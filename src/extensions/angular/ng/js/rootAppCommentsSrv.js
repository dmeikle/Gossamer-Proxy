module.service('commentsSrv', function ($http) {   
    var self = this;
    
    self.comments = [];
    
    this.addComment = function(comment){
        self.comments.push(comment);
    };
    
    this.convertToComments = function(notes){
        self.comments = [];
        for(var i in notes){
            var comment = {
                text: notes[i].notes,
                edit: false
            };
            self.comments.push(comment);
        }
        return self.comments;
    };
    
    this.convertToNotes = function(comments, id){
        self.notes = [];
        for(var i in comments){
            var note = {
                PurchaseOrders_id: id,
                notes: comments[i].text
            };
            self.notes.push(note);
        };
        return self.notes;
    };
    
    //Save comment    
    this.save = function(apiPath, comment, id, formToken){
        var data = {};
        data.comment = comment;
        data.id = id;
        data.FORM_SECURITY_TOKEN = formToken;
        
        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + id,
            data: data
        }).then(function (response) {
            //console.log(response);
        });
    };
});