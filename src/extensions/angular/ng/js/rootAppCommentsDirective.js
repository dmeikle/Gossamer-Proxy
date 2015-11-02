module.directive('comments', function (rootTemplateSrv) {
    return {
        restrict: 'E',
        scope: {
            apiPath: '@'
        },
        transclude: true,
//        link: function (scope, element, attrs) {
//           
//        },
        templateUrl: rootTemplateSrv.commentsTemplate,
        controller: function ($scope) {
            $scope.comments = [];
            var lastHeight = '';
            console.log($scope);
            //Edit Comment
            $scope.editComment = function(comment){
                comment.edit = true;
            };

            //Delete Comment
            $scope.deleteComment = function(index){
                $scope.comments.splice(index, 1);
            };

            //Save New Comment
            $scope.saveNewComment = function(newComment){
                var comment = {};
                comment.text = newComment;
                comment.edit = false;
                $scope.comments.push(comment);
            };
            
            //Save Comment
            $scope.saveComment = function(comment, index){
                comment.edit = false;
            };
            
//            $('.comment-input').each(function () {
//                this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
//            }).on('input', function () {
//                this.style.height = 'auto';
//                this.style.height = (this.scrollHeight) + 'px';
//            });                
            
        }
    };
});