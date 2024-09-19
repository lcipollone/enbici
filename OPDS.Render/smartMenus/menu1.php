<?php 
	$AplicacionesSmartMenu = array(1800);
	print '<script src="../../OPDS.Render/jquery-1.12.4.js"></script>';
	print '<script type="text/javascript" language="javascript" src="../../OPDS.Render/Globals.js"></script>';
	print '<script type="text/javascript" language="javascript" src="../../OPDS.Render/smartMenus/smartMenus.OPDS.js"></script>';
	if (in_array($_SESSION['id_item_de_menu'], $AplicacionesSmartMenu))
	{
		print '<script type="text/javascript"> flagSmartMenu = true;</script>';
	}
	else
	{
		print '<script type="text/javascript"> flagSmartMenu = false;</script>';	
	}
?>

<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
var isDOM = (document.getElementById ? true : false); 
var isIE4 = ((document.all && !isDOM) ? true : false);
var isNS4 = (document.layers ? true : false);

//**********************************
function getRef(id) 
	{
	if (isDOM) return document.getElementById(id);
	if (isIE4) return document.all[id];
	if (isNS4) return document.layers[id];	
	}
//************************************
function getSty(id) 
	{
	return (isNS4 ? getRef(id) : getRef(id).style);
	} 
//************************************


// Hide timeout.
var popTimer = 0;
// Array showing highlighted menu items.
var litNow = new Array();
//************************************
function popOver(menuNum, itemNum) 
	{
	clearTimeout(popTimer);
	hideAllBut(menuNum);
	litNow = getTree(menuNum, itemNum);
	changeCol(litNow, true);
	targetNum = menu[menuNum][itemNum].target;
	if (targetNum > 0) 
		{
		thisX = parseInt(menu[menuNum][0].ref.left) + parseInt(menu[menuNum][itemNum].ref.left);
		thisY = parseInt(menu[menuNum][0].ref.top) + parseInt(menu[menuNum][itemNum].ref.top);
		with (menu[targetNum][0].ref) 
			{
			left = parseInt(thisX + menu[targetNum][0].x);
			top = parseInt(thisY + menu[targetNum][0].y);
			visibility = 'visible';
			}
		}
	}
//****************************************

function popOut(menuNum, itemNum) 
	{
	if ((menuNum == 0) && !menu[menuNum][itemNum].target)
		hideAllBut(0)
	else
		popTimer = setTimeout('hideAllBut(0)', 500);
	}
//*****************************************

function getTree(menuNum, itemNum) 
	{
	// Array index is the menu number. The contents are null (if that menu is not a parent)
	// or the item number in that menu that is an ancestor (to light it up).
	itemArray = new Array(menu.length);
	while(1) 
		{
		itemArray[menuNum] = itemNum;
		// If we've reached the top of the hierarchy, return.
		if (menuNum == 0) return itemArray;
		itemNum = menu[menuNum][0].parentItem;
		menuNum = menu[menuNum][0].parentMenu;
   		}
	}
//***************************************************

// Pass an array and a boolean to specify colour change, true = over colour.
function changeCol(changeArray, isOver) 
	{
	for (menuCount = 0; menuCount < changeArray.length; menuCount++) 
		{
		if (changeArray[menuCount]) 
			{
			newCol = isOver ? menu[menuCount][0].overCol : menu[menuCount][0].backCol;
			// Change the colours of the div/layer background.
			with (menu[menuCount][changeArray[menuCount]].ref) 
				{
				if (isNS4) 
					bgColor = newCol;
				else 
					backgroundColor = newCol;
         		}
      		}
   		}
	}
//****************************************************

function hideAllBut(menuNum) 
	{
	var keepMenus = getTree(menuNum, 1);
	for (count = 0; count < menu.length; count++)
	if (!keepMenus[count])
		menu[count][0].ref.visibility = 'hidden';
	changeCol(litNow, false);
	}

//************************************************

// *** MENU CONSTRUCTION FUNCTIONS ***
function Menu(isVert, popInd, x, y, width, overCol, backCol, borderClass, textClass) 
	{
	// True or false - a vertical menu?
	this.isVert = isVert;
	// The popout indicator used (if any) for this menu.
	this.popInd = popInd
	// Position and size settings.
	this.x = x;
	this.y = y;
	this.width = width;
	// Colours of menu and items.
	this.overCol = overCol;
	this.backCol = backCol;
	//this.overCol = ;
	//this.backCol = l;
	// The stylesheet class used for item borders and the text within items.
	this.borderClass = borderClass;
	this.textClass = textClass;
	// Parent menu and item numbers, indexed later.
	this.parentMenu = null;
	this.parentItem = null;
	// Reference to the object's style properties (set later).
	this.ref = null;
	}
//************************************************

function Item(text, href, frame, length, spacing, target) 
	{
	this.text = String(text);
	this.href = href;
	this.frame = frame;
	this.length = length;
	this.spacing = spacing;
	this.target = target;
	// Reference to the object's style properties (set later).
	this.ref = null;
	}
//************************************************


function writeMenus() 
	{
	if (flagSmartMenu) 
	{

		for (currMenu = 0; currMenu < menu.length; currMenu++) with (menu[currMenu][0]) 
		{
			// Also use properties of each item nested in the other with() for construction.
			for (currItem = 1; currItem < menu[currMenu].length; currItem++) with (menu[currMenu][currItem]) 
			{
				if (target > 0) 
				{
					// Set target's parents to this menu item.
					menu[target][0].parentMenu = currMenu;
					menu[target][0].parentItem = currItem;
				}
			}
		}
		if (!document.getElementById("main-nav"))
		{
			var nav = document.createElement('nav');
			nav.setAttribute("class", "main-nav");            
			nav.setAttribute("role", "navigation");           
			nav.setAttribute("id", "main-nav");
			var body = document.getElementsByTagName('body').item(0);
			if (body)
			{
				body.prepend(nav);
			}
		}
		inicializarMenu("main-nav", "", "sm-mint");
		return;
	}
	if (!isDOM && !isIE4 && !isNS4) return;
	for (currMenu = 0; currMenu < menu.length; currMenu++) with (menu[currMenu][0]) 
		{
		// Variable for holding HTML for items and positions of next item.
		var str = '', itemX = 0, itemY = 0;
		// Remember, items start from 1 in the array (0 is menu object itself, above).
		// Also use properties of each item nested in the other with() for construction.
		for (currItem = 1; currItem < menu[currMenu].length; currItem++) with (menu[currMenu][currItem]) 
			{
			var itemID = 'menu' + currMenu + 'item' + currItem;
			// The width and height of the menu item - dependent on orientation!
			var w = (isVert ? width : length);
			var h = (isVert ? length : width);
			// Create a div or layer text string with appropriate styles/properties.
			// Thanks to Paul Maden (www.paulmaden.com) for helping debug this in IE4, apparently
			// the width must be a miniumum of 3 for it to work in that browser.
			if (isDOM || isIE4) 
				{
				str += '<div id="' + itemID + '" style="position: absolute; left: ' + itemX + '; top: ' + itemY + '; width: ' + w + '; height: ' + h + '; visibility: inherit; ';
				if (backCol) str += 'background: ' + backCol + '; ';
				str += '" ';
				}
			if (isNS4) 
				{
				str += '<layer id="' + itemID + '" left="' + itemX + '" top="' + itemY + '" width="' +  w + '" height="' + h + '" visibility="inherit" ';
				if (backCol) str += 'bgcolor="' + backCol + '" ';
				}
			if (borderClass) str += 'class="' + borderClass + '" ';
			// Add mouseover handlers and finish div/layer.
			str += 'onMouseOver="popOver(' + currMenu + ',' + currItem + ')" onMouseOut="popOut(' + currMenu + ',' + currItem + ')">';
			// Add contents of item (default: table with link inside).
			// In IE/NS6+, add padding if there's a border to emulate NS4's layer padding.
			// If a target frame is specified, also add that to the <a> tag.
			//alert(String(frame ? ' target="' + frame + '">' : '>'));
			//str += '<table width="' + (w - 8) + '" border="0" cellspacing="0" cellpadding="' + (!isNS4 && borderClass ? 3 : 0) + '"><tr><td align="left" height="' + (h - 7) + '">' + '<a class="' + textClass + '" href="' + href + '"' + (frame ? ' target="' + frame + '"> ' : '>') + text + '</a></td>';
			//str += '<table width="' + (w * 1.8) + '" border="0" cellspacing="0" cellpadding="' + (!isNS4 && borderClass ? 3 : 0) + '"><tr><td align="left" height="' + (h - 7) + '">' + '<a class="' + textClass + '" href="' + href + '"' + (frame ? ' target="' + frame + '"> ' : '>') + text + '</a></td>';
			str += '<table width="' + (w * 2.5) + '" border="0" cellspacing="0" cellpadding="' + (!isNS4 && borderClass ? 3 : 0) + '"><tr><td align="left" height="' + (h - 7) + '">' + '<a class="' + textClass + '" href="javascript:document.consulta.action=\'' + href + '\';document.consulta.submit();"' + (frame ? ' target= "' + frame + '" > ' : '>') + text + '</a></td>';
			//str += '<table width="' + (w - 8) + '" border="0" cellspacing="0" cellpadding="' + (!isNS4 && borderClass ? 3 : 0) + '"><tr><td align="left" height="' + (h - 7) + '">' + '<input class="' + textClass + '" onClick="javascript:open("' + href + '");" ' + (frame ? ' target="' + frame + '">' : '>') + 'values="' + text + '"></td>';
			//alert(str);
			if (target > 0) 
				{
				// Set target's parents to this menu item.
				menu[target][0].parentMenu = currMenu;
				menu[target][0].parentItem = currItem;
				// Add a popout indicator.
				if (popInd) str += '<td class="' + textClass + '" align="right">' + popInd + '</td>';
				}
			str += '</tr></table>' + (isNS4 ? '</layer>' : '</div>');
			if (isVert) 
				itemY += length + spacing;
			else 
				itemX += length + spacing;
			}
	
		if (isDOM) 
			{
			var newDiv = document.createElement('div');
			document.getElementsByTagName('body').item(0).appendChild(newDiv);
			newDiv.innerHTML = str;
			ref = newDiv.style;
			ref.position = 'absolute';
			ref.visibility = 'hidden';
			}
		// Insert a div tag to the end of the BODY with menu HTML in place for IE4.
		if (isIE4) 
			{
			document.body.insertAdjacentHTML('beforeEnd', '<div id="menu' + currMenu + 'div" ' + 'style="position: absolute; visibility: hidden">' + str + '</div>');
			ref = getSty('menu' + currMenu + 'div');
			}
		// In NS4, create a reference to a new layer and write the items to it.
		if (isNS4) 
			{
			ref = new Layer(0);
			ref.document.write(str);
			ref.document.close();
			}
		for (currItem = 1; currItem < menu[currMenu].length; currItem++) 
			{
			itemName = 'menu' + currMenu + 'item' + currItem;
			if (isDOM || isIE4) menu[currMenu][currItem].ref = getSty(itemName);
			if (isNS4) menu[currMenu][currItem].ref = ref.document[itemName];
			}
		}
	with(menu[0][0]) 
		{
		ref.left = x;
		ref.top = y;
		ref.visibility = 'visible';
		}
	}
//************************************************



// Syntaxes: *** START EDITING HERE, READ THIS SECTION CAREFULLY! ***
//
// menu[menuNumber][0] = new Menu(Vertical menu? (true/false), 'popout indicator', left, top,
// width, 'mouseover colour', 'background colour', 'border stylesheet', 'text stylesheet');
//
// Left and Top are measured on-the-fly relative to the top-left corner of its trigger, or
// for the root menu, the top-left corner of the page.
//
// menu[menuNumber][itemNumber] = new Item('Text', 'URL', 'target frame', length of menu item,
//  additional spacing to next menu item, number of target menu to popout);
//
// If no target menu (popout) is desired, set it to 0. Likewise, if your site does not use
// frames, pass an empty string as a frame target.
//
// Something that needs explaining - the Vertical Menu setup. You can see most menus below
// are 'true', that is they are vertical, except for the first root menu. The 'length' and
// 'width' of an item depends on its orientation -- length is how long the item runs for in
// the direction of the menu, and width is the lateral dimension of the menu. Just look at
// the examples and tweak the numbers, they'll make sense eventually :).
var menu = new Array();
// Default colours passed to most menu constructors (just passed to functions, not
// a global variable - makes things easier to change later in bulk).
//var defOver = '#336699', defBack = '#003366';
//var defOver = '#00008b', defBack = '#c0c0c0'; Chechu
var defOver = '#00008b', defBack = '#515054';

// Default 'length' of menu items - item height if menu is vertical, width if horizontal.
var defLength = 22;
// Menu 0 is the special, 'root' menu from which everything else arises.
//menu[0] = new Array();
// A non-vertical menu with a few different colours and no popout indicator, as an example.
// *** MOVE ROOT MENU AROUND HERE ***  it's positioned at (5, 0) and is 17px high now.
//menu[0][0] = new Menu(false, '', 5, 0, 17, '#669999', '#006666', '', 'itemText');
// Notice how the targets are all set to nonzero values...
// The 'length' of each of these items is 40, and there is spacing of 10 to the next item.
// Most of the links are set to '#' hashes, make sure you change them to actual files.
<?php
    require_once "coneccion1.php";
			//echo 'Item: '.$id_item_de_menu.' // Acceso: '.$id_acceso;
			
//************************************************

	function longitudDeMenu()
		{
        return 100;
		}
		
//************************************************

    function tieneSubMenues($id_item_de_menu,$id_acceso)
		{
        $db = coneccionSeguridad();
        $select = " select count(*) " .
                 " from sub_menues a, items_de_menu b" .
                 " where a.ID_SUB_ITEM__MENU = b.ID_ITEM_DE_MENU " .
                 " and a.ID_ITEM_DE_MENU = " . $id_item_de_menu ." and a.ID_ACCESO = ". $id_acceso;
		$result = $db->query($select);
        if (DB::isError($result)) 
			{
			die ($result->getMessage());
			}
			
		$row = $result->fetchRow();
        return $row[0] != 0;
	    }
//************************************************

    	$item_actual = 0;
    $nivel = 0;
	
//************************************************

    function ponerSubMenues( $id_item_de_menu,$id_acceso,$idempleado,$idarea)
		{
        global $item_actual;
        global $nivel;
        if ($item_actual == 0)
			{
			print "menu[0] = new Array();";
			/*print "menu[0][0] = new Menu(false, '', 5, 0, 17, defBack, 'fondo', '', 'itemText');";*/
			print "menu[0][0] = new Menu(false, '', 5, 0, 17, defBack, defBack, '', 'itemText');";
			} 
		else
			{
			print "menu[" . $item_actual . "] = new Array();";
			print "menu[" . $item_actual . "][0] = new Menu(true, '>', 17, 22, 80, defOver, defBack, 'itemBorder', 'itemText');";
			}
		$db = coneccionSeguridad();
		$select = "Select b.link, b.descripcion, a.ID_SUB_ITEM__MENU " .
                 "From sub_menues a, items_de_menu b " .
                 "Where a.ID_SUB_ITEM__MENU = b.ID_ITEM_DE_MENU " .
                 "and a.ID_ITEM_DE_MENU = " . $id_item_de_menu . " and a.ID_ACCESO = " . $id_acceso . " order by a.posicion";
		$result = $db->query($select);
		if (DB::isError($result)) 
			{
			die ($result->getMessage());
			}		
        $actual = 1;
		for ($actual=1; $actual<$result->numRows() + 1; $actual++)
			{
			$row = $result->fetchRow();
            if ($nivel == 0)
				{
                print " menu[" . $item_actual . "][" .$actual . "] = new Item('" . $row[1] . "', '" . $row[0] . "', '', 100, 10, " . $actual . "); ";
				} 
			else 
				{
                if (tieneSubMenues($row[2],$id_acceso))
					{
					print " menu[" . $item_actual . "][" .$actual . "] = new Item('" . $row[1] . "', '" . $row[0] . "', '', defLength, 0, " . ($item_actual + $actual). "); ";
					} 
				else 
					{
					print " menu[" . $item_actual . "][" .$actual . "] = new Item('" . $row[1] . "', '" . $row[0]  . "', '', defLength, 0, 0); ";
					}
				}
			}
		$item_actual++;
		$select = " select b.link, " .
                 "        b.descripcion, " .
                 "        a.ID_SUB_ITEM__MENU " .
                 " from sub_menues a," .
                 " 	 items_de_menu b" .
                 " where a.ID_SUB_ITEM__MENU = b.ID_ITEM_DE_MENU" .
                 "   and a.ID_ITEM_DE_MENU = " . $id_item_de_menu . " and a.ID_ACCESO = " . $id_acceso . " order by a.posicion";
		$result = $db->query($select);

		if (DB::isError($result)) 
			{
			die ($result->getMessage());
			}		
        $actual = 1;
        $nivelActual = $nivel;
        $nivel++;
		for ($actual=1; $actual<$result->numRows() + 1; $actual++)
			{
			$row = $result->fetchRow();
            if (tieneSubMenues($row[2],$id_acceso))
				{
				ponerSubMenues($row[2],$id_acceso,$idempleado,$idarea);
				}
			}
		$nivel = $nivelActual;
		}
//************************************************

	/*
	$select = " SELECT k.ID_ITEM_DE_MENU, k.Id_Acceso" .
         " from Empleados c inner join usuarios_X_roles h on c.idempleado = h.id_usuario, " .
         " roles_x_aplicacion g,"      .
         " accesos_x_rol k"     .
         " where h.id_rol_X_aplicacion = g.id_rol_x_aplicacion " .
         " and g.id_rol_X_aplicacion = k.id_rol_x_aplicacion "  .
         " and g.id_aplicacion = 1 " .
         " AND UPPER(C.USUARIO_NOMBRE) =UPPER('" . desencriptar($_SESSION['usuario'], $_SESSION['numeroDeValidacion']) . "')" .
         " AND UPPER(C.PASSWORD) =UPPER('" . desencriptar($_SESSION['password'], $_SESSION['numeroDeValidacion']) . "') and id_area=" . $idarea; */
		 /*
	$db = coneccionLogin();
	$result = $db->query($select);
	if (DB::isError($result)) 
		{
		die ($result->getMessage());
		}		
	if($result->numRows() != 0) 
		{	
		$row = $result->fetchRow();
		$habilitado = 1;
   		$id_item_de_menu = $row[0];
		$id_acceso = $row[1];*/
		
		ponerSubMenues($_SESSION['id_item_de_menu'],$_SESSION['id_acceso'],$_SESSION['idusuario'],$_SESSION['idarea']);
		/*} 
	else 
		{
		$habilitado = 0;
		} */
?>

if (!flagSmartMenu)
{
	var popOldWidth = window.innerWidth;
	nsResizeHandler = new Function('if (popOldWidth != window.innerWidth) location.reload()');
	// This is a quick snippet that captures all clicks on the document and hides the menus
	// every time you click. Use if you want.
	if (isNS4) document.captureEvents(Event.CLICK);
	document.onclick = clickHandle;
}
else
{
	writeMenus();
}

//************************************************

function clickHandle(evt)
	{
	if (isNS4) document.routeEvent(evt);
	hideAllBut(0);
	}
//************************************************

// This is just the moving command for the example.
function moveRoot()
	{
	with(menu[0][0].ref) left = ((parseInt(left) < 100) ? 100 : 5);
	}
//************************************************
	function buscarUsuario()
	{

	}
//  End -->


</script>



<!-- *** IMPORTANT STYLESHEET SECTION - Change the border classes and text colours *** 
<link rel="stylesheet" type="text/css" href="login.css" />-->
<!--   
</head>    comentado Chechu 26/06/06 -->
	<?php
/*	if ($_SESSION['habilitado']) 
		{
		print '<BODY bgcolor="#E8EBD9" marginwidth="0" marginheight="0" style="margin: 0" onLoad="writeMenus(); buscarUsuario(); MM_preloadImages(\'./imagenes/calendar/calendario_o.gif\')" onResize="if (isNS4) nsResizeHandler()">';
		print '<form name="consulta" method=post action="#" >';
		print '</form>';
		} 
	else 
		{
		print '<BODY bgcolor="#E8EBD9" marginwidth="0" marginheight="0" style="margin: 0" onResize="if (isNS4) nsResizeHandler()">';
		}
	?>
	<table bgcolor="#c0c0c0" width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td height="17"><font size="1">&nbsp; </font></td>
		</tr>
	</table>
	<p><p>
	<?php
	if ($_SESSION['habilitado']) 
		{
		} 
	else 
		{
		print "<p>";
		print "<center>";
		print '<l> Usuario o Password incorrecto.</l3>';
		print "</center>";
		print "<p>";
		print "<center>";
		print '<input class=\'botones\' type="button" value="Volver" onClick="javascript:history.back();" onMouseOut=\'javascript:this.className="botones";\' onMouseOver=\'javascript:this.className="botonesSeleccionados";\'>';
		print "</center>";
		session_unset();
		session_destroy();
		Die('');
		}   comentado Chechu 26/06/06 */
	?>