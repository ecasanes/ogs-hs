<div id="sidebar-ticker" class="col-xs-12 ticker-list">
        <?php for($i=0;$i<3;$i++): ?>
        <div class="row ticker-row">
            <div class="col-xs-4 no-padding">
                <img class="img-responsive" src="https://s1.yimg.com/bt/api/res/1.2/0WcGYpojLJ7yrxCUdihsTw--/YXBwaWQ9eW5ld3M7Y2g9OTU2O2NyPTE7Y3c9MTAyNDtkeD0wO2R5PTA7Zmk9dWxjcm9wO2g9MTc4O3E9ODU7dz0xOTA-/http://media.zenfs.com/en-PH/homerun/philstar.com/22f23db30f6fd53c05cdbd3bfaf88b11">
            </div>
            <div class="col-xs-8">
                <h4>Title</h4>
                <p>This is a test content <?php echo $i; ?></p>
            </div>
        </div>
        <?php endfor; ?>
        <?php for($i=0;$i<3;$i++): ?>
        <div class="row ticker-row">
            <div class="col-xs-4 no-padding">
                <img class="img-responsive" src="https://s1.yimg.com/bt/api/res/1.2/0WcGYpojLJ7yrxCUdihsTw--/YXBwaWQ9eW5ld3M7Y2g9OTU2O2NyPTE7Y3c9MTAyNDtkeD0wO2R5PTA7Zmk9dWxjcm9wO2g9MTc4O3E9ODU7dz0xOTA-/http://media.zenfs.com/en-PH/homerun/philstar.com/22f23db30f6fd53c05cdbd3bfaf88b11">
            </div>
            <div class="col-xs-8">
                <h4>Title</h4>
                <p>This quick brown fox jumps over the lazy dog <?php echo $i; ?></p>
            </div>
        </div>
        <?php endfor; ?>
    </div>