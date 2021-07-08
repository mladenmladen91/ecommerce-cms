window.Flex.Component.Product.Store.Command = {
   /* add: function(data){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/addProduct', JSON.stringify(data), 'POST')
            .then(function(json){
                    return resolve({data: json});
            }).catch(function(r){ return reject(r); });
        });
    }, */
	add: function(form){
		let formData = new FormData(form);
		return new Promise(function(resolve, reject){
			fetch('/api/products/addProduct',{
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
    /*update: function(data){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/updateProduct', JSON.stringify(data), 'POST')
            .then(function(json){
                    return resolve({data: json});
            }).catch(function(r){ return reject(r); });
        });
    },*/
	update: function(form){
		let formData = new FormData(form);
		return new Promise(function(resolve, reject){
			fetch('/api/products/updateProduct',{
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
    updateSpec: function(form){
		return new Promise(function(resolve, reject){
			fetch('/api/products/updateSpecification',{
			method: 'POST',
			credentials: 'include',
			headers: {
				"Authorization": "Bearer "+window.Flex.User.accessToken 
			},
			body: form
		}).then((r)=>{
				resolve(r);
			}).catch((r)=>{
				reject(r);
			});
		});
	},
    remove: function(id){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/deleteProduct', JSON.stringify({product_id: id}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
    removeSpec: function(id){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/deleteSpecification', JSON.stringify({id: id}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
	searchProducts: function(id){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/getSearchProducts', JSON.stringify({product_code: id}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
	getProductsForSorting: function(id){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/getAllProductsForSorting', JSON.stringify({category_id: id}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
	sortProducts: function(products){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/sortProducts', JSON.stringify({products: products}), 'POST')
				.then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
	sortNewProducts: function(products){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/sortNewProducts', JSON.stringify({products: products}), 'POST')
				.then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
	toggleSpecialOffer: function(data){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/toggleSpecialOffer', JSON.stringify(data), 'POST')
            .then(function(json){
                    return resolve({data: json});
            }).catch(function(r){ return reject(r); });
        });
    },
	addImage: function(form){
		let formData = new FormData(form);
		return new Promise(function(resolve, reject){
			fetch('/api/products/addImages',{
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
	removeImage: function(id, image){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/deleteImage', JSON.stringify({image_id: id, image: image}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
	sortImages: function(images){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/products/sortImages', JSON.stringify({images: images}), 'POST')
				.then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
	
};
