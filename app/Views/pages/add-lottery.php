<!-- Body main section starts -->
<main>
    <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div>
                        <h4 class="main-title">Add Lottery</h4>
                        <ul class="app-line-breadcrumbs mb-3">
                            <li class="">
                                <a class="f-s-14 f-w-500" href="#">
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="active">
                                <a class="f-s-14 f-w-500" href="#">Add Lottery</a>
                            </li>
                        </ul>
                    </div>
                    <button class="btn btn-md btn-primary" id="saveLotteryBtn">Save</button>
                </div>
            </div>
        </div>
        <!-- Breadcrumb end -->

        <!-- Date and Time Selection -->
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between flex-wrap px-2">
                    <div class="mb-2" style="max-width: 200px;">
                        <div class="d-flex align-items-center bg-white p-2 rounded-1 gap-2">
                            <i class="ti ti-calendar text-primary fs-5"></i>
                            <input type="text" class="border-0 bg-transparent text-primary px-2 py-1 fw-bold w-100 m-0"
                                id="select-date-display" />
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="date-time-wrapper text-end">
                            <div class="form-selectgroup">
                                <label class="select-items">
                                    <input checked="" class="select-input" value="1pm" name="select-options"
                                        type="radio" />
                                    <span class="select-box">
                                        <span class="selectitem">
                                            <i class="ti ti-clock"></i> 1 PM Result
                                        </span>
                                    </span>
                                </label>
                                <label class="select-items">
                                    <input class="select-input" value="8pm" name="select-options" type="radio" />
                                    <span class="select-box">
                                        <span class="selectitem">
                                            <i class="ti ti-clock"></i> 8 PM Result
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Basic Details Section start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Basic Details Section</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Draw Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text b-r-left text-bg-primary">
                                            <i class="ti ti-hash"></i>
                                        </span>
                                        <input type="text" class="form-control b-r-right" id="drawNumber"
                                            placeholder="Enter Draw Number" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Price Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text b-r-left text-bg-primary">
                                            <i class="ti ti-currency-rupee"></i>
                                        </span>
                                        <input type="number" class="form-control" id="priceAmount"
                                            placeholder="Enter Amount" />
                                        <div class="input-group-text b-r-right">
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input" type="checkbox" id="priceToggle">
                                                <label class="form-check-label ms-2" for="priceToggle"
                                                    id="priceLabel">Lakh</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Name and State Toggle Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text b-r-left text-bg-primary">
                                            <i class="ti ti-user"></i>
                                        </span>
                                        <input type="text" class="form-control" id="nameDisplay" value="Singham"
                                            readonly />
                                        <div class="input-group-text b-r-right">
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input" type="checkbox" id="nameToggle">
                                                <label class="form-check-label ms-2" for="nameToggle"
                                                    id="nameLabel">Tirupati</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">State</label>
                                    <div class="input-group">
                                        <span class="input-group-text b-r-left text-bg-primary">
                                            <i class="ti ti-map-pin"></i>
                                        </span>
                                        <input type="text" class="form-control" id="stateDisplay" value="Kerala"
                                            readonly />
                                        <div class="input-group-text b-r-right">
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input" type="checkbox" id="stateToggle">
                                                <label class="form-check-label ms-2" for="stateToggle"
                                                    id="stateLabel">Meghalaya</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic Details Section end -->

            <!-- Lottery Numbers Section start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Lottery Numbers Section</h5>
                        <button class="btn btn-sm btn-primary" id="addLotterySection">
                            <i class="ti ti-plus"></i> Add Section
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="lotteryNumbersContainer">
                            <!-- Default section -->
                            <div class="lottery-number-section mb-4" data-section="1">
                                <div class="row align-items-end">
                                    <div class="col-md-5">
                                        <label class="form-label">Lottery Number</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text b-r-left text-bg-primary">
                                                <i class="ti ti-ticket"></i>
                                            </span>
                                            <input type="text" class="form-control lottery-number-input"
                                                placeholder="73H 12345" maxlength="9" />
                                            <button class="btn btn-outline-secondary b-r-right generate-btn"
                                                type="button">
                                                <i class="ti ti-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Number of Copies</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text b-r-left text-bg-primary">
                                                <i class="ti ti-copy"></i>
                                            </span>
                                            <input type="number" class="form-control b-r-right copies-input"
                                                placeholder="1" min="1" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Lottery Numbers Section end -->

            <!-- Save Button -->
            <div class="col-12">
                <div class="text-center">
                    <button class="btn btn-lg btn-primary" id="saveLotteryBtnBottom">Save</button>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Body main section ends -->

<script>
// Initialize date picker with today's date
document.getElementById('select-date-display').value = new Date().toLocaleDateString();

let sectionCounter = 1;

// Toggle price unit
document.getElementById('priceToggle').addEventListener('change', function() {
    const label = document.getElementById('priceLabel');
    label.textContent = this.checked ? 'Crore' : 'Lakh';
});

// Toggle name
document.getElementById('nameToggle').addEventListener('change', function() {
    const display = document.getElementById('nameDisplay');
    const label = document.getElementById('nameLabel');
    if (this.checked) {
        display.value = 'Tirupati';
        label.textContent = 'Singham';
    } else {
        display.value = 'Singham';
        label.textContent = 'Tirupati';
    }
});

// Toggle state
document.getElementById('stateToggle').addEventListener('change', function() {
    const display = document.getElementById('stateDisplay');
    const label = document.getElementById('stateLabel');
    if (this.checked) {
        display.value = 'Meghalaya';
        label.textContent = 'Kerala';
    } else {
        display.value = 'Kerala';
        label.textContent = 'Meghalaya';
    }
});

// Generate random lottery number
function generateLotteryNumber() {
    // Generate 2 random digits
    const digits = Math.floor(Math.random() * 90 + 10);

    // Generate random letter A-Z
    const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const letter = letters.charAt(Math.floor(Math.random() * letters.length));

    // Generate 5 random digits
    const numbers = Math.floor(Math.random() * 90000 + 10000);

    return `${digits}${letter} ${numbers}`;
}

// Add event listeners to generate buttons
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('generate-btn') || e.target.parentElement.classList.contains(
            'generate-btn')) {
        const section = e.target.closest('.lottery-number-section');
        const input = section.querySelector('.lottery-number-input');
        input.value = generateLotteryNumber();
    }
});

// Add new lottery section
document.getElementById('addLotterySection').addEventListener('click', function() {
    sectionCounter++;
    const container = document.getElementById('lotteryNumbersContainer');

    const newSection = document.createElement('div');
    newSection.className = 'lottery-number-section mb-4';
    newSection.setAttribute('data-section', sectionCounter);
    newSection.innerHTML = `
            <div class="row align-items-end">
                <div class="col-md-5">
                    <label class="form-label">Lottery Number</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text b-r-left text-bg-primary">
                            <i class="ti ti-ticket"></i>
                        </span>
                        <input type="text" class="form-control lottery-number-input" placeholder="73H 12345" maxlength="9" />
                        <button class="btn btn-outline-secondary generate-btn" type="button">
                            <i class="ti ti-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Number of Copies</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text b-r-left text-bg-primary">
                            <i class="ti ti-copy"></i>
                        </span>
                        <input type="number" class="form-control copies-input" placeholder="1" min="1" />
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger mb-3 delete-section-btn" type="button">
                        <i class="ti ti-trash"></i> Delete
                    </button>
                </div>
            </div>
        `;

    container.appendChild(newSection);
});

// Delete lottery section
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('delete-section-btn') || e.target.parentElement.classList.contains(
            'delete-section-btn')) {
        const section = e.target.closest('.lottery-number-section');
        section.remove();
    }
});

// Format lottery number input
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('lottery-number-input')) {
        let value = e.target.value.toUpperCase().replace(/[^0-9A-Z\s]/g, '');

        // Remove existing spaces
        value = value.replace(/\s/g, '');

        // Add space after 3rd character if length > 3
        if (value.length > 3) {
            value = value.substring(0, 3) + ' ' + value.substring(3, 9);
        }

        e.target.value = value;
    }
});

// Save lottery function
function saveLottery() {
    const formData = {
        date: document.getElementById('select-date-display').value,
        time: document.querySelector('input[name="select-options"]:checked').value,
        drawNumber: document.getElementById('drawNumber').value,
        priceAmount: document.getElementById('priceAmount').value,
        priceUnit: document.getElementById('priceToggle').checked ? 'Crore' : 'Lakh',
        name: document.getElementById('nameDisplay').value,
        state: document.getElementById('stateDisplay').value,
        lotteryNumbers: []
    };

    // Collect all lottery numbers
    const sections = document.querySelectorAll('.lottery-number-section');
    sections.forEach(section => {
        const lotteryNumber = section.querySelector('.lottery-number-input').value;
        const copies = section.querySelector('.copies-input').value || 1;

        if (lotteryNumber.trim()) {
            formData.lotteryNumbers.push({
                number: lotteryNumber,
                copies: parseInt(copies)
            });
        }
    });

    // Validate form
    if (!formData.drawNumber || !formData.priceAmount || formData.lotteryNumbers.length === 0) {
        alert('Please fill in all required fields');
        return;
    }

    // Store data in sessionStorage for now (you'll replace this with your POST request)
    sessionStorage.setItem('lotteryData', JSON.stringify(formData));

    console.log('Lottery Data:', formData);
    alert('Data saved! Ready to redirect to print page.');
    window.location.href = "<?=base_url('admin/lottery-print')?>";

    // You can replace the above with your actual POST request and redirect logic
    // Example:
    // fetch('/print-lottery', {
    //     method: 'POST',
    //     headers: { 'Content-Type': 'application/json' },
    //     body: JSON.stringify(formData)
    // }).then(response => {
    //     if (response.ok) {
    //         window.location.href = '/print-lottery-page';
    //     }
    // });
}

// Add event listeners to save buttons
document.getElementById('saveLotteryBtn').addEventListener('click', saveLottery);
document.getElementById('saveLotteryBtnBottom').addEventListener('click', saveLottery);
</script>