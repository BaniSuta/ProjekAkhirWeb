$(document).ready(function(){
    $('a').on('click', function(event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){
                window.location.hash = hash;
            });
        }
    });
});

$(document).ready(function () {
  $("#tombol-cari").hide();
  $("#keyword").on("keyup", function () {
    $("#product").load("../ajax/console.php?keyword=" + $("#keyword").val());
  });
});

$(document).ready(function () {
  $("#tombol-cari").hide();
  $("#keyword").on("keyup", function () {
    $("#cont").load("../ajax/user.php?keyword=" + $("#keyword").val());
  });
});

var tombol = document.getElementById('toggle-mode');
tombol.addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");
    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('mode', 'dark');
    } else {
        localStorage.setItem('mode', 'light');
    }
});