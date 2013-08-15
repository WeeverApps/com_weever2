
wxApp = wxApp || {};

(function($){
    wxApp.App = Backbone.View.extend({
        el: '#toptabs',

        initialize: function() {
            this.allowAddContentButtonsToBeDragged();
            this.allowDroppingOnAddArea();
            Backbone.Events.on( 'api:success', this.highlightAppPreviewRefresh, this );
            Backbone.Events.on( 'subtab:dragstart', this.showDropTab, this );
            Backbone.Events.on( 'subtab:dragstop', this.hideDropTab, this );
            Backbone.Events.on( 'tab:dropped', this.clearBodyStyles, this );
            Backbone.Events.on( 'tab:dropped', this.hideDropTab, this );
        },

        events: {
            'click .wx-add-source-icon': 'addFeature',
            'click #preview-refresh': 'refreshAppPreview'
        },

        allowAddContentButtonsToBeDragged: function() {
            if ( undefined != this.$('list-add-content-items li').draggable ) {
                this.$('.list-add-content-items li').draggable({
                    cursor: "move",
                    cursorAt: { top: 10, left: 10 },
                    helper: function( event ) {
                        return $( "<div class='ui-widget-draggable'>" + $(event.delegateTarget).find('span')[0].innerHTML + "</div>" );
                    },
                    revert: true
                });
            }
        },

        allowDroppingOnAddArea: function() {
            if ( undefined !== this.$('#addFeatureID').droppable ) {
                this.$('#addFeatureID').droppable( {
                    accept: ".list-add-content-items li",
                    hoverClass: "ui-state-hover",
                    drop: this.onDropOnAddArea
                } );
            }
        },

        onDropOnAddArea: function(event, ui) {
            // Using global wxApp.appView since this is the dropped on li
            wxApp.appView.createFeatureView($(ui.draggable).attr('id').replace('add-', ''));
        },

        addFeature: function(ev) {
            this.createFeatureView(ev.currentTarget.id.replace('add-', ''));
        },

        createFeatureView: function(id, parentId) {
            if ( undefined !== wxApp[id + 'SubTab'] && undefined !== wxApp[id + 'SubTabEditView'] ) {
                var tab = new wxApp[id + 'SubTab']();
                if ( undefined != parentId && parentId )
                    tab.set( 'parent_id', parseInt( parentId ) );
                var view = new wxApp[id + 'SubTabEditView']({ model: tab });
            } else {
                throw new Error('Invalid type ' + id);
            }

            this.showEditView(view);
        },

        showEditView: function(view) {
            if ( typeof view !== 'undefined' )
                view.show();
            else
                wx.log('invalid view');
        },

        highlightAppPreviewRefresh: function() {
            $('#preview-refresh').effect('pulsate', { times: 5 }, 6000);
        },

        refreshAppPreview: function() {
            wx.refreshAppPreview();
        },

        showDropTab: function() {
            $('#dropTab').show();
        },

        hideDropTab: function() {
            $('#dropTab').hide();
        },

        clearBodyStyles: function() {
            $('body').attr('style', '');
        }
    });

    wxApp.appView = new wxApp.App();
})(jQuery);