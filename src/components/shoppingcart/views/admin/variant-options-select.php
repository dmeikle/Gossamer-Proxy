<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>


<style>
  #feedback { font-size: 1.4em; }
  
  .selectable .ui-selected {background: #1e5799; /* Old browsers */
background: -moz-linear-gradient(top,  #1e5799 0%, #7db9e8 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1e5799), color-stop(100%,#7db9e8)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #1e5799 0%,#7db9e8 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #1e5799 0%,#7db9e8 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #1e5799 0%,#7db9e8 100%); /* IE10+ */
background: linear-gradient(to bottom,  #1e5799 0%,#7db9e8 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */

color: white; }
  .selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  .selectable li { padding:5px; margin: 3px;  font-size: 1.4em; }
  
  
  .selectable label input{visibility: hidden;}
  .selectable label{display:block; border-radius:5px; border: 1px solid #ccc; cursor: pointer;}
  
   .selectable label.ui-selected{background: -moz-linear-gradient(left,  rgba(163,163,163,0.65) 0%, rgba(0,0,0,0) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(163,163,163,0.65)), color-stop(100%,rgba(0,0,0,0))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(left,  rgba(163,163,163,0.65) 0%,rgba(0,0,0,0) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(left,  rgba(163,163,163,0.65) 0%,rgba(0,0,0,0) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(left,  rgba(163,163,163,0.65) 0%,rgba(0,0,0,0) 100%); /* IE10+ */
background: linear-gradient(to right,  rgba(163,163,163,0.65) 0%,rgba(0,0,0,0) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a3a3a3', endColorstr='#00000000',GradientType=1 ); /* IE6-9 */



color: white;}

  
  
  </style>
  <script>
  $(function() {
      
      $('.selectable').on('mouseup','label',function(){
          var el = $(this);
          console.info(el);
          if(el.hasClass('ui-selected')){
              el.removeClass('ui-selected');
          }else{
              el.addClass('ui-selected');
          }
          
      })
      
      
       $( "#accordion" ).accordion();
 
  });
  </script>
<form method="post">
    <input name="Submit" type="submit" id="Submit" value="Submit">
<div id="accordion">
  
      <?php

foreach($variants as $variant) {
?> 

<h3><?php echo $variant['name'];?></h3>  
<div>
    <p class="selectable">

   <?php
    foreach($variant['child'] as $option) {
        $isSelected = array_search($option['id'], $productVariantItems) !== FALSE;
        ?>
       <label <?php echo ($isSelected)?' class="ui-selected"':'';?>>
           <input type="checkbox" <?php echo ($isSelected)?' checked':'';?> name="variant[<?php echo $variant['id'];?>][CartVariantItems_id][]" value="<?php echo $option['id'];?>"><?php echo $option['variant'];?>
       </label>
      
    <?php 
    }
    ?>
</p>
</div>
<?php
}
?>
    
</div>

    <input name="Submit" type="submit" id="Submit" value="Submit">
</form>