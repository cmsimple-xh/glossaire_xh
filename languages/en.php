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

$plugin_tx['glossaire']['menu_main']="Words and Definitions";
$plugin_tx['glossaire']['frontend_print_title'] = "Glossary";
$plugin_tx['glossaire']['frontend_msg_def_lost'] = "To the webmaster: Plugin Glossaire_XH, It lacks the definition file whose Id number is =";
$plugin_tx['glossaire']['admin_button_create_word'] = "Create a word";
$plugin_tx['glossaire']['admin_button_save'] = "Save";
$plugin_tx['glossaire']['admin_configuration_title'] = "Glossaire - Configuration";
$plugin_tx['glossaire']['admin_definition_aspect_title'] = "ASPECT of DEFINITIONS";
$plugin_tx['glossaire']['admin_definition_border_title'] = "BORDERS";
$plugin_tx['glossaire']['admin_definition_bottom_right_color'] = "Right and bottom borders";
$plugin_tx['glossaire']['admin_definition_text_title'] = "DEFINITIONS";
$plugin_tx['glossaire']['admin_definition_title_title'] = "TITLES DEFINITIONS";
$plugin_tx['glossaire']['admin_definition_top_left_color'] = "Left and top borders";
$plugin_tx['glossaire']['admin_definition_width'] = "Default width (add px or em)";
$plugin_tx['glossaire']['admin_definition_width_increased']="Increased width (option when editing the definition).";
$plugin_tx['glossaire']['admin_definition_width_title'] = "WIDTH of DEFINITIONS";
$plugin_tx['glossaire']['admin_edit_page_title'] = "WORD and DEFINITION";
$plugin_tx['glossaire']['admin_editor_title'] = "DEFINITION";
$plugin_tx['glossaire']['admin_filter_title'] = "FILTER";
$plugin_tx['glossaire']['admin_handle_the_words_title'] = "HANDLE the WORDS";
$plugin_tx['glossaire']['admin_intro'] = "Glossaire_XH can display a definition on mouse over of certain words in your articles (and newsboxes). This definition may be titled and illustrated.</p><p>Once configuration validate one first time for the template in used, simply go to the admin and record a first word and its definition.<br>When reading one of your articles, if the word is present in the text, it will display the definition on mouseover, as would a tooltip.</p><ul><li>This word appears highlighted with a dotted line (configurable)</li><li>Number of occurrences is configurable (allowing a definition of the first appearance of the word only, for example)</li><li>The aspect of the definition displayed is configurable.</li><li>Work on multilingual site.</li><li>Recognition of plural (for supported languages).<br><br>The intervention on the text takes place at the level of the content variable and just before the display of the article. Word lists (one per language) and the associated definitions are stored in text format in the data folder of the plugin.</li></ul>";
$plugin_tx['glossaire']['admin_list_title'] = "LIST";
$plugin_tx['glossaire']['admin_msg_dont_copy_past'] = "It features the characters & or # or; <br>or an html entity (or numeric), it has been truncated.<br>Do not copy and paste, write the words with the keyboard<br>(see instructions).";
$plugin_tx['glossaire']['admin_msg_special_char'] = "Write the word with your keyboard\\nand do not use special characters\\n (see instructions)";
$plugin_tx['glossaire']['admin_msg_warning_last_word'] = "ATTENTION concerning the last word created :";
$plugin_tx['glossaire']['admin_newsboxes_activation'] = "Activate the plugin in the NewsBoxes";
$plugin_tx['glossaire']['admin_newsboxes_activation_text'] = "The words of the glossary found in NewsBoxes will also be underlined.";
$plugin_tx['glossaire']['admin_newsboxes_activation_title'] = "Activation in NewsBoxes";
$plugin_tx['glossaire']['admin_occurrence_aspect_legendtitle'] = "ASPECT of the OCCURRENCE in ARTICLE";
$plugin_tx['glossaire']['admin_occurrence_aspect_title'] = "ASPECT of the OCCURRENCE";
$plugin_tx['glossaire']['admin_occurrence_number'] = "Occurrences number (-1 = All)";
$plugin_tx['glossaire']['admin_occurrence_select_dashed'] = "Dashed";
$plugin_tx['glossaire']['admin_occurrence_select_dotted'] = "Dotted";
$plugin_tx['glossaire']['admin_occurrence_select_solid'] = "Solid";
$plugin_tx['glossaire']['admin_occurrence_title'] = "OCCURRENCES";
$plugin_tx['glossaire']['admin_occurrence_underline_color'] = "Underline color";
$plugin_tx['glossaire']['admin_occurrence_underline_type'] = "Underline type";
$plugin_tx['glossaire']['admin_plugin_state_title'] = "Plugin state for this template";
$plugin_tx['glossaire']['admin_text_background'] = "Background";
$plugin_tx['glossaire']['admin_title']="Plugin Glossaire";
$plugin_tx['glossaire']['admin_txt_active'] = "ACTIVE<span style=\"float:right;margin-right:30px;\">Disable ->";
$plugin_tx['glossaire']['admin_txt_all'] = "ALL";
$plugin_tx['glossaire']['admin_txt_already_exist'] = "already exist. Delete the duplicate.";
$plugin_tx['glossaire']['admin_txt_apercu_title'] = "Definition title";
$plugin_tx['glossaire']['admin_txt_apercu_txt1'] = "Preview of the aspect of the definition.";
$plugin_tx['glossaire']['admin_txt_apercu_txt2'] = "Choose the aspect configuration and see the result directly here.";
$plugin_tx['glossaire']['admin_txt_color']	= "Color";
$plugin_tx['glossaire']['admin_txt_color_choice'] = "Choose the wanted color";
$plugin_tx['glossaire']['admin_txt_config_for_template'] = "Configuration for the template :";
$plugin_tx['glossaire']['admin_txt_delete'] = "Delete";
$plugin_tx['glossaire']['admin_txt_deletion'] = "Deletion";
$plugin_tx['glossaire']['admin_txt_disabled'] = "Disabled (validate the configuration to activate)";
$plugin_tx['glossaire']['admin_txt_edit'] = "Edit";
$plugin_tx['glossaire']['admin_txt_font'] = "Font";
$plugin_tx['glossaire']['admin_txt_freeze_def'] = "Allow to freeze this definition.";
$plugin_tx['glossaire']['admin_txt_freeze_def_text'] = "Usually, the definition is displayed only if the mouse remains above. With this option, it just fade away if the visitor activates the [close] button (upper right) or if the mouse is over another word.";
$plugin_tx['glossaire']['admin_txt_increased_width'] = "Increased width.";
$plugin_tx['glossaire']['admin_txt_increased_width_text'] = "Check this option if, for example, your definition is long. It will be displayed with a width greater. This choice can be made for each definition that requires it. You can adjust the value of this width on the page [configuration].";
$plugin_tx['glossaire']['admin_txt_occurrence_text'] = "As a word may appear several times in an article, you can configure the number of occurrences to be defined on mouseover. Enter a number (1 for example that only the first appearance of the word is defined, 2 for the first two ...). If you want <strong>all occurrences</strong> to be treated, enter <strong>-1</strong>";
$plugin_tx['glossaire']['admin_txt_only_one_template'] = "There is only one template installed.";
$plugin_tx['glossaire']['admin_txt_selection'] = "selection";
$plugin_tx['glossaire']['admin_txt_selections'] = "selections";
$plugin_tx['glossaire']['admin_txt_shades_of_gray']	= "Shades of gray";
$plugin_tx['glossaire']['admin_txt_size'] = "Size (add px)";
$plugin_tx['glossaire']['admin_txt_templ_choice_txt'] = "Here you choose the template for which the following configuration will apply once validated.<br><br>The activation of the plugin for a template occurs during the first validation of the configuration (<i>init_Glossaire()</i> is add in template.htm).<br> <br>in the list of templates, those for which the glossary has not been configured appear in red on a yellow background. When you choose a template, the page reloads with it.";
$plugin_tx['glossaire']['admin_txt_template_choice'] = "Choice of TEMPLATE";
$plugin_tx['glossaire']['admin_txt_the_word'] = "The word";
$plugin_tx['glossaire']['admin_txt_title'] = "<b>TITLE</b>";
$plugin_tx['glossaire']['admin_txt_word'] = "<b>WORD</b>";
$plugin_tx['glossaire']['admin_txt_words'] = "Words";
$plugin_tx['glossaire']['admin_word_and_def_title']="Glossaire - Words and Definitions";
