const form = document.querySelector(".typing-area"),
    receive_id_chat = form.querySelector(".receiveId").value,
    send_id = form.querySelector(".sendId").value,
    inputField = form.querySelector(".text-send-box"),
    sendBtn = form.querySelector(".text-send-button"),
    chatBox = document.querySelector(".messages"),
    addbutton = document.querySelector(".addperson");


chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}
sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "insert.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = "";
                scrollToBottom();
                
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);

    $('.sessionInfo').val("typingstop");
    let xhrs = new XMLHttpRequest();
    xhrs.open("POST", "session.php", true);
    xhrs.onload = () => {
        if (xhrs.readyState === XMLHttpRequest.DONE) {
            if (xhrs.status === 200) {
                let data = xhrs.response;
            }
        }
    }
    let formDatae = new FormData(form);
    xhrs.send(formDatae);
}
setInterval(() => {
    $(document).ready(function () {
        $.ajax({
            dataType: "html",
            url: 'chat.php',
            method: 'POST',
            data: {
                receive_id_chat: receive_id_chat,
            },
            headers: {
                'Access-Control-Allow-Credentials': true,
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': 'GET',
                'Access-Control-Allow-Headers': 'application/json',
            },
            success: function (data) {
                $('.messages').html(data);
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            },
        });
    });
}, 600);

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}