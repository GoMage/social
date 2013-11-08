/**
 * GoMage Social Connector Extension
 *
 * @category     Extension
 * @copyright    Copyright (c) 2013 GoMage (http://www.gomage.com)
 * @author       GoMage
 * @license      http://www.gomage.com/license-agreement/  Single domain license
 * @terms of use http://www.gomage.com/terms-of-use
 * @version      Release: 1.1.0
 * @since        Class available since Release 1.1.0
 */

GomageSicialClass = Class.create({

    config: null,
    gs_overlay: null,

    initialize: function (config) {
        this.gs_overlay = $('gomage-social-overlay');
        if (!this.gs_overlay) {
            var element = $$('body')[0];
            this.gs_overlay = $(document.createElement('div'));
            this.gs_overlay.id = 'gomage-social-overlay';
            document.body.appendChild(this.gs_overlay);

            var offsets = element.cumulativeOffset();
            this.gs_overlay.setStyle({
                'top': offsets[1] + 'px',
                'left': offsets[0] + 'px',
                'width': element.offsetWidth + 'px',
                'height': screen.height + 'px',
                'position': 'absolute',
                'display': 'none',
                'zIndex': '2000'
            });
        }


        },


    sendEmail : function(email, url) {

        var gsForm = new VarienForm('gs-validate-detail', true);

        if (gsForm.validator && gsForm.validator.validate()) {
            $('gs-please-wait').show();
            $('gs-message').innerHTML = '';
            var params = {
                'email' : email
            };

            var request = new Ajax.Request(url, {
                method : 'POST',
                parameters : params,
                loaderArea : false,
                onSuccess : function(transport) {
                    var response = eval('(' + (transport.responseText || false)
                        + ')');
                    if(response.error){
                        $('gs-message').innerHTML = response.error;
                    }
                    if(response.success){
                        $('gs-popup-content').hide();
                        window.location.replace(location.href);
                    }
                    if(response.redirect){
                        window.location.replace(response.redirect);
                    }
                    $('gs-please-wait').hide();

                }
            });

        }
    },

     id_window: function() {
    var elements = window.parent.document.getElementsByClassName('dialog');
    for (i = 0; i < elements.length; i++){
        id = elements[i].firstChild.id;
        break;
    }
   return id;

},

    createWindow : function (title,width,height)
    {
    win = new Window({
    className:'magento',
    title: title,
    width:width,
    height:height,
        maximizable:false,
        minimizable:false,
        resizable:false,
        draggable:false,
        showEffect:Effect.BlindDown,
        hideEffect:Effect.BlindUp,
        showEffectOptions: {duration: 0.4},
        hideEffectOptions: {duration: 0.4}}
    );
     win.setZIndex(5000);
     return win;
    }




});
