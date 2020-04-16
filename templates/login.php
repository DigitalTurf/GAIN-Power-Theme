<?php
/**
 * Template Name: Custom Login/Register
 */
 if (is_user_logged_in()) {
  $redirect = (isset($_GET['redirect_to']))? $_GET['redirect_to']: '/community/news-feed/';
  wp_redirect($redirect);
  exit;
 }

 wp_enqueue_script( 'login-validation-js', get_stylesheet_directory_uri() . '/assets/js/login-validation.js', array( 'jquery' ), null, true );
?>

<!DOCTYPE html>
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->

<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
	   <!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
        <?php wp_head(); ?>

        <style>
            html{
                min-height: 100%;
            }
            body{
                display: table;
                min-height: 100%;
                width: 100%;
            }
            #page{
                display: table-cell;
                vertical-align: middle;
                min-height: 100%;
                width: 100%;
                background-image: url("../wp-content/themes/listingpro-child/assets/images/GP-Flag-Header.jpg");
                background-size: cover;
				overflow: auto;
            }
            .login-form-popup{
                width: 800px;
                transition: width 0.3s;
                padding: 0;
            }
			.login-form-popup .siginincontainer, .login-form-popup .siginupcontainer, .login-form-popup .forgetpasswordcontainer{
				-webkit-box-shadow: 0px 10px 8px 0px rgba(0,0,0,0.26);
                -moz-box-shadow: 0px 10px 8px 0px rgba(0,0,0,0.26);
                box-shadow: 0px 10px 8px 0px rgba(0,0,0,0.26);
			}
            .social-login{
                width: 180px;
                margin: auto;
            }
			.siginupcontainer .social-login{
				visibility: hidden;
			}
			.siginupcontainer .social-login.show{
				visibility: visible;
			}
			.siginupcontainer .check-notification{
				text-align: center;
			}
			.siginupcontainer .check-notfication.hide{
				visibility: hidden;
			}
            .social-login li, .social-login li a{
                width: 100%;
            }
            .clearfix{
                float: none;
                clear: both;
                height: 1px;
            }
			#policy-label{
				font-size: 11px;
				line-height: 1.1;
			}
			.bottom-links a{
				text-align: center;
			}
			#username2{
				-webkit-transition: background-color 0.3s;
				-o-transition: background-color 0.3s;
				transition: background-color 0.3s;
			}
			.form-group.relative{
				position: relative;
			}
			.alphanum-error{
				height: 0px;
				opacity: 0;
				-webkit-transition: opacity 0.3s;
				-o-transition: opacity 0.3s;
				transition: opacity 0.3s;
				-webkit-transition: height 0s;
				-o-transition: height 0s;
				transition: height 0s;
				position: absolute;
				left: 0px;
				top: 60px;
				width: 100%;
				margin: 0 auto;
				font-size: 12px;
				line-height: 1.2;
				background-color: #F2DEDE;
				color: #c42020;
				border: 1px solid #ebccd1;
				border-radius: 4px;
				padding: 10px;
			}
			.alphanum-error i{
				margin-right: 5px;
			}
			.alphanum-error.show{
				height: auto;
				opacity: 1;
			}

            @media (max-width: 820px){
                .login-form-popup{
                    width: 85%;
                }
            }

            @media (max-width: 767px){
				#page{
					display: block;
					overflow-y: scroll;
					box-sizing: content-box;
					padding-top: 50px;
					padding-bottom: 50px;
				}
                .vl{
                    display: none;
                }
                .login-form-popup .siginincontainer, .login-form-popup .siginupcontainer, .login-form-popup .forgetpasswordcontainer{
                    top: 140px;
                    padding-top: 0;
                    padding-bottom: 25px;
                }
                .login-form-popup .or-text{
                    top: 15px;
                }
                .login-form-popup .pop-form-bottom{
                    padding-top: 50px;
                }
            }

            @media (max-width: 481px){
                .login-form-popup .siginincontainer, .login-form-popup .siginupcontainer, .login-form-popup .forgetpasswordcontainer{
                    top: 140px;
                    padding-top: 0;
                    padding-bottom: 19px;
                }
            }
        </style>
    </head>
			<body <?php body_class(); ?>>

			<div id="page" <?php lp_header_data_atts('page'); ?> class="clearfix <?php echo $lp_detail_page_styles; ?>">


			<div class="login-form-popup">
				<div class="auth-switch">
					<div class="row">
						<div class="col-md-6 col-sm-6 text-center signInClick auth-option auth-active"><?php esc_html_e('Sign In','listingpro'); ?></div>
						<div class="col-md-6 col-sm-6 text-center signUpClick auth-option"><?php esc_html_e('Register','listingpro'); ?></div>
					</div>
                </div>
				<div class="siginincontainer">
					<form id="login" class="form-horizontal col-md-5 col-sm-5"  method="post">
						<p class="status"></p>
						<div class="form-group">
							<input type="text" class="form-control" id="lpusername" name="lpusername" placeholder="<?php esc_html_e('Email','listingpro'); ?>" />
						</div>
						<div class="form-group">
							<input type="password" class="form-control" id="lppassword" name="lppassword" placeholder="<?php esc_html_e('Password','listingpro'); ?>" />
						</div>

							<?php
								if($enableCaptchaLogin==true){
									if ( class_exists( 'cridio_Recaptcha' ) ){
										if ( cridio_Recaptcha_Logic::is_recaptcha_enabled() ) {
										echo  '<div class="form-group"><div style="transform:scale(0.88);-webkit-transform:scale(0.88);transform-origin:0 0;-webkit-transform-origin:0 0;" id="recaptcha-'.get_the_ID().'" class="g-recaptcha" data-sitekey="'.$gSiteKey.'"></div></div>';
										}
									}
								}

							?>
						<div class="form-group keep-signed">
							<div class="checkbox pad-bottom-10">
								<input id="check1" type="checkbox" name="remember" value="yes">
								<label for="check1"><?php esc_html_e('Keep me signed in','listingpro'); ?></label>
							</div>
						</div>

						<div class="form-group">
							<input type="submit" value="<?php esc_html_e('Sign in','listingpro'); ?>" class="lp-secondary-btn width-full btn-first-hover" />
						</div>
						<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
						<div class="bottom-links">
							<a  class="forgetPasswordClick" ><?php esc_html_e('Forgot Password?','listingpro'); ?></a><div></div>
							<a href="/contact">Having trouble logging in?</a>
						</div>
					</form>
					<div class="or-devider col-md-2 col-sm-2">
						<div class="vl"></div>
						<div class="or-text">OR</div>
					</div>
					<div class="pop-form-bottom col-md-5 col-sm-5">
						<?php
							if ( is_plugin_active( "nextend-facebook-connect/nextend-facebook-connect.php" ) ) {
								if (count(NextendSocialLogin::$enabledProviders) > 0) {
					?>
						<p class="margin-top-15 social-title"><?php esc_html_e('Sign-In with Social','listingpro'); ?></p>

						<ul class="social-login list-style-none">
							<?php

								foreach (NextendSocialLogin::$providers AS $provider){

									$state         = $provider->getState();
									$providerLable = $provider->getLabel();
									switch ($state) {
										case 'enabled':
										if($providerLable=="Google"){
											/* google is configured */
											?>
											<li>
												<a id="logingoogle" class="google flaticon-googleplus" href="<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1&redirect='+window.location.href; return false;">
                                                    <i class="fab fa-google"></i>
                                                    <span><?php esc_html_e('Google','listingpro'); ?></span>
												</a>
											</li>
											<?php
										}

										if($providerLable=="Facebook"){
											/* facebook is configured */
											?>
											<li>
												<a id="loginfacebook" class="facebook flaticon-facebook" href="<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;">
                                                    <i class="fab fa-facebook-f"></i>
                                                    <span><?php esc_html_e('Facebook','listingpro'); ?></span>
												</a>
											</li>
											<?php
										}

										if($providerLable=="Twitter"){
											/* twitter is configured */
											?>
											<li>
												<a id="logintwitter" class="twitter flaticon-twitter" href="<?php echo get_site_url(); ?>/wp-login.php?loginSocial=twitter" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginSocial=twitter&redirect='+window.location.href; return false;">
                                                    <i class="fab fa-twitter"></i>
                                                    <span><?php esc_html_e('Twitter','listingpro'); ?></span>
												</a>
											</li>
											<?php
										}
										if($providerLable=="LinkedIn"){
											/* twitter is configured */
											?>
											<li>
												<a id="loginlinkedin" class="linkedin flaticon-linkedin" href="<?php echo get_site_url(); ?>/wp-login.php?loginSocial=linkedin" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginSocial=linkedin&redirect='+window.location.href; return false;">
                                                    <i class="fab fa-linkedin-in"></i>
                                                    <span><?php esc_html_e('LinkedIn','listingpro'); ?></span>
												</a>
											</li>
											<?php
										}
									}
								}
							?>
						</ul>
					<?php
							}

						}
					?>
					</div>
				</div>

				<div class="siginupcontainer row grayout">

          <?php

            echo '
            <div class="checkbox form-group check_policy termpolicy pull-left termpolicy-wraper">
              <input id="check_policy" type="checkbox" name="policycheck" value="true">
              <label id ="policy-label" for="check_policy">'.esc_html__('By checking this box, I certify that I am a Democratic/Progressive professional, candidate, or activist. I agree to use this site for my professional development, networking, or marketing efforts supporting Democrats campaigns and/or progressive causes. I acknowledge I’m opting to receive emails and notifications from GAIN POWER.', 'listingpro').'</label>
            </div>';

          ?>

					<form id="register" class="col-md-5 col-sm-5 form-horizontal"  method="post">
					<p class="status"></p>
						<div class="form-group relative">
							<input type="text" class="form-control" id="username2" name="username" placeholder="<?php esc_html_e('Username','listingpro'); ?>"/>
							<div class="alphanum-error">
								Special characters such as "@" or "."" cannot be used in your username. Your username will be viewable by the public. Please choose a username that represents you!
							</div>
						</div>
						<div class="form-group">
							<input type="email" class="form-control" id="email" name="email"  placeholder="<?php esc_html_e('Email','listingpro'); ?>" />
						</div>
						<?php if($enablepassword==true){ ?>
							<div class="form-group">
							<label for="upassword"><?php esc_html_e('Password *','listingpro'); ?></label>
							<input type="password" class="form-control" id="upassword" name="upassword" />
							</div>
						<?php } ?>
						<?php if($enablepassword==false){ ?>
							<div class="form-group pass-message">
								<p><?php esc_html_e('Password will be e-mailed.','listingpro'); ?></p>
							</div>
						<?php } ?>

						<?php
							if(!empty($privacy_policy)){
								$privacy_signup = $listingpro_options['listingpro_privacy_register'];
								if($privacy_signup=="yes"){
									echo '
									<div class="checkbox form-group check_policy termpolicy pull-left termpolicy-wraper">
										<input id="check_policy" type="checkbox" name="policycheck" value="true">
										<label for="check_policy"><a target="_blank" href="'.get_the_permalink($privacy_policy).'" class="help" target="_blank">'.esc_html__('I Agree', 'listingpro').'</a></label>
										<div class="help-text">
											<a class="help" target="_blank"><i class="fa fa-question"></i></a>
											<div class="help-tooltip">
												<p>'.esc_html__('You agree & accept our Terms & Conditions to signup.', 'listingpro').'</p>
											</div>
										</div>
									</div>';
								}
							}
						?>

							<?php
								if($enableCaptcha==true){
									if ( class_exists( 'cridio_Recaptcha' ) ){
										if ( cridio_Recaptcha_Logic::is_recaptcha_enabled() ) {
										echo  '<div class="form-group pull-left"><div style="transform:scale(0.88);-webkit-transform:scale(0.88);transform-origin:0 0;-webkit-transform-origin:0 0;" id="recaptcha-'.get_the_ID().'" class="g-recaptcha" data-sitekey="'.$gSiteKey.'"></div></div>';
										}
									}
								}

							?>
						<div class="form-group">
              <?php if ($_GET['redirect_to']) {
                echo '<input type="hidden" name="redirect_to" value="'.$_GET['redirect_to'].'" />';
               } ?>
							<input disabled type="submit" value="<?php esc_html_e('Register','listingpro'); ?>" id="lp_usr_reg_btn" class="lp-secondary-btn width-full btn-first-hover" />
						</div>
						<div class="bottom-links">
							<a href="/contact">Having trouble logging in?</a>
						</div>
						<?php wp_nonce_field( 'ajax-register-nonce', 'security2' ); ?>
					</form>
					<div class="or-devider col-md-2 col-sm-2">
						<div class="vl"></div>
						<div class="or-text">OR</div>
					</div>
										<div class="pop-form-bottom col-md-5 col-sm-5">
						<?php
							if ( is_plugin_active( "nextend-facebook-connect/nextend-facebook-connect.php" ) ) {
								if (count(NextendSocialLogin::$enabledProviders) > 0) {
					?>

						<p class="margin-top-15 social-title"><?php esc_html_e('Register with Social','listingpro'); ?></p>
						<div class="check-notification">
							You must agree to the terms before registering
						</div>
						<ul class="social-login list-style-none">
							<?php

								foreach (NextendSocialLogin::$providers AS $provider){

									$state         = $provider->getState();
									$providerLable = $provider->getLabel();
									switch ($state) {
										case 'enabled':
										if($providerLable=="Google"){
											/* google is configured */
											?>
											<li>
												<a id="logingoogle" class="google flaticon-googleplus" href="<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1&redirect='+window.location.href; return false;">
                                                    <i class="fab fa-google"></i>
                                                    <span><?php esc_html_e('Google','listingpro'); ?></span>
												</a>
											</li>
											<?php
										}

										if($providerLable=="Facebook"){
											/* facebook is configured */
											?>
											<li>
												<a id="loginfacebook" class="facebook flaticon-facebook" href="<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;">
                                                    <i class="fab fa-facebook-f"></i>
                                                    <span><?php esc_html_e('Facebook','listingpro'); ?></span>
												</a>
											</li>
											<?php
										}

										if($providerLable=="Twitter"){
											/* twitter is configured */
											?>
											<li>
												<a id="logintwitter" class="twitter flaticon-twitter" href="<?php echo get_site_url(); ?>/wp-login.php?loginSocial=twitter" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginSocial=twitter&redirect='+window.location.href; return false;">
                                                    <i class="fab fa-twitter"></i>
                                                    <span><?php esc_html_e('Twitter','listingpro'); ?></span>
												</a>
											</li>
											<?php
										}

										if($providerLable=="LinkedIn"){
											/* twitter is configured */
											?>
											<li>
												<a id="loginlinkedin" class="linkedin flaticon-linkedin" href="<?php echo get_site_url(); ?>/wp-login.php?loginSocial=linkedin" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginSocial=linkedin&redirect='+window.location.href; return false;">
                                                    <i class="fab fa-linkedin-in"></i>
                                                    <span><?php esc_html_e('LinkedIn','listingpro'); ?></span>
												</a>
											</li>
											<?php
										}
									}
								}
							?>
						</ul>
					<?php
							}

						}
					?>
					</div>

				</div>
				<div class="forgetpasswordcontainer">
					<h3 class="text-center"><?php esc_html_e('Forgotten Password?','listingpro'); ?></h3>
					<p>Enter the email address associated with your account to start the password reset process.</p>
					<form class="form-horizontal" id="lp_forget_pass_form" action="#"  method="post">
					<p class="status"></p>
						<div class="form-group">
							<input type="email" name="user_login" class="form-control" id="email3" placeholder="<?php esc_html_e('Email','listingpro'); ?>" />
						</div>
						<div class="form-group">
              <?php if ($_GET['redirect_to']) {
                echo '<input type="hidden" name="redirect_to" value="'.$_GET['redirect_to'].'" />';
               } ?>
							<input type="submit" name="submit" value="<?php esc_html_e('Get New Password','listingpro'); ?>" class="lp-secondary-btn width-full btn-first-hover" />
							<?php wp_nonce_field( 'ajax-forgetpass-nonce', 'security3' ); ?>
						</div>
						<div class="bottom-links">
							<a href="/contact">Having trouble logging in?</a>
						</div>
					</form>
				</div>
			</div>

        </div>


        <?php wp_footer(); ?>


</body>
</html>
