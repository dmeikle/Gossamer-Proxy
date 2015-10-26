<!--- javascript start --->

@components/messaging/includes/js/admin-messaging-ng.js

<!--- javascript end --->
<div class="col-md-9 col-lg-10">
    <div class="mailbox-container mailbox-message-compose"> <!-- NOTE TO READER: Accepts the following class(es) "minimal-view" -->
        <form role="form" id="message-compose" ng-controller="ReplyController" ng-submit="sendMessage(message)">
            <div class="form-group email-recepient-main-container">
                <label for="email-recepient-main">To: </label>
                <span class="pull-right text-right">
                    <a href="#" id="add-cc" class="">Add Cc</a>
                    <a href="#" id="add-bcc" class="">Add Bcc</a>
                </span>
                <span class="text-muted">Type the person's name or enter a new to add to the Address Book (eg: Samantha or demo@example.com)</span>
                <?php echo $form['toContact_id'] . $form['toContact']; ?>

            </div>

            <div class="form-group email-subject-container">
                <label for="email-subject">Subject</label>
                <?php echo $form['subject']; ?>
            </div>
            <div class="form-group email-body-container">
                <?php echo $form['message']; ?>
            </div>

            <div class="message-compose-controls clearfix">
                <div class="message-compose-contols-left">
                    <a id="attach-file" class="btn btn-warning btn-sm" >
                        <span class="glyphicon glyphicon-paperclip"></span>
                        Add Attachment
                    </a>
                </div>
                <div class="message-compose-contols-right">

                    <a href="#" id="send-email" class="btn btn-primary btn-sm" ng-click="sendMessage(message)">
                        <span class="glyphicon glyphicon-send"></span>
                        Send Email
                    </a>
                    <a href="/admin/messaging" id="discard-email" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-ban-circle"></span>
                        Discard
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>