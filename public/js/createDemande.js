!function(e){var t={};function a(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,a),o.l=!0,o.exports}a.m=e,a.c=t,a.d=function(e,t,n){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)a.d(n,o,function(t){return e[t]}.bind(null,o));return n},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="/",a(a.s=27)}({27:function(e,t,a){e.exports=a(28)},28:function(e,t,a){a(29),a(30),a(31)},29:function(e,t){$("#userSelect").focus(),$(".liste_anatypes").hide();var a=window.location.protocol+"//"+window.location.host+window.location.pathname,n=!1;function o(e,t,a){$(".date_alerte").hide();var n=Date.now();n-e<0?$(t+"_futur").show():n-e>864e6?$(t+"_passe").show():($(t+"_ok").show(),$(a).focus())}function i(){if(""!==$("#prelevement").val()&&""!==$("#reception").val()){var e=Date.parse($("#prelevement").val());Date.parse($("#reception").val())-e<0?($(".date_ok").hide(),$("#reception_prelevement").show()):$(".date_ok").show()}}function r(e){var t=a.replace("laboratoire/demandes/create","api/anatypes/"+e);$.get({url:t}).done((function(e){var t=JSON.parse(e);$(".liste_anatypes").hide(),$.each(t,(function(e,t){$("#anatypes_"+t).show()}))}))}$("select[name='userDemande']").change((function(){if($(".listeSerie").remove(),$("#anatypeSelect").removeClass("is-invalid"),$("#typeAlerte").hide(),"Nouveau"==$("select[name='userDemande'] > option:selected").val()){var e=$("select[name='userDemande'] > option:selected"),t=a.replace("demandes","user");$.confirm({theme:"dark",type:"red",typeAnimated:"true",title:e.attr("titre"),content:e.attr("texte"),buttons:{oui:{text:"oui",btnClass:"btn-red",action:function(){window.location=t}},non:function(){}}})}else $("#userSelect > options:selected").attr("id"),$(this).removeClass("is-invalid").addClass("is-valid"),n?($("#especeSelect").addClass("is-valid"),r(n),$("#prelevement").focus()):$("#especeSelect").focus()})),$("#especeSelect").on("change",(function(){if(n=$("#especeSelect > option:selected").attr("id"),""==$("#userSelect > option:selected").val())$("#userSelect").focus().addClass("is-invalid"),$(".liste_anatypes").hide();else{var e=$("#especeSelect > option:selected").attr("id");$(this).addClass("is-valid"),$("#prelevement").focus(),r(e)}})),$("#prelevement").on("change",(function(){$(".date_alerte").hide(),id_actuel="#"+$(this).attr("id"),o(Date.parse($(this).val()),id_actuel,"#reception"),i()})),$("#reception").on("change",(function(){$(".date_alerte").hide(),id_actuel="#"+$(this).attr("id"),o(Date.parse($(this).val()),id_actuel,"#anatypeSelect"),i()}))},30:function(e,t){var a=window.location.protocol+"//"+window.location.host+window.location.pathname;function n(e){$("#premierPrelevementSerie").val(null),$("#estSerie").addClass("d-none"),$(".listeSerie").remove();var t=$("#especeSelect").children("option:selected").attr("id"),n=a.replace("laboratoire/demandes/create","api/anaactes/"+e+"/"+t);$("#anaacteSelect").children().remove(),$.get({url:n}).done((function(e){var t=JSON.parse(e),a="";$.each(t,(function(e,t){var n;a+='<option value="'+t.id+'">'+(((n=t.nom)+"").charAt(0).toUpperCase()+n.substr(1))+"</option>"})),$("#anaacteSelect").append(a),1==t.length&&($("#anaacteSelect").children().attr("selected","selected"),o($("#anaacteSelect > option:selected").val(),$("#userSelect > option:selected").attr("id")))}))}function o(e,t){var n=a.replace("laboratoire/demandes/create","api/estSerie/"+e+"/"+t);console.log(n),$.get({url:n,data_type:"json"}).done((function(e){$("#premier").empty();var t=JSON.parse(e);if(1==t.estSerie)if($("#estSerie").removeClass("d-none"),$("#premierPrelevementSerie").val("premier"),0!=t.nbDemandes){$("#pas_de_serie").hide(),$("#y_a_serie").show();for(var a=0;a<t.nbDemandes;a++)$("#premier").append('<div class="form-check"><input type="radio" class="form-check-input"  id="premierPrelevementSerie" name="serie" value="null" checked ><label class="form-check-label" for="premierPrelevementSerie">'+$("#premier_envoi").attr("texte")+'</label></div><div class="form-check mt-2"><input type="radio" class="form-check-input" id="serie_'+t[a].id+'" name="serie" value="'+t[a].id+'"><label class="form-check-label" for="demande_id">'+$("#autre").attr("texte")+" "+t[a].date_reception+"</label></div>")}else $("#y_a_serie").hide(),$("#pas_de_serie").show();else $("#premierPrelevementSerie").val(null),$("#estSerie").addClass("d-none"),$(".listeSerie").remove()})).fail((function(e){console.log("ça merde !")}))}n($("#anatypeSelect > option:selected").val()),$("#anatypeSelect").on("focus",(function(){""==$("#userSelect > option:selected").val()&&($(this).addClass("is-invalid"),$("#typeAlerte").show(),$("#userSelect").focus())})),$("#anatypeSelect").on("change",(function(){n($(this).children("option:selected").val()),$(this).addClass("is-valid"),$("#anaacteSelect").focus()})),$("select[name='anaacte_id'] ").on("change",(function(){$(".listeSerie").remove(),o($("#anaacteSelect > option:selected").val(),$("#userSelect > option:selected").attr("id"))}))},31:function(e,t){var a=$("input[name='nbPrelevements']").val();$(".lignePrelevement").each((function(e){e<a&&($("#lignePrelevement_"+(e+1)).removeClass("d-none").addClass("d-flex"),$("input[name="+("identification_"+(e+1))+"]").attr("required",!0))})),$("input[name='nbPrelevements']").on("change",(function(e){a=$("input[name='nbPrelevements']").val(),$(".lignePrelevement").removeClass("d-flex").addClass("d-none"),$(".identification").attr("required",!1),$(".lignePrelevement").each((function(e){e<a&&($("#lignePrelevement_"+(e+1)).removeClass("d-none").addClass("d-flex"),$("input[name="+("identification_"+(e+1))+"]").attr("required",!0))}))}));$("#toVeto").prop("checked");function n(e){e?($("#choixDuVeto").removeClass("d-none").addClass("d-block"),$("#iconeVeto").addClass("d-none").removeClass("d-block")):($("#choixDuVeto").addClass("d-none").removeClass("d-block"),$("#iconeVeto").removeClass("d-none").addClass("d-block"))}n($("#toVeto").prop("checked")),$("#toVeto").on("change",(function(){n($("#toVeto").prop("checked"))})),$("#radioBtn a").on("click",(function(){var e=$(this).data("title"),t=$(this).data("toggle");$("#"+t).prop("value",e),$('a[data-toggle="'+t+'"]').not('[data-title="'+e+'"]').removeClass("active").addClass("notActive"),$('a[data-toggle="'+t+'"][data-title="'+e+'"]').removeClass("notActive").addClass("active")}))}});
//# sourceMappingURL=createDemande.js.map