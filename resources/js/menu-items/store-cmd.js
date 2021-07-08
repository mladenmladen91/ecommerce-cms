window.Flex.Component.MenuItems.Store.Command = {
    add: function(data){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/menus/addMenuItem', JSON.stringify(data), 'POST')
            .then(function(json){
                    return resolve({data: json});
            }).catch(function(r){ return reject(r); });
        });
    },
    update: function(data){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/menus/editMenuItem', JSON.stringify(data), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
    remove: function(id, menuId){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/menus/deleteMenuItem', JSON.stringify({
				id: id,
				menu_id: menuId
			}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
	 getAllChildrenMenus: function(id){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/menus/getAllChildrenMenus', JSON.stringify({
				id: id
			}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
	sortMenus: function(menus){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/menus/sortMenus', JSON.stringify({menus: menus}), 'POST')
				.then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
};
