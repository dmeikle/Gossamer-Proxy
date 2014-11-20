
     <script language="javascript">
  $(document).ready(function() {
    
	
	$('.customerDetail').click(function() {
		$( "#customerDialog" ).dialog();
	});
	
  });
  </script>
  
  <div id="customerDialog" title="Customer Details" style="display:none">
  <p>Gladys Knight<br />
  Unit 201<br />
Tel: 604-123-1234<br />
Mobile: 778-123-1233<br />
Email: gknight@thepips.com</p>
</div>
<h2>Active Claims</h2>

<table class="table table-striped table-hover">
        <tr>
          <th scope="col">Job Number</th>
          <th scope="col">Start Date</th>
          <th scope="col">ECD</th>
          <th scope="col">Address</th>
          <th scope="col">Source</th>
          <th scope="col">Phase</th>
          <th scope="col">Status</th>
          <th scope="col">Affected Locations</th>
          <th scope="col">Action</th>
        </tr>
        <tr>
          <td>14-JS123</td>
          <td>2014-10-10</td>
          <td>2014-10-24</td>
          <td>The Paladium<br />
            1234 University Place, Surrey, BC</td>
          <td>Broken Sprinkler Head - Unit 504</td>
          <td>Scheduling</td>
          <td>In-Progress<br />

          <span class="glyphicon glyphicon-envelope" title="unread messages"></span>
          <span class="glyphicon glyphicon-comment" title="unread notifications"></span>
          <span class="glyphicon glyphicon-bell" title="pending alerts"></span>
          <span class="glyphicon glyphicon-flash" title="incident report"></span>
          </td>
          <td>5</td>
          <td>
         	<a href="/portal/claims/1"><span class="glyphicon glyphicon-zoom-in" title="view"></span></a>
          <span class="glyphicon glyphicon-share" title="action request"></span>
          <span class="glyphicon glyphicon-comment" title="notifications"></span>
          
          <span class="glyphicon glyphicon-envelope" title="messages"></span>
          <span class="glyphicon glyphicon-list-alt" title="reports"></span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="8"><table class="table">
            <tr>
              <th scope="col">Location</th>
              <th scope="col">Customer</th>
              <th scope="col">Phase</th>
              <th scope="col">Status</th>
              <th scope="col">Affected Areas</th>
              <th scope="col">Action</th>
              </tr>
            <tr class="alert alert-danger">
              <td>201</td>
              <td><a href=#" class="customerDetail" title="view customer details">Gladys Knight</a><br />
<a href="#" class="customerDetail" title="view customer details">Sadas Daye</a></td>
              <td>Final Repairs</td>
              <td>On-Hold</td>
              <td>Kitchen, Bathroom, Living Room</td>
              <td>
         	<span class="glyphicon glyphicon-zoom-in" title="view"></span>
          <span class="glyphicon glyphicon-user" title="message us"></span>
          <span class="glyphicon glyphicon-home" title="message customer"></span></td>
              </tr>
            <tr>
              <td>202</td>
              <td><a href="#" title="view customer details">Steve McQueen</a></td>
              <td>Final Repairs</td>
              <td>In-Progress</td>
              <td>Kitchen, Bathroom, Living Room</td>
              <td>
              
         	<span class="glyphicon glyphicon-zoom-in" title="view"></span>
          <span class="glyphicon glyphicon-user" title="message us"></span>
          <span class="glyphicon glyphicon-home" title="message customer"></span>
              
              </td>
              </tr>
            <tr>
              <td>301</td>
              <td><a href="#" title="view customer details">Joe Blow</a></td>
              <td>Final Repairs</td>
              <td>In-Progress</td>
              <td>Kitchen, Bathroom</td>
              <td>
         	<span class="glyphicon glyphicon-zoom-in" title="view"></span>
          <span class="glyphicon glyphicon-user" title="message us"></span>
          <span class="glyphicon glyphicon-home" title="message customer"></span></td>
            </tr>
            <tr>
              <td>202</td>
              <td>&nbsp;</td>
              <td>Final Repairs</td>
              <td>In-Progress</td>
              <td>Kitchen, Bathroom, Living Room</td>
              <td>
         	<span class="glyphicon glyphicon-zoom-in" title="view"></span>
          <span class="glyphicon glyphicon-user" title="message us"></span>
          <span class="glyphicon glyphicon-home" title="message customer"></span></td>
            </tr>
            <tr>
              <td>301</td>
              <td>&nbsp;</td>
              <td>Final Repairs</td>
              <td>In-Progress</td>
              <td>Kitchen, Bathroom</td>
              <td>
         	<span class="glyphicon glyphicon-zoom-in" title="view"></span>
          <span class="glyphicon glyphicon-user" title="message us"></span>
          <span class="glyphicon glyphicon-home" title="message customer"></span></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>14-JS123</td>
          <td>2014-10-10</td>
          <td>2014-10-24</td>
          <td>The Paladium<br />
1234 University Place, Surrey, BC</td>
          <td>Broken Sprinkler Head - Unit 504</td>
          <td>Scheduling</td>
          <td>In-Progress</td>
          <td>5</td>
          <td>
         	<span class="glyphicon glyphicon-zoom-in" title="view"></span>
          <span class="glyphicon glyphicon-share" title="action request"></span>
          <span class="glyphicon glyphicon-comment" title="notifications"></span>
          
          <span class="glyphicon glyphicon-envelope" title="messages"></span>
          <span class="glyphicon glyphicon-list-alt" title="reports"></span></td>
        </tr>
        <tr>
          <td>14-JS123</td>
          <td>2014-10-10</td>
          <td>2014-10-24</td>
          <td>The Paladium<br />
1234 University Place, Surrey, BC</td>
          <td>Broken Sprinkler Head - Unit 504</td>
          <td>Scheduling</td>
          <td>In-Progress</td>
          <td>5</td>
          <td>
         	<span class="glyphicon glyphicon-zoom-in" title="view"></span>
          <span class="glyphicon glyphicon-share" title="action request"></span>
          <span class="glyphicon glyphicon-comment" title="notifications"></span>
          
          <span class="glyphicon glyphicon-envelope" title="messages"></span>
          <span class="glyphicon glyphicon-list-alt" title="reports"></span></td>
        </tr>
        <tr>
          <td>14-JS123</td>
          <td>2014-10-10</td>
          <td>2014-10-24</td>
          <td>The Paladium<br />
1234 University Place, Surrey, BC</td>
          <td>Broken Sprinkler Head - Unit 504</td>
          <td>Scheduling</td>
          <td>In-Progress</td>
          <td>5</td>
          <td>
         	<span class="glyphicon glyphicon-zoom-in" title="view"></span>
          <span class="glyphicon glyphicon-share" title="action request"></span>
          <span class="glyphicon glyphicon-comment" title="notifications"></span>
          
          <span class="glyphicon glyphicon-envelope" title="messages"></span>
          <span class="glyphicon glyphicon-list-alt" title="reports"></span></td>
        </tr>
      </table>