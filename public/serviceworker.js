var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    '/offline',
    '/adminlte_3.1.0-rc/dist/css/adminlte.min.css',
    '/adminlte_3.1.0-rc/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
    '/adminlte_3.1.0-rc/plugins/jquery/jquery.min.js',
    '/adminlte_3.1.0-rc/plugins/bootstrap/js/bootstrap.bundle.min.js',
    '/adminlte_3.1.0-rc/dist/js/adminlte.min.js',
    '/assets/img/CondOnlineLogo.png',
    '/assets/icons/icon-72x72.png',
    '/assets/icons/icon-96x96.png',
    '/assets/icons/icon-128x128.png',
    '/assets/icons/icon-144x144.png',
    '/assets/icons/icon-152x152.png',
    '/assets/icons/icon-192x192.png',
    '/assets/icons/icon-384x384.png',
    '/assets/icons/icon-512x512.png',
    '/assets/icons/splash-640x1136.png',
    '/assets/icons/splash-750x1334.png',
    '/assets/icons/splash-828x1792.png',
    '/assets/icons/splash-1125x2436.png',
    '/assets/icons/splash-1242x2208.png',
    '/assets/icons/splash-1242x2688.png',
    '/assets/icons/splash-1536x2048.png',
    '/assets/icons/splash-1668x2224.png',
    '/assets/icons/splash-1668x2388.png',
    '/assets/icons/splash-2048x2732.png',
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});
