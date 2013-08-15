// views/formbuilder.control.radio.js

wxApp = wxApp || {};

(function($){
	wxApp.FormBuilderControlRadioView = wxApp.FormBuilderControlView.extend({
		//className: 'wx-form-builder-radio-group',

		events: {
			'click .wx-form-builder-add-radio': 'addOne'
		},

		initialize: function() {
			this.radioTpl = _.template( $('#form-builder-radio').html() );
			//this.model.bind('change', this.render, this);
		},

		render: function() {
			var html = this.radioTpl( this.model.toJSON() );
			this.$el.append( html );
			return this;
		},

		addOne: function() {
			console.log('radio view add');
			this.model.collection.add( new wxApp.FormBuilderControlRadio() );
			console.log(this.model.collection);
		}

	});
})(jQuery);
