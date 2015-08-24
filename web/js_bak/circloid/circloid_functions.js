/*
* Circloid Functions
*/

/**
 * circloidMenuNav handles the navigation, both Left Menu and Horizontal Menu
 * @param  {object} options: Contains the options set by the user
 * - @param {string} options.container:		accepts [{menu class}, {menu id}]
 * - @param {string} options.eventtype:		accepts [click, hover]
 * - @param {string} options.menuposition:	accepts [top, bottom, left, right]
 * - @param {string} options.slideout:		accepts [left, right, down]
 */
function circloidMenuNav(options){

	/* options presets */
	if(options){
		if(!options.container){
			options.container = ".mainnav";
		}
		if(!options.eventtype){
			options.eventtype = "click";
		}
		if(!options.menuposition){
			options.menuposition = "left";
		}
		if(!options.slideout){
			options.slideout = "down";
		}
	}else{
		options = {container: ".mainnav", eventtype: "click", menuposition: "left", slideout: "down"};
	}

	/* Add "parent" class to appropriate dropdown */
	$(options.container).find("li li > a").siblings("ul").prev().addClass("parent");

	/* Add Dropdown arrow to parents of dropdowns */
	$("<i class='icon m-icon-arrow-down-bold-round m-icon-size-small'></i>").appendTo($(options.container).find("li li > a").siblings("ul").prev());

	if(options.menuposition == "top"){
		$(options.container).find("span.main-menu-icon").each(function(){
			$(this).parent().siblings("ul").siblings("a").children("span.main-menu-icon").after("<i class='icon m-icon-arrow-down-bold-round m-icon-size-small'></i>");
		});
	}

	/* Animate Menu */
	if($(options.container).hasClass("animate")){

		// Sequenced Reveal of menu icons, text and badge
		var count = $(options.container).children("li.menu-item-top").size();
		var duration = 200;
		var finalDelay = (count * duration) + 300;

		$(options.container).find(".main-menu-icon .icon").each(function(index){
			$(this).delay(duration * index).animate({"bottom":"0", "opacity":1}, duration, "linear", function(){
				$(this).parent().siblings(".main-menu-text").delay(200).animate({"left":"0", "opacity":1}, 200, "linear");
			});
		});

		if(finalDelay > badgeRevealTime){
			badgeRevealTime = finalDelay;
		}
	}

	/* Set style for menu */
	$(options.container).css("position","relative");
	$(options.container).children("li").children("ul").css("position","absolute");

	if(options.eventtype == "click"){
		/* Call Function: menuNavClick() */
		menuNavClick(options.container, options.menuposition);
	}else if(options.eventtype == "hover"){
		/* Call Function: menuNavHover() */
		menuNavHover(options.container, options.menuposition);
	}

	$(options.container).find("a.top, a.parent").click(function(e){
		if($(this).siblings("ul").length){
			e.preventDefault();
		}
	});

	/* Close Open Menus If User CLicks Outside the Menu (Works on both Left and Secondary Menus) */
	$(document).on('click', function(event) {
		if (!$(event.target).closest(options.container).length){
			// Hide the menus if visible
			$(options.container).children("li").children("ul").animate({"top": "50px", "opacity":"hide"},200, "linear",function(){
				$(options.container).find("li ul").removeAttr("style").removeClass("sub-menu-open");
				$(options.container).children("li").removeAttr("style").removeClass("menu-open");
			});
		}
	});



	/**
	 * menuNavClick handles the menu open/close when menu is set to open on click
	 * @param  {string} menuBlock:		the parent class/id (options.container) which is set in parent function circloidMenuNav()
	 * @param  {string} menuposition:	where the sub-menu will slideout to set in parent function circloidMenuNav()
	 */
	function menuNavClick(menuBlock, menuposition){
		/* Display Top Menu */
		$(menuBlock).children("li").children("a").on("click", function(){
			if($(this).parent().hasClass("menu-open")){
				/* Call Function: menuNavClickClose() */
				menuNavClickClose($(this), menuposition);
			}else{
				if(menuposition == "left"){
					// $($(this).parents().eq(3)).css("overflow","visible");
					// $($(this).parents().eq(2)).css("overflow","visible");
				}
				/* Call Function: menuNavClickOpen() */
				menuNavClickOpen($(this), menuposition);
			}
		});

		/* Display Submenus */
		$(menuBlock).children("li").children("ul").find("li a").on("click", function(){
			if($(this).next("ul").hasClass("sub-menu-open")){
				/* Call Function: menuNavSubClickClose() */
				menuNavSubClickClose($(this), menuposition);
			}else{
				/* Call Function: menuNavSubClickOpen() */
				menuNavSubClickOpen($(this), menuposition);
			}
		});
	}

	/**
	 * menuNavClickOpen handles the opening of the menu on click
	 * @param  {object} thisObj      the object sent from the parent
	 * @param  {string} menuposition slideout menu position sent from parent
	 */
	function menuNavClickOpen(thisObj, menuposition){
		if(menuposition == "left"){
			thisObj.parent().parent().find("li.menu-open > ul").animate({"top": "50px", "opacity":"hide"},200, "linear",function(){
				$(this).removeAttr("style");
				$(this).find("ul").removeAttr("style").removeClass("sub-menu-open");
				$(this).parent().removeClass("menu-open");
			});
			thisObj.next("ul").animate({"top": "0", "opacity":"show"},200, "linear",function(){
				thisObj.parent().addClass("menu-open");
			});
		}else if(menuposition == "top"){
			thisObj.parent().parent().find("li.menu-open > ul").animate({"top": "62px", "opacity":"hide"},200, "linear",function(){
				$(this).removeAttr("style");
				$(this).find("ul").removeAttr("style").removeClass("sub-menu-open");
				$(this).parent().removeClass("menu-open");
			});
			thisObj.next("ul").animate({"top": "42px", "opacity":"show"},200, "linear",function(){
				thisObj.parent().addClass("menu-open");
			});
		}else if(menuposition == "right"){

		}
	}

	/**
	 * menuNavClickClose handles the closing of the menu on click
	 * @param  {object} thisObj      the object sent from the parent
	 * @param  {string} menuposition slideout menu position sent from parent
	 */
	function menuNavClickClose(thisObj, menuposition){
		if(menuposition == "left"){
			thisObj.next("ul").animate({"top": "50px", "opacity":"hide"},200, "linear",function(){
				$(this).removeAttr("style");
				$(this).parent().removeClass("menu-open");
				$(this).find("ul").removeAttr("style").removeClass("sub-menu-open");
			});
		}else if(menuposition == "top"){
			thisObj.next("ul").animate({"top": "62px", "opacity":"hide"},200, "linear",function(){
				$(this).removeAttr("style");
				$(this).parent().removeClass("menu-open");
				$(this).find("ul").removeAttr("style").removeClass("sub-menu-open");
			});
		}else if(menuposition == "right"){
			// TODO
		}
	}

	/**
	 * menuNavSubClickOpen handles the opening of the sub-menu on click
	 * @param  {object} thisObj      the object sent from the parent
	 * @param  {string} menuposition slideout menu position sent from parent
	 */
	function menuNavSubClickOpen(thisObj, menuposition){
		if(menuposition == "left"){
			thisObj.parent().siblings("li").find("ul").slideUp(function(){
				$(this).removeAttr("style").removeClass("sub-menu-open");
			});
			thisObj.next("ul").slideDown().addClass("sub-menu-open");
		}else if(menuposition == "top"){
			thisObj.parent().siblings().removeAttr("style");
			thisObj.parent().siblings().find("ul").removeAttr("style").removeClass("sub-menu-open");
			thisObj.parent().siblings().find("a.parent ~ ul.sub-menu-open").animate({"top": "39px", "opacity":"hide"},200, "linear");
			if(thisObj.siblings("ul").size() > 0){
				thisObj.parent().css("position","relative");
				thisObj.next("ul").animate({"top": "29px", "left": "158px", "opacity":"show"},200, "linear",function(){
					$(this).addClass("sub-menu-open");
				});
			}
		}
	}

	/**
	 * menuNavSubClickClose handles the closing of the sub-menu on click
	 * @param  {object} thisObj      the object sent from the parent
	 * @param  {string} menuposition slideout menu position sent from parent
	 */
	function menuNavSubClickClose(thisObj, menuposition){
		if(menuposition == "left"){
			thisObj.next("ul").slideUp().removeClass("sub-menu-open");
			thisObj.next("ul").find("ul").slideUp(function(){
				$(this).removeAttr("style").removeClass("sub-menu-open");
			});
		}else if(menuposition == "top"){
			thisObj.next("ul").animate({"top": "39px", "opacity":"hide"},200, "linear",function(){
				$(this).removeAttr("style").removeClass("sub-menu-open");
				$(this).find("ul").removeAttr("style").removeClass("sub-menu-open");
			});
		}
	}

	/**
	 * menuNavHover handles the open/close of the menu on hover
	 * @param  {object} thisObj      the object sent from the parent
	 * @param  {string} menuposition slideout menu position sent from parent
	 */
	function menuNavHover(menuBlock, menuposition){
		/* Display Top Menu */
		$(menuBlock).children("li").mouseenter(function(){
			if(menuposition == "left"){
				// $($(this).parents().eq(3)).css("overflow","visible");
				// $($(this).parents().eq(2)).css("overflow","visible");
				// $($(this).parents().eq(1)).css("overflow","visible");
			}
			/* Call Function: menuNavMouseEnter() */
			menuNavMouseEnter($(this), menuposition);
		}).mouseleave(function(){
			if(menuposition == "left"){
				// $($(this).parents().eq(3)).css("overflow","hidden");
				// $($(this).parents().eq(2)).css("overflow","hidden");
			}
			/* Call Function: menuNavMouseLeave() */
			menuNavMouseLeave($(this), menuposition);
		});


		/* Display Submenus */
		$(menuBlock).children("li").children("ul").find("li a").on("click", function(){
			if($(this).next("ul").hasClass("sub-menu-open")){
				/* Call Function: menuNavSubClickClose() */
				menuNavSubClickClose($(this), menuposition);
			}else{
				/* Call Function: menuNavSubClickOpen() */
				menuNavSubClickOpen($(this), menuposition);
			}
		});

		/* TODO: If parent event type is hover and the submenu is click to open as it is, then add a feature that will hide the submenus when you hover out of the main parent li */
	}

	/**
	 * menuNavMouseEnter handles the open of the menu on hover
	 * @param  {object} thisObj      the object sent from the parent
	 * @param  {string} menuposition slideout menu position sent from parent
	 */
	function  menuNavMouseEnter(thisObj, menuposition){
		if(menuposition == "left"){
			thisObj.children("ul").animate({"top": "0", "opacity":"show"},200, "linear",function(){
				thisObj.parent("li").addClass("menu-open");
			});
		}else if(menuposition == "top"){
			thisObj.children("ul").animate({"top": "42px", "opacity":"show"},200, "linear",function(){
				thisObj.parent("li").addClass("menu-open");
			});
		}
	}

	/**
	 * menuNavMouseLeave handles the open of the menu on leave
	 * @param  {object} thisObj      the object sent from the parent
	 * @param  {string} menuposition slideout menu position sent from parent
	 */
	function  menuNavMouseLeave(thisObj, menuposition){
		if(menuposition == "left"){
			thisObj.children("ul").animate({"top": "50px", "opacity":"hide"},200, "linear",function(){
				$(this).removeClass("menu-open");
				$(this).removeAttr("style");
				$(this).find("ul").removeAttr("style").removeClass("sub-menu-open");
			});
		}else if(menuposition == "top"){
			thisObj.children("ul").animate({"top": "62px", "opacity":"hide"},200, "linear",function(){
				$(this).removeClass("menu-open");
				$(this).removeAttr("style");
				$(this).find("ul").removeAttr("style").removeClass("sub-menu-open");
			});
		}
	}
}

/* Flot Line Chart */
/**
 * lineChartFlot draws the line chart
 * @param  {string} placeholder the ID of the graph
 * @param  {object} json        the json object sent from the server
 */
function lineChartFlot(placeholder, json){

	var colors = $(placeholder).data("graph-colors").split(',');

	var pointRadius = 6;

	var showTicks = true;

	var range = $("#range li.active a").attr('href');

	var tooltipContent = "%s: <b>%y</b>";

	if(placeholder == "#chart-sale"){
		if(range == "custom"){
			pointRadius = 0;
			tooltipContent = "%y: <b>%y</b>";
		}else{
			pointRadius = 6;
		}
	}else{
		pointRadius = 2;
	}

	var options = {
		series: {
			lines: { 
				show: true,
				fill: true,
				lineWidth: 1.5
			},
			points: {
				show: true,
				radius: pointRadius
			}
		},
		shadowSize: 0,
		grid: {
			backgroundColor: '#FFFFFF',
			borderColor: '#D6D6D9',
			borderWidth: 1,
			hoverable: true
		},
		legend: {
			show: true,
			position: "nw"
		},
		xaxis: {
			ticks: json['xaxis']
		},
		tooltip: true,
		tooltipOpts: {
			content: function(label, xval, yval, flotItem){
				if(placeholder == "#chart-sale" && range == "custom"){
					var tooltipAxisName = flotItem.series.label;
					var tooltipLabel = flotItem.series.xaxis.ticks[xval - 1]["label"];
					return "<b>" + yval + "</b> " + tooltipAxisName + " on <b>" + tooltipLabel + "</b>";
				}else{
					return "%s: <b>%y</b>";
				}
			},
			shifts: {
				x: -40,
				y: 25
			},
			defaultTheme : false
		},
		colors: colors
	}

	$.plot(placeholder, [json['order'], json['customer']], options);

	if(placeholder == "#chart-sale" && range == "custom"){
		$(".flot-x-axis .flot-tick-label.tickLabel").addClass("hidden-tooltip");
	}
}

/**
 * getTopCustomerProductChart draws the donut chart for the Top 5 Customers/Products Widget
 * @param  {[type]} placeholder the ID of the graph
 * @param  {[type]} range    	accepts: day, week, month, year
 * @param  {[type]} path     	route value to get data from database
 */
function getTopCustomerProductChart(placeholder, range, path){

	// Get the token Var from URL
	var split = location.search.replace('?','').split('&').map(function(val){
		return val.split('=');
	});

	// Check which widget is ebing updated, Top Customer or Top Product
	splitPath = path.split("/");

	if(splitPath[1] == "customer"){
		var list = "customer";
	}else if(splitPath[1] == "product"){
		var list = "product";
	}

	$.ajax({
		type: 'GET',
		url: 'index.php?route=' + path + '&token=' + split[1][1] + '&range=' + range,
		dataType: 'json',
		beforeSend: function(){
			if(list == "customer"){
				$("#top-customers-chart").html("<img src='view/image/admin_theme/base5builder_circloid/loading.gif' />");
			}else if(list == "product"){
				$("#top-products-chart").html("<img src='view/image/admin_theme/base5builder_circloid/loading.gif' />");
			}
		},
		error: function(){
			if(list == "customer"){
				var textErrorChart = $(".top-customers .text_error_chart").html();
				$("#top-customers-chart").html("<p>" + textErrorChart + "</p>");
			}else if(list == "product"){
				var textErrorChart = $(".top-products .text_error_chart").html();
				$("#top-products-chart").html("<p>" + textErrorChart + "</p>");
			}
		},
		success: function(json) {

			// Set the variables
			var data = [];
			var n = 0;

			// Reset the names/products in the list before population
			if(list == "customer"){
				$(".top-customers-list ul li .list-name").text("--");

				var textView = $(".top-customers .text_view").html();

				var colorCode = $("#top-customers-chart").data('graph-colors').split(',');

				// Populate the data array to be used by $.plot
				$.each(json.total, function(index, val){

					data.push({ label: json.name[n] + ": <b>" + json.total_currency[n] + "</b>",  data: json.total[n], color: colorCode[n]});

					// Adds 1 to n so it can correspond to the correct element name in the list
					m = n + 1;

					// Replaces the current text within the list with the customers name
					if(json.name[n] != ""){
						$(".top-customers-list ul li.top-customers-" + m + " .list-name").html('<a href="index.php?route=sale/customer&token=' + split[1][1] + '&filter_name=' + encodeURI(json.name[n]) + '">' + json.name[n] + '</a>' + ' - ' + json.total_currency[n] );
					}
					// Increment n to get the next value in the array. The loop ends here if there is no other item within the array
					n++;
				});

			}else if(list == "product"){
				$(".top-products-list ul li .list-name").text("--");

				var textView = $(".top-products .text_view").html();
				var textSold = $(".top-products .text_sold").html();

				var colorCode = $("#top-products-chart").data('graph-colors').split(',');

				// Populate the data array to be used by $.plot
				$.each(json.quantity, function(index, val){

					data.push({ label: json.product_name[n] + ": <b>" + json.quantity[n] + " " + textSold +"</b>",  data: json.quantity[n], color: colorCode[n]});

					// Adds 1 to n so it can correspond to the correct element name in the list
					m = n + 1;

					// Replaces the current text within the list with the products name
					if(json.product_name[n] != ""){
						$(".top-products-list ul li.top-products-" + m + " .list-name").html('<a href="index.php?route=catalog/product&token=' + split[1][1] + '&filter_name=' + encodeURI(json.product_name[n]) + '">' + json.product_name[n] + '</a>' + ' - ' + json.quantity[n] + ' ' + textSold );
					}

					// Increment n to get the next value in the array. The loop ends here if there is no other item within the array
					n++;
				});
			}

			// Display "No Data" Message if there is no data
			if(list == "customer" && json.total == ""){
				// Get "no data" message
				var textNoData = $(".top-customers .text_no_data").html();
				$("#top-customers-chart").html("<p>" + textNoData + "</p>");
			}else if(list == "product" && json.quantity == ""){
				// Get "no data" message
				var textNoData = $(".top-products .text_no_data").html();
				$("#top-products-chart").html("<p>" + textNoData + "</p>");
			}else{

				// Plot the chart and set options
				$.plot(placeholder, data, {
					series: {
						pie: { 
							show: true,
							radius:  1,
							innerRadius: 0.88
						}
					},
					legend: {
						show: true,
						container: '#hiddenLegend'
					},
					grid: {
						hoverable: true,
						clickable: true
					},
					tooltip: true,
					tooltipOpts: {
						content: "%s",
						shifts: {
							x: -60,
							y: 25
						},
						defaultTheme : false
					}
				});
			}
		}
	});
}

/**
 * getSalesValueChart draws the chart for the Sales Value Widget
 */
function getSalesValueChart(){

	// Set the variables
	var salesTotal = parseFloat($("#total_sale_raw").val());

	var salesThisYear = parseFloat($("#total_sale_year_raw").val());
	var salesThisYearText = $("#total_sale_year_raw").data("text-label");
	var salesThisYearCurrency = $("#total_sale_year_raw").data("currency-value");

	var salesPreviousYears = parseFloat($("#total_sales_previous_years_raw").val());
	var salesPreviousYearsText = $("#total_sales_previous_years_raw").data("text-label");
	var salesPreviousYearsCurrency = $("#total_sales_previous_years_raw").data("currency-value");

	$("#title").text("Default pie chart"); // ADD HERE - What the hell is this and why is it needed? I can't remember!
	$("#description").text("The default pie chart with no options set."); // ADD HERE - What the hell is this and why is it needed? I can't remember!

	var placeholder = $("#sales-value-chart");

	var colorCode = $("#sales-value-chart").data('graph-colors').split(',');

	// Set the label options
	var data = [
	{ label: salesThisYearText + " <b>" + salesThisYearCurrency + "</b>",  data: salesThisYear, color: colorCode[0]},
	{ label: salesPreviousYearsText + " <b>" + salesPreviousYearsCurrency + "</b>",  data: salesPreviousYears, color: colorCode[1]}
	];

	// Plot the chart and set options
	$.plot(placeholder, data, {
		series: {
			pie: { 
				show: true,
				radius:  1,
				innerRadius: 0
			}
		},
		legend: {
			show: true,
			container: '#hiddenLegend'
		},
		grid: {
			hoverable: true,
			clickable: true
		},
		tooltip: true,
		tooltipOpts: {
			content: "%s",
			shifts: {
				x: -60,
				y: 25
			},
			defaultTheme : false
		}
	});
}