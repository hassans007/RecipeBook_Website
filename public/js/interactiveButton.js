document.addEventListener("DOMContentLoaded", () => {
    // Function to display success messages
    const showSuccessMessage = (message) => {
        const messageContainer = document.getElementById("success-message");
        if (messageContainer) {
            messageContainer.textContent = message;
            messageContainer.style.display = "block";
            setTimeout(() => {
                messageContainer.style.display = "none";
            }, 2.500); // Hide message after 2.5 seconds
        }
    };

    // Save button toggle
    const saveForms = document.querySelectorAll(".save-form");
    saveForms.forEach(form => {
        form.addEventListener("submit", e => {
            e.preventDefault();
            const button = form.querySelector(".save-button");
            const isSaving = button.textContent.includes("Remove");

            // Toggle between button 
            button.textContent = isSaving ? "Save Recipe" : "Remove Recipe";

            fetch(form.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccessMessage(data.success); 
                    } else if (data.error) {
                        console.error(data.error);
                    }
                })
                .catch(error => {
                    console.error("Failed to toggle save:", error);
                    button.textContent = isSaving ? "Remove Recipe" : "Save Recipe";
                });
        });
    });
});
