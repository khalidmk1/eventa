/* avatar show image */
var image_avatar = $('#avatar');
$('#add_file').on('change', function () {
    var imageURL = URL.createObjectURL(this.files[0]);
    image_avatar.attr('src', imageURL);
});

/* mask phone number */
var phoneInput = document.getElementById('phone');
phoneInput.addEventListener('input', function (e) {
    var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,5})/);
    e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
});

$(document).ready(function () {
    var adresse = $('#Adresse_hd');
    var organizationName = $('#organizationName');
    var organizationLink = $('#organizationLink');

    adresse.hide();
    organizationName.hide();
    organizationLink.hide();

    $('#roleSelect').on('change', function () {
        var conceptName = $(this).val();
        if (conceptName == 'organizer') {
            adresse.slideDown();
            adresse.show();
            organizationName.slideDown();
            organizationLink.slideDown();
        } else {
            adresse.slideUp();
            organizationName.slideUp();
            organizationLink.slideUp();
        }
    });

    $('#pills-tab').on('shown.bs.tab', function (e) {
        var profileTab = $('#pills-profile');
        var card_border = $('#card_style')

        if (profileTab.hasClass('active')) {

            card_border.addClass('style_card_singup')
        } else {

            card_border.removeClass('style_card_singup')
        }
    });

    $('#register_user').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);


        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response.message);
                $('#ajax-errors-container').empty();
                $('#ajax-errors-container').append('<div class="alert alert-success alert-dismissible fade show w-25 m-auto mt-2" role="alert"><strong>' + response.message + '</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

                $('#register_user')[0].reset();
            },
            error: function (error) {

                console.log(error);
                // Clear previous errors
                $('#ajax-errors-container').empty();
                // Append new errors to the container
                if (error.responseJSON && error.responseJSON.errors) {
                    var errors = error.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $('#ajax-errors-container').append('<div class="alert alert-danger alert-dismissible fade show w-25 m-auto mt-2" role="alert"><strong>' + value + '</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    });
                }

            }


        });
    });



});





/* create user */

/*  
 */

