document.addEventListener("DOMContentLoaded", function () {
    // Select elements
    const menuBtn = document.querySelector("#menu-btn");
    const closeBtn = document.querySelector("#close-btn");
    const sidebar = document.querySelector("#sidebar");

    if (menuBtn && closeBtn && sidebar) {
        // Toggle sidebar on menu button click
        menuBtn.addEventListener("click", function (event) {
            event.preventDefault();
            sidebar.style.right = "0";  // Show sidebar
        });

        // Close sidebar on close button click
        closeBtn.addEventListener("click", function () {
            sidebar.style.right = "-250px";  // Hide sidebar
        });

        // Close sidebar if user clicks outside
        document.addEventListener("click", function (event) {
            if (!sidebar.contains(event.target) && event.target !== menuBtn) {
                sidebar.style.right = "-250px"; // Hide sidebar
            }
        });
    } else {
        console.error("Sidebar elements not found in the DOM!");
    }
});
