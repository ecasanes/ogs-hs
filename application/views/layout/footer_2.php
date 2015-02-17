<script type="text/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>

       </div>
   </div>
</div>

<script src="<?php print base_url() ?>theme/assets/bs3/js/bootstrap.min.js"></script>
<script src="<?php print base_url() ?>theme/assets/plugins/jquery-tinymce/tinymce.min.js"></script>

<script src="<?php print base_url() ?>theme/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php print base_url() ?>theme/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

<script src="<?php print base_url() ?>theme/js/plugins/bootstrapValidator.min.js"></script>
<script src="<?php print base_url() ?>theme/js/plugins/jasny-bootstrap.min.js"></script>

<script src="<?php print base_url() ?>theme/js/plugins/jquery.cookie.js"></script>

<script src="<?php print base_url() ?>theme/assets/plugins/jquery-navgoco/jquery.navgoco.js"></script>
<script src="<?php print base_url() ?>theme/js/main.js"></script>

<script src="<?php print base_url() ?>theme/assets/plugins/jquery-select2/select2.min.js"></script>
<script src="<?php print base_url() ?>theme/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script src="<?php print base_url() ?>theme/assets/plugins/jquery-icheck/icheck.min.js"></script>
<script src="<?php print base_url() ?>theme/js/plugins/icheck.js"></script>
<script src="<?php print base_url() ?>theme/js/plugins/jquery.floatThead.min.js"></script>

<script src="<?php print base_url() ?>theme/js/plugins/jquery.dynatable.js"></script>
<script src="<?php print base_url() ?>theme/js/plugins/jquery.form.js"></script>

<script src="<?php print base_url() ?>theme/js/plugins/jquery.scrollUp.min.js"></script>
<script src="<?php print base_url() ?>theme/js/plugins/lightbox/lightbox.min.js"></script>

<script src="<?php print base_url() ?>theme/js/plugins/jquery.newsTicker.js"></script>

<script src="<?php print base_url() ?>theme/js/plugins/jquery.sticky-kit.min.js"></script>

<script src="<?php print base_url() ?>theme/js/plugins/jquery.browser.min.js"></script>

<script src="<?php print base_url() ?>theme/js/plugins/json2.js"></script>
<script src="<?php print base_url() ?>theme/js/jquery.dataTables.min.js"></script>

<script src="<?php print base_url() ?>theme/js/custom2.js"></script>

<?php if(! empty($listeners) ): ?>
<script type="text/javascript">
    $(document).ready(function() {
            // Use php array loop.
        <?php foreach($listeners as $listener): ?>
            <?php print($listener); ?>;
        <?php endforeach ?>
    }); 
</script>
<?php endif ?>
