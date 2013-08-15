
wxApp = wxApp || {};

(function($){
    wxApp.FormBuilderSubTab = wxApp.SubTab.extend({
        default_icon_id: 30,
        validateFeed: false,
        typeDescription: 'Form Builder',

        defaults: {
            title: '',
            icon_id: this.default_icon_id,
            type: 'formBuilder',
            content: 'formBuilderContent',
            layout: 'list',
            config: {}
        }
    });

})(jQuery);