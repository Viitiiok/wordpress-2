/**
 * USM Theme - navigation.js
 * Gestionarea meniului de navigare pe dispozitive mobile.
 */
( function() {
    var nav = document.getElementById( 'site-navigation' );
    if ( ! nav ) return;

    var button = nav.querySelector( '.menu-toggle' );
    var menu   = nav.querySelector( 'ul' );

    if ( ! button ) {
        button = document.createElement( 'button' );
        button.className   = 'menu-toggle';
        button.textContent = '\u2630 Meniu';
        button.setAttribute( 'aria-controls', 'primary-menu' );
        button.setAttribute( 'aria-expanded', 'false' );
        nav.insertBefore( button, menu );
    }

    if ( ! menu ) return;

    menu.setAttribute( 'aria-expanded', 'false' );

    function toggleMenu() {
        var expanded = 'true' === button.getAttribute( 'aria-expanded' );
        button.setAttribute( 'aria-expanded', String( ! expanded ) );
        menu.setAttribute( 'aria-expanded', String( ! expanded ) );
        nav.classList.toggle( 'toggled' );
    }

    button.addEventListener( 'click', toggleMenu );

    document.addEventListener( 'click', function( event ) {
        if ( ! nav.contains( event.target ) && nav.classList.contains( 'toggled' ) ) {
            toggleMenu();
        }
    } );

    var links = menu.querySelectorAll( 'a' );
    links.forEach( function( link ) {
        link.addEventListener( 'focus', function() {
            var li = this.closest( 'li' );
            while ( li ) {
                li.classList.add( 'focus' );
                li = li.parentElement.closest( 'li' );
            }
        } );
        link.addEventListener( 'blur', function() {
            var li = this.closest( 'li' );
            while ( li ) {
                li.classList.remove( 'focus' );
                li = li.parentElement.closest( 'li' );
            }
        } );
    } );
} )();
