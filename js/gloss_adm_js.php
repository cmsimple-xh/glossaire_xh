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
header("Content-type: text/javascript; charset=utf-8"); 
define("CHEMIN", "../../../");
define("PATH_GLOSSAIRE", CHEMIN."plugins/glossaire/");
if  (isset($_GET['lng'])){$lng = htmlentities(strip_tags($_GET['lng']));}
else {$lng = 'en';}

if (is_file(PATH_GLOSSAIRE."languages/".$lng.".php")) {
   include(PATH_GLOSSAIRE."languages/".$lng.".php");
}
?>
function donne_focus(id_chp) {
document.getElementById(id_chp).focus();
}

function verif_form() {
    var mot = document.adminsend.mot.value;
    var form = new RegExp("[\u2000-\u206F\u2E00-\u2E7F\\!\"#$%&()*+,\/:;<=>?@_`{|}~]","gi");
    var contr = mot.match(form);
    var message = "<?php echo $plugin_tx['glossaire']['admin_msg_special_char']; ?>";
    
    if(null != contr) { 
        alert (message);
        document.adminsend.mot.value = "";
        setTimeout('donne_focus("mot");', 1);
        }
}

// permet un onload sans conflit (remplace windows.onload)
function lancer(fct) {
if (window.addEventListener)
window.addEventListener('load', fct, false);
else
window.attachEvent('onload', fct);
}

var cptCoch = 0;
var idLign = "lign";     // prefixe id tr (ligne)
var idChk = "coch";    // prefixe id checkbox

function ChangeClass(chk,ini) {
    var addBtn = document.getElementById('btn_add_cont');
    var delBtn = document.getElementById('suppr_mots');
    var expr = /\d+$/gi;   // regexp pour extraction indice checkbox
    var indice = chk.id.match(expr);  // recupere indice checkbox
    ini = (ini == "on") ? "on" : "off";
 
    var lign = document.getElementById(idLign+indice);

    if (chk.checked) {
        lign.className = "coche";  
        cptCoch = cptCoch + 1;
        }
    else {
        lign.className = (indice/2 == Math.round(indice/2)) ? "fonce" : "";    // conserve style diff une ligne sur deux
        if (ini == "off") cptCoch = cptCoch > 0 ? cptCoch - 1 : cptCoch;
    }
    delBtn.className = cptCoch > 0 ? "btn_ok" : "btn_ko";
    addBtn.style.display = cptCoch > 0 ? "none" : "block";

    var txtBtn = cptCoch > 1 ? " <?php echo $plugin_tx['glossaire']['admin_txt_selections']; ?>" : " <?php echo $plugin_tx['glossaire']['admin_txt_selection']; ?>";

    document.getElementById("suppr_txt").innerHTML=cptCoch > 0 ? cptCoch+txtBtn : "";
}
 
function initchk() {
    var i;
    var tabChk = document.getElementsByTagName("input");
    var n = tabChk.length;
    var expr = new RegExp(idChk, "gi");
 
    for (i=0; i<n; i++)
    {
        if (tabChk[i].type.toLowerCase()=="checkbox" && expr.test(tabChk[i].id))
        { 
            ChangeClass(tabChk[i],'on');
        }
        expr.test("");  // reinitialisation attribut lastIndex regexp (FF)
    }
}
// masque le bouton de suppression durant le chargement des styles
document.write('<style type="text/css">.btn_ko{display:none;}<\/style>');
 
lancer(initchk); // lance initchk() une fois la page chargée

// script seek v1.0 issu de : http://www.webbricks.org/bricks/seek/
Array.prototype.each=function(b){for(var a=0,e=this.length;a<e;a++){b.apply(this,[this[a],a])}return this};Array.prototype.contains=function(a){var e=false;this.each(function(b){e=b==a||e});return e};function getAttr(b,a){if(a=='class'){return b.className}else if(a=='for'){return b.htmlFor}else{return b.getAttribute(a)}}function sel(a,e,k){var l,f,d=[],n=[],h,c,m,i=/^\/(.*)\/$/,g,j,o,q,p=document;e=e||p;a=a.replace(/\.([-\w]+)/g,"[class~=$1]");l=a.substr(0,1);if(l=='>'){g=sel(a.substring(1));g.each(function(b){if(b.parentNode==e){d.push(b)}})}else if(l=='#'){d=p.getElementById(a.substring(1));d=d?[d]:[]}else if(l!='['){d=e.getElementsByTagName(a)}else{m=a.match(/~?=/);a=a.substring(1,a.length-1).split(m);h=a[0];c=a[1];if(c&&(c.match(i))){c=new RegExp(c.replace(i,"$1"))}if(c&&typeof c=="string"){if(m=='~='){c=new RegExp("(^|\\s)"+c+"(\\s|$)")}else{c=new RegExp("^"+c+"$")}}k=k||"*";g=e.getElementsByTagName(k);f=g.length;while(f--){j=g[f];o=getAttr(j,h);if(o){if(c){if(c.test(o)){d.unshift(j)}}else{d.unshift(j)}}}}f=d.length;while(f--){n.unshift(d[f])}d=n;return d}function seek(f){f=f||"*";f=f.replace(/\s+/,' ').replace(/(^ )|( $)/,'').replace(/ ?> ?/,'>').replace(/^html ?/,'').replace(/\.([-\w]+)/g,"[class~=$1]").replace(/^(.+)#([-\w]+)/g,"$1[id=$2]");var d=f.split(' '),n,h,c,m,i,g,j=sel('html');if(f===''){return j}d.each(function(l){c=[];j.each(function(k){m=l.match(/>?((#?\w+)|(\[[^\/]*?\])|(\[.*?~?=\/.*?\/\]))/g)||[];m.each(function(a,e){if(e==0){h=sel(a,k)}else if(h.length){if(a.substr(0,1)=='>'){i=[];h.each(function(b){g=sel(a,b);if(g.length){i=i.concat(g)}});h=i}else{i=sel(a,k);g=[];h.each(function(b){if(i.contains(b)){g.push(b)}});h=g}}});if(h.length){h.each(function(b){if(!c.contains(b)){c.push(b)}})}});j=c});return j}
// permet de sélectionner en javascript des éléments html, sur le modèle de la syntaxe css 

// Affectation de la couleur sélectionnée - aperçu def dans l'admin
var curselectorinput;
function selectcolor(c) {
    document.getElementById(curselectorinput).value=c;
    if(document.all) {
    document.getElementById(curselectorinput+'btn').style.background=c;
        if(ap_c) {
                       if((ap_s=='background')&&(ap_c=='ap_titre')) document.getElementById(ap_c).firstChild.style.background=c;
                       if((ap_s=='background')&&(ap_c=='ap_def')) document.getElementById(ap_c).style.background=c;
                       if((ap_s=='color')&&(ap_c=='ap_titre')) document.getElementById(ap_c).firstChild.style.color=c;
                       if((ap_s=='color')&&(ap_c=='ap_def')) seek('div#ap_txtdef.def p').each( function(p) {p.style.color=c;});
                       if(ap_s=='border-left') {
                                         document.getElementById(ap_c).style.borderLeftColor=c;
                                         document.getElementById(ap_c).style.borderTopColor=c;
                                          }                       
                       if(ap_s=='border-right') {
                                         document.getElementById(ap_c).style.borderRightColor=c;
                                         document.getElementById(ap_c).style.borderBottomColor=c;
                                          }
                                          }                       
    } else {
      if(document.getElementById) {
        document.getElementById(curselectorinput+'btn').style.background=c;
        if(ap_c) {
                       if((ap_s=='background')&&(ap_c=='ap_titre')) document.getElementById(ap_c).firstChild.style.background=c;
                       if((ap_s=='background')&&(ap_c=='ap_titre')) document.getElementById(ap_c).firstChild.style.borderBottomColor=c;
                       if((ap_s=='background')&&(ap_c=='ap_def')) document.getElementById(ap_c).style.background=c;
                       if((ap_s=='color')&&(ap_c=='ap_titre')) document.getElementById(ap_c).firstChild.style.color=c;
                       if((ap_s=='color')&&(ap_c=='ap_def')) seek('div#ap_txtdef.def p').each( function(p) {p.style.color=c;});
                       if(ap_s=='border-left') {
                                         document.getElementById(ap_c).style.borderLeftColor=c;
                                         document.getElementById(ap_c).style.borderTopColor=c;
                                          }                       
                       if(ap_s=='border-right') {
                                         document.getElementById(ap_c).style.borderRightColor=c;
                                         document.getElementById(ap_c).style.borderBottomColor=c;
                                          }                       

                       }
      }
    }
   closecolorselector();
}
// Sélecteur de couleurs
function opencolorselector(o, e, ap_cible, ap_style) {
  ap_c=ap_cible;
  ap_s=ap_style;
        selecto = document.getElementById('colorselector').style;
        if(selecto.display == "block") {
            closecolorselector();
        } else {
            selecto.display = "block";
            if(document.all && typeof(window.opera) != 'object') {
                selecto.left = event.x + document.body.scrollLeft - 380;
                selecto.top = event.y + document.body.scrollTop - 220;
            } else {
                if(document.getElementById) {
                selecto.left = (e.clientX + window.pageXOffset - 400) + "px";
                selecto.top = (e.clientY + window.pageYOffset - 220) + "px";
                }
            }
            curselectorinput=o;
        }
}

function closecolorselector() {
    document.getElementById('colorselector').style.display="none";
}
function ap_font(source_name, ap_cible, ap_st) {
  if((ap_cible=='ap_titre')&&(ap_st=='family')) document.getElementById(ap_cible).firstChild.style.fontFamily=document.forms['adminconfig'].elements[source_name].value;
  if((ap_cible=='ap_txtdef')&&(ap_st=='family')) document.getElementById(ap_cible).style.fontFamily=document.forms['adminconfig'].elements[source_name].value;
  if((ap_cible=='ap_titre')&&(ap_st=='size')) document.getElementById(ap_cible).firstChild.style.fontSize=document.forms['adminconfig'].elements[source_name].value;
  if((ap_cible=='ap_txtdef')&&(ap_st=='size')) document.getElementById(ap_cible).style.fontSize=document.forms['adminconfig'].elements[source_name].value;
}

