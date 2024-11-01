<?php
/**
 * WordPress Settings Framework
 *
 * @author Gilbert Pellegrom, James Kemp
 * @link https://github.com/gilbitron/WordPress-Settings-Framework
 * @license MIT
 */

/**
 * Define your settings
 *
 * The first parameter of this filter should be wpsf_register_settings_[options_group],
 * in this case "my_example_settings".
 *
 * Your "options_group" is the second param you use when running new WordPressSettingsFramework()
 * from your init function. It's importnant as it differentiates your options from others.
 *
 * To use the tabbed example, simply change the second param in the filter below to 'wpsf_tabbed_settings'
 * and check out the tabbed settings function on line 156.
 */

add_filter('wpsf_register_settings_stylish-social-share', 'sss_settings');

function sss_settings($wpsf_settings)
{

    $wpsf_settings['tabs'][] = array(
    		'id' => 'tab_1',
    		'title' => __('General'),
    	);

    	// Tab 2
    	$wpsf_settings['tabs'][] = array(
    		'id' => 'tab_2',
    		'title' => __('Theme'),
    	);

    // General Settings section
    $wpsf_settings['sections'][] = array(
        'tab_id' => 'tab_2',
        'section_id' => 'settings',
        'section_title' => 'Theme Settings',
        'section_description' => '',
        'section_order' => 5,
        'fields' => array(

            array(
                'id' => 'theme',
                'title' => 'Select Theme',
                'desc' => '',
                'type' => 'radio',
                'std' => 'model-2',
                'choices' => array(
                    'model-0' => file_get_contents(plugin_dir_path(__FILE__).'themes/theme0.php'),
                    'model-1' => file_get_contents(plugin_dir_path(__FILE__).'themes/theme1.php'),
                    'model-2' => file_get_contents(plugin_dir_path(__FILE__).'themes/theme2.php'),
                    'model-3' => file_get_contents(plugin_dir_path(__FILE__).'themes/theme3.php'),
                    'model-4' => file_get_contents(plugin_dir_path(__FILE__).'themes/theme4.php'),
                    'model-5' => file_get_contents(plugin_dir_path(__FILE__).'themes/theme5.php'),
                    'model-6' => file_get_contents(plugin_dir_path(__FILE__).'themes/theme6.php'),
                    'model-7' => file_get_contents(plugin_dir_path(__FILE__).'themes/theme7.php'),
                    'model-8' => file_get_contents(plugin_dir_path(__FILE__).'themes/theme8.php'),
                    'model-9' => file_get_contents(plugin_dir_path(__FILE__).'themes/theme9.php'),
                    'model-3d-0' => file_get_contents(plugin_dir_path(__FILE__).'themes/theme3d0.php'),
                    'model-3d-1' => file_get_contents(plugin_dir_path(__FILE__).'themes/theme3d1.php'),
                )
            )
        )
    );

    $wpsf_settings['sections'][] = array(
        'tab_id' => 'tab_1',
        'section_id' => 'settings',
        'section_title' => 'General Settings',
        'section_description' => '',
        'section_order' => 5,
        'fields' => array(
            array(
                'id' => 'networks',
                'title' => 'Select Networks',
                'desc' => 'Please select social networks.',
                'type' => 'checkboxes',
                'std' => array(
                    'facebook',
                    'twitter',
                    'google-plus',
                    'linkedin',
                    'reddit',
                    /*'tumblr'*/
                ),
                'choices' => array(
                    'facebook' => 'Facebook',
                    'twitter' => 'Twitter',
                    'google-plus' => 'GooglePlus',
                    'linkedin' => 'LinkedIn',
                    'reddit' => 'Reddit',
                    /*'tumblr' => 'Tumblr',
                    'stumbleupon' => 'StumbleUpon'*/
                )
            ),

            array(
                'id' => 'position',
                'title' => 'Select Position',
                'desc' => 'You can place shortcode <span style="color:red; font-weight: bold">[stylish-social-share]</span> wherever you want to display the share buttons',
                'type' => 'checkboxes',
                'std' => array(
                    'after'
                ),
                'choices' => array(
                    'before' => 'Before Content',
                    'after' => 'After Content',
                )
            ),

            /* array(
                 'id' => 'effects',
                 'title' => 'Effects',
                 'desc' => '',
                 'type' => 'checkboxes',
                 'std' => array(),
                 'choices' => array(
                     'slidein' => 'Use Slide-In',
                     //'after' => 'After Content',
                 )
             ),*/

            array(
                'id' => 'show_on',
                'title' => 'Show On',
                'desc' => 'Please chose where to show the share buttons',
                'type' => 'checkboxes',
                'std' => array(
                    'home',
                    'posts'
                ),
                'choices' => array(
                    'home' => 'Home Page',
                    'pages' => 'Pages',
                    'posts' => 'Posts',
                    'archives' => 'Archives',
                )
            )
        )
    );

    return $wpsf_settings;
}
