var inicializarMenu = function(tagId, menuLabel, themeName){
	$(function() {
		var getSmartMenus = function(menuObject){
			var jsonMenu = {};
			if (menuObject)
			{
				$.each(menuObject.filter(function(node){ return node.target || node.target == 0; }), 
					function(idx, item){ 
						jsonMenu[idx] = {"name": item.text, "link": item.href, "sub": getSmartMenus(menu.filter(function(node){ return node[0].parentItem == item.target; })[0]) };
					});
			}
			return jsonMenu;
		}

		var getMenuItem = function (itemData) {
			var data = itemData.name ? itemData : itemData.menu;
			if (!data)
			{
				return
			}
			var link = $("<a target='main' href='" + (data.link ? data.link : '#') + "'>" + data.name + "</a>" );
	        var item = $("<li>")
	            .append(link);
	        if (Object.keys(itemData.sub).length > 0) {
	            var subList = $("<ul>");
	            $.each(itemData.sub, function (idx, item) {
	                subList.append(getMenuItem(item));
	            });
	            item.append(subList);
	        }
	        return item;
	    };

	    if (flagSmartMenu)
	    {
		    $.getScript(renderPath + "/smartMenus/sources/jquery.smartmenus.js")
		    .done(function( script, textStatus){
		    	//Agrego todas las referencias del menú
		    	var css_link = $("<link>", {
				        rel: "stylesheet",
				        type: "text/css",
				        href: renderPath + "/smartMenus/smartMenus.css"
				    });
				    css_link.appendTo('head');

				var css_link = $("<link>", {
				        rel: "stylesheet",
				        type: "text/css",
				        href: renderPath + "/smartMenus/sources/sm-core-css.css"
				    });
				    css_link.appendTo('head');

				    css_link = $("<link>", {
				        rel: "stylesheet",
				        type: "text/css",
				        href: renderPath + "/smartMenus/sources/" + themeName + ".css"
				    });
				    css_link.appendTo('head');

				$('#' + tagId).html('<input id="main-menu-state" type="checkbox" />' +
										'<label class="main-menu-btn" for="main-menu-state">' +
										'<span class="main-menu-btn-icon"></span>' + //' Toggle main menu visibility ' +
										'</label>' +
						  			'<h2 class="nav-brand"><a href="#">' + menuLabel + '</a></h2>' +	
									'<ul id="main-menu" class="sm ' + themeName + '"></ul>');
				
				/*var menuUrl = "https://api.myjson.com/bins/gr44p";*/

				/*$.getJSON( menuUrl, {format: "json"})
			    .done(function( data ) {
			    	$.each( data.menu, function(i, item) {
				    	$("#main-menu").append(getMenuItem(this));
				    });

			   		//Initialize
					$('#main-menu').smartmenus({
				    	subMenusSubOffsetX: 6,
				    	subMenusSubOffsetY: -8
					});
				});*/

				//Initialize	--> ESTO VA POR AHORA MIENTRAS CONVERTIMOS EL MENÚ ACTUAL, LUEGO HABRÁ QUE HACER EL getJSON.
				var sm = getSmartMenus(menu[0]);

				$.each( sm, function(i, item) {
				    $("#main-menu").append(getMenuItem(item));
				});

				$("nav").show();

				$('#main-menu').smartmenus({
			    	subMenusSubOffsetX: 6,
			    	subMenusSubOffsetY: -8
				});
				
		    });

			// SmartMenus mobile menu toggle button
			var $mainMenuState = $('#main-menu-state');
			if ($mainMenuState.length) {
				// animate mobile menu
			    $mainMenuState.change(function(e) {
			    	var $menu = $('#main-menu');
			    	if (this.checked) {
			        	$menu.hide().slideDown(250, function() { $menu.css('display', ''); });
				    } else {
				    	$menu.show().slideUp(250, function() { $menu.css('display', ''); });
				    }
			    });
			    // hide mobile menu beforeunload
			    $(window).bind('beforeunload unload', function() {
			    	if ($mainMenuState[0].checked) {
			        	$mainMenuState[0].click();
			      	}
			    });
			}
		}
	});
}