
let formBtn = document.querySelector('#login-btn');
let loginForm = document.querySelector('.login-form-container');
let formClose = document.querySelector('#form-close');
/*
window.onscroll = () =>{
  loginForm.classList.remove('active');
}
*/

formBtn.addEventListener('click', () =>{
  loginForm.classList.add('active');
});

formClose.addEventListener('click', () =>{
  loginForm.classList.remove('active');
});



var swiper = new Swiper(".review-slider", {
  spaceBetween: 20,
  loop:true,
  autoplay: {
      delay: 5000,
      disableOnInteraction: false,
  },
  breakpoints: {
    640: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
},
});
var swiper = new Swiper(".brand-slider", {
  spaceBetween: 10,
  loop:true,
  autoplay: {
      delay: 5000,
      disableOnInteraction: false,
  },
    direction: "horizontal",
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
});
/*
var swiper = new Swiper(".brand-slider", {
  spaceBetween: 20,
  loop:true,
  autoplay: {
      delay: 2500000,
      disableOnInteraction: false,
  },
  breakpoints: {
      450: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      991: {
        slidesPerView: 4,
      },
      1200: {
        slidesPerView: 5,
      },
    },
});
*/

function upload_file(e) {
  e.preventDefault();
  document.getElementById('selectfile').files = e.dataTransfer.files;
}

function file_explorer() {
  document.getElementById('selectfile').click();
  
  // document.getElementById('selectfile').onchange = function() {
  //     files = document.getElementById('selectfile').files;
  //    // ajax_file_upload(files);
  // };
}

// function ajax_file_upload(files_obj) {
//   if(files_obj != undefined) {
//       var form_data = new FormData();
//       for(i=0; i<files_obj.length; i++) {
//           form_data.append('file[]', files_obj[i]);
//       }
//       var xhttp = new XMLHttpRequest();
//       xhttp.open("POST", "ajax.php", true);
//       xhttp.onload = function(event) {
//           if (xhttp.status == 200) {
//               alert(this.responseText);
//           } else {
//               alert("Error " + xhttp.status + " occurred when trying to upload your file.");
//           }
//       }

//       xhttp.send(form_data);
//   }
// }

var faq = document.getElementsByClassName("faq-page");
var i;
for (i = 0; i < faq.length; i++) {
    faq[i].addEventListener("click", function () {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");
        /* Toggle between hiding and showing the active panel */
        var body = this.nextElementSibling;
        if (body.style.display === "block") {
            body.style.display = "none";
        } else {
            body.style.display = "block";
        }
    });
}


