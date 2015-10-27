module.service('blogsPhotoSrv', function (photoSrv) {
    var apiPath = '/admin/blogs/';
    var self = this;
    this.getBlogPhoto = function (blogsId) {
        return photoSrv.getPhoto(apiPath + blogsId).then(function (response) {
            self.photo = response.data.Blog.imageName;
        });
    };
});
