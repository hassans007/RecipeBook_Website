document.addEventListener("DOMContentLoaded", () => {
    const navList = document.querySelector("#navList-mobile");
    const openIcon = document.querySelector("#openIcon-mobile");
    const closeIcon = document.querySelector("#closeIcon-mobile");

    function toggleNav() {
        console.log("Toggle function triggered");
        navList.classList.toggle("hide-mobile");
        openIcon.classList.toggle("hide-mobile");
        closeIcon.classList.toggle("hide-mobile");
        console.log("navList classes:", navList.classList);
    }

    openIcon.addEventListener("click", toggleNav);
    closeIcon.addEventListener("click", toggleNav);
});
