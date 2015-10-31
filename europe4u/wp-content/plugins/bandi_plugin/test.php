<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<h2>Add bandi summary</h2>   
<?php  $plugins_url = plugins_url();
    if(isset($_POST['add_summary']) && $_POST['add_summary'] == 'Add summary')
    {  
        if((strlen($_POST['step0']) == 0) || (strlen($_POST['step1']) == 0) || (strlen($_POST['step2']) == 0) || (strlen($_POST['step3']) == 0) || (strlen($_POST['step4']) == 0))
        {
            $add_msg = '<div class="msg_err">Please select all options !</div>';
        }
        else
        {
            $i = 0;
            foreach($_POST['oggetto_link'] as $key => $val)
            {
                if(strlen($_POST['oggetto_link'][$i]) < 4)
                {
                    $add_msg = '<div class="msg_err">Please add a valid oggetto link !</div>';
                }
                else
                {
                    $query = 'INSERT INTO bandi_summary (step0, step1, step2, step3, step4,oggetto,programma,scadenza,link)        
                    VALUES ("'.$_POST['step0'].'", "'.$_POST['step1'].'", "'.$_POST['step2'].'", "'.$_POST['step3'].'", "'.$_POST['step4'].'", 
                    "'.$_POST['oggetto'][$i].'", "'.$_POST['programma'][$i].'", "'.$_POST['scadenza'][$i].'", "'.$_POST['oggetto_link'][$i].'") ';  
                    $result = mysql_query($query);     
                }

                $i++;
            }
        }
    }   

    if(isset($_POST['delete_summary']) && $_POST['delete_summary'] == 'Delete')
    {  
        $query = 'DELETE FROM bandi_summary WHERE id = "'.$_POST['link_id'].'" LIMIT 1';  
        $result = mysql_query($query);     

        if(mysql_affected_rows())
        {
            $delete_msg = '<div class="msg_done">Summary setting successfully deleted!</div>';
        } 
        else
        {
            $delete_msg =  '<div class="msg_err">Error on deleting summary setting!</div>';
        }
    } 

    if(isset($_POST['save_link']) && $_POST['save_link'] == 'Save link')
    {  
        $query1 = 'SELECT link FROM bandi_summary WHERE id = "'.$_POST['link_id'].'" LIMIT 1 ';
        $res = mysql_query($query1);  
        $query = 'UPDATE bandi_summary SET link="'.$_POST['updatedlink'].'" WHERE id = "'.$_POST['link_id'].'" LIMIT 1';
        $result = mysql_query($query);     

        if(mysql_affected_rows())
        {
            $delete_msg = '<div class="msg_done">Link successfully changed!</div>';
        } 
        else
        {
            if(mysql_num_rows($res)>0)
            {
                $row1 = mysql_fetch_assoc($res);
                if($row1['link'] == $_POST['updatedlink']){
                    $delete_msg =  '<div class="msg_done">Link successfully changed!</div>';
                }
                else{
                    $delete_msg =  '<div class="msg_err">Error on changing link!</div>';
                }
            }   
        }
    } 
    $query_steps = 'SELECT * FROM bandi_steps_update WHERE id="1"'; 
    $result_steps = mysql_query($query_steps);
    if(mysql_num_rows($result_steps)>0)
    {
        $row1 = mysql_fetch_assoc($result_steps);
        $initial_step=$row1['initial_step'];
        $step_1=$row1['step_1'];
        $step_2=$row1['step_2'];
        $step_3=$row1['step_3'];
        $step_4=$row1['step_4'];
      //  var_dump($initial_step); var_dump($step_1); var_dump($step_2); var_dump($step_3);var_dump($step_4);
       
    }    
    $query_steps_info = 'SELECT * FROM `bandi_summary` ORDER BY `bandi_summary`.`date_added` DESC LIMIT 1'; 
    $result_steps_info = mysql_query($query_steps_info);
    if(mysql_num_rows($result_steps_info)>0)
    {
        $row1 = mysql_fetch_assoc($result_steps_info);
        $oggetto=$row1['oggetto'];
        $programma=$row1['programma'];
        $scadenza=$row1['scadenza'];
        $link=$row1['link'];
        //var_dump($oggetto); var_dump($programma); var_dump($scadenza); var_dump($link);
       
    }    

?> 
<div style="width:100%; overflow:auto;">  
    <div class="add_coupon" style="width:460px; float:left;position: relative;">
        <?php echo $add_msg; ?>
        <div class="message_container"></div>
        <form action="" method="post">
            <div class="coupon_name">
                Initial step
            </div>
            <div class="coupon_input">
                <select name="step0" id="step0">
                    <option value="Please Select" <?php if($initial_step=="Please Select"){ echo 'selected=selected'; } ?> >Please Select</option>
                    <option value="Pubblico" <?php if($initial_step=="Pubblico"){ echo 'selected=selected'; } ?> >Pubblico</option>
                    <option value="Privato" <?php if($initial_step=="Privato"){ echo 'selected=selected'; } ?> >Privato</option>
                    <option value="NoProfit" <?php if($initial_step=="NoProfit"){ echo 'selected=selected'; } ?> >No Profit</option>
                </select>
            </div>
            <div class="coupon_name">
                Step 1
            </div>
            <div class="coupon_input">
                <select name="step1" id="step1">
                    <option value="Please Select" <?php if($step_1=="Please Select"){ echo 'selected=selected'; } ?> >Please Select</option>
                    <option class="for_step_Pubblico firststep" value="P.A." <?php if($step_1=="P.A."){ echo 'selected=selected'; } ?>  >P.A.</option>
                    <option class="for_step_Pubblico firststep" value="Comuni" <?php if($step_1=="Comuni"){ echo 'selected=selected'; } ?>  >Comuni</option>
                    <option class="for_step_Pubblico firststep" value="Province" <?php if($step_1=="Province"){ echo 'selected=selected'; } ?>  >Province</option>
                    <option class="for_step_Privato firststep" value="PMI" <?php if($step_1=="PMI"){ echo 'selected=selected'; } ?>  >PMI</option>
                    <option class="for_step_Privato firststep" value="Start Up" <?php if($step_1=="Start Up"){ echo 'selected=selected'; } ?>  >Start Up</option>
                    <option class="for_step_Privato firststep" value="Consorzi" <?php if($step_1=="Consorzi"){ echo 'selected=selected'; } ?>  >Consorzi</option>
                    <option class="for_step_Privato firststep" value="Cooperativa" <?php if($step_1=="Cooperativa"){ echo 'selected=selected'; } ?>  >Cooperativa</option>
                    <option class="for_step_Privato firststep" value="Cittadino" <?php if($step_1=="Cittadino"){ echo 'selected=selected'; } ?>  >Cittadino</option>
                    <option class="for_step_NoProfit firststep" value="Associazioni" <?php if($step_1=="Associazioni"){ echo 'selected=selected'; } ?>  >Associazioni</option>
                    <option class="for_step_NoProfit firststep" value="Fondazioni" <?php if($step_1=="Fondazioni"){ echo 'selected=selected'; } ?>  >Fondazioni</option>
                    <option class="for_step_NoProfit firststep" value="Universite" <?php if($step_1=="Universite"){ echo 'selected=selected'; } ?>  >Università</option>
                 </select>
            </div>
            <div class="coupon_name">
                Step 2
            </div>
            <div class="coupon_input">
                <select name="step2" id="step2">
                    <option value="Please Select" <?php if($step_2=="Please Select"){ echo 'selected=selected'; } ?> >Please Select</option>
                    <option class="step_2_option" value="Ricerca innovazione imprese" <?php if($step_2=="Ricerca innovazione imprese"){ echo 'selected=selected'; } ?>  >Ricerca innovazione imprese</option>
                    <option class="step_2_option" value="Formazione istruzione" <?php if($step_2=="Formazione istruzione"){ echo 'selected=selected'; } ?>  >Formazione istruzione</option>
                    <option class="step_2_option" value="Agricoltura e sviluppo rurale" <?php if($step_2=="Agricoltura e sviluppo rurale"){ echo 'selected=selected'; } ?>  >Agricoltura e sviluppo rurale</option>
                    <option class="step_2_option" value="Trasporti, telecomunicazioni, energia" <?php if($step_2=="Trasporti, telecomunicazioni, energia"){ echo 'selected=selected'; } ?>  >Trasporti, telecomunicazioni, energia</option>
                    <option class="step_2_option" value="Ambiente, clima" <?php if($step_2=="Ambiente, clima"){ echo 'selected=selected'; } ?>  >Ambiente, clima</option>
                    <option class="step_2_option" value="Salute e crescita" <?php if($step_2=="Salute e crescita"){ echo 'selected=selected'; } ?>  >Salute e crescita</option>
                    <option class="step_2_option" value="Sviluppo urbano e regionale" <?php if($step_2=="Sviluppo urbano e regionale"){ echo 'selected=selected'; } ?>  >Sviluppo urbano e regionale</option>
                    <option class="step_2_option" value="Occupazione e inclusione sociale - aiuti umanitari" <?php if($step_2=="Occupazione e inclusione sociale - aiuti umanitari"){ echo 'selected=selected'; } ?>  >Occupazione e inclusione sociale - aiuti umanitari</option>
                </select>
            </div>
            <div class="coupon_name">
                Step 3
            </div>
            <div class="coupon_input">
                <select name="step3" id="step3">
                    <option value="Please Select"  <?php if($step_3=="Please Select"){ echo 'selected=selected'; } ?> >Please Select</option>
                    <option class="step_3_option" value="Regione Lombardia" <?php if($step_3=="Regione Lombardia"){ echo 'selected=selected'; } ?> >Regione Lombardia</option>
                    <option class="step_3_option" value="Regione Piemonte" <?php if($step_3=="Regione Piemonte"){ echo 'selected=selected'; } ?> >Regione Piemonte</option>
                    <option class="step_3_option" value="Regione Liguria" <?php if($step_3=="Regione Liguria"){ echo 'selected=selected'; } ?> >Regione Liguria</option>
                    <option class="step_3_option" value="Other" <?php if($step_3=="Other"){ echo 'selected=selected'; } ?> >Other</option>
                </select>
            </div>
            <div class="coupon_name">
                Step 4
            </div>
            <div class="coupon_input">
                <select name="step4" id="step4">
                    <option value="Please Select" <?php if($step_4=="Please Select"){ echo 'selected=selected'; } ?> >Please Select</option>
                    <option class="step_4_option" value="Bandi Regionali" <?php if($step_4=="Bandi Regionali"){ echo 'selected=selected'; } ?> >Bandi Regionali</option>
                    <option class="step_4_option" value="Bandi Europei" <?php if($step_4=="Bandi Europei"){ echo 'selected=selected'; } ?> >Bandi Europei</option>
                </select>
            </div>

            <div class="oggetto-box">
                <div class="coupon_name">
                    Oggetto
                </div>
                <div class="coupon_input">
                    <input type="text" name="oggetto[]" id="" value="<?php echo $oggetto; ?>" />
                </div>
                <div class="coupon_name">
                    Programma
                </div>
                <div class="coupon_input">
                    <input type="text" name="programma[]" id="" value="<?php echo $programma; ?>"/>
                </div>
                <div class="coupon_name">
                    Scadenza
                </div>
                <div class="coupon_input">
                    <input type="text" name="scadenza[]" id="" value="<?php echo $scadenza; ?>" />
                </div>
                <div class="coupon_name">
                    Oggetto Link
                </div>
                <div class="coupon_input">
                    <input type="text" name="oggetto_link[]" id="" value="<?php echo $link; ?>" />
                </div>
            </div>
            <div class="coupon_sent" style="float:right;">
                <div class="add-more">+</div>
            </div>

            <div id="new-oggetto-container">

            </div>


            <div class="coupon_sent" style="float:right; margin-right:40px; margin-top:15px; clear:both;">
                <input type="submit" disabled="disabled" class="c_input" name="add_summary" value="Add summary"/>
            </div>
        </form>
        <form action="" method="POST" style="width: 100%; margin-top: -263px; float: left;">
            <input id="step_0" type="hidden" name="step_0" value="<?php echo $initial_step; ?>">
            <input id="step_1" type="hidden" name="step_1" value="<?php echo $step_1; ?>">
            <input id="step_2" type="hidden" name="step_2" value="<?php echo $step_2; ?>">
            <input id="step_3" type="hidden" name="step_3" value="<?php echo $step_3; ?>">
            <input id="step_4" type="hidden" name="step_4" value="<?php echo $step_4; ?>">
            <input type="button" class="c_input update_stepss" name="update_steps" value="Update Steps"/>
        </form> 
    </div>
    <?php
        $query_display = 'SELECT * FROM bandi_summary ORDER BY date_added DESC';
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
                $cupon['oggetto'] = $row['oggetto'];
                $cupon['programma'] = $row['programma'];
                $cupon['scadenza'] = $row['scadenza'];
                $cupon['oggetto_link'] = $row['link'];
                $cupons[] = $cupon;
            }
        }
        else
        {
            $msg = '<div class="msg_info">You have 0 bandi summary added!</div>';
        }
    ?>   
    <div class="tabel_coduri" style="width:70%; float:left; margin-left:20px;">
        <h2 style="font-weight:bold; padding-top:0px; margin-top:0px;">Bandi summary list</h2>
        <div><?php echo $delete_msg; ?></div>
        <div><?php echo $msg; ?></div>
        <div style="overflow:auto;">
            <div class="nume_cod cod bold border-bottom">Initial step</div>
            <div class="cod_detalii bold border-bottom">Step 1</div>
            <div class="cod_detalii bold border-bottom" style="width:140px;">Step 2</div>
            <div class="cod_detalii bold border-bottom" style="width:120px;">Step 3</div>
            <div class="cod_detalii bold border-bottom" style="width:100px;">Step 4</div>
            <div class="cod_detalii bold border-bottom" style="width:197px;">Oggetto</div>
            <div class="cod_detalii bold border-bottom" style="width:90px;">Programma</div>
            <div class="cod_detalii bold border-bottom" style="width:80px;">Scadenza</div>
            <div class="cod_detalii bold border-bottom"  style="width:210px;">Oggetto Link</div>
            <div class="cod_detalii bold border-bottom" style="width:80px; padding-left:5px;">Option</div>
        </div>
        <?php foreach($cupons as $key=>$val) 
            { 
            ?>
            <div style="overflow:auto; border-bottom: 1px solid #1a8893; background-color: #fff;">
                <form action="" name="edit_form" method="post">
                    <div class="nume_cod cod"> <?php echo $val['step0'];?> </div>
                    <div class="cod_detalii"> <?php echo $val['step1'];?> </div>
                    <div class="cod_detalii" style="width:140px;"> <?php echo $val['step2'];?> </div>
                    <div class="cod_detalii" style="width:120px;"> <?php echo $val['step3'];?> </div>   
                    <div class="cod_detalii" style="width:100px;"> <?php echo $val['step4'];?> </div>    
                    <div class="cod_detalii" style="width:197px;"> <?php echo $val['oggetto'];?> </div>    
                    <div class="cod_detalii" style="width:90px;"> <?php echo $val['programma'];?> </div>    
                    <div class="cod_detalii" style="width:80px;"> <?php echo $val['scadenza'];?> </div>    
                    <div class="cod_detalii" style="width:210px;"><textarea name="updatedlink" style="height:125px;"><?php echo $val['oggetto_link'];?></textarea></div>  
                    <div class="cod_detalii" style="width:80px; padding-left:5px;">                          
                        <input type="hidden" name="link_id" value="<?php echo $val['id'] ?>" />
                        <input type="submit" class="c_input" style="width:80px;" onclick="return confirm('Do you want to delete this bandi summary?');" title="Click to delete this bandi summary" name="delete_summary" value="Delete" />
                        <!-- <input type="button" class="c_input" style="width:80px;"  title="Click to edit link" name="edit_link" value="Edit link" />  -->
                        <input type="submit" class="c_input" style="width:80px;" title="Click to save new link" name="save_link" value="Save link" />
                    </div> 
                </form> 
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
    .nume_cod{width:70px;  float:left; padding-top:5px;  }
    .cod_detalii{width:112px; text-align:center; float:left; padding-top:5px; word-wrap:break-word;}
    .bold{font-weight:bold;}
    .c_input.update_stepss {float: right;margin-right: 10px;}
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
    .step_4_option , .step_3_option , .step_2_option , .for_step_Pubblico , .for_step_Privato ,.for_step_NoProfit{display:none;}
    .oggetto-box {border:1px solid #ccc; padding:2px; overflow: auto; clear:both; margin-top:50px; margin-bottom:5px;float:left;}
    .add-more {background-color:#ccc; color:#fff; padding:2px; width:20px; font-size:20px; font-weight:bolder; text-align:center; border-radius:50%; float:right;}
    .add-more:hover {opacity:0.8; cursor:pointer;}
    .visible-button {display:block;}
</style>   

<script type="text/javascript">
    jQuery(document).ready(function(){
        
        if(jQuery("#step0").val()!="Please Select")
        {
            var classs=".for_step_"+jQuery("#step0").val();
            jQuery(classs).css("display","block");     
        }  
         if(jQuery("#step1").val()!="Please Select")
        {
            jQuery(".step_2_option").css("display","block");     
        }  
        if(jQuery("#step2").val()!="Please Select")
        {
            jQuery(".step_3_option").css("display","block");     
        }
          if(jQuery("#step3").val()!="Please Select")
        {
            jQuery(".step_4_option").css("display","block");     
        }
            jQuery('#step0').change(function(){
                    if(this.value == 'Pubblico')
                        {
                        /* jQuery('#step1').html('<option value="">Please Select</option><option value="P.A.">P.A.</option><option value="Comuni">Comuni</option><option value="Province">Province</option>'); */
                        jQuery(".for_step_Pubblico").css("display","block");
                        jQuery(".for_step_NoProfit").css("display","none");
                        jQuery(".for_step_Privato").css("display","none");
                    } 
                    else if(this.value == 'Privato')
                        {
                   /*     jQuery('#step1').html('<option value="">Please Select</option><option value="PMI">PMI</option><option value="Start Up">Start Up</option><option value="Consorzi">Consorzi</option><option value="Cooperativa">Cooperativa</option><option value="Cittadino">Cittadino</option>'); */
                   jQuery(".for_step_Pubblico").css("display","none");
                   jQuery(".for_step_NoProfit").css("display","none");
                    jQuery(".for_step_Privato").css("display","block");
                    }
                    else if(this.value == 'NoProfit')
                        {
                        /*jQuery('#step1').html('<option value="">Please Select</option><option value="Associazioni">Associazioni</option><option value="Fondazioni">Fondazioni</option><option value="Università">Università</option>'); */
                        jQuery(".for_step_NoProfit").css("display","block");
                        jQuery(".for_step_Pubblico").css("display","none");
                        jQuery(".for_step_Privato").css("display","none");
                    }
                    else if(this.value == 'Please Select')
                    {
                        jQuery('option:selected', 'select[name="step1"]').removeAttr('selected');
                        jQuery('option:selected', 'select[name="step2"]').removeAttr('selected');
                        jQuery('option:selected', 'select[name="step3"]').removeAttr('selected');
                        jQuery('option:selected', 'select[name="step4"]').removeAttr('selected');
                        jQuery("#step_1").val(jQuery(this).val());
                        jQuery("#step_2").val(jQuery(this).val());
                        jQuery("#step_3").val(jQuery(this).val());
                        jQuery("#step_4").val(jQuery(this).val());
                        jQuery(".firststep").css("display","none");
                        jQuery(".step_2_option").css("display","none");
                        jQuery(".step_3_option").css("display","none");
                        jQuery(".step_4_option").css("display","none");
                        jQuery('input[name="add_summary"]').attr('disabled','disabled'); 
                    }
                    jQuery("#step_0").val(jQuery(this).val());

            });

            jQuery('#step1').change(function(){
                    /*   jQuery('#step2').html('<option value="">Please Select</option><option value="Ricerca innovazione imprese">Ricerca innovazione imprese</option><option value="Formazione istruzione">Formazione istruzione</option><option value="Agricoltura e sviluppo rurale">Agricoltura e sviluppo rurale</option><option value="Trasporti, telecomunicazioni, energia">Trasporti, telecomunicazioni, energia</option><option value="Ambiente, clima">Ambiente, clima</option><option value="Salute e crescita">Salute e crescita</option><option value="Sviluppo urbano e regionale">Sviluppo urbano e regionale</option><option value="Occupazione e inclusione sociale - aiuti umanitari">Occupazione e inclusione sociale - aiuti umanitari</option>'); */
                    if(jQuery(this).val()=="Please Select")
                    {
                        jQuery('option:selected', 'select[name="step2"]').removeAttr('selected');
                        jQuery('option:selected', 'select[name="step3"]').removeAttr('selected');
                        jQuery('option:selected', 'select[name="step4"]').removeAttr('selected');
                        jQuery("#step_2").val(jQuery(this).val());
                        jQuery("#step_3").val(jQuery(this).val());
                        jQuery("#step_4").val(jQuery(this).val());
                        jQuery(".step_2_option").css("display","none");
                        jQuery(".step_3_option").css("display","none");
                        jQuery(".step_4_option").css("display","none");
                        jQuery('input[name="add_summary"]').attr('disabled','disabled'); 
                    }
                    else
                    {
                    jQuery(".step_2_option").css("display","block");
                    
                    }
                    jQuery("#step_1").val(jQuery(this).val());
            });

            jQuery('#step2').change(function(){
                    /* jQuery('#step3').html('<option value="">Please Select</option><option value="Regione Lombardia">Regione Lombardia</option><option value="Regione Piemonte">Regione Piemonte</option><option value="Regione Liguria">Regione Liguria</option><option value="Other">Other</option>'); */
                        if(jQuery(this).val()=="Please Select")
                    {
                        jQuery('option:selected', 'select[name="step3"]').removeAttr('selected');
                        jQuery('option:selected', 'select[name="step4"]').removeAttr('selected');
                        jQuery("#step_3").val(jQuery(this).val());
                        jQuery("#step_4").val(jQuery(this).val());
                        jQuery(".step_3_option").css("display","none");
                        jQuery(".step_4_option").css("display","none");
                        jQuery('input[name="add_summary"]').attr('disabled','disabled');
                    }
                    else
                    {
                        jQuery(".step_3_option").css("display","block");
                    }
                    jQuery("#step_2").val(jQuery(this).val());
            });

            jQuery('#step3').change(function(){
                    // jQuery('#step4').html('<option value="">Please Select</option><option value="Bandi Regionali">Bandi Regionali</option><option value="Bandi Europei">Bandi Europei</option>'); 
                      if(jQuery(this).val()=="Please Select")
                    {
                        jQuery('option:selected', 'select[name="step4"]').removeAttr('selected');
                        jQuery("#step_4").val(jQuery(this).val());
                        jQuery(".step_4_option").css("display","none");
                        jQuery('input[name="add_summary"]').attr('disabled','disabled');
                    }
                    else
                    {
                        jQuery(".step_4_option").css("display","block");
                    }
                    jQuery("#step_3").val(jQuery(this).val());
            });

            jQuery('#step4').change(function(){
                if(jQuery(this).val()!="Please Select")
                {
                    jQuery('input[name="add_summary"]').removeAttr('disabled'); 
                }
                else
                {
                    jQuery('input[name="add_summary"]').attr('disabled','disabled'); 
                }
                    jQuery("#step_4").val(jQuery(this).val());
            });
            if(jQuery("#step0").val()!="Please Select" && jQuery("#step1").val()!="Please Select" && jQuery("#step2").val()!="Please Select" && jQuery("#step3").val()!="Please Select" && jQuery("#step4").val()!="Please Select")
            {
                 jQuery('input[name="add_summary"]').removeAttr('disabled'); 
            }
            //For updating steps
            jQuery(".update_stepss").click(function(){
                                jQuery.ajax({
                                type: "POST",
                                cache : false,
                                url: "<?php echo $plugins_url ; ?>/bandi_plugin/ajax.php",
                                data:  {step_0:jQuery("#step_0").val(),step_1:jQuery("#step_1").val(),step_2:jQuery("#step_2").val(),step_3:jQuery("#step_3").val(),step_4:jQuery("#step_4").val()}
                        })
                             .done(function( result ) {
                                jQuery('.message_container').html(result);
                        });
            });
    });

    jQuery(document).on('click','.add-more',function(){
            jQuery('#new-oggetto-container').append('<div class="oggetto-box"><div class="coupon_name">Oggetto</div><div class="coupon_input"><input type="text" name="oggetto[]" id="" value="" /></div><div class="coupon_name">Programma</div><div class="coupon_input"><input type="text" name="programma[]" id="" value="" /></div><div class="coupon_name">Scadenza</div><div class="coupon_input"><input type="text" name="scadenza[]" id="" value="" /></div><div class="coupon_name">Oggetto Link</div><div class="coupon_input"><input type="text" name="oggetto_link[]" id="" value="" /></div></div><div class="coupon_sent" style="float:right;"><div class="add-more visible-button">+</div></div>'); 
            jQuery(this).css('display','none');
    });
</script>