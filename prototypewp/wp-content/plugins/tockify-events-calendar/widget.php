<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

class Tockify_Mini_Calendar_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(

            'register_minical_widget',

            __('Tockify Mini Calendar', 'tockify' ),

            array (
                'description' => __(
                    'Tockify calendar for small spaces', 'tockify' )
            )

        );

    }

    function form( $instance ) {

        $title = false;
        if (isset( $instance[ 'title' ])) {
            $title = $instance['title'];
        }

        if ( trim($title) == false) {
            $title = '';
        }

        $calendar = false;
        if (isset( $instance[ 'calendar' ])) {
            $calendar = $instance['calendar'];
        }

        if ( trim($calendar) == false) {
            $calendar = 'spirited';
        }

        // markup for form ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'calendar' ); ?>">Your Calendar's Short Name</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'calendar' ); ?>"
                   name="<?php echo $this->get_field_name( 'calendar' ); ?>" value="<?php echo esc_attr( $calendar ); ?>">
        </p>


        <?php
    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance[ 'calendar' ] = strip_tags( $new_instance[ 'calendar' ] );
        $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
        return $instance;

    }

    function widget( $args, $instance ) {

        extract( $args );

        $title = false;
        if (isset( $instance[ 'title' ])) {
            $title = $instance['title'];
        }

        if ( trim($title) == false) {
            $title = '';
        }

        $calendar = false;
        if (isset( $instance[ 'calendar' ])) {
            $calendar = $instance['calendar'];
        }

        if ( trim($calendar) == false) {
            $calendar = 'spirited';
        }

        echo $before_widget;
        if ($title != false) {
            echo $before_title . $title . $after_title;
        }

        ?>
        <div data-tockify-component="upcoming"
        data-tockify-calendar="<?php echo $calendar ?>"></div>
        <script type="text/javascript">
           if (window._tkf && window._tkf.loadDeclaredCalendars) {
               window._tkf.loadDeclaredCalendars();
           }
        </script>
        <?php

        echo $after_widget;
    }

}
?>
<?php
/*******************************************************************************
function tockify_register_minical_widget() - registers the widget.
 *******************************************************************************/
?>
<?php
function tockify_register_minical_widget() {

    register_widget( 'Tockify_Mini_Calendar_Widget' );

}
add_action( 'widgets_init', 'tockify_register_minical_widget' );
?>