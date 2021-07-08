window.Flex.Component.Menu.Store.Query = {
    list: function(filters, orderBy, limit, page){
        if(typeof limit === 'undefined') { limit = 100; }
        if(typeof page === 'undefined') { page = 0; }
        if(typeof filters === 'undefined') { filters = {}; }
        if(typeof orderBy === 'undefined') { orderBy = {}; }

        return new Promise(function(resolve){
            window.Flex.Util.Query(
                '/api/menus/getAllMenus',
                JSON.stringify({limit: limit, page: page, filters: filters, orderBy: orderBy}),
                "POST"
            ).then(function(r){
                resolve(r);
            });
        });
    },
};
