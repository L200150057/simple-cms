/** Get filename for custom file input bootstrap 4.6 */
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

/** Set submit button to loading state */
$("form").on("submit", function () {
    const form = $(this);
    const submitButton = form.find(":submit");
    submitButton.prop("disabled", true);
    submitButton.text("Loading...");
});
