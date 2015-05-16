



<!--- javascript start --->

@components/staff/includes/js/admin-staff-list-bb.js

<!--- javascript end --->

  
 

  <div class="container">
     <div class="panel panel-default">
      <div class="panel-heading ">
          <div style="float: right">
              <a href="#/new"><span class="fa fa-user-plus" id="add-user"></span></a>
              <!--<span class="glyphicon glyphicon-align-justify" id="show-rows" style="display: none"></span>
              <span class="glyphicon glyphicon-th" id="show-panes"></span>-->
              <span class="fa fa-calendar" id="on-call-list"></span>
          </div>
        Staff List
      </div>
            <div class="page"></div>
   
    </div>
    <div>

        <ul class="pagination">
            <li>
                <a data-limit="20" data-offset="0" data-url="/admin/staff" class="pagination current">«</a>
            </li> 
            <li>
                <a data-limit="20" data-offset="0" data-url="/admin/staff" class="pagination current">1</a>
            </li> 
            <li><a data-limit="20" data-offset="0" data-url="/admin/staff" class="pagination current">»</a>
            </li>
        </ul>
    </div>
  </div>

 
  <script type="text/template" id="user-list-template">
   
    <table class="table table-striped col-xs-10 col-s-3 col-md-3 staff-member">
      <thead>
        <tr>
          <th>Name</th>
          <th>Title</th>
          <th>Ext</th>
          <th>Mobile</th>
          <th>Status</th>
          <th>Last Login</th> 
          <th></th>     
        </tr>
      </thead>
      <tbody>
        <% _.each(companies, function(user) { %>
        
            <tr data-id="<%= user.id %>">
                <td class="td name"><a href="mailto:<%= htmlEncode(user.get('email')) %>"><%= htmlEncode(user.get('lastname')) %>, <%= htmlEncode(user.get('firstname')) %></a></td>
                <td class="td title"><%= htmlEncode(user.get('title')) %></td>               
                <td class="td telephone"><%= htmlEncode(user.get('telephone')) %></td>
                <td class="td mobile"><%= htmlEncode(user.get('mobile')) %></td>
                <td>
                 <div class="td status-select" style="display:none">
                   <select class="staffStatus">
                      
                    </select>
                    </div>
                    <a data-type="status" onclick="return false;" class="status"><%= htmlEncode(user.get('status')) %></a>
                </div>
                </td>
                <td>
                    <%= htmlEncode(user.get('lastLogin')) %>   
                </td>
                <td>
                    <div class="edit-pane dropdown">
                        <ul>
                            <li class="has-sub"><span class="glyphicon glyphicon-cog"></span>                       
                                <ul>                            
                                    <li><a href="#" data-id="<%= user.id %>" class="btn btn-primary btn-xs schedule">Schedule</a></li> 
                                    <li><a href="#" data-id="<%= user.id %>" class="btn btn-primary btn-xs edit">Edit</a></li> 
                                    <li><a href="#" class="btn btn-primary btn-xs credentials" data-id="<%= user.id %>">Credentials</a></li> 
                                    <li><a href="#" class="btn btn-primary btn-xs permissions" data-id="<%= user.id %>">Permissions</a></li> 
                                    <li><a href="#" class="btn btn-primary btn-xs emergency" data-id="<%= user.id %>">Emergency Contacts</a></li> 
                                    <li><a href="#" data-id="<%= user.id %>" class="btn btn-primary btn-xs delete">Delete</a></li>
                                </ul> 
                            </li> 
                        </ul>                
                    </div>
                    
                </td>
        
            </tr>
    
        <% }); %>
      </tbody>
    </table>
  </script>     
  
 <script type="text/template" id="edit-user-template">
    <form class="edit-user-form">
      <legend><%= user ? 'Edit' : 'New' %> User</legend>
        <label>First Name</label>
        <input name="firstname" type="text" value="<%= user ? user.get('firstname') : '' %>">
        <label>Last Name</label>
        <input name="lastname" type="text" value="<%= user ? user.get('lastname') : '' %>">
        <label>Age</label>
        <input name="age" type="text" value="<%= user ? user.get('age') : '' %>">
        <hr />
       <button type="submit" class="btn"><%= user ? 'Update' : 'Create' %></button>
       <% if(user) { %>
        <input type="hidden" name="id" value="<%= user.id %>" />
       <button data-user-id="<%= user.id %>" class="btn btn-danger delete">Delete</button>
       <% }; %>
    </form>
  </script>