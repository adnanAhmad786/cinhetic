$(function(){$(".help-block").effect("pulsate",{times:7},1E4);$("#flashdatas .alert").delay(5E3).slideUp("fast");0<$("#search_page_ajax").length&&($("#search_page_ajax").autocomplete({minLength:2,scrollHeight:220,source:function(b,a){return $.ajax({url:$("#search_page_ajax").attr("data-url"),type:"get",dataType:"json",data:"word="+b.term,async:!0,cache:!0,success:function(b){return a($.map(b,function(a){return{nom:a.nom,url:a.url}}))}})},focus:function(b,a){$(this).val(a.item.nom);return!1},select:function(b,
a){window.location.href=a.item.url;return!1}}).data("ui-autocomplete")._renderItem=function(b,a){return $("<li></li>").data("ui-autocomplete-item",a).append('<a href="'+a.url+'">'+a.nom+"</span></a>").appendTo(b.addClass("list-row"))});0<$("#search_input").length&&($("#search_input").autocomplete({minLength:2,scrollHeight:220,source:function(b,a){return $.ajax({url:$("#search_input").attr("data-url"),type:"get",dataType:"json",data:"word="+b.term,async:!0,cache:!0,success:function(b){return a($.map(b,
function(a){return{nom:a.nom,url:a.url}}))}})},focus:function(b,a){$(this).val(a.item.nom);return!1},select:function(b,a){window.location.href=a.item.url;return!1}}).data("ui-autocomplete")._renderItem=function(b,a){return $("<li></li>").data("ui-autocomplete-item",a).append('<a href="'+a.url+'">'+a.nom+"</span></a>").appendTo(b.addClass("list-row"))});$(window).scroll(function(){return 100<=$(document).scrollTop()?$("body .navbar-default").stop(!0,!0).animate({opacity:0.8}):$("body .navbar-default").stop(!0,
!0).animate({opacity:1})});$("body .navbar-default").hover(function(){return $(this).stop(!0,!0).animate({opacity:1})},function(){if(100<=$(document).scrollTop())return $("body .navbar-default").stop(!0,!0).animate({opacity:0.8})});jQuery.fn.highlight=function(b,a){var c=RegExp(b,"gi");return this.each(function(){$(this).contents().filter(function(){return 3==this.nodeType&&c.test(this.nodeValue)}).replaceWith(function(){return(this.nodeValue||"").replace(c,function(b){return'<span class="'+a+'">'+
b+"</span>"})})})};var d=$("#search_input").val();$("#search_input").parents("#listmovies *").highlight(d,"highlight");$(".favoris_link").click(function(b){$obj=$(this);$.ajax({url:$(this).attr("data-url"),type:"get",dataType:"json",success:function(a){$obj.find("i").hasClass("fa-star")?$obj.find("i").attr("class","fa fa-star-o"):$obj.find("i").attr("class","fa fa-star")}})});$(".ishome").click(function(b){$obj=$(this);$.ajax({url:$(this).attr("data-url"),type:"get",dataType:"json",success:function(a){$obj.hasClass("athome")?
$obj.find("i").attr("class","pull-left glyphicon glyphicon-heart-empty"):$obj.find("i").attr("class","pull-left glyphicon glyphicon-heart")}})});$("#moresearch").click(function(){return $("#advancedsearch").toggleClass("hide","")});$(".datepicker").datepicker({format:"yyyy-mm-dd"});$("form").on("submit",function(b){$(this).find("button[type=submit]").attr("disabled","disabled");$(this).find("button[type=submit]").text("Envoi en cours...");return $("#overlay").removeClass("hide")});$("input[required]").on("blur",
function(b){if(0==$(this).val().length&&""==$(this).val())return $(this).addClass("parsley-error")});$("input[required]").on("keydown",function(b){return $(this).removeClass("parsley-error")});$(window).scroll(function(){return 100<$(this).scrollTop()?$(".scrollup").fadeIn():$(".scrollup").fadeOut()});return $(".scrollup").click(function(){$("html, body").animate({scrollTop:0},600);return!1})});
