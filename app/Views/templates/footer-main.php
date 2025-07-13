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
               <script src="<?=base_url()?>assets/vendor/simplebar/simplebar.js"></script>
               <!-- phosphor js -->
               <script src="<?=base_url()?>assets/vendor/phosphor/phosphor.js"></script>
               <!-- latest jquery-->
               <script src="<?=base_url()?>assets/vendor/datatable/jquery.dataTables.min.js"></script>
               <!-- data table js-->
               <script>
jQuery(function() {
    jQuery("#example").DataTable();
});
               </script>

               <!-- Bootstrap js-->
               <script src="<?=base_url()?>assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>

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
               </script>
               </body>

               </html>