(function(root, document, $) {
	'use strict';
	var app = {
		init : function() {
			this.win = $(window);
			this.doc = $(document);
			this.body = $('body');



			for (var name in this) {
				if (typeof(this[name].init) === 'function') {
					this[name].init();
				}
			}
		},
		test_func : {
			init : function() {
				console.log('Test init!');
			}
		},

		menuFunctions : {
			init : function() {
				$('.navbar-toggle').click(function() {
				  //$('.site-nav').toggleClass('site-nav--open', 500);
				  $(this).toggleClass('open');
					$('.navbar-collapse').toggleClass('collapse');
				});

			}
		},

		lightbox :  {
			init : function() {

				$('.gallery-photos a').fancybox();

			}
		}
	};


	// publish
	root.app = app;
	// init
	$( root ).ready(function() {
		app.init();
	});
})(window, document, jQuery);
