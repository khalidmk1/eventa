/* avatar show image */
var image_avatar = $('#avatar');
$('#image_avatar').on('change', function(){
    var imageURL = URL.createObjectURL(this.files[0]);
    image_avatar.attr('src', imageURL);
});