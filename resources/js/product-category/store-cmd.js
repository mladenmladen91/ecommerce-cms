window.Flex.Component.ProductCategory.Store.Command = {
   /* add: function(data){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/addProductCategory', JSON.stringify(data), 'POST')
            .then(function(json){
                    return resolve({data: json});
            }).catch(function(r){ return reject(r); });
        });
    }, */
	add: function(form){
		let formData = new FormData(form);
		return new Promise(function(resolve, reject){
			fetch('/api/products/addProductCategory',{
			method: 'POST',
			credentials: 'include',
			headers: {
				"Authorization": "Bearer "+window.Flex.User.accessToken 
			},
			body: formData
		}).then((r)=>{
				resolve(r);
			}).catch((r)=>{
				reject(r);
			});
		});
	},
   /* update: function(data){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/editProductCategory', JSON.stringify(data), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    }, */
	update: function(form){
		let formData = new FormData(form);
		return new Promise(function(resolve, reject){
			fetch('/api/products/editProductCategory',{
			method: 'POST',
			credentials: 'include',
			headers: {
				"Authorization": "Bearer "+window.Flex.User.accessToken 
			},
			body: formData
		}).then((r)=>{
				resolve(r);
			}).catch((r)=>{
				reject(r);
			});
		});
	},
    remove: function(id){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/deleteProductCategory', JSON.stringify({id: id}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
	 getAllChildrenCategories: function(id){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/getAllChildrenCategories', JSON.stringify({
				id: id
			}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
	sortCategories: function(categories){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/sortCategories', JSON.stringify({categories: categories}), 'POST')
				.then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
};
