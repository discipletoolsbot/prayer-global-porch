<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly.

class Prayer_Global_CTA_Post_Type {

    public $post_type = 'ctas';
    public $singular = 'CTA';
    public $plural = 'CTAs';
    public $category = 'category';
    public $cat_singular = 'Category';
    public $cat_plural = 'Categories';
    public $search_items;

    public function __construct() {
        $this->search_items = sprintf( _x( 'Search %s', "Search 'something'", 'disciple_tools' ), $this->plural );
        add_action( 'init', [ $this, 'register_post_type' ] );
        add_action( 'init', [ $this, 'register_taxonomy' ], 0 );
        add_action( 'init', [ $this, 'rewrite_init' ] );
        add_filter( 'post_type_link', [ $this, 'permalink' ], 1, 3 );
        add_filter( 'desktop_navbar_menu_options', [ $this, 'add_navigation_links' ], 20 );
        add_filter( 'dt_nav_add_post_menu', [ $this, 'dt_nav_add_post_menu' ], 10, 1 );
        add_filter( 'dt_templates_for_urls', [ $this, 'add_template_for_url' ] );
        add_filter( 'dt_get_post_type_settings', [ $this, 'dt_get_post_type_settings' ], 10, 2 );
        add_filter( 'dt_registered_post_types', [ $this, 'dt_registered_post_types' ], 10, 1 );
        add_filter( 'dt_details_additional_section_ids', [ $this, 'dt_details_additional_section_ids' ], 10, 2 );
        add_action( 'init', [ $this, 'register_p2p_connections' ], 50, 0 );
        add_filter( 'dt_capabilities', [ $this, 'dt_capabilities' ], 100, 1 );
        add_filter( 'dt_set_roles_and_permissions', [ $this, 'dt_set_roles_and_permissions' ], 20, 1 ); //after contacts
        add_filter( 'allowed_wp_v2_paths', [ $this, 'allowed_wp_v2_paths' ], 10, 1 );
    }

    public function register_post_type(){
        $labels = [
            'name'                  => $this->plural,
            'singular_name'         => $this->singular,
            'menu_name'             => $this->plural,
            'search_items'          => $this->search_items,
        ];
        $rewrite = [
            'slug'       => $this->post_type,
            'with_front' => true,
            'pages'      => true,
            'feeds'      => false,
        ];
        $capabilities = [
            'create_posts'        => 'dt_all_admin_' . $this->post_type,
            'edit_post'           => 'dt_all_admin_' . $this->post_type, // needed for bulk edit
            'read_post'           => 'dt_all_admin_' . $this->post_type,
            'delete_post'         => 'dt_all_admin_' . $this->post_type, // delete individual post
            'delete_others_posts' => 'do_not_allow',
            'delete_posts'        => 'dt_all_admin_' . $this->post_type, // bulk delete posts
            'edit_posts'          => 'dt_all_admin_' . $this->post_type, //menu link in WP Admin
            'edit_others_posts'   => 'do_not_allow',
            'publish_posts'       => 'dt_all_admin_' . $this->post_type,
            'read_private_posts'  => 'do_not_allow',
        ];

        $menu_icon = file_get_contents( plugin_dir_path( __FILE__ ) . 'megaphone.svg' );
        $defaults = [
            'label'                 => $this->singular,
            'labels'                => $labels,
            'public'                => false,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => false,
            'show_in_admin_bar'     => true,
            'rewrite'               => $rewrite,
            'capabilities'          => $capabilities,
            'capability_type'       => $this->post_type,
            'has_archive'           => true, //$archive_slug,
            'hierarchical'          => false,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'menu_position'         => 5,
            'menu_icon'             => 'data:image/svg+xml;base64,' . base64_encode( $menu_icon ),
            'show_in_nav_menus'     => true,
            'can_export'            => false,
            'exclude_from_search'   => true,
            'show_in_rest'          => true,
        ];

        // Adjust defaults accordingly, prior to registration.
        $defaults = apply_filters( 'dt_register_post_type_defaults', $defaults, $this->post_type );
        register_post_type( $this->post_type, $defaults );
    }

    public function rewrite_init(){
        add_rewrite_rule( $this->post_type . '/([0-9]+)?$', 'index.php?post_type=' . $this->post_type . '&p=$matches[1]', 'top' );
    }



    public function register_taxonomy() {

        $labels = array(
            'name' => $this->cat_singular,
            'singular_name' => $this->cat_singular,
            'search_items' => "Search $this->cat_plural" ,
            'all_items' => "All $this->cat_plural",
            'parent_item' => "Parent $this->cat_singular",
            'parent_item_colon' => "Parent $this->cat_singular:",
            'edit_item' => "Edit $this->cat_singular",
            'update_item' => "Update $this->cat_singular",
            'add_new_item' => "Add New $this->cat_singular",
            'new_item_name' => "New $this->cat_singular Name",
            'menu_name' => $this->cat_singular,
        );

        register_taxonomy( $this->category, array( $this->post_type ), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => $this->category ),
        ));

    }



    /**
     * Run on activation.
     */
    public function activation() {
        $this->flush_rewrite_rules();
    }

    /**
     * Flush the rewrite rules
     */
    private function flush_rewrite_rules() {
        $this->register_post_type();
        flush_rewrite_rules();
    } // End flush_rewrite_rules()

    public function permalink( $post_link, $post ) {
        if ( $post->post_type === $this->post_type ) {
            return home_url( $this->post_type . '/' . $post->ID . '/' );
        } else {
            return $post_link;
        }
    }

    public function add_navigation_links( $tabs ) {
        if ( current_user_can( 'access_' . $this->post_type ) ) {
            $tabs[$this->post_type] = [
                'link' => site_url( "/$this->post_type/" ),
                'label' => $this->plural,
                'icon' => '',
                'hidden' => false,
                'submenu' => []
            ];
        }
        return $tabs;
    }

    public function dt_nav_add_post_menu( $links ){
        if ( current_user_can( 'create_' . $this->post_type ) ){
            $links[] = [
                'label' => sprintf( esc_html__( 'New %s', 'disciple_tools' ), esc_html( $this->singular ) ),
                'link' => esc_url( site_url( '/' ) ) . esc_html( $this->post_type ) . '/new',
                'icon' => get_template_directory_uri() . '/dt-assets/images/circle-add-green.svg',
                'hidden' => false,
            ];
        }
        return $links;
    }

    public function add_template_for_url( $template_for_url ){
        $template_for_url[$this->post_type] = 'archive-template.php';
        $template_for_url[$this->post_type . '/new'] = 'template-new-post.php';
        $template_for_url[$this->post_type . '/new-bulk'] = 'template-new-bulk-post.php';
        $template_for_url[$this->post_type . '/mergedetails'] = 'template-merge-post-details.php';
        return $template_for_url;
    }

    public static function get_base_post_type_fields(){
        $fields = [];
        $fields['name'] = [
            'name' => __( 'Name', 'disciple_tools' ),
            'type' => 'text',
            'tile' => 'details',
            'in_create_form' => true,
            'required' => true,
            'icon' => get_template_directory_uri() . '/dt-assets/images/name.svg',
            'show_in_table' => 5
        ];
        $fields['last_modified'] =[
            'name' => __( 'Last Modified', 'disciple_tools' ),
            'type' => 'date',
            'default' => 0,
            'icon' => get_template_directory_uri() . '/dt-assets/images/calendar-range.svg',
            'customizable' => false,
            'show_in_table' => 100
        ];
        $fields['post_date'] =[
            'name' => __( 'Creation Date', 'disciple_tools' ),
            'type' => 'date',
            'default' => 0,
            'icon' => get_template_directory_uri() . '/dt-assets/images/calendar-plus.svg',
            'customizable' => false,
        ];
        $fields['favorite'] = [
            'name'        => __( 'Favorite', 'disciple_tools' ),
            'type'        => 'boolean',
            'default'     => false,
            'private'     => true,
            'show_in_table' => 6,
            'icon' => get_template_directory_uri() . '/dt-assets/images/star.svg'
        ];
        $fields['tags'] = [
            'name'        => __( 'Tags', 'disciple_tools' ),
            'description' => _x( 'A useful way to group related items.', 'Optional Documentation', 'disciple_tools' ),
            'type'        => 'tags',
            'default'     => [],
            'tile'        => 'other',
            'icon' => get_template_directory_uri() . '/dt-assets/images/tag.svg',
        ];
        $fields['follow'] = [
            'name'        => __( 'Follow', 'disciple_tools' ),
            'type'        => 'multi_select',
            'default'     => [],
            'hidden'      => true
        ];
        $fields['unfollow'] = [
            'name'        => __( 'Un-Follow', 'disciple_tools' ),
            'type'        => 'multi_select',
            'default'     => [],
            'hidden'      => true
        ];
        $fields['tasks'] = [
            'name' => __( 'Tasks', 'disciple_tools' ),
            'type' => 'task',
            'icon' => get_template_directory_uri() . '/dt-assets/images/calendar-clock.svg',
            'private' => true
        ];
        //notes field used for adding comments when creating a record
        $fields['notes'] = [
            'name' => 'Notes',
            'type' => 'array',
            'hidden' => true
        ];
        return $fields;
    }

    /**
     * Get the settings for the custom fields.
     *
     * @param bool $with_deleted_options
     * @param bool $load_from_cache
     *
     * @return mixed
     */
    public function get_custom_fields_settings( $with_deleted_options = false, $load_from_cache = true ) {
        return DT_Posts::get_post_field_settings( $this->post_type, $load_from_cache, $with_deleted_options );
    }

    public function dt_get_post_type_settings( $settings, $post_type ){
        if ( $post_type === $this->post_type ){
            $cached = wp_cache_get( $post_type . '_type_settings' );
            if ( $cached ){
                return $cached;
            }
            $fields = $this->get_custom_fields_settings();
            $channels = [];
            foreach ( $fields as $field_key => $field_value ){
                if ( $field_value['type'] === 'communication_channel' ){
                    $field_value['label'] = $field_value['name'];
                    $channels[str_replace( 'contact_', '', $field_key )] = $field_value;
                }
            }
            $s = [
                'fields' => $fields,
                'channels' => $channels,
                'connection_types' => array_keys( array_filter( $fields, function ( $a ) {
                    return $a['type'] === 'connection';
                } ) ),
                'label_singular' => $this->singular,
                'label_plural' => $this->plural,
                'post_type' => $this->post_type
            ];
            $settings = dt_array_merge_recursive_distinct( $settings, $s );

            wp_cache_set( $post_type . '_type_settings', $settings );
        }
        return $settings;
    }

    public function dt_registered_post_types( $post_types ){
        $post_types[] = $this->post_type;
        return $post_types;
    }

    public function dt_details_additional_section_ids( $sections, $post_type ){
//        if ( $post_type === $this->post_type ) {
//            $sections[] = 'details';
//        }
        return $sections;
    }


    /**
     * register p2p connections dynamically based on the connection field declaration
     */
    public function register_p2p_connections(){
        $fields = DT_Posts::get_post_field_settings( $this->post_type, false );
        foreach ( $fields as $field_key => &$field ){
            if ( !isset( $field['name'] ) ){
                $field['name'] = $field_key; //set a field name so integration can depend on it.
            }
            //register a connection if it is not set
            if ( $field['type'] === 'connection' && isset( $field['p2p_key'], $field['post_type'] ) ){
                $p2p_type = p2p_type( $field['p2p_key'] );
                if ( $p2p_type === false ){
                    if ( $field['p2p_direction'] === 'to' ){
                        p2p_register_connection_type(
                            [
                                'name'        => $field['p2p_key'],
                                'to'          => $this->post_type,
                                'from'        => $field['post_type']
                            ]
                        );
                    } else {
                        p2p_register_connection_type(
                            [
                                'name'        => $field['p2p_key'],
                                'from'        => $this->post_type,
                                'to'          => $field['post_type']
                            ]
                        );
                    }
                }
            }
        }
    }
    /**
     * Declare Default D.T post roles
     */
    public function dt_capabilities( $capabilities ){
        $capabilities['access_' . $this->post_type] = [
            'source' => $this->plural,
            'description' => 'The user can access the UI for ' . $this->plural,
        ];
//        $capabilities['update_'  . $this->post_type] = [
//            'source' => $this->plural,
//            'description' => 'The user can edit existing ' . $this->plural,
//        ];
        $capabilities['create_'  . $this->post_type] = [
            'source' => $this->plural,
            'description' => 'The user can create ' . $this->plural
        ];
        $capabilities['view_any_'  . $this->post_type] = [
            'source' => $this->plural,
            'description' => 'The user can view any ' . $this->singular
        ];
        $capabilities['update_any_'  . $this->post_type] = [
            'source' => $this->plural,
            'description' => 'The user can update any ' . $this->singular
        ];
        $capabilities['delete_any_'  . $this->post_type] = [
            'source' => $this->plural,
            'description' => 'The user can delete any ' . $this->singular
        ];
        return $capabilities;
    }

    /**
     * @todo define the permissions for the roles
     * Documentation
     * @link https://github.com/DiscipleTools/Documentation/blob/master/Theme-Core/roles-permissions.md#rolesd
     */
    public function dt_set_roles_and_permissions( $expected_roles ){

        if ( !isset( $expected_roles["multiplier"] ) ){
            $expected_roles["multiplier"] = [

                "label" => __( 'Multiplier', 'prayer-global-porch' ),
                "description" => "Interacts with Contacts and Groups",
                "permissions" => []
            ];
        }

        // if the user can access contact they also can access this post type
        foreach ( $expected_roles as $role => $role_value ){
            if ( isset( $expected_roles[$role]["permissions"]['access_contacts'] ) && $expected_roles[$role]["permissions"]['access_contacts'] ){
                $expected_roles[$role]["permissions"]['access_' . $this->post_type ] = true;
                $expected_roles[$role]["permissions"]['create_' . $this->post_type] = true;
                $expected_roles[$role]["permissions"]['update_' . $this->post_type] = true;
            }
        }

        if ( isset( $expected_roles["administrator"] ) ){
            $expected_roles["administrator"]["permissions"]['dt_all_admin_'.$this->post_type ] = true;
            $expected_roles["administrator"]["permissions"]['wp_api_allowed_user'] = true;
        }
        if ( isset( $expected_roles["dt_admin"] ) ){
            $expected_roles["administrator"]["permissions"]['dt_all_admin_'.$this->post_type ] = true;
            $expected_roles["administrator"]["permissions"]['wp_api_allowed_user'] = true;
        }

        return $expected_roles;
    }

    /*public function allowed_wp_v2_paths( $paths ) {
        $paths[] = '/wp/v2/types/ctas?context=edit&_locale=user';
        $paths[] = '/wp/v2/types/ctas?context=view&_locale=user';
        $paths[] = '/wp/v2/types?context=view&_locale=user';
        $paths[] = '/wp/v2/types?context=edit&_locale=user';

        return $paths;
    }*/

    public function allowed_wp_v2_paths( $allowed_wp_v2_paths ) {
        if ( user_can( get_current_user_id(), 'wp_api_allowed_user' ) ) {

            $allowed_wp_v2_paths[] = '/wp/v2/'.$this->post_type;
            $allowed_wp_v2_paths[] = '/wp/v2/'.$this->post_type.'/(?P<id>[\d]+)';
            $allowed_wp_v2_paths[] = '/wp/v2/'.$this->post_type.'/(?P<parent>[\d]+)/revisions';
            $allowed_wp_v2_paths[] = '/wp/v2/'.$this->post_type.'/(?P<parent>[\d]+)/revisions/(?P<id>[\d]+)';
            $allowed_wp_v2_paths[] = '/wp/v2/'.$this->post_type.'/(?P<id>[\d]+)/autosaves';
            $allowed_wp_v2_paths[] = '/wp/v2/'.$this->post_type.'/(?P<parent>[\d]+)/autosaves/(?P<id>[\d]+)';

            $allowed_wp_v2_paths[] = '/wp/v2/types';
            $allowed_wp_v2_paths[] = '/wp/v2/types/(?P<type>[\w-]+)';

            $allowed_wp_v2_paths[] = '/wp/v2/blocks';
            $allowed_wp_v2_paths[] = '/wp/v2/blocks/(?P<id>[\d]+)';
            $allowed_wp_v2_paths[] = '/wp/v2/blocks/(?P<parent>[\d]+)/revisions';
            $allowed_wp_v2_paths[] = '/wp/v2/blocks/(?P<parent>[\d]+)/revisions/(?P<id>[\d]+)';
            $allowed_wp_v2_paths[] = '/wp/v2/blocks/(?P<id>[\d]+)/autosaves';
            $allowed_wp_v2_paths[] = '/wp/v2/blocks/(?P<parent>[\d]+)/autosaves/(?P<id>[\d]+)';
            $allowed_wp_v2_paths[] = '/wp/v2/block-directory/search';
            $allowed_wp_v2_paths[] = '/wp/v2/block-patterns';
            $allowed_wp_v2_paths[] = '/wp/v2/block-patterns/categories?_locale=user';
            $allowed_wp_v2_paths[] = '/wp/v2/block-patterns/patterns?_locale=user';


            $allowed_wp_v2_paths[] = '/wp/v2/media';
            $allowed_wp_v2_paths[] = '/wp/v2/media/(?P<id>[\d]+)';
            $allowed_wp_v2_paths[] = '/wp/v2/media/(?P<id>[\d]+)/post-process';
            $allowed_wp_v2_paths[] = '/wp/v2/media/(?P<id>[\d]+)/edit';

            $allowed_wp_v2_paths[] = '/wp/v2/taxonomies';
            $allowed_wp_v2_paths[] = '/wp/v2/taxonomies/(?P<taxonomy>[\w-]+)';
            $allowed_wp_v2_paths[] = '/wp/v2/category';
            $allowed_wp_v2_paths[] = '/wp/v2/category/(?P<id>[\\d]+)';

            $allowed_wp_v2_paths[] = '/wp/v2/themes';
            $allowed_wp_v2_paths[] = '/wp/v2/themes/(?P<stylesheet>[\w-]+)';

            $allowed_wp_v2_paths[] = '/wp/v2/templates';
            $allowed_wp_v2_paths[] = '/wp/v2/templates/(?P<id>[\/\w-]+)';
            $allowed_wp_v2_paths[] = '/wp/v2/templates/(?P<parent>[\d]+)/revisions';
            $allowed_wp_v2_paths[] = '/wp/v2/templates/(?P<parent>[\d]+)/revisions/(?P<id>[\d]+)';
            $allowed_wp_v2_paths[] = '/wp/v2/templates/(?P<id>[\d]+)/autosaves';
            $allowed_wp_v2_paths[] = '/wp/v2/templates/(?P<parent>[\d]+)/autosaves/(?P<id>[\d]+)';

            $allowed_wp_v2_paths[] = '/wp/v2/users/me';
            $allowed_wp_v2_paths[] = '/wp/v2/users/me?_locale=user';
            $allowed_wp_v2_paths[] = '/wp/v2/users';

        }
        return $allowed_wp_v2_paths;
    }
}
