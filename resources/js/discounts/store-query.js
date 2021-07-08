window.Flex.Component.Discounts.Store.Query = {
    list: function(){
        return new Promise(function(resolve){
            window.Flex.Util.Query(
                '/api/discounts/getAllDiscounts',
                JSON.stringify({}),
                "POST"
            ).then(function(r){
                resolve(r);
            });
        });
    },
};
