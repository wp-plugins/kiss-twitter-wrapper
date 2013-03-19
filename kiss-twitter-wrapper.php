<?php
/*
Plugin Name: KISS Twitter Wrapper
Plugin URI: https://github.com/iainjames88/kiss-twitter-wrapper
Version: 1.0
Description: A simple (no, honestly, it's stupidly simple) WordPress wrapper plugin for the Twitter Widgets Configurator (https://twitter.com/settings/widgets/new/user/).
Author: Iain Maitland
Author URI: http://twitter.com/iainjames88
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

class KISS_Twitter_Wrapper extends WP_Widget
{
    /**
     * Constructor - sets up the class name and description
     */
    function KISS_Twitter_Wrapper()
    {
        $widget_ops = array(
            'classname' => 'KISS_Twitter_Wrapper',
            'description' => "Configure me to display your Twitter timeline."
            );

        $this->WP_Widget('KISS_Twitter_Wrapper', 'KISS Twitter Wrapper', $widget_ops);
    }

    /**
     * Configuration form for the widget
     */
    function form($instance)
    {
        $instance = wp_parse_args((array) $instance, array('code' => ''));
        $code = $instance['code'];

        echo "<p>It's easy! Create your widget <a href=\"https://twitter.com/settings/widgets/new/user\" target=\"new\">here</a> and paste the generated code below:</p>";
?>
        <p><label for="<?php echo $this->get_field_id('code'); ?>">Code: <input class="widefat" id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>" type="text" value="<?php echo attribute_escape($code); ?>" /></label></p>
<?php
    }

    /**
     * Update the widget contents
     */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['code'] = $new_instance['code'];
        return $instance;
    }

    /**
     * Display the widget
     */
    function widget($args, $instance)
    {
        echo $instance['code'];
        echo "<br /><br />";
    }
}

add_action( 'widgets_init', create_function('', 'return register_widget("KISS_Twitter_Wrapper");') );