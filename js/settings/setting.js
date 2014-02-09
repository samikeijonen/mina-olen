( function( $ ) {

	$('html').addClass('js');
	
		/* Menu primary sub menu toggle. */
		
		$('#menu-primary .menu-item-has-children').children('a').after('<span class="sub-menu-indicator"></span>');
	  
		var $menu = $('#menu-primary-search'),
			$menulink = $('.nav-toggle'),
			$menuTrigger = $('.menu-item-has-children .sub-menu-indicator');
		
		$menulink.click(function(e) {
			e.preventDefault();
			$menulink.toggleClass('opened');
			$menu.toggleClass('opened');
		});
		
		$menuTrigger.click(function(e) {
			e.preventDefault();
			var $this = $(this);
			$this.toggleClass('opened').next('ul').toggleClass('opened');
		});
		
		/* Toggle search. */
		
		$('#menu-primary .toggle-search').click(
			function() {
				$('#menu-primary .toggle-search-form').toggleClass('add-width'); // Add class to add width
				$('#menu-primary .search-form').toggleClass('add-width'); // Add class to open width
			}
		);
		
		/* Back to top. */
		$('.back-to-top').click(function() {
			$('html,body').animate({scrollTop: 0},600);
			return false;
		});
		
		/* Add primary menu bottom border. */
		
		$( '#menu-primary li.menu-item-has-children' ).hover(
			function() {
				$( '.bottom-line' ).addClass( 'hover' ); // Add hover class when hovering
			}, function() {
				$( '.bottom-line' ).removeClass( 'hover' ); // Remove hover class when hovering stops
			}
		);
		
		$( '#menu-primary li.menu-item-has-children' ).hover(
			function() {
				$( '.bottom-line' ).css( 'height', $('ul.sub-menu', this ).outerHeight() ); // Calculate height of on sub UL element
			}, function() {
				$( '.bottom-line' ).css( 'height', '' ); // Remove inline style
			}
		);
		
		/* Adds <span class="screen-reader-text"> on social icon elements. */
		$( '.menu .social-icon a' ).wrapInner( '<span class="screen-reader-text" />' );
		
		/* Headroom. */
		$( '#menu-primary' ).headroom( {
			"tolerance": 5,
			"offset": 205,
			classes : {
				// when element is initialised
				initial : "fixed",
				// when scrolling up
				pinned : "slideUp",
				// when scrolling down
				unpinned : "slideDown"
			}
		
		});
		
		/* Fitvids. */
		 $("#container").fitVids();

} )( jQuery );