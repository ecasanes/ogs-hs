<div class="row">
  <div class="stepwizard">
      <div class="stepwizard-row">
          <?php
            $step_function = $edit_method.'/'.$form_id;
            echo generate_steps_link($step_function, $no_of_steps, $current_form_step, $step_titles);
          ?>
      </div>
  </div>
</div>
