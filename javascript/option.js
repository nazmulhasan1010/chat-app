var buttons = document.querySelectorAll(".newsubmit_button");
var i = 0,
    length = buttons.length,
    optionsBarHidden = document.querySelector(".addcontractsmodals");

for (i = 0; i < length; i++) {
    const HiddenDiv = document.querySelectorAll(".hiddenens")[i];
    buttons[i].addEventListener("click", function () {
        var text = HiddenDiv.innerHTML;
        optionsBarHidden.style.display = 'block';

        // options variable
        const optionses1 = document.querySelector(".optionses1"),
            optionses2 = document.querySelector(".optionses2"),
            optionses3 = document.querySelector(".optionses3");

        //option1
        optionses1.onclick = () => {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "dotOperation.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    location.reload();
                    if (xhr.status === 200) {
                        let data = xhr.response;
                    }
                }
            }
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("delete_id=" + text);
        }
        // option2
        optionses2.onclick = () => {
            const linkAddress = document.querySelector('.linkAddress');
            linkAddress.href = 'profiles.php?ids=' + text;
            console.log(text);
        }

        //option3
        optionses3.onclick = () => {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "dotOperation.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;

                    }
                }
            }
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("unfriend_id=" + text);
        }
    });
}
$(document).mouseup((e) => {
    optionsBarHidden.style.display = 'none';
});