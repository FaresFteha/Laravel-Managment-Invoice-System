import './bootstrap';

// window.Echo.private(`App.Models.User.${userId}`)
//     .notification(function (data) {
//         alert(data.title);
//     });

const imgUrl = 'asset/backend/src/img/generic/image-file-2.png';
var channel = Echo.private(`App.Models.User.${userId}`);
channel.notification(function (data) {
    $('#listNotification').prepend(`<a class="notification notification-flush notification-unread"
    href="${data.url}?notify_id=${data.id}">
    <div class="notification-avatar">
        <div class="avatar avatar-2xl me-3">
        <img src="${imgUrl}" alt="">
        </div>
    </div>
    <div class="notification-body">
        <p class="mb-1"><strong>${data.user}
            </strong>${data.title}</p>
        <span class="notification-time"><span class="me-2" role="img"
                aria-label="Emoji">💬</span>اضيفت
            بواسطة:${data.user}</span>
        <br>
        <span class="notification-time"><span class="me-2" role="img"
                aria-label="Emoji">🕕</span>${data.date}</span>
    </div>
</a>`);
    let count = Number($('#newNotification').text());
    count++;
    if (count == 99) {
        count == '99+';
    }
    $('#newNotification').text(count);
});
