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

/*Sample html code 
<nav>
    <a href="#welcome">Welcome</a>
    <a href="#about">About</a>
    <a href="#section3">Section 3</a>
</nav>

<div id="welcome">Welcome to this website</div>
<div id="about">About this website, and such</div>
<div id="section3">The third section</div> 
*/ 
