window.Flex.Component.PageCategory.Store.Query = {
    list: function(){
      

        return new Promise(function(resolve){
            window.Flex.Util.Query(
                '/api/pages/allCategories',
                JSON.stringify({}),
                "POST"
            ).then(function(r){
                resolve(r);
            });
        });
    },
};
