document.addEventListener('DOMContentLoaded', () => {
    const dropdownToggle = document.getElementById('dropdown-toggle');
    const userMenu = document.getElementById('user-menu');

    // Toggle visibility of the user-menu on click
    dropdownToggle.addEventListener('click', () => {
        const isMenuVisible = userMenu.style.display === 'block';
        userMenu.style.display = isMenuVisible ? 'none' : 'block';
    });

    // Hide the user-menu when clicking outside
    document.addEventListener('click', (event) => {
        if (!dropdownToggle.contains(event.target) && !userMenu.contains(event.target)) {
            userMenu.style.display = 'none';
        }
    });
});
