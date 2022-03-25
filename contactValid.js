var fields = {};
document.addEventListener("DOMContentLoaded", function() {
    fields.firstName = document.getElementById('user_first_name');
    fields.lastName = document.getElementById('user_last_name');
    fields.email = document.getElementById('user_email');
    fields.preference = document.getElementById('cont_pref');
    fields.phone = document.getElementById('user_phone');
    fields.subject = document.getElementById('user_subject');
    fields.message = document.getElementById('message');
   })
   function isNotEmpty(value) {
    if (value == null || typeof value == 'undefined' ) return false;
    return (value.length > 0);
   }

   function isEmail(email) {
    let regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    return regex.test(String(email).toLowerCase());
   }

   function isNumber(num) {
    return (num.length > 0) && !isNaN(num);
   }


  function isPhone(phone) {
    let regex = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
    return regex.test(phone);
   }

   function isValid(){
       var valid = true;
  
     valid &=fieldValidation(fields.user_email, isEmail);   


     return valid;
   }