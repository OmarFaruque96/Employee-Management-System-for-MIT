function showNotification(message) {
    // Create a new div element for the notification
    var notification = $('<div>');
    notification.addClass('notification');
    notification.text(message);

    // Append the notification to the body of the document
    $('body').append(notification);

    // Fade out the notification after 2 seconds
    setTimeout(function() {
        notification.fadeOut('slow', function() {
            $(this).remove();
        });
    }, 2000);
}
