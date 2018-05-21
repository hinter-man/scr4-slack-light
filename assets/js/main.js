$(document).ready(function () {
    $('#create-posting-btn').click(function () {
        let title = $('#posting-title').val();
        let postingChannelId = 1;
        alert(title);
        $.ajax({ url: '/slack-light/index.php',
            data: {'action': 'new-posting','posting-channelId': postingChannelId, 'posting-title': title, 'posting-text': 'hallooo duu'},
            type: 'post',
            success: function(output) {
                alert(output);
            }
        });
    });
});
