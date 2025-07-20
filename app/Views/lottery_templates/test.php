<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meghalaya State Lottery Ticket</title>

    <!-- Download Button (Only visible on screen, not in print) -->
    <div id="downloadBtn" style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
        <button onclick="downloadImage()"
            style="background: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px;">
            📸 Download Image
        </button>
    </div>

    <script>
    // Get lottery data from sessionStorage or URL parameters
    let lotteryData = {};

    // Try to get from sessionStorage first (from the form)
    const storedData = sessionStorage.getItem('lotteryData');
    if (storedData) {
        lotteryData = JSON.parse(storedData);
    } else {
        // Fallback: get from URL parameters or set default data
        const urlParams = new URLSearchParams(window.location.search);
        lotteryData = {
            date: urlParams.get('date') || '28-11-2024',
            time: urlParams.get('time') || '1pm',
            drawNumber: urlParams.get('drawNumber') || '35th',
            priceAmount: urlParams.get('priceAmount') || '75',
            priceUnit: urlParams.get('priceUnit') || 'LAKH',
            lotteryNumbers: [{
                number: '83A 37900',
                copies: 50
            }]
        };
    }

    // Determine day/night theme and colors
    const dayNight = lotteryData.time === '8pm' ? 'NIGHT' : 'DAY';
    const themeColor = lotteryData.time === '8pm' ? '#e53e3e' : '#128933';

    // Set CSS custom property
    document.documentElement.style.setProperty('--lottery-theme', themeColor);

    // Function to get day name from date
    function getDayName(dateString) {
        const date = new Date(dateString);
        const days = ['SUNDAY', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY'];
        return days[date.getDay()];
    }

    // Function to format date
    function formatDate(dateString) {
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}-${month}-${year}`;
    }

    // Function to format time
    function formatTime(timeString) {
        return timeString === '8pm' ? '08:00 P.M.' : '01:00 P.M.';
    }

    // Function to generate tickets HTML
    function generateTicketsHTML() {
        let ticketsHTML = '';
        const formattedDate = formatDate(lotteryData.date);
        const dayName = getDayName(lotteryData.date);
        const formattedTime = formatTime(lotteryData.time);

        lotteryData.lotteryNumbers.forEach(lottery => {
            for (let i = 0; i < lottery.copies; i++) {
                ticketsHTML += `
                        <div class="ticket">
                            <img class="background-img" src="assets/images/auguas-map.png" alt="">
                            <div class="ticket-header">
                                <div class="" style="display: flex; justify-content: space-between">
                                    <div class="logo">
                                        <img src="assets/images/brand-logo.png" alt="">
                                    </div>
                                    <div class="ticket-number">${lottery.number}</div>
                                </div>
                                <div class="draw-info">
                                    <p class="info-drawno">${lotteryData.drawNumber} DRAW ON</p>
                                    <p class="info-draw-date">${formattedDate}</p>
                                    <p class="info-time">${formattedTime}</p>
                                    <p class="onwards">ONWARDS</p>
                                    <p class="info-draw-day">${dayName}</p>
                                </div>
                                <div class="info-right">
                                    <div class="lottery-name">MEGHALAYA STATE LOTTERY</div>
                                    <div class="singham-title">SINGHAM</div>
                                    <div class="subtitle">JACKPOT ${dayNight} DAILY LOTTERY</div>
                                </div>
                            </div>
                            <div class="main-content">
                                <div class="prize-section-wrapper">
                                    <div class="prize-label">
                                        <div>
                                            <div class="prize-label-text">1st <br>Prize</div>
                                            <div class="prize-symbol">₹</div>
                                        </div>
                                    </div>
                                    <div class="prize-amount">${lotteryData.priceAmount} ${lotteryData.priceUnit}</div>
                                    <div class="multiplier">X ${lottery.copies}</div>
                                </div>
                                <div class="lower-bottom-section">
                                    <div class="bottom-section">
                                        <small>${lotteryData.drawNumber} DRAW ON ${formattedDate}</small><br>
                                        <div class="ticket-number">${lottery.number}</div>
                                    </div>
                                    <div class="other-info">
                                        <div class="mrp-box">M.R.P<br>₹ <strong>6/-</strong></div>
                                        <img class="signature" src="assets/images/jbsddbdb-343133.png" alt="">
                                        <div class="last-qr-section">
                                            <div class="qr-section">
                                                <img src="assets/images/web-qr.svg" alt="">
                                            </div>
                                            <div class="bottom-text">
                                                DIRECTOR <br>
                                                MEGHALAYA <br>
                                                STATE<br>
                                                LOTTERY
                                                <div class="border-bottom"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="side-text">SINGHAM ${lotteryData.time === '8pm' ? '8 P.M.' : '1 P.M.'}</div>
                        </div>
                    `;
            }
        });

        return ticketsHTML;
    }

    // Function to download image
    async function downloadImage() {
        // Hide download button temporarily
        const downloadBtn = document.getElementById('downloadBtn');
        downloadBtn.style.display = 'none';

        try {
            // Import html2canvas from CDN
            const script = document.createElement('script');
            script.src = 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js';
            document.head.appendChild(script);

            script.onload = async function() {
                const element = document.querySelector('.container');

                // Configure html2canvas options for better quality
                const canvas = await html2canvas(element, {
                    allowTaint: true,
                    useCORS: true,
                    scale: 2, // Higher resolution
                    width: element.scrollWidth,
                    height: element.scrollHeight,
                    backgroundColor: '#ffffff'
                });

                // Create download link
                const link = document.createElement('a');
                link.download = `lottery_tickets_${new Date().getTime()}.png`;
                link.href = canvas.toDataURL('image/png');

                // Trigger download
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Show download button again
                downloadBtn.style.display = 'block';

                alert('Image downloaded successfully!');
            };

            script.onerror = function() {
                downloadBtn.style.display = 'block';
                alert('Error loading html2canvas library. Please check your internet connection.');
            };

        } catch (error) {
            console.error('Error generating image:', error);
            downloadBtn.style.display = 'block';
            alert('Error generating image. Please try again.');
        }
    }

    // Generate page content when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        const pageContainer = document.querySelector('.page');
        if (pageContainer) {
            pageContainer.innerHTML = generateTicketsHTML();
        }
    });
    </script>

    <style>
    :root {
        --lottery-theme: #128933;
        /* Will be updated by JavaScript */
    }

    @media print {
        #downloadBtn {
            display: none !important;
        }

        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .page {
            width: 209mm;
            min-height: 290mm;
            margin: 0;
            padding: 0;
            border: 1px solid !important;
        }
    }

    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background: white;
    }

    .background-img {
        width: 50mm;
        filter: brightness(0) saturate(100%) invert(85%) sepia(19%) saturate(9%) hue-rotate(314deg) brightness(101%) contrast(95%);
        position: absolute;
        top: -7mm;
        rotate: -35deg;
        left: -8mm;
    }

    .container {
        padding: 10px;
    }

    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 5mm;
        box-sizing: border-box;
        border: 1px solid;
        margin-inline: auto;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10mm;
        align-content: start;
        justify-items: start;
        padding-left: 10mm;
    }

    .ticket {
        width: 75mm;
        height: 47mm;
        background: #f5f5f5;
        border-left: 3mm solid var(--lottery-theme);
        border-right: 8mm solid var(--lottery-theme);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .ticket-header {
        color: white;
        padding: 2mm;
        padding-inline: 1mm;
        padding-bottom: 1.5mm;
        text-align: center;
        position: relative;
        flex-shrink: 0;
    }

    .ticket-number {
        border: 2.5px solid var(--lottery-theme);
        background: #efefef;
        color: #222;
        font-weight: bold;
        font-size: 5mm;
        padding: 1mm 2mm;
        display: inline-block;
        margin-bottom: 1mm;
        letter-spacing: 1.5mm;
    }

    .logo {
        top: 2mm;
        left: 2mm;
        width: 10mm;
        height: 10mm;
        background: #2d5016;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5mm;
        font-weight: bold;
    }

    .logo img {
        width: 100%;
    }

    .draw-info {
        position: absolute;
        margin: 2mm 0.5mm 0;
        text-align: left;
        line-height: -1;
        z-index: 2;
        width: 20mm;
        top: 11mm;
    }

    .draw-info .info-time {
        margin: 0;
        padding: 0;
        line-height: 1;
        font-size: 2.2mm;
        font-weight: 500;
        color: var(--lottery-theme);
    }

    .draw-info .info-draw-date {
        margin: 0;
        padding: 0;
        line-height: 1;
        font-size: 3.2mm;
        color: #0c1178ff;
    }

    .draw-info .info-drawno {
        margin: 0;
        padding: 0;
        line-height: 1;
        font-size: 2mm;
        font-weight: 600;
        color: #0c1178ff;
    }

    .draw-info .onwards {
        margin: 0;
        padding: 0;
        line-height: 1;
        font-size: 1.7mm;
        font-weight: 600;
        color: var(--lottery-theme);
    }

    .draw-info .info-draw-day {
        margin: 0;
        padding: 0;
        line-height: 1;
        font-size: 2.5mm;
        font-weight: 600;
        color: #0c1178ff;
        margin-left: 1mm;
    }

    .info-right {
        width: 45mm;
        margin-left: auto;
    }

    .lottery-name {
        color: #0c1178ff;
        font-size: 2.5mm;
        padding: 0.5mm 1mm;
        margin: 0;
        font-weight: bold;
        text-align: center;
        word-spacing: 1mm;
        letter-spacing: 0.2mm;
        margin-bottom: -0.5mm;
    }

    .main-content {
        padding-inline: 2mm;
        position: relative;
        display: flex;
    }

    .singham-title {
        background: var(--lottery-theme);
        color: white;
        font-size: 7mm;
        font-weight: 1000;
        text-align: center;
        padding: 0 2mm;
        margin: 0;
        letter-spacing: 0.5mm;
        line-height: 7mm;
    }

    .subtitle {
        background: var(--lottery-theme);
        color: white;
        font-size: 2mm;
        font-weight: 600;
        text-align: center;
        padding-bottom: .5mm;
        margin-bottom: 0;
        letter-spacing: .1mm;
    }

    .prize-section {
        display: flex;
        align-items: center;
        gap: 2.5mm;
        margin-bottom: 3mm;
    }

    .prize-section-wrapper {
        display: flex;
        align-items: baseline;
        height: 5mm;
        min-width: 45mm;
        width: 45mm;
    }

    .prize-label {
        font-size: 1.5mm;
        font-weight: 600;
        width: 4mm;
        position: relative;
        top: -4.2mm;
    }

    .prize-symbol {
        font-size: 3mm;
        color: #222;
    }

    .prize-amount {
        font-size: 7mm;
        font-weight: 1000;
        color: var(--lottery-theme);
        line-height: 0.5;
    }

    .multiplier {
        font-size: 3mm;
        font-weight: bold;
        color: black;
    }

    .other-info {
        margin-top: -0.5mm;
        min-width: 25mm;
        width: 25mm;
    }

    .lower-bottom-section {
        display: flex;
        width: 100%;
    }

    .last-qr-section {
        display: flex;
        margin-top: 2mm;
    }

    .bottom-text {
        font-size: 2mm;
        color: var(--lottery-theme);
        text-align: center;
        margin-left: 2mm;
    }

    .border-bottom {
        width: 100%;
        margin-top: 0.5mm;
        height: 0.7mm;
        background-color: #222;
    }

    .mrp-box {
        background: #ffd700;
        color: black;
        font-size: 2mm;
        font-weight: bold;
        padding: 1mm;
        padding-inline: 3mm;
        border-radius: 5mm;
        text-align: center;
        line-height: 1.1;
        width: 6mm;
    }

    .mrp-box strong {
        font-size: 3mm !important;
        color: var(--lottery-theme);
    }

    .draw-date {
        color: black;
        font-size: 2.2mm;
        margin-bottom: 2mm;
    }

    .bottom-section {
        position: absolute;
        bottom: 0.6mm;
        left: 3mm;
        right: 3mm;
    }

    .bottom-section small {
        font-size: 2mm;
        color: #0c1178ff;
        font-weight: 600;
    }

    .bottom-ticket-number {
        border: 1.5px solid var(--lottery-theme);
        background: white;
        color: var(--lottery-theme);
        font-weight: bold;
        font-size: 3.5mm;
        padding: 1.5mm;
        text-align: center;
        letter-spacing: 0.5mm;
        width: 45mm;
    }

    .qr-section {
        text-align: center;
        width: 13mm;
    }

    .qr-section img {
        width: 100%;
    }

    .qr-code {
        width: 12mm;
        height: 12mm;
        background: black;
        margin-bottom: 0.5mm;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2mm;
    }

    .side-text {
        position: absolute;
        right: 0mm;
        top: 20mm;
        translate: 55%;
        rotate: -90deg;
        color: #ffffffff;
        font-size: 4mm;
        font-weight: 600;
        letter-spacing: 0.5mm;
    }

    .signature {
        position: absolute;
        height: 6mm;
        right: 7mm;
        top: 1mm;
    }

    .ticket:nth-child(11n) {
        margin-top: 20px;
    }

    .ticket:nth-child(12n) {
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="page">
            <!-- Tickets will be dynamically generated here -->
        </div>
    </div>
</body>

</html>