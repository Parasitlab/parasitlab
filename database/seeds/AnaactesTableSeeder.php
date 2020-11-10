<?php

use Illuminate\Database\Seeder;

class AnaactesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      DB::table('anaactes')->truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');

      DB::table('anaactes')->insert([
        [
          'id' => 1,
          'num' => "1.a",
          'abbreviation' => "indiv.",
          'nom' => "analyse individuelle (1 animal)",
          'description' => "C'est une analyse conseillée, quand vous voulez connaître la situation d'une seul animal",
          'anatype_id' => 1,
          'estSerie' => false,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 9,
          'pu_ht' => 14.60,
          'tva_id' => 1,
        ],
        [
          'id' => 2,
          'num' => "1.b",
          'abbreviation' => "mélange de 5",
          'nom' => "analyse de mélange (5 animaux maximum)",
          'description' => "Une analyse de mélange, vous permettra d'évaluer la situation d'un groupe à moindre coût.",
          'anatype_id' => 1,
          'estSerie' => false,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 9,
          'pu_ht' => 16.90,
          'tva_id' => 1,
        ],
        // [
        //   'id' => 3,
        //   'num' => "1.c",
        //   'abbreviation' => "pack 3 anal.",
        //   'nom' => "pack de 3 échantillons individuels",
        //   'description' => "Cette analyse vous donnera une indication sur la situation des animaux pour lesquels vous soupçonnez du parasitisme",
        //   'anatype_id' => 1,
        //   'estSerie' => false,
        //   'estAnalyse' => true,
        //   'estTarif' => true,
        //   'icone_id' => 9,
        //   'pu_ht' => 35.00,
        //   'tva_id' => 1,
        // ],
        [
          'id' => 4,
          'num' => "1.d",
          'abbreviation' => "suivi annuel",
          'nom' => "pack de suivi annuel (4 envois de 3 échantillons)",
          'description' => "Il s'agit là du meilleur outil pour suivre la situation de votre troupeau pendant la mise en place d'une gestion du pâturage.",
          'anatype_id' => 1,
          'estSerie' => true,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 9,
          'pu_ht' => 130.00,
          'tva_id' => 1,
        ],
        [
          'id' => 3,
          'num' => "1.c",
          'abbreviation' => "multiple",
          'nom' => "analyses individuelles multiples",
          'description' => "Si vous souhaitez des analyses individuelles sur plusieurs animaux",
          'anatype_id' => 1,
          'propPrelev' => true,
          'estSerie' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 9,
          'pu_ht' => 11.00,
          'tva_id' => 1,
        ],
        [
          'id' => 5,
          'num' => "2.a",
          'abbreviation' => "indiv.",
          'nom' => "analyse individuelle (1 animal)",
          'description' => "C'est une analyse conseillée, quand vous voulez connaître la situation d'une seul animal, tout en prenant en compte une évenutelle présence de petite douve en plus des strongles gastro-intestinaux",
          'anatype_id' => 2,
          'estSerie' => false,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 32,
          'pu_ht' => 15.50,
          'tva_id' => 1,
        ],
        [
          'id' => 6,
          'num' => "2.b",
          'abbreviation' => "melange de 5",
          'nom' => "analyse de mélange (5 animaux maximum))",
          'description' => "Une analyse de mélange, vous permettra d'évaluer la situation d'un groupe à moindre coût, tout en prenant en compte une évenutelle présence de petite douve en plus des strongles gastro-intestinaux ",
          'anatype_id' => 2,
          'estSerie' => false,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 32,
          'pu_ht' => 21.00,
          'tva_id' => 1,
        ],
        [
          'id' => 7,
          'num' => "2.c",
          'abbreviation' => "pack 3 anal.",
          'nom' => "pack de 3 échantillons individuels.",
          'description' => "Cette analyse vous donnera une indication sur la situation des animaux pour lesquels vous soupçonnez du parasitisme gastro-intestinal, y compris de la petite douve.",
          'anatype_id' => 2,
          'estSerie' => false,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 32,
          'pu_ht' => 38.00,
          'tva_id' => 1,
        ],
        [
          'id' => 8,
          'num' => "2.d",
          'abbreviation' => "suivi annuel",
          'nom' => "Pack suivi annuel (4 envois de 3 échantillons par an)",
          'description' => "Il s'agit là du meilleur outil pour suivre la situation de votre troupeau vis-à-vis des parasites intestinaux et de la petite douve, pendant la mise en place d'une gestion du pâturage.",
          'anatype_id' => 2,
          'estSerie' => true,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 32,
          'pu_ht' => 140.00,
          'tva_id' => 1,
        ],
        [
          'id' => 9,
          'num' => "3.a",
          'abbreviation' => "indiv.",
          'nom' => "analyse individuelle (1 animal)",
          'description' => "C'est une bonne analyse si vous soupçonnez de la bronchite vermineuse chez un animal",
          'anatype_id' => 3,
          'estSerie' => false,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 10,
          'pu_ht' => 10.30,
          'tva_id' => 1,
        ],
        [
          'id' => 10,
          'num' => "3.b",
          'abbreviation' => "mélange de 5",
          'nom' => "analyse de mélange (5 animaux maximum)",
          'description' => "C'est une bonne analyse si vous soupçonnez de la bronchite vermineuse chez dans un groupe d'animaux",
          'anatype_id' => 3,
          'estSerie' => false,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 10,
          'pu_ht' => 13.00,
          'tva_id' => 1,
        ],
        [
          'id' => 11,
          'num' => "4.a",
          'abbreviation' => "mélange de 5",
          'nom' => "analyse de mélange (5 animaux maximum)",
          'description' => "C'est l'analyse de choix si vous êtes dans un contexte d'infestation possible par la grande douve ou le paramphistome (zones humides, bordure de ruisseaux, saisies de foies à l'abattoir).",
          'anatype_id' => 4,
          'estSerie' => false,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 31,
          'pu_ht' => 19.50,
          'tva_id' => 1,
        ],
        [
          'id' => 12,
          'num' => "5.a",
          'abbreviation' => "mélange",
          'nom' => "analyse de mélange (5 animaux maximum)",
          'description' => "C'est une analyse innovante qui, en quantifiant la proportion d'<i>Haemonchus contortus</i> parmi les strongles digestifs, vous permettra d'avoir une meilleure appréciation du risque encouru par vos animaux.",
          'anatype_id' => 5,
          'estSerie' => false,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 15,
          'pu_ht' => 49.95,
          'tva_id' => 1,
        ],
        [
          'id' => 13,
          'num' => "6.a",
          'abbreviation' => "2 anal.",
          'nom' => "Analyses coprologiques de mélange avant et après vermifuge (5 à 8 animaux)",
          'description' => "Ce test est une bonne approche si vous soupçonnez l'existence d'une résistance des strongles de votre troupeau vis-à-vis des vermifuges.
            C'est aussi une façon d'évaluer le risque d'introduire des parasites résistants avec l'achat d'un animal.",
          'anatype_id' => 6,
          'estSerie' => true,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 23,
          'pu_ht' => 50.00,
          'tva_id' => 1,
        ],
        [
          'id' => 14,
          'num' => "7.a",
          'abbreviation' => "kit envoi",
          'nom' => "kit d'echantillonnage pré-affranchi",
          'description' => "pack pour l'envoi des prélèvements avec l'affranchissement",
          'anatype_id' => 7,
          'estSerie' => false,
          'propPrelev' => false,
          'estAnalyse' => false,
          'estTarif' => true,
          'icone_id' => 24,
          'pu_ht' => 9.00,
          'tva_id' => 1,
        ],
        [
          'id' => 15,
          'num' => "1.e",
          'abbreviation' => "pack 3 anal.",
          'nom' => "pack de 3 échantillons de mélanges (5 animaux)",
          'description' => "C'est une analyse assez complète qui vous fournira une estimation des différents niveaux d'infestation au sein de votre troupeau en fonction de l'âge ou de l'état des animaux.",
          'anatype_id' => 1,
          'estSerie' => false,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 9,
          'pu_ht' => 42.00,
          'tva_id' => 1,
        ],
        [
          'id' => 16,
          'num' => "2.e",
          'abbreviation' => "pack 3 anal.",
          'nom' => "pack de 3 échantillons de mélange (5 animaux)",
          'description' => "C'est une analyse assez complète qui vous fournira une estimation des différents niveaux d'infestation par les strongles digestifs <strong>et la petite douve</strong> au sein de votre troupeau en fonction de l'âge ou de l'état des animaux.",
          'anatype_id' => 2,
          'estSerie' => false,
          'propPrelev' => false,
          'estAnalyse' => true,
          'estTarif' => true,
          'icone_id' => 32,
          'pu_ht' => 45.00,
          'tva_id' => 1,
        ],
        // [
        //   'id' => 5,
        //   'abbreviation' => "INTE",
        //   'nom' => "interprétation des résultats",
        //   'description' => "coût pour la lecture et l'interprétation des résultats",
        //   'estAnalyse' => false,
        //   'anatype_id' => false,
        //   'estTarif' => false,
        //   'icone_id' => 17,
        //   'pu_ht' => 15,
        //   'tva_id' => 1,
        // ],
        // [
        //   'id' => 6,
        //   'abbreviation' => "VISI",
        //   'nom' => "visite d'élevage",
        //   'description' => "coût pour une visite d'élevage parasito (frais de déplacement en supplément)",
        //   'anatype_id' => false,
        //   'estAnalyse' => false,
        //   'estTarif' => false,
        //   'icone_id' => 18,
        //   'pu_ht' => 150,
        //   'tva_id' => 1,
        // ],
        // [
        //   'id' => 7,
        //   'abbreviation' => "DEPL",
        //   'nom' => "frais de déplacement (par km)",
        //   'description' => "frais de déplacement pour une visite au kilometre réel",
        //   'anatype_id' => false,
        //   'estAnalyse' => false,
        //   'estTarif' => false,
        //   'icone_id' => 19,
        //   'pu_ht' => 0.5,
        //   'tva_id' => 1,
        // ],
        // [
        //   'id' => 8,
        //   'abbreviation' => "MELA",
        //   'nom' => "réalisation du mélange",
        //   'description' => "coût supplémentaire pour réaliser un mélange avec des prélèvements individuels",
        //   'anatype_id' => false,
        //   'estAnalyse' => false,
        //   'estTarif' => true,
        //   'icone_id' => 20,
        //   'pu_ht' => 5,
        //   'tva_id' => 1,
        // ],
      ]);
    }
}
