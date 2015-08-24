$(document).ready(function(){
	/**
	 * Restructure Tile
	 */
	$('.tile').each(function(){
		// Relocate Header Content
		var getTileHeader = $(this).find('.tile-heading').html();
		$(this).find(".tile-body").append('<div class="tile-body-sub">' + getTileHeader + '</div>');

		// Relocate Icon
		$('<span class="c-icon-stack"><i class="icon m-icon-blank"></i></span>').prependTo($(this));

		var getTileIcon = $(this).find('.tile-body i');

		$(getTileIcon).appendTo($(this).find('.c-icon-stack'));

		// Make Tile Clickable
		var tileLink = $(this).find(".tile-footer a").attr('href');

		$(this).on('click', function(){
			window.location.replace(tileLink);
		});
	});

	/**
	 * Add Circle around certain Font Awesome Icons
	 */
	$('.dropdown').each(function(){
		$(this).find('.dropdown-toggle > i.fa').after('<i class="icon m-icon-blank"></i>');
	});


	/**
	 * Highlight Active Menu Item
	 */
	// Get URL Route
	function getURLVar(urlVarName) {
		var urlHalves = String(document.location).toLowerCase().split('?');
		var urlVarValue = '';

		if (urlHalves[1]) {
			var urlVars = urlHalves[1].split('&');

			for (var i = 0; i <= (urlVars.length); i++) {
				if (urlVars[i]) {
					var urlVarPair = urlVars[i].split('=');

					if (urlVarPair[0] && urlVarPair[0] == urlVarName.toLowerCase()) {
						urlVarValue = urlVarPair[1];
					}
				}
			}
		}
		return urlVarValue;
	} 

	var route = getURLVar('route');
	
	if(!route) {
		$('#dashboard').addClass('selected');
	} else {
		// Get Current URL Route
		if (!route) {
			$('#dashboard').addClass('selected');
		} else {
			part = route.split('/');

			url = part[0];

			if (part[1]) {
				url += '/' + part[1];
			}

			$('a[href*=\'' + url + '\']').parents('li[id]').addClass('selected');

			// Add Class To Right Column Based On Active Menu
			$("#right-column").addClass(part[0]);
		}
	}


	/* Mobile Device Menu Control - Start */
	
	$("#menu-control").click(function(e){
		var leftMenuOpen = $("#column-left").is(':visible');

		console.log(leftMenuOpen);

		if(leftMenuOpen){
			// Else, if opened, close it
			$("#column-left").animate({"left": "-110px"},400, function(){
				$(".menu-control-outer").removeClass("opened");
				setTimeout(function(){
					$("#column-left").removeAttr("style");
				}, 100);
			});
		}else{
			// If menu closed, then slide open
			$("#column-left").animate({"left": "0", "opacity":"show"},300);
			$(".menu-control-outer").addClass("opened");
		}
		e.stopPropagation();
	});

	/* Mobile Device Menu Control - End */



	/* Main/Left Menu - Toggle Effects - Start */

	var menuEventType = $("ul.mainnav").data("menu-type");

	if((menuEventType != "hover") && (menuEventType != "click")){
		menuEventType = "click";
	}
	
	circloidMenuNav({
		container: ".mainnav",
		eventtype: menuEventType
	});

	/* Main/Left Menu - Toggle Effects - End */


	/* Add Multi-Colored Border Where Needed - Start */

	var coloredBorder = '<div class="top-border"><span class="border-block bg-color-green"></span><span class="border-block bg-color-orange"></span><span class="border-block bg-color-yellow"></span><span class="border-block bg-color-blue"></span><span class="border-block bg-color-red"></span><span class="border-block bg-color-lime"></span><span class="border-block bg-color-pink"></span></div>';

	$('.modal-content').prepend(coloredBorder).css({'border-top':'0'});

	if($('body').hasClass('login-page')){
		$('.panel.panel-default').prepend(coloredBorder).css({'border-top':'0'});
	}

	/* Add Multi-Colored Border Where Needed - End */



	/* Add/Remove Custom Admin Page - Start */

	// Add Custom Admin Page
	$("#add-custom-admin-page a").click(function(e){
		route = encodeURI(getURLVar('route'));

		$.ajax({
			type: 'GET',
			url: 'index.php?route=common/admin_circloid_dashboard_editor/saveCustomAdminPage&token=' + QueryString.token + '&adminpage=' + route,
			dataType: 'json',
			beforeSend: function(){
				
			},
			error: function(){
				var textAjaxError = $(".ajax-error").text();
				$('<div class="alert alert-danger">' + textAjaxError + '</div>').appendTo(".dashboard-editor-content").css("visibility", "visible").fadeIn(300);
			},
			success: function(json) {

				$('.success').remove();
				$('.warning').remove();

				$(".dashboard-editor-color-profile .loading").hide();

				if(json.saved_custom_admin_page){
					// console.log("saved");
					location.reload();
				}else{
					// console.log("not");
					location.reload();
				}
			}
		});

		e.preventDefault();
	});
	
	// Remove Custom Admin Page
	$("#remove-custom-admin-page a").click(function(e){
		route = encodeURI(getURLVar('route'));

		// console.log(route);

		$.ajax({
			type: 'GET',
			url: 'index.php?route=common/admin_circloid_dashboard_editor/removeCustomAdminPage&token=' + QueryString.token + '&adminpage=' + route,
			dataType: 'json',
			beforeSend: function(){

			},
			error: function(){
				var textAjaxError = $(".ajax-error").text();
				$('<div class="warning hidden">' + textAjaxError + '</div>').appendTo(".dashboard-editor-content").css("visibility", "visible").fadeIn(300);
			},
			success: function(json) {

				$('.success').remove();
				$('.warning').remove();

				$(".dashboard-editor-color-profile .loading").hide();

				if(json.removed_custom_admin_page){
					location.reload();
				}else{
					location.reload();
				}
			}
		});

		e.preventDefault();
	});

	/* Add/Remove Custom Admin Page - End */

	/* Get URL Parameter - Start */

	var QueryString = function () {
		// This function is anonymous, is executed immediately and 
		// the return value is assigned to QueryString!
		var query_string = {};
		var query = window.location.search.substring(1);
		var vars = query.split("&");
		for (var i=0;i<vars.length;i++) {
			var pair = vars[i].split("=");
			// If first entry with this name
			if (typeof query_string[pair[0]] === "undefined") {
				query_string[pair[0]] = pair[1];
				// If second entry with this name
			} else if (typeof query_string[pair[0]] === "string") {
				var arr = [ query_string[pair[0]], pair[1] ];
				query_string[pair[0]] = arr;
				// If third or later entry with this name
			} else {
				query_string[pair[0]].push(pair[1]);
			}
		} 
		return query_string;
	} ();

	/* Get URL Parameter - End */

});