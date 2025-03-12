<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    $(document).ready(function() {

        loadMap();

        function loadMap() {
            var latitude = <?= json_encode($issue['latitude']) ?>;
            var longitude = <?= json_encode($issue['longitude']) ?>;

            // Inisialisasi peta
            var map = L.map('map').setView([latitude, longitude], 13); // Zoom level 13

            // Tambahkan layer OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Tambahkan marker di tengah peta
            L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Issue Location')
                .openPopup();

            // Pusatkan peta ke marker
            map.setView([latitude, longitude], 15);
        }

        if ($('#toastNotification').hasClass("show")) {
            if ($('#toast-header').hasClass("bg-success")) {
                setTimeout(function() {
                    $('#toastNotification').toast('hide');
                }, 2000);
            }

            if ($('#toast-header').hasClass("bg-danger")) {
                setTimeout(function() {
                    $('#toastNotification').toast('hide');
                }, 10000);
            }
        }
    });
</script>