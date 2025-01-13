<?php
/*
 * ==================================================================
 * Plugin GLOSSAIRE_XH for CMSimple_XH (1.7.x)
 * ==================================================================
 * Version:    2.0.1 - sept 2020
 * Copyright:  Ludovic AMATHIEU
 * Website:    https://www.f5swn.fr/en/ (and contact)
 * License:    GNU GPLv3 - http://www.gnu.org/licenses/gpl-3.0.en.html
 * ==================================================================
 */

if (!defined('CMSIMPLE_XH_VERSION')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

global $glossaire_cf;

$cindex = array();
if ($s < 0) {
    $igg = 0;
}
else {
    $cindex[0]['index'] = $s; // index de l'article affiché ou autre.
    $cindex[0]['type'] = ($s > 0) ? 'article' : 'autre';
    $igg = 1;
}
// état de l'affichage des news

// newsboxes affichées via le template
$fich = $pth['folder']['templates'].$cf['site']['template'].'/template.htm';

// identification des index des news
if (!$t = @fopen($fich,'r')) {
// plugin do not work in newsboxes. 
}
$fich_content = file_get_contents($fich);
fclose($t);

if ($glossaire_cf["plugin_active_in_newsboxes"] != "") { // Traitement newsboxes si validé dans la config
    // récupère l'index de la news SI affichée sur le template ET publiée.
    if (preg_match_all('`echo newsbox\([\'"]{1}(News[\d]{2})[\'"]{1}\);`', $fich_content, $matches)) {
        
        foreach ($matches[1] as $val) {
            for($ig=0; $ig < $cl; $ig++) {
                if (preg_match ('`'.$val.'`' ,$h[$ig])) {
                    if (isPublished($val)) {
                        $cindex[$igg]['index'] = $ig;
                        $cindex[$igg]['type'] = 'news';
                        $igg++;
                    }
                }
            }
        }
    } 
    // $cindex contient index (article, catégorie, news) et types (article, autre, news) pour le contenu affiché par le template.
}

if ($lefichier != ""){   //si la liste n'est pas vide

   $cindex_cpt = count($cindex);
   $lignes = array();
   $deffin = "";
   $deffin_arr = array();
   $cptlig = count($lignes2);  // $lignes2 est le tableau contenant la liste des mots du glossaire

    for($iggg=0; $iggg < $cindex_cpt; $iggg++) { // boucle des index article/news
       for($b=0; $b<$cptlig; $b++) {       //début boucle lecture de chaque mot
          $lignes[$b] = explode("|",$lignes2[$b]);    // [0|1] [0|1] => [ [0][1] ] [ [0][1] ]
                          
          /* pour utiliser la ligne en cours : $lignes[$b][0] est le numéro
                                               $lignes[$b][1] est le mot  */  
                                           
          /////// recherche et remplacement du mot //////////////////

          // le mot recherché 
          $lemot = strip_tags($lignes[$b][1]);
          $lemot = stripslashes(trim($lemot));
          
          if ($lemot != ""){   // Cas où $lemot est vide, on ne fait rien 
    
             // Pluriels en fonction de la langue. (Les adjectifs ne sont pas prévus)
            $pluriel = (function_exists('pluriel_'.$pl_lng)) ? 'pluriel_'.$pl_lng : 'pluriel_en';
            $lemotabbr = $lemot;
            $lemot = pluriel($lemot, $pluriel);
                
            $count = 0;
             
             ///////////////// Remplacement occurrence du mot, hors balises html, hors liens //////////////////

             // Recherche et remplacement du mot
            if (preg_match("`^[^a-zØ-öø-ÿ]*$`",$lemotabbr)) {  // Si le mot est une abréviation A.B.C. ou ABC (regex case sensitive)

                // ajout variable $lemotabbr_p pour que ABC matche A.B.C. et vice versa
                if (preg_match ("`\.`",$lemotabbr)) { // si des points sont présents
                      $lemotabbr_p = preg_replace("`\.`","",$lemotabbr); // suppression des points
                }
                else { // sinon, ajout de points
                    $chars = preg_split('//', $lemotabbr, -1, PREG_SPLIT_NO_EMPTY);
                    $lemotabbr_p = implode(".", $chars);
                    $lemotabbr_p = preg_replace("`$`", ".", $lemotabbr_p);
                } // Fin traitement abréviation

                $leregex = "`(?!<.*?)(?<![\p{L}_;/-])(".$lemotabbr."|".$lemotabbr_p.")(?=[^\p{L}_/-])(?![^<>]*?>)(?![^>]*?(</.*>)*</(a|h[1-6]))`u";
                $lelien = "<a href=\"#gpop".$lignes[$b][0]."\" class=\"gpop\">$1</a>";
                $c[$cindex[$iggg]['index']] = preg_replace($leregex, $lelien, $c[$cindex[$iggg]['index']], $glossaire_cf['occurrence_number']);
                }
                else { 
                  $leregex = "`(?!<.*?)(?<![\p{L}_;/-])(".$lemot.")(?=[^\p{L}_&/-])(?![^<>]*?>)(?![^>]*?(</.*>)*</(a|h[1-6]))`ui";
                  $lelien = "<a href=\"#gpop".$lignes[$b][0]."\" class=\"gpop\">$1</a>";
                  $c[$cindex[$iggg]['index']] = preg_replace($leregex, $lelien, $c[$cindex[$iggg]['index']], $glossaire_cf['occurrence_number']);
                }
                $lelienreg = "<a href=\"#gpop".$lignes[$b][0]."\" class=\"gpop\">";
                $regcount = "`(".$lelienreg.")`";
                $count = preg_match_all($regcount, $c[$cindex[$iggg]['index']], $matches);
             //fin mot ou abréviation
          
             $deftit = "";
             $deftxt = "";
             $defconf0 = "";
             $defconf1 = "";
             $largconf = "";
             $defact = "";
             $hdeb = "<div class=\"gl_title\"><p>";
             $hfin = "</p></div>";
             $figdef = "";

             //if ($count != 0) { //Si un remplacement a eu lieu
             if ($count != 0 || $h[$s] == 'Glossar') { //Si un remplacement a eu lieu
             if ($h[$s] == 'Glossar') {
                 $showGloss = " showGloss";
             } else {
                 $showGloss = "";
             }
            
                $pos = "<div id=\"gpop ".$lignes[$b][0];
                if (strpos_arr($deffin_arr, $pos)=== false) { // définition chargée si absente
                    if(file_exists(PATH_GLOSS_DATA.$sl."/def_".$lignes[$b][0].INCEXT)) {
                        include(PATH_GLOSS_DATA.$sl."/def_".$lignes[$b][0].INCEXT);
                    }
                    else {  //Message pour avertir du manque d'un fichier def_xx.inc
                        $avert = $plugin_tx['glossaire']['frontend_msg_def_lost']." ".$lignes[$b][0];
                        $o .= XH_message('warning',$avert);
                    }

                    if ($deftit == ""){  //suppression de la barre titre si le champ titre est vide.
                        $hdeb = "<div><p class=\"impr\">".$lemotabbr;  //Le mot est utilisé comme titre, seulement à l'impression
                        $hfin = "</p></div>";
                    }
                    $glnb = ($cindex[$iggg]['type'] == 'news') ? " gloss_nb" : ""; // class ajoutée aux def *exclusives* aux newsboxes
                    $largconf = ($defconf0 == "") ? $largconf = " larg1" : $largconf = " larg2"; // sélection option définition élargie
                    $figdef = ($defconf1 != "") ? "<div class=\"figer\" onclick=\"ferm()\"></div>" : ""; // option def figée ou pas
                    $defact = "<div id=\"gpop".$lignes[$b][0]."\" class=\"pp".$largconf.$glnb."\">"
                        .$figdef
                        .$hdeb
                        .$deftit
                        .$hfin
                        ."<div class=\"def\">"
                        .$deftxt
                        ."</div></div>";     //mise en forme de la def
                    $deffin_arr[$lemotabbr] = $defact;     //chaque définition est ajoutée dans une variable
                } // fin définition chargée si absente
             }   //fin si remplacement effectué
          } //fin cas $lemot est vide
        }//fin de boucle
    } // fin boucle article/news
    
    if (!empty($deffin_arr)){ 
       //tri de l'ordre d'affichage des définitions (pour l'impression)
       uksort($deffin_arr, 'wd_unaccent_compare_ci');
       //création de l'affichage des définitions
       foreach($deffin_arr as $def) {
          $deffin .= $def."\n";
       }
       $titpied = $version."<div class=\"impr" . $showGloss . "\" style=\"text-align:center;\"><p class=\"print_title\">".$plugin_tx['glossaire']['frontend_print_title']."</p></div>";
      //titre du glossaire en bas de page, qu'à l'impression
    }
    else { $titpied = $version; }
    
    if (!empty($deffin)){ // Def à la fin de l'article
        if ($s < 0) $o .= $titpied.$deffin;
        else $c[$s] .= $titpied.$deffin;
    }
} //fin si la liste n'est pas vide
