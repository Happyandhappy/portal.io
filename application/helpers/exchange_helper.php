<?php 
add_action('after_render_single_aside_menu','my_custom_menu_items');

function my_custom_menu_items($order){
    if($order == 1){
        echo '<li><a href="#"><i class="fa fa-area-chart menu-icon" aria-hidden="true"></i>Test</a></li>';
    }
}
