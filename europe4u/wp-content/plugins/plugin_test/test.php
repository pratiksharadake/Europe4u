<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<h2>Add bandi links</h2>   
<?php
    if(isset($_POST['add_link']) && $_POST['add_link'] == 'Add link')
    {  
        if((strlen($_POST['step0']) == 0) || (strlen($_POST['step1']) == 0) || (strlen($_POST['step2']) == 0) || (strlen($_POST['step3']) == 0) || (strlen($_POST['step4']) == 0))
        {
            $add_msg = '<div class="msg_err">Please select all options !</div>';
        }
        else
        {
            if(strlen($_POST['bandi_link']) < 4)
            {
                $add_msg = '<div class="msg_err">Please add a valid link !</div>';
            }
            else
            {
                $query = 'INSERT INTO bandi_links (step0, step1, step2, step3, step4,link)        
                    VALUES ("'.$_POST['step0'].'", "'.$_POST['step1'].'", "'.$_POST['step2'].'", "'.$_POST['step3'].'", "'.$_POST['step4'].'", "'.$_POST['bandi_link'].'") ';  
                $result = mysql_query($query);     
                 
                if(mysql_affected_rows())
                {
                    $add_msg = '<div class="msg_done">Link successfully added!</div>';
                } 
                else
                {
                    $add_msg =  '<div class="msg_err">Error on adding link!</div>';
                }   
            }
        }
    }    
    
    if(isset($_POST['delete_setting']) && $_POST['delete_setting'] == 'Delete')
    {  
        $query = 'DELETE FROM bandi_links WHERE id = "'.$_POST['link_id'].'" LIMIT 1';  
        $result = mysql_query($query);     
         
        if(mysql_affected_rows())
        {
            $delete_msg = '<div class="msg_done">Link setting successfully deleted!</div>';
        } 
        else
        {
            $delete_msg =  '<div class="msg_err">Error on deleting link setting!</div>';
        }
    }                  
?> 
<div style="width:1500px; overflow:auto;">  
    <div class="add_coupon" style="width:460px; float:left;">
        <?php echo $add_msg; ?>
        <form action="" method="post">
            <div class="coupon_name">
                Initial step
            </div>
            <div class="coupon_input">
                <select name="step0" id="step0">
                    <option value="">Please Select</option>
                    <option value="Pubblico">Pubblico</option>
                    <option value="Privato">Privato</option>
                    <option value="No Profit">No Profit</option>
                </select>
            </div>
            <div class="coupon_name">
                Step 1
            </div>
            <div class="coupon_input">
                <select name="step1" id="step1">
                    <option value="">Please Select</option>
                </select>
            </div>
            <div class="coupon_name">
                Step 2
            </div>
            <div class="coupon_input">
                <select name="step2" id="step2">
                    <option value="">Please Select</option>
                </select>
            </div>
            <div class="coupon_name">
                Step 3
            </div>
            <div class="coupon_input">
                <select name="step3" id="step3">
                    <option value="">Please Select</option>
                </select>
            </div>
            <div class="coupon_name">
                Step 4
            </div>
            <div class="coupon_input">
                <select name="step4" id="step4">
                    <option value="">Please Select</option>
                </select>
            </div>
            <div class="coupon_name">
                Bandi Link
            </div>
            <div class="coupon_input">
                <input type="text" name="bandi_link" id="bandi_link" value="" />
            </div>
            <div class="coupon_sent" style="float:right; margin-right:40px;">
                <input type="submit" disabled="disabled" class="c_input" name="add_link" value="Add link"/>
            </div>
        </form>
    </div>
<?php
    $query_display = 'SELECT * FROM bandi_links ORDER BY date_added DESC';
    $results = mysql_query($query_display);
    if(mysql_num_rows($results)>0)
    {
        while($row = mysql_fetch_assoc($results))
        {
            $cupon['id'] = $row['id'];
            $cupon['step0'] = $row['step0'];
            $cupon['step1'] = $row['step1'];
            $cupon['step2'] = $row['step2'];
            $cupon['step3'] = $row['step3'];
            $cupon['step4'] = $row['step4'];
            $cupon['link'] = $row['link'];
            $cupons[] = $cupon;
        }
    }
    else
    {
        $msg = '<div class="msg_info">You have 0 bandi links added!</div>';
    }
?>   
    <div class="tabel_coduri" style="width:840px; float:left; margin-left:100px;">
        <h2 style="font-weight:bold; padding-top:0px; margin-top:0px;">Bandi links list</h2>
        <div><?php echo $delete_msg; ?></div>
        <div><?php echo $msg; ?></div>
        <div style="overflow:auto;">
            <div class="nume_cod cod bold border-bottom">Initial step</div>
            <div class="cod_detalii bold border-bottom">Step 1</div>
            <div class="cod_detalii bold border-bottom" style="width:140px;">Step 2</div>
            <div class="cod_detalii bold border-bottom" style="width:120px;">Step 3</div>
            <div class="cod_detalii bold border-bottom" style="width:100px;">Step 4</div>
            <div class="cod_detalii bold border-bottom"  style="width:165px;">Link</div>
            <div class="cod_detalii bold border-bottom" style="width:80px; padding-left:5px;">Option</div>
        </div>
        <?php foreach($cupons as $key=>$val) 
        { 
        ?>
            <div style="overflow:auto; border-bottom: 1px solid #1a8893; background-color: #fff;">
                <div class="nume_cod cod"> <?php echo $val['step0'];?> </div>
                <div class="cod_detalii"> <?php echo $val['step1'];?> </div>
                <div class="cod_detalii" style="width:140px;"> <?php echo $val['step2'];?> </div>
                <div class="cod_detalii" style="width:120px;"> <?php echo $val['step3'];?> </div>   
                <div class="cod_detalii" style="width:100px;"> <?php echo $val['step4'];?> </div>    
                <div class="cod_detalii" style="width:165px;"> <?php echo $val['link'];?> </div>  
                <div class="cod_detalii" style="width:80px; padding-left:5px;"> 
                    <form action="" name="edit_form" method="post">
                        <input type="hidden" name="link_id" value="<?php echo $val['id'] ?>" />
                        <input type="submit" class="c_input" style="width:80px;" onclick="return confirm('Do you want to delete this bandi link?');" title="Click to delete this bandi link" name="delete_setting" value="Delete" />
                    </form>
                 </div>  
            </div>
    <?php } ?>
    </div>
</div>
<style type="text/css">
    .discount{margin-top: -2px; width: 43px; text-align:right;}
    .code_edit{color: #1A8893 !important; margin-top: -2px; width: 120px;}
    .margin-top2{margin-top:-2px;}
    .tabel_coduri{float: left; margin-left: 125px; margin-top: 28px;  width: 535px;}
    .border-bottom{border-bottom:1px solid #1a8893; }
    .nume_cod{width:80px;  float:left; padding-top:5px;  }
    .cod_detalii{width:135px; text-align:center; float:left; padding-top:5px; word-wrap:break-word;}
    .bold{font-weight:bold;}
        
    .add_coupon{width:250px; margin-left:15px;margin-top:30px; float:left; }
    .add_coupon select {width:250px;}
    .add_coupon input[type="text"] {width:250px;}
    .coupon_name{width:200px;float:left; margin-bottom:5px; height:25px; padding-top:5px; font-weight:bold; }
    .coupon_input{width:250px; float:left; margin-bottom:5px; height:30px; }
    .coupon_sent{ width:250px; float:left; text-align:right; }
    .c_input{background-color:#1C8C97; border: 0 none; color: #FFFFFF; cursor:pointer; font-size: 13px;font-weight:bold; height:27px; width:190px; padding-top:0px;}
    .change{background-color:#1C8C97;border: 0 none; color: #FFFFFF; cursor: pointer; font-weight: bold; height: 23px;margin-left: 9px; margin-top: -2px; padding-top: 0; width: 190px; }
    .msg_err{color:red; border:1px solid red; padding:5px; margin:5px; background-color: #fff; margin-left:0px;}
    .msg_done{color:#188691; border:1px solid #188691; padding:5px; margin:5px; background-color: #fff; margin-left:0px;}
    .msg_info {color:#145a7b; border:1px solid #145a7b; padding:5px; margin:5px; background-color: #fff; margin-left:0px;}
    .cod{color:#198792; font-weight:bold;}
</style>   

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#step0').change(function(){
           if(this.value == 'Pubblico')
           {
               jQuery('#step1').html('<option value="">Please Select</option><option value="P.A.">P.A.</option><option value="Comuni">Comuni</option><option value="Province">Province</option>');
           } 
           else if(this.value == 'Privato')
           {
               jQuery('#step1').html('<option value="">Please Select</option><option value="PMI">PMI</option><option value="Start Up">Start Up</option><option value="Consorzi">Consorzi</option><option value="Cooperativa">Cooperativa</option><option value="Cittadino">Cittadino</option>');
           }
           else if(this.value == 'No Profit')
           {
               jQuery('#step1').html('<option value="">Please Select</option><option value="Associazioni">Associazioni</option><option value="Fondazioni">Fondazioni</option><option value="Università">Università</option>');
           }
        });
        
        jQuery('#step1').change(function(){
           jQuery('#step2').html('<option value="">Please Select</option><option value="Ricerca innovazione imprese">Ricerca innovazione imprese</option><option value="Formazione istruzione">Formazione istruzione</option><option value="Agricoltura e sviluppo rurale">Agricoltura e sviluppo rurale</option><option value="Trasporti, telecomunicazioni, energia">Trasporti, telecomunicazioni, energia</option><option value="Ambiente, clima">Ambiente, clima</option><option value="Salute e crescita">Salute e crescita</option><option value="Sviluppo urbano e regionale">Sviluppo urbano e regionale</option><option value="Occupazione e inclusione sociale - aiuti umanitari">Occupazione e inclusione sociale - aiuti umanitari</option>'); 
        });
        
        jQuery('#step2').change(function(){
           jQuery('#step3').html('<option value="">Please Select</option><option value="Regione Lombardia">Regione Lombardia</option><option value="Regione Piemonte">Regione Piemonte</option><option value="Regione Liguria">Regione Liguria</option><option value="Other">Other</option>'); 
        });
        
        jQuery('#step3').change(function(){
           jQuery('#step4').html('<option value="">Please Select</option><option value="Bandi Regionali">Bandi Regionali</option><option value="Bandi Europei">Bandi Europei</option>'); 
        });
        
        jQuery('#step4').change(function(){
           jQuery('input[name="add_link"]').removeAttr('disabled'); 
        });
    });
</script>