<?php

    $base_url = base_url('');
    $controller = $this->uri->segment(1, '');
    $method = $this->uri->segment(2, '');
    $session_id = $this->session->userdata('session');

?>


                </div>
            </div>
        </div>
        <?php 
	        if(!isset($modals)){
	        	$modals = null;
	        } 
        ?>
        <?php if($modals && isset($modals)): ?>
	        <?php foreach($modals as $modal_name): ?>
				<?php $this->load->view('modals/'.$modal_name.'.php'); ?>
	    	<?php endforeach; ?>
    	<?php endif; ?>
        <?php $this->load->view('modals/new-document-modal.php'); ?>


        

        <?php 
            if(!isset($footer_scripts_head)){
                $footer_scripts_head = null;
            } 
        ?>
        <?php if($footer_scripts_head && isset($footer_scripts_head)): ?>
            <?php foreach($footer_scripts_head as $script_path): ?>
                <script src="<?php echo base_url('theme/js/'.$script_path.'.js'); ?>"></script>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php $this->load->view('layout/footer-scripts'); ?>

        <?php 
            if(!isset($footer_scripts)){
                $footer_scripts = null;
            } 
        ?>
        <?php if($footer_scripts && isset($footer_scripts)): ?>
            <?php foreach($footer_scripts as $script_path): ?>
                <script src="<?php echo base_url('theme/js/'.$script_path.'.js'); ?>"></script>
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
</html>