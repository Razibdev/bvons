$(".show-login").click(function() {
    $("#login-form").toggle();
});


function closeBtn() {
    $("#login-form").css("display","none");
    $("#signup-form").css("display","none");
}

$('.signup-link').click(function(){
    $("#signup-form").toggle();
    $("#login-form").toggle();
});

$(".signin-link").click(function(){
    $("#login-form").toggle();
    $("#signup-form").toggle();
});
$(".small-search-icon").click(function() {
    $(".search-small").toggle();
    $(".logo").toggle();
});

$('.nav-icon-now').click(function () {
    $('.righ-bottm-menu').toggle();
});

$('#profile-view').click(function () {
    $('.profile').toggle();
});

$('.chairyok').click(function(){
    $(".charity-option").toggle();
});

$(".withdraw-re").click(function () {
    $(".withdraw-request").toggle();
    $(".withdraw-add").css("display","none");
});

$(".add-payment").click(function () {
    $(".withdraw-add").toggle();
    $(".withdraw-request").css("display", "none");
});


function crossButton() {
    $('.panel').css("display","none");
}




$('#dealer-part').click(function () {
    $('.dealer').toggle();
    $('.profile').css('display', 'none');
});
$('#dealer-view').click(function () {
    $('.dealer-option').toggle();
});


$('.you_are_not_dealer').click(function () {
    alert("You are not dealer! Please Apply Dealer request by our app");
});

$('.select-form-now-ok').click(function () {
    $('#transaction_now_ok').toggle();
});



$(document).ready(function() {
    $("input[name$='payment_method']").click(function() {
        var test = $(this).val();

        $("div.payment-fade-now").hide();
        $("#payment" + test).show();
    });
});

if(window.innerWidth <=960){

}else{
    document.addEventListener("DOMContentLoaded", function(){
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.getElementById('navbar_top').classList.add('fixed-top');
            } else {
                document.getElementById('navbar_top').classList.remove('fixed-top');
                document.body.style.paddingTop = '0';
            }
        });
    });
}





$(document).ready(function () {

    let suppermain = document.getElementsByClassName("tab-c")[0];
   
    let firstnowmain = document.getElementsByClassName("dealer-purchase")[0];

    let tabHeaders = document.querySelectorAll(".tab-c .tabs-header > div");
    let tabContents = document.querySelectorAll(".tab-c .tab-content > div");
    let tabContentsNow = document.querySelector(".tab-content");
    let codding = tabContentsNow.children;
    let tabcontentHeight = tabContentsNow.offsetHeight;
    let tabsHeight = document.getElementsByClassName("tabs-header")[0];
    const allBox=tabsHeight.children;
    const values = allBox.length;
    let value = "calc(100% /"+ values +")";


    var now = 0;
    for(let i=0; i<tabHeaders.length; i++){
        tabHeaders[i].addEventListener("click", function () {
            document.querySelector(".tab-c .tabs-header > .active").classList.remove("active");
            tabHeaders[i].classList.add("active");




             now = tabHeaders[i].offsetHeight * i;
            console.log(tabcontentHeight);
            tabContentsNow.style.marginTop = now+"px";
            suppermain.style.height = now+tabcontentHeight+"px";
            firstnowmain.style.height = now+tabcontentHeight+"px";


            if(window.innerWidth <= '960'){
                suppermain.style.height = now*2+tabcontentHeight*2+60+"px";
                tabContentsNow.style.height = now+tabcontentHeight*2+60+"px";

                firstnowmain.style.height = now*2+tabcontentHeight*2+60+"px";

            }

        })
    }

    codding.style.marginTop =now+"px";

});
