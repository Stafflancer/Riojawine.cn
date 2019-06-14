/*! ===================================
 *  Author: Daniel Pataki
 *  -----------------------------------
 *  Improved & optimized by WPHunters
 *  ===================================
 */

(function($){

    $(document).on( 'change', '.acfgfs-font-family select', function(){
        var new_font = $(this).val();
        var container = $(this).parents('.acf-input:first');
        var variants = container.find( '.acfgfs-font-variants .acfgfs-list' );
        var subsets = container.find( '.acfgfs-font-subsets .acfgfs-list' );
        var data = container.find( '.acfgfs-font-data').val();

        $.ajax({
            url: ajaxurl,
            type: 'post',
            dataType: 'json',
            beforeSend: function() {
                container.find( '.acfgfs-loader').show();
            },
            data: {
                action: 'acfgfs_get_font_details',
                font_family: new_font,
                data: data
            },
            success: function( response ) {
                container.find( '.acfgfs-loader').hide();
                variants.html( response.variants );
                subsets.html( response.subsets );

                var preview_text = $('.acfgfs-preview div', container).html();
                var font = new_font.replace( ' ', '+' );

                container.find('.acfgfs-preview').html('<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=' + font + '"><div style="font-family:' + new_font + '"></div>');
                $('.acfgfs-preview div', container).html(preview_text);

            }
        });
    });

})(jQuery);
