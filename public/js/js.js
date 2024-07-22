$('#searchbtn, #searchbar').mouseover(function(){
    $('#searchbar').show(2000);
});
$('#searchbar').focusin(function(){ 
    $('#searchbar').show(2000);
});
$('#searchbtn').mouseout(function(){
    $('#searchbar').hide(2000);
});
$('#searchbar').focusout(function(){
    $('#searchbar').hide(2000);
});
var mybutton = document.getElementById("myBtn");
var navToggle = document.getElementById("navToggle");
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {    
    // navToggle.style.backgroundImage = 'linear-gradient(to bottom, rgba(136,86,59,100), rgba(136,86,59,0))';
    mybutton.style.display = "block";
} else {   
    // navToggle.style.backgroundImage = 'linear-gradient(to bottom, rgba(136,86,59,0.5), rgba(136,86,59,0))';
    mybutton.style.display = "none";
}
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
 } 
function triggerClick(e) {
    document.querySelector('#profileImage').click();
}
function displayImage(e) {
    if (e.files[0]) {
        var reader = new FileReader();
            reader.onload = function(e){
                document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
            }
    reader.readAsDataURL(e.files[0]);
    }   
}