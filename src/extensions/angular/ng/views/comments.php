<div class="comments">    
    <h3><?php echo $this->getString('ACCOUNTING_PURCHASE_ORDER_NOTES'); ?></h3>
    <div class="comment" ng-repeat="comment in comments track by $index" ng-switch="comment.edit">
        <p ng-switch-when="false">{{comment.text}}</p>
        <div ng-switch-when="false" class="dropdown pull-right">
            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                <li><a ng-click="editComment(comment)"><?php echo $this->getString('ACCOUNTING_EDIT'); ?></a></li>
                <li><a ng-click="deleteComment($index)"><?php echo $this->getString('ACCOUNTING_DELETE'); ?></a></li>
            </ul>
        </div>
        <textarea ng-switch-when="true" ng-model="comment.text" class="form-control edit-comment comment-input"></textarea>
        <button ng-switch-when="true"  class="btn-info save-comment" ng-click="saveComment(comment, $index)"><?php echo $this->getString('ACCOUNTING_SAVE'); ?></button>
    </div>

    <textarea name="newComment" class="form-control ng-valid ng-dirty ng-touched new-comment comment-input" ng-model="newComment" id="NewComment"></textarea>
    <button class="btn-info" ng-click="saveNewComment(newComment)"><?php echo $this->getString('ACCOUNTING_SAVE_PURCHASE_ORDER_NOTE'); ?></button>
</div>