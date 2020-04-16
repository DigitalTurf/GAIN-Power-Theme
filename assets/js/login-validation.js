jQuery(document).ready(function(){
    jQuery('#username2').on('input', function(){
        $username = jQuery(this);

        if(!isAlphaNumeric($username.val())) {
            $username.css('background-color', '#F2DEDE');
            jQuery('#lp_usr_reg_btn').attr('disabled', 'true');
            jQuery('.status').html('');
            jQuery('.alphanum-error').addClass('show');
        }else{
            $username.css('background-color', 'white');
            jQuery('#lp_usr_reg_btn').removeAttr('disabled');
            jQuery('.alphanum-error').removeClass('show');
        }
    });
});

function isAlphaNumeric(str) {
    var code, i, len;

    for (i = 0, len = str.length; i < len; i++) {
        code = str.charCodeAt(i);
            if (!(code > 47 && code < 58) && // numeric (0-9)
            !(code > 64 && code < 91) && // upper alpha (A-Z)
            !(code > 96 && code < 123)) { // lower alpha (a-z)
        return false;
        }
    }
    return true;
};