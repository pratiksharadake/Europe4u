<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.carouFredSel-6.2.1.js" type="text/javascript"></script>
</head>

<body <?php body_class(); ?>>
<?php global $current_user;?>
<div id="page" class="hfeed site">

    <div class="user-action">
        <div class="top-section">
            <div class="i-button"></div>
            <div class="info-section">Please Login or Register to access this section.</div>
            <div class="x-button"></div>
        </div>

        <div class="user-msg" id="message-box" style="padding-top:0px;">
            <?php echo @$msg; ?>
        </div>
      
        <div class="action-section" style="margin-left:45px;">  
            <div class="title-section">Login</div>
            <form id="login-form" action="" method="POST">
                <input type="text" style="margin-top:30px;" autocomplete="off" placeholder="Email address" name="email_address" id="email_address" value="" />
                
                <input type="password" autocomplete="off" placeholder="Password" name="pass" id="pass" value="" />
                  </br> </br><a href="<?php echo get_permalink(939);?>" >Forgot Password</a>
                <div class="button-container">
                    <input class="user-actions-btn" type="submit" name="login" id="login" value="Submit">
                </div>
            </form>   
        </div>
        
        <div class="section-separator"></div>
        
        <div class="action-section">
            <div class="title-section">Register</div>
            <form id="register-form" action="" method="POST">
                <div class="two-inputs">
                    <input class="small-inputs" type="text" placeholder="First Name" name="first_name" id="name1" value="" />
                    
                    <input class="small-inputs" style="margin-left:15px;" type="text" placeholder="Last Name" name="last_name" id="surname" value="" />
                </div>
                
                <input type="text" autocomplete="off" placeholder="Email address" name="email" id="email" value="" />
                
                <input type="password" autocomplete="off" placeholder="Password" name="password" id="password" value="" />
                
                <div class="button-container">
                    <input type="hidden" name="submit_button" value="signup" />
                    <input class="user-actions-btn" type="button" name="submit" id="submit" value="Sign up">
                </div>
            </form>
        </div>

        <div class="bottom-section">
            <div class="action-section" style="margin-left:45px;">   
                <strong>Attività Istituzionale:</strong>
                <ul>
                    <li>Servizi per associati</li>
                    <li>Corsi di formazione</li>
                    <li>Iscrizione alla Newsletter</li>
                </ul>
            </div>
            <div class="section-separator"></div>
            <div class="action-section">
                </br></br>
                <div class="paypal_info">
                    <div class="paypalcaps">VUOI DIVENTARE SOCIO?</br>Chiedici come</div>
                    <!-- </br><div class="lower"></div> -->
                </div>
           </div>
        </div>
    </div>

    <header id="masthead" class="site-header" role="banner">
        <div class="header-container">
            <hgroup>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            </hgroup>

            <div class="right-navigation" style="">
                  <?php 
                if ( is_user_logged_in() ) 
                {
                    $first_name = $current_user->first_name;
                    ?>
                    </br></br>
                    <div class="top-links">
                        <div class="top-link-container" style="border-right:2px solid #bfbfbf;">
                            <a class="">Welcome</a>
                        </div>
                        <?php if($first_name){?>
                        <div class="top-link-container" style="border-right:2px solid #bfbfbf;">
                            <img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/top_links_03.png" />
                            <a style="text-transform:capitalize;"><?php echo $first_name;?></a>
                        </div>
                        <?php }?>
                        <div class="top-link-container">
                            <img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/top_links_05.png" />
                            <a class="" href="<?php echo wp_logout_url();?>">SIGN OUT</a>
                        </div>
                    </div>
                    <?php 
                }
                else
                { 
                    ?>
                    <div class="top-links">
                        <div class="top-link-container" style="border-right:2px solid #bfbfbf;">
                            <a class="display-user-action">SOCIO</a>
                        </div>
                        <div class="top-link-container" style="border-right:2px solid #bfbfbf;">
                            <img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/top_links_03.png" />
                            <a class="display-user-action">LOG IN</a>
                        </div>
                        <div class="top-link-container">
                            <img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/top_links_05.png" />
                            <a class="display-user-action">REGISTER</a>
                        </div>
                    </div>
                    <?php 
                } 
                ?>
            
                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
                    <a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
                    <ul id="menu-top-menu" class="nav-menu">
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-152" id="menu-item-152"><a href="<?php echo get_site_url();?>/#sectione2">Go Back</a></li>
                    </ul>
                </nav><!-- #site-navigation -->
                
                <div class="menu-social-icons">
                    <div class="twitter-icon" onclick="location.href='<?php echo get_option('twitter_link'); ?>'"></div>
                    <div class="linkedin-icon" onclick="location.href='<?php echo get_option('linkedin_link'); ?>'"></div>
                    <div class="facebook-icon" onclick="location.href='<?php echo get_option('facebook_link'); ?>'"></div>
                </div>
            </div>
            
            <?php if ( get_header_image() ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
            <?php endif; ?>
        </div>
    </header><!-- #masthead -->
    
    <div id="main" <?php if ( is_admin_bar_showing() ) { ?> style="margin-top:136px;" <?php } ?> class="wrapper">