!function(e){var t={};function n(r){if(t[r])return t[r].exports;var a=t[r]={i:r,l:!1,exports:{}};return e[r].call(a.exports,a,a.exports,n),a.l=!0,a.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)n.d(r,a,function(t){return e[t]}.bind(null,a));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=50)}({50:function(e,t,n){e.exports=n(51)},51:function(e,t,n){n(52),n(53),$((function(){}))},52:function(e,t){var n=window.location.protocol+"//"+window.location.host+window.location.pathname+"/analyseParMois";$.get({url:n}).done((function(e){var t=JSON.parse(e),n=[];for(var r in nb_courbes=Object.keys(t).length,transp=1,t){var a=t[r];for(var o in valeurs=[],labels=[],a)labels.push(o),valeurs.push(a[o]);graphique={type:"line",label:r,data:valeurs,borderColor:"rgb(139, 64, 73,"+transp/nb_courbes+" )",backgroundColor:"rgb(139, 64, 73,"+transp/nb_courbes+" )",borderWidth:transp,order:transp/nb_courbes,radius:1,tension:.2,pointHoverRadius:10},transp+=1,n.push(graphique)}data={labels:labels,datasets:n};var l={data:data,options:{plugins:{title:{display:!0,text:"Nombre d'analyses mensuelles"}}}},i=$("#graph");new Chart(i,l)}))},53:function(e,t){var n=["#c6505a","#2a584f","#74a33f","#6eb8a8","#774448","#fcffc0","#2f142f","#ee9c5d"],r=window.location.protocol+"//"+window.location.host+window.location.pathname+"/analyseParEspece";$.get({url:r}).done((function(e){var t=JSON.parse(e),r=[],a=[];t.forEach((function(e,t){r.push(e.nom),a.push(e.total)})),data={labels:r,datasets:[{label:"essai",data:a,backgroundColor:n}]};var o={type:"pie",data:data,options:{plugins:{title:{display:!0,text:"Nombre d'analyses par espèces"}}}},l=$("#pie");new Chart(l,o)}))}});
//# sourceMappingURL=stats.js.map