export function carregarLeaflet(): Promise<void> {
  return new Promise((resolve, reject) => {
    // Verificar si ya está cargado
    if ((window as any).L) {
      resolve();
      return;
    }

    // CSS
    const leafletCss = document.createElement('link');
    leafletCss.rel = 'stylesheet';
    leafletCss.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
    leafletCss.integrity = 'sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=';
    leafletCss.crossOrigin = '';
    document.head.appendChild(leafletCss);

    // JS
    const leafletJs = document.createElement('script');
    leafletJs.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
    leafletJs.integrity = 'sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=';
    leafletJs.crossOrigin = '';

    // Esperar a que el script de Leaflet termine de cargarse
    leafletJs.onload = () => {
      resolve(); // Resolvemos cuando Leaflet JS se ha cargado
    };

    leafletJs.onerror = () => {
      reject(new Error('Leaflet JS failed to load'));
    };

    document.body.appendChild(leafletJs);
  });
}
