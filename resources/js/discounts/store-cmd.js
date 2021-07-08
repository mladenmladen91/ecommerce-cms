window.Flex.Component.Discounts.Store.Command = {
    add: function(data){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/discounts/addDiscount', JSON.stringify(data), 'POST')
            .then(function(json){
                    return resolve({data: json});
            }).catch(function(r){ return reject(r); });
        });
    },
    update: function(data){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/discounts/editDiscount', JSON.stringify(data), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
    remove: function(id){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/discounts/deleteDiscount', JSON.stringify({id: id}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
};
