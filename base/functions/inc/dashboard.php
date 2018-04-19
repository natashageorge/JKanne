<?php
/*
 *
 * Dashbord Widget Functions
 *
 */

// Remove Dashboard Widget
function remove_dashboard_widgets () {

    //Completely remove various dashboard widgets (remember they can also be HIDDEN from admin)
    remove_meta_box( 'dashboard_quick_press',   'dashboard', 'side' );      //Quick Press widget
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );      //Recent Drafts
    remove_meta_box( 'dashboard_primary',       'dashboard', 'side' );      //WordPress.com Blog
    remove_meta_box( 'dashboard_secondary',     'dashboard', 'side' );      //Other WordPress News
    remove_meta_box( 'dashboard_incoming_links','dashboard', 'normal' );    //Incoming Links
    remove_meta_box( 'dashboard_plugins',       'dashboard', 'normal' );    //Plugins
    //remove_meta_box( 'dashboard_right_now',     'dashboard', 'normal');     // At a Glance
    remove_meta_box( 'dashboard_recent_comments',     'dashboard', 'normal'); //Comments

}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');


// RSS update time on RSS widget
add_filter( 'wp_feed_cache_transient_lifetime', create_function('$a', 'return 600;') );

// Add jkanne news on dashbord widget
$rss_jkanne_blogg_source = get_option('jkanne_rss');
$rss_jkanne_blogg = fetch_feed( $rss_jkanne_blogg_source );

function dashboard_widget_function() {

    global $rss_jkanne_blogg;

    if ( !$rss_jkanne_blogg->get_item_quantity() ) {
        echo '<p>' . __('Apparently, there are no updates to show!', 'jkanne-flexible') . '</p>';
        $rss_jkanne_blogg->__destruct();
        unset($rss_jkanne_blogg);
        return;
    }

    echo "<ul>\n";

    if ( !isset($items) )
        $items = 5;

    foreach ( $rss_jkanne_blogg->get_items( 0, $items ) as $item ) {
        $link = esc_url( strip_tags( $item->get_link() ) );
        $title = esc_html( $item->get_title() );
        $content = $item->get_content();
        $content = wp_html_excerpt( $content, 250 ) . ' ...';

        echo "<li><a class='rsswidget' target='_blank' href='$link'>$title</a>\n<div class='rssSummary'>$content</div>\n";
    }

    echo "</ul>\n";
    $rss_jkanne_blogg->__destruct();
    unset($rss_jkanne_blogg);
}

function add_dashboard_widget() {
    wp_add_dashboard_widget( 'jkanne_dashboard_widget', __('Recent Posts from jkanne.se','jkanne-flexible'), 'dashboard_widget_function' );
}

add_action( 'wp_dashboard_setup', 'add_dashboard_widget' );

if ( is_wp_error($rss_jkanne_blogg) ) {
    function remove_jkanne_dashboard_widget(){
        remove_action( 'wp_dashboard_setup', 'add_dashboard_widget' );
    }jkanne
    add_action('init' , 'remove_jkanne_dashboard_widget');
}


// jkanne redmine dashbord widget
$rss_jkanne_redmine_source = 'http://kund.jkanne.com/IT-tj&nster/' . get_option('jkanne_redmine_folder') . '/issues.atom?key=' . get_option('jkanne_redmine_kay');
$rss_jkanne_redmine = fetch_feed( $rss_jkanne_redmine_source );

function dashboard_redmine_function($rss) {
    include_once(ABSPATH.WPINC.'/feed.php');

    global $rss_jkanne_redmine;

    if ( !$rss_jkanne_redmine->get_item_quantity() ) {
        echo '<p>' . __('Apparently, there are no updates to show!', 'jkanne-flexible') . '</p>';
        $rss_jkanne_redmine->__destruct();
        unset($rss_jkanne_redmine);
        return;
    }

    echo "<ul>\n";

    if ( !isset($items) )
        $items = 5;

    foreach ( $rss_jkanne_redmine->get_items( 0, $items ) as $item ) {
        $publisher = '';
        $site_link = '';
        $d = strtotime($item->get_date());
        $date = date("Y-m-d H:i", $d);
        $a = $item->get_author();
        $author = $a->get_name();
        $link = esc_url( strip_tags( $item->get_link() ) );
        $title = esc_html( $item->get_title() );
        $content = $item->get_content();
        $content = wp_html_excerpt( $content, 250 ) . ' ...';

        echo "<li>
        <h3><a class='rsswidget' target='_blank' href='$link'>$title</a></h3>
        <h4>$date, $author</h4>
        <div class='rssSummary'>$content</div>\n";
    }

    echo "</ul>\n";
    echo '<p><a href="http://jkanne.com/IT-tj&nster/'. get_option('jkanne_redmine_folder') .'/issues" target="_blank">' . __('Read all issues','jkanne-flexible') .'</a></p>';
    $rss_jkanne_redmine->__destruct();
    unset($rss_jkanne_redmine);
}

function redmine_dashboard_widget() {
    wp_add_dashboard_widget( 'jkanne_redmine_dashboard_widget', __('Issues','jkanne-flexible'). ' - ' . get_bloginfo( 'name' ), 'dashboard_redmine_function' );
}

add_action( 'wp_dashboard_setup', 'redmine_dashboard_widget' );

if ( is_wp_error($rss_jkanne_redmine) ) {
    function remove_redmine_widget(){
        remove_action( 'wp_dashboard_setup', 'redmine_dashboard_widget' );
    }
    add_action('init' , 'remove_redmine_widget');
}

// Custom Dashboard Welcome Message
function jkanne_welcome_panel() { ?>

    <script type="text/javascript">
        // Hide default welcome message
        jQuery(document).ready( function($) {
            $('div.welcome-panel-content').hide();
            $('a.welcome-panel-close').text('');
        });
    </script>

    <div class="custom-welcome-panel-content">
        <a href="https://jkanne.com" class="dashboard-logo" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/base/img/jkanne-logo.png"></a>
        <div style="float:right"><img src="<?php echo get_template_directory_uri() ?>/base/img/jkanne.png" width="165"></div>
        <h1><?php _e( 'Welcome to your site!', 'jkanne-flexible'); ?></h1>
        <p class="about-description"><?php _e( 'This is a site created by jkanne. Down below you can see information on how to get started. Place your text, contact information or other stuff on your site. If you have any question you could always contact us or send us an email by visiting <a href="http://www.jkanne.com" target="_blank">our website</a>. We also have a support system where you can put all your questions or issues that you want fixed. You can go there by clicking <a href="http://jkanne.com" target="_blank">here</a>.', 'jkanne-flexible'); ?></p>
        <div class="welcome-panel-column-container">
            <div class="welcome-panel-column">
                <h4><?php _e( "Let's Get Started",'jkanne-flexible' ); ?></h4>
                <?php printf( '<a href="%swp-admin/customize.php" class="button button-primary button-hero load-customize hide-if-no-customize">' . __( 'Customize Your Site', 'jkanne-flexible' ) . '</a>', home_url( '/' ) ); ?>
                <p class="hide-if-no-customize"><?php printf( __( 'or, <a href="%s">edit your site settings</a>', 'jkanne-flexible' ), admin_url( 'options-general.php' ) ); ?></p>
            </div><!-- .welcome-panel-column -->
            <div class="welcome-panel-column">
                <h4><?php _e( 'Next Steps', 'jkanne-flexible' ); ?></h4>
                <ul>
                    <?php if ( 'page' == get_option( 'show_on_front' ) && ! get_option( 'page_for_posts' ) ) : ?>
                    <li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page', 'jkanne-flexible' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
                    <li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages', 'jkanne-flexible' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
                    <?php elseif ( 'page' == get_option( 'show_on_front' ) ) : ?>
                    <li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page', 'jkanne-flexible' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
                    <li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages', 'jkanne-flexible' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
                    <li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Add a blog post', 'jkanne-flexible' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
                    <?php else : ?>
                    <li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Write your first blog post', 'jkanne-flexible' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
                    <li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add an About page', 'jkanne-flexible' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
                    <?php endif; ?>
                    <li><?php printf( '<a href="%s" class="welcome-icon welcome-view-site">' . __( 'View your site', 'jkanne-flexible' ) . '</a>', home_url( '/' ) ); ?></li>
                </ul>
            </div><!-- .welcome-panel-column -->
            <div class="welcome-panel-column welcome-panel-last">
                <h4><?php _e( 'More Actions', 'jkanne-flexible' ); ?></h4>
                <ul>
                    <li><?php printf( '<div class="welcome-icon welcome-widgets-menus">' . __( 'Manage <a href="%1$s">widgets</a> or <a href="%2$s">menus</a>', 'jkanne-flexible' ) . '</div>', admin_url( 'widgets.php' ), admin_url( 'nav-menus.php' ) ); ?></li>
                    <li><?php printf( '<a href="%s" class="welcome-icon welcome-comments">' . __( 'Turn comments on or off', 'jkanne-flexible' ) . '</a>', admin_url( 'options-discussion.php' ) ); ?></li>
                    <li><?php printf( '<a href="%s" target="_blank" class="welcome-icon welcome-learn-more">' . __( 'Learn more about getting started', 'jkanne-flexible' ) . '</a>', 'http://codex.wordpress.org/First_Steps_With_WordPress' ); ?></li>
                </ul>
            </div><!-- .welcome-panel-column welcome-panel-last -->
        </div><!-- .welcome-panel-column-container -->
    </div><!-- .custom-welcome-panel-content -->
<?php
}

add_action( 'welcome_panel', 'jkanne_welcome_panel' );
