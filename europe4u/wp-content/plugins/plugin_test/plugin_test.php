<?php
/*
Plugin Name: Bandi Form Links
Plugin URI: http://www.xxx.com/
Description: Description of my plugin
Author URI: http://www.xxx.com/
*/

class Maheshchari
{

    function Maheshchari()
    {
        add_action('admin_menu', array(&$this, 'my_admin_menu'));
    }
	
    function my_admin_menu()
    {	//create a main admin panel
		//create a sub admin panel link above
        add_menu_page('Bandi Form Links', 'Bandi Form Links', 'administrator', 8, array(&$this,'overview'));
		//These functions adds sub menu for different kinds of admin panel on back end
        add_options_page('Mahesh Options', 'Mahesh  Plugin', 'administrator', basename(__file__),array(&$this, 'my_plugin_options'));
        add_posts_page('Mahesh posts', 'Mahesh  Plugin', 'administrator', basename(__file__),array(&$this, 'my_plugin_posts'));
        add_media_page('Mahesh media', 'Mahesh  Plugin', 'administrator', basename(__file__),array(&$this, 'my_plugin_media'));
        add_pages_page('Mahesh pages', 'Mahesh  Plugin', 'administrator', basename(__file__),array(&$this, 'my_plugin_pages'));
        add_users_page('Mahesh users', 'Mahesh  Plugin', 'administrator', basename(__file__),array(&$this, 'my_plugin_users'));
        add_management_page('maheshchari', 'Mahesh  Plugin', 'administrator', basename(__file__),array(&$this, 'my_plugin_tools'));
        add_theme_page('maheshchari', 'Mahesh  Plugin', 'administrator', basename(__file__),array(&$this, 'my_plugin_themes'));

    }


    function overview()
    {    
        include "test.php";
       
    }

    function settings()
    {
        echo '<h2>Pagina 1</h2>';
		echo "Poti baga aici cu include ceva daca vrei";
		include "test2.php";
    }

    function generel()
    {
        echo '<h2>Pagina 2</h2>';
    }
    function my_plugin_options()
    {
        echo '<h2>My Wordpress Plugin Options</h2>';

    }
    function my_plugin_posts()
    {
        echo '<h2>My Wordpress Plugin posts</h2>';
    }
    function my_plugin_media()
    {
        echo '<h2>My Wordpress Plugin media</h2>';
    }
    function my_plugin_pages()
    {
        echo '<h2>My Wordpress Plugin pages</h2>';
    }
    function my_plugin_users()
    {
        echo '<h2>My Wordpress Plugin users</h2>';
    }

    function my_plugin_tools()
    {
        echo '<h2>My Wordpress Plugin tools</h2>';
    }

    function my_plugin_themes()
    {
        echo '<h2>My Wordpress Plugin themes</h2>';
    }


}


$mybackuper = &new Maheshchari();//instance of the plugin class

?>