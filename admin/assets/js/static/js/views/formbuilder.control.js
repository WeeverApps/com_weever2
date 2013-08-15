
wxApp = wxApp || {};

(function($){
	wxApp.FormBuilderControlView = Backbone.View.extend({
		className: 'wx-form-builder-row',

		events: {
			'click .wx-form-builder-edit-label': 'editLabel',
			'blur .wx-form-builder-label-input': 'updateLabel'
		},

		editLabel: function( ev ) {
			ev.preventDefault();
			this.$label = $( ev.currentTarget );
			this.$( '.wx-form-builder-label-input' ).val( this.$label.text() ).show().select();
			this.$label.hide();
		},

		updateLabel: function(ev) {
			var $me = $( ev.currentTarget );
			this.$label.text( $me.val() ).show();
			$me.hide();
		}

	});
})(jQuery);