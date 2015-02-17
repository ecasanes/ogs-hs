<?php 

$this->load->view('includes/header-with-logout', $data);

?>

<section id="main-content">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1></h1>
                <h2>
                    Sorry you do not have access to this section
                </h2>
                <div class="error-details">
                    You can try other pages for testing, Thanks.
                </div>
                <div class="error-actions">
                    <a onclick="window.history.back();" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-arrow-left"></span>
                        Take Me to Previous Page </a>

                </div>
            </div>
        </div>
    </div>
</div>
</section>

<?php $this->load->view('includes/footer', $data); ?>