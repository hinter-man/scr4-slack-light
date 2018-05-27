$(document).ready(() => {
    registerImportantBtnClickListener();

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
