var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    '/offline',
    '/adminlte/dist/css/adminlte.min.css',
    '/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
    '/adminlte/plugins/jquery/jquery.min.js',
    '/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js',
    '/adminlte/dist/js/adminlte.min.js',
    '/adminlte/dist/img/CondOnlineLogo.png',
    '/assets/favicon/apple-icon-57x57.png',
    '/assets/favicon/apple-icon-60x60.png',
    '/assets/favicon/apple-icon-72x72.png',
    '/assets/favicon/apple-icon-76x76.png',
    '/assets/favicon/apple-icon-114x114.png',
    '/assets/favicon/apple-icon-120x120.png',
    '/assets/favicon/apple-icon-144x144.png',
    '/assets/favicon/apple-icon-152x152.png',
    '/assets/favicon/apple-icon-180x180.png',
    '/assets/favicon/android-icon-36x36.png',
    '/assets/favicon/android-icon-48x48.png',
    '/assets/favicon/android-icon-72x72.png',
    '/assets/favicon/android-icon-96x96.png',
    '/assets/favicon/android-icon-144x144.png',
    '/assets/favicon/android-icon-192x192.png',
];

// Cache on install
var version = 'v2'
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
                return caches.match('/offline');
            })
    )
});
