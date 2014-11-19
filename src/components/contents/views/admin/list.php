
<script language="javascript">

  $(document).ready(function() {

    
    $('.selectable-rows tr').mouseup(function() {

        if($(this).data('type') == 'mainrow') {
            $( this ).next().slideToggle();
        }        
    });
    
    $('.view').click(function(e) {
        window.location = '/admin/contents/jobs/list/' + $(this).data('id') + '/0';
    });
    
    $('.add-packages').click(function(e) {
        e.stopPropagation();
        window.location = '/admin/contents/packages/' + $(this).data('id') + '/0';
    });
    
});
</script>




<table class="table table-striped table-hover selectable-rows">
    <thead>
            <tr>
            <th>Claim</th>
            <th>Address</th>
            <th>Unit</th>
            <th>Name</th>
            <th>Contact Type</th>
            <th>Package Quantity</th>
            <th>Status</th>
            <th>Packout Date</th>
            <th>Return Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tr data-type="mainrow">
        <td>MV-14JS123</td>
        <td>1234 University Place, Surrey, BC</td>
        <td>123</td>
        <td>Galdalf the Grey</td>
        <td>Customer</td>
        <td>45</td>
        <td>need status list</td>
        <td>2014-10-10</td>
        <td>&nbsp;</td>
        <td>
            <button data-id="1" class="view">view</button> 
            <button class="edit">edit</button> 
            <button data-id="1" class="add-packages">Add Packages</button> 
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="9">
            <table class="table">
                <thead>
                    <tr>
                        <td colspan="6">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" type="email" placeholder="Enter description" >
                                    <div class="input-group-addon">search</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Box ID</th>
                        <th>Tag ID</th>
                        <th>Type</th>
                        <th>Room</th>
                        <th>Warehouse Location</th>
                        <th>Item</th>
                    </tr>
                </thead>
                <tr>
                    <td>123</td>
                    <td>1233</td>
                    <td>A</td>
                    <td>104</td>
                    <td>Bin 23</td>
                    <td>remote control</td>
                </tr>
                <tr>
                    <td>124</td>
                    <td>12334</td>
                    <td>B</td>
                    <td>101</td>
                    <td>Bin 23</td>
                    <td>remote control</td>
                </tr>
            </table>
                
        </td>
  </tr>
  <tr style="display:none">
      <td colspan="10"></td>
  </tr>
  <tr>
    <td>MV-14JS123</td>
    <td>1234 University Place, Surrey, BC</td>
    <td>123</td>
    <td>Galdalf the Grey</td>
    <td>Customer</td>
    <td>45</td>
    <td>need status list</td>
    <td>2014-10-10</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MV-14JS123</td>
    <td>1234 University Place, Surrey, BC</td>
    <td>123</td>
    <td>Galdalf the Grey</td>
    <td>Customer</td>
    <td>45</td>
    <td>need status list</td>
    <td>2014-10-10</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MV-14JS123</td>
    <td>1234 University Place, Surrey, BC</td>
    <td>123</td>
    <td>Galdalf the Grey</td>
    <td>Customer</td>
    <td>45</td>
    <td>need status list</td>
    <td>2014-10-10</td>
    <td>2014-10-25</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>MV-14JS123</td>
    <td>1234 University Place, Surrey, BC</td>
    <td>123</td>
    <td>Galdalf the Grey</td>
    <td>Customer</td>
    <td>45</td>
    <td>need status list</td>
    <td>2014-10-10</td>
    <td>2014-10-24</td>
    <td>&nbsp;</td>
  </tr>
</table>
