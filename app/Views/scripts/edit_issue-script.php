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