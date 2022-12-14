var url_actuelle = window.location.protocol + "//" + window.location.host + window.location.pathname; // récupère l'adresse de la page actuelle

var url = url_actuelle + '/analyseParMois';

$.get({
  url: url,

})
.done(function(datas) {
  var donnees = JSON.parse(datas);
  var graphiques = [];
  nb_courbes = Object.keys(donnees).length;
  transp = 1; // indice de transparence de la courbe
  for(const annee in donnees) {
    var serie = donnees[annee];
    valeurs = [];
    labels = [];
    for(const mois in serie) {
      labels.push(mois);
      valeurs.push(serie[mois]);
    }
    graphique = {
      type: 'line',
      label: annee,
      data: valeurs,
      borderColor: 'rgb(139, 64, 73,' + transp/nb_courbes + ' )',
      backgroundColor: 'rgb(139, 64, 73,' + transp/nb_courbes + ' )',
      borderWidth: transp,
      order: transp/nb_courbes,
      radius: 1,
      tension: 0.2,
      pointHoverRadius: 10,
    };
    transp += 1
    graphiques.push(graphique);
  }
  data = {
    labels: labels,
    datasets: graphiques
  };
  const config = {
    data: data,
    options: {
      plugins:  {
        title: {
          display: true,
          text: "Nombre d'analyses mensuelles"
        }
      }
    }
  };

  const ctxt = $("#graph");

  const graph = new Chart(
    ctxt,
    config
  );
})
