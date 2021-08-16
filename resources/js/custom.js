$(document).ready( function () {
    alert("Testando Deploy");
});

$.fn.select2.defaults.set('language', 'pt-BR');

$(document).ready(function(){
    $("form").submit(function(event){
        $("button").attr('disabled', 'disabled');
        $("button").text("Aguarde...");
    });
});

$(".content-wrapper").bind('click mouseover', '#link', function() {
    if ($("body").hasClass("sidebar-collapse") && !$("aside").hasClass("sidebar-focused")) {
        $("#condominium_name").addClass('d-none');
    }
});

$(".main-sidebar").mouseenter(function(){
    if ($("body").hasClass("sidebar-collapse")) {
        $("#condominium_name").removeClass('d-none');
    }
});

function collapse_verify() {
    setTimeout(function() {
        if (!$("body").hasClass("sidebar-collapse")) {
            $("#condominium_name").removeClass('d-none');
        } else {
            $("#condominium_name").addClass('d-none');
        }
    }, 1);
}
