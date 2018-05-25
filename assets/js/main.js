$(document).ready(() => {
    registerPostingClickListener();
// .on('click', function () {
//         let id = event.target.id;
//         alert(id);
//         $.ajax({
//             url: './views/important-ajax.php',
//             type: 'POST',
//             data: {'action': 'toggle-important', 'postingId': id},
//             success: function (data) {
//                 alert(data);
//             }
//         });
//     });

});

function registerPostingClickListener() {
    $('#message-list .posting').click(function (event) {
        let id = $(this).attr("id");
        let userId = $('#actualUserId').text();
        $.ajax({
            url: './views/important-ajax.php',
            type: 'POST',
            data: {'action': 'toggle-important', 'postingId': id, 'userId': userId},
            success: function (data) {
                // either true or false, update list-item
            }
        });
    });

}
