module.service('sideNavSrv', function () {
    self = this;
    
    //Set the default value of the sidenav position based on the localstorage value
    if(localStorage.getItem('sideNavOpen') === 'false') {
        this.sideNavOpen = false;
    } else {
        this.sideNavOpen = true;
    }
});