module.service('sideNavSrv', function () {
    self = this;
//    this.sideNavOpen = false;
//    
    console.log('default state:');
    console.log(localStorage.getItem('sideNavOpen'));
    
    if(localStorage.getItem('sideNavOpen') === 'true') {
        console.log('the side nav is open!');
        this.sideNavOpen = true;
    } else {
        console.log('the side nav is closed!');
        this.sideNavOpen = false;
    }
});