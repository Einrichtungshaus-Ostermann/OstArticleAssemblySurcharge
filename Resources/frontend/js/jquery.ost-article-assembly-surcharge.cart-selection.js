/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Article Assembly Surcharge
 *
 * @package   OstArticleAssemblySurcharge
 *
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

;(function($) {

    // our plugin
    $.plugin( "ostArticleAssemblySurchargeCartSelection", {

        // on initialization
        init: function ()
        {
            // get this
            let me = this;

            // click event for the checkbox
            me._on( me.$el, 'change', $.proxy( me.clickAssembly, me ) );
        },

        // ...
        clickAssembly: function ( event )
        {
            // show loading indicator
            $.loadingIndicator.open();

            // submit the form
            this.$el.closest( "form" ).submit();
        },

        // on destroy
        destroy: function()
        {
            // call the parent
            this._destroy();
        }

    });

    // call our plugin
    $( 'body.is--ctl-checkout .content .row--product input[type="checkbox"].ost-article-assembly-surcharge--checkbox' ).ostArticleAssemblySurchargeCartSelection();

})(jQuery);
