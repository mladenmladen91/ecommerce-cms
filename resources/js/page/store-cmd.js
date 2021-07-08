window.Flex.Component.Page.Store.Command = {
    /*add: function(data){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/pages/addPage', JSON.stringify({
				pages: JSON.stringify([data])
			}), 'POST')
            .then(function(json){
                    return resolve({data: json});
            }).catch(function(r){ return reject(r); });
        });
    }, */
    add: function(form){
		let formData = new FormData(form);
		return new Promise(function(resolve, reject){
			fetch('/api/pages/addPage',{
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
            window.Flex.Util.Query('/api/pages/updatePage', JSON.stringify({
				pages: JSON.stringify([data])
			}), 'POST')
            .then(function(json){
                    return resolve({data: json});
            }).catch(function(r){ return reject(r); });
        });
    }, */
    update: function(form){
		let formData = new FormData(form);
		return new Promise(function(resolve, reject){
			fetch('/api/pages/updatePage',{
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
	 getPage: function(data){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/pages/getPage', JSON.stringify(data), 'POST')
            .then(function(json){
                    return resolve({data: json});
            }).catch(function(r){ return reject(r); });
        });
    },
    remove: function(id){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/pages/deletePage', JSON.stringify({page_id: id}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
	addImage: function(form){
		let formData = new FormData(form);
		return new Promise(function(resolve, reject){
			fetch('/api/pages/addImages',{
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
            window.Flex.Util.Query('/api/pages/deleteImage', JSON.stringify({image_id: id, image: image}), 'POST')
                .then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
	sortImages: function(images){
        return new Promise(function(resolve, reject){
            window.Flex.Util.Query('/api/pages/sortImages', JSON.stringify({images: images}), 'POST')
				.then(function(json){
                    return resolve({data: json});
                }).catch(function(r){ return reject(r); });
        });
    },
}