

<!--- javascript start --->

@components/cssmenu/includes/js/script.js

<!--- javascript end --->


<!--- css start --->

@components/cssmenu/includes/css/styles.css

<!--- css end --->
<div id="ceilingbar">
    <div id='cssmenu'>
        <ul>
           <li class='active'><a href='#'><span><?php echo $this->getString('NAV_HOME');?></span></a></li>
           <li class='has-sub'><a href='#'><span>Products</span></a>
              <ul>
                 <li><a href='#'><span>Product 1</span></a></li>
                 <li><a href='#'><span>Product 2</span></a></li>
                 <li class='last'><a href='#'><span>Product 3</span></a></li>
              </ul>
           </li>
           <li class='has-sub'><a href='#'><span>About</span></a>
              <ul>
                 <li><a href='#'><span>Company</span></a></li>
                 <li class='last'><a href='#'><span>Contact</span></a></li>
              </ul>
           </li>
           <li class='last'><a href='#'><span>Contact</span></a></li>
        </ul>
    </div>
</div>