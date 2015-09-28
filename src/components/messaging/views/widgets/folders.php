<!--- javascript start --->

@components/messaging/includes/js/mailbox.js
@components/messaging/includes/js/admin-messaging-ng.js

<!--- javascript end --->

<!--- css start --->

@components/messaging/includes/css/mailbox.css
<!--- css end --->


<div class="col-md-3 col-lg-2">
    <div class="mailbox-menu" ng-controller="FoldersController">
        <div class="mailbox-compose-outer">
            <div class="compose-message">
                <a href="/admin/messaging/compose" class="btn btn-success btn-block" role="button">
                    <span class="glyphicon glyphicon-envelope"></span>
                    Compose
                </a>
            </div>
            <div class="mailbox-mobile-menu-control">
                <button type="button" class="btn btn-default within-content-navbar-toggle" data-c-target="#mailbox-menu-actual">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
        </div>
        <ul class="nav nav-pills nav-stacked" id="mailbox-menu-actual">
            <li class="active">
                <a href="/admin/messaging">
                    <span ng-show="inboxCount > 0" class="badge highlight-color-blue pull-right"> {{inboxCount}}</span>
                    Inbox
                </a>
            </li>
            <li class="">
                <a href="#">
                    <span class="badge highlight-color-orange pull-right">
                        <span ng-show="starredCount > 0" class="glyphicon glyphicon-star"></span>{{starredCount}}
                    </span>
                    Important
                </a>
            </li>
            <li class="">
                <a href="#">
                    Sent Mail
                </a>
            </li>           
            <li class="">
                <a href="#">
                    <span class="badge pull-right">{{trashCount}}</span>
                    Trash
                </a>
            </li>
        </ul>
        <div class="mailbox-tags">
            <h5>Tags</h5>
            <a href="#">
                <span class="badge highlight-color-green">New</span>
            </a>
            <a href="#">
                <span class="badge highlight-color-blue">Update</span>
            </a>
            <a href="#">
                <span class="badge highlight-color-yellow">Automated</span>
            </a>
            <a href="#">
                <span class="badge highlight-color-red">Urgent</span>
            </a>
            <a href="#">
                <span class="badge highlight-color-purple">Ignore</span>
            </a>
            <a href="#">
                <span class="badge highlight-color-orange">Work</span>
            </a>
            <a href="#">
                <span class="badge highlight-color-lime">Official</span>
            </a>
        </div>
    </div>
</div>