<div style="display: none" id="dialog" title="Select Language">
    <ul>
        <?php
        foreach ($SystemLocalesList as $key => $systemlocale) {
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
    <?php //$locale = $this->getDefaultLocale(); ?>
    <img id="locale-icon" src="/images/flags/<?php //echo $locale['icon'];?>.gif">
    <a class="select-locale" data-id="en_US">EN</a> 
    <a class="select-locale" data-id="zh_CN">&#20013;&#25991;</a>
    <a class="select-locale" data-id="hi_IN">Hindi</a>
</div>

<div id="header">

    <div id="account">
        <a href="/portal/contacts/settings"><span class="glyphicon glyphicon-cog" title="Account Settings"></span></a> 
        <span class="glyphicon glyphicon-envelope" title="view all messages"></span>
        <span class="glyphicon glyphicon-comment" title="view all notifications"></span>
        <span class="glyphicon glyphicon-bell" title="view all alerts"></span>
        <span class="glyphicon glyphicon-flash" title="view all incident reports"></span>
    </div>

    <ul id="nav">
        <li><a href="/restoration/services">WEBSITE_SERVICES</a></li>

        <li><a href="/portal/entrance">WEBSITE_LOGIN</a></li>

        <li><a href="/blogs/0/20">WEBSITE_BOGS_LIST</a></li>

        <li><a href="/contact/contactus">WEBSITE_CONTACT</a></li>

        <li><a href="/restoration/frequently-asked-restoration-questions">WEBSITE_FAQS</a></li>

        <li><a href="/restoration/about-phoenix-restorations">WEBSITE_ABOUT</a></li>

    </ul>

    <!--
   <ul id="nav">
    <?php
    foreach ($NAVIGATION as $key => $item) {

        if (array_key_exists('active', $item) && $item['active'] == false) {
            ?>
                       <li title="disabled on this release"><?php echo $this->getString($item['text_key']); ?></li>
            <?php
            continue;
        }
        ?>
               <li><a href="<?php echo $item['pattern']; ?>"><?php echo $this->getString($item['text_key']); ?></a></li>
               
    <?php }
?>
   </ul>-->
    <!---section2--->
</div>

<style>
    #nav li {
        display: inline;
        margin-left: 20px;
    }
    
</style>