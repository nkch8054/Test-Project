<?php


/* start post type */
if ( ! class_exists( 'sayidan_Story_Post_Type' ) ) :

class sayidan_Story_Post_Type {

    private $theme = 'sayidan';
	public function __construct() {
        // Run when the plugin is activated
		register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );

		// Add the story post type and taxonomies
		add_action( 'init', array( $this, 'story_init' ) );

		// Allow filtering of posts by taxonomy in the admin view
		//add_action( 'restrict_manage_posts', array( $this, 'add_taxonomy_filters' ) );

        // Add custom metaboxes
        add_action( 'cmb2_init', array( $this, 'add_story_metaboxes' ) );
	}
    
    /**
     * Add custom metaboxes for post and default pages
     */
    function add_story_metaboxes() {
    
        $cmb_story = new_cmb2_box( array(
                                'id'            => 'story_metabox',
                                'title'         => __( 'Extra Details', 'sayidan' ),
                                'object_types'  => array( 'story', ), // Post type
                                'context'       => 'normal',
                                'priority'      => 'high',
                                'show_names'    => true, // Show field names on the left
                                ) );
        // Author Name
        $cmb_story->add_field( array(
                                'name' => __( 'Author Name', 'sayidan' ),
                                'desc' => __( 'ex: Linda Amelie', 'sayidan' ),
                                'id'   => '_name',
                                'type' => 'text',
                                ) );
        
    }
	/**
	 * Flushes rewrite rules on plugin activation to ensure story posts don't 404.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
	 *
	 * @uses story Item_Post_Type::story_init()
	 */
	public function plugin_activation() {
		$this->story_init();
		flush_rewrite_rules();
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses story Item_Post_Type::register_post_type()
	 * @uses story Item_Post_Type::register_taxonomy_tag()
	 * @uses story Item_Post_Type::register_taxonomy_category()
	 */
	public function story_init() {
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
		return array( 'story_category', 'story_tag' );
	}



	/**
	 * Enable the story Item custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Stories', 'sayidan' ),
			'singular_name'      => __( 'Story Item', 'sayidan' ),
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
			'menu_icon' => 'dashicons-format-chat',
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
				//'revisions',
			),
			'capability_type' => 'page',
			'menu_position'   => 5,
			'hierarchical'      => true,
			'has_archive'     => true,
		);

		$args = apply_filters( 'eventposttype_args', $args );
		register_post_type( 'story', $args );
	}



	/**
	 * Register a taxonomy for story Item Tags.
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

		$args = apply_filters( 'eventposttype_tag_args', $args );

		register_taxonomy( 'story_tag', array( 'story' ), $args );

	}

	/**
	 * Register a taxonomy for story Item Categories.
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

		$args = apply_filters( 'eventposttype_category_args', $args );

        register_taxonomy( 'story_category', array( 'story' ), $args );
	}

}

new sayidan_Story_Post_Type;

endif;
