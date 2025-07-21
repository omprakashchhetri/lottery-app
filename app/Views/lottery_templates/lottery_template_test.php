<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>A4 Print Template</title>
    <style>
    .desktop-capture * {
        /* Reset mobile-specific styles for all children */
        transform: none !important;
        /* font-size: inherit !important; */
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "Arial", sans-serif;
        font-size: 12pt;
        line-height: 1.4;
        color: #333;
        background: #f5f5f5;
    }

    /* Force all text to be bold */
    body,
    body * {
        font-weight: 1000 !important;
    }


    .page {
        width: 210mm;
        min-width: 210mm;
        height: 297mm;
        min-height: 297mm;
        margin: 20px auto;
        background: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 1mm;
        position: relative;
        border-radius: 5px;
        transform: none !important;
        box-sizing: border-box;
    }

    #toolbarContainer {
        display: none;
    }

    .header-image {
        width: 100%;
        height: auto;
        max-height: 80mm;
        object-fit: cover;
        display: block;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .header-wrapper {
        position: relative;
    }

    .first-number {
        color: #f00;
        font-family: 'Arial Black', sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 42pt;
        position: absolute;
        top: 50.5mm;
        right: 39mm !important;
    }

    .draw-number-count {
        color: #ff0d0d;
        font-family: 'Arial Black', sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 18pt;
        position: absolute;
        top: 150px;
        right: 43.5%;
    }

    .draw-date-top {
        color: #fff;
        font-family: 'Arial Black', sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 28pt;
        position: absolute;
        top: 37.4mm;
        right: 34mm;
    }

    .draw-date-top.draw-8pm {
        font-size: 23pt;
        top: 145px;
        right: 37mm;
    }

    .draw-number-count.draw-8pm {
        font-size: 17pt;
        position: absolute;
        top: 145px;
        right: 42%;
    }

    .content {
        padding: 0;
    }

    .section {
        border-bottom: 2px solid gray;
    }

    .section {
        margin-bottom: 0px;
        padding: 8px;
        background: #f9f9f9;
    }

    .section-title {
        font-size: 16pt;
        font-weight: bold;
        color: #007acc;
        margin-bottom: 10px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
    }

    .top-seller-text {
        color: #060;
        font-family: "Arial Black", sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 12px;
    }

    .const-prize-head {
        color: #3a5e8c;
        font-family: "Arial Black", sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 12px;
        white-space: nowrap;
        margin: 0;
        line-height: 0.5;
        padding: 0;
    }

    .two-column {
        display: flex;
        gap: 20px;
    }

    .fifth-numbre-wrapper {
        display: flex;
    }

    .fifth-numbre-wrapper .fifth-section {
        width: calc(100% / 10);
        border-right: 1px solid #333;
        text-align: center;
    }

    .fifth-numbre-wrapper .fifth-section:last-child {
        border-right: unset;
    }

    .fifth-section .draw-number {
        font-weight: 1000 !important;
        display: block;
        color: black;
        font-family: "Arial Rounded MT Bold", sans-serif;
        font-style: normal;
        font-weight: 500;
        line-height: 1.1;
        text-decoration: none;
        font-size: 18pt;
        width: 100%;
    }

    .top-number-text {
        color: black;
        font-family: "Arial Rounded MT Bold", sans-serif;
        font-style: normal;
        font-weight: 600;
        text-decoration: none;
        font-size: 19pt;
        margin: 0pt;
    }

    .section-inner {
        border: 2px solid rgb(149, 149, 255);
        border-radius: 14px;
        margin-top: 10px;
        position: relative;
        min-height: 17mm;
    }

    .section-inner.green {
        min-height: 16mm;
    }

    .section-img {
        position: absolute;
        top: -5px;
        left: -5px;
        z-index: 10;
        width: 74mm;
    }

    .green .section-img {
        top: -1px;
    }

    .section-img img {
        height: 18mm;
    }

    .green .section-img img {
        height: 15.5mm;
    }

    .section-img-block {
        position: absolute;
        background-color: #FAAF3A;
        height: 14mm;
        top: 2px;
        left: 60px;
        z-index: 5;
        width: 45mm;
    }

    .section-img-block-main {
        position: absolute;
        border-bottom: 13mm solid #d51717;
        border-left: 0px solid transparent;
        border-right: 15px solid transparent;
        height: 0;
        top: 7px;
        left: 60px;
        z-index: 5;
        width: 55mm;
    }

    .green .section-img-block {
        top: 2px;
    }

    .green .section-img-block-main {
        border-bottom: 13mm solid #d51717;
        width: 55mm;
        top: 6px;
    }

    .green .section-img-block-main.blue-col {
        border-bottom: 13mm solid #4492d6;
    }

    .green .section-img-block-main.green-col {
        border-bottom: 13mm solid #54bb2e;
    }

    .numbers-wrapper {
        float: right;
        width: calc(100% - 70mm);
        line-height: 1.1;
        margin-top: -2.3mm;
        display: inline-flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .green .numbers-wrapper {
        margin-top: -2.5mm;
    }

    .draw-number {
        width: calc((60mm * 2) / 5);
    }

    .ad-image-wrapper {
        margin-bottom: -5px;
        position: relative;
    }

    .ad-image {
        width: 100%;
        height: 66mm;
    }

    .fifth-price-header {
        text-align: center;
        background: #4447f8;
        color: #fff;
        font-size: 16pt;
        font-weight: 1000;
        padding-bottom: 2px;
    }

    .footer {
        position: relative;
    }

    .footer-image {
        width: 100%;
        height: 12mm;
    }

    .footer-middle {
        position: absolute;
        color: #001F5F;
        font-family: "Arial Black", sans-serif;
        font-size: 25pt;
        left: 50%;
        translate: -50%;
        top: -1mm;
    }

    .footer-middle-element {
        position: absolute;
        border: 1px solid #ddd329;
        ;
        z-index: 1;
        width: 45mm;
        height: 10mm;
        border-radius: 8px;
        left: 40mm;
        top: 1mm;
    }

    .footer-middle-element::before {
        content: "";
        position: absolute;
        height: 9mm;
        width: 1mm;
        background: #ddd329;
        top: 0px;
        left: -10px;
        display: block;
    }

    .footer-middle-element.right {
        right: 40mm;
        top: 1mm;
        left: unset;
    }

    .footer-middle-element.right::before {
        content: unset;
    }

    .footer-middle-element.right::after {
        content: "";
        height: 9mm;
        width: 1mm;
        background: #ddd329;
        ;
        top: 0px;
        right: -10px;
        display: block;
        position: absolute;
    }

    .footer-middle-element .text {
        color: #fff;
        font-family: "Arial Black", sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 6.5pt;
        line-height: 1.3;
        text-align: center;
    }

    .draw-date {
        position: absolute;
        color: #fff;
        font-family: "Arial Black", sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 22pt;
        line-height: 1.3;
        text-align: center;
        top: 0;
        padding: 3px;
        left: 0;
    }

    .draw-date.right {
        position: absolute;
        right: 0;
        left: unset;
    }

    #downloadBtn {
        position: fixed;
        bottom: 10%;
        left: 60%;
        translate: -60%;
        background-color: #4498f8ff;
        padding: 10px 30px;
        font-size: 18px;
        font-weight: 500;
        border: none;
        border-radius: 10px;
        color: #fff;
        z-index: 100;
        display: flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }

    #generateBtn {
        position: fixed;
        bottom: 10%;
        left: 40%;
        translate: -40%;
        background-color: #f86e44ff;
        padding: 10px 30px;
        font-size: 18px;
        font-weight: 500;
        border: none;
        border-radius: 10px;
        color: #fff;
        z-index: 100;
        display: flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }

    .days-left-count {
        position: absolute;
        color: #fff;
        right: 26mm;
        top: 4mm;
        font-size: 31px;
    }

    /* Print Styles */
    /* Print Styles - Updated */
    @media print {
        body {
            background: white;
            font-size: 11pt;
            margin: 0;
            padding: 0;
        }

        .days-left-count {
            position: absolute;
            color: #fff;
            right: 26mm;
            top: 4mm;
            font-size: 31px;
        }

        .page {
            width: 210mm;
            height: 297mm;
            margin: 0;
            box-shadow: none;
            page-break-after: always;
            padding: 1mm;
            display: flex;
            flex-direction: column;
        }

        .header-image {
            max-height: 80mm;
        }

        .content {
            padding: 0;
            flex: 1;
        }

        .section-img-block {
            background: #FAAF3A !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .section-img-block-main {
            border-bottom: 13mm solid #d51717 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .green .section-img-block-main {
            border-bottom: 13mm solid #d51717 !important;
            width: 55mm;
            top: 6px;
        }

        .green .section-img-block-main.blue-col {
            border-bottom: 13mm solid #4492d6;
        }

        .green .section-img-block-main.green-col {
            border-bottom: 13mm solid #54bb2e;
        }

        .fifth-price-header {
            background: #4447f8 !important;
            color: #fff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .section:first-child {
            border-bottom: 2px solid gray;
        }

        .section {
            page-break-inside: avoid;
            background: white;
            margin-bottom: 0px;
            padding: 5px;
        }

        .section-inner {
            border: 2px solid rgb(149, 149, 255);
            border-radius: 8px;
            margin-top: 10px;
            position: relative;
            min-height: 17mm;
        }

        .section-inner.green {
            min-height: 16mm;
        }

        .two-column {
            display: block;
        }

        .column {
            margin-bottom: 15px;
        }

        .highlight-box {
            background: #f0f0f0;
            border: 1px solid #ccc;
        }

        .footer {
            position: relative;
            margin-top: auto;
            width: 100%;
        }

        .footer-image {
            width: 100%;
            height: 12mm;
            display: block;
        }

        .footer-middle-element {
            background: transparent;
            border: 1px solid #ddd329;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .footer-middle-element::before {
            background: #ddd329 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .footer-middle-element.right::after {
            background: #ddd329 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Force all colors to print */
        * {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Remove any fixed positioning that might cause issues */
        .footer {
            position: relative !important;
            bottom: auto !important;
            left: auto !important;
            right: auto !important;
        }

        @page {
            size: A4;
            margin: 0;
        }
    }

    /* Responsive adjustments */
    @media screen and (max-width: 800px) {
        .page {
            width: 95%;
            margin: 10px auto;
        }

        #downloadBtn {
            top: 100px;
            bottom: unset;
            left: 300px;
            right: unset;
        }

        #generateBtn {
            top: 100px;
            bottom: unset;
            left: 100px;
            right: unset;
        }

        #editBtn {
            top: 100px;
            bottom: unset;
            left: 100px;
            right: 100px;
        }
    }
    </style>
</head>

<body>
    <?php 
    // print_r($lotteryData);

        // Set timezone if needed
        date_default_timezone_set('Asia/Kolkata');

        // Today's date
        $today = new DateTime();

        // Target date
        $targetDate = new DateTime('2025-08-27');

        // Calculate the difference
        $interval = $today->diff($targetDate);

        // Output the number of days
        $daysLeft = $interval->days;

        $resultId = $lotteryData['data']['result_id'];
        $status = $lotteryData['data']['status'];
        $first = $lotteryData['data']['lottery_data']['section1'][0];
        $first_short = substr(substr($lotteryData['data']['lottery_data']['section1'][0], 3), -5);;
        $secondData = $lotteryData['data']['lottery_data']['section2'];
        $thirdData = $lotteryData['data']['lottery_data']['section3'];
        $forthData = $lotteryData['data']['lottery_data']['section4'];
        $fifthData = $lotteryData['data']['lottery_data']['section5'];
        $date_short = $lotteryData['data']['draw_date_short'];
        $date_full = $lotteryData['data']['draw_date_full'];
        $time = $lotteryData['data']['draw_time'];
        $formattedTime = strtolower(str_replace(' ', '', $time));
        $onePmCount = $lotteryResultCount[$formattedTime] + 55;
    ?>
    <button id="downloadBtn" onclick="downloadBoth()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-down"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1z">
            </path>
            <path fill-rule="evenodd"
                d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708z">
            </path>
        </svg>
        <span>Download</span></button>
    <button id="generateBtn" onclick="generateBoth()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear"
            viewBox="0 0 16 16">
            <path
                d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0">
            </path>
            <path
                d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z">
            </path>
        </svg>
        <span>Generate</span>
    </button>
    <div class="page">
        <!-- Header Image Section -->
        <div class="header-wrapper">
            <?php if($time == '1 PM'){ ?>
            <span class="first-number"><?=$first?></span>
            <span class="draw-number-count"><?=$onePmCount?></span>
            <span class="draw-date-top"><?=$date_full?></span>
            <img src="<?=base_url()?>assets/images/main-header-1pm-result.jpg" alt="Header Image"
                class="header-image" />
            <?php } else if($time == '8 PM') { ?>
            <!-- 8pm header -->
            <span class="first-number"><?=$first?></span>
            <span class="draw-number-count draw-8pm"><?=$onePmCount?></span>
            <span class="draw-date-top draw-8pm"><?=$date_full?></span>
            <img src="<?=base_url()?>assets/images/main-header-8pm-result.jpg" alt="Header Image"
                class="header-image" />
            <?php } ?>
        </div>

        <div class="content">
            <!-- Section 1: Main Content -->
            <!-- <div class="section">
                <h2 class="top-seller-text">
                    Sold by : SELLER - KRISHNAPADA GHOSH - SWARUPDHA & SUB STOCKIST -
                    SOUVIK LOTTERY CENTRE - BITHARI
                </h2>
            </div> -->
            <div class="section">
                <div class="section-content">
                    <h3 class="const-prize-head">
                        Cons. Prize Amount for Winner ₹
                        <span style="
                  color: rgb(203, 27, 115);
                  font-size: 20px;
                  font-weight: 800;
                ">1000/-</span> <span style="margin-inline: 5px;">for</span> <span style="
                  color: rgb(203, 27, 27);
                  font-size: 15px;
                ">Seller</span>
                        ₹<span style="
                  color: rgb(203, 27, 27);
                  font-size: 15px;
                  font-weight: 800;
                "> 500/-</span>
                        <span style="
                  color: rgb(17, 130, 53);
                  font-size: 15px;
                  font-weight: 800;
                  margin-inline: 5px;
                "><?=$first_short?></span>(All Remaining Series Of 1st Prize No.)
                    </h3>
                </div>
                <div class="section section-inner">
                    <div class="section-img">
                        <img src="<?=base_url()?>assets/images/2nd-price-label.png" alt="">
                    </div>
                    <div class="section-img-block"></div>
                    <div class="section-img-block-main"></div>
                    <div class="numbers-wrapper">
                        <?php foreach($secondData as $secondNum) { ?>
                        <span class="top-number-text draw-number"><?=$secondNum?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="section section-inner green">
                    <div class="section-img">
                        <img src="<?=base_url()?>assets/images/3rd-price-label.png" alt="">
                    </div>
                    <div class="section-img-block"></div>
                    <div class="section-img-block-main blue-col"></div>
                    <div class="numbers-wrapper">
                        <?php foreach($thirdData as $thirdNum) { ?>
                        <span class="top-number-text draw-number"><?=$thirdNum?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="section section-inner green">
                    <div class="section-img">
                        <img src="<?=base_url()?>assets/images/4th-price-label.png" alt="">
                    </div>
                    <div class="section-img-block"></div>
                    <div class="section-img-block-main green-col"></div>
                    <div class="numbers-wrapper">
                        <?php foreach($forthData as $forthNum) { ?>
                        <span class="top-number-text draw-number"><?=$forthNum?></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="ad-image-wrapper">
                <span class="days-left-count"><?=$daysLeft?></span>
                <img class="ad-image" src="<?=base_url('print-outs-09621/ad-section-678145874jkncvnq41.jpg')?>" alt="">
            </div>
            <h3 class="fifth-price-header">5th Prize Amount for Winner ₹120/- for Seller ₹10/- </h3>
            <div class="section">
                <div class="fifth-numbre-wrapper">
                    <?php foreach ($fifthData as $index => $fifthNum): ?>
                    <?php if ($index % 10 === 0): ?>
                    <div class="fifth-section">
                        <?php endif; ?>

                        <span class="draw-number"><?= htmlspecialchars($fifthNum) ?></span>

                        <?php if (($index + 1) % 10 === 0 || $index + 1 === count($fifthData)): ?>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>


                </div>
            </div>
            <div class="footer">
                <div>
                    <div class="draw-date">
                        <?=$date_short?>
                    </div>
                    <div class="footer-middle-element">
                        <p class="text">TDS 2% Under Section 194G shall be deducted on Sellers Prize Amount w.e.f. 1st
                            October</p>
                    </div>
                    <div class="footer-middle time-on"><?=$time?></div>
                    <div class="footer-middle-element right">
                        <p class="text">Please check the results <br>with relevent Official Government<br> Gazatte</p>
                    </div>
                    <div class="draw-date right">
                        <?=$date_short?>
                    </div>
                </div>

                <img class="footer-image" src="<?=base_url()?>assets/images/image(3).png" alt="">
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script>
        // Function to download as image (targets .page element)
        function downloadAsImage() {
            const pageElement = document.querySelector('.page');

            if (!pageElement) {
                alert('No element with class "page" found!');
                return;
            }

            html2canvas(pageElement, {
                useCORS: true,
                scale: 2, // Higher quality
                backgroundColor: '#ffffff',
                width: pageElement.offsetWidth,
                height: pageElement.offsetHeight
            }).then(canvas => {
                const link = document.createElement('a');
                var time = "<?=$time?>";
                var fileName = generateFileName(time);
                link.download = fileName + '.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            }).catch(error => {
                console.error('Error generating image:', error);
            });
        }

        // Function to download as PDF (targets .page element)
        function downloadAsPDF() {
            const pageElement = document.querySelector('.page');

            if (!pageElement) {
                alert('No element with class "page" found!');
                return;
            }

            html2canvas(pageElement, {
                useCORS: true,
                scale: 2,
                backgroundColor: '#ffffff'
            }).then(canvas => {
                const {
                    jsPDF
                } = window.jspdf;
                const pdf = new jsPDF({
                    orientation: 'p',
                    unit: 'mm',
                    format: 'a4',
                    compress: true
                });

                const imgWidth = 210; // A4 width in mm
                const pageHeight = 297; // A4 height in mm
                const imgHeight = (canvas.height * imgWidth) / canvas.width;

                pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, imgWidth, imgHeight);
                var time = "<?=$time?>";
                var fileName = generateFileName(time);
                pdf.save(fileName + '.pdf');
            }).catch(error => {
                console.error('Error generating PDF:', error);
            });
        }

        function generateFileName(timeString) {
            const now = new Date();

            // Get date in dd-mm-yyyy format
            const day = String(now.getDate()).padStart(2, '0');
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
            const year = now.getFullYear();

            // Clean and format the time string (optional: lowercase and no spaces)
            const timeFormatted = timeString.toLowerCase().replace(/\s+/g, '');

            // Combine all into the desired format
            return `result-${day}-${month}-${year}_${timeFormatted}`;
        }

        // Function to download both at once
        function downloadBoth() {
            downloadAsImage();
            setTimeout(() => {
                downloadAsPDF();
            }, 1000); // Small delay to prevent conflicts            
        }

        function generateBoth() {
            setTimeout(() => {
                generateAndUpload()
            }, 2000);
        }

        const resultId = "<?=$resultId?>";

        async function generateAndUpload() {
            const pageElement = document.querySelector('.page');
            const generateBtn = document.getElementById('generateBtn');

            if (!pageElement) {
                alert('No element with class "page" found!');
                return;
            }

            // ⏳ Set loading state
            const originalBtnText = generateBtn.innerHTML;
            generateBtn.disabled = true;
            generateBtn.innerHTML = 'Processing...';

            const time = "<?=$time?>"; // Or replace with actual time if dynamic from JS
            const fileName = generateFileName(time);

            try {
                const canvas = await html2canvas(pageElement, {
                    useCORS: true,
                    scale: 2,
                    backgroundColor: '#ffffff'
                });

                const pngDataUrl = canvas.toDataURL('image/png');
                const pngBlob = dataURLtoBlob(pngDataUrl);

                const {
                    jsPDF
                } = window.jspdf;
                const pdf = new jsPDF({
                    orientation: 'p',
                    unit: 'mm',
                    format: 'a4',
                    compress: true
                });
                const imgWidth = 210;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                pdf.addImage(pngDataUrl, 'PNG', 0, 0, imgWidth, imgHeight);
                const pdfBlob = pdf.output('blob');

                const formData = new FormData();
                formData.append('png_file', pngBlob, fileName + '.png');
                formData.append('pdf_file', pdfBlob, fileName + '.pdf');
                formData.append('result_id', resultId);

                const response = await fetch('<?=base_url()?>save-lottery-files', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();
                console.log('Upload result:', result);

                if (response.ok) {
                    alert('Files uploaded successfully!');
                } else {
                    alert('Upload failed. Please check console.');
                }
            } catch (error) {
                console.error('Error in generateAndUpload:', error);
                alert('Something went wrong during generation or upload.');
            } finally {
                // ✅ Revert button to original state
                generateBtn.disabled = false;
                generateBtn.innerHTML = originalBtnText;
            }
        }


        // Utility: Convert DataURL to Blob
        function dataURLtoBlob(dataURL) {
            const arr = dataURL.split(',');
            const mime = arr[0].match(/:(.*?);/)[1];
            const bstr = atob(arr[1]);
            let n = bstr.length;
            const u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new Blob([u8arr], {
                type: mime
            });
        }
        </script>
</body>

</html>