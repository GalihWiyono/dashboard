<script>
    $(document).ready(function() {

        $(".btn-approve").click(function() {
            let userId = $(this).data("id");
            let userName = $(this).data("name");

            $("#approveUserName").text(userName);
            $("#approveForm").attr("action", "<?= base_url('users/approve/') ?>" + userId);
            $("#approveUserModal").modal("show");
        });

        $(".btn-reject").click(function() {
            let userId = $(this).data("id");
            let userName = $(this).data("name");

            $("#rejectUserName").text(userName);
            $("#rejectForm").attr("action", "<?= base_url('users/reject/') ?>" + userId);
            $("#rejectUserModal").modal("show");
        });

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