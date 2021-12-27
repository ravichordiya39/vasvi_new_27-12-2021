function imagePreview(input, img_id = '', img_err = '') {
    let input_file = input.files[0];

    if (input.files && input_file) {
        let fsize = input_file.size;
        let fname = input_file.name;
        let fextension = fname.split('.').pop();
        let validExtensions = ["jpg" , "jpeg", "png", "bmp", "gif"];
        let reader = new FileReader();

        if ($.inArray(fextension, validExtensions) == -1) {
            $('#'+img_err).css('display', 'block').html('Only photo is allowed');
            input.value = "";
            $('#'+img_id).css('display', 'block').attr('src', '');
            return false;
        }

        if (fsize > 2097152) {
            $('#'+img_err).css('display', 'block').html('Photo should be less than 2mb');
           input.value = "";
            $('#'+img_id).css('display', 'block').attr('src', '');
           return false;
        }

        $('#'+img_err).css('display', 'none').html('');

        reader.onload = function(e) {
            $('#'+img_id).css('display', 'block').attr('src', e.target.result);
        }

        reader.readAsDataURL(input_file);

        return true;
    } else {
        $('#'+img_id).css('display', 'none').attr('src', '');
    }
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode < 48 || charCode > 57) {
        return false;
    }

    return true;
}

function isFloat(evt) {
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode < 46 || charCode > 57) {
        return false;
    }

    if ((charCode == 46 && evt.target.value.split('.').length > 1) || charCode == 47) {
        return false;
    }

    return true;
}
