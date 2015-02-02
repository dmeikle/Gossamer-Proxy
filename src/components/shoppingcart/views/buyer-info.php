<!--- css start --->
@components/shoppingcart/includes/css/checkout-buyer.css
<!--- css end --->

<form method="post" action="<gcms:uri='cart_checkout_2'/>">
    
 
<form  class="form-horizontal" role="form" method="post" action="<gcms:uri='cart_checkout_2'/>"> 

	<h3>Billing Information</h3>
 

	<table class="table"> 
      <tbody>
          <tr> 
        <td align="right" width="125"><label>First Name:</label></td> 
        <td><?php echo $form['firstname']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Last Name:</label></td> 
        <td><?php echo $form['lastname']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Email:</label></td> 
        <td><?php echo $form['email']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Company:</label></td> 
        <td><?php echo $form['company']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Phone:</label></td> 
        <td><?php echo $form['telephone']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right" valign="top"><label>Street Address:</label></td> 
        <td><?php echo $form['address1']; ?>
<br> 
	    <?php echo $form['address2']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>City:</label></td> 
        <td><?php echo $form['city']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>State/Province:</label></td> 
        <td><select name="client[state]" onmousewheel="return false;"> 
          <option value='{"state":"", "id":""}'>Select State</option> 
          <option value='{"state":"AL", "id":"1"}'>Alabama</option> 
          <option value='{"state":"AK", "id":"2"}'>Alaska</option> 
          <option value='{"state":"AS", "id":"3"}'>American Samoa</option> 
          <option value='{"state":"AZ", "id":"4"}'>Arizona</option> 
          <option value='{"state":"AR", "id":"5"}'>Arkansas</option> 
          <option value='{"state":"CA", "id":"6"}'>California</option> 
          <option value='{"state":"CO", "id":"7"}'>Colorado</option> 
          <option value='{"state":"CT", "id":"8"}'>Connecticut</option> 
          <option value='{"state":"DE", "id":"9"}'>Delaware</option> 
          <option value='{"state":"DC", "id":"10"}'>District of Columbia</option> 
          <option value='{"state":"FL", "id":"11"}'>Florida</option> 
          <option value='{"state":"GA", "id":"12"}'>Georgia</option> 
          <option value='{"state":"HI", "id":"13"}'>Hawaii</option> 
          <option value='{"state":"ID", "id":"14"}'>Idaho</option> 
          <option value='{"state":"IL", "id":"15"}'>Illinois</option> 
          <option value='{"state":"IN", "id":"16"}'>Indiana</option> 
          <option value='{"state":"IA", "id":"17"}'>Iowa</option> 
          <option value='{"state":"KS", "id":"18"}'>Kansas</option> 
          <option value='{"state":"KY", "id":"19"}'>Kentucky</option> 
          <option value='{"state":"LA", "id":"20"}'>Louisiana</option> 
          <option value='{"state":"ME", "id":"21"}'>Maine</option> 
          <option value='{"state":"MD", "id":"22"}'>Maryland</option> 
          <option value='{"state":"MA", "id":"23"}'>Massachusetts</option> 
          <option value='{"state":"MI", "id":"24"}'>Michigan</option> 
          <option value='{"state":"MN", "id":"25"}'>Minnesota</option> 
          <option value='{"state":"MS", "id":"26"}'>Mississippi</option> 
          <option value='{"state":"MO", "id":"27"}'>Missouri</option> 
          <option value='{"state":"MT", "id":"28"}'>Montana</option> 
          <option value='{"state":"NE", "id":"29"}'>Nebraska</option> 
          <option value='{"state":"NV", "id":"30"}'>Nevada</option> 
          <option value='{"state":"NH", "id":"31"}'>New Hampshire</option> 
          <option value='{"state":"NJ", "id":"32"}'>New Jersey</option> 
          <option value='{"state":"NM", "id":"33"}'>New Mexico</option> 
          <option value='{"state":"NY", "id":"34"}'>New York</option> 
          <option value='{"state":"NC", "id":"35"}'>North Carolina</option> 
          <option value='{"state":"ND", "id":"36"}'>North Dakota</option> 
          <option value='{"state":"OH", "id":"37"}'>Ohio</option> 
          <option value='{"state":"OK", "id":"38"}'>Oklahoma</option> 
          <option value='{"state":"OR", "id":"39"}'>Oregon</option> 
          <option value='{"state":"PA", "id":"40"}'>Pennsylvania</option> 
          <option value='{"state":"PR", "id":"41"}'>Puerto Rico</option> 
          <option value='{"state":"RI", "id":"42"}'>Rhode Island</option> 
          <option value='{"state":"SC", "id":"43"}'>South Carolina</option> 
          <option value='{"state":"SD", "id":"44"}'>South Dakota</option> 
          <option value='{"state":"TN", "id":"45"}'>Tennessee</option> 
          <option value='{"state":"TX", "id":"46"}'>Texas</option> 
          <option value='{"state":"UT", "id":"47"}'>Utah</option> 
          <option value='{"state":"VT", "id":"48"}'>Vermont</option> 
          <option value='{"state":"VI", "id":"49"}'>Virgin Islands</option> 
          <option value='{"state":"VA", "id":"50"}'>Virginia</option> 
          <option value='{"state":"WA", "id":"51"}'>Washington</option> 
          <option value='{"state":"WV", "id":"52"}'>West Virginia</option> 
          <option value='{"state":"WI", "id":"53"}'>Wisconsin</option> 
          <option value='{"state":"WY", "id":"54"}'>Wyoming</option> 
          <option value='{"state":"AB", "id":"55"}'>Alberta</option> 
          <option value='{"state":"BC", "id":"56"}'>British Columbia</option> 
          <option value='{"state":"MB", "id":"57"}'>Manitoba</option> 
          <option value='{"state":"NB", "id":"58"}'>New Brunswick</option> 
          <option value='{"state":"NF", "id":"59"}'>Newfoundland</option> 
          <option value='{"state":"NT", "id":"60"}'>Northwest Territories</option> 
          <option value='{"state":"NS", "id":"61"}'>Nova Scotia</option> 
          <option value='{"state":"ON", "id":"62"}'>Ontario</option> 
          <option value='{"state":"PE", "id":"63"}'>Prince Edward Island</option> 
          <option value='{"state":"QC", "id":"64"}'>Quebec</option> 
          <option value='{"state":"SK", "id":"65"}'>Saskatchewan</option> 
          <option value='{"state":"YT", "id":"66"}'>Yukon Territory</option> 
        </select></td> 
      </tr> 
      <tr> 
        <td align="right"><label>ZIP/Postal Code:</label></td> 
        <td><?php echo $form['zip']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Country:</label></td> 
        <td><select name="client[country]" onmousewheel="return false;" onchange="javascript:handleVATZeroRatingVisibility();"> 
          <option value="">Click to Select</option> 
          <option value=""></option> 
          <option value="CA">Canada</option> 
          <option value="US">United States</option> 
        </select></td> 
      </tr> 
    </tbody></table> 
	
	
	<h3>Shipping Information</h3>(if different)
<input type="hidden" name="client[shipto]" value="different"> 
  
	<table class="table"> 
      <tbody><tr> 
        <td align="right" width="125"><label>First Name:</label></td> 
        <td><?php echo $form['shipFirstname']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Last Name:</label></td> 
        <td><?php echo $form['shipLastname']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Email:</label></td> 
        <td><?php echo $form['shipEmail']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Company:</label></td> 
        <td><?php echo $form['shipCompany']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Phone:</label></td> 
        <td><?php echo $form['shipTelephone']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right" valign="top"><label>Street Address:</label></td> 
        <td><?php echo $form['shipAddress1']; ?>
<br> 
	    <?php echo $form['shipAddress2']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>City:</label></td> 
        <td><?php echo $form['shipCity']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>State/Province:</label></td> 
        <td><select name="client[shipState]" onmousewheel="return false;"> 
           <option value='{"state":"", "id":"0"}'>Select State</option> 
          <option value='{"state":"AL", "id":"1"}'>Alabama</option> 
          <option value='{"state":"AK", "id":"2"}'>Alaska</option> 
          <option value='{"state":"AS", "id":"3"}'>American Samoa</option> 
          <option value='{"state":"AZ", "id":"4"}'>Arizona</option> 
          <option value='{"state":"AR", "id":"5"}'>Arkansas</option> 
          <option value='{"state":"CA", "id":"6"}'>California</option> 
          <option value='{"state":"CO", "id":"7"}'>Colorado</option> 
          <option value='{"state":"CT", "id":"8"}'>Connecticut</option> 
          <option value='{"state":"DE", "id":"9"}'>Delaware</option> 
          <option value='{"state":"DC", "id":"10"}'>District of Columbia</option> 
          <option value='{"state":"FL", "id":"11"}'>Florida</option> 
          <option value='{"state":"GA", "id":"12"}'>Georgia</option> 
          <option value='{"state":"HI", "id":"13"}'>Hawaii</option> 
          <option value='{"state":"ID", "id":"14"}'>Idaho</option> 
          <option value='{"state":"IL", "id":"15"}'>Illinois</option> 
          <option value='{"state":"IN", "id":"16"}'>Indiana</option> 
          <option value='{"state":"IA", "id":"17"}'>Iowa</option> 
          <option value='{"state":"KS", "id":"18"}'>Kansas</option> 
          <option value='{"state":"KY", "id":"19"}'>Kentucky</option> 
          <option value='{"state":"LA", "id":"20"}'>Louisiana</option> 
          <option value='{"state":"ME", "id":"21"}'>Maine</option> 
          <option value='{"state":"MD", "id":"22"}'>Maryland</option> 
          <option value='{"state":"MA", "id":"23"}'>Massachusetts</option> 
          <option value='{"state":"MI", "id":"24"}'>Michigan</option> 
          <option value='{"state":"MN", "id":"25"}'>Minnesota</option> 
          <option value='{"state":"MS", "id":"26"}'>Mississippi</option> 
          <option value='{"state":"MO", "id":"27"}'>Missouri</option> 
          <option value='{"state":"MT", "id":"28"}'>Montana</option> 
          <option value='{"state":"NE", "id":"29"}'>Nebraska</option> 
          <option value='{"state":"NV", "id":"30"}'>Nevada</option> 
          <option value='{"state":"NH", "id":"31"}'>New Hampshire</option> 
          <option value='{"state":"NJ", "id":"32"}'>New Jersey</option> 
          <option value='{"state":"NM", "id":"33"}'>New Mexico</option> 
          <option value='{"state":"NY", "id":"34"}'>New York</option> 
          <option value='{"state":"NC", "id":"35"}'>North Carolina</option> 
          <option value='{"state":"ND", "id":"36"}'>North Dakota</option> 
          <option value='{"state":"OH", "id":"37"}'>Ohio</option> 
          <option value='{"state":"OK", "id":"38"}'>Oklahoma</option> 
          <option value='{"state":"OR", "id":"39"}'>Oregon</option> 
          <option value='{"state":"PA", "id":"40"}'>Pennsylvania</option> 
          <option value='{"state":"PR", "id":"41"}'>Puerto Rico</option> 
          <option value='{"state":"RI", "id":"42"}'>Rhode Island</option> 
          <option value='{"state":"SC", "id":"43"}'>South Carolina</option> 
          <option value='{"state":"SD", "id":"44"}'>South Dakota</option> 
          <option value='{"state":"TN", "id":"45"}'>Tennessee</option> 
          <option value='{"state":"TX", "id":"46"}'>Texas</option> 
          <option value='{"state":"UT", "id":"47"}'>Utah</option> 
          <option value='{"state":"VT", "id":"48"}'>Vermont</option> 
          <option value='{"state":"VI", "id":"49"}'>Virgin Islands</option> 
          <option value='{"state":"VA", "id":"50"}'>Virginia</option> 
          <option value='{"state":"WA", "id":"51"}'>Washington</option> 
          <option value='{"state":"WV", "id":"52"}'>West Virginia</option> 
          <option value='{"state":"WI", "id":"53"}'>Wisconsin</option> 
          <option value='{"state":"WY", "id":"54"}'>Wyoming</option> 
          <option value='{"state":"AB", "id":"55"}'>Alberta</option> 
          <option value='{"state":"BC", "id":"56"}'>British Columbia</option> 
          <option value='{"state":"MB", "id":"57"}'>Manitoba</option> 
          <option value='{"state":"NB", "id":"58"}'>New Brunswick</option> 
          <option value='{"state":"NF", "id":"59"}'>Newfoundland</option> 
          <option value='{"state":"NT", "id":"60"}'>Northwest Territories</option> 
          <option value='{"state":"NS", "id":"61"}'>Nova Scotia</option> 
          <option value='{"state":"ON", "id":"62"}'>Ontario</option> 
          <option value='{"state":"PE", "id":"63"}'>Prince Edward Island</option> 
          <option value='{"state":"QC", "id":"64"}'>Quebec</option> 
          <option value='{"state":"SK", "id":"65"}'>Saskatchewan</option> 
          <option value='{"state":"YT", "id":"66"}'>Yukon Territory</option>
        </select></td> 
      </tr> 
      <tr> 
        <td align="right"><label>ZIP/Postal Code:</label></td> 
        <td><?php echo $form['shipZip']; ?>
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Country:</label></td> 
        <td><select name="client[shipCountry]" onmousewheel="return false;" onchange="javascript:handleVATZeroRatingVisibility();"> 
          <option value="">Click to Select</option> 
          <option value=""></option> 
          <option value="CA">Canada</option> 
          <option value="US">United States</option> 
        </select></td> 
      </tr> 
    </tbody></table> 
	
<table class="table">
	<tr>
	<td>
	
    <h3>Special Instructions</h3> 
	<textarea name="purchase[instructions]" cols="30" rows="5" id="instructions"></textarea> 
	
	<h3>Additional Information</h3> 
	Date of Event:
	<input type="text" name="purchase[eventDate]"><br> 
	Date Order Required By:
	<input name="purchase[requireDate]" type="text" id="requireDate">
	<br> 
	How did you hear of Us:<br> 
	<select name="purchase[referer]"> 
		<option value="Friend">Friend</option> 
		<option value="Surfing">Surfing</option> 
		<option value="Google Ad">Google Ad</option> 
		<option value="Complete Wedding Directory">Complete Wedding Directory</option> 
		<option value="Aislewalk">Aislewalk</option> 
		<option value="WeddingBells">Wedding Bells</option> 
		<option value="FrugalBride">Frugal Bride</option> 
		<option value="BrockHouseRestaurant">Brock House Restaurant</option> 
		<option value="White Dove Dreams, Red Dragon Desires">White Dove Dreams, Red Dragon Desires</option> 
		<option value="asianweddings.ca">asianweddings.ca</option> 
		<option value="indianweddings.ca">indianweddings.ca</option> 
		<option value="Canadian Bride">Canadian Bride</option> 
		<option value="Other">Other</option> 
	</select> 
	</td>
	</tr>
	</table>
	<h3>Shipping Method</h3> 
	
        <table class="table"> 
      <tbody>
	  <tr> 
        <td align="right" width="150"><label>Shipping Type:</label></td> 
		<td align="left"> 
	<select name="purchase[deliveryMethod]" id="deliveryMethod"> 
	<option value="">select shipping</option>
	<option value="0">Pick Up (GVRD only)</option>
        <option value="1">Canada Ground</option>
        <option value="2">U.S.A.</option>
        <option value="4">Express Canada</option>
      </select>       
	  </td>
	  </tr>
	  </tbody>
	  </table> 
	  
	  <img src="/images/usps.jpg" width="100px" id="id06370483851060271"> 
	  <div> 
	  	<div> 
	  	<img src="/images/usps.jpg" width="100px" id="id06370483851060271"> 
	  	</div><br> 
	  	Expedited Ground to USA - approx. 7-10 business days<br> 
	  	Express Air to USA - approx. 3-5 business days
	  </div> 
            <div> 
                <div> 
                <img src="/images/canadapost.jpg" width="100px" id="id9282579540740699"> 
            </div><br> 
                Expedited Ground to Canada - approx. 4-7 business days<br> 
                Express Air to Canada - approx. 1-3 business days
            </div> 
			
          <div style="clear:both"></div>
<input name="paymentType" id="payment" type="hidden" value="creditcard"> 
	<h3>Payment Information</h3> 			
	 <script type="text/javascript" language="JavaScript"><!-- expandcontent('creditCard'); --></script> 
    <table class="table"> 
      <tbody><tr> 
        <td align="right" width="150">Name on Credit Card: </td> 
        <td><input type="text" name="nameOnCard" maxlength="50" value=""></td> 
      </tr> 
      <tr> 
        <td align="right"><label>Credit Card Type:</label></td> 
        <td><select name="cardType" onmousewheel="return false;"> 
          <option value="Visa">Visa</option> 
          <option value="Mastercard">Mastercard</option> 
          <option value="Amex">American Express</option> 
        </select></td> 
      </tr> 
      <tr> 
        <td align="right"><label>Credit Card Number:</label></td> 
        <td><input type="text" name="number" value="" autocomplete="off" maxlength="19"></td> 
      </tr> 
      <tr> 
        <td align="right"><label>Expiration Date:</label> 
          <nobr></nobr></td> 
        <td><div align="left"> 
          <select name="expiryMonth" onmousewheel="return false;" class="month"> 
            <option value="1">01</option> 
            <option value="2">02</option> 
            <option value="3">03</option> 
            <option value="4">04</option> 
            <option value="5">05</option> 
            <option value="6">06</option> 
            <option value="7">07</option> 
            <option value="8">08</option> 
            <option value="9">09</option> 
            <option value="10">10</option> 
            <option value="11">11</option> 
            <option value="12">12</option> 
          </select> 
          <select name="expiryYear" onmousewheel="return false;" class="year">    
<option value="2014">2014</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option>  
	</select> 
        </div></td> 
      </tr> 
      <tr>
        <td align="right">Verification Code: </td>
        <td><input type="text" name="verification" value="" size="6" autocomplete="off" maxlength="4"></td> 
      
      </tr>
    </tbody></table> 
	
	<div style="padding:10px 0px 10px 150px"> 
	
	<input type="submit" name="Submit" value="Cancel">
            <input type="reset" name="Submit2" value="Reset">
            <input name="Submit" type="submit" id="Submit" value="Submit">
  </div> 
		<input type="hidden" class="hide" name="action" value="update_member_info"> 
	
			
	  
	
</form> 
</form>