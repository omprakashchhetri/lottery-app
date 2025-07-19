<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lottery Ticket Generator</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 20px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .header {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }

    .header h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .form-section {
        padding: 40px;
        background: #f8f9ff;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 30px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #2d3748;
        font-size: 0.95rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .number-input-section {
        background: white;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        margin-top: 20px;
    }

    .number-input-section h3 {
        color: #2d3748;
        margin-bottom: 0;
        font-size: 1.3rem;
    }

    .number-field-group {
        margin-bottom: 20px;
        padding: 15px;
        background: #f8f9ff;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    .number-input-wrapper {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .number-input {
        flex: 1;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        font-family: 'Courier New', monospace;
        letter-spacing: 1px;
    }

    .number-input:focus {
        outline: none;
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
    }

    .btn-random,
    .btn-remove {
        padding: 10px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        min-width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-random {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .btn-random:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(240, 147, 251, 0.3);
    }

    .btn-remove {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        color: white;
    }

    .btn-remove:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
    }

    .btn-remove:disabled {
        background: #e2e8f0;
        color: #a0aec0;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .number-format-info {
        background: #ebf8ff;
        border-left: 4px solid #3182ce;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
    }

    .number-format-info p {
        color: #2c5282;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 30px;
    }

    .btn {
        padding: 14px 28px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .btn-success {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: white;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(72, 187, 120, 0.3);
    }

    .btn-secondary {
        background: #e2e8f0;
        color: #4a5568;
    }

    .btn-secondary:hover {
        background: #cbd5e0;
    }

    .preview-section {
        display: none;
        padding: 40px;
        background: white;
        border-top: 1px solid #e2e8f0;
    }

    .preview-section.show {
        display: block;
    }

    .preview-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .preview-header h2 {
        color: #2d3748;
        font-size: 1.8rem;
    }

    .ticket-count {
        background: #4299e1;
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
    }

    .tickets-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 20px;
        max-height: 70vh;
        overflow-y: auto;
        padding: 20px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #f7fafc;
    }

    /* Print Styles */
    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            margin: 0;
            padding: 0;
            background: white;
        }

        .container,
        .form-section,
        .preview-header,
        .action-buttons {
            display: none !important;
        }

        .preview-section {
            display: block !important;
            padding: 0 !important;
            background: white !important;
            border: none !important;
        }

        .tickets-container {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 5mm !important;
            max-height: none !important;
            overflow: visible !important;
            padding: 5mm !important;
            border: none !important;
            background: white !important;
            page-break-inside: avoid;
        }

        .ticket {
            page-break-inside: avoid;
            break-inside: avoid;
        }
    }

    /* Lottery Ticket Styles */
    .ticket {
        width: 100%;
        max-width: 350px;
        height: 220px;
        background: #f5f5f5;
        border-left: 4px solid var(--lottery-theme, #128933);
        border-right: 10px solid var(--lottery-theme, #128933);
        position: relative;
        display: flex;
        flex-direction: column;
        font-family: Arial, sans-serif;
        font-size: 10px;
        margin: 0 auto;
    }

    .ticket.night {
        --lottery-theme: #e53e3e;
    }

    .ticket.day {
        --lottery-theme: #128933;
    }

    .ticket-header {
        background: var(--lottery-theme);
        color: white;
        padding: 8px;
        text-align: center;
        position: relative;
        flex-shrink: 0;
    }

    .ticket-top-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .logo {
        width: 30px;
        height: 30px;
        background: #2d5016;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 10px;
        font-weight: bold;
    }

    .ticket-number-top {
        border: 2px solid white;
        background: #efefef;
        color: #222;
        font-weight: bold;
        font-size: 14px;
        padding: 4px 8px;
        letter-spacing: 1px;
    }

    .draw-info {
        position: absolute;
        left: 8px;
        top: 50px;
        text-align: left;
        font-size: 9px;
        line-height: 1.1;
    }

    .lottery-name {
        color: #0c1178ff;
        font-size: 10px;
        font-weight: bold;
        margin-bottom: 4px;
    }

    .singham-title {
        background: var(--lottery-theme);
        color: white;
        font-size: 20px;
        font-weight: 1000;
        text-align: center;
        padding: 0 8px;
        letter-spacing: 1px;
        line-height: 1;
    }

    .subtitle {
        background: var(--lottery-theme);
        color: white;
        font-size: 8px;
        font-weight: 600;
        text-align: center;
        padding: 2px;
        letter-spacing: 0.5px;
    }

    .main-content {
        padding: 12px;
        flex-grow: 1;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .prize-section {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .prize-label {
        font-size: 8px;
        font-weight: 600;
        text-align: center;
        line-height: 1.1;
    }

    .prize-amount {
        font-size: 24px;
        font-weight: 1000;
        color: var(--lottery-theme);
        line-height: 0.8;
    }

    .multiplier {
        font-size: 12px;
        font-weight: bold;
        color: black;
    }

    .right-section {
        text-align: center;
        font-size: 8px;
    }

    .mrp-box {
        background: #ffd700;
        color: black;
        font-size: 8px;
        font-weight: bold;
        padding: 4px 8px;
        border-radius: 4px;
        margin-bottom: 8px;
    }

    .mrp-box strong {
        font-size: 12px;
        color: var(--lottery-theme);
    }

    .bottom-section {
        background: #f0f0f0;
        padding: 8px;
        text-align: center;
        border-top: 1px solid #ddd;
    }

    .bottom-ticket-number {
        border: 1px solid var(--lottery-theme);
        background: white;
        color: var(--lottery-theme);
        font-weight: bold;
        font-size: 12px;
        padding: 4px 8px;
        letter-spacing: 1px;
        margin-top: 4px;
    }

    .side-text {
        position: absolute;
        right: -20px;
        top: 50%;
        transform: rotate(-90deg) translateX(50%);
        color: white;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        white-space: nowrap;
    }

    .error-message {
        background: #fed7d7;
        color: #c53030;
        padding: 12px;
        border-radius: 8px;
        margin-top: 15px;
        display: none;
    }

    .success-message {
        background: #c6f6d5;
        color: #22543d;
        padding: 12px;
        border-radius: 8px;
        margin-top: 15px;
        display: none;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎟️ Lottery Ticket Generator</h1>
            <p>Generate and print lottery tickets with custom numbers and settings</p>
        </div>

        <div class="form-section">
            <form id="ticketForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="lotteryType">Lottery Type</label>
                        <select id="lotteryType" name="lotteryType" required>
                            <option value="">Select Type</option>
                            <option value="1pm">1:00 PM (Day)</option>
                            <option value="8pm">8:00 PM (Night)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="prizeAmount">Prize Amount (in Lakhs)</label>
                        <input type="number" id="prizeAmount" name="prizeAmount" placeholder="e.g., 75" required>
                    </div>

                    <div class="form-group">
                        <label for="drawNumber">Draw Number</label>
                        <input type="number" id="drawNumber" name="drawNumber" placeholder="e.g., 35" required>
                    </div>

                    <div class="form-group">
                        <label for="drawDate">Draw Date</label>
                        <input type="date" id="drawDate" name="drawDate" required>
                    </div>

                    <div class="form-group">
                        <label for="mrpPrice">MRP Price (₹)</label>
                        <input type="number" id="mrpPrice" name="mrpPrice" value="6" required>
                    </div>

                    <div class="form-group">
                        <label for="multiplier">Prize Multiplier</label>
                        <input type="number" id="multiplier" name="multiplier" value="50" required>
                    </div>
                </div>

                <div class="number-input-section">
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                        <h3>Ticket Numbers</h3>
                        <button type="button" id="addNumberField" class="btn btn-primary"
                            style="padding: 8px 16px; font-size: 0.9rem;">
                            ➕ Add Number Field
                        </button>
                    </div>
                    <div class="number-format-info">
                        <p><strong>Number Format Examples:</strong></p>
                        <p>• Single numbers: 83A 37900, 83A 37901, 83A 37902</p>
                        <p>• Range format: 83A 37900-37950 (generates 51 tickets)</p>
                        <p>• Format: [2 digits][1 letter] [5 digits] (e.g., 45A 12345)</p>
                    </div>

                    <div id="numberFieldsContainer">
                        <div class="number-field-group">
                            <div class="form-group">
                                <label>Ticket Numbers or Ranges</label>
                                <div class="number-input-wrapper">
                                    <input type="text" class="number-input" placeholder="45A 12345 or 45A 12345-12355"
                                        required>
                                    <button type="button" class="btn-random" title="Generate Random Number">🎲</button>
                                    <button type="button" class="btn-remove" title="Remove Field">❌</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="submit" class="btn btn-primary">
                        🎫 Generate Tickets
                    </button>
                    <button type="button" id="downloadBtn" class="btn btn-success" style="display: none;">
                        📥 Download PDF
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        🔄 Reset Form
                    </button>
                </div>

                <div class="error-message" id="errorMessage"></div>
                <div class="success-message" id="successMessage"></div>
            </form>
        </div>

        <div class="preview-section" id="previewSection">
            <div class="preview-header">
                <h2>Generated Tickets</h2>
                <div class="ticket-count" id="ticketCount">0 tickets</div>
                <button type="button" id="printBtn" class="btn btn-primary">
                    🖨️ Print Tickets
                </button>
            </div>
            <div class="tickets-container" id="ticketsContainer">
                <!-- Generated tickets will appear here -->
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>
    class LotteryTicketGenerator {
        constructor() {
            this.form = document.getElementById('ticketForm');
            this.previewSection = document.getElementById('previewSection');
            this.ticketsContainer = document.getElementById('ticketsContainer');
            this.ticketCount = document.getElementById('ticketCount');
            this.errorMessage = document.getElementById('errorMessage');
            this.successMessage = document.getElementById('successMessage');
            this.downloadBtn = document.getElementById('downloadBtn');
            this.printBtn = document.getElementById('printBtn');

            this.generatedTickets = [];
            this.initEventListeners();
        }

        initEventListeners() {
            this.form.addEventListener('submit', (e) => this.handleFormSubmit(e));
            this.downloadBtn.addEventListener('click', () => this.downloadPDF());
            this.printBtn.addEventListener('click', () => this.printTickets());
            this.form.addEventListener('reset', () => this.handleReset());

            // Add number field functionality
            document.getElementById('addNumberField').addEventListener('click', () => this.addNumberField());

            // Initialize with event delegation for dynamic elements
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('btn-random')) {
                    this.generateRandomNumber(e.target);
                }
                if (e.target.classList.contains('btn-remove')) {
                    this.removeNumberField(e.target);
                }
            });
        }

        handleFormSubmit(e) {
            e.preventDefault();
            this.hideMessages();

            try {
                const formData = this.getFormData();
                const tickets = this.parseTicketNumbers(formData.ticketNumbers);

                if (tickets.length === 0) {
                    throw new Error('No valid ticket numbers found');
                }

                this.generatedTickets = tickets;
                this.renderTickets(formData, tickets);
                this.showSuccess(`Successfully generated ${tickets.length} tickets`);

            } catch (error) {
                this.showError(error.message);
            }
        }

        getFormData() {
            const data = new FormData(this.form);
            const formData = Object.fromEntries(data.entries());

            // Collect all ticket numbers from individual input fields
            const numberInputs = document.querySelectorAll('.number-input');
            const ticketNumbers = [];

            numberInputs.forEach(input => {
                if (input.value.trim()) {
                    ticketNumbers.push(input.value.trim());
                }
            });

            formData.ticketNumbers = ticketNumbers.join('\n');

            // Add computed day name
            const date = new Date(formData.drawDate);
            const dayNames = ['SUNDAY', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY'];
            formData.dayName = dayNames[date.getDay()];

            return formData;
        }

        parseTicketNumbers(numbersText) {
            const lines = numbersText.trim().split('\n').filter(line => line.trim());
            const tickets = [];

            for (let line of lines) {
                line = line.trim();
                if (!line) continue;

                // Check for range format (e.g., "83A 37900-37910")
                const rangeMatch = line.match(/^(\w+)\s+(\d+)-(\d+)$/);
                if (rangeMatch) {
                    const [, prefix, start, end] = rangeMatch;
                    const startNum = parseInt(start);
                    const endNum = parseInt(end);

                    if (startNum > endNum) {
                        throw new Error(`Invalid range: ${line} (start > end)`);
                    }

                    for (let i = startNum; i <= endNum; i++) {
                        tickets.push(`${prefix} ${i.toString().padStart(start.length, '0')}`);
                    }
                } else {
                    // Single ticket number
                    const singleMatch = line.match(/^(\w+)\s+(\d+)$/);
                    if (singleMatch) {
                        tickets.push(line);
                    } else {
                        throw new Error(`Invalid ticket format: ${line}`);
                    }
                }
            }

            return tickets;
        }

        renderTickets(formData, tickets) {
            const timeDisplay = formData.lotteryType === '8pm' ? '08:00 P.M.' : '01:00 P.M.';
            const dayNight = formData.lotteryType === '8pm' ? 'NIGHT' : 'DAY';
            const themeClass = formData.lotteryType === '8pm' ? 'night' : 'day';

            // Format date for display
            const date = new Date(formData.drawDate);
            const formattedDate = date.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            }).replace(/\//g, '-');

            let html = '';

            tickets.forEach(ticketNumber => {
                html += this.generateTicketHTML(formData, ticketNumber, {
                    timeDisplay,
                    dayNight,
                    themeClass,
                    formattedDate
                });
            });

            this.ticketsContainer.innerHTML = html;
            this.ticketCount.textContent = `${tickets.length} ticket${tickets.length !== 1 ? 's' : ''}`;
            this.previewSection.classList.add('show');
            this.downloadBtn.style.display = 'flex';
        }

        generateTicketHTML(formData, ticketNumber, displayData) {
            return `
                    <div class="ticket ${displayData.themeClass}">
                        <div class="ticket-header">
                            <div class="ticket-top-row">
                                <div class="logo">ML</div>
                                <div class="ticket-number-top">${ticketNumber}</div>
                            </div>
                            <div class="draw-info">
                                <p><strong>${formData.drawNumber}th DRAW ON</strong></p>
                                <p><strong>${displayData.formattedDate}</strong></p>
                                <p>${displayData.timeDisplay}</p>
                                <p><small>ONWARDS</small></p>
                                <p><strong>${formData.dayName}</strong></p>
                            </div>
                            <div style="text-align: right; flex: 1; margin-left: 60px;">
                                <div class="lottery-name">MEGHALAYA STATE LOTTERY</div>
                                <div class="singham-title">SINGHAM</div>
                                <div class="subtitle">JACKPOT ${displayData.dayNight} DAILY LOTTERY</div>
                            </div>
                        </div>
                        
                        <div class="main-content">
                            <div class="prize-section">
                                <div class="prize-label">
                                    1st<br>Prize<br>₹
                                </div>
                                <div class="prize-amount">${formData.prizeAmount} LAKH</div>
                                <div class="multiplier">X ${formData.multiplier}</div>
                            </div>
                            
                            <div class="right-section">
                                <div class="mrp-box">
                                    M.R.P<br>₹ <strong>${formData.mrpPrice}/-</strong>
                                </div>
                                <div style="font-size: 8px; margin-top: 8px;">
                                    DIRECTOR<br>
                                    MEGHALAYA<br>
                                    STATE<br>
                                    LOTTERY
                                </div>
                            </div>
                        </div>
                        
                        <div class="bottom-section">
                            <div style="font-size: 8px; color: #0c1178ff; font-weight: 600;">
                                ${formData.drawNumber}th DRAW ON ${displayData.formattedDate}
                            </div>
                            <div class="bottom-ticket-number">${ticketNumber}</div>
                        </div>
                        
                        <div class="side-text">SINGHAM ${formData.lotteryType === '8pm' ? '8 P.M.' : '1 P.M.'}</div>
                    </div>
                `;
        }

        async downloadPDF() {
            try {
                const {
                    jsPDF
                } = window.jspdf;
                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: 'a4'
                });

                const tickets = document.querySelectorAll('.ticket');
                let isFirstPage = true;

                for (let i = 0; i < tickets.length; i++) {
                    const ticket = tickets[i];

                    // Add new page for every ticket after the first
                    if (!isFirstPage && i % 8 === 0) {
                        pdf.addPage();
                    }

                    const canvas = await html2canvas(ticket, {
                        scale: 3,
                        useCORS: true,
                        allowTaint: true,
                        backgroundColor: '#ffffff'
                    });

                    const imgData = canvas.toDataURL('image/jpeg', 1.0);

                    // Calculate position for 2x4 grid
                    const col = i % 2;
                    const row = Math.floor((i % 8) / 2);
                    const x = col * 100 + 5;
                    const y = row * 60 + 10;

                    pdf.addImage(imgData, 'JPEG', x, y, 90, 50);
                    isFirstPage = false;
                }

                const date = new Date().toISOString().split('T')[0];
                pdf.save(`lottery-tickets-${date}.pdf`);

            } catch (error) {
                this.showError('Error generating PDF: ' + error.message);
            }
        }

        printTickets() {
            window.print();
        }

        handleReset() {
            this.previewSection.classList.remove('show');
            this.downloadBtn.style.display = 'none';
            this.hideMessages();
            this.generatedTickets = [];

            // Reset to single number field
            const container = document.getElementById('numberFieldsContainer');
            container.innerHTML = `
                    <div class="number-field-group">
                        <div class="form-group">
                            <label>Ticket Numbers or Ranges</label>
                            <div class="number-input-wrapper">
                                <input type="text" class="number-input" placeholder="45A 12345 or 45A 12345-12355" required>
                                <button type="button" class="btn-random" title="Generate Random Number">🎲</button>
                                <button type="button" class="btn-remove" title="Remove Field">❌</button>
                            </div>
                        </div>
                    </div>
                `;
            this.updateRemoveButtonsState();
        }

        showError(message) {
            this.errorMessage.textContent = message;
            this.errorMessage.style.display = 'block';
            this.successMessage.style.display = 'none';
        }

        showSuccess(message) {
            this.successMessage.textContent = message;
            this.successMessage.style.display = 'block';
            this.errorMessage.style.display = 'none';
        }

        hideMessages() {
            this.errorMessage.style.display = 'none';
            this.successMessage.style.display = 'none';
        }

        addNumberField() {
            const container = document.getElementById('numberFieldsContainer');
            const fieldCount = container.children.length;

            const fieldGroup = document.createElement('div');
            fieldGroup.className = 'number-field-group';
            fieldGroup.innerHTML = `
                    <div class="form-group">
                        <label>Ticket Numbers or Ranges</label>
                        <div class="number-input-wrapper">
                            <input type="text" class="number-input" placeholder="45A 12345 or 45A 12345-12355">
                            <button type="button" class="btn-random" title="Generate Random Number">🎲</button>
                            <button type="button" class="btn-remove" title="Remove Field">❌</button>
                        </div>
                    </div>
                `;

            container.appendChild(fieldGroup);
            this.updateRemoveButtonsState();
        }

        removeNumberField(button) {
            const fieldGroup = button.closest('.number-field-group');
            const container = document.getElementById('numberFieldsContainer');

            if (container.children.length > 1) {
                fieldGroup.remove();
                this.updateRemoveButtonsState();
            }
        }

        updateRemoveButtonsState() {
            const removeButtons = document.querySelectorAll('.btn-remove');
            const shouldDisable = removeButtons.length <= 1;

            removeButtons.forEach(button => {
                button.disabled = shouldDisable;
            });
        }

        generateRandomNumber(button) {
            const input = button.parentElement.querySelector('.number-input');
            const randomNumber = this.createRandomTicketNumber();
            input.value = randomNumber;

            // Add a small animation to show the number was generated
            input.style.background = '#e6fffa';
            setTimeout(() => {
                input.style.background = 'white';
            }, 500);
        }

        createRandomTicketNumber() {
            // Generate 2 random digits (10-99)
            const digits = Math.floor(Math.random() * 90) + 10;

            // Generate 1 random letter (A-Z)
            const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const letter = letters[Math.floor(Math.random() * letters.length)];

            // Generate 5 random digits (10000-99999)
            const numbers = Math.floor(Math.random() * 90000) + 10000;

            return `${digits}${letter} ${numbers}`;
        }
    }

    // Initialize the application
    document.addEventListener('DOMContentLoaded', () => {
        const generator = new LotteryTicketGenerator();

        // Initialize remove buttons state on page load
        generator.updateRemoveButtonsState();
    });
    </script>
</body>

</html>