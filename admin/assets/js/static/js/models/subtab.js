
wxApp = wxApp || {};

(function($){
    wxApp.SubTab = wxApp.Tab.extend({
        defaults: {
            id: null,
            parent_id: null,
            title: '',
            icon_id: 1,
            type: null,
            layout: null,
            typeDescription: '',
            published: 1,
            config: {}
        },

        typeDescription: '',

        validateFeed: true,

        allowTitleEdit: true,

        initialize: function() {
        },

		setConfig: function(key, val) {
			var config = this.getConfig();
			config[key] = val;
            try {
			    this.set('config', config);
            } catch ( e ) {

            }
		},

        deleteConfig: function(key) {
            var config = this.getConfig();
            delete config[key];
            this.set('config', config);
        },

		getConfig: function() {
			return this.get('config');
		},

        getModelName: function() {
            var retVal = false;
            // Use reverse inspection of wxApp
            for ( var name in wxApp ) {
                if ( wxApp[name] == this.constructor ) {
                    retVal = name;
                    break;
                }
            }
            return retVal;
        },

		getAPIData: function() {
			var data = this.toJSON();
			data.config = JSON.stringify(data.config);
            if ( data.id == data.parent_id )
                delete data['parent_id'];
            if ( data.id )
                data.tab_id = data.id;
			return this.filterAPIData( data );
		},

        filterAPIData: function( data ) {
            return data;
        },

        toJSON: function() {
            var retVal = JSON.parse(JSON.stringify(this.attributes));
            retVal.validateFeed = this.validateFeed;
            retVal.typeDescription = this.typeDescription;
            return retVal;
        },

        getValidateFeed: function() {
            return true;
        },

        save: function() {
            var me = this;
            wx.log(me.getAPIData());
            wx.makeApiCall( 'tabs/add_tab', me.getAPIData(), function(data) {
                if ( ! me.get('id') ) {
                    me.set('id', data.tab_id);
                    Backbone.Events.trigger('tab:new', me);
                } else {
                    me.trigger('save', me);
                }
            });
        },

        destroy: function() {
            var me = this;
            wx.makeApiCall('tabs/delete', { tab_id: this.get('id') }, function() {
                me.trigger('destroy');
            });
        }
    });
})(jQuery);