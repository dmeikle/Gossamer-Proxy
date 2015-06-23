<!--- javascript start --->

@components/claims/includes/js/admin-claims-list-ng.js

<!--- javascript end --->

<div class="col-sm-6 col-md-3">
    <div class="c-widget c-widget-quick-info c-widget-size-small highlight-color-purple" data-url="#" style="cursor: pointer;">
        <div class="c-widget-icon">
            <span class="icon icon-list-circle"></span>
        </div>
        <div class="c-wdiget-content-block">
            <div class="c-widget-content-heading" ng-controller="claimsCtrl">
                {{openCount}}
            </div>
            <div class="c-widget-content-sub">
                open Claims
            </div>
        </div>
    </div>
</div>