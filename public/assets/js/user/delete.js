function destroy(event) {
    event.preventDefault();

    $("#delete-modal").modal("show");

    $("#dismiss-delete-modal").on("click", function() {
        $("#delete-modal").modal("hide");
    })

    $("#confirm-delete").off().on("click", function () {
        const confirmDelete = $(this);
        const confirmDeleteText = confirmDelete.text();

        confirmDelete.prop("disabled", true);
        confirmDelete.text(`Loading ...`);

        $.ajax({
            url: event.target.action,
            type: event.target.method,
            data: $(event.target).serialize(),
        })
            .done(function () {
                userDatatable.ajax.reload();
                $("#delete-modal").modal("hide");
                confirmDelete.prop("disabled", false);
                confirmDelete.text(confirmDeleteText);
            })
            .fail(function () {
                confirmDelete.prop("disabled", false);
                confirmDelete.text(confirmDeleteText);
            });
    });
}
