jQuery(document).ready(function($) {
    $.ajax({
        url: ajax_obj.ajax_url,
        method: 'POST',
        data: {
            action: 'get_books',
        },
        success: function(response) {
            console.log(response); 
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
});