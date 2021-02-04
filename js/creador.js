jQuery(document).ready(function($) {
    paginador();
    a = 1;
    $('.btnP').click(function(event) {
        a = $(this).attr('var');
        hi();
        var vp = ".pag-"+a;
        $(".pag").hide();
        $(vp).show();
    });



    $(".r").click(function(event) {
        a--;
        $(".pag").hide();
        var vp = ".pag-"+a;
        $(vp).show();
        hi();
    });

    $(".l").click(function(event) {
        a++;
        $(".pag").hide();
        var vp = ".pag-"+a;
        $(vp).show();
        hi();
        $(".btnP").removeClass('activo');
        var jc = ".btnP-"+a;
        $(jc).addClass('activo')
    });

    $("#bq").keyup(function(event) {
        $("#bqC").show();
        $(".pagination").hide();
        $("#bqC").click(function(event) {
            $("#bq").val("");
            paginador();
            $(".pagination").show();
            $(this).hide();
        });
        var bq = new RegExp($(this).val(), 'i');
        $('.result > tr').hide();
        $('.result > tr').filter(function(index) {
            return bq.test($(this).text());
        }).show();

    });
});
function hi () {
    var pag = $(".btnP:last").html();
    $(".l").show();
    $(".r").show();
    if (a == 1) {
        $(".r").hide();

    }else if(a == pag){
        $(".l").hide();

    }
}

function paginador () {
$(".pag").hide();
$(".pag-1").show();
var a = 1;
var i = 1;
var h = 1;
var ht = "<li><a href='#' class='r'>&larr; Antras</a></li>";
$(".result > .pag").each(function(index, el) {
    if(i == 1){
        ht = ht + "<li><a href='#' class='btnP btnP-"+h+"' var='"+h+"'>"+h+"</a></li>";
    }else if (i == 5){
        i = 0;
        h++;
    }
     i++;
});
ht = ht + "<li><a href='#' class='l'>Siguiente &rarr;</a></li>";
$(".pagination").html(ht);
$(".r").hide();

}
