module.controller('sideNavCtrl', function ($scope, tabsSrv, sideNavSrv, $window, $document, $log) {

    $scope.prevClickedItem = '';
    $scope.prevSubItems = '';
    $scope.sideNavOpen = sideNavSrv.sideNavOpen;
    var atTop = true;
    var sideNav = document.getElementById('side-nav');
    var headerHeight = 50;

    $scope.expanded = {};

    $scope.toggleSubnav = function (event) {
        var navItem = jQuery(event.target);
        var subItems = jQuery(event.target.nextElementSibling);

        if ($scope.prevClickedItem.length !== 0) {
            $scope.prevClickedItem.toggleClass('active');
        }

        if ($scope.prevSubItems.length === 0) {
            subItems.slideDown(200);
            $scope.prevClickedItem = navItem;
            $scope.prevSubItems = subItems;
            navItem.toggleClass('active');
        } else {
            if ($scope.prevClickedItem[0] !== navItem[0]) {
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

    $scope.toggleSidenav = function () {
        if (sideNavSrv.sideNavOpen === true) {
            sideNavSrv.sideNavOpen = false;
            localStorage.setItem('sideNavOpen', false);
        } else {
            sideNavSrv.sideNavOpen = true;
            localStorage.setItem('sideNavOpen', true);
        }
    };

    $scope.$watch(function () {
        return sideNavSrv.sideNavOpen;
    }, function (newVal) {
        $scope.sideNavOpen = newVal;
    }, true);

    $document.bind('scroll', function () {
        if ($window.scrollY > headerHeight && atTop === true) {
            //sideNav.style.paddingTop = "0px";
            sideNav.classList.add("scrolled");
            atTop = false;
        } else {
            if ($window.scrollY < headerHeight && atTop === false) {
                //sideNav.style.paddingTop = "50px";
                sideNav.classList.remove("scrolled");
                atTop = true;
            }
        }
    });
});