<?php

$js_files = array(
    
    array(
        'handle' => 'swiper-js',
        'src' => DRILLLCORP_CORE_JS . '/swiper.min.js',
        'deps' => array('jquery'),
        'in_footer' => true
    ),

    array(
        'handle' => 'main',
        'src' => DRILLLCORP_CORE_JS . '/main.js',
        'deps' => array('jquery'),
        'in_footer' => true
    ),
);

if (!drilllcorp_core()->is_drilllcorp_active()) {
    $js_files[] = array(
        'handle' => 'bootstrap',
        'src' => DRILLLCORP_CORE_JS . '/bootstrap.min.js',
        'deps' => array('jquery'),
        'in_footer' => true
    );
}

return $js_files;
