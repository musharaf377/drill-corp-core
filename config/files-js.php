<?php

$js_files = array(
    
    array(
        'handle' => 'swiper-js',
        'src' => DRILLCORP_CORE_JS . '/swiper.min.js',
        'deps' => array('jquery'),
        'in_footer' => true
    ),

    array(
        'handle' => 'main',
        'src' => DRILLCORP_CORE_JS . '/main.js',
        'deps' => array('jquery'),
        'in_footer' => true
    ),
);

if (!drillcorp_core()->is_drillcorp_active()) {
    $js_files[] = array(
        'handle' => 'bootstrap',
        'src' => DRILLCORP_CORE_JS . '/bootstrap.min.js',
        'deps' => array('jquery'),
        'in_footer' => true
    );
}

return $js_files;
