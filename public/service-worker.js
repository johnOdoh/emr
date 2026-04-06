// Minimal service worker — no offline caching
self.addEventListener("install", event => {
  // Required for installability, but no caching logic
  self.skipWaiting();
});

self.addEventListener("activate", event => {
  // Just take control immediately
  event.waitUntil(clients.claim());
});
self.addEventListener("fetch", event => {
  // Just take control immediately
  self.skipWaiting();
});

// No fetch handler → always go to the network
