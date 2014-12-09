<div style="display: none" id="dialog" title="Select Language">
    <ul>
    <?php
        
        foreach($SystemLocalesList as $key => $systemlocale) {
            //echo '<li class="select-locale" data-id="' . $key . '"><img src="/images/flags/' . $systemlocale['icon'] . '.gif" /> ' . $systemlocale['languageName'] . '</li>';
        }
        ?>
    </ul>
    <form method="post" action="/locale/change" id="locale-change">
        <input type="hidden" name="locale" id="locale" />
    </form>
  </div>
<!--

<div id="locales">
    <?php //$locale = $this->getDefaultLocale();?>
   <img id="locale-icon" src="/images/flags/<?php //echo $locale['icon'];?>.gif">
   <a class="select-locale" data-id="en_US">EN</a> 
   <a class="select-locale" data-id="zh_CN">&#20013;&#25991;</a>
</div>
-->
<div id="header">
      <div id="logo">Phoenix Restorations</div>
    <div id="account">
        <a href="/portal/contacts/settings"><span class="glyphicon glyphicon-cog" title="Account Settings"></span></a> 
          <span class="glyphicon glyphicon-envelope" title="view all messages"></span>
          <span class="glyphicon glyphicon-comment" title="view all notifications"></span>
          <span class="glyphicon glyphicon-bell" title="view all alerts"></span>
          <span class="glyphicon glyphicon-flash" title="view all incident reports"></span>
    </div>
<ul id="nav">
            <li><a href="/admin/home">Home</a></li>
        
            <li><a href="/admin/staff/0/20">Claims</a></li>
        
            <li><a href="/admin/claims/0/20">Events</a></li>
        
            <li><a href="/admin/contents/0/20">Messaging</a></li>
        
            <li><a href="/admin/inventory">FAQ</a></li>
        
            <li>Invoices</li>
        
    </ul>
    <!---section2--->
  </div>

