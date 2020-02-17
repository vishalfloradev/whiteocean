$=jQuery;
$(function () {
    $('#main_navbar').bootnavbar();

	jQuery('.stellarnav').stellarNav({
        theme: 'dark',
        breakpoint: 960,
        position: 'right',
        phoneBtn: '',
        locationBtn: ''
    }); 

})
var rangeSlider = function(){
var slider = $('.range-slider'),
range = $('.range-slider__range'),
value = $('.range-slider__value');

slider.each(function(){

value.each(function(){
var value = $(this).prev().attr('value');
$(this).html(value);
});

range.on('input', function(){
$(this).next(value).html(this.value);
});
});
};  
rangeSlider();
document.addEventListener('touchmove', function(event) {
event.preventDefault();
}, false);
function myFunction() {
document.getElementById("myDropdown").classList.toggle("show");
}
            

$(window).scroll(function() {
if ($(this).scrollTop() >= 50) {         
$('#return-to-top').fadeIn(200);    
} else {
$('#return-to-top').fadeOut(200);  
}
});
$('#return-to-top').click(function() {     
$('body,html').animate({
scrollTop : 0                      
}, 500);
});


