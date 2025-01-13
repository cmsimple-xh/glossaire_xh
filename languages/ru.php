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

$plugin_tx['glossaire']['menu_main']="Слова и определения";
$plugin_tx['glossaire']['frontend_print_title'] = "глоссарий";
$plugin_tx['glossaire']['frontend_msg_def_lost'] = "К веб-мастеру : плагин Glossaire_XH, В нем отсутствует файл определения, идентификатор которого равен =";
$plugin_tx['glossaire']['admin_button_create_word'] = "Создать слово";
$plugin_tx['glossaire']['admin_button_save'] = "сохранить";
$plugin_tx['glossaire']['admin_configuration_title'] = "Glossaire - Конфигурация";
$plugin_tx['glossaire']['admin_definition_aspect_title'] = "АСПЕКТ ОПРЕДЕЛЕНИЯ";
$plugin_tx['glossaire']['admin_definition_border_title'] = "ГРАНИЦЫ";
$plugin_tx['glossaire']['admin_definition_bottom_right_color'] = "Правая и нижняя границы";
$plugin_tx['glossaire']['admin_definition_text_title'] = "ОПРЕДЕЛЕНИЯ";
$plugin_tx['glossaire']['admin_definition_title_title'] = "ОПРЕДЕЛЕНИЯ ТИТОВ";
$plugin_tx['glossaire']['admin_definition_top_left_color'] = "Левая и верхняя границы";
$plugin_tx['glossaire']['admin_definition_width'] = "Ширина по умолчанию (добавление px или em)";
$plugin_tx['glossaire']['admin_definition_width_increased']="Увеличенная ширина (опция при редактировании определения).";
$plugin_tx['glossaire']['admin_definition_width_title'] = "ШИРИНА ОПРЕДЕЛЕНИЙ";
$plugin_tx['glossaire']['admin_edit_page_title'] = "СЛОВА И ОПРЕДЕЛЕНИЕ";
$plugin_tx['glossaire']['admin_editor_title'] = "ОПРЕДЕЛЕНИЕ";
$plugin_tx['glossaire']['admin_filter_title'] = "ФИЛЬТР";
$plugin_tx['glossaire']['admin_handle_the_words_title'] = "ОБРАЩАТЬ СЛОВА";
$plugin_tx['glossaire']['admin_intro'] = "Glossaire_XH может отображать определение над мышью над определенными словами в ваших статьях (и в новостных блоках). Это определение может быть озаглавлено и проиллюстрировано. </p><p> После того, как конфигурация будет проверена в первый раз для используемого шаблона, просто перейдите к администратору и запишите первое слово и его определение.<br />При чтении одного из ваших статьи, если слово присутствует в тексте, оно отображает определение при наведении курсора мыши, а также подсказку.</p><ul><li>Это слово выделяется пунктирной линией (настраивается) </li><li>Количество входов настраивается (что позволяет, например, определять первое появление только слова)</li><li>Аспект отображаемого определения настраивается.</li><li>Работа на многоязычном сайте.</li><li>Признание множественного числа (для поддерживаемых языков).<br /><br />Вмешательство в текст происходит на уровне переменной содержимого и непосредственно перед отображением статьи. Списки слов (по одному на язык) и связанные определения хранятся в текстовом формате в папке с данными плагина.</li></ul>";
$plugin_tx['glossaire']['admin_list_title'] = "СПИСОК";
$plugin_tx['glossaire']['admin_msg_dont_copy_past'] = "Он содержит символы & или # или;<br />или html-объект (или числовой), он был усечен.<br />Не копируйте и вставляйте, не пишите слова с помощью клавиатуры<br />(см. инструкции).";
$plugin_tx['glossaire']['admin_msg_special_char'] = "Запишите слово с помощью клавиатуры\\n и не используйте специальные символы\\n (см. Инструкции)";
$plugin_tx['glossaire']['admin_msg_warning_last_word'] = "ВНИМАНИЕ относительно создания последнего слова :";
$plugin_tx['glossaire']['admin_newsboxes_activation'] = "Активировать плагин в NewsBoxes";
$plugin_tx['glossaire']['admin_newsboxes_activation_text'] = "Слова глоссария, найденные в NewsBoxes также будут подчеркнуты.";
$plugin_tx['glossaire']['admin_newsboxes_activation_title'] = "Активация в NewsBoxes";
$plugin_tx['glossaire']['admin_occurrence_aspect_legendtitle'] = "аспект возникновения в статье";
$plugin_tx['glossaire']['admin_occurrence_aspect_title'] = "аспект возникновения";
$plugin_tx['glossaire']['admin_occurrence_number'] = "Количество вхождений (-1 = All)";
$plugin_tx['glossaire']['admin_occurrence_select_dashed'] = "Пунктир";
$plugin_tx['glossaire']['admin_occurrence_select_dotted'] = "Пунктирная";
$plugin_tx['glossaire']['admin_occurrence_select_solid'] = "Сплошная";
$plugin_tx['glossaire']['admin_occurrence_title'] = "вхождений";
$plugin_tx['glossaire']['admin_occurrence_underline_color'] = "Подчеркнутый цвет";
$plugin_tx['glossaire']['admin_occurrence_underline_type'] = "Подчеркнутый тип";
$plugin_tx['glossaire']['admin_plugin_state_title'] = "Состояние плагина для этого шаблона";
$plugin_tx['glossaire']['admin_text_background'] = "Задний план";
$plugin_tx['glossaire']['admin_title']="Plugin Glossaire";
$plugin_tx['glossaire']['admin_txt_active'] = "действующий<span style=\"float:right;margin-right:30px;\">запрещать ->";
$plugin_tx['glossaire']['admin_txt_all'] = "ВСЕ";
$plugin_tx['glossaire']['admin_txt_already_exist'] = "уже существует. Удалить дубликат.";
$plugin_tx['glossaire']['admin_txt_apercu_title'] = "Название определения";
$plugin_tx['glossaire']['admin_txt_apercu_txt1'] = "Предварительный просмотр аспекта определения.";
$plugin_tx['glossaire']['admin_txt_apercu_txt2'] = "Выберите конфигурацию аспекта и посмотрите результат прямо здесь.";
$plugin_tx['glossaire']['admin_txt_color']	= "цвет";
$plugin_tx['glossaire']['admin_txt_color_choice'] = "Выберите желаемый цвет";
$plugin_tx['glossaire']['admin_txt_config_for_template'] = "Конфигурация для шаблона :";
$plugin_tx['glossaire']['admin_txt_delete'] = "Удалить";
$plugin_tx['glossaire']['admin_txt_deletion'] = "делеция";
$plugin_tx['glossaire']['admin_txt_disabled'] = "Отключено (проверьте активируемую конфигурацию)";
$plugin_tx['glossaire']['admin_txt_edit'] = "редактировать";
$plugin_tx['glossaire']['admin_txt_font'] = "Шрифт";
$plugin_tx['glossaire']['admin_txt_freeze_def'] = "Позволить заморозить это определение.";
$plugin_tx['glossaire']['admin_txt_freeze_def_text'] = "Обычно определение отображается только в том случае, если мышь остается выше. С этой опцией он просто исчезает, если посетитель активирует кнопку [закрыть] (верхний правый) или если мышь находится над другим словом.";
$plugin_tx['glossaire']['admin_txt_increased_width'] = "Увеличенная ширина.";
$plugin_tx['glossaire']['admin_txt_increased_width_text'] = "Проверьте этот параметр, если, например, ваше определение длинное. Он будет отображаться с большей шириной. Этот выбор может быть сделан для каждого определения, которое его требует. Вы можете отрегулировать значение этой ширины на странице [конфигурация].";
$plugin_tx['glossaire']['admin_txt_occurrence_text'] = "Поскольку слово может появляться несколько раз в статье, вы можете настроить количество вхождений, которые будут определены при наведении мыши. Введите число (например, 1, что определено только первое появление слова, 2 для первых двух ...). Если вы хотите, чтобы <strong>все вхождения </strong> обрабатывались, введите <strong>-1</strong>";
$plugin_tx['glossaire']['admin_txt_only_one_template'] = "Установлен только один шаблон.";
$plugin_tx['glossaire']['admin_txt_selection'] = "выбор";
$plugin_tx['glossaire']['admin_txt_selections'] = "выборы";
$plugin_tx['glossaire']['admin_txt_shades_of_gray']	= "Оттенки серого";
$plugin_tx['glossaire']['admin_txt_size'] = "Размер (добавить px)";
$plugin_tx['glossaire']['admin_txt_templ_choice_txt'] = "Здесь вы выбираете шаблон, для которого после проверки будет применена следующая конфигурация.<br /><br />Активация плагина для шаблона происходит во время первой проверки конфигурации (<i>init_Glossaire()</i> добавляется в template.htm).<br /><br />в списке шаблонов, те, для которых глоссарий не был настроен, отображаются красным цветом на желтом фоне. Когда вы выбираете шаблон, страница перезагружается вместе с ним.";
$plugin_tx['glossaire']['admin_txt_template_choice'] = "Выбор ШАБЛОНА";
$plugin_tx['glossaire']['admin_txt_the_word'] = "Слово";
$plugin_tx['glossaire']['admin_txt_title'] = "<b>НАЗВАНИЕ</b>";
$plugin_tx['glossaire']['admin_txt_word'] = "<b>СЛОВО</b>";
$plugin_tx['glossaire']['admin_txt_words'] = "слова";
$plugin_tx['glossaire']['admin_word_and_def_title']="Glossaire - Слова и определения";
