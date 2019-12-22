$(document).ready(function(e) {

    // Multiply upload image 
    $('.btn-add-image').click(function() {
        var html = $('.copy_form').html();
        $('.add-img').after(html);
    });

    $('body').on('click', '.btn-remove-image', function() {
        $(this).parents('.control-group').remove();
    });

    //Upload Image/s
    $('#form_upload_img').on('submit', function(e) {
        e.PreventDefault();
    });
    //Process data submition
    $.ajax({
        url: '/album',
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,

        success: function(response) {
            $('.success_msg').html(response);
            $('#form_upload_img')[0].reset();
        },
        error: function(response) {
            alert('Error Uploading Image');
        }
    });
});