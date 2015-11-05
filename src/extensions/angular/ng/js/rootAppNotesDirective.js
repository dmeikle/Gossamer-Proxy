module.directive('notes', function (rootTemplateSrv, notesSrv) {
    return {
        restrict: 'E',
        scope: {
            apiPath: '@',
            parentItemId: '@',
            parentItemName: '@'
        },
        transclude: false,
        templateUrl: rootTemplateSrv.notesTemplate,
        controller: function ($scope) {
            $scope.notes = notesSrv.notes;
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            console.log($scope.parentItemId);
            
            //Edit Note
            $scope.editNote = function(note){
                note.edit = true;
            };

            //Delete Note
            $scope.deleteNote = function(index){
                $scope.notes.splice(index, 1);
                notesSrv.notes = $scope.notes;
            };

            //Save New Note
            $scope.saveNewNote = function(newNote){
                var note = {};
                note.notes = newNote;
                note.edit = false;
                note.id = 0;
                notesSrv.notes.push(note);
                $scope.notes = notesSrv.notes;
                notesSrv.save($scope.apiPath, note, $scope.parentItemName, $scope.parentItemId, formToken);
                $scope.newNote = '';
            };
            
            //Save Note
            $scope.saveNote = function(note, index){
                note.edit = false;
                notesSrv.notes = $scope.notes;
                notesSrv.save($scope.apiPath, note, $scope.parentItemName, $scope.parentItemId, formToken);
            };         
            
        }
    };
});