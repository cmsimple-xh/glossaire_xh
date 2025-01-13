/*
 * ==================================================================
 * Plugin GLOSSAIRE_XH for CMSimple_XH (1.7.x)
 * ==================================================================
 * Version:    2.0.1 - sept 2020
 * Copyright:  Ludovic AMATHIEU
 * Website:    https://www.f5swn.fr/en/ (and contact)
 * License:    GNU GPLv3 - http://www.gnu.org/licenses/gpl-3.0.en.html
 * ==================================================================
  
     Une partie de ce script javascript provient du site : http://css.alsacreations.com/
     Il est sous licence Creative Commons : http://creativecommons.org/licenses/by/2.0/fr/
     La partie "comportement survol def" est inspirée de ce lien:
     http://www.developpez.net/forums/d645689/webmasters-developpement-web/javascript/onmouseout-div-boutons/

*/
//Détection IE8 - on repère la sous-chaine "Trident/4.0"
function IsIE8Browser() {    
  var rv = -1;    
  var ua = navigator.userAgent;    
  var re = new RegExp("Trident\/([0-9]{1,}[\.0-9]{0,})");    
  if (re.exec(ua) != null) {        
    rv = parseFloat(RegExp.$1);    
    }    
    return (rv >= 4);
    }

gk=window.Event?1:0; // navigateurs Gecko ou IE
if (IsIE8Browser()) gk=0; // navigateur IE8
D=document;bulle=poppup=popn=encours=wpop=hpop=x=0

var colleDef = null;

function ferm()
{
encours.left=-999+'px'; 
encours=0; 
delai=null;
if(window.stopLect){stopLect('vid'+poppup.id);} // fonction stopLect(id) à créer par l'utilisateur (voir lisez-moi)
}

var chrono = null;
function initEvent(idConteneur)
{
  var elements = document.getElementById(idConteneur).getElementsByTagName("*");
  var i;
  var n = elements.length;
  for (i=0; i<n; i++)
  {
    elements[i].onmouseover = function(){stopTempo()}
  }
}

function stopTempo()
{
  if (chrono!=null)
    clearTimeout(chrono);
  chrono = null;
}

function demarreTempo()
{
  if (chrono==null)
    chrono = setTimeout("mouseOut()","20");
}

function mouseOut()
{
  if(colleDef == null) {
  ferm();
  chrono = null;
  }
}

var delai = null;
function stopDelai()
{
  if (delai!=null)
    {clearTimeout(delai);
    delai = null;}
}

function demarreDelai()
{
  if (delai==null)
  {delai = setTimeout("ferm();","900");}
}

function ctrl(e)
{
if(!x){de=!D.documentElement.clientWidth?D.body:D.documentElement;x=1} // IE6
el=gk?e.target:event.srcElement; //objet sous la souris
if(!el.tagName)el=el.parentNode; // noeud #text

if(el.className == 'gpop' && el.href)
  {
  poppup = D.getElementById(el.href.substring(el.href.lastIndexOf('#') + 1));
  with(poppup){wpop=offsetWidth;hpop=offsetHeight;bulle=style}

  if(bulle!=encours) // seulement si changement de bulle
    {
    colleDef=null;
    encours.left=-999+'px';
    encours=bulle;
    fx=gk?innerWidth-15:de.clientWidth   //l fenêtre
    fy=gk?innerHeight-15:de.clientHeight //h fenêtre
    sx=gk?pageXOffset:de.scrollLeft      //scroll h
    sy=gk?pageYOffset:de.scrollTop       //scroll v
    x=gk?e.pageX:event.clientX+sx;       //curseur x
    y=gk?e.pageY:event.clientY+sy;       //curseur y
    posx=x>=fx+sx-wpop-10?x-sx-wpop-15:x-sx+15   //positionnement x

    if(hpop>=0.8*fy){hpop=Math.round(0.8*fy); he=hpop+"px";} else{ he="";}    // limit. hauteur def par rapport hauteur fenêtre
    posy=y>=fy+sy-hpop-20?y-sy-hpop-15:y-sy+15   //positionnement y
    if(posy<=10) posy=20;
    with(bulle){left=posx+'px';top=posy+'px'; height=he; overflow=he==""?'hidden':'auto';}
    
    el.onclick=function(){return false}//désactive le lien
    if(window.demLect){demLect('vid'+poppup.id);} // fonction demLect(id) à créer par l'utilisateur (voir lisez-moi)

    }  // Tempo d'affichage
    el.onmouseout=function(){demarreDelai();}
    el.onmouseover=function(){stopDelai();}
  }
  
  else {  // Comportement survol def
    if((el.className == 'pp larg1')||(el.className == 'pp larg2')){
    stopDelai();
    initEvent(el.id);
    if(colleDef == null){  
    if(el.firstChild.className == 'figer'){colleDef = 1;} else{colleDef = null;}
    }
    el.onmouseout=function(){demarreTempo();}
    el.onmouseover=function(){stopTempo();}
    }
  }
}

if(colleDef == null) {
  D.onmousemove=ctrl;
 }

