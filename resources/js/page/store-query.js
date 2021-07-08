window.Flex.Component.Page.Store.Query = {
    list: function(language, limit, category){
        /*if(typeof limit === 'undefined') { limit = 100; }
        if(typeof page === 'undefined') { page = 0; }
        if(typeof filters === 'undefined') { filters = {}; }
        if(typeof orderBy === 'undefined') { orderBy = {}; }*/

        return new Promise(function(resolve){
            window.Flex.Util.Query(
                '/api/pages/list',
                JSON.stringify({language_id: language, limit: limit, category_id: category}),
                "POST"
            ).then(function(r){
                resolve(r);
            });
        });
    },
	imageList: function(id){
        /*if(typeof limit === 'undefined') { limit = 100; }
        if(typeof page === 'undefined') { page = 0; }
        if(typeof filters === 'undefined') { filters = {}; }
        if(typeof orderBy === 'undefined') { orderBy = {}; }*/

        return new Promise(function(resolve){
            window.Flex.Util.Query(
                '/api/pages/listImages',
                JSON.stringify({page_id: id}),
                "POST"
            ).then(function(r){
                resolve(r);
            });
        });
    }
};
