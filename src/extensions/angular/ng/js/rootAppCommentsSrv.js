module.service('commentsSrv', function ($http) {   
    
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