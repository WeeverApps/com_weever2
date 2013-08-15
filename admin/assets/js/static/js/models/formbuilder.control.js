
wxApp = wxApp || {};

(function($){

	wxApp.FormBuilderControl = Backbone.Model.extend({

		// http://documentcloud.github.com/backbone/#Model-defaults
		defaults: function() {
			return {
				type: '',
				hidePlaceholderClass: '',
				showPlaceholder: true
			};
		},

		initialize: function() {
			this.togglePlaceholder();
			this.on( 'change:showPlaceholder', this.togglePlaceholder );
		},

		togglePlaceholder: function() {
			if ( this.get( 'showPlaceholder' ) === false ) {
				this.set( 'hidePlaceholderClass', 'wx-hide' );
			}
		}
	});

})(jQuery);