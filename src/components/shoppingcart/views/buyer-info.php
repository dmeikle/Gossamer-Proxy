<!--- css start --->
@components/shoppingcart/includes/css/checkout-buyer.css
<!--- css end --->

<div id="checkout"> 
<h1>Billing/Shipping Information</h1> 
 
<form  class="form-horizontal" role="form" method="post" action="<gcms:uri='cart_checkout_2'/>"> 

	<div class="form-group"> 
	<h3>Billing Information</h3>
 
 
	<table border="0" cellpadding="3" width="325"> 
      <tbody><tr> 
        <td align="right" width="125"><label>First Name:</label></td> 
        <td><input type="text" name="client[firstname]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Last Name:</label></td> 
        <td><input type="text" name="client[lastname]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Email:</label></td> 
        <td><input type="text" name="client[email]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Company:</label></td> 
        <td><input type="text" name="client[company]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Phone:</label></td> 
        <td><input type="text" name="client[telephone]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right" valign="top"><label>Street Address:</label></td> 
        <td><input type="text" name="client[address1]" value=""> 
<br> 
	    <input type="text" name="client[address2]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>City:</label></td> 
        <td><input type="text" name="client[city]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>State/Province:</label></td> 
        <td><select name="client[state]" onmousewheel="return false;"> 
          <option value="">Select State</option> 
          <option value="AL">Alabama</option> 
          <option value="AK">Alaska</option> 
          <option value="AS">American Samoa</option> 
          <option value="AZ">Arizona</option> 
          <option value="AR">Arkansas</option> 
          <option value="CA">California</option> 
          <option value="CO">Colorado</option> 
          <option value="CT">Connecticut</option> 
          <option value="DE">Delaware</option> 
          <option value="DC">District of Columbia</option> 
          <option value="FL">Florida</option> 
          <option value="GA">Georgia</option> 
          <option value="HI">Hawaii</option> 
          <option value="ID">Idaho</option> 
          <option value="IL">Illinois</option> 
          <option value="IN">Indiana</option> 
          <option value="IA">Iowa</option> 
          <option value="KS">Kansas</option> 
          <option value="KY">Kentucky</option> 
          <option value="LA">Louisiana</option> 
          <option value="ME">Maine</option> 
          <option value="MD">Maryland</option> 
          <option value="MA">Massachusetts</option> 
          <option value="MI">Michigan</option> 
          <option value="MN">Minnesota</option> 
          <option value="MS">Mississippi</option> 
          <option value="MO">Missouri</option> 
          <option value="MT">Montana</option> 
          <option value="NE">Nebraska</option> 
          <option value="NV">Nevada</option> 
          <option value="NH">New Hampshire</option> 
          <option value="NJ">New Jersey</option> 
          <option value="NM">New Mexico</option> 
          <option value="NY">New York</option> 
          <option value="NC">North Carolina</option> 
          <option value="ND">North Dakota</option> 
          <option value="OH">Ohio</option> 
          <option value="OK">Oklahoma</option> 
          <option value="OR">Oregon</option> 
          <option value="PA">Pennsylvania</option> 
          <option value="PR">Puerto Rico</option> 
          <option value="RI">Rhode Island</option> 
          <option value="SC">South Carolina</option> 
          <option value="SD">South Dakota</option> 
          <option value="TN">Tennessee</option> 
          <option value="TX">Texas</option> 
          <option value="UT">Utah</option> 
          <option value="VT">Vermont</option> 
          <option value="VI">Virgin Islands</option> 
          <option value="VA">Virginia</option> 
          <option value="WA">Washington</option> 
          <option value="WV">West Virginia</option> 
          <option value="WI">Wisconsin</option> 
          <option value="WY">Wyoming</option> 
          <option value="AB">Alberta</option> 
          <option value="BC">British Columbia</option> 
          <option value="MB">Manitoba</option> 
          <option value="NB">New Brunswick</option> 
          <option value="NF">Newfoundland</option> 
          <option value="NT">Northwest Territories</option> 
          <option value="NS">Nova Scotia</option> 
          <option value="ON">Ontario</option> 
          <option value="PE">Prince Edward Island</option> 
          <option value="QC">Quebec</option> 
          <option value="SK">Saskatchewan</option> 
          <option value="YT">Yukon Territory</option> 
        </select></td> 
      </tr> 
      <tr> 
        <td align="right"><label>ZIP/Postal Code:</label></td> 
        <td><input type="text" name="client[zip]" value=""> 
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
  </div> 

  <div id="shippinginfo"> 
	<h3>Shipping Information</h3>(if different)
<input type="hidden" name="client[shipto]" value="different"> 
  <div class="infobox"> 
 
	<table border="0" cellpadding="3" width="325"> 
      <tbody><tr> 
        <td align="right" width="125"><label>First Name:</label></td> 
        <td><input type="text" name="client[shipFirstname]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Last Name:</label></td> 
        <td><input type="text" name="client[shipLastname]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Email:</label></td> 
        <td><input type="text" name="client[shipEmail]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Company:</label></td> 
        <td><input type="text" name="client[shipCompany]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>Phone:</label></td> 
        <td><input type="text" name="client[shipTelephone]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right" valign="top"><label>Street Address:</label></td> 
        <td><input type="text" name="client[shipAddress1]" value=""> 
<br> 
	    <input type="text" name="client[shipAddress2]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>City:</label></td> 
        <td><input type="text" name="client[shipCity]" value=""> 
</td> 
      </tr> 
      <tr> 
        <td align="right"><label>State/Province:</label></td> 
        <td><select name="client[shipState]" onmousewheel="return false;"> 
          <option value="">Select State</option> 
          <option value="AL">Alabama</option> 
          <option value="AK">Alaska</option> 
          <option value="AZ">Arizona</option> 
          <option value="AR">Arkansas</option> 
          <option value="CA">California</option> 
          <option value="CO">Colorado</option> 
          <option value="CT">Connecticut</option> 
          <option value="DE">Delaware</option> 
          <option value="DC">District of Columbia</option> 
          <option value="FL">Florida</option> 
          <option value="GA">Georgia</option> 
          <option value="HI">Hawaii</option> 
          <option value="ID">Idaho</option> 
          <option value="IL">Illinois</option> 
          <option value="IN">Indiana</option> 
          <option value="IA">Iowa</option> 
          <option value="KS">Kansas</option> 
          <option value="KY">Kentucky</option> 
          <option value="LA">Louisiana</option> 
          <option value="ME">Maine</option> 
          <option value="MD">Maryland</option> 
          <option value="MA">Massachusetts</option> 
          <option value="MI">Michigan</option> 
          <option value="MN">Minnesota</option> 
          <option value="MS">Mississippi</option> 
          <option value="MO">Missouri</option> 
          <option value="MT">Montana</option> 
          <option value="NE">Nebraska</option> 
          <option value="NV">Nevada</option> 
          <option value="NH">New Hampshire</option> 
          <option value="NJ">New Jersey</option> 
          <option value="NM">New Mexico</option> 
          <option value="NY">New York</option> 
          <option value="NC">North Carolina</option> 
          <option value="ND">North Dakota</option> 
          <option value="OH">Ohio</option> 
          <option value="OK">Oklahoma</option> 
          <option value="OR">Oregon</option> 
          <option value="PA">Pennsylvania</option> 
          <option value="PR">Puerto Rico</option> 
          <option value="RI">Rhode Island</option> 
          <option value="SC">South Carolina</option> 
          <option value="SD">South Dakota</option> 
          <option value="TN">Tennessee</option> 
          <option value="TX">Texas</option> 
          <option value="UT">Utah</option> 
          <option value="VT">Vermont</option> 
          <option value="VI">Virgin Islands</option> 
          <option value="VA">Virginia</option> 
          <option value="WA">Washington</option> 
          <option value="WV">West Virginia</option> 
          <option value="WI">Wisconsin</option> 
          <option value="WY">Wyoming</option> 
          <option value="AB">Alberta</option> 
          <option value="BC">British Columbia</option> 
          <option value="MB">Manitoba</option> 
          <option value="NB">New Brunswick</option> 
          <option value="NF">Newfoundland</option> 
          <option value="NT">Northwest Territories</option> 
          <option value="NS">Nova Scotia</option> 
          <option value="ON">Ontario</option> 
          <option value="PE">Prince Edward Island</option> 
          <option value="QC">Quebec</option> 
          <option value="SK">Saskatchewan</option> 
          <option value="YT">Yukon Territory</option> 
        </select></td> 
      </tr> 
      <tr> 
        <td align="right"><label>ZIP/Postal Code:</label></td> 
        <td><input type="text" name="client[shipZip]" value=""> 
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
  </div> 
  </div> 
  <div style=" width:800px; clear:both"> 
  	<div style=" float:left; width:300px;"> 
    <h2 style="clear:both;">Special Instructions</h2> 
	<textarea name="shipping[instructions]" cols="30" rows="5" id="instructions"></textarea> 
	</div> 
	<div style=" float:left;"> 
	<h2 style="clear:both;">Additional Information</h2> 
	Date of Event:
	<input type="text" name="eventDate"><br> 
	Date Order Required By:
	<input name="requireDate" type="text" id="requireDate">
	<br> 
	How did you hear of Us:<br> 
	<select name="refer"> 
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
	</div><br><br><br> 
	</div> 
	<h2 style="clear:both;">Shipping Method</h2> 
	<div class="infoBox"> 
	<table border="0" cellpadding="3" width="350"> 
      <tbody><tr> 
        <td align="right" width="150"><label>Shipping Type:</label></td> 
		<td align="left"> 
	<select name="deliveryMethod" id="deliveryMethod"> 
	<option value="">select shipping</option>
	<option value="0">Pick Up (GVRD only)</option>
        <option value="1">Canada Ground</option>
        <option value="2">U.S.A.</option>
        <option value="4">Express Canada</option>
      </select>

       
	  </td></tr></tbody></table> 
	  <div style="width:475px; height:100px; padding-left:10px; border:1px #000000 solid; border-bottom:0px;"> 
	  	<div style="width:100px; float:left; margin-right:10px;"> 
	  	<img src="/images/usps.jpg" width="100px" id="id06370483851060271"> 
	  	</div><br> 
	  	Expedited Ground to USA - approx. 7-10 business days<br> 
	  	Express Air to USA - approx. 3-5 business days
	  </div> 
	  <div style="width:475px; height:70px; padding-left:10px; border:1px #000000 solid; border-top:0px; clear:both;"> 
	  <div style="width:100px; padding-top:30px; margin-right:10px; float:left;"> 
	  <img src="/images/canadapost.jpg" width="100px" id="id9282579540740699"> 
	  </div><br> 
	  Expedited Ground to Canada - approx. 4-7 business days<br> 
	  Express Air to Canada - approx. 1-3 business days
	  </div> 
 
  </div> 
  <!--
  <h2 style="clear:both;">Payment Type</h2>
	 <div style="width:475px; padding-left:10px; border:1px #000000 solid;margin-bottom:10px" id="paymentType">
              
            <input name="paymentType" id="payment" type="radio" value="creditcard" checked="checked" />
            Credit Card	 &nbsp;&nbsp;&nbsp; <br />
            <input name="paymentType" id="payment" type="radio" value="paypal" />
            Paypal&nbsp;&nbsp;&nbsp; <span class="style2">*requires manually sending funds from your account </span><br />
          <input name="paymentType" id="payment" type="radio" value="cod" /> 
          C.O.D. <span class="style2">*Canadian residents only. Please include telephone number </span><br />
            <input name="paymentType" id="payment" type="radio" value="westernunion" />
          Western Union <span class="style4">** see below </span><br />
          <input name="paymentType" id="payment" type="radio" value="cheque" /> 
          Cheque <span class="style4">** see below</span> <br />
          <input name="paymentType" id="payment" type="radio" value="money order" /> 
          Money Order <span class="style4">** see below</span><br />
		  <span class="style4">** Prepayment required before shipping. Upon receipt of payment, order will be processed. No products are shipped without prior payment by purchaser. </span>
       
    </div>
	--> 
	<input name="paymentType" id="payment" type="hidden" value="creditcard"> 
	<h2 style="clear:both;">Payment Information</h2> 
	
  <div class="infoBox"> 
      <script type="text/javascript" language="JavaScript"><!-- expandcontent('creditCard'); --></script> 
    <table border="0" cellpadding="3" width="350"> 
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
  </div> 
  <div style="padding:10px 0px 10px 150px"> 
	
	<input type="submit" name="Submit" value="Cancel">
            <input type="reset" name="Submit2" value="Reset">
            <input name="Submit" type="submit" id="Submit" value="Submit">
  </div> 
		<input type="hidden" class="hide" name="action" value="update_member_info"> 
</form> 
</div>