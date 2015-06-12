

<!--- javascript start --->

@components/staff/includes/js/admin-staff-list-ng.js

<!--- javascript end --->

<div class="block">
    <div class="block-heading">
        <div class="main-text h2">
            Staff List
        </div>
        <div class="block-controls">
            <span aria-hidden="true" class="icon icon-cross icon-size-medium block-control-remove"></span>
            <span aria-hidden="true" class="icon icon-arrow-down icon-size-medium block-control-collapse"></span>
        </div>
    </div>
    <div class="block-content-outer" style="display: block">
        <div class="block-content-inner">
            <div class="table-responsive">
                <table ng-controller="StaffController as manager" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</div>
                            <th>Title</div>
                            <th>Ext</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Last Login</th> 
                            <th>cog</th>    
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="staff in manager.items" >
                            <td class="col-xs-2 col-md-2 col-lg-2"><a href="mailto:{{staff.email}}">{{staff.lastname}}, {{staff.firstname}}</a></td>
                            <td class="col-xs-2 col-md-2 col-lg-2">{{staff.title}}</td> 
                            <td class="col-xs-1 col-md-1 col-lg-1">{{staff.telephone}}</td>  
                            <td class="col-xs-2 col-md-2 col-lg-2">{{staff.mobile}}</td>  
                            <td class="col-xs-1 col-md-1 col-lg-1">{{staff.status}}</td>     
                            <td class="col-xs-2 col-md-2 col-lg-2">{{staff.lastLogin}}</td>  
                            <td><button ng-show="staff.editable">Edit</button> </td>
                        </tr>
                    </tbody>
                </table>
                

                    <ul class="pagination" ng-controller="PaginationController as paginator" style="margin: 0">
                        <li pagination-start></li>
                        <li ng-repeat="row in paginator.rows"> 
                            <a ng-click="manager.loadPage(2)" class=" {{ row.current}}" data-limit="{{ row.limit}}" data-offset="{{ row.offset}}" data-url="/admin/staff/rest/{{$index}}/{{ paginator.rowsPerPage}}">{{ $index + 1}}</a>
                        </li>  
                        <li pagination-end></li>
                    </ul>
                    <dir-pagination-controls on-page-change="paginator.pageChanged(newPageNumber)"></dir-pagination-controls>
                
            </div>
        </div>
    </div>

</div>