$(document).ready(function () {
    $('.delete-button').click(function (e) {
        var modalId = $(this).data('target');
        $(modalId).modal('show');
    });
    $('.cancel-button').click(function (e) {
        var modalId = $(this).closest('.modal').attr('id');
        $('#' + modalId).modal('hide');
    });
    $('.edit-button').click(function () {
        var modalId = $(this).data('target');
        $(modalId).modal('show');
    });
});
