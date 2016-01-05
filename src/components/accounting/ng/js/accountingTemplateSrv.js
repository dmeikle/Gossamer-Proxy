module.service('accountingTemplateSrv', function (crudSrv) {
//    this.timesheetModal = '/render/accounting/timesheetModal';
//    this.generalCostsModal = '/render/accounting/generalCostsModal';
//    this.suppliesModal = '/render/accounting/suppliesModal';
//    this.inventoryModal = '/render/accounting/inventoryModal';
//    this.cashReceiptsModal = '/render/accounting/cashReceiptsModal';
    var self = this;
    
    //Cash Receipts Modal
    this.cashReceiptsModal = function(){
        //check to see if we have content
        if(self.cashReceiptsModalCache){
            return self.cashReceiptsModalCache;
        } else {
            return getTemplateContent('/render/accounting/cashReceiptsModal').then(function(response){
                self.cashReceiptsModalCache = response.data;
                return response.data;
            });            
        }
    };
    
    //General Costs Modal
    this.generalCostsModal = function(){
        //check to see if we have content
        if(self.generalCostsModalCache){
            return self.generalCostsModalCache;
        } else {
            return getTemplateContent('/render/accounting/generalCostsModal').then(function(response){
                self.generalCostsModalCache = response.data;
                return response.data;
            });            
        }
    };
    
    //Inventory Modal
    this.inventoryModal = function(){
        //check to see if we have content
        if(self.inventoryModalCache){
            return self.inventoryModalCache;
        } else {
            return getTemplateContent('/render/accounting/inventoryModal').then(function(response){
                self.inventoryModalCache = response.data;
                return response.data;
            });            
        }
    };
    
    //Supplies Modal
    this.suppliesModal = function(){
        //check to see if we have content
        if(self.suppliesModalCache){
            return self.suppliesModalCache;
        } else {
            return getTemplateContent('/render/accounting/suppliesModal').then(function(response){
                self.suppliesModalCache = response.data;
                return response.data;
            });            
        }
    };
    
    //Supplies Modal
    this.timesheetModal = function(){
        //check to see if we have content
        if(self.timesheetModalCache){
            return self.timesheetModalCache;
        } else {
            return getTemplateContent('/render/accounting/timesheetModal').then(function(response){
                self.timesheetModalCache = response.data;
                return response.data;
            });            
        }
    };
    
    //Gets the template based on the url
    function getTemplateContent (uri) {
        return crudSrv.getTemplate(uri);
    }

});