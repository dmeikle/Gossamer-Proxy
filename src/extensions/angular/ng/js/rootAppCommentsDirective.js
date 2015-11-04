module.directive('comments', function (rootTemplateSrv, commentsSrv) {
    return {
        restrict: 'E',
        scope: {
            apiPath: '@'
        },
        transclude: true,
        templateUrl: rootTemplateSrv.commentsTemplate,
        controller: function ($scope) {
            $scope.comments = commentsSrv.comments;
            
            //Edit Comment
            $scope.editComment = function(comment){
                comment.edit = true;
            };

            //Delete Comment
            $scope.deleteComment = function(index){
                $scope.comments.splice(index, 1);
                commentsSrv.comments = $scope.comments;
            };

            //Save New Comment
            $scope.saveNewComment = function(newComment){
                var comment = {};
                comment.text = newComment;
                comment.edit = false;
                commentsSrv.comments.push(comment);
                $scope.comments = commentsSrv.comments;
            };
            
            //Save Comment
            $scope.saveComment = function(comment, index){
                comment.edit = false;
                commentsSrv.comments = $scope.comments;
            };         
            
        }
    };
});