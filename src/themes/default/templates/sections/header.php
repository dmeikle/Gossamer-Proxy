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
 

<div id="locales"><i class="fa fa-shopping-cart"></i>  | 
    <?php $locale = $this->getDefaultLocale();?>
    <img id="locale-icon" src="/images/flags/<?php echo $locale['icon'];?>.gif">
</div>
<div id="logo"><a title="home decor" class="invisible" href="/">glen meikle</a></div>
<nav>
        <ul>
        <li><a href="/" title="asian home decor">home</a></li>
        <li class="has-sub"><a href="/about">artist profile</a>
            <ul>
                <li><a href="/glen-meikle" title="glen meikle">Glen Meikle</a></li>
                <li><a href="/wall-tablets" title="wall art tablets">Wall Tablets</a></li>
            </ul>
        </li>
        <li><a href="/cart/Wall Tablets/">collection</a></li> 
        <li><a href="/design">design</a>
            <ul>
                <li><a href="/design">layout 1</a>
                <li><a href="/design2">layout 2</a>
            </ul>
        </li>
                                <li><a href="/inspiration" title="chinese wall art">inspiration</a></li>
        <li><a href="/contact">contact</a></li>
    </ul>
</nav>

<div id="pagetitle"><?php echo $pageTitle;?></div>

