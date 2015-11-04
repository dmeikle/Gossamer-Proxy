<div class="notes">    
    <h3><?php echo $this->getString('ACCOUNTING_PURCHASE_ORDER_NOTES'); ?></h3>
    <div class="note" ng-repeat="note in notes track by $index" ng-switch="note.edit">
        <p ng-switch-when="false">{{note.notes}}</p>
        <div ng-switch-when="false" class="dropdown pull-right">
            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                <li><a ng-click="editNote(note)"><?php echo $this->getString('ACCOUNTING_EDIT'); ?></a></li>
                <li><a ng-click="deleteNote($index)"><?php echo $this->getString('ACCOUNTING_DELETE'); ?></a></li>
            </ul>
        </div>
        <textarea ng-switch-when="true" ng-model="note.notes" class="form-control edit-note note-input"></textarea>
        <button ng-switch-when="true"  class="btn-info save-note" ng-click="saveNote(note, $index)"><?php echo $this->getString('ACCOUNTING_SAVE'); ?></button>
    </div>

    <textarea name="newNote" class="form-control ng-valid ng-dirty ng-touched new-note note-input" ng-model="newNote" id="newNote"></textarea>
    <button class="btn-info" ng-click="saveNewNote(newNote)"><?php echo $this->getString('ACCOUNTING_SAVE_PURCHASE_ORDER_NOTE'); ?></button>
</div>