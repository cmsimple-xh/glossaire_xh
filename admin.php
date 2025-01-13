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

$hjs .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"".PATH_GLOSSAIRE."css/gloss_admin.css\" />\n";
$hjs .= "<script type=\"text/javascript\" src=\"".PATH_GLOSSAIRE."js/gloss_adm_js.php?&amp;lng=".$sl."\"></script>\n";
$hjs .= "<script type=\"text/javascript\" src=\"".PATH_GLOSSAIRE."js/val_suppr_for_ie.js\"></script>\n";

if (function_exists('XH_wantsPluginAdministration') 
    && XH_wantsPluginAdministration('glossaire') 
    || isset($glossaire) && $glossaire == 'true') {
       $o .= print_plugin_admin('on');
          if (XH_ADM) {
            include (PATH_GLOSSAIRE."admin_functions".INCEXT);
         }
    switch ($admin) {
     case '':
       $o .= '<h1>'.ADMIN_TITLE.'</h1>
       <div id="intro">
       <p>
       <img class="glossaire_icon" src="'.PATH_GLOSSAIRE.'img/glossaire_icon.png" /><br />'
       .ADMIN_INTRO.
       '</p>
       <p>Version '.GLOSS_VERSION.'</p>
       </div>';
       $o .= '<div class="copy">
       <p>Copyright &copy; 2018 <a href="https://www.f5swn.fr" target="_blank">Ludovic AMATHIEU</a></p>
       <p>This program is free software: you can redistribute it and/or modify it under the terms of 
       the GNU General Public License as published by the Free Software Foundation, either version 3 
       of the License, or (at your option) any later version.</p><p>This program is distributed in the 
       hope that it will be useful, but without any warranty; without even the implied warranty of 
       merchantability or fitness for a particular purpose. See the GNU General Public License for 
       more details.</p>
       <p>You should have received a copy of the GNU General Public License along with this program. 
       If not, see <a href="http://www.gnu.org/licenses/" target="_blank">http://www.gnu.org/licenses/</a>.</p>
       <p>Credits :<br />
       The <b>German</b> translation (<b>de</b> language and help files) is provided by <a href="http://home.michael-zajusch.de/" target="_blank">Michael Zajusch</a><br /> 
       The <b>Slovak</b> translation (<b>sk</b> language file) is provided by <a href="http://www.cmsimpleforum.com" target="_blank">Tata</a><br /> 
       The <b>Czech</b> translation (<b>cs</b> language file) is provided by <a href="http://oldnema.compsys.cz/en/?Demo_templates" target="_blank">Oldnema</a></p> 
       <p>Thanks to <a href="http://www.freeiconspng.com/free-images/book-icon-133" target="_blank">freeiconspng.com</a> for images used to create plugin icon.</p>
       </div>';
     break;
     case 'plugin_main':

// PAGES MOTS et DEFS 
// ==================

       $o .= '<div id="haut_gl"> </div>
       <h1>'.ADMIN_WORDS_AND_DEF_TITLE.'</h1>
       ';
         
       $glsend = import('glsend', 'POST');
       $def = import('def', 'GET');
       $suppr = import('suppr', 'POST');
       $numdef = import('numdef', 'POST');
       $defconf[0] = import('defconf0', 'POST');
       $defconf[1] = import('defconf1', 'POST');
         
       if ($glsend == 1){$def = $numdef;}    // sinon def est null
       $defchoix = 0;
       if (($def == "")||($glsend == 1)||($suppr == 1)){$defchoix = 0;}
       if ((is_numeric($def)) && ($glsend != 1)) {$defchoix = 1;}
       if ($def == "new") {$defchoix = 2;}

       switch ($defchoix) {  
        case "0":       
                  
         /////////////////////// Affichage, modification et écriture d'une définition ////////////////////
         global $contenu1, $tit, $mot, $deftxt, $deftit, $defmot, $defconf0, $defconf1;

         if ($glsend == 1){  

            // écriture de la définition

            if (preg_match("`[&#;]`", (string) $mot)) {
               $o .= XH_message('warning', "<p><u>".$plugin_tx['glossaire']['admin_msg_warning_last_word']."</u><br /><b>".$mot."</b><br />".$plugin_tx['glossaire']['admin_msg_dont_copy_past']."</p>");
            }

            $contenu1 = import('contenu1', 'POST', FALSE);
            $tit = substr(clean_str(import('tit')),0,50);
            $mot = substr(clean_str(import('mot')),0,30);   
            $deftxt = addslashes($contenu1); 
            $deftit = addslashes($tit);   
            $defmot = addslashes($mot);
            $defconf0 = addslashes(import('defconf0', 'POST'));
            $defconf1 = addslashes(import('defconf1', 'POST'));
            if ($defmot != "") {          
               EcriDef();
          
               // écriture du mot dans la liste des mots
               ModifMot($numdef);          
            }                           
         } // fin if $glsend == 1

         //suppressions
         if ((isset($suppr)) && (is_numeric($suppr)) && ($suppr == 1)){  
            $mot = $_POST['mot'];                    
            if (is_array($mot)) {                
               SupprMot($mot);          
            }
         }
        
         $o .= '<div id="gest_mots">';
        
                                     
         //affichage de la liste des mots 
         //==============================
        
         unset($lignes);
         lecture_mots();
        
         //Filtre d'affichage 
         //------------------
         // let_filtre est transmise en POST depuis un champ caché, form de tri
         // et n'existe que si le tri est utilisé alors qu'une lettre du filtre a été précédemment choisie.
         // sinon, on utilise $let qui est passée en paramètre (GET) au clic sur une lettre du filtre.
        
         if (!empty($_POST['let_filtre'])) {
            $let = htmlentities(strip_tags($_POST['let_filtre']));
         }
         else {
              $let = import('let', 'GET');
         }
         if (($let != "all") && (preg_match("`\p{L}`u", $let))){    
            $cpt = count($lignes);                            
               if (preg_match("`\p{L}`u", $let)){
                  for($i=0; $i<$cpt; $i++){
                     if (!preg_match("`^$let`ui",OteAccents($lignes[$i][1]))){      
                        unset($lignes[$i]);                              
                        $lignes = array_values($lignes);                 
                        $i--;                                           
                     }
                     $cpt = count($lignes);                                   
                  }
               }
         }
         //Fin du filtre
        
         //Tri alphabétique par colonnes
         //-----------------------------
        
        
         global $img_on, $img_off, $choix_tri, $img_nr, $img_mot;
         $choix = import('choix', 'POST');
         $img_on = "tri_on";
         $img_off = "tri_off";
         $choix_tri = 1;               
         $img_nr = $img_off;
         $img_mot = $img_on;         
        
         switch ($choix) {
          case "0":
           $choix_tri = 0;
           $img_nr = $img_on;
           $img_mot = $img_off;
          break;
          
          case "1":
           $choix_tri = 1;
           $img_nr = $img_off;
           $img_mot = $img_on;
          break;
         }
        
         //tri du tableau affiché
          function array_key_multi_sort(&$arr, $l , $strnat='strnatcasecmp') {
            return usort($arr, 
                          function($a, $b) use ($l, $strnat) {
                             return $strnat(OteAccents($a[$l]), OteAccents($b[$l]));
                          }
                        );   
         } 
         if (is_array($lignes)) {array_key_multi_sort($lignes, $choix_tri , $strnat='strnatcasecmp');}
         //fin du tri

         $o .= '<br />
         <fieldset class="title">'
         .$plugin_tx['glossaire']['admin_handle_the_words_title'].
         '<span style="float:right;">'
         .language_choice().
         '</span>
         <br />
         </fieldset>
         <br />';

        
         //Affichage du filtre alphabétique avec liste A|B|C|....|Z|Tous
         //-------------------------------------------------------------
        
         //Début liste filtre alphabetique   
         $o .= '<fieldset>
         <legend align="center">'
         .$plugin_tx['glossaire']['admin_filter_title'].
         '</legend>
         <table class="filtre" cellspacing="0" cellpadding="4" align="center" border="0" width="100%">
         <tr>
         <td>
         <b> | ';
        
         //Alphabet généré selon la langue utilisée
         $o .= get_alphabet($sl).
         '<a href="?&amp;glossaire&amp;admin=plugin_main&amp;action=plugin_text&amp;normal&amp;let=all#haut_gl">'
         .$plugin_tx['glossaire']['admin_txt_all'].
         '</a>
          | </b>
          </td>
          </tr>
          </table>
          </fieldset>';
         //Fin liste filtre alphabetique

         //Affichage du tableau des mots du glossaire
         //------------------------------------------
        
         // $let, si elle existe (GET), est utilisée dans affiche_mots() pour créer le
         // champ caché let_filtre situé dans le form de tri (pour conserver le filtre
         // quelque soit le tri effectué).
         affiche_mots();
        
         $o .= '<br />
         <fieldset>
         <legend align="center">'
         .$plugin_tx['glossaire']['admin_list_title'].
         '</legend>
         <br />'
         .$motaff.
         '<br />
         </fieldset>
         </div>
         <br />';
         //Fin affichage du tableau
        
        break;       //fin pas de paramètre def
        
        case "1": //un paramètre a été passé
         global $mot, $tit, $contenu1, $numdef, $defconf;
         if(file_exists(PATH_GLOSS_DATA.$sl."/def_".$def.INCEXT)) {   
            include(PATH_GLOSS_DATA.$sl."/def_".$def.INCEXT);          
               $numdef = $def;
               $mot = $defmot;
               $tit = $deftit;
               $contenu1 = $deftxt;
               $defconf[0] = $defconf0;
               $defconf[1] = $defconf1;
         }
        break;
        
        case "2": // nouveau mot et donc nouvelle def
         global $mot, $tit, $contenu1, $numdef, $defconf0, $defconf1, $nrdispo;
         $mot = "";
         $tit = "";
         $contenu1 = "";
         $defconf0 = "";
         $defconf1 = "";    
         lecture_mots();
         FindNrMax();
         $numdef = $nrdispo;
        break;
       }
        
       $glsend = 0;
        
       //Affichage des formulaires de création/modif mots et définitions associées
       //=========================================================================
        
       switch ($defchoix) {
        case "1":
        case "2":
         $o .= '
         <div id="gloss_edit">
         <br />
         <fieldset class="title">'
         .$plugin_tx['glossaire']['admin_edit_page_title'].
         '<br />
         </fieldset>
         <br />
         <fieldset>
         <br />
         <form name="adminsend" id="adminsend" action="?&amp;glossaire&amp;admin=plugin_main&amp;action=plugin_text&amp;normal#haut_gl" method="post">
         <input type="hidden" name="glsend" value="1" />';
        
         /******************* EDITION **********************/
         $o .= '
         <input type="hidden" name="numdef" value="'.$numdef.'" />
         <table cellspacing="0" cellpadding="0" border="0" width="40%" style="vertical-align:middle; cursor:pointer; margin-left: auto; margin-right: auto;">
         <tr>
         <td></td>
         <td align="center">Id : '.$numdef.'</td>
         </tr>
         <tr>
         <td>'.$plugin_tx['glossaire']['admin_txt_word'].'&nbsp;</td>
         <td><input id="mot" type="text" name="mot" value="'.$mot.'" onchange="verif_form();" /></td>
         </tr>
         <tr>
         <td>'.$plugin_tx['glossaire']['admin_txt_title'].'&nbsp;</td>
         <td><input type="text" name="tit" value="'.$tit.'" /></td>
         </tr>
         </table>
         <br /><br />
         <a name="definition1"></a>
         <label for="contenu1">
         &nbsp;&nbsp;<b>'.$plugin_tx['glossaire']['admin_editor_title'].'</b>
         </label>
         <br /><br />';

         // Affichage de l'éditeur

             $o .= '
         <textarea name="contenu1" class="contenu1" style="width: 100%;" rows="30" cols="80">'
         .$contenu1.
         '</textarea>
         <br />
         </fieldset>
         <br />
         <fieldset>
         <table cellspacing="0" cellpadding="4" align="center" border="0" width="100%">
         <tr style="text-align:left;">
         <td width="70%">
         <p>&bull; '.$plugin_tx['glossaire']['admin_txt_increased_width'].'&nbsp;&nbsp;&nbsp;&nbsp;</p>
         </td>
         <td width="30%">
         <input type="checkbox" name="defconf0" '.(($defconf[0])? "checked":'').' />
         </td>
         </tr>
         <tr style="text-align:left;">
         <td colspan="2">
         <p align="justify">'
         .$plugin_tx['glossaire']['admin_txt_increased_width_text'].
         '</p>
         </td>
         </tr>
         </table>
         </fieldset>
         <br />
         <fieldset>
         <table cellspacing="0" cellpadding="4" align="center" border="0" width="100%">
         <tr style="text-align:left;">
         <td width="70%">
         <p>&bull; '.$plugin_tx['glossaire']['admin_txt_freeze_def'].'&nbsp;&nbsp;&nbsp;&nbsp;</p>
         </td>
         <td width="30%">
         <input type="checkbox" name="defconf1" '.(($defconf[1])?"checked":'').' />
         </td>
         </tr>
         <tr style="text-align:left;">
         <td colspan="2">
         <p align="justify">'
         .$plugin_tx['glossaire']['admin_txt_freeze_def_text'].
         '</p>
         </td>
         </tr>
         </table>
         </fieldset>
         <p style="text-align:center;">
         <input class="submit" type="submit" form="adminsend" value="'.$plugin_tx['glossaire']['admin_button_save'].'" />
         </p>
         </form>
         <br />
         </div>';
        
         init_editor(array('contenu1'));

        break;
       } //fin cas de l'emploi du formulaire (édition def existante ou création d'une définition)
        
     break; // FIN GESTION MOTS et DEFS
        
     // DEBUT CONFIGURATION selon template
     case 'plugin_config':

// PAGE CONFIGURATION
//===================
       global $tpl_state;
       
       // Liste des templates
       $templ_list = array();
       $hd = opendir($pth['folder']['templates']);
       while ($fichier = readdir($hd)) {
          if (is_dir($pth['folder']['templates'].$fichier) && $fichier != "." && $fichier != "..") {
                $templ_list[] = $fichier;
          }
       }
       closedir($hd);
       sort($templ_list);
        
       $glconfig = import('glconfig', 'POST');
       $desactiv = $glossaire_cf["plugin_disable_state"];
       $config[0] = $glossaire_cf["occurrence_number"];
       $config[1] = $glossaire_cf["plugin_active_in_newsboxes"];
       $defin[6] = $glossaire_cf["definition_width"];
       $defin[7] = $glossaire_cf["definition_width_increased"];
       $occur[0] = $glossaire_cf["occurrence_underline_type"];
       $occur[1] = $glossaire_cf["occurrence_underline_color"];
       $titre[0] = $glossaire_cf["definition_title_background"];
       $titre[1] = $glossaire_cf["definition_title_color"];
       $titre[2] = $glossaire_cf["definition_title_font"];
       $titre[3] = $glossaire_cf["definition_title_size"];
       $defin[0] = $glossaire_cf["definition_text_background"];
       $defin[1] = $glossaire_cf["definition_text_color"];
       $defin[2] = $glossaire_cf["definition_text_font"];
       $defin[3] = $glossaire_cf["definition_text_size"];
       $defin[4] = $glossaire_cf["definition_top_left_border"];
       $defin[5] = $glossaire_cf["definition_bottom_right_border"];
        
       // le template choisi est chargé pour la page courante
       if ($tpl_choosen != '') {
          $cf['site']['template']=$tpl_choosen; 
          $pth['folder']['template']=$pth['folder']['templates'].$cf['site']['template'].'/';
          $pth['file']['template']=$pth['folder']['template'].'template.htm'; 
          $pth['file']['stylesheet']=$pth['folder']['template'].'stylesheet.css'; 
          $pth['folder']['menubuttons']=$pth['folder']['template'].'menu/'; 
          $pth['folder']['templateimages']=$pth['folder']['template'].'images/'; 
       }
       
       // Controle du fichier template.htm et mise à jour config si code absent alors qu'état ACTIF
       checkActivation($tpl_value);
        
       if ($glconfig == 1) {              //si le formulaire de config a été envoyé
        
          // Récupération valeurs formulaire
          $desactiv = import('desactiv', 'POST'); // plugin désactivé pour ce template 
          $config[0] = import('config0', 'POST'); // Configuration du nombre d'occurrence(s)
          $config[1] = import('config1', 'POST'); // Activation du plugin pour les newsboxes
          $defin[6] = import('defin6', 'POST'); // Largeur par défaut de la définition affichée
          $defin[7] = import('defin7', 'POST'); // Largeur augmentée (option lors de l'édition de la définition)
          $occur[0] = import('occur0', 'POST'); // Aspect du souligné sur l'occurrence
          $occur[1] = import('occur1', 'POST'); // Couleur du souligné sur l'occurrence
          $titre[0] = import('titre0', 'POST'); // Couleur de l'arrière-plan du titre de la definition affichée
          $titre[1] = import('titre1', 'POST'); // Couleur du titre de la def
          $titre[2] = import('titre2', 'POST'); // Police du titre de la def
          $titre[3] = import('titre3', 'POST'); // Taille du titre de la def
          $defin[0] = import('defin0', 'POST'); // Couleur de l'arrière-plan du texte de la def
          $defin[1] = import('defin1', 'POST'); // Couleur du texte de la def
          $defin[2] = import('defin2', 'POST'); // Police du texte de la def
          $defin[3] = import('defin3', 'POST'); // Taille du texte de la def
          $defin[4] = import('defin4', 'POST'); // Bords gauche et supérieur
          $defin[5] = import('defin5', 'POST'); // Bords droit et inférieur

          // Vérification et ajout eventuel de init_Glossaire() dans template.htm
          // ou suppression si désactivation choisie
          GlossActivation($tpl_value, $desactiv);
          if ($tpl_state == 1) $desactiv = ''; // le code a été ajouté
                  
          // fonction permettant d'actualiser les styles de l'aperçu de la définition quand form vient d'être transmis.        
          $hjs .= "<script type=\"text/javascript\">
           function apply_ap_styles() {
           if(document.all) {
             document.getElementById('ap_titre').firstChild.style.background='".$titre[0]."';
             document.getElementById('ap_titre').firstChild.style.color='".$titre[1]."';
             document.getElementById('ap_titre').firstChild.style.fontFamily=document.forms['adminconfig'].elements['titre2'].value;
             document.getElementById('ap_titre').firstChild.style.fontSize=document.forms['adminconfig'].elements['titre3'].value;
             document.getElementById('ap_txtdef').style.background='".$defin[0]."';
             document.getElementById('ap_def').style.background='".$defin[0]."';     
             seek('div#ap_txtdef.def p').each( function(p) {p.style.background='".$defin[0]."';});
             seek('div#ap_txtdef.def p').each( function(p) {p.style.color='".$defin[1]."';});
             document.getElementById('ap_txtdef').firstChild.style.fontFamily=document.forms['adminconfig'].elements['defin2'].value;
             document.getElementById('ap_txtdef').firstChild.style.fontSize=document.forms['adminconfig'].elements['defin3'].value;
             document.getElementById('ap_def').style.borderLeftColor='".$defin[4]."';
             document.getElementById('ap_def').style.borderTopColor='".$defin[4]."';
             document.getElementById('ap_def').style.borderRightColor='".$defin[5]."';
             document.getElementById('ap_def').style.borderBottomColor='".$defin[5]."';
           } else {
           if(document.getElementById) {
            document.getElementById('ap_titre').firstChild.style.background='".$titre[0]."';
            document.getElementById('ap_titre').firstChild.style.borderBottomColor='".$titre[0]."';
            document.getElementById('ap_titre').firstChild.style.color='".$titre[1]."';
            document.getElementById('ap_titre').firstChild.style.fontFamily=document.forms['adminconfig'].elements['titre2'].value;
            document.getElementById('ap_titre').firstChild.style.fontSize=document.forms['adminconfig'].elements['titre3'].value;
            document.getElementById('ap_txtdef').style.background='".$defin[0]."';
            document.getElementById('ap_def').style.background='".$defin[0]."';
            seek('div#ap_txtdef.def p').each( function(p) {p.style.background='".$defin[0]."';});
            seek('div#ap_txtdef.def p').each( function(p) {p.style.color='".$defin[1]."';});
            document.getElementById('ap_txtdef').firstChild.style.fontFamily=document.forms['adminconfig'].elements['defin2'].value;
            document.getElementById('ap_txtdef').firstChild.style.fontSize=document.forms['adminconfig'].elements['defin3'].value;
            document.getElementById('ap_def').style.borderLeftColor='".$defin[4]."';
            document.getElementById('ap_def').style.borderTopColor='".$defin[4]."';
            document.getElementById('ap_def').style.borderRightColor='".$defin[5]."';
            document.getElementById('ap_def').style.borderBottomColor='".$defin[5]."';
            }
          }
        }  
         if (window.addEventListener) {
                   window.addEventListener('load', apply_ap_styles, false);
                   } else if (window.attachEvent) {
                   window.attachEvent('onload', apply_ap_styles);
                   }     
        </script>\n";        
                
          // écriture du fichier de configuration 
          $rec = '<?php 
          // Fichier de configuration du GLOSSAIRE pour le template : '.$tpl_value.'
          if (stristr($_SERVER["SCRIPT_NAME"], "'.$tpl_value.INCEXT.'")) {
             header("location:../index.php");
             die();
          }
          $plugin_cf["glossaire"]["plugin_disable_state"] = stripslashes("'.$desactiv.'"); // Plugin désactivé pour ce template
          $plugin_cf["glossaire"]["occurrence_number"] = stripslashes("'.$config[0].'"); // Configuration du nombre d\'occurrence(s)
          $plugin_cf["glossaire"]["plugin_active_in_newsboxes"] = stripslashes("'.$config[1].'"); // Activation du plugin pour les newsboxes
          $plugin_cf["glossaire"]["definition_width"] = stripslashes("'.$defin[6].'"); // Largeur par défaut de la définition affichée
          $plugin_cf["glossaire"]["definition_width_increased"] = stripslashes("'.$defin[7].'"); // Largeur augmentée (option lors de l\'édition de la définition)
          $plugin_cf["glossaire"]["occurrence_underline_type"] = stripslashes("'.$occur[0].'"); // Aspect du souligné sur l\'occurrence
          $plugin_cf["glossaire"]["occurrence_underline_color"] = stripslashes("'.$occur[1].'"); // Couleur du souligné sur l\'occurrence
          $plugin_cf["glossaire"]["definition_title_background"] = stripslashes("'.$titre[0].'"); // Couleur de l\'arrière-plan du titre de la definition affichée
          $plugin_cf["glossaire"]["definition_title_color"] = stripslashes("'.$titre[1].'"); // Couleur du titre de la def
          $plugin_cf["glossaire"]["definition_title_font"] = stripslashes("'.$titre[2].'"); // Police du titre de la def
          $plugin_cf["glossaire"]["definition_title_size"] = stripslashes("'.$titre[3].'"); // Taille du titre de la def
          $plugin_cf["glossaire"]["definition_text_background"] = stripslashes("'.$defin[0].'"); // Couleur de l\'arrière-plan du texte de la def
          $plugin_cf["glossaire"]["definition_text_color"] = stripslashes("'.$defin[1].'"); // Couleur du texte de la def
          $plugin_cf["glossaire"]["definition_text_font"] = stripslashes("'.$defin[2].'"); // Police du texte de la def
          $plugin_cf["glossaire"]["definition_text_size"] = stripslashes("'.$defin[3].'"); // Taille du texte de la def
          $plugin_cf["glossaire"]["definition_top_left_border"] = stripslashes("'.$defin[4].'"); // Bords gauche et supérieur
          $plugin_cf["glossaire"]["definition_bottom_right_border"] = stripslashes("'.$defin[5].'"); // Bords droit et inférieur
          ';
          $rec .= '?'.'>';
        
          @chmod(PATH_GLOSS_CONFIG.$tpl_value.INCEXT,0666);
          WriteDefDB(PATH_GLOSS_CONFIG.$tpl_value.INCEXT,$rec); //met à jour la config du Glossaire
              // Rappel de la page avec le template choisi
              // (sinon la validation du formulaire semble sans effet, exemple: activation sur newsbox) 
              $o .= "<script type=\"text/javascript\">
              //<![CDATA[
              function validTpl() {
           document.getElementById('chtpl').submit();
          }
                if (window.addEventListener) {
                   window.addEventListener('load', validTpl, false);
          } else if (window.attachEvent) {
                   window.attachEvent('onload', validTpl);
           }
           //]]>
          </script>";        
       }  //fin cas formulaire config envoyé
        
        
       function GetSelector($inputename='idselector', $default='', $ap_cible='id_div_cible', $ap_style='') {
         if ($default == "transparent") $default = "";
         if ($default == "inherit") $default = "";
         return "<input size=\"10\" class=\"gl_chp\" type=\"text\" id=\"".$inputename."\" name=\"".$inputename."\" value=\"".$default."\" /><input class=\"gl_col\" id=\"".$inputename."btn\" name=\"".$inputename."btn\" type=\"button\" value=\"    \" onclick=\"opencolorselector('".$inputename."', event, '".$ap_cible."', '".$ap_style."')\" style=\"height:20px; width:25px; background:".$default."\" />\n";
       }
        
       $o .= '
       <div id="colorselector" style="z-index:50;position:absolute;top:15px;width:300px;display:none;border:thin solid black;background:#FFFFFF;">
       <p style="text-align:center;">'
       .$plugin_tx['glossaire']['admin_txt_color_choice'].
       '</p>
       <table cellspacing="1" cellpadding="1" style="margin:auto;text-align:center;border:0">
       <tr>';
        
       $fill = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
       $col_r = 0;
       $col_g = 0;
       $col_b = 0;
       $row_return = 0;
       $block_return = 0;
        
       while($col_r <= 255) {
          $col_g = 0;
          $block_return++;
          while($col_g <= 255) {
            $col_b = 0;
            while($col_b <= 255) {
              $red = strtoupper(dechex($col_r));
              $green = strtoupper(dechex($col_g));
              $blue = strtoupper(dechex($col_b));
              $color = str_pad($red,2,'0',STR_PAD_LEFT)."".str_pad($green,2,'0',STR_PAD_LEFT)."".str_pad($blue,2,'0',STR_PAD_LEFT);
              $o .= "<td height=\"15px\" width=\"15px\" bgcolor=\"#".$color."\" onclick='selectcolor(\"#".$color."\")' style=\"cursor: hand;\"></td>";
              $row_return++;
              if($row_return == 18) {
                $o .= "</tr><tr>";
                $row_return = 0;
              }
              $col_b += 51;
            }
            $col_g += 51;
          }
          $col_r += 51;
       }
       $o .= '
       <td></td>
       </tr>
       </table>
       <p style="text-align:center;">'
       .$plugin_tx['glossaire']['admin_txt_shades_of_gray'].
       '</p>
       <table style="margin:auto;text-align:center;border:0">
       <tr>';
       $col = 15;
        while($col <= 255) {
          $red = strtoupper(dechex($col));
          $green = strtoupper(dechex($col));
          $blue = strtoupper(dechex($col));
          $color = str_pad($red,2,'0',STR_PAD_LEFT)."".str_pad($green, 2,'0',STR_PAD_LEFT)."".str_pad($blue,2,'0',STR_PAD_LEFT);
          $o .= "<td height=\"15px\" width=\"15px\" bgcolor=\"#".$color."\" onclick='selectcolor(\"#".$color."\")' style=\"cursor: hand;\"></td>";
          $col += 15;
        }
        
        $o .= '
        </tr>
        </table>
        </div>';
        $o .= '<div id="haut_gl"> </div>
        <h1>'.ADMIN_CONFIGURATION_TITLE.'</h1>
        <div id="gloss_config">';
        
        //Choix TEMPLATE
        $o .= '
        <br />
        <fieldset>
        <legend align="center">'
        .$plugin_tx['glossaire']['admin_txt_template_choice'].
        '</legend>';
          
        if (isset($templ_list)) {
           if (count($templ_list) > 1) {
              $o .= '
              <div style="text-align:center">
              <form method="post" name="chtpl" id="chtpl" action="?&amp;glossaire&amp;admin=plugin_config&amp;action=plugin_text&amp;normal#haut_gl">
              <table cellspacing="0" cellpadding="4" style="text-align:center;border:0;width:100%">
              <tr>
              <td>
                 <p>'
               .$plugin_tx['glossaire']['admin_txt_config_for_template'].
               '<select name="tpl_choosen" style="vertical-align:middle;" onchange="submit(); return true;">';
              foreach ($templ_list as $templ){
                 $o .= '
                 <option class="'.(is_file (PATH_GLOSS_CONFIG.$templ.INCEXT) ? 'fait' : 'pasfait').'" value="'.$templ.'"'.($tpl_value==$templ ? ' selected="selected"' : '').'>'.$templ.'</option>';
              }
              $o .= '
              </select>
              <input type="submit" value="Go" title="Go"  style="vertical-align:middle;" />
              </p>
              </td>
              </tr>
              <tr>
              <td>
                   <p align="justify">'
              .$plugin_tx['glossaire']['admin_txt_templ_choice_txt'].
              '</p>
                   </td>
              </tr>
              </table>
                   </form>
              </div>';
           } else {
                  $o .= '
                  <div style="text-align:center">'.$plugin_tx['glossaire']['admin_txt_only_one_template'].'
                  </div>';
           }
        }
        $o .= '
        </fieldset>';
        // FIN CHOIX TEMPLATE
        
        // CONFIGURATION pour le template en cours ou celui choisi
        $o .= '<form name="adminconfig" id="adminconfig" action="?&amp;glossaire&amp;admin=plugin_config&amp;action=plugin_text&amp;normal#haut_gl" method="post">
        <input type="hidden" name="glconfig" value="1" />
        <input type="hidden" name="tpl" value="'.(($tpl_choosen != '') ? $tpl_choosen : $tpl_value).'" />';
        
        // Etat du plugin pour le template en cours (actif ou désactivé)
        $o .= '
        <br />
        <fieldset>
        <legend align="center">'
        .$plugin_tx['glossaire']['admin_plugin_state_title'].
        '</legend>
        <br />';
        ($desactiv == 'on') ?  $o .= '<p style="text-align:center;">'.$plugin_tx['glossaire']['admin_txt_disabled'].'</p>'
        : $o .= '<p style="text-align:center;">'.$plugin_tx['glossaire']['admin_txt_active'].' <input type="checkbox" name="desactiv" '.(($desactiv)? "checked":'').' /></span></p>';
        $o .= '
        </fieldset>';

        // Activation pour les newsbox
        $o .= '
        <br />
        <fieldset>
        <legend align="center">'
        .$plugin_tx['glossaire']['admin_newsboxes_activation_title'].
        '</legend>
        <br />
        <table cellspacing="0" cellpadding="4" align="center" border="0" width="100%">
        <tr style="text-align:left;">
        <td>
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_newsboxes_activation'].
        '&nbsp;&nbsp;&nbsp;&nbsp;
        </p>
        </td>
        <td width="20%">
        <input type="checkbox" name="config1" '.(($config[1])? "checked":'').' />
        </td>
        </tr>
        <tr style="text-align:left;"><td colspan="2">
        <p align="justify">'
        .$plugin_tx['glossaire']['admin_newsboxes_activation_text'].
        '</p>
        </td>
        </tr>
        </table>
        </fieldset>';
        
        // Choix nombre d'occurrences
        $o .= '<br />
        <fieldset>
        <legend align="center">'
        .$plugin_tx['glossaire']['admin_occurrence_title'].
        '</legend>
        <br />
        <table cellspacing="0" cellpadding="4" align="center" border="0" width="100%">
        <tr style="text-align:left;">
        <td>
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_occurrence_number'].
        '</p>
        </td>
        <td width="20%">
        <input name="config0" class="occurnb" type="text" size="4" value="'.$config[0].'" />
        </td>
        </tr>
        <tr style="text-align:left;"><td colspan="2">
        <p align="justify">'
        .$plugin_tx['glossaire']['admin_txt_occurrence_text'].
        '</p>
        </td></tr>
        </table>
        </fieldset>';
        
        // Largeur définitions
        $o .= '<br />
        <fieldset>
        <legend align="center">'
        .$plugin_tx['glossaire']['admin_definition_width_title'].
        '</legend>
        <br />
        <table cellspacing="0" cellpadding="4" style="text-align:center;border:0;width:100%">
        <tr style="text-align:left;">
        <td style="padding-right:30px;">
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_definition_width'].
        '</p>
        </td>
        <td width="20%">
        <input name="defin6" class="defwidth" type="text" size="4" value="'.$defin[6].'" />
        </td>
        </tr>
        <tr style="text-align:left;">
        <td style="padding-right:30px;">
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_definition_width_increased'].
        '</p>
        </td>
        <td width="20%">
        <input name="defin7" class="defwidth" type="text" size="4" value="'.$defin[7].'" />
        </td>
        </tr>
        </table>
        </fieldset>';
        
        // ASPECT OCCURRENCES (Titre)
        $o .= '<br /><br />
        <fieldset class="title">'
        .$plugin_tx['glossaire']['admin_occurrence_aspect_title'].
        '<br />
        </fieldset>';
        
        // Aspect occurrences (type et couleur souligné)
        $o .= '<br />
        <fieldset>
        <legend align="center">'
        .$plugin_tx['glossaire']['admin_occurrence_aspect_legendtitle'].
        '</legend>
        <br />
        <table cellspacing="0" cellpadding="4" style="text-align:center;border:0;width:100%">
        <tr style="text-align:left;">
        <td>
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_occurrence_underline_type'].
        '</p>
        </td>
        <td>
        <select name="occur0">
        <option value="dotted"'.(($occur[0] == "dotted") ? " selected=\"selected\"": "").'>'.$plugin_tx['glossaire']['admin_occurrence_select_dotted'].'</option>
        <option value="dashed"'.(($occur[0] == "dashed") ? " selected=\"selected\"" : "").'>'.$plugin_tx['glossaire']['admin_occurrence_select_dashed'].'</option>
        <option value="solid"'.(($occur[0] == "solid") ? " selected=\"selected\"" : "").'>'.$plugin_tx['glossaire']['admin_occurrence_select_solid'].'</option>
        </select>
        </td>
        </tr>
        <tr style="vertical-align:middle; text-align:left;">
        <td>
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_occurrence_underline_color'].
        '</p>
        </td>
        <td>
        '.GetSelector("occur1", "$occur[1]").'
        </td>
        </tr>
        </table>
        </fieldset>
        <br />';
        
        // ASPECT des DEFINITIONS (Titre)
        $o .= '<br />
        <fieldset class="title">'
        .$plugin_tx['glossaire']['admin_definition_aspect_title'].
        '<br />
        </fieldset>
        <br />';
        
        // Titres des définitions (background, couleur, font, taille)
        $o .= '<fieldset>
        <legend align="center">'
        .$plugin_tx['glossaire']['admin_definition_title_title'].
        '</legend>
        <br />
        <table cellspacing="0" cellpadding="4" style="text-align:center;border:0;width:100%">
        <tr style="text-align:left;">
        <td>
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_text_background'].
        '</p>
        </td>
        <td>
        '.GetSelector("titre0", "$titre[0]", "ap_titre", "background").'
        </td>
        </tr>
        <tr style="text-align:left;">
        <td>
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_txt_color'].
        '</p>
        </td>
        <td>
        '.GetSelector("titre1", "$titre[1]", "ap_titre", "color").'
        </td>
        </tr>
        <tr style="text-align:left;">
        <td width="50%">
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_txt_font'].
        '</p>
        </td>
        <td width="50%">
        <select name="titre2" onchange="ap_font(\'titre2\', \'ap_titre\', \'family\');">
        <option value="Arial, Helvetica, sans-serif"'.(($titre[2] == "Arial, Helvetica, sans-serif") ? " selected=\"selected\"" : "").'>Arial, Helvetica, sans-serif</option>
        <option value="Verdana, Bitstream Vera Sans, sans-serif"'.(($titre[2] == "Verdana, Bitstream Vera Sans, sans-serif") ? " selected=\"selected\"" : "").'>Verdana, Bitstream Vera Sans, sans-serif</option>
        <option value="Trebuchet MS, Helvetica, sans-serif"'.(($titre[2] == "Trebuchet MS, Helvetica, sans-serif") ? " selected=\"selected\"" : "").'>Trebuchet MS, Helvetica, sans-serif</option>
        <option value="Comic sans MS, Arial, sans-serif"'.(($titre[2] == "Comic sans MS, Arial, sans-serif") ? " selected=\"selected\"" : "").'>Comic sans MS, Arial, sans-serif</option>
        <option value="Times New Roman, Times, serif"'.(($titre[2] == "Times New Roman, Times, serif") ? " selected=\"selected\"" : "").'>Times New Roman, Times, serif</option>
        <option value="Georgia, Times New Roman, serif"'.(($titre[2] == "Georgia, Times New Roman, serif") ? " selected=\"selected\"" : "").'>Georgia, Times New Roman, serif</option>
        <option value="Courier New, Courier, monospace"'.(($titre[2] == "Courier New, Courier, monospace") ? " selected=\"selected\"" : "").'>Courier New, Courier, monospace</option>
        <option value="inherit"'.(($titre[2] == "inherit") ? " selected=\"selected\"" : "").'>inherit</option>
        </select>
        </td>
        </tr>
        <tr style="text-align:left;">
        <td>
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_txt_size'].
        '</p>
        </td>
        <td>
        <input name="titre3" class="defwidth" type="text" size="4" value="'.$titre[3].'" onchange="ap_font(\'titre3\', \'ap_titre\', \'size\');" />
        </td>
        </tr>
        </table>
        </fieldset>';
        
        // Définitions (background, couleur, font, taille)
        $o .= '<br />
        <fieldset>
        <legend align="center">'
        .$plugin_tx['glossaire']['admin_definition_text_title'].
        '</legend>
        <br />
        <table cellspacing="0" cellpadding="4" style="text-align:center;border:0;width:100%">
        <tr style="text-align:left;">
        <td>
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_text_background'].
        '</p>
        </td>
        <td width="50%">
        '.GetSelector("defin0", "$defin[0]", "ap_def", "background").'
        </td>
        </tr>
        <tr style="text-align:left;">
        <td>
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_txt_color'].
        '</p>
        </td>
        <td width="50%">
        '.GetSelector("defin1", "$defin[1]", "ap_def", "color").'
        </td>
        </tr>
        <tr style="text-align:left;">
        <td width="50%">
        <p>&bull; '.$plugin_tx['glossaire']['admin_txt_font'].'</p></td><td width="50%"><select name="defin2" onchange="ap_font(\'defin2\', \'ap_txtdef\', \'family\');">
        <option value="Arial, Helvetica, sans-serif"'.(($defin[2] == "Arial, Helvetica, sans-serif") ? " selected=\"selected\"" : "").'>Arial, Helvetica, sans-serif</option>
        <option value="Verdana, Bitstream Vera Sans, sans-serif"'.(($defin[2] == "Verdana, Bitstream Vera Sans, sans-serif") ? " selected=\"selected\"" : "").'>Verdana, Bitstream Vera Sans, sans-serif</option>
        <option value="Trebuchet MS, Helvetica, sans-serif"'.(($defin[2] == "Trebuchet MS, Helvetica, sans-serif") ? " selected=\"selected\"" : "").'>Trebuchet MS, Helvetica, sans-serif</option>
        <option value="Comic sans MS, Arial, sans-serif"'.(($defin[2] == "Comic sans MS, Arial, sans-serif") ? " selected=\"selected\"" : "").'>Comic sans MS, Arial, sans-serif</option>
        <option value="Times New Roman, Times, serif"'.(($defin[2] == "Times New Roman, Times, serif") ? " selected=\"selected\"" : "").'>Times New Roman, Times, serif</option>
        <option value="Georgia, Times New Roman, serif"'.(($defin[2] == "Georgia, Times New Roman, serif") ? " selected=\"selected\"" : "").'>Georgia, Times New Roman, serif</option>
        <option value="Courier New, Courier, monospace"'.(($defin[2] == "Courier New, Courier, monospace") ? " selected=\"selected\"" : "").'>Courier New, Courier, monospace</option>
        <option value="inherit"'.(($defin[2] == "inherit") ? " selected=\"selected\"" : "").'>inherit</option>
        </select>
        </td>
        </tr>
        <tr style="text-align:left;">
        <td>
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_txt_size'].
        '</p>
        </td>
        <td width="50%">
        <input name="defin3" class="defwidth" type="text" size="4" value="'.$defin[3].'" onchange="ap_font(\'defin3\', \'ap_txtdef\', \'size\');" />
        </td>
        </tr>
        </table>
        </fieldset>
        <br />
        <fieldset>
        <legend align="center">'
        .$plugin_tx['glossaire']['admin_definition_border_title'].
        '</legend>
        <br />
        <table cellspacing="0" cellpadding="4" style="text-align:center;border:0;width:100%">
        <tr style="text-align:left;">
        <td>
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_definition_top_left_color'].
        '</p>
        </td>
        <td width="50%">
        '.GetSelector("defin4", "$defin[4]", "ap_def", "border-left").'
        </td>
        </tr>
        <tr style="text-align:left;">
        <td>
        <p>&bull; '
        .$plugin_tx['glossaire']['admin_definition_bottom_right_color'].
        '</p>
        </td>
        <td width="50%">
        '.GetSelector("defin5", "$defin[5]", "ap_def", "border-right").'
        </td></tr>
        </table>
        </fieldset>
        <br />
        <p style="text-align:center;">
        <input class="submit" type="submit" form="adminconfig" value="'.$plugin_tx['glossaire']['admin_button_save'].'" />
        </p>
        </form>';
        
        // Bloc de l'aperçu des définitions
        $o .= '<div id="fixe">
        <div class="apercu">
        <div class="pp" id="ap_def">
        <div id="ap_titre"><h4>'.$plugin_tx['glossaire']['admin_txt_apercu_title'].'</h4></div>
        <div class="def" id="ap_txtdef"><p>'.$plugin_tx['glossaire']['admin_txt_apercu_txt1'].'<br /><br />'.$plugin_tx['glossaire']['admin_txt_apercu_txt2'].'</p></div>
        </div>
        </div>
        </div>
        </div>';

        break; // FIN CONFIGURATION
                      
        default:
        $o .= plugin_admin_common($action, $admin, $plugin);
       } 
    }
