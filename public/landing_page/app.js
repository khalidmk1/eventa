





$(document).ready(function () {
    // avatar show image 
    var image_avatar = $('#avatar');
    $('#formFileSm').on('change', function () {
        var imageURL = URL.createObjectURL(this.files[0]);
        image_avatar.attr('src', imageURL);
    });
    $('#add_file').on('change', function () {
        var imageURL = URL.createObjectURL(this.files[0]);
        image_avatar.attr('src', imageURL);
    });

    //randome color
    var random_color = ['btn-primary', 'btn-secondary', 'btn-success', 'btn-danger', 'btn-warning', 'btn-info', 'btn-dark'];

    $('.randomcolor').each(function (i, el) {
        var randomIndex = Math.floor(Math.random() * random_color.length);
        var randomClass = random_color[randomIndex];

        $(el).addClass(randomClass);
    });



    // mask phone number 
    var phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,5})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });


    //  show and hide passwords 

    const togglePasswords = document.querySelectorAll('.toggle-password');
    togglePasswords.forEach(togglePassword => {
        togglePassword.addEventListener('click', () => {
            const passwordField = togglePassword.previousElementSibling; // Select the preceding input field
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye-slash');
        });
    });




    // show and hide the sign up input 
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
        var loginTab = $('#pills-home-tab');
        var loginTabContent = $('#pills-home');
        var signupTab = $('#pills-profile-tab');
        var signupTabContent = $('#pills-profile');
        var cardBorder = $('#card_style');

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response.message);

                // Handle success
                handleSuccess(response, loginTab, loginTabContent, signupTab, signupTabContent, cardBorder);
            },
            error: function (error) {
                console.log(error);

                // Handle errors
                handleErrors(error);
            }
        });
    });

    function handleSuccess(response, loginTab, loginTabContent, signupTab, signupTabContent, cardBorder) {
        $('#ajax-errors-container').empty();
        $('#ajax-errors-container').append('<div class="alert alert-success alert-dismissible fade show w-25 m-auto mt-2" role="alert"><strong>' + response.message + '</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

        // Activate the login tab
        activateTab(loginTab, loginTabContent);

        // Deactivate the signup tab
        deactivateTab(signupTab, signupTabContent);

        // Toggle the card border style based on the active tab
        toggleCardBorderStyle(loginTabContent, cardBorder);

        // Reset the form
        $('#register_user')[0].reset();
    }

    function handleErrors(error) {
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

    function activateTab(tab, tabContent) {
        tab.addClass('active');
        tabContent.addClass('show');
        tabContent.addClass('active');
    }

    function deactivateTab(tab, tabContent) {
        tab.removeClass('active');
        tabContent.removeClass('show');
        tabContent.removeClass('active');
    }

    function toggleCardBorderStyle(activeTabContent, cardBorder) {
        if (activeTabContent.hasClass('active')) {
            cardBorder.addClass('style_card_singup');
        } else {
            cardBorder.removeClass('style_card_singup');
        }
    }


});

$(document).ready(function () {







    // Variables of the inputs
    var tagsToSections = {
        'Sports': $('#sport_tag'),
        'Conferences': $('#Conferences_tag'),
        'Expos': $('#expos_tag'),
        'Concerts': $('#concerts_tag'),
        'Festivals': $('#Festivals_tag'),
        'Performing arts': $('#Performing_arts_tag'),
        'Community': $('#Community_tag')
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
                section.find('input[type=checkbox]').prop('checked', false);
            }
        });


    });
    var selectedTags = []; // Declare selectedTags in a higher scope

    // Attach a change event listener to checkboxes
    $('.checked_tag').on('change', function () {
        // Fetch selected checkbox values
        selectedTags = [];
        $('.checked_tag:checked').each(function () {
            selectedTags.push($(this).val());
        });

    });


    var selectedCategorie = [];

    $('.checked_categorie').on('change', function () {

        selectedCategorie = [];
        $('.checked_categorie:checked').each(function () {
            selectedCategorie.push($(this).val());
        });

    });



    var city;

    $('#city').on('change', function () {
        city = $(this).val();
    });

    $('#search_forme').submit(function (e) {
        e.preventDefault();
        var title = $('#title').val();
        var url_location = $(location).attr('href');

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: {
                'title': title,
                'categorie': selectedCategorie,
                'tags': selectedTags,
                'city': city
            },
            success: function (data) {
   

                /* console.log(data[2].event_id); */

                $('.all_content').hide();

                $('.event_conatine').empty();

                var output = ' ';


                if (data.length > 0) {

                    data[0].forEach(event => {
                        const extension = event.video.split('.').pop().toLowerCase();


                        output += `
        <div class="col">
            <div class="card h-100 shadow-lg border-0 mb-5 p-0 rounded">
                <div class="position-relative">
                    <span class="position-absolute price">Free</span>`;

                    output +=`  <form action="/folow/${event.slug}" method="post"
                    data-id="${event.id}" class="event_folow">`

                    if(data[1] == true){

                        console.log('hello');

                        /* for (let i = 0; i < data[2].length; i++) {
                            const element = data;
                            console.log(element);
                            if (element) {
                                output += `<i class="fa-solid fa-heart position-absolute p-2"
                                    id="heart_${event.id}"
                                    style="right: 0 ; font-size: 30px ; color: red ; z-index: 1000;"></i>`;
                            } else {
                                output += `<i class="fa-regular fa-heart position-absolute p-2"
                                    id="heart_${event.id}"
                                    style="right: 0 ; font-size: 30px ; color: red ; z-index: 1000;"></i>`;
                            }
                            
                        } */
                       
                        
                    }else{
                        output +=`  <i class="fa-regular fa-heart position-absolute p-2"
                        id="heart_${event.id}"
                        style="right: 0 ; font-size: 30px ; color: red ; z-index: 1000;"></i>
                        `
                    }

                    output +=`</form>`

                        if (['mp4', 'avi', 'mov'].includes(extension)) {
                            output += `
            <video class="card-img-top about_vid w-100" autoplay loop muted>
                <source src="/storage/event/video/${event.video}" type="video/mp4">
            </video>`;
                        } else if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                            output += `<img src="/storage/event/image/${event.video}" class="card-img-top about_img" alt="Skyscrapers"/>`;
                        }

                        output += `
                </div>
                <div class="card-body">
                    <h5 class="card-title">${event.title}</h5>
                    <p class="card-text">${event.description.length > 200 ? event.description.substring(0, 200) + ' ...' : event.description}</p>
                </div>
                <div class="text-center">
                <a class="btn btn-info w-25 mb-2" href="/event/${event.slug}">detail -></a>
                </div>`;

                output +=`<div class="card-footer border-0 text-center">`

                var categorie = event.categorie



                categorie.forEach(element => {
                    output +=`
                    
                    <small class="text-muted categorie-tag">${ element }</small>
                  
                    `;
                });

               
               
               

                output +=`  </div>
                 </div>
                </div>`;
           

                        $('.event_conatine').append(output);
                        output = ' '

                    });


                }



            },
            error: function (error) {
                console.log(error);

            }
        });
    });



})

$(document).ready(function () {
    $(document).on('click', '.event_folow', function (e) {
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var btn = $('.folow_btn');
        var dataId = $(this).data("id");

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN // Include CSRF token in the headers
            },
            success: function (data) {

                var hearts = $('#heart_' + dataId);
                /* console.log(hearts); */
                if (data === "folow true") {
                    hearts.each(function () {
                        $(this).removeClass('fa-regular').addClass('fa-solid');
                    });
                    btn.hide();
                }
                if (data === "folow false") {
                    hearts.each(function () {
                        $(this).removeClass('fa-solid').addClass('fa-regular');
                    });
                    btn.show();
                }

                if (data === "folow created") {
                    hearts.each(function () {
                        $(this).removeClass('fa-regular').addClass('fa-solid');
                    });
                    btn.hide();
                }

                if (data === "please you need to be authenticated") {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 'slow');
                    $('.message_container').append('<div class="alert alert-primary alert-dismissible fade show w-100 m-auto mt-2" role="alert"><strong>' + data + " " + '<a href="/login" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Login</a>' + '</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }

            },
            error: function (error) {
                console.log(error);

            }


        })

    })



})












