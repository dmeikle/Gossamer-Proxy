module.controller('sideNavCtrl', function($scope, tabsSrv, sideNavSrv) {
    $scope.prevClickedItem = '';
    $scope.prevSubItems = '';
    $scope.sideNavOpen = sideNavSrv.sideNavOpen; 
    
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
    };
    
    $scope.toggleSidenav = function(){
        console.log('toggling nav...');
        console.log(sideNavSrv.sideNavOpen);
        
        if(sideNavSrv.sideNavOpen === true){
            console.log('it be troo');
            sideNavSrv.sideNavOpen = false;
        } else {
            console.log('it be false.');
            sideNavSrv.sideNavOpen = true;
        }
        console.log(sideNavSrv.sideNavOpen);
    };
    
    $scope.$watch(function() { return sideNavSrv.sideNavOpen; }, function(newVal) { 
        $scope.sideNavOpen = newVal;
    }, true);
});