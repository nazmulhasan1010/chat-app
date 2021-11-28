const form = document.querySelector(".hidden_account").value,
    chatBoxXe = document.querySelector(".contractssess"),
    activeBox = document.querySelector(".active_fild"),
    activeBar = document.querySelector(".activet-contracts"),
    searchBar = document.querySelector(".search-contract-input"),
    usersList = document.querySelector(".search_result"),
    logOut = document.querySelector(".logOut");

setInterval(() => {
    $(document).ready(function () {
        $.ajax({
            dataType: "html",
            url: 'home.php',
            method: 'POST',
            data: {
                receive_id: form,
            },
            headers: {
                'Access-Control-Allow-Credentials': true,
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': 'GET',
                'Access-Control-Allow-Headers': 'application/json',
            },
            success: function (data) {
                $('.contractssess').html(data);
            },
        });
    });
}, 500);


setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "active.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                activeBox.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("receive_id=" + form);
}, 500);


setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "activeBar.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                activeBar.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("receive_id=" + form);
}, 500);


logOut.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "logout.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {

            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("receive_id=" + form);
}

searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "search.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data != "") {
                    usersList.style.display = 'block';
                    searchBar.style.borderBottomLeftRadius = '0px';
                    searchBar.style.borderBottomRightRadius = '0px';
                } else {
                    searchBar.style.borderBottomLeftRadius = '5px';
                    searchBar.style.borderBottomRightRadius = '5px';
                    usersList.style.display = 'none';
                }
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}