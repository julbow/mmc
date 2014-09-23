<?php

/**
 * (c) 2007-2014 Mandriva, http://www.mandriva.com
 *
 * This file is part of Mandriva Management Console (MMC).
 *
 * MMC is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * MMC is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with MMC.  If not, see <http://www.gnu.org/licenses/>.
 */

$sidemenu = new SideMenu();
/*
	* CSS class name to use when rendering the sidebar.
	* You should use the sub-module name
	* */
$sidemenu->setClass("idesk");
/*
 * Register new SideMenuItem objects in the menu.
 * Each item is a menu pane.
 * */
$sidemenu->addSideMenuItem(new SideMenuItem(_T("All tickets"),
	    "idesk", "idesk", "index") 
	);
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Create a ticket"),
	    "idesk", "idesk", "create")
	);


?>
