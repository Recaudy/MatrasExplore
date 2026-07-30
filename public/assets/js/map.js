/* Explore Bangka Beaches - Interactive Leaflet Map Script */

document.addEventListener('DOMContentLoaded', () => {
    const mapCanvas = document.getElementById('map-canvas');
    if (!mapCanvas) return;

    // Get locations from DOM dataset attributes (injected by CodeIgniter controller/views)
    const destinationsData = JSON.parse(mapCanvas.getAttribute('data-destinations') || '[]');
    
    if (destinationsData.length === 0) return;

    // Center map around Bangka or the first destination
    const defaultCenter = [-1.75000000, 106.00000000]; // Center coordinates of Bangka region
    const isHome = mapCanvas.classList.contains('map-home-canvas');
    const map = L.map('map-canvas', {
        scrollWheelZoom: !isHome, // Disable scroll zoom by default on homepage to prevent trapping page scroll
        zoomControl: true
    }).setView(defaultCenter, 10);

    // Google Maps Roadmap (Streets) Tile Layer - Exactly like Google Maps
    const googleStreets = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        attribution: '&copy; <a href="https://www.google.com/maps">Google Maps</a>'
    });

    // Google Maps Satellite / Hybrid Tile Layer
    const googleSatellite = L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        attribution: '&copy; <a href="https://www.google.com/maps">Google Maps</a>'
    });

    // CartoDB Voyager Tile Layer
    const cartoVoyager = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        maxZoom: 20,
        subdomains: 'abcd',
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/attributions">CARTO</a>'
    });

    // Set default layer to Google Maps (Streets)
    googleStreets.addTo(map);

    // Add Layer Switcher Control in top-right corner
    const baseLayers = {
        "Google Maps (Streets)": googleStreets,
        "Google Satellite": googleSatellite,
        "Terrain & Coast": cartoVoyager
    };
    L.control.layers(baseLayers, null, { position: 'topright' }).addTo(map);

    // Keep track of markers
    const markers = [];

    // Custom SVG Pin Icon matching the CSS definitions in map.css
    const createCustomIcon = (isActive = false) => {
        return L.divIcon({
            className: `leaflet-marker-custom-div`,
            html: `<div class="custom-map-marker ${isActive ? 'active' : ''}"><div class="custom-map-marker-inner"></div></div>`,
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });
    };

    // Populates markers on the map
    destinationsData.forEach(dest => {
        const lat = parseFloat(dest.latitude);
        const lng = parseFloat(dest.longitude);
        
        if (isNaN(lat) || isNaN(lng)) return;

        const marker = L.marker([lat, lng], { icon: createCustomIcon() }).addTo(map);
        
        // Custom popup layout
        const popupContent = `
            <div class="leaflet-popup-title">${dest.name}</div>
            <div class="leaflet-popup-desc">${dest.description}</div>
            <a class="leaflet-popup-link" href="${dest.baseUrl}/destinations/${dest.slug}">Explore Detail &rarr;</a>
        `;
        
        marker.bindPopup(popupContent);
        
        // Save database ID and slug with marker for interaction
        marker.destinationId = dest.id;
        marker.slug = dest.slug;
        markers.push(marker);
    });

    // Fit map bounds to show all markers nicely if we have multiple
    if (markers.length > 0) {
        const group = new L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.15));
    }

    // Sidebar interaction logic
    const sidebarCards = document.querySelectorAll('.map-sidebar-card');
    const externalMapBtn = document.querySelector('.map-external-btn');
    
    sidebarCards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove active classes
            sidebarCards.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            
            const lat = parseFloat(this.getAttribute('data-lat'));
            const lng = parseFloat(this.getAttribute('data-lng'));
            const id = this.getAttribute('data-id');
            const destName = this.querySelector('.map-item-text h4').textContent;
            
            if (isNaN(lat) || isNaN(lng)) return;
            
            // Update Google Maps button link
            if (externalMapBtn) {
                externalMapBtn.href = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(destName + ' Bangka')}`;
            }

            // Pan and Zoom map smoothly
            map.setView([lat, lng], 14, {
                animate: true,
                duration: 1.0
            });
            
            // Open popup for corresponding marker and style it active
            markers.forEach(marker => {
                if (String(marker.destinationId) === String(id)) {
                    marker.setIcon(createCustomIcon(true));
                    marker.openPopup();
                } else {
                    marker.setIcon(createCustomIcon(false));
                }
            });
        });
    });

    // Reset markers state when closing map popups
    map.on('popupclose', () => {
        markers.forEach(marker => {
            marker.setIcon(createCustomIcon(false));
        });
        sidebarCards.forEach(c => c.classList.remove('active'));
    });

    // Update external maps button and marker states when clicking directly on map markers
    map.on('popupopen', (e) => {
        const marker = e.popup._source;
        if (marker && marker.destinationId) {
            
            // Update all markers colors
            markers.forEach(m => {
                if (String(m.destinationId) === String(marker.destinationId)) {
                    m.setIcon(createCustomIcon(true));
                } else {
                    m.setIcon(createCustomIcon(false));
                }
            });

            // Find corresponding sidebar card to get the name and set it active
            sidebarCards.forEach(c => {
                if (String(c.getAttribute('data-id')) === String(marker.destinationId)) {
                    c.classList.add('active');
                    const destName = c.querySelector('.map-item-text h4').textContent;
                    if (externalMapBtn) {
                        externalMapBtn.href = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(destName + ' Bangka')}`;
                    }
                } else {
                    c.classList.remove('active');
                }
            });
        }
    });
});
