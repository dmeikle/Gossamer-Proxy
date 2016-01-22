<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\messaging\listeners;

use core\eventlisteners\Event;
use extensions\proxyserver\models\ProxyMessageModel;
use core\eventlisteners\AbstractListener;
use components\messaging\models\MessagingNotificationTemplateModel;

/**
 * SendInAppMessageListener
 *
 * @author Dave Meikle
 */
class SendInAppMessageListener extends AbstractListener {

    use \components\messaging\traits\LoadMailTemplateTrait;

    public function on_save_success(Event $event) {

        $params = $event->getParams();
        $this->loadTemplate($params['Message']['messageType']);

        $recipient = $this->getRecipient($params);
        file_put_contents('/var/www/ip2/phoenixrestorations.com/logs/save.log', str_replace('<!---message--->', $params['Message']['message'], $this->template), FILE_APPEND);
        $post = array(
            'Message' => array(
                'requestType' => 'BASIC_EMAIL',
                'to' => array($recipient['email']),
                'cc' => array(),
                'bcc' => array(),
                'subject' => $params['Message']['subject'],
                'html' => str_replace('<!---message--->', $params['Message']['message'], $this->template),
                'plainText' => $params['Message']['message']
            )
        );

        $datasource = $this->getDatasource('extensions\\proxyserver\\models\\ProxyMessageModel');
        $model = new ProxyMessageModel($this->httpRequest, $this->httpResponse, $this->logger);

        $result = $datasource->query('post', $model, 'mail', $post);
    }

    private function getRecipient(array $message) {
        if (array_key_exists('Contact', $message)) {
            return $message['Contact'];
        } elseif (array_key_exists('Staff', $message)) {
            return $message['Contact'];
        } elseif (array_key_exists('Customer', $message)) {
            return $message['Customer'];
        }
    }

}
