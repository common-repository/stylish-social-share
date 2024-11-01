<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.wpmaniax.com
 * @since      1.0.0
 *
 * @package    Stylish_Social_Share
 * @subpackage Stylish_Social_Share/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Stylish_Social_Share
 * @subpackage Stylish_Social_Share/public
 * @author     WP Maniax <plugins@wpmaniax.com>
 */
class Stylish_Social_Share_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    private $settings;
    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of the plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $default_settings = 'a:12:{s:26:"settings_networks_facebook";s:8:"facebook";s:25:"settings_networks_twitter";s:7:"twitter";s:29:"settings_networks_google-plus";s:11:"google-plus";s:26:"settings_networks_linkedin";s:8:"linkedin";s:24:"settings_networks_reddit";s:6:"reddit";s:24:"settings_position_before";s:1:"0";s:23:"settings_position_after";s:5:"after";s:21:"settings_show_on_home";s:4:"home";s:22:"settings_show_on_pages";s:1:"0";s:22:"settings_show_on_posts";s:5:"posts";s:25:"settings_show_on_archives";s:1:"0";s:14:"settings_theme";s:7:"model-2";}';
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->settings = wpsf_get_settings('stylish-social-share');
        if($this->settings == '') $this->settings = unserialize($default_settings);
        add_shortcode('stylish-social-share', array($this, 'stylish_social_share_shortcut'));

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Stylish_Social_Share_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Stylish_Social_Share_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/stylish-social-share-public.css', array(), $this->version, 'all');
        wp_enqueue_style('font-awesome', plugin_dir_url(__FILE__) . 'css/font-awesome.min.css');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Stylish_Social_Share_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Stylish_Social_Share_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/stylish-social-share-public.js', array('jquery'), $this->version, false);

    }

    public function render_tss_html($content)
    {
        //echo "<pre>"; print_r($this->settings); echo "</pre>";
        if ($this->settings['settings_theme'] == 'model-0') return $content;
        $markup = $this->render_tss_html_bar();

        if (is_home() && $this->settings['settings_show_on_home'] != 'home') $markup = '';
        if (is_page() && $this->settings['settings_show_on_pages'] != 'pages') $markup = '';
        if (is_single() && $this->settings['settings_show_on_posts'] != 'posts') $markup = '';
        if (is_archive() && $this->settings['settings_show_on_archives'] != 'archives') $markup = '';

        if ($this->settings['settings_position_before'] == 'before') {
            $content = $markup . $content;
        }
        if ($this->settings['settings_position_after'] == 'after') {
            $content .= $markup;
        }
        return $content;
    }

    public function render_tss_html_bar()
    {
        //echo "<pre>"; print_r($this->settings); echo "</pre>";
        $links = $this->helper->get_share_links();
        $networks = array('facebook', 'twitter', 'google-plus', 'linkedin', 'reddit');

        $bar = '<ul class="social-nav ' . $this->settings['settings_theme'] . '">';
        foreach ($networks as $network):
            if($this->settings['settings_networks_'.$network] != $network) continue;
            $bar .= '<li>';
            $bar .= '<a rel="nofollow" href="' . $links[$network] . '" target="_blank" class="' . $network . ' stylishss-button">';
            if (strpos($this->settings['settings_theme'], '3d') !== false) {
                $bar .= '<div class="front"><i class="fa fa-' . $network . '"></i></div>';
                $bar .= '<div class="back"><i class="fa fa-' . $network . '"></i></div>';
            } else $bar .= '<i class="fa fa-' . $network . '"></i>';
            $bar .= '</a>';
            $bar .= '</li>';
        endforeach;
        $bar .= '</ul>';
        return $bar;
    }

    public function stylish_social_share_shortcut()
    {
        if ($this->settings['settings_theme'] == 'model-0') return;
        return $this->render_tss_html_bar();
    }

    public function  stylish_social_share_footer()
    {
        if($this->settings['settings_theme'] != 'model-0') return;
        if (is_home() && $this->settings['settings_show_on_home'] != 'home') return;
        if (is_page() && $this->settings['settings_show_on_pages'] != 'pages') return;
        if (is_single() && $this->settings['settings_show_on_posts'] != 'posts') return;
        if (is_archive() && $this->settings['settings_show_on_archives'] != 'archives') return;
        echo $this->render_tss_html_bar();
    }

}
