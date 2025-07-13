               <!-- tap on top -->
               <div class="go-top">
                   <span class="progress-value">
                       <i class="ti ti-chevron-up"></i>
                   </span>
               </div>

               <!-- Footer Section starts-->
               <footer>
                   <div class="container-fluid">
                       <div class="row">
                           <div class="col-md-9 col-12">
                               <ul class="footer-text">
                                   <li>
                                       <!-- <p class="mb-0">
                        Copyright © 2025 Dev Hunter. All rights reserved 💖
                      </p> -->
                                   </li>
                                   <!-- <li><a href="blank.html#"> V1.0.0 </a></li> -->
                               </ul>
                           </div>
                           <div class="col-md-3">
                               <ul class="footer-text text-end">
                                   <li>
                                       <!-- <a href="mailto:teqlathemes@gmail.com.">
                        Need Help <i class="ti ti-help"></i
                      ></a> -->
                                   </li>
                               </ul>
                           </div>
                       </div>
                   </div>
               </footer>
               <!-- Footer Section ends-->
               </div>
               </div>
               </div>

               <!-- latest jquery-->
               <script src="<?=base_url()?>assets/js/jquery-3.6.3.min.js"></script>

               <!-- Simple bar js-->
               <script src="<?=base_url()?>assets/vendor-assets/simplebar/simplebar.js"></script>
               <!-- phosphor js -->
               <script src="<?=base_url()?>assets/vendor-assets/phosphor/phosphor.js"></script>
               <!-- latest jquery-->
               <script src="<?=base_url()?>assets/vendor-assets/datatable/jquery.dataTables.min.js"></script>
               <!-- data table js-->
               <script>
jQuery(function() {
    jQuery("#example").DataTable();
});
               </script>

               <!-- Bootstrap js-->
               <script src="<?=base_url()?>assets/vendor-assets/bootstrap/bootstrap.bundle.min.js"></script>

               <!-- App js-->
               <script src="<?=base_url()?>assets/js/script.js"></script>

               <!-- Customizer js-->
               <script src="<?=base_url()?>assets/js/customizer.js"></script>
               <script>
function getFormattedDate() {
    const now = new Date();
    const day = now.getDate();
    const month = now.toLocaleString("default", {
        month: "long"
    });
    const year = now.getFullYear();

    const suffix = (day) => {
        if (day > 3 && day < 21) return "th";
        switch (day % 10) {
            case 1:
                return "st";
            case 2:
                return "nd";
            case 3:
                return "rd";
            default:
                return "th";
        }
    };

    return `<span class="text-primary">${day}${suffix(
                    day
                    )}</span> ${month} ${year}`;
}

document.getElementById("date-display").innerHTML = getFormattedDate();
<?php if($title == 'Admin Dashboard') { ?>

function updateClock() {
    const now = new Date();
    const hour = now.getHours();
    const minutes = now.getMinutes();
    const seconds = now.getSeconds();

    const hourHand = document.getElementById("hour");
    const minuteHand = document.getElementById("min");
    const secondHand = document.getElementById("sec");

    const hourDeg = (hour % 12) * 30 + minutes * 0.5;
    const minuteDeg = minutes * 6;
    const secondDeg = seconds * 6;

    hourHand.style.transform = `translate(-50%, -100%) rotate(${hourDeg}deg)`;
    minuteHand.style.transform = `translate(-50%, -100%) rotate(${minuteDeg}deg)`;
    secondHand.style.transform = `translate(-50%, -100%) rotate(${secondDeg}deg)`;
}

// Update clock every second
setInterval(updateClock, 1000);
updateClock();
<?php }else { ?>
$(document).ready(function() {
    // Store used numbers for each section to avoid duplicates
    let usedNumbers = {
        section2: new Set(),
        section3: new Set(),
        section4: new Set(),
        section5: new Set()
    };

    // Helper function to generate random number in range
    function getRandomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    // Helper function to generate unique numbers for a section
    function generateUniqueNumbers(section, count, digits) {
        let numbers = [];
        let attempts = 0;
        const maxAttempts = 1000; // Prevent infinite loops

        while (numbers.length < count && attempts < maxAttempts) {
            let num;
            if (section === 'section5') {
                // For section 5, generate numbers from 0000-9999 (4 digits with leading zeros)
                num = getRandomNumber(0, 9999);
            } else {
                // For other sections, generate based on digit count
                const min = Math.pow(10, digits - 1);
                const max = Math.pow(10, digits) - 1;
                num = getRandomNumber(min, max);
            }

            // Check if number is already used in this section
            if (!usedNumbers[section].has(num)) {
                numbers.push(num);
                usedNumbers[section].add(num);
            }
            attempts++;
        }

        // Sort numbers in ascending order
        return numbers.sort((a, b) => a - b);
    }

    // Section 1 Generator (28V 12345 format)
    $('#generateSection1').click(function() {
        const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const randomLetter = letters[getRandomNumber(0, 25)];
        const randomNumber = getRandomNumber(10000, 99999);
        const result = `${getRandomNumber(10, 99)}${randomLetter} ${randomNumber}`;

        $('.section1-input').val(result);
    });

    // Section 2 Generator (5 digits, 10 numbers)
    $('#generateSection2').click(function() {
        usedNumbers.section2.clear(); // Clear previous numbers
        const numbers = generateUniqueNumbers('section2', 10, 5);

        $('.section2-input').each(function(index) {
            if (index < numbers.length) {
                $(this).val(numbers[index].toString().padStart(5, '0'));
            }
        });
    });

    // Section 3 Generator (4 digits, 10 numbers)
    $('#generateSection3').click(function() {
        usedNumbers.section3.clear(); // Clear previous numbers
        const numbers = generateUniqueNumbers('section3', 10, 4);

        $('.section3-input').each(function(index) {
            if (index < numbers.length) {
                $(this).val(numbers[index].toString().padStart(4, '0'));
            }
        });
    });

    // Section 4 Generator (4 digits, 10 numbers)
    $('#generateSection4').click(function() {
        usedNumbers.section4.clear(); // Clear previous numbers
        const numbers = generateUniqueNumbers('section4', 10, 4);

        $('.section4-input').each(function(index) {
            if (index < numbers.length) {
                $(this).val(numbers[index].toString().padStart(4, '0'));
            }
        });
    });

    // Section 5 Generator (4 digits, 100 numbers in ranges)
    $('#generateSection5').click(function() {
        usedNumbers.section5.clear(); // Clear previous numbers
        const numbers = generateUniqueNumbers('section5', 100, 4);

        $('.section5-input').each(function(index) {
            if (index < numbers.length) {
                $(this).val(numbers[index].toString().padStart(4, '0'));
            }
        });
    });

    // Function to get all values from each section as arrays
    function getAllSectionValues() {
        let sectionData = {
            section1: [],
            section2: [],
            section3: [],
            section4: [],
            section5: []
        };

        // Get Section 1 values
        $('.section1-input').each(function() {
            let value = $(this).val().trim();
            if (value !== '') {
                sectionData.section1.push(value);
            }
        });

        // Get Section 2 values
        $('.section2-input').each(function() {
            let value = $(this).val().trim();
            if (value !== '') {
                sectionData.section2.push(value);
            }
        });

        // Get Section 3 values
        $('.section3-input').each(function() {
            let value = $(this).val().trim();
            if (value !== '') {
                sectionData.section3.push(value);
            }
        });

        // Get Section 4 values
        $('.section4-input').each(function() {
            let value = $(this).val().trim();
            if (value !== '') {
                sectionData.section4.push(value);
            }
        });

        // Get Section 5 values
        $('.section5-input').each(function() {
            let value = $(this).val().trim();
            if (value !== '') {
                sectionData.section5.push(value);
            }
        });

        return sectionData;
    }

    // Function to get specific section values
    function getSectionValues(sectionNumber) {
        let values = [];
        $(`.section${sectionNumber}-input`).each(function() {
            let value = $(this).val().trim();
            if (value !== '') {
                values.push(value);
            }
        });
        return values;
    }

    // Function to send data via AJAX
    function sendLotteryData() {
        let allData = getAllSectionValues();

        let data = {
            lottery_data: allData,
            draw_time: $('input[name="select-options"]:checked').next().text()
                .trim(), // Get selected time
            draw_date: $('#date-display').text() // Get current date
        };
        console.log(data);

        // Example AJAX call
        // $.ajax({
        //     url: '<?=base_url()?>save-lottery-results', // Replace with your endpoint
        //     type: 'POST',
        //     data: {
        //         lottery_data: allData,
        //         draw_time: $('input[name="select-options"]:checked').next().text()
        //     .trim(), // Get selected time
        //         draw_date: $('#date-display').text() // Get current date
        //     },
        //     success: function(response) {
        //         console.log('Success:', response);
        //         alert('Lottery results saved successfully!');
        //     },
        //     error: function(xhr, status, error) {
        //         console.log('Error:', error);
        //         alert('Error saving lottery results!');
        //     }
        // });
    }

    // Update the save button to use the new function
    $('#saveLotteryResultBtn, #saveLotteryResultBtnBottom').click(function() {
        sendLotteryData();
    });

    // Optional: Clear all sections
    $('#clearAll').click(function() {
        $('.section1-input, .section2-input, .section3-input, .section4-input, .section5-input').val(
            '');
        // Clear used numbers
        Object.keys(usedNumbers).forEach(section => {
            usedNumbers[section].clear();
        });
    });
});
<?php } ?>
               </script>
               </body>

               </html>