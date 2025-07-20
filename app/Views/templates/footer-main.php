               <!-- tap on top -->
               <div class="go-top">
                   <span class="progress-value">
                       <i class="ti ti-chevron-up"></i>
                   </span>
               </div>

               <!-- Footer Section starts-->
               <footer class="py-1">
                   <div class="container-fluid">
                       <div class="row">
                           <div class="col-md-9 col-12">
                               <ul class="footer-text">
                                   <li>
                                       <small class="mb-0">
                                           Copyright © 2025. All rights reserved.
                                       </small>
                                   </li>
                                   <!-- <li><a href="blank.html#"> V1.0.0 </a></li> -->
                               </ul>
                           </div>
                           <!-- <div class="col-md-3">
                               <ul class="footer-text text-end">
                                   <li>
                                       <a href="#">
                                           Need Help <i class="ti ti-help"></i></a>
                                   </li>
                               </ul>
                           </div>
                       </div> -->
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
               <?php if($title == 'Create Lottery') { ?>
               <script src="<?=base_url('assets/plugins/flatpickr/flatpickr.js')?>"></script>
               <script>
flatpickr('#select-date-display', {
    dateFormat: 'd-m-Y', // Example: 19-07-2025
    defaultDate: 'today', // Optional: sets today's date by default
});
               </script>
               <?php } ?>
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

    return `<span class="text-primary">${day}${suffix(day)}</span> ${month} ${year}`;
}
<?php if($title == 'Admin Dashboard' || $title == 'Add Result') { ?>
document.getElementById("date-display").innerHTML = getFormattedDate();
<?php } ?>
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
$(document).on('change', '.toggle-status', function() {
    const isChecked = $(this).is(':checked') ? 1 : 0;
    const recordId = $(this).data('record');

    $.ajax({
        url: '<?= base_url("update-toggle-status") ?>',
        method: 'POST',
        data: {
            id: recordId,
            status: isChecked
        },
        success: function(response) {
            console.log('Status updated:', response);
            window.location.reload();
        },
        error: function() {
            alert('Failed to update status.');
        }
    });
});
$(document).on('click', '.delete-result-btn', function() {
    const resultId = $(this).data('id');

    if (!confirm('Are you sure you want to delete this result?')) return;

    $.ajax({
        url: '<?= base_url("admin/delete-result") ?>',
        method: 'POST',
        data: {
            id: resultId
        },
        success: function(response) {
            if (response.status === 'success') {
                alert(response.message);
                location.reload(); // or remove DOM element manually
            } else {
                alert('Failed: ' + response.message);
            }
        },
        error: function() {
            alert('Something went wrong while deleting the result.');
        }
    });
});


<?php } ?>
               </script>
               <?php if($title == 'Add Result') { ?>
               <script src="<?=base_url('assets/js/add-result.js')?>"></script>
               <?php } ?>
               </body>

               </html>