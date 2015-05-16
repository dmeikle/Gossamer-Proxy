


<!--- javascript start --->

    @components/tickets/includes/js/admin-tickets-list.js
<!--- javascript end --->

<?php //pr($this->data);?>
<style>
    #tickets {
        width: 100%;
    }    
    .ticket {
        display:block;
        clear: both;
    }
    #tickets .ticketNumber, #tickets .category, #tickets .ticketType, #tickets .jobNumber {
        width: 20%;
        float: left;
        
    }
    #tickets .action, #tickets .expand {
        width: 10%;
        float: left;
    }
    
    #ticket-slider {
        max-width: 795px;
    }
    
    #ticket-slider #dateStarted {
        width: 50%;
        float: left;
    }
    
    #ticket-slider #timeStarted {
        width: 50%;
        float: left;
    }
    #ticket-slider #assignee {
        float: left;
    }
    #ticket-slider .room {
        clear: both;
        margin: 3px;
    }
    #ticket-slider .room .roomName {
        font-weight: bold;
        background-color: inherit;
    }
    #ticket-slider .room .action {
        float: left;
        width: 40%;
    }
    #ticket-slider .room .coverage {
        float: left;
        width: 20%;
        background-color: inherit;
    }
    #ticket-slider .room .status {
        float: left;
        width: 20%;
        background-color: inherit;
    }
    #ticket-slider .room .walls {
        float: left;
        width: 20%;
        background-color: inherit;
    }
    #ticket-slider .room .action {
        float: left;
        width: 20%;
        background-color: inherit;
    }
    
    .room:nth-child(odd) {
        background-color: #007fff;
      }

      .room:nth-child(even) {
        background-color: #e6e6e6;
      }
</style>
    
<table data-role="table" id="movie-table-custom" class="table tickets ui-responsive table-striped">
    <thead>
        <th data-priority="1">Number</th>
        <th data-priority="1">Category</th>
        <th data-priority="1">Type</th>
        <th data-priority="1">Job</th>
        <th data-priority="1">Action</th>  
        <th data-priority="1">Action</th>  
    </thead>
    
<?php foreach($Tickets as $ticket) {?>
    <tr>
        <td class="ticketNumber">
            <?php echo $ticket['prefix'] . $ticket['sequenceId'];?>
        </td>
        <td  class="category">            
            <?php echo $ticket['category'];?>
        </td>
        <td  class="ticketType">            
            <?php echo $ticket['TicketTypes_id'];?>
        </td>
        <td class="jobNumber">
            <?php echo $ticket['jobNumber'];?>
        </td>
        <td class="action">-</td>
        <td class="expand">
            <a href="#" data-id="<?php echo $ticket['Tickets_id'];?>" class="view-ticket"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </td>
    </tr>
<?php }?>
</table>

<?php
echo $pagination; ?>
