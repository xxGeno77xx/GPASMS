@php
use App\Models\Staff;

  $staffMember = Staff::find($record->staff_id);
  $group = $staffMember->group;
  $matricule = $staffMember->legacy_id;

  $totalchefImmediat= collect([$record->assiduite1, $record->commerciale1, $record->connaissance1, $record->encadrement1, $record->promptitude1])->sum();

  $totalHierarchie1 = collect([$record->assiduite2, $record->commerciale2, $record->connaissance2, $record->encadrement2, $record->promptitude2])->sum();

  $totalHierarchie2= collect([$record->assiduite3, $record->commerciale3, $record->connaissance3, $record->encadrement3, $record->promptitude3])->sum();
  
@endphp
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ed2a18f3-9d47-41c0-8790-f004b9fb45e5</title>
  <style type="text/css">


    
    * {
      margin: 0.5cm;
    }

    .s1,
    s4,
    s7,
    s12,
    s17,
    s20,
    s21,
    s22,
    s23,
    s24,
    s25,
    s26,
    s27,
    s28,
    s29,
    s30,
    s31,
    s32,
    s34,
    s35,
    s36,
    s37,
    s38,
    s39,
    s40,
    s41,
    s42,
    s43,
    s44,
    s45,
    s46,
    s47s48s49 {
      color: #4b97ef;
      font-family: "Times New Roman", serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 8pt;
    }


    .datalist {
      padding-left: 44pt;
      text-indent: -19pt;
      line-height: 12pt;
      text-align: left;

    }



    p {
      color: black;
      font-family: Cambria, serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 10pt;
      margin: 0pt;
    }

    li {
      display: block;
    }

    #l1 {
      padding-left: 0pt;
      counter-reset: c1 1;
    }

    #l1>li>*:first-child:before {
      counter-increment: c1;
      content: "(" counter(c1, decimal) ") ";
      color: black;
      font-family: Cambria, serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 10pt;
    }

    #l1>li:first-child>*:first-child:before {
      counter-increment: c1 0;
    }

     
    tbody {
      vertical-align: top;
    }

    table{
      width: 100%;
    }
    
  </style>
</head>

<body>

  <div style="position: absolute; top: 0; left: -5pt; padding-left: 0pt; z-index: 10;">
    <!-- Colonne 1 : Logo -->
    <span><img width="115" height="110" alt="logo_poste" src="images/logo_poste.jpg" /></span>
  </div>
  
  

  <div style="width: 100%; text-align: center;">

    
    <div style="display: inline-block; vertical-align: top; width: 35%; padding-left: 30pt;">
      <!-- Colonne 2 : Informations de l'entreprise -->
      <p class="s4" style="line-height: 24pt; text-align: left;">
        SOCIETE DES POSTES DU TOGO
      </p>
      <p class="s7" style="line-height: 11pt; text-align: left;">
        B.P. 2626 — Tel. : 22.21.44.03 Lomé TOGO
      </p>
    </div>
  
 
  
    <div style="display: inline-block; vertical-align: top; width: 25%; text-align: center;">
      <!-- Colonne 4 : République Togolaise -->
      <p class="s17" style="line-height: 24pt;">
        REPUBLIQUE TOGOLAISE
      </p>
      <p class="s20" style="line-height: 9pt;">
        Travail - Liberté - Patrie
      </p>
    </div>
  </div>
  
  <br>
  
  
    <!-- Colonne 3 : Feuille de notation -->
    <p class="s12" style="text-align: left; padding-left: 5pt;">
      Feuille de notation du personnel du Groupe {{$group}} ({{$group}}1, {{$group}}2, {{$group}}3) <span style="text-align: left; padding-left: 150pt;">ANNEE: </span> 
    </p>

  <table style="margin-left: 3pt; border-collapse: collapse; " cellspacing="0">
    <tr>
      <td style="border: 1pt solid #3f3b3b;" colspan="6">
        <p class="s23" style="padding-top: 2pt; padding-left: 8pt; line-height: 12pt; text-align: left;">
          N° matricule: {{$matricule}} <span style="margin-left: 120pt;"> Direction: </span>
        </p>
        <p class="s23" style="padding-top: 2pt; padding-left: 8pt; line-height: 12pt; text-align: left;">
          Nom: <span style="margin-left: 152.5pt;"> Division: </span>
        </p>
        <p class="s23" style="padding-top: 2pt; padding-left: 8pt; line-height: 12pt; text-align: left;">
          Prénoms: <span style="margin-left: 120pt;"> Section: </span>
        </p>
        <p class="s23" style="padding-top: 2pt; padding-left: 8pt; line-height: 12pt; text-align: left;">
          Date D'embauche: <span style="margin-left: 120pt;"> Fonction: </span>
        </p>
        <p class="s23" style="padding-top: 2pt; padding-left: 8pt; line-height: 12pt; text-align: left;">
          Groupe: <span style="margin-left: 120pt;"> Classe: </span> <span style="margin-left: 1pt;"> Echelon: </span> <span style="margin-left: 1pt;"> Poste occuppé: </span>
        </p>
        <p class="s23" style="padding-top: 2pt; padding-left: 8pt; line-height: 12pt; text-align: left;">
          Date du dernier avancement: <span style="margin-left: 120pt;"> Indice: </span>
        </p>
      </td>
     
    </tr>
    <tr style="height: 9pt">
      <td style="
            border-top-style: solid;
            border-top-width: 1pt;
            border-top-color: #3f3b3b;
            border-left-style: solid;
            border-left-width: 1pt;
            border-left-color: #3f3b3b;
            border-bottom-style: solid;
            border-bottom-width: 1pt;
            border-bottom-color: #3f3b3b;
border-right-style: solid;
            border-right-width: 1pt;
          " colspan="6">
      </td>
    </tr>
    <tr style="height: 18pt">
      <td style="
            width: 534pt;
            border: 1pt solid #3f3b3b;

          " colspan="6">
        <p class="s24" style="
              padding-top: 2pt;
              padding-right: 2pt;
              text-indent: 0pt;
              text-align: center;
            ">
          CADRE RESERVE AU CHEF DU PERSONNEL
        </p>
      </td>
    </tr>
    <tr style="height: 17pt">
      <td style="
            width: 534pt;
            border: 1pt solid #3f3b3b;

          " colspan="6">
        <p class="s24" style="
              padding-top: 1pt;
              padding-right: 2pt;
              text-indent: 0pt;
              text-align: center;
            ">
          SANCTIONS ENCOURUES PAR
          L&#39;AGENT AU COURS DE L&#39;ANNEE
        </p>
      </td>
    </tr>
    <tr style="height: 50pt">
      <td style="
            width: 134pt;
            border: 1pt solid #3f3b3b;

          " colspan="2">
        <p class="s32" style="
              padding-top: 2pt;
              padding-left: 31pt;
              text-indent: 0pt;
              text-align: left;
            ">
          Avertissement (s)
        </p>
        <p class="s33" style="
              padding-top: 5pt;
              padding-left: 6pt;
              text-indent: 0pt;
              text-align: left;
            ">
          Date (s)
        </p>
      </td>
      <td style="
            width: 135pt;
            border: 1pt solid #3f3b3b;

          " colspan="2">
        <p class="s32" style="
              padding-top: 2pt;
              padding-left: 1pt;
              text-indent: 0pt;
              text-align: center;
            ">
          Blâme(s)
        </p>
        <p class="s33" style="
              padding-top: 5pt;
              padding-left: 1pt;
              padding-right: 93pt;
              text-indent: 0pt;
              text-align: center;
            ">
          Date (s)
        </p>
      </td>
      <td style="
            width: 137pt;
            border: 1pt solid #3f3b3b;

          ">
        <p class="s32" style="
              padding-top: 2pt;
              padding-left: 45pt;
              text-indent: 0pt;
              text-align: left;
            ">
          <span style="color: #262626">Mise à pied </span>
        </p>
        <p class="s33" style="
              padding-top: 5pt;
              padding-left: 6pt;
              text-indent: 0pt;
              text-align: left;
            ">
          Date (s) :
        </p>
        <p class="s33" style="padding-left: 6pt; text-indent: 0pt; text-align: left">
          Durée(s) :
        </p>
      </td>
      <td style="
            width: 128pt;
            border: 1pt solid #3f3b3b;

          ">
        <p class="s33" style="
              padding-top: 2pt;
              padding-left: 34pt;
              text-indent: 0pt;
              text-align: left;
            ">
          Suspension(s)
        </p>
        <p class="s33" style="
              padding-top: 5pt;
              padding-left: 6pt;
              text-indent: 0pt;
              text-align: left;
            ">
          Date(s):
        </p>
        <p class="s32" style="padding-left: 6pt; text-indent: 0pt; text-align: left">
          Durée(s)
        </p>
      </td>
    </tr>
    <tr style="height: 14pt">
      <td style="
            width: 534pt;
            border: 1pt solid #3f3b3b;

          " colspan="6">

      </td>
    </tr>
    <tr style="height: 38pt">
      <td style="
            width: 243pt;
            border: 1pt solid #3f3b3b;

          " colspan="3">

        <p class="s37" style="
              padding-left: 3pt;
              padding-right: 1pt;
              text-indent: 0pt;
              text-align: center;
            ">
          Critères
        </p>
      </td>
      <td style="
            width: 100pt;
            border: 1pt solid #3f3b3b;

          ">
        <p class="s38" style="
              padding-top: 5pt;
              padding-left: 27pt;
              text-indent: -11pt;
              line-height: 94%;
              text-align: left;
            ">
          Notes du chef immédiat
        </p>
      </td>
      <td style="
            border: 1pt solid #3f3b3b;

          ">
        <p class="s41" style="
              padding-top: 5pt;
              padding-left: 1pt;
              text-indent: 0pt;
              line-height: 91%;
              text-align: center;
            ">
          Notes du chef hiérarchique suivant
        </p>

      </td>
      <td style="border: 1pt solid #3f3b3b; ">
        <p class="s41" style="
        padding-top: 5pt;
              padding-right: 1pt;
              text-indent: 0pt;
              line-height: 91%;
              text-align: center;
            ">
          Notes du chef hiérarchique suivant
        </p>

      </td>
    </tr>
    <tr style="height: 25pt">
      <td style="width: 2pt; border: 1pt solid #3f3b3b;" colspan="3">
        <p class="s32" style="
              padding-top: 6pt;
              padding-left: 4pt;
              text-indent: 0pt;
              text-align: left;
            ">
          1-Assiduité et disponibilité
        </p>
      </td>
      <td style="width: 100pt; border: 1pt solid #3f3b3b; text-align:center; vertical-align: middle;">{{$record->assiduite1}}</td>
      <td style="width: 101pt; border: 1pt solid #3f3b3b;  text-align:center; vertical-align: middle;">{{$record->assiduite2}} </td>
      <td style="width: 90pt; border: 1pt solid #3f3b3b;  text-align:center; vertical-align: middle;">{{$record->assiduite3}}</td>
    </tr>
    <tr style="height: 25pt">
      <td style="width: 2pt; border: 1pt solid #3f3b3b;" colspan="3">
        <p class="s32" style="
              padding-top: 6pt;
              padding-left: 4pt;
              text-indent: 0pt;
              text-align: left;
            ">
          2-Capacité commerciale, d’initiative et de créativité
        </p>
      </td>
      <td style="width: 100pt; border: 1pt solid #3f3b3b; text-align:center; vertical-align: middle;">{{$record->commerciale1}}</td>
      <td style="width: 101pt; border: 1pt solid #3f3b3b;  text-align:center; vertical-align: middle;"> {{$record->commerciale2}}</td>
      <td style="width: 90pt; border: 1pt solid #3f3b3b;  text-align:center; vertical-align: middle;">{{$record->commerciale3}}</td>
    </tr>
    <tr style="height: 25pt">
      <td style="width: 2pt; border: 1pt solid #3f3b3b;" colspan="3">
        <p class="s32" style="
              padding-top: 6pt;
              padding-left: 4pt;
              text-indent: 0pt;
              text-align: left;
            ">
          3-Connaissance et conscience professionnelles
        </p>
      </td>
      <td style="width: 100pt; border: 1pt solid #3f3b3b; text-align:center; vertical-align: middle;">{{$record->connaissance1}}</td>
      <td style="width: 101pt; border: 1pt solid #3f3b3b;  text-align:center; vertical-align: middle;"> {{$record->connaissance2}}</td>
      <td style="width: 90pt; border: 1pt solid #3f3b3b;  text-align:center; vertical-align: middle;">{{$record->connaissance3}}</td>
    </tr>
    <tr style="height: 25pt">
      <td style="width: 2pt; border: 1pt solid #3f3b3b;" colspan="3">
        <p class="s32" style="
              padding-top: 6pt;
              padding-left: 4pt;
              text-indent: 0pt;
              text-align: left;
            ">
          4-Capacité d'encadrer et de travailler en groupe
        </p>
      </td>
      <td style="width: 100pt; border: 1pt solid #3f3b3b; text-align:center; vertical-align: middle;">{{$record->encadrement1}}</td>
      <td style="width: 101pt; border: 1pt solid #3f3b3b;  text-align:center; vertical-align: middle;"> {{$record->encadrement2}}</td>
      <td style="width: 90pt; border: 1pt solid #3f3b3b;  text-align:center; vertical-align: middle;">{{$record->encadrement3}}</td>
    </tr>
    <tr style="height: 25pt">
      <td style="width: 2pt; border: 1pt solid #3f3b3b;" colspan="3">
        <p class="s32" style="
              padding-top: 6pt;
              padding-left: 4pt;
              text-indent: 0pt;
              text-align: left;
            ">
          5-Promptitude a rendre compte et à transmettre
          les ordres
        </p>
      </td>
      <td style="width: 100pt; border: 1pt solid #3f3b3b; text-align:center; vertical-align: middle;">{{$record->promptitude1}}</td>
      <td style="width: 101pt; border: 1pt solid #3f3b3b;  text-align:center; vertical-align: middle;"> {{$record->promptitude2}}</td>
      <td style="width: 90pt; border: 1pt solid #3f3b3b;  text-align:center; vertical-align: middle;">{{$record->promptitude3}}</td>
    </tr>
    <tr style="height: 27pt">
      <td style="width: 243pt; border: 1pt solid #3f3b3b;" colspan="3">
        <p class="s32" style="
              padding-top: 6pt;
              padding-left: 5pt;
              text-indent: 0pt;
              text-align: left;
            ">
          Note totale
        </p>
      </td>
      <td style="width: 100pt; border: 1pt solid #3f3b3b; text-align:center; vertical-align: middle;">{{$totalchefImmediat}}</td>
      <td style="width: 101pt; border: 1pt solid #3f3b3b;  text-align:center; vertical-align: middle;">{{$totalHierarchie1}}</td>
      <td style="width: 90pt; border: 1pt solid #3f3b3b;  text-align:center; vertical-align: middle;">{{$totalHierarchie2}}</td>
    </tr>
    <tr style="height: 30pt">
      <td style="width: 243pt; border: 1pt solid #3f3b3b;" colspan="3">
        <p class="s33" style="
              padding-top: 10pt;
              padding-left: 5pt;
              text-indent: 0pt;
              text-align: left;
            ">
          Note / 20
        </p>
      </td>
      <td style="
            border-top-style: solid;
            border-top-width: 3pt;
            border-top-color: #3f3b3b;
            border-left-style: solid;
            border-left-width: 3pt;
            border-left-color: #3f3b3b;
            border-bottom-style: solid;
            border-bottom-width: 3pt;
            border-bottom-color: #443f3b;
            border-right-style: solid;
            border-right-width: 3pt;
            border-right-color: #3f3b3b;
          ">
      </td>
      <td style="
            border-top: 3pt solid #3f3b3b;
border-left: 1pt solid #3f3b3b;
border-bottom: 3pt solid #3f3b3b;
border-right: 3pt solid #3f3b3b;

          ">
      </td>
      <td style="
            border-top-style: solid;
            border-top-width: 3pt;
            border-top-color: #3f3b3b;
            border-left-style: solid;
            border-left-width: 1pt;
            border-left-color: #3f3b3b;
            border-bottom-style: solid;
            border-bottom-width: 3pt;
            border-bottom-color: #3f3f3b;
            border-right-style: solid;
            border-right-width: 3pt;
            border-right-color: #3f3b3b;
          ">
      </td>
    </tr>
    <tr style="height: 49pt">
      <td style="border: 1pt solid #3f3b3b;" colspan="3">
        <p class="s32" style="
              padding-top: 6pt;
              padding-left: 5pt;
              text-indent: 0pt;
              text-align: left;
            ">
          Noms et Signatures des notateurs
        </p>
      </td>
      <td style="
            border-top-style: solid;
            border-top-width: 2pt;
            border-top-color: #443f3b;
            border-left-style: solid;
            border-left-width: 1pt;
            border-left-color: #3f3b3b;
            border-bottom-style: solid;
            border-bottom-width: 1pt;
            border-bottom-color: #3f3b3b;
            border-right-style: solid;
            border-right-width: 1pt;
            border-right-color: #3f3b3b;
          ">

      </td>
      <td style="
           border-top: 2pt solid #3f3b3b;
border-left: 1pt solid #3f3b3b;
border-bottom: 1pt solid #3f3b3b;
border-right: 1pt solid #3f3b3b;

          ">

      </td>
      <td style="
            width: 90pt;
border-top: 2pt solid #3f3f3b;
border-left: 1pt solid #3f3b3b;
border-bottom: 1pt solid #3f3b3b;
border-right: 1pt solid #3f3b3b;

          ">

      </td>
    </tr>
    <tr style="height: 9pt">
      <td style="border: 1pt solid #3f3b3b;" colspan="3"></td>
      <td style="border: 1pt solid #3f3b3b;"></td>
      <td style="border: 1pt solid #3f3b3b;"></td>
      <td style="border: 1pt solid #3f3b3b;"></td>
    </tr>
    <tr style="height: 17pt">
      <td style="border: 1pt solid #3f3b3b; " colspan="3">
        <p class="s52" style="
              padding-top: 1pt;
              padding-left: 3pt;
              text-indent: 0pt;
              text-align: center;
            ">
          Note moyenne
        </p>
      </td>
      <td style="border: 1pt solid #3f3b3b;">
      </td>
      <td style="border: 1pt solid #3f3b3b;">
        <p class="s53" style="
              padding-top: 2pt;
              text-indent: 0pt;
              text-align: center;
            ">
          Proposition
        </p>
      </td>
      <td style="border: 1pt solid #3f3b3b;"></td>
    </tr>
    <tr style="height: 24pt">
      <td style="border: 1pt solid #3f3b3b;">
        <p class="s38" style="
              padding-top: 4pt;
              padding-left: 16pt;
              text-indent: 0pt;
              text-align: left;
            ">
          Précédente
        </p>
      </td>
      <td style="border: 1pt solid #3f3b3b;">
        <p class="s38" style="
              padding-top: 4pt;
              padding-left: 12pt;
              text-indent: 0pt;
              text-align: left;
            ">
          En cours (1)
        </p>
      </td>
      <td style="border: 1pt solid #3f3b3b;">
        <p class="s54" style="padding-left: 14pt; text-indent: 0pt; text-align: left">
          Note moyenne
        </p>
        <p class="s53" style="
              padding-top: 1pt;
              padding-left: 13pt;
              text-indent: 0pt;
              text-align: left;
            ">
          des III mois (2)
        </p>
      </td>
      <td style="
            border: 1pt solid #3f3b3b;

          ">
        <p class="s24" style="
              padding-top: 5pt;
              text-indent: 0pt;
              text-align: center;
            ">
          Promotion
        </p>
      </td>
      <td style="border: 1pt solid #3f3b3b;">
        <p class="s24" style="
              padding-top: 5pt;
              text-indent: 0pt;
              text-align: center;
            ">
          Avancement
        </p>
      </td>
      <td style="border: 1pt solid #3f3b3b;">
        <p class="s24" style="
              padding-top: 5pt;
              text-indent: 0pt;
              text-align: center;
            ">
          Promotion
        </p>
      </td>
    </tr>
    <tr style="height: 22pt">
      <td style="border: 1pt solid #3f3b3b;"></td>
      <td style="border: 1pt solid #3f3b3b;"></td>
      <td style="border: 1pt solid #3f3b3b;"></td>
      <td style="border: 1pt solid #3f3b3b;"></td>
      <td style="border: 1pt solid #3f3b3b;"></td>
      <td style="border: 1pt solid #3f3b3b;"></td>
    </tr>
  </table>
  <ol id="l1">
    <li data-list-text="(1)"> 
      <p class="datalist">
        Note moyenne est la moyenne des trois notes attribuées par les trois
        chefs hiérarchiques.
      </p>
    </li>
    <li data-list-text="(2)">
      <p class="datalist">
        Note moyenne est la moyenne des deux notes moyennes obtenues sur les
        dix huit (18) mois.
      </p>
    </li>
  </ol>
  <p style="padding-top: 6pt; text-indent: 0pt; text-align: left"><br /></p>
  <p class="s57" style="padding-left: 251pt; text-indent: 0pt; text-align: left">
    Lomé, Le
  </p>
  <p class="s57" style="
        padding-top: 6pt;
        padding-left: 251pt;
        text-indent: 0pt;
        text-align: left;
      "> Le Directeur Général de la Société des Postes du Togo
  </p>
</body>

</html>