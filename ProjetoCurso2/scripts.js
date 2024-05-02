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


//SCRIPT PARA MUDAR COR DE FUNDO DE CLARO E ESCURO//

function toggleTheme() {
    var body = document.body;
    var elementsToChange = document.querySelectorAll('#intro-msg, h1, h3, h4, #pesquisa-msg, .container-pesquisa');
    var currentTheme = body.getAttribute('data-theme');

    if (currentTheme === 'dark') {
        body.setAttribute('data-theme', 'light');
        body.style.backgroundColor = '#f2f5f8';
        body.style.color = '#000';
        for (var i = 0; i < elementsToChange.length; i++) {
            elementsToChange[i].style.backgroundColor = ''; // Volta para a cor de fundo padrão do CSS
            elementsToChange[i].style.color = ''; // Volta para a cor do texto padrão do CSS
        }
        document.getElementById('tema').innerText = 'Tema Escuro';
    } else {
        body.setAttribute('data-theme', 'dark');
        body.style.backgroundColor = '#222831';
        body.style.color = 'white';
        for (var i = 0; i < elementsToChange.length; i++) {
            elementsToChange[i].style.backgroundColor = '#222831';
            elementsToChange[i].style.color = 'white';
        }
        document.getElementById('tema').innerText = 'Tema Claro';
    }
}




