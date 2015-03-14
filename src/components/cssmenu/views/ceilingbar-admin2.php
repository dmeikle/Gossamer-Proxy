

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
                 <li><a href='/admin/contacts/0'><span>Create New Contact</span></a></li>
              </ul>
           </li>
           
           <li class='has-sub'><a href='#'><span><?php echo $this->getString('ADMIN_STAFF');?></span></a>
                <ul>
                    <li><a href='/admin/staff/0'><span>Create New Staff</span></a></li>
                 </ul>             
           </li>
          
           <li class='has-sub'><a href='/admin/scoping/requests/0/20'><span><?php echo $this->getString('ADMIN_SCOPING');?></span></a>
                <ul>
                    <li><a href='/admin/scoping/requests/0/20'><span>List All Requests</span></a></li>
                    <li><a href='/admin/scoping/takeoffs/0/20'><span>List All Takeoffs</span></a></li>
                 </ul>             
           </li>
           <li class='has-sub'><a href='/admin/claims/0/20'><span><?php echo $this->getString('ADMIN_CLAIMS');?></span></a>
                <ul>
                    <li><a href='/admin/claim/1/0'><span>Create New Claim</span></a></li>
                    <li><a href='/admin/claims/scheduling/0/20'><span>Scheduling</span></a></li>
                 </ul>             
           </li>
           <li class='has-sub'><a href='/admin/samples/0/20'><span><?php echo $this->getString('ADMIN_SAMPLES');?></span></a>
                <ul>
                    <li><a href='/admin/samples/0'><span>Create New Sample</span></a></li>
                 </ul>             
           </li>
           <li class='has-sub'><a href='/admin/contacts/0/20'><span><?php echo $this->getString('ADMIN_CONTACTS');?></span></a>
                <ul>
                    <li><a href='/admin/contacts/0'><span>Create New Contact</span></a></li>
                    <li><a href='/admin/companies/0/20'><span>List All Companies</span></a></li>
                    <li><a href='/admin/companies/0'><span>Create New Company</span></a></li>
                 </ul>             
           </li>
           <li class='has-sub'><a href='/admin/notifications/0/20'><span><?php echo $this->getString('ADMIN_NOTIFICATIONS');?></span></a>
                <ul>
                    <li><a href='/admin/contacts/0'><span>Create New Contact</span></a></li>
                    <li><a href='/admin/companies/0/20'><span>List All Companies</span></a></li>
                    <li><a href='/admin/companies/0'><span>Create New Company</span></a></li>
                 </ul>             
           </li>
           <li class='has-sub'><a href='/admin/messaging/0/20'><span><?php echo $this->getString('ADMIN_MESSAGES');?></span></a>
                <ul>
                    <li><a href='/admin/messaging/0'><span>Create New Message</span></a></li>
                    <li><a href='/admin/messaging/0/20'><span>List All Messages</span></a></li>
                 </ul>             
           </li>
           <li class='has-sub'><a href='/admin/cms/pages/0/20'><span><?php echo $this->getString('ADMIN_WEBSITE');?></span></a>
                <ul>
                    <li><a href='/admin/cms/pages/0/20'><span>List All Web Pages</span></a></li>
                    <li><a href='/admin/cms/pages/0'><span>Create New Page</span></a></li>
                    <li><a href='/admin/cms/sections/0'><span>List All Sections</span></a></li>
                    <li><a href='/admin/blogs/0'><span>List All Blogs</span></a></li>
                    <li><a href='/admin/blogs/0/20'><span>Create New Blog</span></a></li>
                 </ul>             
           </li>
           <li class='has-sub'><a href='/admin/messaging/0/20'><span><?php echo $this->getString('ADMIN_BUILDING_ADDRESSES');?></span></a>
                <ul>
                    <li><a href='/admin/projects/0/20'><span>List All Addresses</span></a></li>
                    <li><a href='/admin/projects/0'><span>Create New Address</span></a></li>
                 </ul>             
           </li>
           <li class='has-sub'><a href='/admin/incidents/0/20'><span><?php echo $this->getString('ADMIN_INCIDENTS');?></span></a>
                <ul>
                    <li><a href='/admin/incidents/0/20'><span>List All incidents</span></a></li>
                 </ul>             
           </li>
           <li class='has-sub'><a href='/admin/incidents/0/20'><span><?php echo $this->getString('ADMIN_INCIDENTS');?></span></a>
                <ul>
                    <li><a href='/admin/incidents/0/20'><span>List All incidents</span></a></li>
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