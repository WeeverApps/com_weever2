// views/formbuilder.contro.radio.group.js

wxApp = wxApp || {};

(function($){
	wxApp.FormBuilderControlRadioGroupView = wxApp.FormBuilderControlView.extend({

		initialize: function() {
			console.log('radio group view init');
			this.template = _.template( $('#form-builder-radio-group').html() );
			this.collection.bind('add', this.addOne, this);
		},

		render: function() {
			console.log('radio group view render');
			this.$el.html( this.template() );
			return this;
		},

		addOne: function( radio ) {
			console.log('radio group view add');
			var view = new wxApp.FormBuilderControlRadioView({ model: radio });
			this.$('.wx-form-builder-radio-group').append( view.render().el );
		}

	});
})(jQuery);
