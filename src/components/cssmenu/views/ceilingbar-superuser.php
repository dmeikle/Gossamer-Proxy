

<!--- javascript start --->

@components/cssmenu/includes/js/script.js

<!--- javascript end --->


<!--- css start --->

@components/cssmenu/includes/css/styles.css

<!--- css end --->
<div id="ceilingbar">
    <div id='cssmenu'>
        <ul>
           <li class='active'><a href='/admin/home'><span><?php echo $this->getString('NAV_HOME');?></span></a></li>
           <li class='has-sub'><a href='/admin/contacts/0/20'><span><?php echo $this->getString('ADMIN_CONTACTUS');?></span></a>
              <ul>
                 <li><a href='/admin/contacts/0'><span>Add New Contact</span></a></li>
              </ul>
           </li>
           <li><a href='#'><span><?php echo $this->getString('ADMIN_STAFF');?></span></a></li>
           <li class='has-sub'><a href='#'><span><?php echo $this->getString('NAV_PORTAL_COMMUNICATION');?></span></a>
              <ul>
                <li><a href='#'><span><?php echo $this->getString('NAV_PORTAL_MESSAGES');?></span></a></li>
                <li><a href='#'><span><?php echo $this->getString('NAV_PORTAL_ALERTS');?></span></a></li>
                <li><a href='#'><span><?php echo $this->getString('NAV_PORTAL_ACTIONS');?></span></a></li>
                <li class='last'><a href='#'><span><?php echo $this->getString('NAV_PORTAL_EMAILS');?></span></a></li>
              </ul>
           </li>
          
           
           <li style="float: right" class='has-sub'><a href='#'><span><?php echo $this->getString('NAV_PORTAL_WELCOME');?> <?php echo $firstname;?></span></a>
           <ul class="avatar">               
                <li><a title="<?php echo $this->getString('PORTAL_TITLE_UPDATE_INFO');?>" href='/portal/contacts/edit'><span><?php echo $firstname;?> <?php echo $lastname;?></span></a></li>
                <li><a href='/portal/contacts/settings'><span><?php echo $this->getString('PORTAL_CONTACT_SETTINGS');?></span></a></li>
                <li class='last'><a href='/portal/contacts/credentials'><span><?php echo $this->getString('PORTAL_CHANGE_PASSWORD');?></span></a></li>
                <li class='last'><a href='#'><span><?php echo $this->getString('PORTAL_LOGOUT');?></span></a></li>
              </ul>
           </li>
        </ul>
    </div>
</div>