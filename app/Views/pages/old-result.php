<div class="container-fluid">
    <div class="body-container">
        <div class="result-content">
            <div class="result-first-main">
                <div class="content-wrapper first-sib p-0">
                    <h4 class="bg-primary text-center font-body heading-4">
                        OLD RESULTS
                    </h4>
                </div>
                <div class="heading-wrapper">
                    <h2 class="text-center font-body heading-5">
                        <strong>OLD RESULTS</strong>
                    </h2>
                </div>
                <div class="result-content">
                    <div class="col-lg-3 col-md-5 col-6 mx-auto">
                        <select name="old_results" id="old_results" class="form-control text-center border-warning"
                            placeholder="Select the date" onchange="downloadPdf(this.value)">
                            <option value="">Select the option</option>
                            <?php if (isset($oldResults) && !empty($oldResults)): ?>
                            <?php foreach ($oldResults as $result): ?>
                            <option value="<?= $result->pdf_path ?>">
                                <?= date('d-m-Y', strtotime($result->draw_date)) ?> -
                                <?= date('g:i A', strtotime($result->draw_time)) ?>
                            </option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="conten-wrapper">
                    <div class="section-container">
                        <h3 class="ad-heading font-body mb-4">
                            SINGHAM MEGA LOTTERY DRAW
                        </h3>
                        <h4 class="heading-1 mb-0">
                            Ticket Price ₹600 Only — Win up to ₹5 CRORE!
                        </h4>
                        <h4 class="heading-1 mb-4">Play responsibly. Terms apply.</h4>
                        <a href="#" class="btn btn-lg btn-light buy-tickets-btn font-body">BUY YOUR TICKET NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function downloadPdf(pdfPath) {
    if (pdfPath && pdfPath !== '') {
        // Extract filename from path
        const filename = pdfPath.split('/').pop();
        // Use your existing download route
        window.location.href = '<?= base_url('files/download/') ?>' + filename;
    }
}
</script>