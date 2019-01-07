self.addEventListener('install', function(event) {
  event.waitUntil(
      caches.open('drift_pwa').then(function(cache) {
          return cache.addAll([
              './wp-includes/js/jquery/jquery.js'
          ]);
      })
  );
});


self.addEventListener('fetch', function(event) {
  event.respondWith(
      caches.match(event.request).then(function(response) {
          return response || fetch(event.request);
      })
  );
});