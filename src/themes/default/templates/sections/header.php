<div style="display: none" id="dialog" title="Select Language">
    <ul>
    <?php
        
        foreach($SystemLocalesList as $key => $systemlocale) {
           // echo '<li class="select-locale" data-id="' . $key . '"><img src="/images/flags/' . $systemlocale['icon'] . '.gif" /> ' . $systemlocale['languageName'] . '</li>';
            
             echo '<li class="select-locale" data-id="' . $key . '">' . $systemlocale['languageName'] . '</li>';
        }
        ?>
    </ul>
    <form method="post" action="/locale/change" id="locale-change">
        <input type="hidden" name="locale" id="locale" />
    </form>
  </div>


<div id="locales">
    <?php //$locale = $this->getDefaultLocale();?>
   <img id="locale-icon" src="/images/flags/<?php //echo $locale['icon'];?>.gif">
   <a class="select-locale" data-id="en_US">EN</a> 
   <a class="select-locale" data-id="zh_CN">&#20013;&#25991;</a>
   <a class="select-locale" data-id="hi_IN">Hindi</a>
</div>

<div id="header">
  


<ul id="nav">
            <li><a href="/restoration/services"><?php echo $this->getString('WEBSITE_SERVICES');?></a></li>
        
            <li><a href="/portal/entrance"><?php echo $this->getString('WEBSITE_LOGIN');?></a></li>
        
            <li><a href="/blogs/0/20"><?php echo $this->getString('WEBSITE_BOGS_LIST');?></a></li>
        
            <li><a href="/contact/contactus"><?php echo $this->getString('WEBSITE_CONTACT');?></a></li>
        
            <li><a href="/restoration/frequently-asked-restoration-questions"><?php echo $this->getString('WEBSITE_FAQS');?></a></li>
        
            <li><a href="/restoration/about-phoenix-restorations"><?php echo $this->getString('WEBSITE_ABOUT');?></a></li>
        
    </ul>
    <!---section2--->
  </div>

