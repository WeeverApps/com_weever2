
wxApp = wxApp || {};

(function($){
	wxApp.FormBuilderControlTextInputView = wxApp.FormBuilderControlView.extend({

		initialize: function() {
			this.inputTpl = _.template( $('#form-builder-text-input').html() );
			this.model.bind('change', this.render, this);
		},

		render: function() {
			this.$el.html( this.inputTpl( this.model.toJSON() ) );
			return this;
		}

	});
})(jQuery);