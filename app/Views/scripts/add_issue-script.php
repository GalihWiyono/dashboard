<script>
    function previewImage(event) {
        let reader = new FileReader();
        reader.onload = function() {
            let output = document.getElementById('photoPreview');
            output.src = reader.result;
            document.getElementById('photoPreviewContainer').style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function previewVideo(event) {
        let file = event.target.files[0];
        let videoPreview = document.getElementById('videoPreview');
        let videoContainer = document.getElementById('videoPreviewContainer');

        if (file) {
            let objectURL = URL.createObjectURL(file);
            videoPreview.src = objectURL;
            videoContainer.style.display = 'block';
        }
    }

    $(document).ready(function() {

        let submitBtn = $("#submitBtn");

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    $("#latitude").val(position.coords.latitude);
                    $("#longitude").val(position.coords.longitude);
                    submitBtn.prop("disabled", false); // Aktifkan tombol submit
                },
                function(error) {
                    let locationModal = new bootstrap.Modal(document.getElementById('locationModal'));
                    locationModal.show();
                    submitBtn.prop("disabled", true); // Tetap disable submit
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                } // Opsi tambahan
            );
        } else {
            let locationModal = new bootstrap.Modal(document.getElementById('locationModal'));
            locationModal.show();
            submitBtn.prop("disabled", true);
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