(function ($, root, undefined) {

	$(function () {

		'use strict';

		// DOM ready, take it away
        //Scroll fixed menu
        $(window).on("scroll", function () {
            if ($(this).scrollTop() > 225) {
                $(".header-main").addClass("fixed");
								$(".header-image").css("height", "284");
            }
            else {
                $(".header-main").removeClass("fixed");
								$(".header-image").css("height", "225");
            }
        });
      });

    })(jQuery, this);
