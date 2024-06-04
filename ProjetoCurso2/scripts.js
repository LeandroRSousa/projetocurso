//SCRIPT PARA MANTER O MENU DE NAVEGAÇÃO ROLANDO COM A PÁGINA//

window.addEventListener('scroll', function() {
    const header = document.querySelector('.nav');
    const headerHeight = header.offsetHeight;

    if (window.scrollY > headerHeight && window.innerWidth > 768) {
        header.classList.add('nav-fixed');
    } else {
        header.classList.remove('nav-fixed');
    }
});


//SCRIPT PARA MENU HAMBURGUER EM TELAS MENORES//

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
    var elementsToChange = document.querySelectorAll('#intro-msg, h1, h3, h4, #pesquisa-msg, .container-pesquisa, .container-postagens, .comments-section');
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

//Script para pesquisar na página//

document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("search");
    const searchButton = document.getElementById("search-button");

    searchInput.addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            performSearch();
        }
    });

    searchButton.addEventListener("click", performSearch);
});

function performSearch() {
    const searchInput = document.getElementById("search");
    const searchText = searchInput.value.trim().toLowerCase();
    if (searchText) {
        removeHighlights(document.body);  // Limpar destaques anteriores
        highlightWords(document.body, searchText);
    } else {
        removeHighlights(document.body);
    }
}

function highlightWords(element, searchText) {
    let firstHighlightFound = false;  // Variável para controlar a rolagem

    if (element.nodeType === Node.TEXT_NODE) {
        const text = element.textContent;
        const regex = new RegExp(`\\b${searchText}\\b`, 'gi');
        const matches = text.match(regex);

        if (matches) {
            const highlightedText = text.replace(regex, match => `<span class="highlight">${match}</span>`);
            const newElement = document.createElement('span');
            newElement.innerHTML = highlightedText;
            element.replaceWith(newElement);

            if (!firstHighlightFound) {
                firstHighlightFound = true;
                scrollToHighlight(newElement.querySelector('.highlight'));
            }
        }
    } else if (element.nodeType === Node.ELEMENT_NODE) {
        element.childNodes.forEach(child => highlightWords(child, searchText));
    }
}

function scrollToHighlight(element) {
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

function removeHighlights(element) {
    if (element.nodeType === Node.ELEMENT_NODE) {
        element.childNodes.forEach(child => removeHighlights(child));
    } else if (element.nodeType === Node.TEXT_NODE && element.parentNode.matches('.highlight')) {
        const parent = element.parentNode;
        parent.replaceWith(...parent.childNodes);
    }
}
