window.addEventListener('scroll', function() {
    const header = document.querySelector('.nav');
    const headerHeight = header.offsetHeight;

    if (window.scrollY > headerHeight && window.innerWidth > 768) {
        header.classList.add('nav-fixed');
    } else {
        header.classList.remove('nav-fixed');
    }
});


function toggleMenu() {
    var menuIcon = document.querySelector('.menu-icon');
    var closeIcon = document.querySelector('.close-icon');
    var nav = document.querySelector('.nav ul');

    nav.classList.toggle('active');
    menuIcon.style.display = nav.classList.contains('active') ? 'none' : 'block';
    closeIcon.style.display = nav.classList.contains('active') ? 'block' : 'none';
}





