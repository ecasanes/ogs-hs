<?php


    if($controller == 'basic-decf'){


        switch($current_form_step){
            case 1:
                $link_next = base_url($controller.'/edit/'.$form_id.'/2');
                break;
            case 2:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/1');
                $link_next = base_url($controller.'/edit/'.$form_id.'/0');
                break;
            case 3:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/2');
                $link_next = base_url($controller.'/edit/'.$form_id.'/4');
                break;
            case 4:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/3');
                $link_next = base_url($controller.'/edit/'.$form_id.'/5');
                break;
            case 5:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/4');
                $link_next = base_url($controller.'/edit/'.$form_id.'/6');
                break;
            case 6:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/5');
                break;
            default:
                $link_prev = '';
                break;
        }
    }

    if($controller == 'case-file' || $controller == 'project-plan'){


        switch($current_form_step){
            case 1:
                $link_next = base_url($controller.'/edit/'.$form_id.'/2');
                break;
            case 2:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/1');
                $link_next = base_url($controller.'/edit/'.$form_id.'/0');
                break;
            case 3:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/2');
                $link_next = base_url($controller.'/edit/'.$form_id.'/4');
                break;
            case 4:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/3');
                $link_next = base_url($controller.'/edit/'.$form_id.'/5');
                break;
            case 5:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/4');
                $link_next = base_url($controller.'/edit/'.$form_id.'/6');
                break;
            case 6:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/5');
                $link_next = base_url($controller.'/edit/'.$form_id.'/7');
                break;
            case 7:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/6');
                $link_next = base_url($controller.'/edit/'.$form_id.'/8');
                break;
            case 8:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/7');
                break;
            default:
                $link_prev = '';
                break;
        }
    }


    if($controller == 'ofi'){
        switch($current_form_step){
            case 1:
                $link_next = base_url($controller.'/edit/'.$form_id.'/2');
                break;
            case 2:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/1');
                $link_next = base_url($controller.'/edit/'.$form_id.'/3');
                break;
            case 3:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/2');
                $link_next = base_url($controller.'/edit/'.$form_id.'/4');
                break;
            case 4:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/3');
                $link_next = '';
                break;
            default:
                $link_prev = '';
                break;
        }
    }


     if($controller == 'erp'){
        switch($current_form_step){
            case 1:
                $link_next = base_url($controller.'/edit/'.$form_id.'/2');
                break;
            case 2:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/1');
                $link_next = base_url($controller.'/edit/'.$form_id.'/3');
                break;
            case 3:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/2');
                $link_next = base_url($controller.'/edit/'.$form_id.'/4');
                break;
            case 4:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/3');
                $link_next = base_url($controller.'/edit/'.$form_id.'/5');
                break;
            case 5:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/4');
                $link_next = '';
                break;
            default:
                $link_prev = '';
                break;
        }
    }


    if($controller == 'mcdr'){
        switch($current_form_step){
            case 1:
                $link_next = base_url($controller.'/edit/'.$form_id.'/2');
                break;
            case 2:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/1');
                $link_next = base_url($controller.'/edit/'.$form_id.'/3');
                break;
            case 3:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/2');
                $link_next = base_url($controller.'/edit/'.$form_id.'/4');
                break;
            case 4:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/3');
                $link_next = base_url($controller.'/edit/'.$form_id.'/5');
                break;
            case 5:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/4');
                $link_next = base_url($controller.'/edit/'.$form_id.'/6');
                break;
            case 6:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/5');
                $link_next = base_url($controller.'/edit/'.$form_id.'/7');
                break;
            case 7:
                $link_prev = base_url($controller.'/edit/'.$form_id.'/6');
                break;
            default:
                $link_prev = '';
                break;
        }
    }
    

?>

<div class="panel-footer">
    <div class="row tab-footer">
        <div class="col-xs-5 text-left">
            <?php if($current_form_step != 1): ?>
                <a class="btn btn-info prevtab casefile" type="button" href="<?php echo $link_prev; ?>"><span class="glyphicon glyphicon-chevron-left"></span> Prev</a>
            <?php endif; ?>
        </div>
        <div class="col-xs-7 text-right">
            <button class="btn btn-info btn-icon casefile" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span></button>
            <!-- <a id="steps-print-button" href="#" class="btn btn-default"></span></a> -->
            <?php if($current_form_step != 4 && $controller == 'ofi'): ?>
                <button class="btn btn-info nexttab casefile" type="submit">Next <span class="glyphicon glyphicon-chevron-right"></span></button>
            <?php elseif($current_form_step != 8 && ($controller == 'case-file' || $controller == 'project-plan')): ?>
                <button class="btn btn-info nexttab casefile" type="submit">Next <span class="glyphicon glyphicon-chevron-right"></span></button>
            <?php elseif($current_form_step != 6 && $controller == 'basic-decf'): ?>
                <button class="btn btn-info nexttab casefile" type="submit">Next <span class="glyphicon glyphicon-chevron-right"></span></button>
            <?php elseif($current_form_step != 5 && $controller == 'erp'): ?>
                <button class="btn btn-info nexttab casefile" type="submit">Next <span class="glyphicon glyphicon-chevron-right"></span></button>
            <?php elseif($current_form_step != 7 && $controller == 'mcdr'): ?>
                <button class="btn btn-info nexttab casefile" type="submit">Next <span class="glyphicon glyphicon-chevron-right"></span></button>
            <?php endif; ?>
        </div>
    </div>
</div>


