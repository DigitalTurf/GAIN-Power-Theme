jQuery(document).ready(function(){
    if(jQuery(".siginupcontainer").length){
        jQuery("#check_policy").click(function(){
            if(jQuery(this).is(':checked')){
                jQuery("#lp_usr_reg_btn").attr("disabled", false);
                jQuery(".siginupcontainer .social-login").addClass("visible");
                jQuery(".siginupcontainer .check-notification").addClass("hide");
                jQuery(".siginupcontainer").removeClass("grayout");
            } else {
                jQuery(".siginupcontainer").addClass("grayout");
                jQuery("#lp_usr_reg_btn").attr("disabled", true);
                jQuery(".siginupcontainer .social-login").removeClass("visible");
                jQuery(".siginupcontainer .check-notification").removeClass("hide");
            }
        });
    }
});
