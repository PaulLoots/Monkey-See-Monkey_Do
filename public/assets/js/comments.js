$(function() {
    $("#textCommentModal").modal("show");
});

$('#textCommentModal').on('hidden.bs.modal', function () {
    window.location.href = '/answers';
})