<!--- javascript start --->
    @components/shoppingcart/includes/js/jquery.jeditable.mini.js
    @components/shoppingcart/includes/js/admin-view-purchase.js
<!--- javascript end --->

<?php

$client = $purchase['Client'];

?>
<input style="visibility: hidden" type=hidden" id="clientId" value="<?php echo $client['id'];?>" />
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $this->getString('LABEL_PURCHASER_INFORMATION'); ?>
    </div>
<table class="table" id="table" width="100%">
    <tr>
        <td>
            <?php echo $this->getString('LABEL_PURCHASE_NUMBER'); ?> #
        </td>
        <td>
            <?php echo $purchase['id']; ?>    
        </td>
        <td>
            <?php echo $this->getString('LABEL_DATE'); ?>: 
        </td>
        <td class="editable">
            <?php echo $purchase['orderDate'];?>    
        </td>
    </tr>
</table>
    <table width="100%">
        <tr> 
            <td width="50%">
                <table width="100%" class="table">
                    <tr>
                        <td width="100" align="right"><?php echo $this->getString('LABEL_FIRSTNAME'); ?>: </td>
                        <td  class="dblclick" style="display: inline" title="Doubleclick to edit..." id="firstname" data-><?php echo $client['firstname'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_LASTNAME'); ?>: </td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="lastname"><?php echo $client['lastname'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_CITY'); ?>: </td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="city"><?php echo $client['city'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_STATE'); ?>: </td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="state"><?php echo $client['state'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_COUNTRY'); ?>: </td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="country"><?php echo $client['country'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_ZIP'); ?>: </td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="zip"><?php echo $client['zip'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_TELEPHONE'); ?>: </td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="telephone"><?php echo $client['telephone'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_EMAIL'); ?>: </td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="email"><?php echo $client['email'];?></td>
                    </tr> <tr>
                        <td width="40" align="right"><?php echo $this->getString('LABEL_COMPANY'); ?>: </td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="company"><?php echo $client['company'];?></td>
                    </tr>
                </table>                
            </td>
            <td>
                <table width="100%" class="table">
                    <tr>
                        <td width="100" align="right"><?php echo $this->getString('LABEL_SHIP_FIRSTNAME'); ?>:</td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="shipFirstname"><?php echo $client['shipFirstname'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_SHIP_LASTNAME'); ?>:</td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="shipLastname"><?php echo $client['shipLastname'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_SHIP_CITY'); ?>:</td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="shipCity"><?php echo $client['shipCity'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_SHIP_STATE'); ?>:</td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="shipState"><?php echo $client['shipState'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_SHIP_COUNTRY'); ?>:</td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="shipCountry"><?php echo $client['shipCountry'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_SHIP_ZIP'); ?>:</td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="shipZip"><?php echo $client['shipZip'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_SHIP_TELEPHONE'); ?>:</td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="shipTelephone"><?php echo $client['shipTelephone'];?></td>
                    </tr> <tr>
                        <td align="right"><?php echo $this->getString('LABEL_SHIP_EMAIL'); ?>:</td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="shipEmail"><?php echo $client['shipEmail'];?></td>
                    </tr> <tr>
                        <td width="60" align="right"><?php echo $this->getString('LABEL_SHIP_COMPANY'); ?>:</td>
                        <td class="dblclick" style="display: inline" title="Doubleclick to edit..." id="shipCompany"><?php echo $client['shipCompany'];?></td>
                    </tr>
                </table> 
            </td>
        </tr>
    </table>
</div>
