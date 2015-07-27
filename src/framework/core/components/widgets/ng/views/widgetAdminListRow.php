
  <td ng-switch="widget">
    <div ng-switch-when="editing">
      <input type='text' name='name' ng-model='widget.name' placeholder='Widget Name'>
    </div>
    <div ng-switch-default>
      {{ widget.name }}
    </div>
  </td>
  <td ng-switch="widget">
    <div ng-switch-when="editing">
      <input type='text' name='component' ng-model='widget.component' placeholder='Widget Name'>
    </div>
    <div ng-switch-default>
      {{ widget.component }}
    </div>
  </td><td ng-switch="widget">
    <div ng-switch-when="editing">
      <input type='text' name='description' ng-model='widget.description' placeholder='Widget Name'>
    </div>
    <div ng-switch-default>
      {{ widget.description }}
    </div>
  </td><td ng-switch="widget">
    <div ng-switch-when="editing">
      <input type='text' name='module' ng-model='widget.module' placeholder='Widget Name'>
    </div>
    <div ng-switch-default>
      {{ widget.module }}
    </div>
  </td><td ng-switch="widget">
    <div ng-switch-when="editing">
      <input type='text' name='htmlKey' ng-model='widget.htmlKey' placeholder='Widget Name'>
    </div>
    <div ng-switch-default>
      {{ widget.htmlKey }}
    </div>
  </td>
  <!-- <td>
    <input type='text' name='component' ng-model='widget.component' placeholder='Widget Component'>
  </td>
  <td>
    <input type='text' name='description' ng-model='widget.description' placeholder='Widget Description'>
  </td>
  <td>
    <input type='text' name='module' ng-model='widget.module' placeholder='Widget Module'>
  </td>
  <td>
    <input type='text' name='key' ng-model='widget.htmlKey' placeholder='Widget HTML Key'>
  </td> -->
  <td>
    <button type='button' name='Confirm' ng-click='editWidget(widget)'><?php echo $this->getString('WIDGET_CONFIRM'); ?></button>
  </td>
</tr>
