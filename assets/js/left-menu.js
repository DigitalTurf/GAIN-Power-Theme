jQuery(document).ready(function(){
    if(jQuery(".left-sidebar-menu").length){
        // Minimized and Expanded menu sizes
        var menuSmall = "68px";
        var menuLarge = "220px";

        //Remember if menu was last expanded or collapsed
        if(document.cookie.indexOf("menu-open=true") >= 0 && jQuery("#page").length){
            //Open the menu if the
            jQuery(".left-sidebar-menu").removeClass("closed");
            jQuery("#page").css("padding-left", menuLarge);
            jQuery(".lp_confirmation").css("width", "calc(100% - "+menuLarge+")");
        }else if(jQuery("#page").length){
            //Padding for the main page if the menu is closed
            jQuery("#page").css("padding-left", menuSmall);
            jQuery(".lp_confirmation").css("width", "calc(100% - "+menuSmall+")");
        }

        //Inbox link and unread message count
        var unreadMessages = jQuery("#hidden-message-count").html();
        if(unreadMessages > 0){
            jQuery("#menu-left-side-menu .sub-menu li:contains('My Messages')").append("<div class='inbox-badge'>" + unreadMessages + "</div>");
        }

        //Add classes for active menu items
        var url = window.location.href.toLowerCase();
        jQuery("#menu-left-side-menu .sub-menu li").each(function(i, el){
            if(jQuery(el).find("a").attr("href").toLowerCase() == url){
                jQuery(el).addClass("active-page");
                jQuery(el).parent().closest("li").addClass("active-parent");
            }
        });

        //Collapse menus that are not in use
        jQuery("#menu-left-side-menu>li").each(function(i, el){
            if(!jQuery(el).hasClass("active-parent")){
                jQuery(el).css("max-height", "18px");
                jQuery(el).addClass("collapsed");
                jQuery(el).removeAttr("style");
            }
        });

        //Open/close functionality
        jQuery(".left-sidebar-menu .toggle-panel").click(function(){
            jQuery(".left-sidebar-menu").toggleClass("closed");
            if(jQuery(".left-sidebar-menu").hasClass("closed")){
                jQuery("#page").css("padding-left", menuSmall);
                jQuery(".lp_confirmation").css("width", "calc(100% - "+menuSmall+")");
                document.cookie = "menu-open=false; path=/";
            }else{
                jQuery("#page").css("padding-left", menuLarge);
                jQuery(".lp_confirmation").css("width", "calc(100% - "+menuLarge+")");
                document.cookie = "menu-open=true; path=/";
            }
        });

        //Mouse Position
        var currentMouseX = -1;
        var currentMouseY = -1;
        jQuery(document).mousemove(function(event) {
            currentMouseX = event.pageX;
            currentMouseY = event.pageY;
        });

        //Delayed Hover for tooltips
        jQuery("#menu-left-side-menu li a").on({
            'mouseover': function () {
                var menuItem = this;
                if(jQuery(".left-sidebar-menu").hasClass("closed")){
                    timer = setTimeout(function () {
                        xPos = (currentMouseX + 10).toString() + "px";
                        yPos = (currentMouseY + 10).toString() + "px";
                        jQuery("body").append("<div class='left-menu-tooltip'>" + jQuery(menuItem).html() +"</div>");
                        var tooltip = jQuery("body").find("div.left-menu-tooltip");
                        jQuery(tooltip).css({"top": yPos, "left": xPos});
                        jQuery(tooltip).animate({height: "20px"}, 200);
                    }, 200);
                }
            },
            'mouseout' : function () {
                if(jQuery(".left-sidebar-menu").hasClass("closed")){
                    clearTimeout(timer);
                    var tooltip = jQuery("body").find("div.left-menu-tooltip");
                    if(tooltip.length){
                        jQuery(tooltip).remove();
                    }
                }
            }
        });

        //Hover Animation for top list items
        jQuery("#menu-left-side-menu>li>a").hover(function(){
            //Hover Color
            if(!jQuery(this).closest("li").hasClass("active-parent")){
                jQuery(this).closest("li").css("color", "#A62A59;");
                jQuery(this).css("color", "#A62A59;");
            }
        }, function(){
            //Hover Color
            if(!jQuery(this).closest("li").hasClass("active-parent")){
                jQuery(this).closest("li").css("color", "#292929;");
                jQuery(this).css("color", "#292929;");
            }
        });

        //Submenu expand/collapse
        jQuery("#menu-left-side-menu>li>a").click(function(){
            jQuery(this).closest("li").toggleClass("collapsed");
        });
    }
});
