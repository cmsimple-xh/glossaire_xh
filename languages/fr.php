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

$plugin_tx['glossaire']['menu_main'] = "Mots et Définitions";
$plugin_tx['glossaire']['frontend_print_title'] = "Glossaire";
$plugin_tx['glossaire']['frontend_msg_def_lost'] = "A l'attention du webmestre : Plugin Glossaire_XH, Il manque le fichier de définition dont le numéro d'Id est =";
$plugin_tx['glossaire']['admin_button_create_word'] = "Créer un mot";
$plugin_tx['glossaire']['admin_button_save'] = "Enregistrer";
$plugin_tx['glossaire']['admin_configuration_title'] = "Glossaire - Configuration";
$plugin_tx['glossaire']['admin_definition_aspect_title'] = "ASPECT des DEFINITIONS";
$plugin_tx['glossaire']['admin_definition_border_title'] = "BORDS";
$plugin_tx['glossaire']['admin_definition_bottom_right_color'] = "Bords droit et inférieur";
$plugin_tx['glossaire']['admin_definition_text_title'] = "DEFINITIONS";
$plugin_tx['glossaire']['admin_definition_title_title'] = "TITRES des DEFINITIONS";
$plugin_tx['glossaire']['admin_definition_top_left_color'] = "Bords gauche et supérieur";
$plugin_tx['glossaire']['admin_definition_width'] = "Largeur par défaut (mettre px ou em)";
$plugin_tx['glossaire']['admin_definition_width_increased']="Largeur augmentée (option à l'édition de la définition).";
$plugin_tx['glossaire']['admin_definition_width_title'] = "LARGEUR des DEFINITIONS";
$plugin_tx['glossaire']['admin_edit_page_title'] = "MOT et DEFINITION";
$plugin_tx['glossaire']['admin_editor_title'] = "DEFINITION";
$plugin_tx['glossaire']['admin_filter_title'] = "FILTRE";
$plugin_tx['glossaire']['admin_handle_the_words_title'] = "GESTION des MOTS";
$plugin_tx['glossaire']['admin_intro'] = "Glossaire_XH permet d'afficher une définition au survol de certains mots dans vos articles (et newsbox). Cette définition peut être titrée et illustrée.</p><p>Une fois la configuration validée une première fois pour le template en cours, il suffit de créer un premier mot ainsi que sa définition.</p><p>Lors de la lecture d'un de vos articles, si ce mot est présent dans le texte, il permettra d'afficher la définition au survol du pointeur de la souris, comme le ferait une info-bulle.</p><ul><li>Ce mot apparaît souligné d'un pointillé (configurable)</li><li>Nombre d'occurrences configurable (seule la première apparition du mot, par exemple)</li><li>L'aspect de la définition affichée est configurable.</li><li>Site multilingue pris en charge.</li><li>Reconnaissance des pluriels intégrée (pour les langues supportées).</li></ul><br />L'intervention sur le texte n'a lieu qu'au niveau de la variable du contenu et juste avant l'affichage de l'article. Les listes de mots (une par langue) et les définitions associées sont enregistrées au format texte dans le dossier data du plugin.";
$plugin_tx['glossaire']['admin_list_title'] = "LISTE";
$plugin_tx['glossaire']['admin_msg_dont_copy_past'] = "Il comporte les caractères & ou # ou ; <br />ou une entité (html ou numérique), Il a donc été tronqué.<br />N'utilisez pas de copier/coller, écrivez les mots avec le clavier<br />(cf mode d'emploi).";
$plugin_tx['glossaire']['admin_msg_special_char'] = "Ecrivez le mot avec votre clavier\\net n'utilisez pas de caractères spéciaux\\n (cf mode d'emploi)";
$plugin_tx['glossaire']['admin_msg_warning_last_word'] = "ATTENTION concernant le dernier mot créé :";
$plugin_tx['glossaire']['admin_newsboxes_activation'] = "Activer le plugin dans les newsbox";
$plugin_tx['glossaire']['admin_newsboxes_activation_text'] = "Les mots du glossaire présents dans les newsbox seront également soulignés.";
$plugin_tx['glossaire']['admin_newsboxes_activation_title'] = "ACTIVATION dans les NEWSBOX";
$plugin_tx['glossaire']['admin_occurrence_aspect_legendtitle'] = "ASPECT de l'OCCURRENCE dans l'ARTICLE";
$plugin_tx['glossaire']['admin_occurrence_aspect_title'] = "ASPECT de l'OCCURRENCE";
$plugin_tx['glossaire']['admin_occurrence_number'] = "Nombre d'occurrences soulignées (-1 = Toutes)";
$plugin_tx['glossaire']['admin_occurrence_select_dashed'] = "Tirets";
$plugin_tx['glossaire']['admin_occurrence_select_dotted'] = "Pointillés";
$plugin_tx['glossaire']['admin_occurrence_select_solid'] = "Trait plein";
$plugin_tx['glossaire']['admin_occurrence_title'] = "OCCURRENCES";
$plugin_tx['glossaire']['admin_occurrence_underline_color'] = "Couleur de souligné";
$plugin_tx['glossaire']['admin_occurrence_underline_type'] = "Type de souligné";
$plugin_tx['glossaire']['admin_plugin_state_title'] = "Etat du plugin pour ce template";
$plugin_tx['glossaire']['admin_text_background'] = "Arrière-plan";
$plugin_tx['glossaire']['admin_title'] = "Plugin Glossaire";
$plugin_tx['glossaire']['admin_txt_active'] = "ACTIF<span style=\"float:right;margin-right:30px;\">Désactiver ->";
$plugin_tx['glossaire']['admin_txt_all'] = "Tous";
$plugin_tx['glossaire']['admin_txt_already_exist'] = "existe déjà. Supprimez le doublon.";
$plugin_tx['glossaire']['admin_txt_apercu_title'] = "Titre définition";
$plugin_tx['glossaire']['admin_txt_apercu_txt1'] = "Aperçu de l'aspect de la définition.";
$plugin_tx['glossaire']['admin_txt_apercu_txt2'] = "Choisissez une configuration d'aspect ci-contre et voyez le résultat directement ici.";
$plugin_tx['glossaire']['admin_txt_color']	= "Couleur";
$plugin_tx['glossaire']['admin_txt_color_choice'] = "Cliquez sur la couleur désirée";
$plugin_tx['glossaire']['admin_txt_config_for_template'] = "Configuration pour le template :";
$plugin_tx['glossaire']['admin_txt_delete'] = "Supprimer";
$plugin_tx['glossaire']['admin_txt_deletion'] = "Suppression";
$plugin_tx['glossaire']['admin_txt_disabled'] = "Désactivé (valider la configuration pour réactiver)";
$plugin_tx['glossaire']['admin_txt_edit'] = "Modifier";
$plugin_tx['glossaire']['admin_txt_font'] = "Fonte (police)";
$plugin_tx['glossaire']['admin_txt_freeze_def'] = "Permettre de figer cette définition.";
$plugin_tx['glossaire']['admin_txt_freeze_def_text'] = "Habituellement, la définition reste affichée seulement si le curseur de la souris reste au dessus. Avec cette option, elle s'effacera seulement si le visiteur actionne le bouton [fermer] ou si le curseur de la souris est sur un autre mot.";
$plugin_tx['glossaire']['admin_txt_increased_width'] = "Largeur augmentée.";
$plugin_tx['glossaire']['admin_txt_increased_width_text'] = "Cochez cette option si, par exemple, votre définition est longue. Elle sera affichée dans un cadre plus large. Ce choix peut être fait pour chaque définition qui le nécessite. Vous pouvez régler la valeur de cette largeur sur la page [configuration].";
$plugin_tx['glossaire']['admin_txt_occurrence_text'] = "Comme un mot peut apparaitre plusieurs fois dans un article, vous pouvez configurer ici le nombre d'occurences qui seront munies de la d&eacute;finition au survol. Entrez un chiffre (exemple 1 pour que seule la premi&egrave;re apparition du mot soit d&eacute;finie, 2 pour les deux premi&egrave;res etc...). Si vous d&eacute;sirez que <strong>toutes</strong> les occurrences soient trait&eacute;es, entrez<strong> -1</strong>)";
$plugin_tx['glossaire']['admin_txt_only_one_template'] = "Il n'y a qu'un seul template installé.";
$plugin_tx['glossaire']['admin_txt_selection'] = "sélection";
$plugin_tx['glossaire']['admin_txt_selections'] = "sélections";
$plugin_tx['glossaire']['admin_txt_shades_of_gray']	= "Dégradé de Gris";
$plugin_tx['glossaire']['admin_txt_size'] = "Taille (mettre px)";
$plugin_tx['glossaire']['admin_txt_templ_choice_txt'] = "Ici vous choisissez le template pour lequel la configuration ci-dessous s'appliquera une fois validée.<br /><br />L'activation du plugin pour un template a lieu lors de la première validation de la configuration (<i>init_Glossaire()</i> est ajouté dans template.htm).<br /><br />Dans la liste des templates, ceux pour lesquels le Glossaire n'a pas encore été configuré apparaissent en rouge sur fond jaune. Lorsque vous choisissez un template, la page se recharge en l'utilisant.";
$plugin_tx['glossaire']['admin_txt_template_choice'] = "Choix TEMPLATE";
$plugin_tx['glossaire']['admin_txt_the_word'] = "Le mot";
$plugin_tx['glossaire']['admin_txt_title'] = "<b>TITRE</b>";
$plugin_tx['glossaire']['admin_txt_word'] = "<b>MOT</b>";
$plugin_tx['glossaire']['admin_txt_words'] = "Mots";
$plugin_tx['glossaire']['admin_word_and_def_title']="Glossaire - Mots et Définitions";
