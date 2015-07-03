<!--- javascript start --->


@components/claims/includes/js/admin-claims-list-ng.js

<!--- javascript end --->


<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-heading">
                <div class="main-text h2">
                    Claims List
                </div>
                <div class="block-controls">
                    <span aria-hidden="true" class="icon icon-cross icon-size-medium block-control-remove"></span>
                    <span aria-hidden="true" class="icon icon-arrow-down icon-size-medium block-control-collapse"></span>
                </div>
            </div>
            <div class="block-content-outer">
                <div class="block-content-inner">
                    <div class="table-responsive">
                        <div id="datatable-1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="dataTables_length" id="datatable-1_length">
                                        <label>Show <select name="datatable-1_length" aria-controls="datatable-1" class="form-control input-sm">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                            entries</label>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div id="datatable-1_filter" class="dataTables_filter">
                                        <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="datatable-1"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table ng-controller="ClaimsController" id="datatable-1" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Film Title: activate to sort column descending" style="width: 344px;">
                                                    Job Number
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Released: activate to sort column ascending" style="width: 135px;">
                                                    Strata Number
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Studio: activate to sort column ascending" style="width: 133px;">
                                                    Claim Type
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Worldwide Gross: activate to sort column ascending" style="width: 224px;">
                                                    Address
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Domestic Gross: activate to sort column ascending" style="width: 213px;">
                                                    Parent Claim
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Foreign Gross: activate to sort column ascending" style="width: 190px;">
                                                    Status (color row)
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable-1" rowspan="1" colspan="1" aria-label="Budget: activate to sort column ascending" style="width: 149px;">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                            <tr role="row" class="odd" ng-repeat="claim in claimsList">
                                                <td class="sorting_1"><a href="/admin/claim/{{claim.jobNumber}}">{{claim.jobNumber}}</a></td>
                                                <td>{{claim.strataNumber}}</td>
                                                <td>
                                                    <span class="label label-success">{{claim.icon}}</span>
                                                </td>
                                                <td><strong>{{claim.buildingName}}</strong><br>{{claim.address}}</td>
                                                <td>{{claim.parentClaims_id}}</td>
                                                <td>{{claim.ClaimStatusTypes_id}}</td>
                                                <td></td>
                                            </tr>
                                            
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="dataTables_info" id="datatable-1_info" role="status" aria-live="polite">Showing 1 to 10 of 20 entries</div>
                                        
                                </div>
                                <div class="col-xs-6">
                                    <div class="dataTables_paginate paging_simple_numbers" id="datatable-1_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous disabled" aria-controls="datatable-1" tabindex="0" id="datatable-1_previous">
                                                <a href="#">Previous</a>
                                            </li>
                                            <li class="paginate_button active" aria-controls="datatable-1" tabindex="0">
                                                <a href="#">1</a>
                                            </li>
                                            <li class="paginate_button " aria-controls="datatable-1" tabindex="0">
                                                <a href="#">2</a>
                                            </li>
                                            <li class="paginate_button next" aria-controls="datatable-1" tabindex="0" id="datatable-1_next">
                                                <a href="#">Next</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>