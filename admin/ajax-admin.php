<?php
add_action( 'wp_ajax_add_set', 'u_ajax_add_set' );
add_action( 'wp_ajax_delete_set', 'u_ajax_delete_set' );
add_action( 'wp_ajax_update_set', 'u_ajax_update_set' );

function u_ajax_add_set() {
    $current_user = current_user_can('edit_others_pages');
    if ($current_user ) {
        $arr_html = array('script' => array(
            'async' => array(),
            'src' => array(),
            'data-script' => array(),
            'charset' => array()),
            'div' => array(
                'class' => array(),
                'data-pid' => array(),
                'data-type' => array(),
                'data-options' => array(),
                'data-social' => array()));
        $u_id = sanitize_key($_POST['id']);
        $u_id_usocial = sanitize_key($_POST['id_usocial']);
        $u_script_usocial = wp_kses($_POST['script_usocial'], $arr_html);
        $u_display_loc = sanitize_text_field($_POST['display_locations']);
        if (!preg_match("/^[0-9 ]+$/", $u_id_usocial)) {
            u_render_list_set("invalid_id");
        } else if (!preg_match("(^body$|^h1_title$|^product_page$)",$u_display_loc)) {
            u_render_list_set("invalid_loc");
        } else if ($u_script_usocial == ""){
            u_render_list_set("invalid_script");
        } else if ($u_id >= 100){
            u_render_list_set("max_scripts");
        } else {
            Usocial_Wpdb::u_add_usocial_set($u_id_usocial,$u_script_usocial,$u_display_loc);
            u_render_list_set();
        }
        wp_die();
    } else {
        wp_die ('','',403);
    }
}
function u_ajax_delete_set () {
    $current_user = current_user_can('edit_others_pages');
    if ($current_user) {
        $u_id_usocial = sanitize_key($_POST['id_usocial']);
        Usocial_Wpdb::u_delete_usocial_set($u_id_usocial);
        u_render_list_set();
        wp_die();
    } else {
        wp_die ('','',403);
    }
}
function u_ajax_update_set () {
    $current_user = current_user_can('edit_others_pages');
    if ($current_user) {
        $arr_html = array('script' => array(
            'async' => array(),
            'src' => array(),
            'data-script' => array(),
            'charset' => array()),
            'div' => array(
                'class' => array(),
                'data-pid' => array(),
                'data-type' => array(),
                'data-options' => array(),
                'data-social' => array()));
        $u_id = sanitize_key($_POST['id']);
        $u_id_usocial = sanitize_key($_POST['id_usocial']);
        $u_script_usocial = wp_kses($_POST['script_usocial'], $arr_html);
        $u_display_loc = sanitize_text_field($_POST['display_locations']);
        if (!preg_match("/^[0-9 ]+$/", $u_id_usocial)) {
            u_render_list_set("invalid_id");
        } else if (!preg_match("(^body$|^h1_title$|^product_page$)",$u_display_loc)) {
            u_render_list_set("invalid_loc");
        } else if ($u_script_usocial == ""){
            u_render_list_set("invalid_script");
        } else {
            Usocial_Wpdb::u_update_usocial_set($u_id,$u_id_usocial,$u_script_usocial,$u_display_loc);
            u_render_list_set();
        }
        wp_die();
    } else {
        wp_die ('','',403);
    }
}
function u_cyr_to_lat_display_loc ($u_display_loc) {
    switch ($u_display_loc) {
        case "body":
            echo esc_html_e('Body', 'usocial');
            break;
        case "product_page":
            echo esc_html_e('Карточка товара', 'usocial');
            break;
        case "h1_title":
            echo esc_html_e('Заголовок H1', 'usocial');
            break;
    }
}
function u_render_list_set ($error_message = null) {

    $u_sets_result = Usocial_Wpdb::u_get_usocial_set(null);
    ?>
    <div class="u-added-sets">
        <?if( $u_sets_result ) { ?>
            <table class="iksweb">
                <tbody>
                <tr class="tr_title">
                    <td>№</td>
                    <td><?php esc_html_e('ID набора в uSocial', 'usocial');?></td>
                    <td><?php esc_html_e('Дата создания', 'usocial');?></td>
                    <td><?php esc_html_e('Расположение', 'usocial');?></td>
                    <td><?php esc_html_e('Действия', 'usocial');?></td>
                </tr>
                <? foreach ($u_sets_result as $key => $u_set_result ) {?>
                    <tr class="tr_value">
                        <td id="u-number-<?echo esc_html(count($u_sets_result)) - $key;?>"><?echo esc_html(count($u_sets_result)) - $key;?></td>
                        <td id="u-id-usocial-<? echo esc_html($u_set_result->id);?>"><?echo esc_html($u_set_result->id_usocial);?></td>
                        <td id="u-date-create-<? echo esc_html($u_set_result->id);?>"><?echo esc_html($u_set_result->dates_create);?></td>
                        <td id="u-display-loc-<? echo esc_html($u_set_result->id);?>" value="<? echo esc_html($u_set_result->display_locations)?>"><?echo esc_html(u_cyr_to_lat_display_loc($u_set_result->display_locations));?></td>
                        <td>
                            <input type="hidden" id="u-script-usocial-<? echo esc_html($u_set_result->id);?>" value='<?echo esc_html(stripslashes($u_set_result->scripts_usocial), ENT_QUOTES);?>'>
                            <a class="stats-button" href="<?echo esc_html_e('https://usocial.pro/', 'usocial')."project/$u_set_result->id_usocial/stats";?>" target="_blank"><img width="20px" src="<?echo esc_html(plugins_url( 'img/svg/stats.svg' , __FILE__ ));?>" alt=""></a>
                            <img class="update-button" data-number="<? echo esc_html(count($u_sets_result)) - $key;?>" data-id="<? echo esc_html($u_set_result->id);?>" width="20px" src="<?echo esc_html(plugins_url( 'img/svg/edit.svg' , __FILE__ ));?>" alt="">
                            <img class="delete-button" data-number="<? echo esc_html(count($u_sets_result)) - $key;?>" data-id="<? echo esc_html($u_set_result->id);?>" width="20px" src="<?echo esc_html(plugins_url( 'img/svg/delete.svg' , __FILE__ ));?>" alt="">
                        </td>
                    </tr>
                <?}?>
                </tbody>
            </table>
        <?} else {?>
            <span class="u-null-sets"><?php esc_html_e('У вас пока нет созданных наборов', 'usocial');?></span>
        <?}?>
    </div>
    <?php
    //Errors valid
    if ($error_message == "invalid_id") {
        ?><div class="u-error-message"><?php esc_html_e('Укажите верный ID набора.', 'usocial');?></div><?
    } else if ($error_message == "invalid_loc") {
        ?><div class="u-error-message"><?php esc_html_e('Вы неверно указали место отображения кнопок.', 'usocial');?></div><?
    } else if ($error_message == "invalid_script") {
        ?><div class="u-error-message"><?php esc_html_e('Вы не ввели сгенерированный код.', 'usocial');?></div><?
    } else if ($error_message == "max_scripts") {
        ?><div class="u-error-message"><?php esc_html_e('Вы добавили максимальное количество наборов.', 'usocial');?></div><?
    }

}





























