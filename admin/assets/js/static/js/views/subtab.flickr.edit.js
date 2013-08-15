
wxApp = wxApp || {};

(function($){
    wxApp.FlickrSubTabEditView = wxApp.SubTabEditView.extend({
        subTabEditTplSelector: '#flickr-subtab-edit-template',

        setModelFromView: function(model) {
        	if ( 'flickrPhotosets' == this.$('.wx-content-radio:checked').val() ) {
        		model.set( 'layout', 'list' );
        	}
            model.set( 'content', this.$('.wx-content-radio:checked').val() );
            model.setConfig( 'url', this.$('.wx-edit-input').val() );
            return model;
        },

        initializeEvents: function() {
            this.events = _.extend({}, this.genericEvents, this.events);
        }
    });
})(jQuery);