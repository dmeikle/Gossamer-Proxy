module.service('notesSrv', function ($http) {   
    var self = this;
    
    self.notes = [];
    
    this.addNote = function(note){
        self.notes.push(note);
    };

    this.getNotes = function(notes){
        for(var i in notes){
            notes[i].edit = false;
        }
        return notes;
    };
    
    //Save comment    
    this.save = function(note, formToken, apiPath){
        var saveNote = angular.copy(note);
//        var data = {};
//        data.notes = notes;
//        data.id = id;
//        data.FORM_SECURITY_TOKEN = formToken;
        delete saveNote.edit;
        console.log(saveNote);
//        return $http({
//            method: 'POST',
//            headers: {
//                'Content-Type': 'application/x-www-form-urlencoded'
//            },
//            url: apiPath + id,
//            data: data
//        }).then(function (response) {
//            //console.log(response);
//        });
    };
});