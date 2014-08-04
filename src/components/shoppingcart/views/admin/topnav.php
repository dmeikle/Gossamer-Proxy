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

<div id="locales">
    <?php $locale = $this->getDefaultLocale();?>
    <img id="locale-icon" src="/images/flags/<?php echo $locale['icon'];?>.gif">
</div>
 
<nav>
    <ul>
        <li><a class="blog-nav-item active" href="/admin"><?php echo $this->getString('NAV_HOME');?></a></li>
        <li><a class="blog-nav-item" href="/admin/cart/categories"><?php echo $this->getString('NAV_CATEGORIES');?></a></li>
        <li><a class="blog-nav-item" href="/admin/cart/products/0/20"><?php echo $this->getString('NAV_PRODUCTS');?></a></li>
        <li><a class="blog-nav-item" href="/admin/cart/sales/0/20"><?php echo $this->getString('NAV_SALES');?></a></li>
        <li><a class="blog-nav-item" href="/admin/cart/variants"><?php echo $this->getString('NAV_VARIANTS');?></a></li>
    </ul>
</nav>