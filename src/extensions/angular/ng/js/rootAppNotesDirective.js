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
            };
            
            //Save Note
            $scope.saveNote = function(note, index){
                note.edit = false;
                notesSrv.notes = $scope.notes;
                notesSrv.save(note, $scope.parentItemId, );
            };         
            
        }
    };
});