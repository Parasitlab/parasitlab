!function(e){var t={};function a(i){if(t[i])return t[i].exports;var n=t[i]={i:i,l:!1,exports:{}};return e[i].call(n.exports,n,n.exports,a),n.l=!0,n.exports}a.m=e,a.c=t,a.d=function(e,t,i){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(a.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)a.d(i,n,function(t){return e[t]}.bind(null,n));return i},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="/",a(a.s=29)}({29:function(e,t,a){e.exports=a(30)},30:function(e,t){var a=$("#choisirFirst").attr("session"),i=[],n=window.location.protocol+"//"+window.location.host+window.location.pathname,o=$("#bouton_pdf").attr("href"),s=$("#src_img_espece").attr("lien");function r(e,t){$("#titre_observations").fadeIn(),a&&($("#choisirTuto").fadeIn(),a=!1);var i=n.replace("analyses/choisir","api/observations/"+e+"/"+t);$.get({url:i}).done((function(e){if(null!=e){lignes=JSON.parse(e);var t=[];$.each(lignes,(function(e,a){t.push(a.categorie_id)}));var a=Array.from(new Set(t));$.each(a,(function(e,t){$("#cat_"+t).fadeIn()})),$.each(lignes,(function(e,t){var a=null==t.autres?"":'<p class="ml-3 mb-0 p-1 pl-2 bordure-epaisse"><i>Autres causes&nbsp;: </i>'+t.autres+"</p>";$("#categorie_"+t.categorie_id).append('<div id="card_'+t.id+'" class="card borderless" categorie="'+t.categorie_id+'"><div id="observation_'+t.id+'" class="card-header observation list-group-item list-group-item-action disabled pointeur" selection="non" >'+t.intitule+'</div><div id="explication_'+t.id+'" class="collapse bg-bleu-tres-clair"><div class="card-body small"><p class="ml-3 mb-0 p-1 pl-2 bordure-epaisse">'+t.explication+"</p>"+a+"</div></div></div>")}))}})).fail((function(e){console.log("ERREUR: "+e)}))}function l(){$("#penser_veto").hide(),$("#autres_analyses").hide(),$("#boutons").hide(),$(".anatype").hide(),$(".anaacte").hide(),$(".listeanaactes").hide(),$(".optionstarifs").attr("state","closed"),$(".titre_analyses").hide(),$("#aucune_option").hide()}function c(e){$("#observation_"+e).attr("selection","non"),$("#observation_"+e).toggleClass("active").toggleClass("disabled"),$("#explication_"+e).removeClass("show")}$("#choisirExplicationBouton").on("click",(function(){$("#choisirExplication").hide(),$("#choisirEspece").fadeIn()})),$(".espece").on("click",(function(){$("#age").empty(),$("#input_age").val(""),$("#bouton_pdf").attr("href",o),$(".espece").css("filter","opacity(20%)"),$(this).css("filter","blur(0px)"),l(),$(".categorie").hide(),$(".liste_observations").empty(),i=[];var e=$(this).attr("id").split("_")[1],t=$(this).attr("espece");$("#input_espece").val(e);var a=n.replace("analyses/choisir","api/ages/"+e);$.get({url:a}).done((function(a){var i=JSON.parse(a);if(i.length>0){var n='<div class="my-3 p-3"><p class="lead">'+$("#age").attr("titre")+"</p>";$.each(i,(function(e,t){n+='<img id="ages_'+t.id+'" class="age img-zoom mr-3" src="'+s+"/"+t.icone.nom+'" alt="ages" data-toggle="tooltip" title="'+t.nom+'">'})),n+="</div>",$("#age").append(n),$(".age").on("click",(function(){var t=$(this).attr("id").split("_")[1];$("#input_age").val(t),$("#img_"+e).attr("src",$(this).attr("src")),$("#img_"+e).attr("title",$(this).attr("title")),$("#titre").empty().append($(this).attr("title")),$("#age").empty(),r("ages",t)}))}else $("#titre").empty().append(t),r("especes",e)}));var c=$(this).attr("name"),p=o.replace("espece",c);$("#bouton_pdf").attr("href",p);[],$(".liste_observations").each((function(e,t){i.push(null)}))})),$(".liste_observations").on("click",".card",(function(){var e,t=$(this).attr("id").split("_")[1],a=$("#observation_"+t).attr("selection"),n=$(this).parent().attr("id").split("_")[1];if("oui"==a)c(t),i[n-1]=null;else if("non"==a){if(null!=i[n-1])c(i[n-1]);i[n-1]=t,function(e){$("#observation_"+e).attr("selection","oui"),$("#observation_"+e).toggleClass("active").toggleClass("disabled"),$("#explication_"+e).addClass("show")}(t)}l(),$.each(i,(function(e,t){$("#input_"+(e+1)).val(t)})),e=(window.location.protocol+"//"+window.location.host+window.location.pathname).replace("analyses/choisir","api/options"),$("#choisirTuto").hide(),$.post({url:e,data:$("form").serialize(),datatype:"json"}).done((function(e){if(null!=e){var t=JSON.parse(e).anatypes,a=JSON.parse(e).anaactes;(function(e){var t=0;return e.forEach((function(e){t+=null==e?0:1})),t})(i)>0?(0==t.length?$("#aucune_option").show():($.each(t,(function(e,t){$("#anatype_"+t).attr("keep","true").fadeIn()})),1==t.length?$("#une").fadeIn():$("#deux").fadeIn(),$.each(a,(function(e,t){$("#anaacte_"+t).fadeIn()}))),5==$("#input_espece").val()&&$("#autres_analyses").fadeIn(2e3)):l()}})).fail((function(e){console.log(e)})),window.scrollTo(200,250)})),$("#avousdejouer").on("click",(function(){$("#choisirTuto").fadeOut(),window.scrollTo(200,250)})),$(".optionstarifs").on("click",(function(){var e,t=$(this).attr("id").split("_")[1];"opened"==$(this).attr("state")?($("#listeanaactes_"+t).hide(),$("#optionstarifs_"+t).attr("state","closed"),$(".anatype[keep='true']").removeClass("estompe"),$(".anatype[keep='true'] img").show(),$(".anatype[keep='true'] button").removeClass("btn-clair"),$("#boutons").hide(),$("#penser_veto").hide()):($(".anatype[keep='true']").addClass("estompe"),$(".anatype[keep='true'] img").hide(),$(".anatype[keep='true'] button").addClass("btn-clair"),e="#anatype_"+t,$(e).removeClass("estompe"),$(e+" img").show(),$(e+" button").removeClass("btn-clair"),$(".listeanaactes").hide(),$(".optionstarifs").attr("state","closed"),$(this).attr("state","opened"),$("#listeanaactes_"+t).fadeIn(1e3),$("#boutons").fadeIn(1500),$("#penser_veto").fadeIn(3e3),window.scrollTo(200,250))}))}});
//# sourceMappingURL=choisir.js.map