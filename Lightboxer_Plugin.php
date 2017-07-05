<?php


include_once('Lightboxer_LifeCycle.php');

class Lightboxer_Plugin extends Lightboxer_LifeCycle {

    /**
     * See: http://plugin.michael-simpson.com/?page_id=31
     * @return array of option meta data.
     */
    public function getOptionMetaData() {
        //  http://plugin.michael-simpson.com/?page_id=31
        return array(
            '_version' => array('Installed Version'), // Leave this one commented-out. Uncomment to test upgrades.
            'ATextInput' => array(__('Enter in some text', 'lightboxer')),
            'AmAwesome' => array(__('I like this awesome plugin', 'lightboxer'), 'false', 'true'),
            'CanDoSomething' => array(__('Which user role can do something', 'lightboxer'),
                                        'Administrator', 'Editor', 'Author', 'Contributor', 'Subscriber', 'Anyone')
        );
    }

//    protected function getOptionValueI18nString($optionValue) {
//        $i18nValue = parent::getOptionValueI18nString($optionValue);
//        return $i18nValue;
//    }

    protected function initOptions() {
        $options = $this->getOptionMetaData();
        if (!empty($options)) {
            foreach ($options as $key => $arr) {
                if (is_array($arr) && count($arr > 1)) {
                    $this->addOption($key, $arr[1]);
                }
            }
        }
    }

    public function getPluginDisplayName() {
        return 'LightBoxer';
    }

    protected function getMainPluginFileName() {
        return 'lightboxer.php';
    }

    /**
     * See: http://plugin.michael-simpson.com/?page_id=101
     * Called by install() to create any database tables if needed.
     * Best Practice:
     * (1) Prefix all table names with $wpdb->prefix
     * (2) make table names lower case only
     * @return void
     */
    protected function installDatabaseTables() {
        //        global $wpdb;
        //        $tableName = $this->prefixTableName('mytable');
        //        $wpdb->query("CREATE TABLE IF NOT EXISTS `$tableName` (
        //            `id` INTEGER NOT NULL");
    }

    /**
     * See: http://plugin.michael-simpson.com/?page_id=101
     * Drop plugin-created tables on uninstall.
     * @return void
     */
    protected function unInstallDatabaseTables() {
        //        global $wpdb;
        //        $tableName = $this->prefixTableName('mytable');
        //        $wpdb->query("DROP TABLE IF EXISTS `$tableName`");
    }


    /**
     * Perform actions when upgrading from version X to version Y
     * See: http://plugin.michael-simpson.com/?page_id=35
     * @return void
     */
    public function upgrade() {
    }

    public function addActionsAndFilters() {

        // Add options administration page
        // http://plugin.michael-simpson.com/?page_id=47
        add_action('admin_menu', array(&$this, 'addSettingsSubMenuPage'));
		
		//create a custom post type __CB
		add_action('init', array(&$this, 'create_lightboxer_post_type' ));
		
		

        // Example adding a script & style just for the options administration page
        // http://plugin.michael-simpson.com/?page_id=47
        //        if (strpos($_SERVER['REQUEST_URI'], $this->getSettingsSlug()) !== false) {
        //            wp_enqueue_script('my-script', plugins_url('/js/my-script.js', __FILE__));
        //            wp_enqueue_style('my-style', plugins_url('/css/my-style.css', __FILE__));
        //        }


        // Add Actions & Filters
        // http://plugin.michael-simpson.com/?page_id=37


        // Adding scripts & styles to all pages
        // Examples:
        //        wp_enqueue_script('jquery');
        //        wp_enqueue_style('my-style', plugins_url('/css/my-style.css', __FILE__));
        //        wp_enqueue_script('my-script', plugins_url('/js/my-script.js', __FILE__));
		add_action( 'wp_enqueue_scripts', array(&$this, 'lightboxer_main_script'), 11 );
		add_action( 'wp_enqueue_scripts', array(&$this, 'lightboxer_main_script'), 11 );
		
        // Register short codes
        // http://plugin.michael-simpson.com/?page_id=39


        // Register AJAX hooks
        // http://plugin.michael-simpson.com/?page_id=41

    }
	public function lightboxer_main_script (){
		global $post_type;
		
		if( 'lightboxer_post' == $post_type){
				
			wp_register_script('bigpicture', plugins_url('/js/BigPicture.js', __FILE__), array('jquery'), true );
			wp_register_script('lightboxer', plugins_url('/js/LightBoxer.js', __FILE__), array('jquery'), true );
			wp_enqueue_script('bigpicture');
			wp_enqueue_script('lightboxer');
			wp_enqueue_style('lb-style', plugins_url('/css/lb-style.css', __FILE__));
		}
		
		
	}
	public function create_lightboxer_post_type (){
		register_post_type(
			'lightboxer_post',
			array(
				'labels' => array(
					'name' => __('LightBoxers'),
					'singular_name' => __('LightBoxer')
				),
				'supports' => array('title', 'excerpt', 'comments'),
				'public' => true,
				'has_archive' => true,
			)		
		);
	}


}
