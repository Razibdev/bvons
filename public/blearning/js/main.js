

if(window.innerWidth <= '960'){
    $(".search-btn-menu").click(function(){
        $("#menu-search-bar").toggle();
    });
}else{
    $(".search-btn-menu").click(function(){
        $("#menu-search-bar").toggle();
        $('.nav-link').toggle();
    });
}