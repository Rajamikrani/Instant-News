// JavaScript to handle popup visibility
document.addEventListener("DOMContentLoaded", () => {
    const openPopup = document.getElementById("openPopup");
    const popupForm = document.getElementById("popupForm");
    const closePopup = document.querySelector(".close");

    // Open the popup
    openPopup.addEventListener("click", () => {
        popupForm.style.display = "flex";
    });

    // Close the popup
    closePopup.addEventListener("click", () => {
        popupForm.style.display = "none";
    });

    // Close popup if clicking outside the form content
    popupForm.addEventListener("click", (e) => {
        if (e.target === popupForm) {
            popupForm.style.display = "none";
        }
    });
});
