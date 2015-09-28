
<!--- javascript start --->

@components/claims/includes/js/admin-claims-list-ng.js

<!--- javascript end --->

<div class="col-md-12">
    <div class="block block-size-normal">
        <div class="block-heading">
            <div class="main-text h2">
                Comments
            </div>
            <div class="block-controls">
                <span aria-hidden="true" class="icon icon-cross icon-size-medium block-control-remove"></span>
                <span aria-hidden="true" class="icon icon-arrow-down icon-size-medium block-control-collapse"></span>
            </div>
        </div>
        <div class="block-content-outer">
            <div class="block-content-inner mCustomScrollbar _mCS_1 mCS-autoHide" style="position: relative; overflow: visible;">
                <div id="mCSB_1" class="mCustomScrollBox mCS-dark mCSB_vertical mCSB_outside" tabindex="0">
                    <div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr" ng-controller="ClaimCommentsController">
                        <div class="comment-block clearfix" ng-repeat="comment in comments">
                            <div class="comment-image">
                                <a href="#">
                                    <img class="list-thumbnail" src="assets/images/required/profile/profile-pic-6.jpg" width="40" height="40" alt="profile-pic-6">
                                </a>
                            </div>
                            <div class="comment-title h4">
                                <a href="#">
                                    {{comment.author}}
                                </a>
                                <small>{{comment.lastModified}} </small>
                            </div>
                            <div class="comment-content">
                                <div style="padding: 10px 10px 10px 20px">{{comment.comments}}</div>
                            </div>                         
                            
                        </div>  
                        
                        <form class="comment-input-block" ng-show="showme">
                                <div class="comment-image">
                                    <a href="#">
                                        <img class="list-thumbnail" src="assets/images/required/profile/profile-pic-4.jpg" width="40" height="40" alt="profile-pic-4">
                                    </a>
                                </div>
                                <div class="comment-input-area">
                                    <div class="form-group" style="padding: 10px 20px">
                                        <textarea id="comments" ng-model="comment.comments" rows="3" class="form-control input-sm user-comment" placeholder="What's on your mind?"></textarea>
                                    </div>
                                    <button class="btn btn-primary btn-xs post-comment" type="submit" ng-click="saveComment(comment)">Post Message</button><br>
                                </div>
                            <a name="location_comment"></a>
                                
                            </form> 
                            <a class="btn btn-default btn-sm" ng-click="showme=true" href="#location_comment">Comment
                                <span class="glyphicon glyphicon-comment"></span>
                            </a>
                            <a class="btn btn-default btn-sm" ng-click="showme=false" ng-show="showme">Cancel</a>   
                            
                       
                    </div>
                </div>
                <div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-dark mCSB_scrollTools_vertical" style="display: block;">
                    <div class="mCSB_draggerContainer">
                        <div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 60px; max-height: 300px;" oncontextmenu="return false;">
                            <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>                                
                        </div>
                        <div class="mCSB_draggerRail"></div>                            
                    </div>                        
                </div>                    
            </div>
        </div>
    </div>
</div>