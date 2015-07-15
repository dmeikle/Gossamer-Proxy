<!--- javascript start --->

@components/messaging/includes/js/admin-messaging-ng.js
<!--- javascript end --->

<div class="col-md-9 col-lg-10">
    <div class="mailbox-container mailbox-message-view" data-email-id="1" ng-controller="MessageController" data-ng-init="init('<?php echo $uniqueId;?>')">
        <div class="message-subject h2">
           {{message.subject}}
            <span class="badge highlight-color-green">New</span>
            <span class="email-extra-icons">
                <span class="glyphicon glyphicon-picture icon-size-small highlight-color-blue-text" title="Pictures Attached"></span>
                <span class="glyphicon glyphicon-paperclip icon-size-small" title="Has Attachments"></span>
            </span>
        </div>
        <div class="message-general-info-container">
            <div class="message-controls">
                <div class="btn-group btn-group-sm">
                    <a href="#" type="button" ng-click="isReplyFormOpen = !isReplyFormOpen" class="btn btn-primary">
                        <span class="glyphicon glyphicon-pencil"></span>
                        Reply
                    </a>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#">Forward Message</a></li>
                        <li><a href="#">Archive Message</a></li>
                        <li><a href="#">Mark as Unread</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Delete Message</a></li>
                        <li><a href="#">This is Junk Mail</a></li>
                    </ul>
                </div>
            </div>
            <div class="message-general-info">
                <div class="message-sender-image">
                    <a href="#">
                        <img class="list-thumbnail" src="test-data/pages-mailbox-message-view/images/sender-1.jpg" alt="">
                    </a>
                </div>
                <div class="message-sender">
                    From: <span class="sender-name">{{message.fromStaff}}{{message.fromContact}}</span> <span class="sender-email">({{message.fromStaffEmail}}{{message.toStaffEmail}}{{message.fromContactEmail}}{{message.fromContactEmail}})</span>
                </div>
                <div class="message-recepient">
                    To: <span class="recepient-name">Me</span> <span class="send-date">at  {{message.sendDate}}</span> 
                </div>
                
            </div>
        </div>
        <div class="message-body-container">
            <div class="message-body">
                 {{message.message}}
            </div>
            
        </div>
        <div ng-show="isReplyFormOpen" id="reply-container" ng-controller="ReplyController">
            <form method="post">
                <?php echo $form['uniqueId'];?>
                <?php echo $form['reply'];?>
                <?php echo $form['sendReply'];?>
                <?php echo $form['discard'];?>  
            </form>
        </div>
    </div>
</div>