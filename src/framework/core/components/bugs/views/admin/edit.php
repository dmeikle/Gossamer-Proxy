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

    <table class="table">
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
    </table>

</div>