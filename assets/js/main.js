$(document).ready(() => {
    registerImportantBtnClickListener();
    handleEditModal();

   $('#message-list .posting:not(:last)').find('#update-posting-buttons').addClass('hide-posting-buttons');

});

function registerImportantBtnClickListener() {
    $('.important-btn').click(function (event) {
        let idAttr = $(this).attr("id");
        let id = idAttr.replace( /^\D+/g, '');
        let userId = $('#actualUserId').text();
        $.ajax({
            url: './views/important-ajax.php',
            type: 'POST',
            context: this,
            data: {'action': 'toggle-important', 'postingId': id, 'userId': userId},
            success: function (data) {
                data == 1 ? $(this).addClass("important") : $(this).removeClass("important")
            }
        });
    });
}

function handleEditModal() {
    $('#edit-posting-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var title = button.data('title');
        var text = button.data('text');
        var id = button.data('posting-id');
        var modal = $(this)
        modal.find('#title').val(title);
        modal.find('#text').val(text);
        modal.find('#save-edit-btn').attr('value', id);
    })
}
