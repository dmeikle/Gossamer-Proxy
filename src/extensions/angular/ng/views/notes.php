<div class="notes">
    <!--<h3><?php // echo $this->getString('NOTES'); ?></h3>-->
    <div class="notes-area">
        <div class="note" ng-repeat="note in notes track by $index" ng-switch="note.edit">
            <div ng-switch-when="false">
                <span ng-if="loading[$index]" class="spinner-loader edit-note-spinner"></span>

                <div class="dropdown pull-right">
                    <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                        <li><a ng-click="deleteNote($index)"><?php echo $this->getString('ACCOUNTING_DELETE'); ?></a></li>
                    </ul>
                </div>

                <p class="author-info" ng-if="!loading[$index]"><strong>{{note.firstname}} {{note.lastname}}</strong> - {{note.lastModified}}</p>
                <div class="clearfix"></div>
                <p ng-if="!loading[$index]">{{note.notes}}</p>
                <div class="clearfix"></div>
            </div>
            <div ng-switch-when="true">
                <textarea  ng-model="note.notes" class="form-control edit-note note-input"></textarea>
                <button class="btn-info save-note" ng-click="saveNote(note, $index)"><?php echo $this->getString('ACCOUNTING_SAVE'); ?></button>
            </div>
        </div>
    </div>
    <div class="input-area">
        <textarea name="newNote" class="form-control ng-valid ng-dirty ng-touched new-note note-input" ng-model="newNote" id="newNote"></textarea>
        <button class="btn-info float-right" ng-click="saveNewNote(newNote)"><?php echo $this->getString('ACCOUNTING_SAVE_PURCHASE_ORDER_NOTE'); ?></button>
        <span ng-if="savingNote" class="spinner-loader new-note-spinner"></span>
    </div>
</div>