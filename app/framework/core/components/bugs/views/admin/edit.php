<?php
/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
?>
<div ng-controller="bugsEditCtrl as ctrl">
    <h2 class="pull-left"><?php echo $this->getString('BUGS_TICKET'); ?> {{ctrl.bug.ticketId}}
        <span ng-if="ctrl.saving">
            <loading-spinner class="action-spinner blue"></loading-spinner>
        </span>
    </h2>
    <div class="clearfix"></div>
    <section class="card">
        <div class="col-md-4">
            <ul class="material-list">
                <li class="material-list-item">
                    <div class="material-list-item-content">
                        <span class="material-list-title"><?php echo $this->getString('BUGS_TICKET_ID'); ?></span>
                        <span class="material-list-secondary" ng-if="!ctrl.bug.ticketId">-</span>
                        <span class="material-list-secondary">{{ctrl.bug.ticketId}}</span>
                    </div>
                </li>
                <li class="material-list-item">
                    <div class="material-list-item-content">
                        <span class="material-list-title"><?php echo $this->getString('BUGS_SUBJECT'); ?></span>
                        <span class="material-list-secondary" ng-if="!ctrl.bug.subject">-</span>
                        <span class="material-list-secondary">{{ctrl.bug.subject}}</span>
                    </div>
                </li>
                <li class="material-list-item">
                    <div class="material-list-item-content">
                        <span class="material-list-title"><?php echo $this->getString('BUGS_DATE_ENTERED'); ?></span>
                        <span class="material-list-secondary" ng-if="!ctrl.bug.lastModified">-</span>
                        <span class="material-list-secondary">{{ctrl.bug.lastModified}}</span>
                    </div>
                </li>
                <li class="material-list-item">
                    <div class="material-list-item-content">
                        <span class="material-list-title"><?php echo $this->getString('BUGS_ENTERED_BY'); ?></span>
                        <span class="material-list-secondary" ng-if="!ctrl.bug.staff">-</span>
                        <span class="material-list-secondary">{{ctrl.bug.staff}}</span>
                    </div>
                </li>


            </ul>
        </div>
        <div class="col-md-4">
            <ul class="material-list">

                <li class="material-list-item">
                    <div class="material-list-item-content">
                        <span class="material-list-title"><?php echo $this->getString('BUGS_COMMENTS'); ?></span>
                        <span class="material-list-secondary" ng-if="!ctrl.bug.comments">-</span>
                        <span class="material-list-secondary">{{ctrl.bug.comments}}</span>
                    </div>
                </li>
                <li class="material-list-item">
                    <div class="material-list-item-content">
                        <span class="material-list-title"><?php echo $this->getString('BUGS_ERROR_MESSAGE'); ?></span>
                        <span class="material-list-secondary" ng-if="!ctrl.bug.errorMessage">-</span>
                        <span class="material-list-secondary">{{ctrl.bug.errorMessage}}</span>
                    </div>
                </li>
                <li class="material-list-item">
                    <div class="material-list-item-content">
                        <span class="material-list-title"><?php echo $this->getString('BUGS_REFERER_URL'); ?></span>
                        <span class="material-list-secondary" ng-if="!ctrl.bug.refererURL">-</span>
                        <span class="material-list-secondary">{{ctrl.bug.refererURL}}</span>
                    </div>
                </li>
                <li class="material-list-item">
                    <div class="material-list-item-content">
                        <span class="material-list-title"><?php echo $this->getString('BUGS_CURRENT_URL'); ?></span>
                        <span class="material-list-secondary" ng-if="!ctrl.bug.currentURL">-</span>
                        <span class="material-list-secondary">{{ctrl.bug.currentURL}}</span>
                    </div>
                </li>
            </ul>
        </div>

        <div class="col-md-4">
            <div>
                <ul class="material-list">
                    <li class="material-list-item">
                        <div class="material-list-item-content">
                            <span class="material-list-title"><?php echo $this->getString('BUGS_STATUS'); ?></span>
                            <span class="material-list-secondary">
                                <select class="form-control" ng-model="ctrl.bug.status">
                                    <option>pending</option>
                                    <option>active</option>
                                    <option>completed</option>
                                </select>
                            </span>
                        </div>
                    </li>
                    <li class="material-list-item">
                        <div class="material-list-item-content">
                            <span class="material-list-title"><?php echo $this->getString('BUGS_NOTES'); ?></span>
                            <span class="material-list-secondary">
                                <textarea rows="5" ng-model="ctrl.bug.notes" class="form-control"></textarea>
                            </span>
                            <!--<span class="material-list-secondary">{{ctrl.bug.staff}}</span>-->
                        </div>
                    </li>
                </ul>

            </div>
            <div class="clearfix"></div>
            <button class="btn-primary pull-right" ng-click="ctrl.save(ctrl.bug)">Save</button>
        </div>
        <div class="clearfix"></div>
    </section>
<!--    <table class="table">
<tr>
<td>Ticket ID</td>
<td>{{ctrl.bug.ticketId}}</td>
<td rowspan="10" valign="top">
Notes<br />
<textarea rows="10" ng-model="ctrl.bug.notes" class="form-control"></textarea>
</td>
</tr>
<tr>
<td>Date Entered</td>
<td>{{ctrl.bug.lastModified}}</td>
</tr>
<tr>
<td>Subject</td>
<td>{{ctrl.bug.subject}}</td>
</tr>
<tr>
<td>Comments</td>
<td>{{ctrl.bug.comments}}</td>
</tr>
<tr>
<td>Error Message</td>
<td>{{ctrl.bug.errorMessage}}</td>
</tr>
<tr>
<td>Referer URL</td>
<td>{{ctrl.bug.refererURL}}</td>
</tr>
<tr>
<td>Current URL</td>
<td>{{ctrl.bug.currentURL}}</td>
</tr>
<tr>
<td>Entered By</td>
<td>{{ctrl.bug.staff}}</td>
</tr>
<tr>
<td>Status</td>
<td>
<select class="form-control" ng-model="ctrl.bug.status">
    <option>pending</option>
    <option>active</option>
    <option>completed</option>
</select>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td><button ng-click="ctrl.save(ctrl.bug)">Save</button></td>
</tr>
</table>-->

</div>