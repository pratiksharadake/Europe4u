<?php
/**
 * Login Form
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="col2-set clearfix" id="customer_login">

    <div class="col-1">

<?php endif; ?>

        <h2><?php _e( 'Login', 'woocommerce' ); ?></h2>

        <form method="post" class="login">

            <?php do_action( 'woocommerce_login_form_start' ); ?>

            <p class="form-row form-row-wide">
                <input type="text" class="input-text placeholder" placeholder="<?php _e('Username or email', 'woocommerce'); ?>" name="username" id="username" />
            </p>
            <p class="form-row form-row-wide">
                <input class="input-text placeholder" placeholder="<?php _e('Password', 'woocommerce'); ?>" type="password" name="password" id="password" />
            </p>
            
            <?php do_action( 'woocommerce_login_form' ); ?>

            <p class="form-row">
                <?php wp_nonce_field( 'woocommerce-login' ); ?>

                <input type="submit" class="button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" /> 
                <a class="lost_password woo-lost_password2" href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost Password?', 'woocommerce' ); ?></a>
                <label for="rememberme" class="inline woo-my-account-rememberme">
                    <input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
                </label>
            </p>

            <?php do_action( 'woocommerce_login_form_end' ); ?>
        </form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

    </div>

    <div class="col-2">

        <h2><?php _e( 'Register', 'woocommerce' ); ?></h2>

        <form method="post" class="register">

            <?php if ( get_option( 'woocommerce_registration_generate_username' ) === 'no' ) : ?>

                <p class="form-row form-row-wide">
                    <input type="text" class="input-text placeholder" placeholder="<?php _e('Username', 'woocommerce'); ?>" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) esc_attr_e( $_POST['username'] ); ?>" />
                </p>

                <?php endif; ?>

                <p class="form-row form-row-wide">
                    <input type="email" class="input-text placeholder" placeholder="<?php _e('Email', 'woocommerce'); ?>" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) esc_attr_e( $_POST['email'] ); ?>" />
                </p>

                <p class="form-row form-row-wide">
                    <input type="password" class="input-text placeholder" placeholder="<?php _e('Password', 'woocommerce'); ?>" name="password" id="reg_password" value="<?php if ( ! empty( $_POST['password'] ) ) esc_attr_e( $_POST['password'] ); ?>" />
                </p>

                <!-- Spam Trap -->
                <div style="left:-999em; position:absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

                <?php do_action( 'woocommerce_register_form' ); ?>
                <?php do_action( 'register_form' ); ?>

                <p class="form-row">
                    <?php wp_nonce_field( 'woocommerce-register', 'register' ); ?>
                    <input type="submit" class="button" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
                </p>

            <?php do_action( 'woocommerce_register_form_end' ); ?>

        </form>

    </div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>