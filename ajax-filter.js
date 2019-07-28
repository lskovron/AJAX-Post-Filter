function gon_ajaxPostsFilter() {

        //allow results to be sortable through URL parameters
        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }


        var id = getParameterByName('id');
        var tax = getParameterByName('tax');
        if(id&&tax){
           console.log(id); 
           console.log(tax);

           var grid = jQuery( '#case-studies' );

           // action found in ajax-filter.php
           jQuery.ajax({

                url: gon_js_vars.ajaxurl,
                data: {
                    action: 'gon_posts_filter',
                    id: id,
                    tax: tax
                },
                dataType: 'json',
                type: 'POST',
                nonce: gon_js_vars.nonce,
                success: function(response) {

                    grid.html( response );

                },
                error: function(response) {

                    grid.html( response );

                },
                cache: false

            });

       }
        
        // run the same AJAX query if a sidebar category is clicked
        var filter = jQuery('.case-studies-sidebar').find( '.tax-filter-control');

        filter.on( 'click', function(e) {

            console.log('click');

            var tax_id = jQuery(this).attr( 'data-cat-id' );
            var tax_name = jQuery(this).attr( 'data-tax-name' );

            if( typeof tax_id !== typeof undefined && tax_id !== false ) {

            e.preventDefault();

            var id = jQuery(this).attr( 'data-cat-id' );
            var tax = jQuery(this).attr( 'data-tax-name' );
            var grid = jQuery( '#case-studies' );
    
            // action found in ajax-filter.php
            jQuery.ajax({

                url: gon_js_vars.ajaxurl,
                data: {
                    action: 'gon_posts_filter',
                    id: id,
                    tax: tax
                },
                dataType: 'json',
                type: 'POST',
                nonce: gon_js_vars.nonce,
                success: function(response) {

                    grid.html( response );

                },
                error: function(response) {

                    grid.html( response );

                },
                cache: false

                });

            }

            e.preventDefault();

        });

}

jQuery(document).ready(function(){
    gon_ajaxPostsFilter();    
});
