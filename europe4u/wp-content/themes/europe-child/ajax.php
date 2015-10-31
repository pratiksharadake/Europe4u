<?php
    define( 'BLOCK_LOAD', true );     
    require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
    require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/wp-db.php' ); 
    $wpdb = new wpdb( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

    //user registration
    if(isset($_POST['submit_button']) && $_POST['submit_button'] == 'signup')
    {
        $_POST['username'] = $_POST['email'];
        //check if email is already registered
        $email_check = $wpdb->get_var( 'SELECT SQL_CACHE ID FROM wp_users WHERE user_email = "'.mysql_real_escape_string($_POST['email']).'" LIMIT 1;' );

        if(strlen($email_check) > 0)
        {
            $msg = '<div class="warning">This email address is already registered !</div>';
        }
        else
        {
            $username_check = $wpdb->get_var( 'SELECT SQL_CACHE ID FROM wp_users WHERE user_login = "'.mysql_real_escape_string($_POST['username']).'" LIMIT 1;' );
            if(strlen($username_check) > 0)
            {
                //check if username is already registered
                $msg = '<div class="warning">This username is already registered !</div>';
            }
            else
            {
                //make password secure
                $hash = wp_hash_password( mysql_real_escape_string($_POST['password']) );
                $display_name = $_POST['first_name']." ".$_POST['last_name'];
                $nickname = $_POST['first_name'].".".$_POST['last_name'];
                //insert wp user into db
                $insert_user = $wpdb->insert( 
                    'wp_users', 
                    array( 
                        'user_pass' => $hash,
                        'user_login' =>mysql_real_escape_string($_POST['email']), 
                        'display_name' => $display_name,
                        'user_nicename' => $display_name,
                        'user_email' =>mysql_real_escape_string($_POST['email']), 
                        'user_registered' => current_time('mysql', 1) 
                    ) 
                );

                //check if user was inserted
                if($insert_user)
                {
                    //get wp user id
                    $wp_userid = $wpdb->insert_id;
                    //insert user settings in wp_usermeta db table
                    $insert_user_settings = mysql_query('INSERT INTO `wp_usermeta` (`user_id`, `meta_key`, `meta_value`) 
                        VALUES  ("'.$wp_userid.'", "wp_capabilities", "'.mysql_real_escape_string(serialize(array('subscriber' => '1'))).'"), 
                        ("'.$wp_userid.'", "wp_user_level", "5"),( "'.$wp_userid.'", "first_name", "'.$_POST['first_name'].'" ),( "'.$wp_userid.'", "last_name", "'.$_POST['last_name'].'" );
                    ');

                    if(mysql_affected_rows())
                    {
                        //send email to new subscriber user
                        $headers = "From: info@europe4you.it\r\n";
                        $headers .= "Reply-To: info@europe4you.it\r\n";
                        $headers .= "MIME-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                        $to = mysql_real_escape_string($_POST['email']);
                        $subject = 'New Account on Europe4you';
                        $message = '<html><head></head><body>Hello '.mysql_real_escape_string($_POST['name1']).', <br />Use this <a href="http://www.europe4you.it/">link</a> to login to your account.
                        <br /> Your login credentials are : <br />
                        Email address : '.mysql_real_escape_string($_POST['email']).'<br />
                        Password : '.mysql_real_escape_string($_POST['password']).'
                        </body>
                        </html>
                        ';
                        mail($to, $subject,$message, $headers);

                        $msg = '<div class="done">Account created successfully. Please check your email address for login credentials.</div>';
                    }
                    else
                    {
                        $msg = '<div class="error">Something went wrong while creating your account settings.</div>';
                    }
                }
                else
                {
                    $msg = '<div class="error">Something went wrong while creating your account.</div>';
                }
            }
        } 
        echo $msg;
    }
    // end user registration part
    
    //set step1 for bandi form
    if(isset($_POST['data2']) && $_POST['data2'] == 'set_bandi_form')
    {
        session_start();
        $_SESSION['bandi_step'] = $_POST['data1'];
        echo '0';
    }
    
    if(isset($_POST['data1']) && $_POST['data1'] == 'get_bandi_link')
    {
        if(strlen($_POST['step0']) > 0){
            $where = ' step0 = "'.$_POST['step0'].'" AND ';
        }
        else {
            $where = '';
        }
        
        $query = 'SELECT SQL_CACHE link FROM bandi_links WHERE 
            '.$where.'
            step1 = "'.$_POST['step1'].'" AND
            step2 = "'.$_POST['step2'].'" AND
            step3 = "'.$_POST['step3'].'" AND
            step4 = "'.$_POST['step4'].'" ORDER BY date_added DESC LIMIT 1';
         
        $result = mysql_query($query);
        $row = mysql_fetch_assoc($result);
        
        echo $row['link'];
    }
?>
