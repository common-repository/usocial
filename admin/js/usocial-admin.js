(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	var update_trigger = false;
	//Click button add trigger set
	$("html").on("click","#u-add-trigger-set", function () {

		window.open(usocial.link_site + 'share', '_blank');
		update_trigger = false;

		$("#u-create-set-title").show();
		$("#u-edit-set-title").hide();
		var u_lastSetNumber = $('table.iksweb tr.tr_value:first>td:first').text();
		u_lastSetNumber = +u_lastSetNumber + 1;
		$("#u-title-number-set").text(u_lastSetNumber);
		$("#u-div-form").slideDown();
	});
	//Click button cancel set
	$("html").on("click","#u-cancel-set", function () {
		$("#u-div-form").delay( 200 ).slideUp();
		$("#u-form").trigger("reset");
	});
	// Add new set
	$("html").on("click","#u-add-set", function () {
		if (update_trigger == false ) {
			var u_id = $("#u-title-number-set").text();
			var u_id_usocial = $("#u-id-usocial-field").val();
			var u_script_usocial = $("#u-script-usocial-field").val();
			var u_display_loc = $('input[name="u-display-loc-radio"]:checked').val();

			var data = {
				action: 'add_set',
				id: u_id,
				id_usocial: u_id_usocial,
				script_usocial: u_script_usocial,
				display_locations: u_display_loc,
				beforeSend : function () {
					$("#u-loader").css( "display", "block");
				},
				success: function () {
					$('html, body').animate({
						scrollTop: 0
					});
				}
			};

			// Send ajax
			jQuery.post(ajaxurl, data, function (response) {
				$(".u-added-sets-list").html(response).animate({opacity: 1}, 300);
				if (!$(".u-error-message").length) {
					$("#u-div-form").delay(200).slideUp();
					$("#u-form").trigger("reset");
				}
			});
		} else {
			var u_id = $("#u-hidden-id").val();
			var u_id_usocial = $("#u-id-usocial-field").val();
			var u_script_usocial = $("#u-script-usocial-field").val();
			var u_display_loc = $('input[name="u-display-loc-radio"]:checked').val();

			var data = {
				action: 'update_set',
				id: u_id,
				id_usocial: u_id_usocial,
				script_usocial: u_script_usocial,
				display_locations: u_display_loc,
				beforeSend : function () {
					$("#u-loader").css( "display", "block");
				},
				success: function () {
					$('html, body').animate({
						scrollTop: 0
					});
				}
			};
			// Send ajax
			jQuery.post(ajaxurl, data, function (response) {
				$(".u-added-sets-list").html(response).animate({opacity: 1}, 300);
				if (!$(".u-error-message").length) {
					$("#u-div-form").delay(200).slideUp();
					$("#u-form").trigger("reset");
				}
			});

		}
	});

	// Delete set
	$("html").on("click",".delete-button", function () {
		var u_id = $(this).data("id");
		var u_number = $(this).data("number");
		if (confirm(usocial.delete + u_number + "?")) {
			var data = {
				action: 'delete_set',
				id_usocial: u_id,
				beforeSend: function () {
					$("#u-loader").css("display", "block");
				}
			};

			jQuery.post(ajaxurl, data, function (response) {
				$(".u-added-sets-list").html(response).animate({opacity: 1}, 300);
			});
		}
	});

	// Update set
	$("html").on("click",".update-button", function () {

		update_trigger = true;

		var u_id = $(this).data("id");
		var u_number = $(this).data("number");
		var u_id_usocial = $(`#u-id-usocial-${u_id}`).text();
		var u_script_usocial = $(`#u-script-usocial-${u_id}`).val();
		console.log (u_id);
		var u_display_loc = $(`#u-display-loc-${u_id}`).attr('value');

		$("#u-hidden-id").val(u_id);
		$("#u-id-usocial-field").val(u_id_usocial);
		$("#u-script-usocial-field").val(u_script_usocial);
		console.log (u_display_loc);
		$(`input[name="u-display-loc-radio"][value="${u_display_loc}"]`).prop('checked', true);

		$("#u-title-number-set").text(u_number);

		$("#u-edit-set-title").show();
		$("#u-create-set-title").hide();

		$("#u-div-form").slideDown();

	});

	$(document).ajaxComplete(function(){
		$("#u-loader").css( "display", "none");
	});

})( jQuery );
