<?php

/**
 * Theme Excerpt Class
 * @package drilllcorp
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access it directly
}

if (!class_exists('DrilllCorp_Core_excerpt')):
    class DrilllCorp_Core_excerpt
    {

        public static $length = 55;

        public static $types = array(
            'short' => 25,
            'regular' => 55,
            'long' => 100,
            'promo' => 15
        );

        public static $more = true;

        /**
         * Sets the length for the excerpt
         * @package drilllcorp
         */
        public static function length($new_length = 55, $more = true)
        {
            DrilllCorp_Core_excerpt::$length = $new_length;
            DrilllCorp_Core_excerpt::$more = $more;

            add_filter('excerpt_more', 'DrilllCorp_Core_excerpt::auto_excerpt_more');

            add_filter('excerpt_length', 'DrilllCorp_Core_excerpt::new_length');

            DrilllCorp_Core_excerpt::output();
        }

        public static function new_length()
        {
            if (isset(DrilllCorp_Core_excerpt::$types[DrilllCorp_Core_excerpt::$length]))
                return DrilllCorp_Core_excerpt::$types[DrilllCorp_Core_excerpt::$length];
            else
                return DrilllCorp_Core_excerpt::$length;
        }

        public static function output()
        {
            the_excerpt();
        }

        public static function continue_reading_link()
        {

            return '<span class="readmore"><a href="' . get_permalink() . '">' . esc_html__('Read More', 'drilllcorp-core') . '</a></span>';
        }

        public static function auto_excerpt_more()
        {
            if (DrilllCorp_Core_excerpt::$more) :
                return ' ';
            else :
                return ' ';
            endif;
        }
    } //end class
endif;

if (!function_exists('drilllcorp_core_excerpt')) {

    function DrilllCorp_Core_excerpt($length = 55, $more = true)
    {
        DrilllCorp_Core_excerpt::length($length, $more);
    }
}
