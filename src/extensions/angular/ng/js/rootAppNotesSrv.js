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
    
    this.getList = function(){
        
    };
    
    //Save comment    
    this.save = function(apiPath, note, parentItemName, parentItemId, formToken){
        var saveNote = angular.copy(note);
        delete saveNote.edit;
        saveNote[parentItemName] = parentItemId;
        var data = {};
        data.notes = saveNote;
        //data.id = id;
        data.FORM_SECURITY_TOKEN = formToken;
//        console.log(apiPath);
//        console.log(data);

        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + saveNote.id,
            data: data
        }).then(function (response) {
            //console.log(response);
        });
    };
});