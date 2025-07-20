<div class="container-fluid">
    <?php // echo "<pre>"; print_r($resultArray);?>
    <div class="body-container">
        <div class="heading-wrapper p-0">
            <h4 class="bg-primary text-center font-body heading-1">
                MEGHALAYA STATE LOTTERY
            </h4>
        </div>
        <div class="heading-wrapper">
            <h2 class="heading-2 font-body"><strong>SINGHAM</strong></h2>
        </div>
        <div class="heading-wrapper p-0">
            <h4 class="bg-primary text-center font-body heading-3">
                MEGHALAYA WEEKLY LOTTERY
            </h4>
        </div>
        <div class="para-wrapper">
            <p class="font-body para-color para-align">
                Stay updated with the latest results and information about
                MEGHALAYA State Lottery. Your gateway to winning opportunities
                awaits.
            </p>
        </div>
        <div class="content-wrapper">
            <div class="download-option-btns">
                <!-- 1 PM Download Button -->
                <?php if ($processedResults['1pm']['showDownload'] && $processedResults['1pm']['result']): ?>
                <a href="<?=base_url('files/download/' . basename($processedResults['1pm']['result']->pdf_path))?>"
                    target="_blank" class="download-btn-78asbcabc custom-btn font-body">01:00 P.M</a>
                <?php else: ?>
                <span class="download-btn-78asbcabc custom-btn font-body"
                    style="opacity: 0.5; cursor: not-allowed;">01:00 P.M</span>
                <?php endif; ?>

                <!-- 8 PM Download Button -->
                <?php if ($processedResults['8pm']['showDownload'] && $processedResults['8pm']['result']): ?>
                <a href="<?=base_url('files/download/' . basename($processedResults['8pm']['result']->pdf_path))?>"
                    target="_blank" class="download-btn-78asbcabc custom-btn font-body">08:00 P.M</a>
                <?php else: ?>
                <span class="download-btn-78asbcabc custom-btn font-body"
                    style="opacity: 0.5; cursor: not-allowed;">08:00 P.M</span>
                <?php endif; ?>

                <a href="<?=base_url('old-results')?>"
                    class="download-btn-78asbcabc custom-btn custom-dark-btn font-body">OLD RESULTS</a>
            </div>
            <div class="divider"></div>
        </div>
        <div class="result-content">
            <!-- 1 PM Result Section -->
            <div class="result-first-main">
                <div class="content-wrapper p-0">
                    <h4 class="bg-primary text-center font-body heading-4">
                        <?php if ($processedResults['1pm']['result']): ?>
                        <?= date('d-m-Y', strtotime($processedResults['1pm']['result']->draw_date)) ?>
                        <?php else: ?>
                        <?= date('d-m-Y') ?>
                        <?php endif; ?>
                    </h4>
                </div>
                <div class="heading-wrapper">
                    <h2 class="text-center font-body heading-5">
                        <strong>MORNING (01:00 P.M)</strong>
                    </h2>
                </div>
                <div class="result-content">
                    <?php if ($processedResults['1pm']['showImage'] && $processedResults['1pm']['result']): ?>
                    <img class="img-fluid"
                        src="<?=base_url('files/image/' . basename($processedResults['1pm']['result']->result_image))?>"
                        alt="1 PM Lottery Result" />
                    <?php if ($processedResults['1pm']['message']): ?>
                    <div class="alert alert-info mt-3 text-center">
                        <small class="font-body"><?= $processedResults['1pm']['message'] ?></small>
                    </div>
                    <?php endif; ?>
                    <?php else: ?>
                    <div class="text-center p-4"
                        style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px;">
                        <p class="font-body para-color">
                            <?= $processedResults['1pm']['message'] ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 8 PM Result Section -->
            <div class="result-first-main">
                <div class="content-wrapper p-0">
                    <h4 class="bg-primary text-center font-body heading-4">
                        <?php if ($processedResults['8pm']['result']): ?>
                        <?= date('d-m-Y', strtotime($processedResults['8pm']['result']->draw_date)) ?>
                        <?php else: ?>
                        <?= date('d-m-Y') ?>
                        <?php endif; ?>
                    </h4>
                </div>
                <div class="heading-wrapper">
                    <h2 class="text-center font-body heading-5">
                        <strong>NIGHT (08:00 P.M)</strong>
                    </h2>
                </div>
                <div class="result-content">
                    <?php if ($processedResults['8pm']['showImage'] && $processedResults['8pm']['result']): ?>
                    <img class="img-fluid"
                        src="<?=base_url('files/image/' . basename($processedResults['8pm']['result']->result_image))?>"
                        alt="8 PM Lottery Result" />
                    <?php if ($processedResults['8pm']['message']): ?>
                    <div class="alert alert-info mt-3 text-center">
                        <small class="font-body"><?= $processedResults['8pm']['message'] ?></small>
                    </div>
                    <?php endif; ?>
                    <?php else: ?>
                    <div class="text-center p-4"
                        style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px;">
                        <p class="font-body para-color">
                            <?= $processedResults['8pm']['message'] ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="draw-content">
            <div class="content-wrapper">
                <h1 class="heading-6 font-body">Draw Schedule</h1>
            </div>
            <div class="para-wrapper">
                <p class="draw-terms-para para-color font-body">
                    One times a day, a First Prize of Rs. 75 Lakhs is up for grabs in
                    the Meghalaya Future Daily Lottery. Every day of the week has a
                    distinct name for the draws. For instance, the draws on Sunday
                    are referred to as Future Brook, the draws on Monday as Future
                    Stream, and so forth. Each draw's name and draw date are listed
                    in the table below.
                </p>
                <p class="draw-terms-para para-color font-body">
                    Meghalaya Lottery on , at precisely 1:00 PM. This famous website
                    called the Meghalaya Lottery, has built a reputation for quickly
                    publishing
                </p>
                <p class="draw-terms-para para-color font-body">
                    the most current lottery results. So, respected customers,
                    please accept these results for the Meghalaya State Lottery's
                    1:00 PM Morning Result.
                </p>
                <p class="draw-terms-para para-color font-body">
                    Check Today Result 1 PM today Meghalaya State Lottery , Singham
                    Lottery Result 1:00 PM. As you know lottery draw (1:00 PM)
                    has been rescheduled and now being updated at 1:00 PM. You may
                    check Singham Lottery morning result here at 1:00 PM. Today
                    result will also be updated here on this page. Stay connected
                    with us to check your today's draw result of the day. Those who
                    have tickets for the draw (1:00 PM) stay connected with us.
                    Result will be updated soon here on this page. Stay tuned to
                    check more results of the day.
                </p>
            </div>
            <div class="tnc-section content-wrapper">
                <a class="common-button custom-btn tnc-btn tnc-main-btn font-button" href="#" target="_blank">Terms
                    &amp; Conditions</a>
            </div>
        </div>
    </div>
</div>