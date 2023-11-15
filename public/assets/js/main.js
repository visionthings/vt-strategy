// pre loader
document.addEventListener("DOMContentLoaded", function () {
    var spinnerloader = document.querySelector(".spinnerloader");
    spinnerloader.style.display = "none";
    document.body.style.overflowY = "auto";
});
// change navbar color
document.addEventListener("DOMContentLoaded", function () {
    var navbar = document.getElementById("mainNavbar");

    window.addEventListener("scroll", function () {
        if (window.scrollY >= 70) {
            navbar.style.backgroundColor = 'black';
        } else {
            navbar.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
        }
    });
});

// typed js
var typed = new Typed('#typed', {
    strings: ['كتابة وصياغة واعداد لوائح الحوكمة', 'تقييم أداء أعضاء مجلس الإدارة واللجان المنبثقة منه', 'تأهيل الشركات للإدراج فى السوق المالية', 'تقديم الاستشارات المتخصصة فى مجال الحوكمة'],
    typeSpeed: 50,
});

// index testmonials
function setCarouselHeight() {
    var carouselInner = document.querySelector('.carousel-inner');
    var carousel = document.querySelector('.carousel');
    if (carouselInner && carousel) {
      carousel.style.height = carouselInner.clientHeight + 'px';
    }
  }

  window.addEventListener('load', setCarouselHeight);
  window.addEventListener('resize', setCarouselHeight);


  