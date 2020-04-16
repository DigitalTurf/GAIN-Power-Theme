jQuery(document).ready(function($) {
  // Home Page Form Switcher
  $('#home-search-switcher').niceSelect();

  var timeout = null;
  $('body').scroll(function () {
      if (!timeout) {
          timeout = setTimeout(function () {
              clearTimeout(timeout);
              timeout = null;

              if ($('body').scrollTop() > 0) {
                $('body').addClass('scrolled');
              } else {
                $('body').removeClass('scrolled');
              }
          }, 250);
      }
  });

  // Home Page Form Switcher Animation
  if ( $('body').hasClass( "home-page" ) ) {
    var disp = $('.search-switcher .nice-select .current');
    var time = 500;

    function fadeMessages(arr) {
      if (arr.length == 0) return;
      disp.fadeOut(time, function(){
        disp.toggleClass('blue').html(arr[0]).hide().fadeIn(time, function() {
          arr.shift();
          fadeMessages(arr);
        });
      });
    }

    var options = [];
    $('#home-search-switcher option').each( function(i, option) {
      if ($(this).text() != 'Everything') {
        options[i] = $(option).text();
      }
      options = options.filter(function( element ) {
         return element !== undefined;
      });
    });
    options.push('Everything');
    setTimeout(fadeMessages(options), 5000);
  }

  $('.lp-search-bar form').submit(function( event ) {
    event.preventDefault();
    var cur = $('#home-search-switcher option:selected').val();
    var searchStr = encodeURIComponent($('#lp_t_search').val());

    if (cur == 'directory') {
      window.location.href = siteData.site_url + '/?lp_t_search='+searchStr+'&lp_s_tag=&lp_s_cat=&s=home&post_type=listing';
    } else if (cur == 'job') {
      window.location.href = 'https://careercenter.democraticgain.org/jobs/?keywords='+searchStr;
    } else {
      window.location.href = siteData.site_url + '/?s='+searchStr+'&bp_search=1&view=content';
    }
  });
  $('#home-search-switcher').change(function() {

  });

  $('.auth-switch .auth-option').on('click', function() {
    if(!$(this).hasClass('auth-active')) {
      $('.auth-switch .auth-option').toggleClass('auth-active');
    } 
  });
  $('.md-trigger').on('click', function() {
    $('.auth-switch .auth-option').removeClass('auth-active');
    if ($(this).hasClass('signInClick')) {
      $('.auth-switch .auth-option.signInClick').addClass('auth-active');
    }
    if ($(this).hasClass('signUpClick')) {
      $('.auth-switch .auth-option.signUpClick').addClass('auth-active');
    }
  });

  // Clone User Admin Menu
  if ( $( "#wp-admin-bar-my-account-buddypress > li.menupop" ).length ) {
    const header_profile = $('#lp-user-name-menu');
    const toolbar_menu = $('#wp-admin-bar-my-account-buddypress > li.menupop').clone();
    $(header_profile).prepend(toolbar_menu);
  }

  // Mobile menue operations
  $('.mobile-menu-nav, .nav-menu-close').on('click', function() {
    $('header.lp-header').toggleClass('mobile-nav-active');
    $('li.active-item').removeClass('active-item');
  });

  $('.mobile-nav-active #menu-main > li').on('click', function(event) {
    if($(this).hasClass('active-item')){
      $(this).removeClass('active-item');
    } else {
      event.preventDefault();
      $('li.active-item').removeClass('active-item');
      $(this).addClass('active-item');
    }
  });

  function is_touch_device() {
    var prefixes = ' -webkit- -moz- -o- -ms- '.split(' ');
    var mq = function (query) {
      return window.matchMedia(query).matches;
    }
    if (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
      return true;
    }

    var query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join('');
    return mq(query);
  }

  if (is_touch_device()) {
    $('.lp-header-user-nav-top').addClass('touch-enabled');
    $('#lp-user-name-menu > li > a').each(function( index ) {
      if(!$(this).parent().is("#user-menu-logout")) {
        $(this).addClass('touch-enabled');
      }
    });
  }
  else {
    $('.lp-header-user-nav-top').addClass('no-touch');
  }
  $('.lp-user-name').on('click', function() {
    var nav = $('.lp-header-user-nav-top.logged-in.touch-enabled');
    if (nav.hasClass('active-nav')) {
      nav.removeClass('active-nav');
    }
    else {
      nav.addClass("active-nav");
    }

  });

  $('a.touch-enabled').on('click', function(e) {
    e.preventDefault();
  });

  $('.mobile-search-btn').on('click', function(e) {
    $('.header-search-container').toggleClass('mobile-display');
  });

  if ($('#avatar-upload-form').length) {
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#avatar-upload-form").offset().top - 200
    }, 1000)
  }

  var attempts = 50;
  function waitForEl(selector, callback) {
    if ($(selector).length) {
      attempts = 0;
      callback();
    } else if (attempts > 0) { // Only repeat the countdown if attempts are left
      var ytloop = setTimeout(function() {
        waitForEl(selector, callback);
      }, 200);
    }
    attempts--; // decrease attempts by 1
  };

  if ( $('body').hasClass( "activity" ) ) {
    waitForEl('iframe[src*="youtube"]', function() {
  		var attempts = 50;
      $('iframe[src*="youtube"]').wrap("<div class='youtube-wrap'></div>");
    });
    $("li.load-more").on('click', function(){
  		var attempts = 50;
      waitForEl(selector, function() {
       $('iframe[src*="youtube"]').wrap("<div class='youtube-wrap'></div>");
      });
    });
  };
});
