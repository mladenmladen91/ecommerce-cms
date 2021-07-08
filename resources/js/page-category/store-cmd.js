window.Flex.Component.PageCategory.Store.Command = {
    add: function(data){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/pages/addCategory', JSON.stringify(data), 'POST')
            .then(function(json){
                    return resolve({data: json});
            }).catch(function(r){ return reject(r); });
        });
    },
    update: function(id, name){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/pages/editCategory', JSON.stringify({
                id: id,
                name: name,
            }), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
    remove: function(id){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/pages/deleteCategory', JSON.stringify({id: id}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
};
