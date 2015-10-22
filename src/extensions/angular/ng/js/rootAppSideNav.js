module.controller('sideNavCtrl', function($scope, tabsSrv) {
    $scope.prevClickedItem = '';
    $scope.prevSubItems = '';
    $scope.sideNavOpen = true;
    $scope.test = 'this is a test';
    $scope.navItems = [{
        title:'Accounting',
        subItems:[{
            title:'Timesheets'
        },{
            title:'General Cost Items'
        }]    
    },{
        title:'Staff',
        subItems:[{
            title:'List'
        },{
            title:'Permissions'
        }]
    }];

    $scope.expanded = {};
    
    $scope.toggleSubnav = function(event){ 
        console.log('side nav toggle!');
        var navItem = jQuery(event.target);
        var subItems = jQuery(event.target.nextElementSibling);
        
        if($scope.prevClickedItem.length !== 0){
            $scope.prevClickedItem.toggleClass('active');
        }
        console.log($scope.prevSubItems.length);
        console.log($scope.prevClickedItem[0] !== navItem[0]);
        
        if($scope.prevSubItems.length === 0){
            subItems.slideDown(200);
            $scope.prevClickedItem = navItem;
            $scope.prevSubItems = subItems;
            navItem.toggleClass('active');
        } else {
            if($scope.prevClickedItem[0] !== navItem[0]){                
                jQuery($scope.prevSubItems).slideUp(200);
                subItems.slideDown(200);
                $scope.prevClickedItem = navItem;
                $scope.prevSubItems = subItems;
                navItem.toggleClass('active');
            } else {
                subItems.slideUp(200);
                $scope.prevSubItems = '';
                $scope.prevClickedItem = '';
                navItem.removeClass('active');
            }
            
                
        }
        
        
        
//        if($scope.prevSubItems.length !== 0 && $scope.prevClickedItem[0] !== navItem[0]){
//            jQuery($scope.prevSubItems).slideUp(150);
//            subItems.slideDown(150);
//            console.log('slide up');
//            $scope.prevSubItems = subItems;
//        } else {
//            subItems.slideUp(150);
//            console.log('slide down');
//            $scope.prevSubItems = '';
//        }
        
        //navItem.toggleClass('active');
        //subItems.slideToggle(150);
//        $scope.prevClickedItem = navItem;
//        $scope.prevSubItems = subItems;
    };
    
    $scope.toggleSidenav = function(){
        if($scope.sideNavOpen === true){
            $scope.sideNavOpen = false;
        } else {
            $scope.sideNavOpen = true;
        }        
    };
});