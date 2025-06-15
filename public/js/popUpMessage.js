document.addEventListener('DOMContentLoaded', function() {
                let successMessage = document.getElementById('message');
                if (successMessage) {
                    // Class to make the message visible
                    successMessage.classList.add('show');
    
                    // Remove the message after 2.5 seconds
                    setTimeout(function() {
                        successMessage.classList.remove('show'); // Start fade-out
                        setTimeout(() => successMessage.remove(), 1000); // Remove after fade-out
                    }, 2500);
                }
            });