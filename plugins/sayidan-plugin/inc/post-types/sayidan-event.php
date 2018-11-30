<?php

        /* start post type */
        if ( ! class_exists( 'sayidan_Event_Post_Type' ) ) :
        
        class sayidan_Event_Post_Type {
            
            private $theme = 'sayidan';
            public function __construct() {
                // Run when the plugin is activated
                register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );
                
                // Add the event post type and taxonomies
                add_action( 'init', array( $this, 'event_init' ) );
                
                // Thumbnail support for event posts
                add_theme_support( 'post-thumbnails', array( 'event' ) );
                
                // Add thumbnails to column view
                add_filter( 'manage_edit-event_columns', array( $this, 'add_thumbnail_column_event'), 10, 1 );
                add_action( 'manage_pages_custom_column', array( $this, 'display_thumbnail_event' ), 10, 1 );
                
                // Allow filtering of posts by taxonomy in the admin view
                add_action( 'restrict_manage_posts', array( $this, 'add_taxonomy_filters' ) );
                
                // Show event post counts in the dashboard
                add_action( 'right_now_content_table_end', array( $this, 'add_event_counts' ) );
                
                
                // Add taxonomy terms as body classes
                //add_filter( 'body_class', array( $this, 'add_body_classes' ) );\
                // Add custom post metaboxes
                add_action( 'cmb2_init', array( $this, 'add_events_metaboxes' ) );
                
                //add_action( 'add_meta_boxes', array( $this, 'add_events_metaboxes' ) );
                //add_action( 'save_post', array( $this, $this->theme . '_event_meta_details_save'), 1, 2); // save the custom fields
            }
            
            /**
             * Create sayidan event specific meta box key values
             */
            public function add_events_metaboxes() {
                
                /**
                 * Initiate the metabox
                 */
                $cmb = new_cmb2_box( array(
                                       'id'            => 'events_metabox',
                                       'title'         => __( 'Event Details', $this->theme ),
                                       'object_types'  => array( 'event', ), // Post type
                                       'context'       => 'normal',
                                       'priority'      => 'high',
                                       'show_names'    => true, // Show field names on the left
                                       // 'cmb_styles' => false, // false to disable the CMB stylesheet
                                       // 'closed'     => true, // Keep the metabox closed by default
                                       ) );
                
                // Regular text field
                $cmb->add_field( array(
                                       'name'       => __( 'Content', $this->theme ),
                                       'desc'       => __( 'field description (optional)', $this->theme ),
                                       'id'         => $this->theme . '_text',
                                       'type'       => 'wysiwyg',
                                       ) );
                
                // Location
                $cmb->add_field( array(
                                       'name' => __( 'Location', $this->theme ),
                                       'desc' => __( 'event location (optional)', $this->theme ),
                                       'id'   => $this->theme . '_location',
                                       'type' => 'text',
                                       ) );
                
                // Latitude, Longitude
                $cmb->add_field( array(
                                       'name' => __( 'Latitude, Longitude', $this->theme ),
                                       'desc' => __( 'Ex: 50.821116,4.3672731', $this->theme ),
                                       'id'   => $this->theme . '_latlon',
                                       'type' => 'text',
                                       // 'split_values' => true, // Save latitude and longitude as two separate fields
                                       ) );
                // Time
                $cmb->add_field( array(
                                       'name' => __( 'Time', $this->theme ),
                                       'desc' => __( 'event time (optional)', $this->theme ),
                                       'id'   => $this->theme . '_time',
                                       'type' => 'text_datetime_timestamp',
                                       ) );
                
                // URL text field
                $cmb->add_field( array(
                                       'name' => __( 'Max Tickets', $this->theme ),
                                       'desc' => __( 'max amount of people that can attend', $this->theme ),
                                       'id'   => $this->theme . '_tickets',
                                       'type' => 'text',
                                       ) );
                
                // URL text field
                $cmb->add_field( array(
                                       'name' => __( 'External Link', $this->theme ),
                                       'desc' => __( 'event link (optional)', $this->theme ),
                                       'id'   => $this->theme . '_url',
                                       'type' => 'text_url',
                                       ) );
                
                // Warning Label
                $cmb->add_field( array(
                                       'name' => __( 'Warning Label', $this->theme ),
                                       'desc' => __( 'ex: 2 tickets left', $this->theme ),
                                       'id'   => $this->theme . '_warning',
                                       'type' => 'text',
                                       ) );
                
                // Available
                $cmb->add_field( array(
                                       'name' => __( 'Available', $this->theme ),
                                       'desc' => __( 'is event available for registration', $this->theme ),
                                       'id'   => $this->theme . '_available',
                                       'type' => 'checkbox',
                                       ) );
            }

            
            /**
             * Flushes rewrite rules on plugin activation to ensure event posts don't 404.
             *
             * @link http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
             *
             * @uses event Item_Post_Type::event_init()
             */
            public function plugin_activation() {
                $this->event_init();
                flush_rewrite_rules();
            }
            
            /**
             * Initiate registrations of post type and taxonomies.
             *
             * @uses event Item_Post_Type::register_post_type()
             * @uses event Item_Post_Type::register_taxonomy_tag()
             * @uses event Item_Post_Type::register_taxonomy_category()
             */
            public function event_init() {
                $this->register_post_type();
                $this->register_taxonomy_category();
                $this->register_taxonomy_tag();
                //$this->add_events_metaboxes();
            }
            
            /**
             * Get an array of all taxonomies this plugin handles.
             *
             * @return array Taxonomy slugs.
             */
            protected function get_taxonomies() {
                return array( 'event_category', 'event_tag' );
            }
            
            
            
            /**
             * Enable the event Item custom post type.
             *
             * @link http://codex.wordpress.org/Function_Reference/register_post_type
             */
            protected function register_post_type() {
                $labels = array(
                                'name'               => __( 'Events', $this->theme ),
                                'singular_name'      => __( 'Event Item', $this->theme ),
                                'add_new'            => __( 'Add New', $this->theme ),
                                'add_new_item'       => __( 'Add New', $this->theme ),
                                'edit_item'          => __( 'Edit Item', $this->theme ),
                                'new_item'           => __( 'Add New  Item', $this->theme ),
                                'view_item'          => __( 'View Item', $this->theme ),
                                'search_items'       => __( 'Search Items', $this->theme ),
                                'not_found'          => __( 'No items found', $this->theme ),
                                'not_found_in_trash' => __( 'No items found in trash', $this->theme ),
                                );
                
                $args = array(
                              'menu_icon' => 'dashicons-megaphone',
                              'labels'          => $labels,
                              'public'          => true,
                              'supports'        => array(
                                                         'title',
                                                         'editor',
                                                         'excerpt',
                                                         'thumbnail',
                                                         //'comments',
                                                         //'author',
                                                         //'custom-fields',
                                                         'revisions',
                                                         ),
                              'capability_type' => 'page',
                              'menu_position'   => 5,
                              'hierarchical'      => true,
                              'has_archive'     => true,
                              );
                
                $args = apply_filters( 'eventposttype_args', $args );
                register_post_type( 'event', $args );
            }
            
            
            
            /**
             * Register a taxonomy for event Item Tags.
             *
             * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
             */
            protected function register_taxonomy_tag() {
                $labels = array(
                                'name'                       => __( 'Tags', $this->theme ),
                                'singular_name'              => __( 'Tag', $this->theme ),
                                'menu_name'                  => __( 'Tags', $this->theme ),
                                'edit_item'                  => __( 'Edit Tag', $this->theme ),
                                'update_item'                => __( 'Update Tag', $this->theme ),
                                'add_new_item'               => __( 'Add New Tag', $this->theme ),
                                'new_item_name'              => __( 'New  Tag Name', $this->theme ),
                                'parent_item'                => __( 'Parent Tag', $this->theme ),
                                'parent_item_colon'          => __( 'Parent Tag:', $this->theme ),
                                'all_items'                  => __( 'All Tags', $this->theme ),
                                'search_items'               => __( 'Search  Tags', $this->theme ),
                                'popular_items'              => __( 'Popular Tags', $this->theme ),
                                'separate_items_with_commas' => __( 'Separate tags with commas', $this->theme ),
                                'add_or_remove_items'        => __( 'Add or remove tags', $this->theme ),
                                'choose_from_most_used'      => __( 'Choose from the most used tags', $this->theme ),
                                'not_found'                  => __( 'No  tags found.', $this->theme ),
                                );
                
                $args = array(
                              'labels'            => $labels,
                              'public'            => true,
                              'show_in_nav_menus' => true,
                              'show_ui'           => true,
                              'show_tagcloud'     => true,
                              'hierarchical'      => false,
                              'show_admin_column' => true,
                              'query_var'         => true,
                              
                              );
                
                $args = apply_filters( 'eventposttype_tag_args', $args );
                
                register_taxonomy( 'event_tag', array( 'event' ), $args );
                
            }
            
            /**
             * Register a taxonomy for event Item Categories.
             *
             * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
             */
            protected function register_taxonomy_category() {
                
                
                $labels = array(
                                'name'                       => __( 'Categories', $this->theme ),
                                'singular_name'              => __( 'Category', $this->theme ),
                                'menu_name'                  => __( 'Categories', $this->theme ),
                                'edit_item'                  => __( 'Edit Category', $this->theme ),
                                'update_item'                => __( 'Update Category', $this->theme ),
                                'add_new_item'               => __( 'Add New Category', $this->theme ),
                                'new_item_name'              => __( 'New Category Name', $this->theme ),
                                'parent_item'                => __( 'Parent Category', $this->theme ),
                                'parent_item_colon'          => __( 'Parent Category:', $this->theme ),
                                'all_items'                  => __( 'All Categories', $this->theme ),
                                'search_items'               => __( 'Search Categories', $this->theme ),
                                'popular_items'              => __( 'Popular Categories', $this->theme ),
                                'separate_items_with_commas' => __( 'Separate categories with commas', $this->theme ),
                                'add_or_remove_items'        => __( 'Add or remove categories', $this->theme ),
                                'choose_from_most_used'      => __( 'Choose from the most used categories', $this->theme ),
                                'not_found'                  => __( 'No categories found.', $this->theme ),
                                );
                
                $args = array(
                              'labels'            => $labels,
                              'public'            => true,
                              'show_in_nav_menus' => true,
                              'show_ui'           => true,
                              'show_tagcloud'     => true,
                              'hierarchical'      => true,
                              'show_admin_column' => true,
                              'query_var'         => true,
                              );
                
                $args = apply_filters( 'eventposttype_category_args', $args );
                
                register_taxonomy( 'event_category', array( 'event' ), $args );
                
                global $flatsome_opt;
                
                if(isset($flatsome_opt['events_page']) && $flatsome_opt['events_page']){
                    add_action( 'wp_loaded', 'add_ux_event_permastructure' );
                    function add_ux_event_permastructure() {
                        global $wp_rewrite, $flatsome_opt;
                        $items_link = $flatsome_opt['events_page'];
                        add_permastruct( 'event_category',  $items_link.'/%event_category%', false );
                        add_permastruct( 'event', $items_link.'/%event_category%/%event%', false );
                    }
                    
                    add_filter( 'post_type_link', 'ux_events_permalinks', 10, 2 );
                    function ux_events_permalinks( $permalink, $post ) {
                        if ( $post->post_type !== 'event' )
                            return $permalink;
                        
                        $terms = get_the_terms( $post->ID, 'event_category' );
                        
                        if ( ! $terms )
                            return str_replace( '%event_category%', '', $permalink );
                        
                        $post_terms = array();
                        foreach ( $terms as $term )
                        $post_terms[] = $term->slug;
                        
                        return str_replace( '%event_category%', implode( ',', $post_terms ) , $permalink );
                    }

                    // Make sure that all term links include their parents in the permalinks
                    add_filter( 'term_link', 'add_term_parents_to_permalinks', 10, 2 );
                    
                    function add_term_parents_to_permalinks( $permalink, $term ) {
                        $term_parents = get_term_parents( $term );
                        
                        foreach ( $term_parents as $term_parent )
                        $permlink = str_replace( $term->slug, $term_parent->slug . ',' . $term->slug, $permalink );
                        
                        return $permalink;
                    }
                    
                    // Helper function to get all parents of a term
                    function get_term_parents( $term, &$parents = array() ) {
                        $parent = get_term( $term->parent, $term->taxonomy );
                        
                        if ( is_wp_error( $parent ) )
                            return $parents;
                        
                        $parents[] = $parent;
                        
                        if ( $parent->parent )
                            get_term_parents( $parent, $parents );
                        
                        return $parents;
                    }
                    
                } // Set custom permalinks
            }
            
            /**
             * Add taxonomy terms as body classes.
             *
             * If the taxonomy doesn't exist (has been unregistered), then get_the_terms() returns WP_Error, which is checked
             * for before adding classes.
             *
             * @param array $classes Existing body classes.
             *
             * @return array Amended body classes.
             */
            public function add_body_classes( $classes ) {
                $taxonomies = $this->get_taxonomies();
                
                foreach( $taxonomies as $taxonomy ) {
                    $terms = get_the_terms( get_the_ID(), $taxonomy );
                    if ( $terms && ! is_wp_error( $terms ) ) {
                        foreach( $terms as $term ) {
                            $classes[] = sanitize_html_class( str_replace( '_', '-', $taxonomy ) . '-' . $term->slug );
                        }
                    }
                }
                
                return $classes;
            }
            
            /**
             * Add columns to event Item list screen.
             *
             * @link http://wptheming.com/2010/07/column-edit-pages/
             *
             * @param array $columns Existing columns.
             *
             * @return array Amended columns.
             */
            public function add_thumbnail_column_event( $columns ) {
                $column_thumbnail = array( 'thumbnail' => __( 'Thumbnail', $this->theme ) );
                return array_slice( $columns, 0, 2, true ) + $column_thumbnail + array_slice( $columns, 1, null, true );
            }
            
            /**
             * Custom column callback
             *
             * @global stdClass $post Post object.
             *
             * @param string $column Column ID.
             */
            public function display_thumbnail_event( $column ) {
                global $post;
                if( $post->post_type == 'event' ){
                    switch ( $column ) {
                        case 'thumbnail':
                            //print_r($post);
                            echo get_the_post_thumbnail( $post->ID, array(35, 35) );
                        break;
                    }
                }
            }
            
            /**
             * Add taxonomy filters to the event admin page.
             *
             * Code artfully lifted from http://pippinsplugins.com/
             *
             * @global string $typenow
             */
            public function add_taxonomy_filters() {
                global $typenow;
                
                // An array of all the taxonomies you want to display. Use the taxonomy name or slug
                $taxonomies = $this->get_taxonomies();
                
                // Must set this to the post type you want the filter(s) displayed on
                if ( 'event' != $typenow ) {
                    return;
                }
                
                foreach ( $taxonomies as $tax_slug ) {
                    $current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
                    $tax_obj          = get_taxonomy( $tax_slug );
                    $tax_name         = $tax_obj->labels->name;
                    $terms            = get_terms( $tax_slug );
                    if ( 0 == count( $terms ) ) {
                        return;
                    }
                    echo '<select name="' . esc_attr( $tax_slug ) . '" id="' . esc_attr( $tax_slug ) . '" class="postform">';
                    echo '<option>' . esc_html( $tax_name ) .'</option>';
                    foreach ( $terms as $term ) {
                        printf(
                               '<option value="%s"%s />%s</option>',
                               esc_attr( $term->slug ),
                               selected( $current_tax_slug, $term->slug ),
                               esc_html( $term->name . '(' . $term->count . ')' )
                               );
                    }
                    echo '</select>';
                }
            }
            
            /**
             * Add event Item count to "Right Now" dashboard widget.
             *
             * @return null Return early if event post type does not exist.
             */
            public function add_event_counts() {
                if ( ! post_type_exists( 'event' ) ) {
                    return;
                }
                
                $num_posts = wp_count_posts( 'event' );
                
                // Published items
                $href = 'edit.php?post_type=event';
                $num  = number_format_i18n( $num_posts->publish );
                $num  = $this->link_if_can_edit_posts( $num, $href );
                $text = _n( 'event Item Item', 'event Item Items', intval( $num_posts->publish ) );
                $text = $this->link_if_can_edit_posts( $text, $href );
                $this->display_dashboard_count( $num, $text );
                
                if ( 0 == $num_posts->pending ) {
                    return;
                }
                
                // Pending items
                $href = 'edit.php?post_status=pending&amp;post_type=event';
                $num  = number_format_i18n( $num_posts->pending );
                $num  = $this->link_if_can_edit_posts( $num, $href );
                $text = _n( 'event Item Item Pending', 'event Item Items Pending', intval( $num_posts->pending ) );
                $text = $this->link_if_can_edit_posts( $text, $href );
                $this->display_dashboard_count( $num, $text );
            }
            
            /**
             * Wrap a dashboard number or text value in a link, if the current user can edit posts.
             *
             * @param  string $value Value to potentially wrap in a link.
             * @param  string $href  Link target.
             *
             * @return string        Value wrapped in a link if current user can edit posts, or original value otherwise.
             */
            protected function link_if_can_edit_posts( $value, $href ) {
                if ( current_user_can( 'edit_posts' ) ) {
                    return '<a href="' . esc_url( $href ) . '">' . $value . '</a>';
                }
                return $value;
            }
            
            /**
             * Display a number and text with table row and cell markup for the dashboard counters.
             *
             * @param  string $number Number to display. May be wrapped in a link.
             * @param  string $label  Text to display. May be wrapped in a link.
             */
            protected function display_dashboard_count( $number, $label ) {
                ?>
<tr>
<td class="first b b-event"><?php echo esc_html( $number ); ?></td>
<td class="t event"><?php echo esc_html( $label ); ?></td>
</tr>
<?php
    }
    }
    
    new sayidan_Event_Post_Type;
    
    endif;


?>