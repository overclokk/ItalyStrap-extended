<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit61d2c58b3f38e3101cd48c853b7a5c1d
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Leafo\\ScssPhp\\' => 14,
        ),
        'I' => 
        array (
            'ItalyStrap\\Widget\\' => 18,
            'ItalyStrap\\Shortcode\\' => 21,
            'ItalyStrap\\Core\\' => 16,
        ),
        'A' => 
        array (
            'Auryn\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Leafo\\ScssPhp\\' => 
        array (
            0 => __DIR__ . '/..' . '/leafo/scssphp/src',
        ),
        'ItalyStrap\\Widget\\' => 
        array (
            0 => __DIR__ . '/../..' . '/widget',
        ),
        'ItalyStrap\\Shortcode\\' => 
        array (
            0 => __DIR__ . '/../..' . '/shortcode',
        ),
        'ItalyStrap\\Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'Auryn\\' => 
        array (
            0 => __DIR__ . '/..' . '/rdlowrey/auryn/lib',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Parsedown' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown',
            ),
        ),
        'D' => 
        array (
            'Detection' => 
            array (
                0 => __DIR__ . '/..' . '/mobiledetect/mobiledetectlib/namespaced',
            ),
        ),
    );

    public static $classMap = array (
        'ItalyStrapAdminGallerySettings' => __DIR__ . '/../..' . '/admin/ItalyStrapAdminGallerySettings.php',
        'ItalyStrapAdminMediaSettings' => __DIR__ . '/../..' . '/admin/ItalyStrapAdminMediaSettings.php',
        'ItalyStrapBreadcrumbs' => __DIR__ . '/../..' . '/deprecated/ItalyStrapBreadcrumbs.php',
        'ItalyStrapLazyload' => __DIR__ . '/../..' . '/deprecated/ItalyStrapLazyload.php',
        'ItalyStrap\\Admin\\A_Admin' => __DIR__ . '/../..' . '/admin/class-abstract-admin.php',
        'ItalyStrap\\Admin\\A_Fields' => __DIR__ . '/../..' . '/admin/fields/class-abstract-fields.php',
        'ItalyStrap\\Admin\\Admin' => __DIR__ . '/../..' . '/admin/class-admin.php',
        'ItalyStrap\\Admin\\Admin_Uninstall' => __DIR__ . '/../..' . '/admin/class-admin-uninstall.php',
        'ItalyStrap\\Admin\\Customize_Select_Multiple_Control' => __DIR__ . '/../..' . '/admin/customizer/class-customize-select-multiple-control.php',
        'ItalyStrap\\Admin\\Customize_Select_Web_Fonts_Control' => __DIR__ . '/../..' . '/admin/customizer/class-customize-select-web-fonts-control.php',
        'ItalyStrap\\Admin\\Customizer_Manager' => __DIR__ . '/../..' . '/admin/customizer/class-customize-manager.php',
        'ItalyStrap\\Admin\\Fields' => __DIR__ . '/../..' . '/admin/fields/class-fields.php',
        'ItalyStrap\\Admin\\I_Admin' => __DIR__ . '/../..' . '/admin/i-admin.php',
        'ItalyStrap\\Admin\\I_Fields' => __DIR__ . '/../..' . '/admin/fields/i-fields.php',
        'ItalyStrap\\Admin\\Import_Export' => __DIR__ . '/../..' . '/admin/class-import-export.php',
        'ItalyStrap\\Admin\\Register_Metaboxes' => __DIR__ . '/../..' . '/admin/class-register-metabox.php',
        'ItalyStrap\\Admin\\Sanitization' => __DIR__ . '/../..' . '/admin/class-sanitization.php',
        'ItalyStrap\\Admin\\Security_Input' => __DIR__ . '/../..' . '/admin/class-security-input.php',
        'ItalyStrap\\Admin\\Validation' => __DIR__ . '/../..' . '/admin/class-validation.php',
        'ItalyStrap\\Core\\ItalyStrapCarousel' => __DIR__ . '/../..' . '/deprecated/ItalyStrapCarousel.php',
        'ItalyStrap\\Core\\ItalyStrapGlobals' => __DIR__ . '/../..' . '/deprecated/ItalyStrapGlobals.php',
        'ItalyStrap\\Core\\ItalyStrapGlobalsCss' => __DIR__ . '/../..' . '/deprecated/ItalyStrapGlobals.php',
        'ItalyStrap\\Core\\ItalyStrapHTMLSitemaps' => __DIR__ . '/../..' . '/deprecated/ItalyStrapHTMLSitemaps.php',
        'ItalyStrap\\Widget\\Vcard_Widget' => __DIR__ . '/../..' . '/deprecated/class-widget-vcard.php',
        'ItalyStrap\\Widget\\Widget_Posts2' => __DIR__ . '/../..' . '/deprecated/class-widget-posts2.php',
        'Mobile_Detect' => __DIR__ . '/..' . '/mobiledetect/mobiledetectlib/Mobile_Detect.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit61d2c58b3f38e3101cd48c853b7a5c1d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit61d2c58b3f38e3101cd48c853b7a5c1d::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit61d2c58b3f38e3101cd48c853b7a5c1d::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit61d2c58b3f38e3101cd48c853b7a5c1d::$classMap;

        }, null, ClassLoader::class);
    }
}
