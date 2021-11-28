const navigation2 = document.querySelector('.side-navigations'),
    navBtn = document.querySelector('.menus'),
    menuesse = document.querySelector('.menuess'),
    formDatas = document.querySelector('.typing-area');
navBtn.onclick = () => {
    navigation2.style.display = 'block';

}
$(document).mouseup((e) => {
    navigation2.style.display = 'none';
});


$('#textsendbox').keyup(function () {
    var text = $(this).val();
    if (text !== "") {
        $('.sessionInfo').val("typing");
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "session.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                }
            }
        }
        let formDatae = new FormData(formDatas);
        xhr.send(formDatae);
    } else {
        $('.sessionInfo').val("typingstop");
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "session.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                }
            }
        }
        let formDatae = new FormData(formDatas);
        xhr.send(formDatae);
    }

});

// snack box 
var statusBar = document.getElementById('snackbar');
setTimeout(function () {
    statusBar.style.display = 'none';
}, 2000);