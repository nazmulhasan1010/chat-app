 //singin password
 const pswrdField = document.querySelector(".confirm-password"),
     pswrdField2 = document.querySelector(".password"),
     toggleIcon = document.querySelector(".check");



 //singup password
 toggleIcon.onclick = () => {
     if (pswrdField.type === "password") {
         pswrdField.type = "text";
         pswrdField2.type = "text";
     } else {
         pswrdField.type = "password";
         pswrdField2.type = "password";
     }
 }