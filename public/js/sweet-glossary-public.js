(function( $ ) {
	'use strict';

	$(document).ready(function () {
		$(".index-search input").on("input", (function() {
			var t = $(this).val().toLowerCase();
			console.log(t)
			0 !== t.length ? ($(".index-wrapper li").filter((function() {
				console.log($(this).text().toLowerCase().indexOf(t))
				$(this).text().toLowerCase().indexOf(t) > -1 ? $(this).removeClass("hidden") : $(this).addClass("hidden")
			}
			)),
			$(".index-wrapper .index-item").filter((function() {
				var t;
				0 === $(this).find("li:not(.hidden)").length ? $(this).addClass("hidden") : $(this).removeClass("hidden")
			}
			))) : $(".index-wrapper .hidden").removeClass("hidden")
		}
		))
	});

})( jQuery );
