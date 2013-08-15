
wxApp = wxApp || {};

(function($){
    wxApp.FormBuilderSubTabEditView = wxApp.SubTabEditView.extend({
		previewPaneSelector: '.wx-form-builder-preview',

        subTabEditTplSelector: '#form-builder-subtab-edit-template',

        initializeEvents: function() {
            this.events = _.extend({}, this.genericEvents, this.events);
        },

        events: {
            'click .wx-form-builder-add-text-input': 'addTextInput',
			'click .wx-form-builder-add-password-input': 'addPasswordInput',
			'click .wx-form-builder-add-color-input': 'addColorInput',
			'click .wx-form-builder-add-date-input': 'addDateInput',
			'click .wx-form-builder-add-datetime-input': 'addDateTimeInput',
			'click .wx-form-builder-add-datetime-local-input': 'addDateTimeLocalInput',
			'click .wx-form-builder-add-month-input': 'addMonthInput',
			'click .wx-form-builder-add-number-input': 'addNumberInput',
			'click .wx-form-builder-add-tel-input': 'addTelInput',
			'click .wx-form-builder-add-time-input': 'addTimeInput',
			'click .wx-form-builder-add-url-input': 'addUrlInput',
			'click .wx-form-builder-add-week-input': 'addWeekInput',
			'click .wx-form-builder-add-radio-group': 'addRadioGroup'
		},

		addField: function( properties ) {
			var input = new wxApp.FormBuilderControlTextInput( properties );
			var inputView = new wxApp.FormBuilderControlTextInputView({
				model: input
			});
			this.$( this.previewPaneSelector ).append( inputView.render().el );
		},

        addTextInput: function() {
			this.addField({
				input: 'text',
				label: 'Text'
			});
        },

		addPasswordInput: function() {
			this.addField({
				input: 'password',
				label: 'Password'
			});
		},

		addColorInput: function() {
			this.addField({
				input: 'color',
				label: 'Color',
				showPlaceholder: false
			});
		},

		addDateInput: function() {
			this.addField({
				input: 'date',
				label: 'Date'
			});
		},

		addDateTimeInput: function() {
			this.addField({
				input: 'datetime',
				label: 'Date/Time (UTC)'
			});
		},

		addDateTimeLocalInput: function() {
			this.addField({
				input: 'datetime-local',
				label: 'Date/Time'
			});
		},

		addMonthInput: function() {
			this.addField({
				input: 'month',
				label: 'Month'
			});
		},

		addNumberInput: function() {
			this.addField({
				input: 'number',
				label: 'Number'
			});
		},

		addTelInput: function() {
			this.addField({
				input: 'tel',
				label: 'Telephone'
			});
		},

		addTimeInput: function() {
			this.addField({
				input: 'time',
				label: 'Time'
			});
		},

		addUrlInput: function() {
			this.addField({
				input: 'url',
				label: 'URL'
			});
		},

		addWeekInput: function() {
			this.addField({
				input: 'week',
				label: 'Week'
			});
		},

		addRadioGroup: function() {
			var radioGroup = new wxApp.FormBuilderControlRadioGroup();
//			var radio = new wxApp.FormBuilderControlRadio();
//			group.add( radio );
			var radioGroupView = new wxApp.FormBuilderControlRadioGroupView({
				collection: radioGroup
			});
			this.$( this.previewPaneSelector ).append( radioGroupView.render().el );
			radioGroup.add( new wxApp.FormBuilderControlRadio() );
		}

    });
})(jQuery);