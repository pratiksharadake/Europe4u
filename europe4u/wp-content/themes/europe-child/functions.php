<?php
update_option('siteurl','http://www.europe4you.it');
update_option('home','http://www.europe4you.it');

add_action('admin_menu', 'baw_create_menu');  
function baw_create_menu() {      
    add_menu_page('Social Networks Options', 'Social Networks Options', 'administrator', __FILE__, 'baw_settings_page');        
    add_action( 'admin_init', 'register_mysettings' );
}
function register_mysettings() {     
    register_setting( 'baw-settings-group', 'twitter_link' );
    register_setting( 'baw-settings-group', 'facebook_link' );         
    register_setting( 'baw-settings-group', 'linkedin_link' );         
}                                                                                                                                   
function baw_settings_page() 
{
    ?>
    <div class="wrap">           
        <form method="post" action="options.php">
            <?php settings_fields( 'baw-settings-group' ); ?>
            <?php //do_settings( 'baw-settings-group' ); ?>   
            <h2>Social Networks Settings</h2>               
            <table class="form-table">        
                  <tr valign="top">
                <th scope="row">Twitter link</th>
                <td>
                    <input type="text" id="color1" value="<?php echo get_option('twitter_link'); ?>" name="twitter_link" />   
                </tr>  
                <tr valign="top">
                <th scope="row">Facebook link:</th>
                <td>
                    <input type="text" id="color2" value="<?php echo get_option('facebook_link'); ?>" name="facebook_link" />     
                </td>
                </tr>  
                <tr valign="top">
                <th scope="row">Linkedin link:</th>
                <td>
                    <input type="text" id="color3" value="<?php echo get_option('linkedin_link'); ?>" name="linkedin_link" />     
                </td>
                </tr>
                <td>   
              </td>        
              </table>       
            <?php submit_button(); ?>    
        </form>
    </div>
    <?php 
} 

/**
 * Bandi Section
 */
function bandinew_add_meta_box() {
    add_meta_box(
        'bandisection',
        __( 'Step 2 & Settore Attività', 'bandi' ),
        'bandinew_meta_box_callback',
        'bandi',
        'advanced',
        'high'
    );
}
add_action( 'add_meta_boxes', 'bandinew_add_meta_box',1 );

function bandinew_meta_box_callback( $post ) 
{
    global $post;
    wp_nonce_field( 'bandinew_save_meta_box_data', 'bandinew_meta_box_nonce' );

    $bandi_child_cat = get_post_meta( $post->ID, 'bandi_child_cat',true);
    $sector_project = get_post_meta( $post->ID, 'sector_project',true);
    
    $bandi_terms = get_terms('bandi-category', array('hide_empty' => false));
    $bandi_sector_project = get_terms('sector-project', array('hide_empty' => false));
    //echo '<pre>';print_r($bandi_terms);
    ?>
        <div class="bandi_container">
            <div class="bandi_label">Step 2 <span class="required" style="color:#cc0000;">*</span></div>
            <div class="bandi_inputcontainer">
                <select name="bandi_child_cat" required>
                    <option value="">Please Select</option>
                    <?php
                    
                    foreach($bandi_terms as $bandi_cat){
                         $bandi_cat->parent;
                        //if($bandi_cat->parent != 0){
                            if($bandi_child_cat==$bandi_cat->term_id){$selected="selected";}else{$selected="";}
                            echo '<option value="'.$bandi_cat->term_id.'" '.$selected.'>'.$bandi_cat->name.'</option>';
                        //}
                    }
                    ?>
                </select>
                <!-- </br>Step 2 -->
            </div>
        </div>
        <div class="bandi_container">
            <div class="bandi_label">Settore Attività <span class="required" style="color:#cc0000;">*</span></div>
            <div class="bandi_inputcontainer">
                <select name="sector_project" required>
                    <option value="">Please Select</option>
                    <?php
                    
                    foreach($bandi_sector_project as $term){
                        if($sector_project==$term->term_id){$selected="selected";}else{$selected="";}
                        echo '<option value="'.$term->term_id.'" '.$selected.'>'.$term->name.'</option>';
                    }
                    ?>
                </select>
                <!-- </br>Settore Attività -->
            </div>
        </div>      
        <style>
        .bandi_container {margin: 15px 10px;overflow: hidden;width: 95%;}
        .bandi_label{float: left;width: 30%;font-weight: bold;}
        .bandi_inputcontainer{width: 65%;float: right;}
        </style>
    <?php
}

function bandinew_save_meta_box_data( $post )
{
    global $post;
    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['bandinew_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['bandinew_meta_box_nonce'], 'bandinew_save_meta_box_data' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    $bandi_child_cat = sanitize_text_field( $_POST['bandi_child_cat'] );
    update_post_meta( $post->ID, 'bandi_child_cat', $bandi_child_cat );
    
    $sector_project = sanitize_text_field( $_POST['sector_project'] );
    update_post_meta( $post->ID, 'sector_project', $sector_project );        
}
add_action( 'save_post', 'bandinew_save_meta_box_data' );

function app_output_buffer() {
     ob_start();
} 
add_action('init', 'app_output_buffer');

/********************* User role creation starts ********************************************/
//add_role( 'associate-pmi', 'PMI E over 35', array( 'read' => true, 'edit_posts' => false,'delete_posts' => false ) );
//add_role( 'associate-noprofit', 'ASSOCIAZIONI E NO PROFIT', array( 'read' => true, 'edit_posts' => false,'delete_posts' => false ) );
//add_role( 'associate-under35', 'GIOVANI UNDER 35', array( 'read' => true, 'edit_posts' => false,'delete_posts' => false ) );
/********************* User role creation ends ********************************************/


/* 
 * Function Name: go_home
 * Description: Logout redirect to home
 * Author: Pratiksha
 */
function go_home(){
  wp_redirect( home_url() );
  exit();
}
add_action('wp_logout','go_home');

/**
 * Function Name: europe4u_extra_user_profile_fields
 * Description: Add custom user fields for User profile
 * Author: Pratiksha
 */
function europe4u_extra_user_profile_fields( $user ) 
{ 
    if($user->roles[0]!="subscriber")
    {
         ?>
        <h3>User Extra Fields:</h3>
        <table class="form-table">
            <tr>
                <th><label>Data di nascita</label></th>
                <td><input type="text" id="date" name="birth_date" value="<?php echo esc_attr( get_the_author_meta( 'birth_date', $user->ID ) ); ?>"/></td>
                
            </tr>
            <?php if($user->roles[0] == "associate-under35"){?>
            <tr>
                <th><label><?php _e("Luogo di nascita "); ?></label></th>
                <td><input type="text" name="birth_place" value="<?php echo esc_attr( get_the_author_meta( 'birth_place', $user->ID ) ); ?>" /></td>
            </tr>
            <?php } if($user->roles[0] != "associate-noprofit"){?>
            <tr>
                <th><label><?php _e("C.I. / P. IVA"); ?></label></th>
                <td><input type="text" name="piva" value="<?php echo esc_attr( get_the_author_meta( 'piva', $user->ID ) ); ?>" /></td>
            </tr>
            <?php }?>
            <tr>
                <th><label><?php _e("Codice fiscale"); ?></label></th>
                <td><input type="text" name="tax_code" value="<?php echo esc_attr( get_the_author_meta( 'tax_code', $user->ID ) ); ?>" /></td>
            </tr>
            <?php if($user->roles[0] != "associate-under35"){?>
            <tr>
                <th><label><?php _e("Sede legale"); ?></label></th>
                <td><input type="text" name="reg_ofc" value="<?php echo esc_attr( get_the_author_meta( 'reg_ofc', $user->ID ) ); ?>" /></td>
            </tr>
            <?php }?>
            <tr>
                <th><label><?php _e("Numero di telefono"); ?></label></th>
                <td><input type="text" name="phone_no" value="<?php echo esc_attr( get_the_author_meta( 'phone_no', $user->ID ) ); ?>" /></td>
            </tr>
            <tr>
                <th><label><?php _e("Indirizzo"); ?></label></th>
                <td><input type="text" name="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" /></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="text" name="state" value="<?php echo esc_attr( get_the_author_meta( 'state', $user->ID ) ); ?>"/></br>&nbsp;&nbsp;Nazione</td>
                <td><input type="text" name="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>"/></br>&nbsp;&nbsp;Provincia</td>
                <td><input type="text" name="zip" value="<?php echo esc_attr( get_the_author_meta( 'zip', $user->ID ) ); ?>"/></br>&nbsp;&nbsp;Cap.</td>
            </tr>
        </table>
       <!--  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
        <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#date').datepicker({
                dateFormat : 'dd/mm/yy',
                changeMonth : true,
                changeYear : true,
                yearRange: '-100y:c+nn',
                maxDate: '-1d'
            });
        });
        </script>
        <?php
    }
}
add_action( 'show_user_profile', 'europe4u_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'europe4u_extra_user_profile_fields' );

/* 
 * Function Name: europe4u_save_extra_user_profile_fields
 * Description: Registers extra user fields required
 * Author: Pratiksha
 */
function europe4u_save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
        update_user_meta($user_id,'birth_date',$_POST['birth_date']);
        update_user_meta($user_id,'birth_place',$_POST['birth_place']);
        update_user_meta($user_id,'tax_code',$_POST['tax_code']);
        update_user_meta($user_id,'phone_no',$_POST['phone_no']);
        update_user_meta($user_id,'address',$_POST['address']);
        update_user_meta($user_id,'state',$_POST['state']);
        update_user_meta($user_id,'city',$_POST['city']);
        update_user_meta($user_id,'zip',$_POST['zip']);
        update_user_meta($user_id,'reg_ofc',$_POST['reg_ofc']);  
        update_user_meta($user_id,'piva',$_POST['piva']);       
}
add_action( 'personal_options_update', 'europe4u_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'europe4u_save_extra_user_profile_fields' );


