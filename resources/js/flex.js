if (typeof window.Flex === 'undefined'){
    window.Flex = {
        Util: {},
        Component: {},
        User: {
            accessToken: null
        }
    };
}
window.Flex.Util.uuid = () => {
    return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
}
window.Flex.Util.DateTime = {
    formatDate: function(date) {
        if(typeof date === "string") {
            date = new Date(date);
        }
        return date.getDate()+"."+(date.getMonth()+1)+"."+((date.getFullYear()+"").substr(2));
    },
    formatTime: function(date) {
        if(typeof date === "string") {
            date = new Date(date);
        }
        return date.getHours()+":"+date.getMinutes();
    }
};

window.Flex.Util.Query = function(uri, data, method = "GET"){
    while(null === window.Flex.User.accessToken && uri != '/admin/token') {
        return new Promise((resolve,reject) => {
            setTimeout(() => {
                if(null === window.Flex.User.accessToken) {
                    reject("Cant resolve access Token");
                } else {
                    window.Flex.Util.Query(uri, data, method).then((r) => {
                        resolve(r)
                    }).catch((r) => {
                        reject(r);
                    })
                }
            }, 1000);
        })
    }
    return new Promise(function(resolve, reject){
        fetch(uri, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer '+window.Flex.User.accessToken
            },
            credentials: 'include',
            body: data
        }).then(function(response){
            response.json().then(function (json) {
                if(json.success === false) {
                    reject(json.errors);
                    return;
                }
                return resolve({data: json, response: response});
            });
        }).catch(function(r){ return reject(r) });
    });
};

window.Flex.Util.Query('/admin/token').then((r) => {
    window.Flex.User.accessToken = r.data.accessToken;
})

window.Flex.Util.Dispatcher = function(){
    let listOfRegisteredCallbacks = {};
    return {
        dispatch: function (event, resource) {
            if (!listOfRegisteredCallbacks[event]) {
                return;
            }
            listOfRegisteredCallbacks[event].forEach(function(callback){
                callback(resource);
            })
        },
        register: function (event, callback) {
            if (!listOfRegisteredCallbacks[event]) {
                listOfRegisteredCallbacks[event] = [];
            }
            listOfRegisteredCallbacks[event].push(callback);
        },
        unregister: function (event) {
            listOfRegisteredCallbacks[event] = [];
        }
    };
}();

window.Flex.Util.clearElement = (elem) => {
    while (elem.firstChild) {
        elem.removeChild(elem.firstChild);
    }
};

window.Flex.Util.clearElements = (elems) => {
    elems.forEach((elem) => {
        window.Flex.Util.clearElement(elem);
    });
};

window.Flex.Util.toArray = (elem) => {
    let type = typeof elem;
    switch (type) {
        case 'object':
            let arr = [];
            Object.keys(elem).forEach(function (key) {
                arr.push(elem[key]);
            });
            return arr;
        default:
            return [elem];
    }
};

window.Flex.Util.listApiCalls = (display = false) => {
    let displayApis = [];
    let apis = {
        component: [],
        command: [],
        query: [],
    };
    Object.keys(window.Flex.Component).forEach((key) => {
        let component = window.Flex.Component[key];
        if(component.hasOwnProperty('Store')) {
            if(component.Store.hasOwnProperty('Command')) {
                Object.keys(component.Store.Command).forEach((commandCall) => {
                    displayApis.push({
                        component: key,
                        command: commandCall,
                        query: null,
                    })
                    apis.component.push(key)
                    apis.command.push(commandCall)
                })
            }
            if(component.Store.hasOwnProperty('Query')) {
                Object.keys(component.Store.Query).forEach((commandCall) => {
                    displayApis.push({
                        component: key,
                        command: null,
                        query: commandCall,
                    })
                    apis.component.push(key)
                    apis.query.push(commandCall)
                })
            }
        }
    })
    if(display) {
        console.table(displayApis)
    }
    return apis;
}

window.Flex.Util.confirmModal = (options) => {

    let parsedOptions = {
        title: 'Potvrdi akciju',
        content: 'Da li ste sigurni?',
        data: {},
        success: () => {},
    }

    if(typeof options.title !== 'undefined') {
        parsedOptions.title = options.title;
    }
    if(typeof options.content !== 'undefined') {
        parsedOptions.content = options.content;
    }
    if(typeof options.data !== 'undefined') {
        parsedOptions.data = options.data;
    }
    if(typeof options.success !== 'undefined') {
        parsedOptions.success = options.success;
    }


    let confirmModalDom = document.querySelector('#flexConfirmationModal');
    let confirmModalTitle = confirmModalDom.querySelector('[data-title]');
    let confirmModalContent = confirmModalDom.querySelector('[data-content]');
    let confirmModalSuccess = confirmModalDom.querySelector('[data-confirmation-success]');

    window.Flex.Util.clearElements([confirmModalTitle, confirmModalContent]);
    confirmModalTitle.appendChild(document.createTextNode(parsedOptions.title));
    confirmModalContent.innerHTML = parsedOptions.content;

    confirmModalSuccess.addEventListener('click', () => {
        $('#flexConfirmationModal').modal('hide');
        parsedOptions.success(parsedOptions.data);
    })

    $('#flexConfirmationModal').modal('show');
}
