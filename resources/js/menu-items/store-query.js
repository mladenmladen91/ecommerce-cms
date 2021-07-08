window.Flex.Component.MenuItems.Store.Query = {
    list: function(id){
      

        return new Promise(function(resolve){
            window.Flex.Util.Query(
                '/api/menus/getAllMenuItems',
                JSON.stringify({id: id}),
                "POST"
            ).then(function(r){
                resolve(r);
            });
        });
    },
};
