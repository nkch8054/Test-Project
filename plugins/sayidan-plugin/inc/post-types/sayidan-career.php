<?php


/* start post type */
if ( ! class_exists( 'sayidan_Career_Post_Type' ) ) :

class sayidan_Career_Post_Type {

    private $theme = 'sayidan';
	public function __construct() {
        // Run when the plugin is activated
		register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );

		// Add the career post type and taxonomies
		add_action( 'init', array( $this, 'career_init' ) );

		// Thumbnail support for career posts
		add_theme_support( 'post-thumbnails', array( 'career' ) );

		// Add thumbnails to column view
		add_filter( 'manage_edit-career_columns', array( $this, 'add_thumbnail_column_career'), 10, 1 );
		add_action( 'manage_pages_custom_column', array( $this, 'display_thumbnail_career' ), 10, 1 );

		// Allow filtering of posts by taxonomy in the admin view
		add_action( 'restrict_manage_posts', array( $this, 'add_taxonomy_filters' ) );

		// Show career post counts in the dashboard
		add_action( 'right_now_content_table_end', array( $this, 'add_career_counts' ) );
		
        // Add custom metaboxes
        add_action( 'cmb2_init', array( $this, 'add_career_metaboxes' ) );
        
		//Add taxonomy terms as body classes
		//add_filter( 'body_class', array( $this, 'add_body_classes' ) );
        //add_action( 'add_meta_boxes', array( $this, 'add_events_metaboxes' ) );
        //add_action( 'save_post', array( $this, 'sayidan_career_meta_details_save'), 1, 2); // save the custom fields
	}

    /**
     * Create sayidan career specific meta box key values
     */
    public function add_career_metaboxes() {
        
        /**
         * Initiate the metabox
         */
        
        $cmb_company = new_cmb2_box( array(
                               'id'            => 'company_metabox',
                               'title'         => __( 'About Company', $this->theme ),
                               'object_types'  => array( 'career', ), // Post type
                               'context'       => 'normal',
                               'priority'      => 'high',
                               'show_names'    => true, // Show field names on the left
                               ) );
        // Location
        $cmb_company->add_field( array(
                               'name' => __( 'Location', $this->theme ),
                               'desc' => __( 'ex: Paris, France', $this->theme ),
                               'id'   => '_location',
                               'type' => 'text',
                               ) );
        
        // Description
        $cmb_company->add_field( array(
                               'name' => __( 'Description', $this->theme ),
                               'desc' => __( 'describe company details', $this->theme ),
                               'id'   => '_desc',
                               'type' => 'textarea',
                               ) );
        // Applications
        $cmb_company->add_field( array(
                               'name' => __( 'Extra Field', $this->theme ),
                               'desc' => __( 'ex: 189 Applications', $this->theme ),
                               'id'   => '_applications',
                               'type' => 'text',
                               // 'split_values' => true, // Save latitude and longitude as two separate fields
                               ) );
        // Link
        $cmb_company->add_field( array(
                               'name' => __( 'Link', $this->theme ),
                               'desc' => __( 'event link (optional)', $this->theme ),
                               'id'   => '_link',
                               'type' => 'text_url',
                               ) );
        
        $cmb_job = new_cmb2_box( array(
                               'id'            => 'career_metabox',
                               'title'         => __( 'Job Details', $this->theme ),
                               'object_types'  => array( 'career', ), // Post type
                               'context'       => 'normal',
                               'priority'      => 'high',
                               'show_names'    => true, // Show field names on the left
                               ) );
        // Position
        $cmb_job->add_field( array(
                               'name' => __( 'Position', $this->theme ),
                               'desc' => __( 'ex: Engineer', $this->theme ),
                               'id'   => '_position',
                               'type' => 'text',
                               ) );

        // Rate
        $cmb_job->add_field( array(
                               'name' => __( 'Rate', $this->theme ),
                               'desc' => __( 'ex: 70,000', $this->theme ),
                               'id'   => '_rate',
                               'type' => 'select',
                               'options' => array(
                                      '0'       => __( '< $20,000', $this->theme ),
                                      '1'       => __( '$20,000 - $50,000', $this->theme ),
                                      '2'       => __( '$50,000 - $100,000', $this->theme ),
                                      '3'       => __( '$100,000 - $150,000', $this->theme ),
                                      '4'       => __( '$150,000 - $200,000', $this->theme ),
                                      '5'       => __( '> $200,000', $this->theme ),
                                      ),
                               ) );
        // Role
        $cmb_job->add_field( array(
                               'name' => __( 'Role', $this->theme ),
                               'desc' => __( 'ex: fulltime', $this->theme ),
                               'id'   => '_role',
                               'type' => 'select',
                               'options' => array(
                                      '1'       => __( 'Full-Time', $this->theme ),
                                      '2'       => __( 'Part-Time', $this->theme ),
                                      '3'       => __( 'Freelance', $this->theme ),
                                      '4'       => __( 'Contract', $this->theme ),
                                      ),
                               ) );
        
        // Extras
        $cmb_job->add_field( array(
                                'name' => __( 'Extras', $this->theme ),
                                'desc' => __( 'ex: Remote, Free Mac', $this->theme ),
                                'id'   => '_extras',
                                'type' => 'text',
                                'split_values' => true,
                                ) );
    
        // Apply Link
        $cmb_job->add_field( array(
                               'name'       => __( 'Apply Link', $this->theme ),
                               'desc'       => __( '', $this->theme ),
                               'id'         => '_apply',
                               'default'    => '/apply-to-job/',
                               'type'       => 'text_url',
                               ) );
        // Description
        $cmb_job->add_field( array(
                               'name'       => __( 'Description', $this->theme ),
                               'desc'       => __( 'describe job details', $this->theme ),
                               'id'         => '_descj',
                               'type'       => 'textarea',
                               ) );
        // Advantages
        $cmb_job->add_field( array(
                               'name' => __( 'Feature List', $this->theme ),
                               'desc' => __( 'ex: Remote & Flexible, Personal home office budget, ...', $this->theme ),
                               'id'   => '_featuresj',
                               'type' => 'textarea',
                               //'split_values' => true, // Save values as separate fields
                               ) );
        
        
        $cmb_requirements = new_cmb2_box( array(
                               'id'            => 'requirements_metabox',
                               'title'         => __( 'Skills & Requirements', $this->theme ),
                               'object_types'  => array( 'career', ), // Post type
                               'context'       => 'normal',
                               'priority'      => 'high',
                               'show_names'    => true, // Show field names on the left
                               ) );

        // Description
        $cmb_requirements->add_field( array(
                               'name'       => __( 'Description', $this->theme ),
                               'desc'       => __( 'describe job details', $this->theme ),
                               'id'         => '_descr',
                               'default'    => '',
                               'type'       => 'textarea',
                               ) );
        // Advantages
        $cmb_requirements->add_field( array(
                               'name' => __( 'Feature List', $this->theme ),
                               'desc' => __( 'provide one feature per line', $this->theme ),
                               'id'   => '_featuresr',
                               'type' => 'textarea',
                               //'split_values' => true, // Save values as separate fields
                               ) );
    }
    
	/**
	 * Load the plugin text domain for translation.
	 */


	/**
	 * Flushes rewrite rules on plugin activation to ensure career posts don't 404.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
	 *
	 * @uses career Item_Post_Type::career_init()
	 */
	public function plugin_activation() {
		$this->career_init();
		flush_rewrite_rules();
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses career Item_Post_Type::register_post_type()
	 * @uses career Item_Post_Type::register_taxonomy_tag()
	 * @uses career Item_Post_Type::register_taxonomy_category()
	 */
	public function career_init() {
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
		return array( 'career_category', 'career_tag' );
	}



	/**
	 * Enable the career Item custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Career', 'sayidan' ),
			'singular_name'      => __( 'Career Item', 'sayidan' ),
			'add_new'            => __( 'Add New', 'sayidan' ),
			'add_new_item'       => __( 'Add New', 'sayidan' ),
			'edit_item'          => __( 'Edit Item', 'sayidan' ),
			'new_item'           => __( 'Add New  Item', 'sayidan' ),
			'view_item'          => __( 'View Item', 'sayidan' ),
			'search_items'       => __( 'Search Items', 'sayidan' ),
			'not_found'          => __( 'No items found', 'sayidan' ),
			'not_found_in_trash' => __( 'No items found in trash', 'sayidan' ),
		);
		
		$args = array(
			'menu_icon' => 'dashicons-welcome-learn-more',
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

		$args = apply_filters( 'sayidan_args', $args );
		register_post_type( 'career', $args );
	}



	/**
	 * Register a taxonomy for career Item Tags.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_tag() {
		$labels = array(
			'name'                       => __( 'Tags', 'sayidan' ),
			'singular_name'              => __( 'Tag', 'sayidan' ),
			'menu_name'                  => __( 'Tags', 'sayidan' ),
			'edit_item'                  => __( 'Edit Tag', 'sayidan' ),
			'update_item'                => __( 'Update Tag', 'sayidan' ),
			'add_new_item'               => __( 'Add New Tag', 'sayidan' ),
			'new_item_name'              => __( 'New  Tag Name', 'sayidan' ),
			'parent_item'                => __( 'Parent Tag', 'sayidan' ),
			'parent_item_colon'          => __( 'Parent Tag:', 'sayidan' ),
			'all_items'                  => __( 'All Tags', 'sayidan' ),
			'search_items'               => __( 'Search  Tags', 'sayidan' ),
			'popular_items'              => __( 'Popular Tags', 'sayidan' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'sayidan' ),
			'add_or_remove_items'        => __( 'Add or remove tags', 'sayidan' ),
			'choose_from_most_used'      => __( 'Choose from the most used tags', 'sayidan' ),
			'not_found'                  => __( 'No  tags found.', 'sayidan' ),
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

		$args = apply_filters( 'sayidan_tag_args', $args );

		register_taxonomy( 'career_tag', array( 'career' ), $args );

	}

	/**
	 * Register a taxonomy for career Item Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		

		$labels = array(
			'name'                       => __( 'Categories', 'sayidan' ),
			'singular_name'              => __( 'Category', 'sayidan' ),
			'menu_name'                  => __( 'Categories', 'sayidan' ),
			'edit_item'                  => __( 'Edit Category', 'sayidan' ),
			'update_item'                => __( 'Update Category', 'sayidan' ),
			'add_new_item'               => __( 'Add New Category', 'sayidan' ),
			'new_item_name'              => __( 'New Category Name', 'sayidan' ),
			'parent_item'                => __( 'Parent Category', 'sayidan' ),
			'parent_item_colon'          => __( 'Parent Category:', 'sayidan' ),
			'all_items'                  => __( 'All Categories', 'sayidan' ),
			'search_items'               => __( 'Search Categories', 'sayidan' ),
			'popular_items'              => __( 'Popular Categories', 'sayidan' ),
			'separate_items_with_commas' => __( 'Separate categories with commas', 'sayidan' ),
			'add_or_remove_items'        => __( 'Add or remove categories', 'sayidan' ),
			'choose_from_most_used'      => __( 'Choose from the most used categories', 'sayidan' ),
			'not_found'                  => __( 'No categories found.', 'sayidan' ),
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

		$args = apply_filters( 'sayidan_category_args', $args );

		register_taxonomy( 'career_category', array( 'career' ), $args );
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
	 * Add columns to career Item list screen.
	 *
	 * @link http://wptheming.com/2010/07/column-edit-pages/
	 *
	 * @param array $columns Existing columns.
	 *
	 * @return array Amended columns.
	 */
	public function add_thumbnail_column_career( $columns ) {
		$column_thumbnail = array( 'thumbnail' => __( 'Thumbnail', 'sayidan' ) );
		return array_slice( $columns, 0, 2, true ) + $column_thumbnail + array_slice( $columns, 1, null, true );
	}

	/**
	 * Custom column callback
	 *
	 * @global stdClass $post Post object.
	 *
	 * @param string $column Column ID.
	 */
	public function display_thumbnail_career( $column ) {
		global $post;
        if( $post->post_type == 'career' ){
            switch ( $column ) {
                case 'thumbnail':
                    echo get_the_post_thumbnail( $post->ID, array(35, 35, true ), array('class' => 'img-responsive') );
                break;
            }
        }
	}

	/**
	 * Add taxonomy filters to the career admin page.
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
		if ( 'career' != $typenow ) {
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
	 * Add career Item count to "Right Now" dashboard widget.
	 *
	 * @return null Return early if career post type does not exist.
	 */
	public function add_career_counts() {
		if ( ! post_type_exists( 'career' ) ) {
			return;
		}

		$num_posts = wp_count_posts( 'career' );

		// Published items
		$href = 'edit.php?post_type=career';
		$num  = number_format_i18n( $num_posts->publish );
		$num  = $this->link_if_can_edit_posts( $num, $href );
		$text = _n( 'career Item Item', 'career Item Items', intval( $num_posts->publish ) );
		$text = $this->link_if_can_edit_posts( $text, $href );
		$this->display_dashboard_count( $num, $text );

		if ( 0 == $num_posts->pending ) {
			return;
		}

		// Pending items
		$href = 'edit.php?post_status=pending&amp;post_type=career';
		$num  = number_format_i18n( $num_posts->pending );
		$num  = $this->link_if_can_edit_posts( $num, $href );
		$text = _n( 'career Item Item Pending', 'career Item Items Pending', intval( $num_posts->pending ) );
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
			<td class="first b b-career"><?php echo esc_html( $number ); ?></td>
			<td class="t career"><?php echo esc_html( $label ); ?></td>
		</tr>
		<?php
	}
}

new sayidan_Career_Post_Type;

endif;
