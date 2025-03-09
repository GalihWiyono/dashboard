<script>
    $(document).ready(function() {
        $(".btn-edit").click(function() {
            let userId = $(this).data("id");

            $.ajax({
                url: "<?= base_url('users/get') ?>/" + userId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $("#edit-id").val(data.id);
                    $("#edit-name").val(data.name);
                    $("#edit-email").val(data.email);
                    $("#edit-username").val(data.username);

                    // Tampilkan modal
                    $("#editForm").attr("action", "<?= base_url('users/update/') ?>" + userId);
                    $("#editUserModal").modal("show");
                },
                error: function(xhr) {
                    alert("Gagal mengambil data.");
                }
            });
        });

        $(".btn-delete").click(function() {
            let userId = $(this).data("id");
            let userName = $(this).data("name");

            $("#deleteUserName").text(userName);
            $("#deleteForm").attr("action", "<?= base_url('users/delete/') ?>" + userId);
            $("#deleteUserModal").modal("show");
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