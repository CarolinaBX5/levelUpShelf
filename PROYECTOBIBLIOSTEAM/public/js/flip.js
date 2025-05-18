    function flipCard() {
        document.getElementById('auth-card').classList.toggle('flipped');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        const navbarMenu = document.querySelector('.navbar-menu');

        mobileMenu.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            navbarMenu.classList.toggle('active');
        });

        const navLinks = document.querySelectorAll('.navbar-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                navbarMenu.classList.remove('active');
            });
        });
    });