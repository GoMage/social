/**
 * GoMage Social Connector Extension
 *
 * @category     Extension
 * @copyright    Copyright (c) 2013 GoMage (http://www.gomage.com)
 * @author       GoMage
 * @license      http://www.gomage.com/license-agreement/  Single domain license
 * @terms of use http://www.gomage.com/terms-of-use
 * @version      Release: 1.1
 * @since        Class available since Release 1.1
 */

GomageSicialClass = Class.create({

    sendEmail : function(email, url) {
        $('social-please-wait').show();
        if(this.isValidEmail(email) == false){
            if($('gsc_message')){
                $('gsc_message').innerHTML = 'Please enter a valid email address. For example johndoe@domain.com.';
            } $('social-please-wait').hide();
        }else{
            $('gsc_message').innerHTML = '';
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
                        $('gsc_message').innerHTML = response.error;
                    }
                    if(response.success){
                        $('gs-popup-content').hide();
                        window.location.replace(location.href);
                    }
                    if(response.redirect){
                        window.location.replace(response.redirect);
                    }
                    $('social-please-wait').hide();

                }
            });

        }
    },

    isValidEmail : function (v)
    {
        if(v == ''){
            return false;
        }
        return Validation.get('IsEmpty').test(v) || /^([a-z0-9,!\#\$%&'\*\+\/=\?\^_`\{\|\}~-]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z0-9,!\#\$%&'\*\+\/=\?\^_`\{\|\}~-]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*@([a-z0-9-]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z0-9-]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*\.(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]){2,})$/i.test(v)
    },

    createWindow : function (title,width,height)
    {
    win = new Window({
    className:'magento',
    title: title,
    width:width,
    height:height,
    minimizable:false,
    maximizable:false,
    showEffectOptions:{duration:0.4},
    hideEffectOptions:{duration:0.4}});

     return win;
    }




});
