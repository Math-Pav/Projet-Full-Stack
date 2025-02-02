import { get_location } from './services/map.js';
export const initMap = (x, y, z) => {
    let map = L.map('map').setView([x, y], z);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
    }).addTo(map);

    return map;
};

export const addMarker = (map, x_pos, y_pos, name, rue, ville) => {
    let marker = L.marker([x_pos, y_pos]).addTo(map);
    marker.bindPopup(`
        <div>
            <h3>${name}</h3>
            <p><strong>Rue :</strong> ${rue}</p>
            <p><strong>Ville :</strong> ${ville}</p>
        </div>
    `);
};

export const loadMarkers = async (map) => {
    const markers = await get_location();

    markers.forEach(marker => {
        addMarker(map, marker.x_pos, marker.y_pos, marker.name, marker.rue, marker.ville);
    });
};

