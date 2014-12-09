<h3>Credentials</h3>
<form method="post" role="form">
    <table class="table" style="max-width: 700 !important">
        <tr>
           <td>Username:</td>
           <td><?php echo $form['username']; ?></td>
         </tr>

         <tr>
           <td>Password:</td>
           <td><?php echo $form['password']; ?></td>
         </tr>
         <tr>
           <td>Confirm:</td>
           <td><?php echo $form['passwordConfirm']; ?></td>
         </tr>
       </table>
     </td>
   </tr>
   <tr>
     <td></td>
     <td><?php echo $form['submit']; ?></td>
   </tr>
   </table>
</form>