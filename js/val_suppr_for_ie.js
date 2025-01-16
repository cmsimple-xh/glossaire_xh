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

/*Pour IE <=11 pour validation de la suppression de mots, admin Glossaire, liste mots.
IE ne gérant pas l'attribut "form=id_du_form" (html5)
Les éléments extérieurs au formulaire y sont temporairement inclus puis la validation effectuée.
*/
function validForIE() {
   var objForm = document.getElementById("supprmot"); // Le formulaire

   // Test IE jusqu'à v11
   if (/*@cc_on!@*/false) var bIsIE = 1; // IE toutes versions sauf IE11
   var ua = window.navigator.userAgent;
   var msie = ua.indexOf('MSIE ');  // IE <=10
   var trident = ua.indexOf('Trident/'); // IE11

   if ((typeof (bIsIE) != 'undefined') || (msie > 0) || (trident > 0)) {
       var nbrInput = document.getElementsByTagName('input').length;

    // on déplace les input checkbox id=cochx dans le formulaire
        for (var i=0; i<=nbrInput; i++) {
            if (document.getElementById('coch'+i)) {
               var inputCoch = document.getElementById('coch'+i);
               objForm.insertBefore(inputCoch, objForm.firstChild);
               inputCoch.style.display = 'none';
            } 
        }
    }
objForm.submit();
}
