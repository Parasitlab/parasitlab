!function(e){var t={};function n(o){if(t[o])return t[o].exports;var i=t[o]={i:o,l:!1,exports:{}};return e[o].call(i.exports,i,i.exports,n),i.l=!0,i.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var i in e)n.d(o,i,function(t){return e[t]}.bind(null,i));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=27)}({27:function(e,t,n){e.exports=n(28)},28:function(e,t){var n=[],o=$("#bouton_pdf").attr("href");function i(){$("#penser_veto").hide(),$("#boutons").hide(),$(".option").hide(),$(".anaacte").hide(),$(".titre_analyses").hide(),$("#aucune_option").empty(),$("#aucune_analyse").empty()}function a(e){$("#observation_"+e).attr("selection","non"),$("#observation_"+e).toggleClass("active").toggleClass("disabled"),$("#explication_"+e).removeClass("show")}$(".espece").on("click",(function(){$("#bouton_pdf").attr("href",o),$(".espece").css("filter","opacity(20%)"),$(this).css("filter","blur(0px)"),i(),$(".categorie").hide(),$(".liste_observations").empty(),n=[];var e=$(this).attr("id").split("_")[1];$("#input_espece").val(e);var t=(window.location.protocol+"//"+window.location.host+window.location.pathname).replace("analyses/choisir","api/observations/"+e),a=$(this).attr("name"),r=o.replace("espece",a);$("#bouton_pdf").attr("href",r),$("#titre_observations").attr("espece",e).fadeIn(),function(e){$.get({url:e}).done((function(e){null!=e&&(lignes=JSON.parse(e),$(".categorie").fadeIn(),$.each(lignes,(function(e,t){var n=null==t.autres?"":'<p class="ml-3 mb-0 p-1 pl-2 bordure-epaisse"><i>Autres causes&nbsp;: </i>'+t.autres+"</p>";$("#categorie_"+t.categorie_id).append('<div id="card_'+t.id+'" class="card borderless" categorie="'+t.categorie_id+'"><div id="observation_'+t.id+'" class="card-header observation list-group-item list-group-item-action disabled pointeur" selection="non" >'+t.intitule+'</div><div id="explication_'+t.id+'" class="collapse bg-bleu-tres-clair"><div class="card-body small"><p class="ml-3 mb-0 p-1 pl-2 bordure-epaisse">'+t.explication+"</p>"+n+"</div></div></div>")})))})).fail((function(e){console.log("ERREUR: "+e)}))}(t);[],$(".liste_observations").each((function(e,t){n.push(null)}))})),$(".liste_observations").on("click",".card",(function(){var e,t=$(this).attr("id").split("_")[1],o=$("#observation_"+t).attr("selection"),r=$(this).parent().attr("id").split("_")[1];if("oui"==o)a(t),n[r-1]=null;else if("non"==o){if(null!=n[r-1])a(n[r-1]);n[r-1]=t,function(e){$("#observation_"+e).attr("selection","oui"),$("#observation_"+e).toggleClass("active").toggleClass("disabled"),$("#explication_"+e).addClass("show")}(t)}i(),$.each(n,(function(e,t){$("#input_"+(e+1)).val(t)})),e=(window.location.protocol+"//"+window.location.host+window.location.pathname).replace("analyses/choisir","api/options"),$.post({url:e,data:$("form").serialize(),datatype:"json"}).done((function(e){if(null!=e){var t=JSON.parse(e).options,o=JSON.parse(e).anaactes;(function(e){var t=0;return e.forEach((function(e){t+=null==e?0:1})),t})(n)>0?(0==t.length?$("#aucune_option").append("<p class=\"lead alert-warning p-3\">Désolé... Nous n'avons aucune proposition d'analyses pour cette situation car ce parasite n'est pas détectable par coproscopie.</p>"):($.each(t,(function(e,t){$("#"+t+".option").fadeIn()})),1==o.length?$("#une").fadeIn():$("#deux").fadeIn(),$.each(o,(function(e,t){$("#anaacte_"+t).fadeIn()}))),$("#boutons").fadeIn(1e3),$("#penser_veto").fadeIn(2e3)):i()}}))}))}});
//# sourceMappingURL=choisir.js.map