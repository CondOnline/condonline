function collapse_verify(){setTimeout((function(){$("body").hasClass("sidebar-collapse")?$("#condominium_name").addClass("d-none"):$("#condominium_name").removeClass("d-none")}),1)}$.fn.select2.defaults.set("language","pt-BR"),$(document).ready((function(){$("form").submit((function(e){$("button").attr("disabled","disabled"),$("button").text("Aguarde...")}))})),$(".content-wrapper").bind("click mouseover","#link",(function(){$("body").hasClass("sidebar-collapse")&&!$("aside").hasClass("sidebar-focused")&&$("#condominium_name").addClass("d-none")})),$(".main-sidebar").mouseenter((function(){$("body").hasClass("sidebar-collapse")&&$("#condominium_name").removeClass("d-none")}));