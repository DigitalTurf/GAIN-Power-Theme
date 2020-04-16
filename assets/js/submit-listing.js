var widgetsubmit;
var fd;
var lpcount = 0;
var lpcountsize = 0;
/**
 * Hides donate field if category is Firms and Freelancers or a subcategory of it
 */
jQuery(document).ready(function() {
	jQuery('#inputCategory').on('change.select2', function (e) {
		var selections = jQuery(this).select2('data');
		for(var i = 0; i < selections.length; i++) {
			if (selections[i].text.indexOf('Firms and Freelancers') >= 0 ||
				selections[i].text.indexOf('Communications') >= 0 ||
				selections[i].text.indexOf('Compliance') >= 0 ||
				selections[i].text.indexOf('Digital') >= 0 ||
				selections[i].text.indexOf('Direct Mail') >= 0 ||
				selections[i].text.indexOf('Field') >= 0 ||
				selections[i].text.indexOf('Fundraising') >= 0 ||
				selections[i].text.indexOf('Minority-Owned') >= 0 ||
				selections[i].text.indexOf('Operations') >= 0 ||
				selections[i].text.indexOf('Phones and Texting') >= 0 ||
				selections[i].text.indexOf('Polling') >= 0 ||
				selections[i].text.indexOf('Televison/Media') >= 0 ||
				selections[i].text.indexOf('Women-Owned') >= 0) {
				jQuery('.donate-form-group input').attr('disabled', 'true');
			}
			else {
				jQuery('.donate-form-group input').removeAttr('disabled', 'true');
				break;
			}
		}
		if (selections.length == 0) {
			jQuery('.donate-form-group input').removeAttr('disabled');
		}
	});
});

/**
 * detect IE
 * returns version of IE or false, if browser is not Internet Explorer
 */
function detectIE() {

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }

    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }

    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
       // Edge (IE 12+) => return version number
       return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    }

    // other browser
    return false;
}

function recaptchaCallbackk() {
	if (jQuery('#recaptcha-securet').length) {
		var sitekey = jQuery('#recaptcha-securet').data('sitekey');
		widgetsubmit = grecaptcha.render(document.getElementById('recaptcha-securet'), {
		  'sitekey': sitekey
		});
	}
}

function submitListing($this, fd) {
	jQuery("#listingsubmitBTN").prop('disabled', !0);
	fd.append('action', 'listingpro_custom_submit_listing_ajax');
	if (jQuery('#already-account').is(':checked')) {
		fd.append('processLogin', 'yes')
	} else {
		fd.append('processLogin', 'no')
	}
	var postContent = tinymce.editors.inputDescription.getContent();
	if (postContent != '' || postContent != null || postContent != !1) {
		fd.append('postContent', postContent)
	} else {
		fd.append('postContent', '')
	}
	if ($Alloedimgcount == true) {
		fd.append('imageCount', lpcount)
	}

	jQuery.ajax({
		type: 'POST',
		url: '/wp-admin/admin-ajax.php',
		data: fd,
		contentType: false,
		processData: false,
		success: function(res) {
			if (jQuery('#recaptcha-securet').length) {
				lp_reset_grecaptcha()
			}
			var resp = jQuery.parseJSON(res);
			listing_ajax_response_notice(resp);
			if (resp.response === "fail") {
				jQuery("#listingsubmitBTN").prop('disabled', !1);
				jQuery.each(resp.status, function(k, v) {
					if (k === "postTitle") {
						jQuery("input:text[name='postTitle']").addClass('error-msg')
					} else if (k === "gAddress") {
						jQuery("input:text[name='gAddress']").addClass('error-msg')
					} else if (k === "category") {
						jQuery("#inputCategory_chosen").find('a.chosen-single').addClass('error-msg');
						jQuery("#inputCategory").next('.select2-container').find('.selection').find('.select2-selection--single').addClass('error-msg');
						jQuery("#inputCategory").next('.select2-container').find('.selection').find('.select2-selection--multiple').addClass('error-msg')
					} else if (k === "location") {
						jQuery("#inputCity_chosen").find('a.chosen-single').addClass('error-msg');
						jQuery("#inputCity").next('.select2-container').find('.selection').find('.select2-selection--single').addClass('error-msg');
						jQuery("#inputCity").next('.select2-container').find('.selection').find('.select2-selection--multiple').addClass('error-msg')
					} else if (k === "postContent") {
						jQuery("textarea[name='postContent']").addClass('error-msg');
						jQuery("#lp-submit-form .wp-editor-container").addClass('error-msg')
					} else if (k === "email") {
						jQuery("input#inputEmail").addClass('error-msg')
					} else if (k === "inputUsername") {
						jQuery("input#inputUsername").addClass('error-msg')
					} else if (k === "inputUserpass") {
						jQuery("input#inputUserpass").addClass('error-msg')
					}
				});
				var errorrmsg = jQuery("input[name='errorrmsg']").val();
				$this.find('.preview-section .fa-spinner').removeClass('fa-spinner fa-spin');
				$this.find('.preview-section .fa').addClass('fa-times');
				$this.find('.preview-section').find('.error_box').text(errorrmsg).show();
				jQuery('.bottomofbutton.lpsubmitloading').removeClass('fa-spinner fa-spin');
				jQuery('.bottomofbutton.lpsubmitloading').addClass('fa-times');
				jQuery('.loaderoneditbutton.lpsubmitloading').removeClass('fa-spinner fa-spin');
				jQuery('.loaderoneditbutton.lpsubmitloading').addClass('fa-times');
			} else if (resp.response === "failure") {
				if (jQuery('#already-account').is(':checked')) {
					jQuery('.lp-submit-have-account').append(resp.status)
				} else {
					jQuery("input#inputEmail").after(resp.status);
					jQuery("div#inputEmail").after(resp.status)
				}
				$this.find('.preview-section .fa-spinner').removeClass('fa-spinner fa-spin');
				$this.find('.preview-section .fa').addClass('fa-angle-right');
				jQuery("#listingsubmitBTN").prop('disabled', !1);
				jQuery('.bottomofbutton.lpsubmitloading').removeClass('fa-spinner fa-spin');
				jQuery('.bottomofbutton.lpsubmitloading').addClass('fa-times');
				jQuery('.loaderoneditbutton.lpsubmitloading').removeClass('fa-spinner fa-spin');
				jQuery('.loaderoneditbutton.lpsubmitloading').addClass('fa-times');
			} else if (resp.response === "success") {
				$this.find('.preview-section .fa-spinner').removeClass('fa-times');
				$this.find('.preview-section .fa-spinner').removeClass('fa-spinner fa-spin');
				$this.find('.preview-section .fa').addClass('fa-check');
				jQuery('.bottomofbutton.lpsubmitloading').removeClass('fa-times');
				jQuery('.bottomofbutton.lpsubmitloading').addClass('fa-check');
				jQuery('.loaderoneditbutton.lpsubmitloading').removeClass('fa-spinner fa-spin');
				jQuery('.loaderoneditbutton.lpsubmitloading').removeClass('fa-angle-right');
				jQuery('.loaderoneditbutton.lpsubmitloading').addClass('fa-check');
				var redURL = resp.status;

				function redirectPageNow() {
					window.location.href = redURL
				}
				setTimeout(redirectPageNow, 1000)
			}
		},
		error: function(jqXhr, textStatus, errorMessage) {
			if (!jQuery('#recaptcha-securet').length === 0) {
				lp_reset_grecaptcha()
			}
			$this.find('.preview-section .fa-spinner').removeClass('fa-times');
			$this.find('.preview-section .fa-spinner').removeClass('fa-spinner fa-spin');
			$this.find('.preview-section .fa').addClass('fa-times');
			alert('An error occured while submitting your listing. Please refesh and try again.');
		}
	});
}

window.onload = recaptchaCallbackk;
jQuery(document).on('submit', '#lp-submit-form', function(e) {
	jQuery('.error_box').hide('');
	jQuery('.error_box').html('');
	jQuery('.error_box').text('');
	jQuery('.username-invalid-error').html('');
	jQuery('.username-invalid-error').text('');
	var $this = jQuery(this);
	jQuery('span.email-exist-error').remove();
	jQuery('input').removeClass('error-msg');
	jQuery('textarea').removeClass('error-msg');
	$this.find('.preview-section .fa-angle-right').removeClass('fa-angle-right');
	$this.find('.preview-section .fa').addClass('fa-spinner fa-spin');
	jQuery('.bottomofbutton.lpsubmitloading').addClass('fa-spinner fa-spin');
	jQuery('.loaderoneditbutton.lpsubmitloading').addClass('fa-spinner fa-spin');

	// Check if user is cropping
	if (jQuery("#featured-crop-wrap").length && jQuery("#business-crop-wrap").length) {
		if (jQuery("#featured-crop-wrap").css("visibility") == "visible" || jQuery("#business-crop-wrap").css("visibility") == "visible") {
			msgf = 'Please finish cropping before submitting';
			var resError = {response : 'fail', msg : msgf};
			listing_ajax_response_notice(resError);
			jQuery('.lpsubmitloading').addClass('fa-angle-right');
			$this.find('.preview-section').addClass('fa-angle-right');
			$this.find('.preview-section .fa').removeClass('fa-spinner fa-spin');
			jQuery('.bottomofbutton.lpsubmitloading').removeClass('fa-spinner fa-spin');
			jQuery('.loaderoneditbutton.lpsubmitloading').removeClass('fa-spinner fa-spin');
			return false;
		}
	}

	fd = new FormData(this);

	$maxAlloedSize = jQuery('#lp-submit-form').data('imgsize');
	$totalAlloedImgs = jQuery('#lp-submit-form').data('imgcount');

	if (detectIE() == false) {
		var $fullbrowserdet = navigator.sayswho;
		var $browserArray = $fullbrowserdet.split(" ");// outputs: `Chrome 62`
		if ($browserArray[0]=="Safari") {
			if ($browserArray[1] >= 12) {
				fd.delete('listingfiles[]');
				fd.delete('lp-featuredimage[]');
				fd.delete('business_logo[]');
			}
		}
		else {
			fd.delete('listingfiles[]');
			fd.delete('lp-featuredimage[]');
			fd.delete('business_logo[]');
		}
	}

	$totalfilesize = 0;
	$totalfilesize = jQuery('.lplistgallery').attr('data-savedgallweight');
	$selectedImagesCount = jQuery('.lplistgallery').attr('data-savedgallerysize');

	if (jQuery("input[name='listingfiles[]']").length) {
	  jQuery.each(jQuery("input[name='listingfiles[]']"), function(k, files) {
	    jQuery.each(jQuery("input[name='listingfiles[]']")[k].files, function(i, file) {
	      if (file.size > 1 || file.fileSize > 1) {
					$totalfilesize = parseInt($totalfilesize) + parseInt(file.size);
	        fd.append('listingfiles[' + lpcount + ']', file);
	        lpcount++;
	      }
	    });
	  });
	}

	lpcount = parseInt(lpcount) + parseInt($selectedImagesCount);
	$AlloedSize = true;
	$Alloedimgcount = true;

	if (!isNaN($totalfilesize)) {
		if ($totalfilesize > $maxAlloedSize) {
			msgf = jQuery('#lp-submit-form').data('sizenotice');
			var resError = {response : 'fail', msg : msgf};
			listing_ajax_response_notice(resError);
			$this.find('.preview-section').addClass('fa-angle-right');
			jQuery('.lpsubmitloading').addClass('fa-angle-right');
			$this.find('.preview-section .fa').removeClass('fa-spinner fa-spin');
			jQuery('.bottomofbutton.lpsubmitloading').removeClass('fa-spinner fa-spin');
			jQuery('.loaderoneditbutton.lpsubmitloading').removeClass('fa-spinner fa-spin');
			$AlloedSize = false;
		}
	}

	if (lpcount > $totalAlloedImgs) {
		msgf = jQuery('#lp-submit-form').data('countnotice');
		var resError = {response : 'fail', msg : msgf};
		listing_ajax_response_notice(resError);
		jQuery('.lpsubmitloading').addClass('fa-angle-right');
		$this.find('.preview-section').addClass('fa-angle-right');
		$this.find('.preview-section .fa').removeClass('fa-spinner fa-spin');
		jQuery('.bottomofbutton.lpsubmitloading').removeClass('fa-spinner fa-spin');
		jQuery('.loaderoneditbutton.lpsubmitloading').removeClass('fa-spinner fa-spin');
	  $Alloedimgcount = false;
	}
	else {
		if (featuredExists && businessExists) {
			businessCropper.getCroppedCanvas().toBlob(function (blob) {
				var name = jQuery("#business-image-upload img").attr("alt");
				var date = new Date();
				var file = new File([blob], name, {type: blob.type, lastModified: date} );
				fd.append('business_logo', file);
				featuredCropper.getCroppedCanvas().toBlob(function (fblob) {
					var fname = jQuery("#featured-image-upload img").attr("alt");
					var fdate = new Date();
					var ffile = new File([fblob], fname, {type: fblob.type, lastModified: fdate} );
					fd.append('lp-featuredimage', ffile);
					submitListing($this, fd);
				});/*end featured image*/
			}); // end business logo
	  }
		else if (featuredExists && !businessExists) {
			featuredCropper.getCroppedCanvas().toBlob(function (fblob) {
				var fname = jQuery("#featured-image-upload img").attr("alt");
				var fdate = new Date();
				var ffile = new File([fblob], fname, {type: fblob.type, lastModified: fdate} );
				fd.append('lp-featuredimage', ffile);
				fd.append('lp-featuredimage-remove', featuredRemove);
				fd.append('business-logo-remove', true);
				submitListing($this, fd);
			});
		}
		else if (businessExists && !featuredExists) {
			businessCropper.getCroppedCanvas().toBlob(function (blob) {
				var name = jQuery("#business-image-upload img").attr("alt");
				var date = new Date();
				var file = new File([blob], name, {type: blob.type, lastModified: date} );
				fd.append('business_logo', file);
				fd.append('lp-featuredimage-remove', true);
				submitListing($this, fd);
			});
		}
		else {
			// TODO: Add Remove instructions here
			fd.append('lp-featuredimage-remove', true);
			fd.append('business-logo-remove', true);
			submitListing($this, fd);
		}
	}
  e.preventDefault()
});



function listing_ajax_response_notice(res) {
	if ( res.response == 'success' ) {
		jQuery('.lp-notifaction-area').find('h4').text(res.msg);
		jQuery('.lp-notifaction-area').removeClass('lp-notifaction-error').addClass('lp-notifaction-success');
		jQuery('.lp-notifaction-area').addClass('active-wrap');
	}
	if ( res.response == 'fail' || res.response == 'failure' ) {
		jQuery('.lp-notifaction-area').find('h4').text(res.msg);
		jQuery('.lp-notifaction-area').removeClass('lp-notifaction-success').addClass('lp-notifaction-error');
		jQuery('.lp-notifaction-area').addClass('active-wrap');
	}
}

// Check browser code
navigator.sayswho= (function() {
	var ua= navigator.userAgent, tem,
	M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
	if (/trident/i.test(M[1])) {
		tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
		return 'IE '+(tem[1] || '');
	}
	if (M[1]=== 'Chrome') {
		tem= ua.match(/\b(OPR|Edge)\/(\d+)/);
		if (tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
	}
	M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
	if ((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
	return M.join(' ');
})();
