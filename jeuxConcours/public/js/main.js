//var
const href = window.location.href;
// function
async function request(url) {
    return await fetch(url, {}).then((response) => { return response.text().then(((text) => { return text })) })
}

function home() {
    window.location.href = href;
}