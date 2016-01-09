module.service('notesSrv', function ($http, $log) {   
    var self = this;
    
    self.notes = [];
    
    this.addNote = function(note){
        self.notes.push(note);
    };

    this.getNotes = function(notes){
        for(var i in notes){
            notes[i].edit = false;
        }
        $log.log(notes);
        return notes;
    };
    
    //Save comment    
    this.save = function(apiPath, note, parentItemName, parentItemId, itemName, formToken){
        var saveNote = angular.copy(note);
        delete saveNote.edit;
        saveNote[parentItemName] = parentItemId;
        var data = {};
        data[itemName] = saveNote;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + saveNote.id,
            data: data
        }).then(function (response) {
            //console.log(response);
            return response.data[itemName][0];
        });
    };
    
    this.remove = function(apiPath, id, formToken){
        var data = {};
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + 'remove/' + id,
            data: data
        }).then(function (response) {
            
        });
    };
});