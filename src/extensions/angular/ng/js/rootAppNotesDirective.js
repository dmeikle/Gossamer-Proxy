module.directive('notes', function (rootTemplateSrv, notesSrv) {
    return {
        restrict: 'E',
        scope: {
            apiPath: '@',
            parentItemId: '@',
            parentItemName: '@',
            itemName: '@'
        },
        transclude: false,
        templateUrl: rootTemplateSrv.notesTemplate,
        controller: function ($scope) {
            $scope.notes = notesSrv.notes;
            $scope.loading = {};
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            
            //Edit Note
            $scope.editNote = function(note){
                note.edit = true;
            };

            //Delete Note
            $scope.deleteNote = function(index){
                $scope.loading[index] = true;
                notesSrv.remove($scope.apiPath, $scope.notes[index].id).then(function(){
                    $scope.notes.splice(index, 1);
                    notesSrv.notes = $scope.notes;
                    $scope.loading[index] = false;
                });
            };

            //Save New Note
            $scope.saveNewNote = function(newNote){
                var note = {};
                note.notes = newNote;
                note.id = 0;
                $scope.loading.newNote = true;
                notesSrv.save($scope.apiPath, note, $scope.parentItemName, $scope.parentItemId, $scope.itemName, formToken).then(function(note){
                    note.edit = false;
                    notesSrv.notes.push(note);
                    $scope.notes = notesSrv.notes;
                    $scope.loading = false;
                });
                
                $scope.newNote = '';
            };
            
            //Save Note
            $scope.saveNote = function(note, index){
                note.edit = false;
                //notesSrv.notes = $scope.notes;
                $scope.loading[index] = true;
                notesSrv.save($scope.apiPath, note, $scope.parentItemName, $scope.parentItemId, $scope.itemName, formToken).then(function(note){
                    note.edit = false;
                    notesSrv.notes[index] = note;
                    $scope.notes = notesSrv.notes;                    
                    $scope.loading[index] = false;
                });
            };         
            
        }
    };
});