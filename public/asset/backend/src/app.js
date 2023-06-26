import './bootstrap';

// window.Echo.private(`App.Models.User.${userId}`)
//     .notification(function (data) {
//         alert(data.title);
//     });

var channel = Echo.private(`App.Models.User.${userId}`);
channel.notification(function (data) {
    console.log(data);
    alert(data.title);
});
