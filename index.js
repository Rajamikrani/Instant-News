<<<<<<< HEAD
const menubtn = document.querySelector("#menubtn")
      
menubtn.addEventListener('click' , function(){
    const sidebar = document.querySelector("#sidebar_div")
    sidebar.classList.toggle('active');
    this.classList.toggle('fa-bars');
    this.classList.toggle('fa-times');
});

document.addEventListener('click' , function (e) {
    if (!sidebar.contains(e.target) && !menubtn.contains(e.target)) {
        sidebar.classList.remove('active');
        menubtn.classList.add('fa-bars');
        menubtn.classList.remove('fa-times');
    }
});
=======
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
>>>>>>> 76f79100be993b43f49ffc4523ecc7bbb410bedf
