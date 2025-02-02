<div id="map" style="height: 550px;"></div>
<script src="./_assets/js/components/map.js" type="module"></script>
<script type="module">
    import {initMap, loadMarkers} from "./_assets/js/components/map.js";

    document.addEventListener('DOMContentLoaded', async () => {
        const map = initMap(47.1464, 2.8747, 6);
        await loadMarkers(map);
    });
</script>