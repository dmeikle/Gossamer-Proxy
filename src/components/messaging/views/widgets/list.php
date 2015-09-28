<!--- javascript start --->

@components/messaging/includes/js/mailbox.js
@components/messaging/includes/js/admin-messaging-ng.js
<!--- javascript end --->

<!--- css start --->

@components/messaging/includes/css/mailbox.css
<!--- css end --->

<script language="javascript">

$(document).ready(function() {
    $(".email-star").on("click", function(){
            $(this).find(".email-star-status").toggleClass("checked");
    });
});


</script>
<div class="col-md-9 col-lg-10">
    <div class="mailbox-container mailbox-email-list">
        <div class="mailbox-controls">
            <div class="checkbox email-select-all">
                <label class="">
                    <div class="icheckbox_square-blue checkbox-actual" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                    <span class="main-text hidden-xs hidden-sm">
                        Select All
                    </span>
                </label>
            </div>
            <a href="#" class="btn btn-default btn-sm email-refresh">
                <span class="glyphicon glyphicon-refresh"></span>
            </a>
            <a href="#" class="btn btn-default btn-sm email-mark-read" disabled="disabled">
                <span class="glyphicon glyphicon-saved"></span>
                <span class="hidden-xs hidden-sm">
                    Mark as Read
                </span>
            </a>
            <a href="#" class="btn btn-default btn-sm email-mark-junk" disabled="disabled">
                <span class="glyphicon glyphicon-warning-sign"></span>
                <span class="hidden-xs hidden-sm">
                    Mark as Junk
                </span>
            </a>
            <a href="#" class="btn btn-default btn-sm email-delete" disabled="disabled">
                <span class="glyphicon glyphicon-trash"></span>
            </a>
            <div class="email-pager-top">
                <div class="email-pager-container">
                    <a href="#" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a href="#" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
                <div class="email-pager-count hidden-xs hidden-sm">1- of {{rowCount}}</div>
            </div>
        </div>
        <table class="table table-hover" ng-controller="MessagingController">
            <tbody>
                
                <tr ng-class="rowClass(message)" data-email-id="2" ng-click="viewMessage(message.uniqueId)" ng-repeat="message in messages">
                    <td class="email-checkbox">
                        <div class="icheckbox_square-blue checkbox-actual" style="position: relative;">
                            <input type="checkbox" class="email-item-checkbox" style="position: absolute; opacity: 0;">
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                        </div>
                    </td>
                    <td class="email-star">
                        <span class="email-star-status">
                            <span class="glyphicon glyphicon-star email-important"></span>
                            <span class="glyphicon glyphicon-star-empty email-normal"></span>
                        </span>
                    </td>
                    <td class="email-sender">
                        {{message.fromStaff}}{{message.fromContact}}
                    </td>
                    <td class="email-subject">
                        <span class="email-extra-icons">
                            <span class="glyphicon glyphicon-warning-sign highlight-color-red-text" title="Junk Mail"></span>
                            <span class="glyphicon glyphicon-paperclip" title="Has Attachment"></span>
                        </span>
                        {{message.subject}}
                    </td>
                    <td class="email-datetime">
                        {{message.sendDate | date : 'fullDate'}}
                    </td>
                </tr>
                <tr class="empty-list">
                    <td colspan="5">You currently have no emails.</td>
                </tr>
            </tbody></table>
        <div class="email-pager-bottom" ng-controller="MessagingController">
            <div class="email-pager-count">1-{{limit}} of {{rowCount}}</div>
            <a href="#" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a href="#" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
</div>