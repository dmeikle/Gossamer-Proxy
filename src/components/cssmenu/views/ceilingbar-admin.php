

<!--- javascript start --->

@components/cssmenu/includes/js/script.js

<!--- javascript end --->


<!--- css start --->

@components/cssmenu/includes/css/styles.css

<!--- css end --->





<div id="ceilingbar">
    
<div style="display: none" id="dialog" title="Select Language">
    <ul>
    <?php
        
        foreach($SystemLocalesList as $key => $systemlocale) {
            
             echo '<li class="select-locale" data-id="' . $key . '">' . $systemlocale['languageName'] . '</li>';
        }
        ?>
    </ul>
    <form method="post" action="/locale/change" id="locale-change">
        <input type="hidden" name="locale" id="locale" />
    </form>
  </div>

   <div id="locales">
         
           <a class="select-locale" data-id="en_US">EN</a> 
           <a class="select-locale" data-id="zh_CN">&#20013;&#25991;</a>
           <a class="select-locale" data-id="hi_IN">Hindi</a>
        </div>


    <div id='cssmenu'>
        
     
        <ul>
            <?php foreach($NAVIGATION as $navItem) {
                if(array_key_exists('children', $navItem)) { ?>
                    <li class='has-sub'><a href='<?php echo $navItem['pattern'];?>'><span><?php echo $this->getString($navItem['text_key']);?></span></a>
                        <ul>
                            <?php foreach($navItem['children'] as $subnavItem) { ?>
                                 <li><a href='<?php echo $subnavItem['pattern'];?>'><span><?php echo $this->getString($subnavItem['text_key']);?></span></a></li>
                            <?php }?>
                        </ul>                    
                    </li>
                    
            <?php } else { ?>
                    <li class='active'><a href='<?php echo $navItem['pattern'];?>'><span><?php echo $this->getString($navItem['text_key']);?></span></a></li>
            <?php
                }
            }
            ?>            
                
        </ul>
    </div>
</div>