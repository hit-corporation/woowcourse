'use strict';
const navBottom = document.querySelector('#nav-bottom');
const floatingButton = document.querySelector('.floating-button');


(async function(win) {

    win.addEventListener('scroll', e => {
        if(win.scrollY > 300) 
        {
            navBottom.classList.remove('sticky-top')
            navBottom.classList.add('fixed-top', 'bg-white', 'text-dark', 'scrolled', 'material-shadow-1');
            // floaitng button
            floatingButton.classList.add('visible', 'opacity-100');
        }
        if(win.scrollY <= 300)
        {
            navBottom.classList.add('sticky-top')
            navBottom.classList.remove('fixed-top', 'bg-white', 'text-dark', 'scrolled', 'material-shadow-1');
            floatingButton.classList.remove('visible', 'opacity-100');
        }
    });

})(window);