<?php

$css_files = array(
    
    array(
        'handle' => 'drilllcorp-swiper-css',
        'src' => DRILLLCORP_CORE_CSS . '/swiper.min.css',
        'deps' => array(),
    ),

    array(
        'handle' => 'drilllcorp-core-main-style',
        'src' => DRILLLCORP_CORE_CSS . '/main-style.css',
        'deps' => array(),
    ),

    array(
        'handle' => 'drilllcorp-ele-widgets',
        'src' => DRILLLCORP_CORE_CSS . '/ele-widgets.css',
        'deps' => array(),
    ),
    array(
        'handle' => 'drilllcorp-ele-responsive',
        'src' => DRILLLCORP_CORE_CSS . '/responsive.css',
        'deps' => array(),
    ),


);

if (!drilllcorp_core()->is_drilllcorp_active()) {
    $css_files[] = array(
        'handle' => 'bootstrap',
        'src' => DRILLLCORP_CORE_CSS . '/bootstrap.min.css',
        'deps' => array(),
    );

    $css_files[] = array(
        'handle' => 'main-style',
        'src' => DRILLLCORP_CORE_CSS . '/main-style.css',
        'deps' => array(),
    );
    $css_files[] = array(
        'handle' => 'responsive',
        'src' => DRILLLCORP_CORE_CSS . '/responsive.css',
        'deps' => array(),
    );
}

return $css_files;
