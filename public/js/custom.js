var SITE_URL_REMOTE = window.location.origin.replace(/\/?$/, '/');

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
$("#traslate-btn").click(function(){
    var g_text = $('#google_text').val();
    if(!$.trim(g_text).length) {
      swal("Required!", "Please enter text to translate!", "error");
    }

    var language = $('#language').find(":selected").val();
    if(!$.trim(language).length) {
      swal("Required!", "Please select language to translate!", "error");
    }
    $.ajax({
            url: SITE_URL_REMOTE + 'google-ajax-form',
            type: "POST",
            dataType: 'json',
            async: false,
            data: {
                'text': g_text,
                'language': language,
                '_token': $('meta[name="_token"]').attr('content')
            },
      success: function (res) {
        if (res['success'] == true) {
          $('#translated_text').val(res['translation']);
        }
      }
    });
});