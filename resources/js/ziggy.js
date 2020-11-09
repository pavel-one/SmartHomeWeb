const Ziggy = {"url":"http:\/\/home.local","port":null,"defaults":[],"routes":{"index":{"uri":"\/","methods":["GET","HEAD"]},"dashboard.index":{"uri":"dashboard","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    for (let name in window.Ziggy.routes) {
        Ziggy.routes[name] = window.Ziggy.routes[name];
    }
}

export { Ziggy };
