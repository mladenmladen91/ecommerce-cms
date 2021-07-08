window.Flex.Component.Menu.Store.Command = {
    add: function(data){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/menus/addMenu', JSON.stringify(data), 'POST')
            .then(function(json){
                    return resolve({data: json});
            }).catch(function(r){ return reject(r); });
        });
    },
    update: function(id, name, position){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/menus/editMenu', JSON.stringify({
                id: id,
                name: name,
                position: position
            }), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
    remove: function(id){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/menus/deleteMenu', JSON.stringify({id: id}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
};
