<?php 
    define( 'BLOCK_LOAD', true );     
    $hostname = getenv('HTTP_HOST');
    if($hostname=="sigmalogic.eu")
    {
        require_once( $_SERVER['DOCUMENT_ROOT'] . '/europe4you/wp-config.php' );
        require_once( $_SERVER['DOCUMENT_ROOT'] . '/europe4you/wp-includes/wp-db.php' ); 
    }
    else{
        require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
        require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/wp-db.php' ); 
    }
    $wpdb = new wpdb( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
    $query = 'UPDATE  bandi_steps_update SET initial_step="'.$_POST['step_0'].'", step_1="'.$_POST['step_1'].'", step_2="'.$_POST['step_2'].'", step_3="'.$_POST['step_3'].'", step_4="'       .$_POST['step_4'].'" WHERE id="1"';    
    $result = mysql_query($query);

    if($result)
    {
        echo '<div class="msg_done">Steps updated!</div>';
    }
    else
    {
        echo '<div class="msg_done">StepsThere was an error, please try again.</div>';
    }
?> 