<?php

$css_files = array(
    
    array(
        'handle' => 'drillcorp-swiper-css',
        'src' => DRILLCORP_CORE_CSS . '/swiper.min.css',
        'deps' => array(),
    ),

    array(
        'handle' => 'drillcorp-core-main-style',
        'src' => DRILLCORP_CORE_CSS . '/main-style.css',
        'deps' => array(),
    ),

    array(
        'handle' => 'drillcorp-ele-widgets',
        'src' => DRILLCORP_CORE_CSS . '/ele-widgets.css',
        'deps' => array(),
    ),
    array(
        'handle' => 'drillcorp-toc-widget-css',
        'src' => DRILLCORP_CORE_CSS . '/toc-widget.css',
        'deps' => array(),
    ),
    array(
        'handle' => 'drillcorp-ele-responsive',
        'src' => DRILLCORP_CORE_CSS . '/responsive.css',
        'deps' => array(),
    ),


);

if (!drillcorp_core()->is_drillcorp_active()) {
    $css_files[] = array(
        'handle' => 'bootstrap',
        'src' => DRILLCORP_CORE_CSS . '/bootstrap.min.css',
        'deps' => array(),
    );

    $css_files[] = array(
        'handle' => 'main-style',
        'src' => DRILLCORP_CORE_CSS . '/main-style.css',
        'deps' => array(),
    );
    $css_files[] = array(
        'handle' => 'responsive',
        'src' => DRILLCORP_CORE_CSS . '/responsive.css',
        'deps' => array(),
    );
}

return $css_files;
