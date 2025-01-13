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
if (!defined("PATH_GLOSSAIRE")) define("PATH_GLOSSAIRE", $pth['folder']['plugins']."glossaire/");

$version = "\n<!-- Plugin GLOSSAIRE V ".GLOSS_VERSION." -->\n\n";

// Les fonctions suivantes complètent $lemot avant sont insertion dans la regex avec la prise en charge du pluriel
// Il est prévu une fonction par langue (pluriel_fr pour le français par exemple).

// cs=Čeština (Tchèque)
function pluriel_cs($var) {
   $search = array(
      '`(?<![\(\|\)])(í)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(ítě)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(a)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(e|ě)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(o)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(á)(n)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(d|h|ch|k|n|r|s|t)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(e)?(č|c)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(e)?(ř)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(e)?(š)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(e)?(ž)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(e)?(j)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(e)?(ď)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(e)?(ť)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(e)?(ň)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\)\?])\z`',
            );

   $replace = array(
            '($1|$1ch|$1ho|$1m(i|u)?)',
            '($1|ěti)',
            '($1|ami|á(ch|m)|ě|e(ch|m)?|o(vé|vi|u)?|u|ů(m)?|y)?',
            '($1|at(a|ech|ům|y)?|em(i)?|et(e|em|i)|i|í(ch|m)?|ů(m)?)',
      '($1|a|e(ch|m)|ě|u|ům|y)?',
            '($1|a)$2(a|e(ch|m)?|i|í|mi|o(vé|vi|u)?|u|ů(m)?|y)?',
            '$1(a|e(ch|m)?|i|í|mi|o(vé|vi|u)?|u|ů(m)?|y)?',
            '($1)?$2(e(m)?|ě(m|mi)?|i|í(ch|m)?|ů(m)?)?',
            '($1)?($2|r)(e(m)?|ě(m|mi)?|i|í(ch|m)?|ů(m)?)?',
            '($1)?($2|s)(e(m)?|ě(m|mi)?|i|í(ch|m)?|ů(m)?)?',
            '($1)?($2|z)(e(m)?|ě(m|mi)?|i|í(ch|m)?|ů(m)?)?',
            '($1)?$2(e(m)?|ě(m|mi)?|i|í(ch|m)?|ů(m)?)?',
            '($1)?($2|d)(e(m)?|ě(m|mi)?|i|í(ch|m)?|ů(m)?)?',
            '($1)?($2|t)(e(m)?|ě(m|mi)?|i|í(ch|m)?|ů(m)?)?',
            '($1)?($2|n)(e(m)?|ě(m|mi)?|i|í(ch|m)?|ů(m)?)?',
            '(e|i|y)?',
            );
   $var = preg_replace ($search, $replace, $var, 1);
   return $var;
}

// da=Dansk (Danois)
function pluriel_da($var) {
   $search = array(
      '`(at)\b`',
      '`(af)\b`',
      '`(en)\b`',
      '`(?<![\(\|\)])(æ)(t)(?![\(\|\)])\b`',
      '`(?<![\(\|\)])(er)(?![\(\|\)])\b`',
      '`(?<![\(\|\)])(o)(?![\(\|\)])\b`',
      '`(?<![\(\|\)])(o|a)(?![\(\|\)])`',
      '`(?<![\(\|\)])(æ)(?![\(\|\)])`',
      '`(?<![\(\|\)])(a|e|i|o|ø|u)(b|c|d|f|g|h|j|k|l|m|n|p|q|r|s|t|v|w|x|z)(?![\(\|\)])\b`',
      '`(?<![\(\|\)])(dom)(?![\(\|\)])\b`',
      '`(?<![\(\|\)])(e)(?![\(\|\)])\b`',
      '`(?<![\(\|\)])(s)(?![\(\|\)])\b`',
      '`(?<![\(\|\)])(er)(?![\(\|\)])\b`',
      '`(?<![\(\|\)])(a|i|o|u|æ|heb|ing|feb)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])\z`',
      );

   $replace = array(
      '($1|$1te|$1er|$1et|$1erne)',
      '($1|$1fe|$1fer)',
      '($1|e|ne|ner)',
      '($1$2|$1$2$2et|$1dder|$1dderne)',
      '($1|re)',
      '($1|øer)',
      '($1|ø|æ)',
      '($1|jø)',
      '($1$2|$1$2$2|$2$1r|$1$2t)(e|er|et|ne|ene|erne)?',
      '($1|$1e)',
      '($1|$1r|$1rne|$1t|n$1)',
      '($1|$1ene|$1e)',
      '($1|re|rer)',
      '($1|$1er)',
      '(e|er|et|ene|erne)?',
      );

   $var = preg_replace ($search, $replace, $var, 1);
   return $var;
}

// de=Deutsch (Allemand)
function pluriel_de($var) {
   $search = array(
      '`(at|au|e|ent|and|ant|ist|or|ion|ik|heit|keit|shaft|tät|ung)\b`i',
      '`(in)\b`i',
      '`(ma|um|us)\b`i',
      '`(eur|ich|ier|ig|ling)\b`i',
      '`(to)\b`i',
      '`(?<![\(\|])(a)(?![\(\|])`i',         
      '`(?<![\(\|])(o)(?![\(\|])`i',         
      '`(?<![\(\|])(u)(?![\(\|])`i',         
      '`(?<![\)])\z`',          
      );

   $replace = array(
      '($1|$1e|$1n|$1en|$1er)',
      '($1|$1eu|$1nen|$1e)',
      '($1|men|uen)',
      '($1|$1e)',
      '($1|ten|tos)',
      '($1|ä)',
      '($1|ö)',
      '($1|ü)',
      '(s|n|en|nen|e|er|ern|se)?',
      );

   $var = preg_replace ($search, $replace, $var, 1);
   return $var;
}

// en=English (Anglais)
function pluriel_en($var) {
   $search = array(
      '`(an)\b`',
      '`(?<![?\(\|\)])(us)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(a)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(o)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(on)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(sis)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(ouse)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(ild)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(f|fe)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(oo)(se|t|th)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(ch|s|ss|sh)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(b|c|d|f|g|h|j|k|l|m|n|p|q|r|s|t|v|w|x|z)(y)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])\z`',
      );

   $replace = array(
      '($1|$1s|en)',
      '($1|$1es|i)',
      '($1|$1e|$1s)',
      '($1|$1s|$1es)',
      '($1|$1s|a)',
      '($1|$1es|ses)',
      '($1|$1s|ice)',
      '($1|$1s|$1es|$1ren)',
      '($1|ves)',
      '($1$2|ee$2)',
      '($1|$1es)',
      '($1$2|$1ies)',
      '(s)?',
      );

   $var = preg_replace ($search, $replace, $var, 1);
   return $var;
}

// fr=Français
function pluriel_fr($var) {
   $search = array(
      '`(al)\b`',
      '`(?<![\(\|])(ail)\b`',
      '`(?<![\(\|])(eu)\b`',
      '`(?<![\(\|])(au)\b`',
      '`(?<![\(\|])(ou)\b`',
      '`(?<![\)sxz])\z`',
      );

   $replace = array(
      '($1|aux|aus|als)',
      '($1|aux|aus|ails)',
      '($1|eux|eus)',
      '($1|aux|aus)',
      '($1|oux|ous)',
      '(s)?',
      );

   $var = preg_replace ($search, $replace, $var, 1);
   return $var;
}

// it=Italiano (Italien)
function pluriel_it($var) {
   $search = array(
      '`(llo)\b`',
      '`(?<![\(\|])(e)\b`',
      '`(?<![\(\|])(co)\b`',
      '`(?<![\(\|])(ca)\b`',
      '`(?<![\(\|])(go)\b`',
      '`(?<![\(\|])(ga)\b`',
      '`(?<![\(\|])(ia)\b`',
      '`(?<![\(\|])(o)\b`',
      '`(?<![\(\|])(a)\b`',
      );

   $replace = array(
      '($1|la)',
      '($1|oi)',
      '($1|ci|chi|che)',                
      '($1|chi|che)',
      '($1|gi|ghi|ghe)',                
      '($1|ghe)',
      '($1|e|ie)',
      '($1|ini|ei|a||i)',
      '($1|e)',
      );

   $var = preg_replace ($search, $replace, $var, 1);
   return $var;
}

// nl=Nederlands (Néerlandais)
function pluriel_nl($var) {
   $search = array(
      '`(?<![?\(\|\)])(a|o)\1(f)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(us)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(f)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(s)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(eid)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(a|e|i|o|u|y)\1(b|c|d|f|g|h|j|k|l|m|n|p|q|r|s|t|v|w|x|z)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(a|e|i|o|u|y)(b|c|d|f|g|h|j|k|l|m|n|p|q|r|s|t|v|w|x|z)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(a|i)(b|c|d|f|g|h|j|k|l|m|n|p|q|r|s|t|v|w|x|z)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(e|i)(e)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])(b|c|d|f|g|h|j|k|l|m|n|p|q|r|s|t|v|w|x|z)(a|e|i|o|u|y)(?![\(\|\)])\b`',
      '`(?<![?\(\|\)])\z`',
      );

   $replace = array(
      '($1$1$2|$1$2en)',
      '($1|$1(s)?en|uzen|i)',
      '($1|$1s|ven)',
      '($1|$1en|zen)',
      '($1|eden)',
      '($1$1$2|$1$1$2s|$1$2en)',
      '($1$2|$1$2s|$1$2($2)?en|e$2en)',
      '($1$2|$1$2s|e$2en)',
      '($1$2|$1$2s|$1($2)?ën)',
      '($1$2|$1$2s)',
      '(s|eren)?',
      );

   $var = preg_replace ($search, $replace, $var, 1);
   return $var;
}

// ru=Русский (Russe)
function pluriel_ru($var) {
   $search = array(
      '`(к|г|х|ш|щ|ж|ч)(а|о|у|э|ы|ь)?(?!\pL)`u',
      '`(?<![\(\|])(е)(?!\pL)(?![\(\|])`u',       
      '`(?<![\(\|])(o)(?!\pL)(?![\(\|])`u',
      '`(?<![\(\|])(a)(?!\pL)(?![\(\|])`u',
      '`(?<![\(\|])(я|ь|й)(?!\pL)(?![\(\|])`u',
      '`(?<![\)])\z`',        
      );

   $replace = array(
      '($1$2|$1и|$1а)',
      '($1|я)',
      '($1|а)',
      '($1|Ы|ы|и)',
      '($1|и)',
      '(Ы)?',
      );
   $var = preg_replace ($search, $replace, $var, 1);
   return $var;
}

// sk=Slovenčina (Slovaque)
function pluriel_sk($var) {
   $search = array(
      '`(?<![\(\|\)])(e)(st)(o)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(a|e|i|o|u|y)(s)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(ch|k)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(ôň)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(ôž)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(ňa)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(i|u)(e)?(b|c|d|dz|f|g|h|j|l|m|n|p|r|s|t|v)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(a|e|i|o|u)(b|c|d|dz|f|g|h|j|l|m|p|r|s|t|v)(y)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(a|á|e|i|ie|í|o)(b|c|d|dz|f|g|h|j|l|m|n|p|r|s|t|v|z)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(b|c|d|dz|f|g|h|j|l|m|n|p|r|s|t|v)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(č)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(ď)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(dž)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(ň)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(ř)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(š)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(ť)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(ž)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(ie)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(á)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(e)(b|c|d|dz|f|g|h|j|l|m|n|p|r|s|t|v)(a)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(i)(b|c|d|dz|f|g|h|j|l|m|n|p|r|s|t|v)(a)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(a|ä)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(o|ö|ő)(?![\(\|\)])(?!\pL)`u',
      '`(?<![\(\|\)])(e|é|ě|i|í|u|ü|ű|y)(?![\(\|\)])(?!\pL)`u',
            );

   $replace = array(
      '(i)?$1$2(i)?($3|a(mi)?|á(ch|m)?|e|om|u)?',
            '($1$2|$1|a|$1$2a|$2y)',
            '($1|ci|si|ky)',
            '($1|on)(e)?',
            '($1|ož)(e)?',
            '($1|ne)(e)?',
            '($1$2$3|$2$3)(a|á(ch|m)|e|í|i(a(ch|m))?|mi|o(ch|m|u|v(i|ia)?)|u|y)?',
            '($1$2$3|(a|á|é|í|ie|iu|ó|ô|ú)$2(y)?)',
            '($1)?$2((a)?(mi)?|á(ch|m)|e|í|i(a(ch|m))?|o(ch|m|u|v(i)?(a)?)?|u|y)?',
            '$1((a)?(mi)?|á(ch|m)|e|í|i(a(ch|m))?|o(ch|m|u|v(i)?(a)?)?|u|y)?',
      '($1|c)((a)?(mi)?|á(ch|m)|e|í|i(a(ch|m))?|o(ch|m|u|v(i)?(a)?)?|u|y)?',
      '($1|d)((a)?(mi)?|á(ch|m)|e|í|i(a(ch|m))?|o(ch|m|u|v(i)?(a)?)?|u|y)?',
      '($1|dz)((a)?(mi)?|á(ch|m)|e|í|i(a(ch|m))?|o(ch|m|u|v(i)?(a)?)?|u|y)?',
      '($1|n)((a)?(mi)?|á(ch|m)|e|í|i(a(ch|m))?|o(ch|m|u|v(i)?(a)?)?|u|y)?',
      '($1|r)((a)?(mi)?|á(ch|m)|e|í|i(a(ch|m))?|o(ch|m|u|v(i)?(a)?)?|u|y)?',
      '($1|s)((a)?(mi)?|á(ch|m)|e|í|i(a(ch|m))?|o(ch|m|u|v(i)?(a)?)?|u|y)?',
      '($1|t)((a)?(mi)?|á(ch|m)|e|í|i(a(ch|m))?|o(ch|m|u|v(i)?(a)?)?|u|y)?',
      '($1|z)((a)?(mi)?|á(ch|m)|e|í|i(a(ch|m))?|o(ch|m|u|v(i)?(a)?)?|u|y)?',
            '($1|i(a|ach|am|ami|u)?|í(m)?)',
            '($1(ch|m)?|ami|é|ej|ou|ú)',
            '($1)?(ie)?$2($3|y|u|e|o(ch|m|u|v|vi|via)?|ho|m|mu|(i)?(á|a)?(ch|m|mi)?|(i)?a(t|ť)((a|á)(m|mi)?|á(ch)?|om|u|i)?|en(iec|cami|ce|coch|com)?)?',
      '($1|í)$2($3|y|u|e|o(ch|m|u|v|vi|via)?|ho|m|mu|(i)?(á|a)?(ch|m|mi)?|(i)?a(t|ť)((a|á)(m|mi)?|á(ch)?|om|u|i)?|en(iec|cami|ce|coch|com)?)?',
            '($1)?(y|u|e|o(ch|m|u|v|vi|via)?|ho|m|mu|(i)?(á|a)?(ch|m|mi)?|(i)?a(t|ť)((a|á)(m|mi)?|á(ch)?|om|u|i)?|en(iec|cami|ce|coch|com)?)?',
            '($1)?(a(mi)?|á(m|ch)?|u|e|o(ch|m|v|via)|(ho|m|mu))?',
            '($1)?(i(a|ach|am)?|a(mi)?|u|o(ch|m|v|via)|(ho|m|mu))?',
            );
   $var = preg_replace ($search, $replace, $var, 1);
   return $var;
}

// Traitement des pluriels y compris mots composés (dont les termes sont séparés par un espace ou tiret)
function pluriel($var, $pluriel) {
  $sep = ( strpos($var, ' ') !== false ) ? ' ' : (( strpos($var, '-') !== false ) ? '-' : '');
  if ($sep != '') {
      $temp = explode ($sep, $var);
      foreach ($temp as $value) {
          $result[] = $pluriel($value);
      }
      $temp = implode ($sep, $result);
      return $temp;
     }
  else {
      $var = $pluriel($var);
      return $var;
     }
}    

//strpos appliquée à une variable tableau
function strpos_arr($array_defs, $gpop_div) {
    foreach($array_defs as $what) {
        if(($pos = strpos($what, $gpop_div))!==false) return $pos;
    }
    return false;
} 

//source : http://www.weirdog.com/blog/php/trier-les-cles-accentuees-dun-tableau-associatif.html
function wd_unaccent_compare_ci($a, $b) {
    return strcmp(strtolower(OteAccents($a)), strtolower(OteAccents($b)));
}

//Langues
if ($sl != "" ) {
      $pl_lng = $sl;
}
else {$pl_lng = "en";}

     switch ($pl_lng) {
        case 'cs':
            $ctype = $pl_lng."_CZ";
            break;
        case 'da':
            $ctype = $pl_lng."_DK";
            break;
        case 'et':
            $ctype = $pl_lng."_EE";
            break;
        case 'gr':
            $ctype = "el_".strtoupper($pl_lng);
            break;
        case 'hu':
            $ctype = $pl_lng;
            break;
        case 'pl':
            $ctype = $pl_lng;
            break;
        case 'se':
            $ctype = "sv_".strtoupper($pl_lng);
            break;
        case 'de':
        case 'en':
        case 'es':
        case 'fi':
        case 'fr':
        case 'it':
        case 'nl':
        case 'no':
        case 'sk':
        case 'ru':
            $ctype = $pl_lng."_".strtoupper($pl_lng);
            break;
    }

$char = strtoupper($charset);

setlocale(LC_CTYPE, '".$ctype.".".$char."'); //pour que le serveur accepte les caractères accentués dans le preg_replace plus bas.
                                         //nécessaire chez Free, par exemple.

 ///////////////////lecture de la liste de mots et stockage dans un tableau//////////////////////
$lefichier = "";
if (is_file(PATH_GLOSS_DATA.$sl."/wlist".INCEXT)) {         //si wlist.inc existe
   $fp = fopen (PATH_GLOSS_DATA.$sl."/wlist".INCEXT, "r");
   while (!feof($fp)) {
   $buffer = fgets ($fp, 4096);
   $lefichier .= $buffer;
   }
   fclose ($fp);

   if ($lefichier != ""){                      //si la liste n'est pas vide
      $lefichier = trim($lefichier);
      $lignes2 = explode(";", $lefichier);        //0|1;0|1 => [0|1] [0|1]

}
}
