<tr>
  <td>
    <input type='text' name='name' ng-model='newWidget.name' placeholder='Widget Name'>
  </td>
  <td>
    <input type='text' name='component' ng-model='newWidget.component' placeholder='Widget Component'>
  </td>
  <td>
    <input type='text' name='description' ng-model='newWidget.description' placeholder='Widget Description'>
  </td>
  <td>
    <input type='text' name='module' ng-model='newWidget.module' placeholder='Widget Module'>
  </td>
  <td>
    <input type='text' name='key' ng-model='newWidget.key' placeholder='Widget HTML Key'>
  </td>
  <td>
    <button type='button' name='Confirm' ng-click='addNewWidget(newWidget)'><?php echo $this->getString('WIDGET_CONFIRM'); ?></button>
  </td>
</tr>
