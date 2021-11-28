 const hideBtn = document.querySelector(".hide_pass"),
     ico = document.querySelector(".fa-eye-slash"),
     passFild = document.querySelector(".passwordrs");

 hideBtn.onclick = () => {
     if (passFild.type == 'password') {
         passFild.type = 'text';
         ico.classList.remove("fa-eye-slash");
         ico.classList.add("fa-eye");
     } else {
         passFild.type = 'password';
         ico.classList.remove("fa-eye");
         ico.classList.add("fa-eye-slash");
     }
 }