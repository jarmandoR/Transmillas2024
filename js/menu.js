$(document).ready(function(){
    $(".menu_a > li").click(function(e){
        var a = e.target.id;
        //desactivamos seccion y activamos elemento de menu
        $(".menu_a li.active").removeClass("active");
        $(".menu_a #"+a).addClass("active");
        //ocultamos divisiones, mostramos la seleccionada
        $(".content").css("display", "none");
        $("."+a).fadeIn();
    });
});