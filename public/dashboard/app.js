$(document).ready(function () {

    /*  show and hide passwords */
    const togglePasswords = document.querySelectorAll('.toggle-password');
    togglePasswords.forEach(togglePassword => {
        togglePassword.addEventListener('click', () => {
            const passwordField = togglePassword.previousElementSibling; // Select the preceding input field
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye-slash');
        });
    });


    // show avatar image 
    var image_avatar = $('#avatar');
    $('#add_file').on('change', function () {
        var imageURL = URL.createObjectURL(this.files[0]);
        image_avatar.attr('src', imageURL);
    });

    // Variables of the inputs
    var tagsToSections = {
        'Sports': $('#sport_tag'),
        'Conferences': $('#Conferences_tag'),
        'Expos': $('#expos_tag'),
        'Concerts': $('#concerts_tag'),
        'Festivals': $('#Festivals_tag'),
        'Performing arts': $('#Performing_arts_tag'),
        'Community': $('#Community_tags')
    };

    Object.values(tagsToSections).forEach(section => section.hide());

    $('.checked').on('change', function () {
        var checkedValues = [];


        $('.checked:checked').each(function () {
            checkedValues.push($(this).val());
        });



        Object.entries(tagsToSections).forEach(([tag, section]) => {
            if (checkedValues.indexOf(tag) !== -1) {
                section.slideDown();
            } else {
                section.slideUp();
                section.find('select').val(null).trigger('change'); // Clear select inputs
                section.find('input[type=text]').val(''); // Clear text inputs
            }
        });


    });





});

function addProgramme() {
    let newProgramme = `
        <div class="col-4 days">
            <div class="card border-primary mb-3" style="max-width: 50rem;">
                <div class="card-header align-items-center justify-content-between d-flex">

                <span>Day ${$('.days').length + 2}</span> 
                <i class="fa fa-trash trash_icon remove-programme" aria-hidden="true"></i>   
                <i class="fa fa-plus card_add border border-dark  add-programme"></i>

                </div>

                <div class="card-body">
                    <div class="form-group">
                        <textarea  name="programme[]" class="form-control" rows="6"></textarea>
                    </div>
                </div>
            </div>
        </div>`;

    // Remove existing add-programme button
    $('.add-programme').remove();

    $('#programmeContainer').append(newProgramme);

}

// Event listener for adding a new programme
$(document).on('click', '.add-programme', function () {
    addProgramme();
});

// Event listener for removing a programme
$(document).on('click', '.remove-programme', function () {
    $(this).closest('.days').remove();

    // Update the day numbers after removal
    $('.days').each(function (index) {
        $(this).find('.card-header span').text(`Day ${index + 2}`);
    });

    // Check if there are any remaining .days, if not, append the button to the last card-header
    if ($('.days').length !== 0) {
        let addButton = '<i class="fa fa-plus card_add border border-dark add-programme "></i>';
        $('#programmeContainer .card-header').last().append(addButton);
    }
    if ($('.days').length === 0) {
        let addButton = '<i class="fa fa-plus card_add border border-dark add-programme"></i>';
        $('#programmeContainer .card-header').last().append(addButton);
    }


});












//create event
$(document).ready(function () {

    $('#store_event').submit(function (e) {
        e.preventDefault();
        $('#exampleModalCenter').modal('show')
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                setTimeout(function () {
                    $('#exampleModalCenter').modal('hide')
                    location.reload(); // Reload the page after success
                 }, 1000);

                $('html, body').animate({ scrollTop: 0 }, 'slow');
                $('.days').remove();

                if ($('.days').length === 0) {
                    let addButton = '<i class="fa fa-plus card_add border border-dark add-programme"></i>';
                    $('#programmeContainer .card-header').last().append(addButton);
                }


                $('#store_event')[0].reset();

                var seccuss;
                if (response.message === "The date is invalid") {
                    seccuss = `<div class="col-6 alert alert-danger alert-dismissible ml-2 text-center fade show danger_alert" role="alert">
                        <strong>${response.message}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`;
                } else {
                    seccuss = `<div class="col-6 alert alert-success alert-dismissible ml-2 text-center fade show danger_alert" role="alert">
                        <strong>${response.message}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`;
                }


                $('#message_containe').append(seccuss);
                console.log(response);
            },
            error: function (error) {

                setTimeout(function () {
                   $('#exampleModalCenter').modal('hide')
                   
                }, 1000);

                console.log(error);
                $('html, body').animate({ scrollTop: 0 }, 'slow');
                if (error.responseJSON.errors) {


                    $.each(error.responseJSON.errors, function (key, value) {
                        console.log(value);
                        var error = `<div class="col-6 alert alert-danger alert-dismissible ml-2 text-center fade show  danger_alert " role="alert">
                                        <strong>${value}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>`;
                        $('#message_containe').append(error);
                    });
                }


            }

        });
    });




});

//play with image and video
$(document).ready(function () {
    var video = $('#myVideo');
    video.hide();

    var image = $('#Myimage');
    image.hide();

    $('#add_file').on('change', function () {
        // Get the video element    
        var videoFile = $(this)[0].files[0];

        var scene = $('.scene');
        scene.hide();

        // Get uploaded file extension
        var extension = $(this).val().split('.').pop().toLowerCase();
        var validFileExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];

        if ($.inArray(extension, validFileExtensions) == -1) {
            // Create a URL for the selected file
            var videoURL = URL.createObjectURL(videoFile);

            // Set the video source to the URL
            video.attr('src', videoURL);

            // Load and play the video
            video[0].load();
            video[0].play();
            video.show();
            image.hide();
        } else {
            var imageURL = URL.createObjectURL(videoFile);

            // Set the image source to the URL
            image.attr('src', imageURL);

            image.show();
            video.hide();
        }
    });
});





