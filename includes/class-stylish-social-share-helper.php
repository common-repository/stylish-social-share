<?php

/**
 *
 * @link       http://www.wpmaniax.com
 * @since      1.0.0
 *
 * @package    Foosocial
 * @subpackage Foosocial/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Foosocial
 * @subpackage Foosocial/includes
 * @author     WP Maniax <plugins@wpmaniax.com>
 */
class Stylish_Social_Share_Helper
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function get_share_links()
    {
        global $post;

        $share_links = array();
        $url = urlencode(get_permalink($post->ID));
        $title = urlencode(get_the_title($post->ID));

        $networks = array('facebook', 'twitter', 'google-plus', 'linkedin', 'reddit', 'tumblr', 'stumbleupon');
        $links = array('http://www.facebook.com/sharer.php?u=$url', 'https://twitter.com/share?url=$url', 'https://plus.google.com/share?url=$url', 'http://www.linkedin.com/shareArticle?url=$url', 'http://reddit.com/submit?url=$url&title=$title', 'http://www.tumblr.com/share/link?url=$url&name=$title', 'http://www.stumbleupon.com/submit?url=$url&title=$title');

        for ($i = 0; $i < count($networks); $i++) {
            $url_new = str_replace('$url', $url, $links[$i]);
            $url_new = str_replace('$title', $title, $url_new);
            $share_links[$networks[$i]] = $url_new;
        }

        return $share_links;
    }

}
