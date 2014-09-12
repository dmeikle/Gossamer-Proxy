<div style="display: none" id="dialog" title="Select Language">
    <ul>
    <?php
        
        foreach($SystemLocalesList as $key => $locale) {
            echo '<li class="select-locale" data-id="' . $key . '"><img src="/images/flags/' . $locale['icon'] . '.gif" /> ' . $locale['languageName'] . '</li>';
        }
        ?>
    </ul>
    <form method="post" action="/locale/change" id="locale-change">
        <input type="hidden" name="locale" id="locale" />
    </form>
  </div>


<div id="locales"> <i class="fa fa-shopping-cart"></i>  | 
    <?php //$locale = $this->getDefaultLocale();?>
   <!-- <img id="locale-icon" src="/images/flags/<?php echo $locale['icon'];?>.gif">-->
   <a class="select-locale" data-id="en_US">EN</a> 
   <a class="select-locale" data-id="zh_CN">&#20013;&#25991;</a>
</div>
<div id="logo"><a title="home decor" class="invisible" href="/">glen meikle</a></div>
<nav>
        <ul>
        <li><a href="/" title="asian home decor"><?php echo $this->getString('NAV_HOME');?></a></li>
        <li class="has-sub"><a href="/about"><?php echo $this->getString('NAV_ARTIST_PROFILE');?></a>
            <ul>
                <li><a href="/glen-meikle" title="glen meikle"><?php echo $this->getString('NAV_GLEN_MEIKLE');?></a></li>
                <li><a href="/wall-tablets" title="wall art tablets"><?php echo $this->getString('NAV_WALL_TABLETS');?></a></li>
            </ul>
        </li>
        <li><a href="/cart/Wall Tablets/"><?php echo $this->getString('NAV_CART');?></a></li> 
        <li><a href="/design"><?php echo $this->getString('NAV_DESIGN');?></a>
            <ul>
                <li><a href="/design"><?php echo $this->getString('NAV_LAYOUT_1');?></a>
                <li><a href="/design2"><?php echo $this->getString('NAV_LAYOUT_2');?></a>
            </ul>
        </li>
        <li><a href="/inspiration" title="chinese wall art"><?php echo $this->getString('NAV_INSPIRATION');?></a></li>
        <li><a href="/contact"><?php echo $this->getString('NAV_CONTACT');?></a></li>
    </ul>
  
 
</nav>

<div id="pagetitle"><?php echo $pageTitle;?></div>

