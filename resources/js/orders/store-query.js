window.Flex.Component.Order.Store.Query = {
    list: function(offset){
        
        return new Promise(function(resolve){
            window.Flex.Util.Query(
                '/api/orders/getAllOrders',
                JSON.stringify({offset: offset}),
                "POST"
            ).then(function(r){
                resolve(r);
            });
        });
    },
	
	getOrder: function(id){
        return new Promise(function(resolve){
            window.Flex.Util.Query(
                '/api/orders/getOrder',
                JSON.stringify({id: id}),
                "POST"
            ).then(function(r){
                resolve(r);
            });
        });
    }
};
