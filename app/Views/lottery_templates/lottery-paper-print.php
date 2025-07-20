<?php
// Initialize variables with default values
$lotteryData = [];
$drawNumber = '35';
$prizeAmount = '75';
$prizeUnit = 'LAKH';
$drawDate = '28-11-2024';
$drawTime = '01:00 P.M.';
$lotteryType = '1pm';
$dayNight = 'DAY';

// Data will be populated by JavaScript from sessionStorage
// Default values shown above will be replaced by actual form data

// Function to get day name from date
function getDayName($date) {
    if (empty($date)) return 'THURSDAY';
    
    $timestamp = strtotime($date);
    return strtoupper(date('l', $timestamp));
}

// Function to format date
function formatDate($date) {
    if (empty($date)) return '28-11-2024';
    
    $timestamp = strtotime($date);
    return date('d-m-Y', $timestamp);
}

// Function to format time
function formatTime($time) {
    if (empty($time)) return '01:00 P.M.';
    
    $timestamp = strtotime($time);
    return date('h:i A', $timestamp);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meghalaya State Lottery Ticket</title>

    <style>
    :root {
        --lottery-theme: #128933;
        /* Default theme, will be updated by JavaScript */
    }

    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact !important;
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
            /* border: 1px solid #f6f6f6 !important; */
            background: url(<?=base_url('assets/images/1752953987805.jpg')?>);
        }

        .print-controls {
            display: none !important;
        }

        .background-img {
            width: 50mm;
            filter: brightness(0) saturate(100%) invert(85%) sepia(19%) saturate(9%) hue-rotate(314deg) brightness(101%) contrast(95%);
            position: absolute;
            top: -7mm;
            transform: rotate(-35deg);
            left: -8mm;
        }
    }

    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background: white;
    }

    .print-controls {
        position: fixed;
        top: 10px;
        right: 10px;
        z-index: 1000;
        background: white;
        padding: 10px;
        /* border: 1px solid #f6f6f6; */
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .print-controls button {
        margin: 0 5px;
        padding: 8px 16px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .print-controls button:hover {
        background: #0056b3;
    }

    .background-img {
        width: 50mm;
        filter: brightness(0) saturate(100%) invert(85%) sepia(19%) saturate(9%) hue-rotate(314deg) brightness(101%) contrast(95%);
        position: absolute;
        top: -7mm;
        transform: rotate(-35deg);
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
        align-content: center;
        justify-items: start;
        padding-left: 10mm;
        background: url(<?=base_url('assets/images/1752953987805.jpg')?>);
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
        box-shadow: -5px 6px 15px hsl(10deg 13% 0% / 0.38);
        filter: brightness(.6);
    }

    .ticket:nth-child(odd) {
        margin-top: -10px;
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
        padding-top: 1mm;
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
        font-size: 2.5mm;
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
        margin-top: 0;
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
        bottom: 0mm;
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
        transform: rotate(-90deg);
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
    <!-- Print Controls -->
    <div class="print-controls">
        <button onclick="generatePDF()">Generate PDF</button>
        <button onclick="generateImage()">Generate Image</button>
        <button onclick="window.print()">Print</button>
    </div>

    <div class="container">
        <div class="page" id="printPage">
            <!-- Tickets will be generated by JavaScript -->
            <div class="ticket" style="display: none;" id="ticketTemplate">
                <img class="background-img" src="<?=base_url('assets/images/auguas-map.png')?>" alt="">
                <div class="ticket-header">
                    <div class="" style="display: flex; justify-content: space-between">
                        <div class="logo">
                            <img src="<?=base_url('assets/images/brand-logo.png')?>" alt="">
                        </div>
                        <div class="ticket-number lottery-number-display">83A 37900</div>
                    </div>
                    <div class="draw-info">
                        <p class="info-drawno"><span class="draw-number-display">35</span>th DRAW ON</p>
                        <p class="info-draw-date draw-date-display">28-11-2024</p>
                        <p class="info-time draw-time-display">01:00 P.M.</p>
                        <p class="onwards">ONWARDS</p>
                        <p class="info-draw-day draw-day-display">THURSDAY</p>
                    </div>
                    <div class="info-right">
                        <div class="lottery-name">MEGHALAYA STATE LOTTERY</div>
                        <div class="singham-title">SINGHAM</div>
                        <div class="subtitle">JACKPOT <span class="day-night-display">DAY</span> DAILY LOTTERY</div>
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
                        <div class="prize-amount"><span class="prize-amount-display">75</span> <span
                                class="prize-unit-display">LAKH</span></div>
                        <div class="multiplier">X <span class="copies-display">50</span></div>
                    </div>
                    <div class="lower-bottom-section">
                        <div class="bottom-section">
                            <small><span class="draw-number-display">35</span>th DRAW ON <span
                                    class="draw-date-display">28-11-2024</span></small><br>
                            <div class="ticket-number lottery-number-display">83A 37900</div>
                        </div>
                        <div class="other-info">
                            <div class="mrp-box">M.R.P<br>₹ <strong>6/-</strong></div>
                            <img class="signature" src="<?=base_url('assets/images/jbsddbdb-343133.png')?>" alt="">
                            <div class="last-qr-section">
                                <div class="qr-section">
                                    <img src="<?=base_url('assets/images/web-qr.svg')?>" alt="">
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
                <div class="side-text">SINGHAM <span class="side-time-display">1 P.M.</span></div>
            </div>
        </div>
    </div>

    <!-- Include jsPDF and html2canvas libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>
    // Get lottery data from sessionStorage
    let lotteryData = null;

    document.addEventListener('DOMContentLoaded', function() {
        // Retrieve data from sessionStorage
        const storedData = sessionStorage.getItem('lotteryData');

        if (storedData) {
            try {
                lotteryData = JSON.parse(storedData);
                console.log('Retrieved lottery data:', lotteryData);
                generateTickets(lotteryData);
            } catch (e) {
                console.error('Error parsing lottery data:', e);
                showDefaultTicket();
            }
        } else {
            console.log('No lottery data found in sessionStorage');
            showDefaultTicket();
        }
    });

    function generateTickets(data) {
        const printPage = document.getElementById('printPage');
        const template = document.getElementById('ticketTemplate');

        // Clear existing tickets
        printPage.innerHTML = '';

        // Set theme based on time
        const isNight = data.time === '8pm';
        const theme = isNight ? '#e53e3e' : '#128933';
        document.documentElement.style.setProperty('--lottery-theme', theme);

        // Generate tickets for each lottery number
        data.lotteryNumbers.forEach((lottery, index) => {
            const ticket = template.cloneNode(true);
            ticket.style.display = 'flex';
            ticket.id = `ticket-${index}`;

            // Update ticket data
            updateTicketData(ticket, data, lottery);

            printPage.appendChild(ticket);
        });

        // If no lottery numbers, show default
        if (data.lotteryNumbers.length === 0) {
            showDefaultTicket();
        }
    }

    function updateTicketData(ticket, data, lottery) {
        // Update lottery numbers
        ticket.querySelectorAll('.lottery-number-display').forEach(el => {
            el.textContent = lottery.number;
        });

        // Update draw number
        ticket.querySelectorAll('.draw-number-display').forEach(el => {
            el.textContent = data.drawNumber;
        });

        // Update prize amount and unit
        ticket.querySelector('.prize-amount-display').textContent = data.priceAmount;
        ticket.querySelector('.prize-unit-display').textContent = data.priceUnit.toUpperCase();

        // Update copies/multiplier
        ticket.querySelector('.copies-display').textContent = lottery.copies;

        // Update date
        const formattedDate = data.date;
        console.log(data.date);
        ticket.querySelectorAll('.draw-date-display').forEach(el => {
            el.textContent = formattedDate;
        });

        // Update time
        const formattedTime = formatTime(data.time);
        ticket.querySelector('.draw-time-display').textContent = formattedTime;

        // Update day
        const dayName = getDayName(data.date);
        ticket.querySelector('.draw-day-display').textContent = dayName;

        // Update day/night
        const dayNight = data.time === '8pm' ? 'NIGHT' : 'DAY';
        ticket.querySelector('.day-night-display').textContent = dayNight;

        // Update side time
        const sideTime = data.time === '8pm' ? '8 P.M.' : '1 P.M.';
        ticket.querySelector('.side-time-display').textContent = sideTime;
    }

    function showDefaultTicket() {
        const printPage = document.getElementById('printPage');
        const template = document.getElementById('ticketTemplate');

        const defaultTicket = template.cloneNode(true);
        defaultTicket.style.display = 'flex';
        defaultTicket.id = 'default-ticket';

        printPage.innerHTML = '';
        printPage.appendChild(defaultTicket);
    }

    // Utility functions
    function formatDate(dateString) {
        if (!dateString) return '28-11-2024';

        try {
            const date = new Date(dateString);
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        } catch (e) {
            return dateString;
        }
    }

    function formatTime(timeString) {
        if (!timeString) return '01:00 P.M.';

        if (timeString === '1pm') return '01:00 P.M.';
        if (timeString === '8pm') return '08:00 P.M.';

        try {
            const date = new Date(`1970-01-01T${timeString}`);
            return date.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        } catch (e) {
            return timeString;
        }
    }

    function getDayName(dateString) {
        if (!dateString) return 'THURSDAY';

        try {
            const date = new Date(dateString);
            const days = ['SUNDAY', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY'];
            return days[date.getDay()];
        } catch (e) {
            return 'THURSDAY';
        }
    }

    // Function to generate PDF
    function generatePDF() {
        const element = document.getElementById('printPage');

        html2canvas(element, {
            scale: 2,
            useCORS: true,
            allowTaint: true,
            backgroundColor: '#ffffff',
            width: element.offsetWidth,
            height: element.offsetHeight
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jspdf.jsPDF('p', 'mm', 'a4');

            const imgWidth = 210;
            const pageHeight = 295;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            let heightLeft = imgHeight;

            let position = 0;

            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            const filename = 'lottery_tickets_' + new Date().getTime() + '.pdf';
            pdf.save(filename);
        }).catch(error => {
            console.error('Error generating PDF:', error);
            alert('Error generating PDF. Please try again.');
        });
    }

    // Function to generate image
    function generateImage() {
        const element = document.getElementById('printPage');

        html2canvas(element, {
            scale: 2,
            useCORS: true,
            allowTaint: true,
            backgroundColor: '#ffffff',
            width: element.offsetWidth,
            height: element.offsetHeight
        }).then(canvas => {
            const link = document.createElement('a');
            link.download = 'lottery_tickets_' + new Date().getTime() + '.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
        }).catch(error => {
            console.error('Error generating image:', error);
            alert('Error generating image. Please try again.');
        });
    }

    // Print function
    function printPage() {
        window.print();
    }
    </script>
</body>

</html>