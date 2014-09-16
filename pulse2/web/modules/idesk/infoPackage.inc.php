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

/**
 * idesk module declaration
 */
require_once("modules/pulse2/version.php");

$MMCApp = & MMCApp::getInstance();
$base = &$MMCApp->getModule('base');
$computers = & $base->getSubmod('computers');
$users = & $base->getSubmod('users');

$mod = new Module("idesk");
$mod->setVersion(VERSION);
$mod->setRevision(REVISION);
$mod->setDescription(_T("iDesk ticket system module", "idesk"));
$mod->setAPIVersion("0:1:0");
$mod->setPriority(900);

$submod = new SubModule("idesk", _T("Issues", "idesk"));
$submod->setDefaultPage("idesk/idesk/index");
$submod->setPriority(150);
$submod->setImg("modules/idesk/graph/img/idesk");

$page = new Page("index", _T("IronDesk tickets", "idesk"));
$submod->addPage($page);

$page = new Page("create", _T("Create a ticket", "idesk"));
$submod->addPage($page);
 
if (!empty($computers)) {
    $page = new Page("ideskcreate", _T("Create a ticket", "idesk"));
    $page->setFile("modules/idesk/idesk/create.php");
    $computers->addPage($page);
    unset($base);
    unset($computers);
}    
if (!empty($users)) {
    $page = new Page("ideskcreate", _T("Create a ticket", "idesk"));
    $page->setFile("modules/idesk/idesk/create.php");
    $users->addPage($page);
    unset($base);
    unset($users);
}    



$mod->addSubmod($submod);

$MMCApp->addModule($mod);


?>
<script type='text/javascript'>
jQuery('#navbaridesk a').attr('target', '_blank');
jQuery('.idesk a').click(function(event) {
    event.preventDefault();
    window.open(jQuery(this).attr("href"), "popupWindow", "width=600,height=400,scrollbars=yes, top=100, left=100, resizable=yes, scrollbars=yes, toolbar=no, menubar=no, location=no,directories=no, status=no'");
});
</script>
