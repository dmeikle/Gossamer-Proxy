here

<!--- javascript start --->

@core/components/widgets/includes/js/admin-widgets-ng.js

<!--- javascript end --->
<form method="post">
<table ng-controller="WidgetsController as widgets" cstalass="table table-striped table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Component</th>
            <th>Description</th>
            <th>HTML Key</th>
            <th>cog</th>    
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="widget in widgets.items" >
            <td class="col-xs-2 col-md-2 col-lg-2">
                <div ng-hide="editingData[widget.id]">{{widget.name}}</div>
                <div ng-show="editingData[widget.id]"><input type="text" ng-model="widget.name" /></div> 
            </td> 
            <td class="col-xs-1 col-md-1 col-lg-1">                <div ng-hide="editingData[widget.id]">{{widget.component}}</div>
                <div ng-show="editingData[widget.id]"><input type="text" ng-model="widget.component" /></div> 
            </td>  
            <td class="col-xs-2 col-md-2 col-lg-2">                <div ng-hide="editingData[widget.id]">{{widget.description}}</div>
                <div ng-show="editingData[widget.id]"><textarea ng-model="widget.description"></textarea></div> 
            </td>  
            <td class="col-xs-1 col-md-1 col-lg-1">            
                <div ng-hide="editingData[widget.id]">{{widget.htmlKey}}</div>
                <div ng-show="editingData[widget.id]"><input type="text" ng-model="widget.htmlKey" /></div> 
            </td>     
            <td>
            <button ng-hide="editingData[widget.id]" ng-click="modify(widget)">Edit</button>
            <button ng-show="editingData[widget.id]" ng-click="update(widget)">Update</button>
            </td>
        </tr>
    </tbody>
</table>
</form>