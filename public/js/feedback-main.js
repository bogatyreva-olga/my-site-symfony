function getFeedbackMessageValue() {
    return $('#feedback-message').val();
}

function getNameUserValue() {
    return $('#name-user').val();
}

function dateFormat(timestamp) {
    let date = new Date(timestamp * 1000);
    let year = date.getFullYear();
    let month = "0" + (date.getMonth() + 1);
    let day = "0" + date.getDate();
    let hours = date.getHours();
    let minutes = "0" + date.getMinutes();
    return year + "-" + month.substr(-2) + "-" + day.substr(-2) + " " + hours + ':' + minutes.substr(-2);
}

function getCategoryId() {
    return $("#category").val();
}

function sendFeedbackMessage() {
    let data = {
        message: getFeedbackMessageValue(),
        userName: getNameUserValue(),
        categoryId: getCategoryId(),
    };

    $.post('/feedback/messages', data, function (data) {
        const filterElement = $("#category-filter");
        filterElement.val(data.categoryId);
        console.log(filterElement);
        updateFeedbackMessagesWithCategoryFilter();

        $("#name-user").val('');
        $('#feedback-message').val('');
    })

    return undefined;
}

function getNodeFromFeedbackMessage(feedbackMessage) {
    let feedbackMessageElement = $('<div/>', {
        class: 'message-item'
    });
    let dateElement = $('<div/>', {
        text: dateFormat(feedbackMessage.createdAt),
        class: 'date-message'
    });
    $(feedbackMessageElement).append(dateElement);

    let userMessageElement = $('<div/>', {
        class: 'user-message'
    });
    let paragraphMessageElement = $('<p/>', {
        class: 'text-break',
        text: feedbackMessage.message
    });
    userMessageElement.append(paragraphMessageElement);
    feedbackMessageElement.append(userMessageElement);

    let userNameElement = $('<div/>', {
        text: feedbackMessage.userName,
        class: 'user-name'
    });
    feedbackMessageElement.append(userNameElement);

    return feedbackMessageElement;
}

function updateFeedbackMessagesWithCategoryFilter() {
    let categoryId = $("#category-filter").val();

    $.ajax({
        url: '/feedback/messages?categoryId=' + categoryId,
        method: 'get',
        success: function (data) {
            let feedbackMessagesData = data.feedbackMessages;

            const feedbackMessagesElement = $('#feedback-messages');
            feedbackMessagesElement.html('');

            for (let i = 0; i < feedbackMessagesData.length; i++) {
                let feedbackMessageElement = getNodeFromFeedbackMessage(feedbackMessagesData[i]);
                feedbackMessagesElement.append(feedbackMessageElement);
            }
        }
    });

    return undefined;
}

$(document).ready(function () {

    const sendFeedbackMessageButton = $('#send-feedback-message');

    $(sendFeedbackMessageButton).click(sendFeedbackMessage);
    setInterval(updateFeedbackMessagesWithCategoryFilter, 15000);
    updateFeedbackMessagesWithCategoryFilter();

    const filterCategorySelect = $("#category-filter");
    if (filterCategorySelect) {
        $(filterCategorySelect).change(updateFeedbackMessagesWithCategoryFilter);
    }
});
