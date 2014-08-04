<form method="post" action="/cart/confirm" id="confirmBuyerForm">
 <a href="/cart/Wall Tablets">&lt;&lt; Make Changes</a> 
      <button id="confirmBuyerInfo">I Confirm This Is Accurate &gt;&gt;</button>
<?php

foreach($client as $field => $value) {
    echo "<input type=\"hidden\" name=\"client[$field]\" value=\"$value\" />\r\n";
}

?>
</form>