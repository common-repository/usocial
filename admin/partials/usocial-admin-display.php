<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://usocial.pro/
 * @since      1.0.0
 *
 * @package    Usocial
 * @subpackage Usocial/admin/partials
 */
?>
<div class="u-setting-page">
    <h1><?php esc_html_e('USOCIAL — Кнопки поделиться для социальных сетей', 'usocial');?></h1>

    <div class="u-right-button"><input id="u-add-trigger-set"  type="submit" class="u-button-admin-page" value="<?php esc_html_e('Создать набор', 'usocial');?>"></div>
    <span class="u-title-page-admin"><?php esc_html_e('Мои наборы', 'usocial');?></span>
    <div id="u-loader"><div class="cssload-loader"></div></div>

    <div class="u-added-sets-list">
        <? u_render_list_set();?>
    </div>
    <span class="u-text-page-admin"><?php esc_html_e('Используйте класс .uSocial-Share для стилизации кнопок поделиться.', 'usocial');?></span>
    <!--- Form add/edit set usocial--->

    <div id="u-div-form">
        <div class="u-title-page-admin"><span id="u-create-set-title"><?php esc_html_e('Создание набора ', 'usocial');?>№</span><span id="u-edit-set-title"><?php esc_html_e('Редактирование набора ', 'usocial');?>№</span><span id="u-title-number-set"></span></div>

        <form id="u-form" method="post" action="">
            <input type="hidden" id="u-hidden-id">
            <span class="u-subtitle-page-admin"><?php esc_html_e('ID набора в uSocial', 'usocial');?> <a target="_blank" href="<?php esc_html_e('https://help.usocial.pro/ru/knowledge-bases/2/articles/53-wordpress-plagin-dlya-ustanovki-knopok#usocial-id', 'usocial');?>"><img class="u-img-a-faq" width="16px" src="<?echo esc_html(plugins_url( 'img/svg/usocial_help.svg' , dirname(__FILE__)));?>" alt=""></a></span>
            <input type="number" min="1" name="u-id-usocial-field" id="u-id-usocial-field" placeholder="<?php esc_html_e('Запишите ID набора', 'usocial');?>">
            <span class="u-subtitle-page-admin"><?php esc_html_e('Код кнопок', 'usocial');?></span>
            <textarea cols="40" rows="10" name="u-script-usocial-field" id="u-script-usocial-field" class="u-usocial-field" placeholder="<?php esc_html_e('Вставьте сюда код набора «Поделиться» сгенерированный на странице uSocial', 'usocial');?>"></textarea>
            <span class="u-subtitle-page-admin"><?php esc_html_e('Где хотите отобразить кнопки на сайте?', 'usocial');?> <a target="_blank" href="<?php esc_html_e('https://help.usocial.pro/ru/knowledge-bases/2/articles/53-wordpress-plagin-dlya-ustanovki-knopok#button-display', 'usocial');?>"><img class="u-img-a-faq" width="16px" src="<?echo esc_html(plugins_url( 'img/svg/usocial_help.svg' , dirname(__FILE__)));?>" alt=""></a></span>

            <label><input type="radio" name="u-display-loc-radio" value="body" checked> <?php esc_html_e('Body', 'usocial');?></label><br>
            <label><input type="radio" name="u-display-loc-radio" value="h1_title"> <?php esc_html_e('Заголовок H1', 'usocial');?></label><br>
            <label><input type="radio" name="u-display-loc-radio" value="product_page"> <?php esc_html_e('Карточка товара', 'usocial');?></label><br>

            <button type="button" class="u-button-admin-page" id="u-add-set"><?php esc_html_e('Сохранить', 'usocial');?></button>
            <button type="button" class="u-button-admin-page" id="u-cancel-set"><?php _e('Отмена', 'usocial');?></button>
        </form>
    </div>
</div>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
