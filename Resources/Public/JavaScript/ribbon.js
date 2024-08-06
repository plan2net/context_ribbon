function ribbonAppendHtml (el, str) {
    const div = document.createElement('div');
    div.innerHTML = str;
    while (div.children.length > 0) {
        el.appendChild(div.children[0]);
    }
}

function getContextName () {
    const metas = document.getElementsByTagName('meta');

    for (let i = 0; i < metas.length; i++) {
        if (metas[i].getAttribute('name') === 'context') {
            return metas[i].getAttribute('content');
        }
    }

    return '';
}

document.onreadystatechange = function () {
    if (document.readyState === 'complete') {

        const value = getContextName();
        if (value) {
            ribbonAppendHtml(document.body, '<div class="ribbonbox"><div class="ribbon ' + value.toLowerCase() + '"><span>' + value + '</span></div></div>');
        }
    }
};
