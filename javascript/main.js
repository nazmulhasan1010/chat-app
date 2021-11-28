const sarchBar = document.querySelector('.search-bar-text'),
    sachBtn = document.querySelector('.search-button'),
    cross = document.querySelector('.cross-button'),
    sachIco = document.querySelector('.search-button i');
sachBtn.onclick = () => {
    if (sarchBar.style.display === 'block') {
        sarchBar.style.display = 'none';
        sachIco.classList.remove("fa-times");
    } else {
        sarchBar.style.display = 'block';
        sachIco.classList.add("fa-times");
    }
}

//button active
const chatBtn = document.getElementById('chat-buttons');
const activeBtn = document.getElementById('activw-buttons');
const chatModal = document.getElementById('chat-fild');
const activeModal = document.getElementById('active-fild');

if (chatModal.style.display = 'none') {
    activeModal.style.display = 'none';
    activeBtn.style.color = '#ccc';
    activeBtn.style.background = 'none';
    chatBtn.style.color = 'black';
    chatBtn.style.background = 'none';
    chatModal.style.display = 'block';
}
if (activeModal.style.display = 'block') {
    chatModal.style.display = 'block';
    chatBtn.style.color = '#ccc';
    chatBtn.style.background = '#333';
    activeBtn.style.color = 'black';
    activeBtn.style.background = '#none';
    activeModal.style.display = 'none';
}
chatBtn.onclick = () => {
    if (activeModal.style.display = 'none') {
        chatModal.style.display = 'block';
        chatBtn.style.color = '#ccc';
        chatBtn.style.background = '#333';
        activeBtn.style.color = 'black';
        activeBtn.style.background = 'none';
    } else {
        activeModal.style.display = 'none';
        chatModal.style.display = 'block';
        chatBtn.style.color = '#ccc';
        chatBtn.style.background = '#333';
        activeBtn.style.color = 'black';
        activeBtn.style.background = 'none';
    }
}

activeBtn.onclick = () => {
    if (chatModal.style.display = 'none') {
        activeModal.style.display = 'block';
        activeBtn.style.color = '#ccc';
        activeBtn.style.background = '#333';
        chatBtn.style.color = 'black';
        chatBtn.style.background = 'none';
    } else {
        chatModal.style.display = 'none';
        activeModal.style.display = 'block';
        activeBtn.style.color = '#ccc';
        activeBtn.style.background = '#333';
        chatBtn.style.color = 'black';
        chatBtn.style.background = 'none';
    }

}

//add modal
const addModal = document.querySelector('.add-contracts-modal'),
    navigation2 = document.querySelector('.side-navigation'),
    closeIco2 = document.querySelector('.fa-bars'),
    addBtn = document.querySelector('.add-contracts-option'),
    hideModal = document.querySelector('.cancen-btn-add');
addBtn.onclick = () => {
    if (addModal.style.display === 'block') {
        addModal.style.display = 'none';
    } else {
        addModal.style.display = 'block';
        navigation2.style.display = 'none';
        closeIco2.classList.remove("fa-times");

    }
}



hideModal.onclick = () => {
    addModal.style.display = 'none';
}

//status breakAfter
var statusBar = document.getElementById('snackbar');
setTimeout(function () {
    statusBar.style.display = 'none';
}, 2000);

//option bar 
const navigation = document.querySelector('.side-navigationss'),
    navBtn = document.querySelector('.menuf'),
    menues = document.querySelector('.menuess');
navBtn.onclick = () => {
    navigation.style.display = 'block';
}

$(document).mouseup((e) => {
    navigation.style.display = 'none';
});

// 2nd add button
const closeIcoe = document.querySelector(".fa-bars"),
    addModale = document.querySelector(".add_contrac"),
    hideModal2 = document.querySelector('.cancen-btn-add2'),
    addBtne = document.querySelector(".adds");
addBtne.onclick = () => {
    if (addModale.style.display === 'block') {
        addModale.style.display = 'none';
    } else {
        addModale.style.display = 'block';
    }
}

hideModal2.onclick = () => {
    addModale.style.display = 'none';
}