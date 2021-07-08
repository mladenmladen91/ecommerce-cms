window.Flex.Component.Product.Store.Query = {
	listCategory: function(){
	     return new Promise(function(resolve){
            window.Flex.Util.Query(
                '/api/products/getAllProductCategory',
                JSON.stringify({}),
                "POST"
            ).then(function(r){
                resolve(r);
            });
        }); 	
	},
    list: function(category, page, limit){
        if(typeof limit === 'undefined') { limit = 2; }
        if(typeof page === 'undefined') { page = 0; }
   
        let offset = page * limit;
        return new Promise(function(resolve){
            window.Flex.Util.Query(
                '/api/products/getAllProducts',
                JSON.stringify({category_id: category, limit: limit, offset: offset}),
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
                '/api/products/listImages',
                JSON.stringify({product_id: id}),
                "POST"
            ).then(function(r){
                resolve(r);
            });
        });
    },
	getProduct: function(id){
        return new Promise(function(resolve){
            window.Flex.Util.Query(
                '/api/products/getProduct',
                JSON.stringify({id: id}),
                "POST"
            ).then(function(r){
                resolve(r);
            });
        });
    }
};
