$(document).ready(function(){
    $("#share_icons").click(function(){
      $("#div3").fadeToggle(500);
    });
  });

$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});

$('.search-icon').click(function(){
$('.search-wrapper').toggleClass('open');
$('body').toggleClass('search-wrapper-open');
});
$('.search-cancel').click(function(){
$('.search-wrapper').removeClass('open');
$('body').removeClass('search-wrapper-open');
});

$(document).ready(function() {
$('.product-slider .owl-carousel').owlCarousel({
loop: true,
margin: 10,
autoplay:true,
responsiveClass: true,
responsive: {
0: {
items: 2,
nav: true
},
600: {
items: 3,
nav: false
},
1000: {
items: 4,
nav: true,
loop: false,
margin: 20
}
}
})
})
$(document).ready(function() {
$('#featuredCat .owl-carousel').owlCarousel({
loop: true,
margin: 10,
autoplay:true,
responsiveClass: true,
responsive: {
0: {
items: 2,
nav: true
},
600: {
items: 3,
nav: false
},
1000: {
items: 4,
nav: true,
loop: false,
margin: 20
}
}
})
})
$(document).ready(function() {
$('.best_seller .owl-carousel').owlCarousel({
loop: true,
margin: 10,
autoplay:true,
responsiveClass: true,
responsive: {
0: {
items: 2,
nav: true
},
600: {
items: 3,
nav: false
},
1000: {
items: 4,
nav: true,
loop: false,
margin: 20
}
}
})
})

$(document).ready(function() {
$('.vasvi_exclusive_slider .owl-carousel').owlCarousel({
loop: true,
margin: 10,
autoplay:true,
responsiveClass: true,
responsive: {
0: {
items: 2,
nav: true
},
600: {
items: 3,
nav: false
},
1000: {
items: 4,
nav: true,
loop: false,
margin: 20
}
}
})
})

$(document).ready(function() {
$('.client-review .owl-carousel').owlCarousel({
loop: true,
margin: 10,
autoplay:true,
responsiveClass: true,
responsive: {
0: {
items: 1,
nav: true
},
600: {
items: 2,
nav: false
},
1000: {
items: 2,
nav: true,
loop: false,
margin: 20
}
}
})
})

$(window).scroll(function() {
if ($(this).scrollTop() >= 50) { // If page is scrolled more than 50px
$('#return-to-top').fadeIn(200); // Fade in the arrow
} else {
$('#return-to-top').fadeOut(200); // Else fade out the arrow
}
});
$('#return-to-top').click(function() { // When arrow is clicked
$('body,html').animate({
scrollTop: 0 // Scroll to top of body
}, 500);
});

window.onscroll = function() {
myFunction()
};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
if (window.pageYOffset >= sticky) {
navbar.classList.add("sticky")
} else {
navbar.classList.remove("sticky");
}
}

$(document).ready(function(){
$(".signin-btn").click(function(){
$("#registerModal").hide();

});

$(".signup-btn").click(function(){
$("#loginModal").hide();

});



});


$(function(){
$('#chatbox').popover({

placement: 'top',
title: 'Write a Note'+
//'<button  class="float"> <i class="fa fa-close my-float" id="chatbox2" aria-hidden="true"></i> </button>',
'<button type="button" id="chatbox" class="close2"  aria-hidden="true">&times;</button>',

html:true,
content:  $('#myForm').html()
}).on('click', function(){


//$(this).closest('div.popover').popover('hide');

//var close = $('#chatbox2').val;
//var close = document.getElementById('#chatbox2').value;
//alert(close);
// alert(dsfhshdf);
// had to put it within the on click action so it grabs the correct info on submit

$('.btn-submit-review ').click(function(){
$('#result').after("form submitted by " + $('#email').val())
$.post('/echo/html/',  {
email: $('#email').val(),
name: $('#name').val(),
phone: $('#phone').val(),
}, function(r){
$('#pops').popover('hide')
$('#result').html('resonse from server could be here' )
})
})

})

//
// $("#close2").click(function(){
//alert("The paragraph was clicked.");
//});
//var close = document.getElementById('#chatbox2').value;

})
