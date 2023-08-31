const href = window.location.href;

function preventDefault(event) {
    event.stopPropagation();
    event.preventDefault();
}

function changeClass(el, del, add) {
    del ? el.classList.remove(del) : null;
    add ? el.classList.add(add) : null;
}

function changeType(type, ...el) {
    el.forEach(element => {
        element.type = type
    });
}

function clearValue(...el) {
    el.forEach(element => {
        element.value = ""
    });
}

function getEl(meth, q) {
    return q.map(element => {
        return meth(element)
    });
}

function getElId(el, ...id) {
    return getEl(el.getElementById.bind(el), id)
}

function getElSelectAll(el, ...id) {
    return getEl(el.querySelectorAll.bind(el), id)
}

function getElSelect(el, ...id) {
    return getEl(el.querySelector.bind(el), id)
}

function getAttr(el, ...attr) {
    return getEl(el.getAttribute.bind(el), attr)
}

function show(el) {
    el.classList.remove("hidden");
    el.classList.add("show")
}

function close(el) {
    el.classList.add("hidden");
    el.classList.remove("show");
}

function go(location) {
    window.location.href = location;
}

function home() {
    Redirect.go('/');
}

function convertDate(date) {
    const [day, month, year] = date.split('/');
    return year + "-" + month + "-" + day;
}

class Request {
    constructor(url) {
        this.url = url;
        this.myHeaders = new Headers();
        this.myInit = {
            headers: this.myHeaders,
            mode: 'cors',
            cache: 'default'
        };
    }
    async req() {
        return await fetch(this.url, this.myInit).then((response) => { return response.text().then(((text) => { return text })) })

    }
    async get() {
        this.method("GET")
        return await this.req()
    }
    async post(body) {
        this.editMyInit({ "method": "POST", "body": body })
        return await this.req()
    }
    editMyInit(obj) {
        Object.entries(obj).forEach(([key, value]) => {
            this.myInit[key] = value
        });
    }
    method(method) {
        this.myInit.method = method
    }
    body(body) {
        this.myInit.body = body
    }
}