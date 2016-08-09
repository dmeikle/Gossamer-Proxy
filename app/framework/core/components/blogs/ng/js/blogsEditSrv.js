module.service('blogsEditSrv', function ($http) {
    var apiPath = '/admin/blogs/';

    var self = this;

    this.getBlogList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.blogsList = response.data.Blogs;
                    self.blogsCount = response.data.BlogsCount[0].rowCount;
                });
    };

    this.getBlogDetail = function (object) {
        return $http.get(apiPath + object.id)
                .then(function (response) {
                    if (response.data.Blog) {
                        if (response.data.Blog.dob) {
                            response.data.Blog.dob = new Date(response.data.Blog.dob);
                        }
                        if (response.data.Blog.hireDate) {
                            response.data.Blog.hireDate = new Date(response.data.Blog.hireDate);
                        }
                        if (response.data.Blog.departureDate) {
                            response.data.Blog.departureDate = new Date(response.data.Blog.departureDate);
                        }
                        self.blogsDetail = response.data.Blog;
                    }
                });
    };

    this.getBlogCreds = function (object) {
        return $http.get(apiPath + 'credentials/' + object.id)
                .then(function (response) {
                    self.blogsCreds = response.data.BlogAuthorization;
                });
    };

    this.save = function (object, formToken) {
        var copiedObject = jQuery.extend(true, {}, object);
        for (var property in copiedObject) {
            if (copiedObject.hasOwnProperty(property)) {
                if (copiedObject[property] === null) {
                    delete copiedObject[property];
                }
            }
        }
        if (copiedObject.dob) {
            copiedObject.dob = object.dob.toISOString().substring(0, 10);
        }
        if (copiedObject.hireDate) {
            copiedObject.hireDate = object.hireDate.toISOString().substring(0, 10);
        }
        if (copiedObject.departureDate) {
            copiedObject.departureDate = object.departureDate.toISOString().substring(0, 10);
        }

        var requestPath;
        if (!copiedObject.id) {
            requestPath = apiPath + '0';
        } else {
            requestPath = apiPath + copiedObject.id;
        }
        var data = {};
        data.Blog = copiedObject;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            url: requestPath,
            data: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function (response) {
            self.blogsDetail = response.data.Blog[0];
        });
    };

    this.checkUsernameExists = function (object) {
        return $http({
            url: apiPath + 'checkusername/' + object.id + '/' + object.username,
            method: 'GET'
        })
                .then(function (response) {
                    self.usernameExists = response.data.exists;
                });
    };

    this.saveCredentials = function (object, formToken) {
        var data = {};
        data.BlogAuthorization = object;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + 'credentials/' + object.id,
            data: data
        }).then(function (response) {
            self.credentialStatus = response.data;
        });
    };


});
