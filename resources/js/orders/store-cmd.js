window.Flex.Component.Order.Store.Command = {
    remove: function(id){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/orders/deleteOrder', JSON.stringify({id: id}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
		
};
