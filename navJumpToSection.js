// more info on https://coderwall.com/p/z7gfjq/scroll-to-page-sections-with-nav-links 

jQuery(document).ready(function($){
$("nav").find("a").click(function(e) {
    e.preventDefault();
    var section = $(this).attr("href");
    $("html, body").animate({
        scrollTop: $(section).offset().top
    });
});
});