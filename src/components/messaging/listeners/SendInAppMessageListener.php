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
use extensions\proxyserver\models\ProxyServerModel;
use core\eventlisteners\AbstractListener;

/**
 * SendInAppMessageListener
 *
 * @author Dave Meikle
 */
class SendInAppMessageListener extends AbstractListener {

    public function on_save_success(Event $event) {
        $params = $event->getParams();

        $locale = $this->getDefaultLocale();
        $datasource = $this->getDatasource('extensions\\proxyserver\\models\\ProxyServerModel');
        $model = new ProxyServerModel($this->httpRequest, $this->httpResponse, $this->logger);

        $recipient = $this->getRecipient($params);

        $post = array(
            'Message' => array(
                'requestType' => 'BASIC_EMAIL',
                'to' => array($recipient['email']),
                'cc' => array(),
                'bcc' => array(),
                'subject' => $params['Message']['subject'],
                'html' => '<html><body>this is the message</body></html>',
                'plainText' => $params['Message']['message']
            )
        );

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
