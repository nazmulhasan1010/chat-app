 const submit_button = document.querySelector('.submit-button');
 submit_button.onclick = () => {
     const first_name = document.querySelector('.first-name').value,
         last_name = document.querySelector('.last-name').value,
         email = document.querySelector('.email'),
         password = document.querySelector('.password'),
         con_password = document.querySelector('.confirm-password');
     const items = {
         fname: first_name,
         lname: last_name,
         email: email.value,
         password: password.value,
         conpass: con_password.value
     };
     sessionStorage.setItem('detiels', JSON.stringify(items));
 }
 var sessionItem = JSON.parse(sessionStorage.getItem("detiels"));
 var firstname = sessionItem['fname'],
     lastname = sessionItem['lname'],
     eMail = sessionItem['email'],
     passWord = sessionItem['password'],
     connPassWord = sessionItem['conpass'];
 $(document).ready(function () {
     function capitalize(cap) {
         return cap[0].toUpperCase() + cap.substr(1);
     }
     $('.first-name').keyup(function () {
         var firstNameS = $(this).val();
         var firstNameCap = capitalize(firstNameS);
         $('.first-name').val(firstNameCap);
     });
     $('.last-name').keyup(function () {
         var lastNameS = $(this).val();
         var lastNameCap = capitalize(lastNameS);
         $('.last-name').val(lastNameCap);
     });

     $('.first-name').val(firstname);
     $('.last-name').val(lastname);
     $('.email').val(eMail);
     $('.password').val(passWord);
     $('.confirm-password').val(connPassWord);
 });