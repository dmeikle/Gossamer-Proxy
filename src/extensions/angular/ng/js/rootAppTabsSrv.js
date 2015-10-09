module.service('tabsSrv', function() {
    this.tabs = [];
    
    //Adding a tab
    this.addTab = function(tabObj){
        tabObj.active = true;
        //Checks to see if the tab is already opened...
        for(var i in this.tabs){
            this.tabs[i].active = false;
            if(this.tabs[i].title === tabObj.title){
                this.tabs[i].active = true;
                return;
            }
        }
        //set the loading key to show the spinner
        tabObj.loading = true;
        this.tabs.push(tabObj);
    };    
    
    //Closing a tab
    this.closeTab = function(index){
        this.tabs.splice(index, 1);
    };
});