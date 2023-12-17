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
            }
        });


    });




    let tabCounter = 1;


    function addTab() {

        tabCounter++;


        let tabLink = $(`<a class="nav-item nav-link" data-toggle="tab" href="#nav-tab-${tabCounter}" role="tab" aria-controls="nav-tab-${tabCounter}" aria-selected="false">Day ${tabCounter}</a>`);


        let tabContent = $(`
           <div class="tab-pane fade" id="nav-tab-${tabCounter}" role="tabpanel" aria-labelledby="nav-tab-${tabCounter}">
               <button class="close close-tab" type="button" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
               <div class="form-group pt-3">                        
               <textarea name="programme[]" class="form-control" rows="3" placeholder="Programe of the day"></textarea>
             </div>
             
           </div>
       `);

        // Append tab link and content to the respective containers
        $('#nav-tab').append(tabLink);
        $('#nav-tabContent').append(tabContent);

        // Show the newly added tab
        tabLink.tab('show');
    }

    // Event listener for the button click
    $('#addTabBtn').on('click', function () {
        addTab();
    });

    // Event listener for closing a tab
    $('#nav-tabContent').on('click', '.close-tab', function () {
        let tabId = $(this).closest('.tab-pane').attr('id');
        $(`a[href="#${tabId}"]`).remove(); // Remove tab link
        $(`#${tabId}`).remove(); // Remove tab content
        tabCounter--;
    });

});



//create event
$(document).ready(function () {
    $('#store_event').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                /* console.log(data); */

                $('#store_event')[0].reset();

                console.log(response);
            },
            error: function (error) {

                console.log(error);
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





