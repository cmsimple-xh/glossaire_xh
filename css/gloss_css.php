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
header("Content-type: text/css; charset=iso-8859-1");   //pour la compatibilité avec FireFox et autre nav non css dyn
header("Pragma: no-cache", false);

define("CHEMIN", "../../../");
if (!defined("PATH_GLOSS_CONFIG")) define("PATH_GLOSS_CONFIG", CHEMIN."plugins/glossaire/config/");
if (!defined("PATH_GLOSSAIRE")) define("PATH_GLOSSAIRE", CHEMIN."plugins/glossaire/");

if  (isset($_GET['tpl'])){$tpl = htmlentities(strip_tags($_GET['tpl']));}
else {$tpl = "";}
$plugin_cf = array();

if (is_file(PATH_GLOSS_CONFIG.$tpl.".inc")) {
    include(PATH_GLOSS_CONFIG.$tpl.".inc");
    echo "/* Plugin GLOSSAIRE - generate for template = ".$tpl." */";
}
else if (is_file(PATH_GLOSS_CONFIG."config.php")){
    include(PATH_GLOSS_CONFIG."config.php");
    echo "/* Plugin GLOSSAIRE - default configuration */";
}
?>

.gpop{
cursor:help;
text-decoration: none;
border-bottom: 1px <?php echo $plugin_cf['glossaire']['occurrence_underline_type']." ".$plugin_cf['glossaire']['occurrence_underline_color']; ?>;
}

.larg1 {
width: <?php echo $plugin_cf['glossaire']['definition_width']; ?>;
}

.larg2 {
width: <?php echo $plugin_cf['glossaire']['definition_width_increased']; ?>;
}

.pp {
position: fixed;
left: -999px;
top: 0;
border-radius: 6px 6px; 
-moz-border-radius: 6px;
-webkit-border-radius: 6px;
-khtml-border-radius: 6px;
box-shadow: 3px 3px 9px #999 !important;
-webkit-box-shadow: 3px 3px 9px #999;
-khtml-box-shadow: 3px 3px 9px #999;
border: 1px solid <?php echo $plugin_cf['glossaire']['definition_top_left_border']; ?>;
border-top: 1px solid <?php echo $plugin_cf['glossaire']['definition_top_left_border']; ?>;
border-bottom: 1px solid <?php echo $plugin_cf['glossaire']['definition_bottom_right_border']; ?>;
border-right: 1px solid <?php echo $plugin_cf['glossaire']['definition_bottom_right_border']; ?>;
background: <?php echo $plugin_cf['glossaire']['definition_text_background']; ?>;
color: <?php echo $plugin_cf['glossaire']['definition_text_color']; ?>;
font-family: <?php echo $plugin_cf['glossaire']['definition_text_font']; ?>;
font-size: <?php echo $plugin_cf['glossaire']['definition_text_size']; ?>;
z-index: 500;
overflow: hidden;
}

.pp p {
color: <?php echo $plugin_cf['glossaire']['definition_text_color']; ?>;
}

.def {
margin: 0.3em 0.3em;
}

.pp a:hover{
position: static;
}

.pp h4 {
height: 16px;
vertical-align: middle;
line-height: 16px;
border-radius: 6px 6px 0px 0px; 
-moz-border-radius: 6px 6px 0px 0px;
-webkit-border-radius: 6px 6px 0px 0px;
-khtml-border-radius: 6px 6px 0px 0px;
font-family: <?php echo $plugin_cf['glossaire']['definition_title_font']; ?>;
font-size: <?php echo $plugin_cf['glossaire']['definition_title_size']; ?>;
margin: 0 0 0.5em 0;
border-bottom: 1px solid <?php echo $plugin_cf['glossaire']['definition_title_background']; ?>;
background: <?php echo $plugin_cf['glossaire']['definition_title_background']; ?>;
color: <?php echo $plugin_cf['glossaire']['definition_title_color']; ?>;
text-align: center;
}

.impr {
display: none;
}

.figer {
background: url("<?php echo PATH_GLOSSAIRE; ?>img/fermer.png") no-repeat 0 0px;
width: 17px;
height: 17px;
float: right;
}
.figer:hover {
background: url("<?php echo PATH_GLOSSAIRE; ?>img/fermer.png") no-repeat 0 -34px;
width: 17px;
height: 17px;
float: right;
}

@media print {
    div.impr { 
    display: block;
    margin-top: 30px;
    width: 80%;
    border-top: 1px solid black; 
    margin-left: auto;
    margin-right: auto;
    }
    .impr h3 {
    font-size: 14px;
    text-decoration: underline;
    }
    .pp { 
    position: static;
    left: 0;
    background: transparent;
    border: 0;
    color: black;
    font-size: 10px;
    padding: 5px;
    box-shadow: none !important;
    }
    .larg1, .larg2 {
    width: 45%; /* 32% => définitions sur 3 colonnes */
    float: left;
    }
    .pp h4 {
    color: black;
    font-size: 11px;
    margin: 0;
    text-align: left;
    background: transparent;
    }
    .pp p {
    margin: 2px 0 5px 0;
    }
    div#content a {
    text-decoration:underline;
    }
    .figer, object {
    display: none;
    }
}
/* pour affichage sur smartphone */
@media screen and (max-width: 440px) {
    .larg1, .larg2 {
    width: 10em;
    }
}
@media screen and (min-width: 441px) and (max-width: 520px) {
    .larg1, .larg2 {
    width: 16em;
    }
}
