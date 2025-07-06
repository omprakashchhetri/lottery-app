 <footer class="site-footer bg-primary p-5 mt-4 border-top inline-gap">
     <p class="text-center font-body text-white draw-terms-para mb-0">
         © 2025 - Meghalaya State Lotteries
     </p>
     <!-- <a
          href="/"
          class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
          aria-label="Bootstrap"
        >
          <svg class="bi me-2" width="40" height="32" aria-hidden="true">
            <use xlink:href="#bootstrap"></use>
          </svg>
        </a> -->
     <!-- <ul class="nav col-md-4 justify-content-end">
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-body-secondary">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-body-secondary">Features</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-body-secondary">Pricing</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-body-secondary">FAQs</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-body-secondary">About</a>
          </li>
        </ul> -->
 </footer>
 </div>

 <script src="assets/plugins/bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js"></script>
 <script src="assets/plugins/jquery/jquery-3.7.1.min.js"></script>
 <script>
jQuery(document).ready(function() {
    jQuery(document).on("click", ".menubar-toggle", function() {
        var expanded = jQuery(this).attr("aria-expanded") === "true";
        if (expanded) {
            jQuery("#mainBody-content").addClass("toggle-show");
            jQuery(".menu-backdrop").show();
        } else {
            jQuery("#mainBody-content").removeClass("toggle-show");
            jQuery(".menu-backdrop").hide();
        }
    });
    // jQuery(document).on("click", ".menu-backdrop", function () {
    //   jQuery(".menubar-toggle").trigger("click");
    // });
});
 </script>
 </body>

 </html>