<?php
/*
 * ==================================================================
 * Plugin GLOSSAIRE_XH for CMSimple_XH (1.7.x)
 * ==================================================================
 * @version:    2.0.2 - 2025 01 13
 * @copyright  Ludovic AMATHIEU
 * @author    https://www.f5swn.fr/en/ (and contact)
 *
 * @copyright 2024 The CMSimple_XH developers <http://cmsimple-xh.org/?The_Team>
 * @author    The CMSimple_XH developers <devs@cmsimple-xh.org>
 *
 * @license    GNU GPLv3 - http://www.gnu.org/licenses/gpl-3.0.en.html
 * ==================================================================
 */
 

// Prevent direct access and usage from unsupported CMSimple_XH versions.
if (!defined('CMSIMPLE_XH_VERSION')
    || strpos(CMSIMPLE_XH_VERSION, 'CMSimple_XH') !== 0
    || version_compare(CMSIMPLE_XH_VERSION, 'CMSimple_XH 1.7.0', 'lt')
) {
    header('HTTP/1.1 403 Forbidden');
    header('Content-Type: text/plain; charset=UTF-8');
    die(<<<EOT
GLOSSAIRE detected an unsupported CMSimple_XH version.
Uninstall GLOSSAIRE or upgrade to a supported CMSimple_XH version!
EOT
    );
} 
 
$charset = 'utf-8';
define('INCEXT', '.inc');
define('ADMIN_TITLE', $plugin_tx['glossaire']['admin_title']);
define('ADMIN_INTRO', $plugin_tx['glossaire']['admin_intro']);
define('ADMIN_WORDS_AND_DEF_TITLE', $plugin_tx['glossaire']['admin_word_and_def_title']);
define('ADMIN_CONFIGURATION_TITLE', $plugin_tx['glossaire']['admin_configuration_title']);

if (!defined("PATH_GLOSSAIRE")) define("PATH_GLOSSAIRE", $pth['folder']['plugins']."glossaire/");
if (!defined("PATH_GLOSS_CONFIG")) define("PATH_GLOSS_CONFIG", $pth['folder']['plugins']."glossaire/config/");     
if (!defined("PATH_GLOSS_DATA")) define("PATH_GLOSS_DATA", $pth['folder']['plugins']."glossaire/data/");

$versionStr = @file_get_contents($pth['folder']['plugins'].'glossaire/version.nfo');
if ($versionStr != '') {
    $versionArr = explode(',', $versionStr);
    $vresult = $versionArr[2];
}
else $vresult = 'undefined';

define('GLOSS_VERSION', $vresult);
include($pth['folder']['plugins']."glossaire/function_gloss.inc");

// Initialisation du plugin Glossaire 
// (fonction appelée depuis template.htm dont le template a été activé depuis la configuration)
function init_Glossaire(){
    global $o, $s, $c, $edit, $sl, $pth, $charset, $plugin_tx, $plugin_cf, $cl, $h, $cf;
    if (!($edit)) {        
     if(file_exists(PATH_GLOSSAIRE."gloss_inc1".INCEXT)) {
         include(PATH_GLOSSAIRE."gloss_inc1".INCEXT);
         include(PATH_GLOSSAIRE."gloss_inc2".INCEXT);
     }
    }
}

// définition template en cours / template choisi dans select de la configuration
$tpl_choosen =  import('tpl_choosen', 'POST'); // issu du select liste des templates
$tpl_act = import('tpl', 'POST'); // issu de la validation du formulaire
$tpl_value = ($tpl_choosen != '') ? $tpl_choosen : (($tpl_act != '') ? $tpl_act : $cf['site']['template']); 
if ($tpl_act != '') $tpl_choosen = $tpl_act;

// Lecture config, état du plugin (actif ou désactivé)
function glossaire_readConfig() {
    global $pth, $tpl_value, $plugin_cf;
    $config = PATH_GLOSS_CONFIG.$tpl_value.INCEXT;
    if (file_exists($config)) {
        return XH_includeVar($config, 'plugin_cf')['glossaire'];   // si config template existe
    }
    else return $plugin_cf['glossaire'];  // sinon config par défaut
}
$glossaire_cf = glossaire_readConfig();

$plugin_state = ($glossaire_cf["plugin_disable_state"] == 'on') ? 'off' : 'on';

if (($plugin_state == 'on') || XH_ADM) {

  if ((file_exists(PATH_GLOSSAIRE."js/gloss.js")) && (file_exists(PATH_GLOSSAIRE."css/gloss_css.php"))) {
     $hjs .= "<script type=\"text/javascript\" src=\"".PATH_GLOSSAIRE."js/gloss.js\"></script>\n";
     if (file_exists(PATH_GLOSSAIRE."js/fonct_util.js")){$hjs .= "<script language=\"javascript\" type=\"text/javascript\" src=\"".PATH_GLOSSAIRE."js/fonct_util.js\"></script>\n";}
     $hjs .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"".PATH_GLOSSAIRE."css/gloss_css.php?tpl=".$tpl_value."\" />\n";
  }
}
