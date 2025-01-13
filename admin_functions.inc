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

if (!defined("PATH_GLOSS_CONFIG")) define("PATH_GLOSS_CONFIG", $pth['folder']['plugins']."glossaire/config/");     
if (!defined("PATH_GLOSS_DATA")) define("PATH_GLOSS_DATA", $pth['folder']['plugins']."glossaire/data/");

//traitement mot et titre avant écriture
function clean_str($str) {
   $str = strip_tags($str);
   $str_a = html_entity_decode($str);
   $str_b = preg_replace("`&[^\s]*;`", '', $str_a);
   $str_final = preg_replace("`[&#;\]\[\}\{\(\)]`", '', $str_b);
   return $str_final;
}

//lecture_mots() - charge le fichier wlist.inc et sort une variable tableau $lignes contenant [[nr][mot fr][mot en]]

function lecture_mots() {
  global $lignes, $sl;
  $lignes = array();
  $lefichier = "";
  if (is_file(PATH_GLOSS_DATA.$sl."/wlist".INCEXT)) {
     $fp = fopen (PATH_GLOSS_DATA.$sl."/wlist".INCEXT, "r");
     while (!feof($fp)) {
        $buffer = fgets ($fp, 4096);
        $lefichier .= $buffer;
     }
       fclose ($fp);
  
     if ($lefichier != ""){
        $lefichier = trim($lefichier);
        $lignes2 = explode(";", $lefichier);         //0|1|2;0|1|2 => [0|1|2] [0|1|2]
        for($i=0; $i<count($lignes2); $i++) {
           $lignes[$i] = explode("|",$lignes2[$i]);  // [0|1|2] [0|1|2] => [ [0][1][2] ] [ [0][1][2] ]
        }
     }
     return $lignes;
  }
}

//affiche_mots() - partant de $lignes, génère un tableau html affichant les mots et leur lien d'édition/suppression.

function affiche_mots() {
   global $lignes, $motaff, $sl, $pth, $mot, $img_nr, $img_mot, $img_on, $img_off, $choix, $let, $plugin_tx;

   if (!empty($let)) {         //Récup des paramètres du Filtre s'il a été utilisé
      $val_let_filtre = htmlentities($let);
   }
   if (!empty($val_let_filtre)) {       //intégration paramètres filtre à conserver
      $param_filtre = "<input type=\"hidden\" name=\"let_filtre\" value=\"".$val_let_filtre."\" />\n";
   }
   else {
        $param_filtre = "";
   }                                  
   $form_tri_nr = "\n<form name=\"tri_nr\" action=\"#haut_gl\" method=\"post\">".$param_filtre."\n<input type=\"hidden\" name=\"choix\" value=\"0\" /><button type=\"submit\" class=\"".$img_nr."\"> Id</button></form>\n";
   $form_tri_mot = "\n<form name=\"tri_mot\" action=\"#haut_gl\" method=\"post\">".$param_filtre."\n<input type=\"hidden\" name=\"choix\" value=\"1\" /><button type=\"submit\" class=\"".$img_mot."\"> ".$plugin_tx['glossaire']['admin_txt_words']."</button></form>\n";
   $debform1 = "\n<thead><tr>\n<th class=\"th1\" scope=\"col\">".$form_tri_nr."</th>\n<th class=\"th2\" scope=\"col\">".$form_tri_mot."</th>\n";
   $finform = "\n<tfoot>\n<tr><td colspan=\"4\" align=\"right\"><div id=\"btn_add_cont\"><input id=\"btn_add\" class=\"btn_add\" type=\"button\" value=\"".$plugin_tx['glossaire']['admin_button_create_word']."\" title=\"".$plugin_tx['glossaire']['admin_button_create_word']."\" onclick=\"self.location.href=('?&amp;glossaire&amp;admin=plugin_main&amp;action=plugin_text&amp;normal&amp;lng=".$sl."&amp;def=new#haut_gl')\" /></div><span class=\"suppr_txt\" id=\"suppr_txt\"></span><input onclick=\"validForIE()\" form=\"supprmot\" id=\"suppr_mots\" class=\"btn_ko suppr\" type=\"submit\" value=\"".$plugin_tx['glossaire']['admin_txt_delete']."\" title=\"".$plugin_tx['glossaire']['admin_txt_delete']."\" /></td></tr></tfoot>\n";
   $debtabl = "\n<tbody>\n<tr><td colspan=\"4\">\n<div class=\"innerb\">\n<table class=\"tabletwo2\">\n<tbody>\n";
   $debform3 ="<th class=\"th4\" scope=\"col\"><img src=\"".$pth['folder']['plugins']."glossaire/img/suppr.png\" alt=\"".$plugin_tx['glossaire']['admin_txt_deletion']."\" title=\"".$plugin_tx['glossaire']['admin_txt_deletion']."\" /><form id=\"supprmot\" name=\"supprmot\" action=\"\" method=\"post\">".$param_filtre."<input type=\"hidden\" name=\"suppr\" value=\"1\" /></form></th><th class=\"thbout\" scope=\"col\"></th></tr></thead>\n";
   $debform = $debform1.$debform3;

   for($i=0; $i<count($lignes); $i++) {   //début boucle
       $nrtmp = $lignes[$i][0];
       $mottmp = $lignes[$i][1];

       // une ligne du tableau sur deux : background différencié
       if ($i%2 == 0) {
          $fonce = " class=\"fonce\"";
       }
       else { 
            $fonce = "";
       }

       $motdeb = "<tr id=\"lign".$i."\" ".$fonce.">\n<td class=\"td1\" scope=\"row\">".$nrtmp."</td>\n<td class=\"td2\"><a href=\"?&amp;glossaire&amp;admin=plugin_main&amp;action=plugin_text&amp;normal&amp;lng=".$sl."&amp;def=".$nrtmp."#haut_gl\" title=\"".$plugin_tx['glossaire']['admin_txt_edit']." : ".$mottmp."\">".$mottmp."</a></td>\n";
       $motfin = "<td class=\"td4\"><input form=\"supprmot\" id=\"coch".$i."\" type=\"checkbox\" name=\"mot[]\" value=\"".$nrtmp."\" onclick=\"ChangeClass(this)\" /></td></tr>\n";
       $mottmp = $motdeb.$motfin;
       $motaff .= $mottmp;
   } //fin boucle

   $tableone = "tableone2";
   $motaff = "\n<table class=\"".$tableone."\">".$debform.$debtabl.$motaff."</tbody></table></div></td></tr></tbody>\n".$finform."</table>";           //$debform = partie head, $finform = partie foot, $motaff = partie body du tableau

   return $motaff;    //$motaff = le tableau html à afficher dans l'admin.
}

//ecriture_mots() - partant de $lignes (qui peut comporter des éléments vides, voir SupprMot()), écrit le fichier wlist.inc

function ecriture_mots(){
   global $lignes, $memo2, $sl;
   $final = $lignes;
   if (is_array($final)) {
      $cte = count($final);

      for ($i=0; $i<$cte; $i++) {
          $joinligne[$i] = join ("|", $final[$i]); //[ [0][1] ] [ [0][1] ] => [0|1] [0|1]
          if ($joinligne[$i] == "|"){              //si les éléments relatifs à un mot sont vides, supprimer l'élément les contenant.
             unset($joinligne[$i]);
          }
      }

   $textjoin = join (";", $joinligne);             // [0|1] [0|1] => 0|1;0|1
   $memo2 = $textjoin;
   $dossier = PATH_GLOSS_DATA.$sl;                 // Création sous-dossier data/xx/ s'il n'existe pas. (xx = langue)
   if(!is_dir($dossier)){
      mkdir($dossier);
   }

   $fichier= fopen (PATH_GLOSS_DATA.$sl."/wlist".INCEXT ,"w");
   fputs ($fichier, $memo2);
   fclose ($fichier);
   }
}

//EcriDef() - Ecrit le fichier de définition defx.inc

function EcriDef() {                                 
  global $defmot,$deftit,$deftxt,$numdef,$defconf0,$defconf1,$sl;
  
  $dossier = PATH_GLOSS_DATA.$sl;  // Création sous-dossier data/xx/ s'il n'existe pas. (xx = langue)
           if(!is_dir($dossier)){
             mkdir($dossier);
           }

  $rec = "<?php
\$defconf0 = stripslashes(\"$defconf0\");
\$defconf1 = stripslashes(\"$defconf1\");
\$defmot = stripslashes(\"$defmot\");
\$deftit = stripslashes(\"$deftit\");
\$deftxt = stripslashes(\"$deftxt\");
?>";
  WriteDefDB(PATH_GLOSS_DATA.$sl."/def_".$numdef.INCEXT,$rec);
}


//FindNrMax - Permet de calculer le numéro disponible pour la création d'un mot.

function FindNrMax() {
  global $nrdispo,$lignes;
  $i = 0;

  while (!empty ($lignes[$i][0])) {                
     $tslesnr[$i] = $lignes[$i][0];            
     $i++;
  }
  if (empty ($lignes)) {                
     $nrdispo = 1;
  }
  else {
       $nrdispo = max($tslesnr)+1;          
  }
  return $nrdispo;
}

//SupprMot($nr) -  partant de $mot[] généré par le form de suppression (cases à cocher), permet de supprimer les mots cochés.

function SupprMot($nr) {
   global $lignes, $sl;
   
   lecture_mots();
   
   //suppression du mot dans la liste
  $cptelist = count($lignes);
  $cpte = count($nr);             
  $i = 0;
  while ($i<$cpte) {                          
     $nrmot = $nr[$i];          
     $c = 0;
     while ($c<$cptelist) {         
        if ($lignes[$c][0] == $nrmot) {     
           $lignes[$c][0] = "";
           $lignes[$c][1] = "";            
                            
           //et suppression defx.inc correspondant
           if (file_exists(PATH_GLOSS_DATA.$sl."/def_".$nrmot.INCEXT)) {
           DeletDefDB(PATH_GLOSS_DATA.$sl."/def_".$nrmot.INCEXT);
           }
        }
     $c++;
     }
  $i++;
  }
  ecriture_mots();
}


//ModifMot($nr) - Permet de modifier un mot dans la liste $lignes avant de reécrire wlist.inc avec ecriture_mots()

function ModifMot($nr) {
   global $o, $lignes, $mot, $nrdispo, $plugin_tx;

   lecture_mots();
   
   //modification du mot dans la liste
  $i = 0;
  $rempl = 0;

  while (!empty ($lignes [$i][0])) {
     if ($lignes[$i][0] == $nr) {
        $lignes[$i][1] = $mot;
        $rempl = 1;
     }
     $i++;
  }
  if ($rempl == 0) {
     //Détection des doublons et alerte
     $c = 0;
     while (!empty ($lignes [$c][0])) {
        if (($lignes[$c][1] == $mot) && ($lignes[$c][1] != "")) {
           $doublon = $plugin_tx['glossaire']['admin_txt_the_word']." [".$mot."] ".$plugin_tx['glossaire']['admin_txt_already_exist'];
           $o .= XH_message('warning', $doublon);
        }
     $c++;
     }
     //fin doublons
         
     $cpte = count($lignes);
     $lignes[$cpte][0] = $nr;
     $lignes[$cpte][1] = $mot;
  }
  ecriture_mots();
}

function WriteDefDB($fil,$DefDB) {
  $fhandle = fopen($fil, "w");
  fputs($fhandle, $DefDB);
  fclose($fhandle);
}

function DeletDefDB($fil) {
  @chmod($fil,0755);
  @chmod($fil,0777);
  @unlink($fil);
}

// vérifie et ajoute éventuellement init_Glossaire() dans template.htm du template.
function GlossActivation($template, $desactiv = '') {
    global $pth, $o, $tpl_state;
  $tpl_state = '';
    $code = '</head>';
    $code_mod = '</head><?php init_Glossaire(); ?>';
    $init_code = '<?php init_Glossaire(); ?>';
    $fich = $pth['folder']['templates'].$template.'/template.htm';
    $fich_sauv = $fich.'.bak';
    
    if (!$t = @fopen($fich,'r')) {
        $o .= '<div class="alert_activ">
               file template.htm can not be open, template : 
               <b>'.$template.'</b><br /><br />function [<b>fopen()</b>] problem<br /><br />File path : '.$fich.'<br /><br />
               Please add <b>&lt;?php init_Glossaire(); ?&gt;</b> manually juste after &lt;/head&gt;, on same line and without space.
               <br /></div>';
        return;
    }
    $contenu = file_get_contents($fich);
    $manualMod = strpos($contenu, $init_code);
    $alreadyMod = strpos($contenu, $code_mod);
    
    if (($alreadyMod === false) && ($manualMod !== false)) {
       fclose($t);
     $o .= '<div class="alert_activ">
          You added the code &lt;?php init_Glossaire ?&gt; <u>manually</u>.<br /><br />
          Please remove it and validate the Configuration page.<br /></div>';
     return;
  }
    
    if ($alreadyMod !== false) {
        if ($desactiv == 'on') {
            $contenuMod = str_replace($code_mod, $code, $contenu); // désactivation
            fclose($t);
        }
        else {
            fclose($t);
            return;
        }
    }
    else {
        $contenuMod = str_replace($code, $code_mod, $contenu);
        $tpl_state = 1;
        fclose($t);
    }
    
    // création sauvegarde .bak
    $sauv =fopen($fich_sauv,'w');
    fwrite($sauv,$contenu);
    fclose($sauv);
    
    //Ecriture - remplace </head> par </head>< ? php init_Glossaire ? > ou l'inverse si désactivation
    $t2=@fopen($fich,'w+');
    fwrite($t2,$contenuMod);
    fclose($t2);
}

function checkActivation($template) {
  global $pth, $plugin_state, $desactiv;
    $fich = $pth['folder']['templates'].$template.'/template.htm';
    $init_code = '<?php init_Glossaire(); ?>';    

    if (!$t = @fopen($fich,'r')) {
        return;
    }
    $contenu = file_get_contents($fich);
    $modState = strpos($contenu, $init_code);
    fclose($t);
    
    if (($plugin_state == 'on') && ($modState === false)) { // code absent mais état activé dans config
    $fich = PATH_GLOSS_CONFIG.$template.INCEXT;  
    if (!$t = @fopen($fich,'r')) {
           return;
      }
    $before = '$plugin_cf["glossaire"]["plugin_disable_state"] = stripslashes("");';
    $after = '$plugin_cf["glossaire"]["plugin_disable_state"] = stripslashes("on");';
    $contenu = file_get_contents($fich);
    $contenuMod = str_replace($before, $after, $contenu); 
       fclose($t);
       
       // Ecriture fichier config
    $t2=@fopen($fich,'w+');
      fwrite($t2,$contenuMod);
      fclose($t2);

 }
      $desactiv = ($modState === false) ? 'on' : '';
}

// permet de changer de langue depuis la liste des mots
function language_choice(){
    global $pth, $cf, $sl;
    
    $url = '?&amp;glossaire&amp;admin=plugin_main&amp;action=plugin_text&amp;normal#haut_gl';

    $r = XH_secondLanguages();
    array_unshift($r, $cf['language']['default']);
    $i = array_search($sl, $r);
    unset($r[$i]);

    $langNames = explode(';', $cf['language']['2nd_lang_names']);
    foreach ($langNames as $value) {
        $langName[substr($value, 0, 2)] = substr($value, 3);
    }

    $t = '';
    foreach ($r as $lang) {
        $base_url = $pth['folder']['base']
            . ($lang == $cf['language']['default'] ? '' : $lang . '/');
        $img = $pth['folder']['flags'] . $lang . '.gif';

        $title = isset($langName[$lang])
            ? $langName[$lang]
            : $lang;

        $el = file_exists($img)
                ? '<img src="' . $img
                . '" alt="' . $title
                . '" title="' . $title
                . '" class="flag">'
                : $title;
        $t .= '<a href="' . $base_url . $url . '">' . $el . '</a> ';
    }
    return $t;
}

// Générer l'alphabet utilisé pour le filtre (Liste des mots)
function get_alphabet($lng){
    $out = '';
    $fr = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $gr = array('Α','Β','Γ','Δ','Ε','Ζ','Η','Θ','Ι','Κ','Λ','Μ','Ν','Ξ','Ο','Π','Ρ','Σ','Τ','Υ','Φ','Χ','Ψ','Ω');
    $ru = array('А','Б','В','Г','Д','Е','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я');
    
    switch ($lng) {
        case 'cs':
        case 'da':
        case 'de':
        case 'en':
        case 'es':
        case 'fi':
        case 'fr':
        case 'hu':
        case 'it':
        case 'nl':
        case 'no':
        case 'pl':
        case 'se':
        case 'sk':
            $arr = $fr;
            break;
        case 'gr':
            $arr = $gr;
            break;
        case 'ru':
            $arr = $ru;
            break;
    }
    foreach ($arr as $value) {
        $out .= '<a href="?&amp;glossaire&amp;admin=plugin_main&amp;action=plugin_text&amp;normal&amp;let='.$value.'#haut_gl">'.$value.'</a> | ';
    }
    return $out;
}
