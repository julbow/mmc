<?php

/**
 * (c) 2012 Mandriva, http://www.mandriva.com
 *
 * $Id$
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

$idesk_url = "main.php?module=base&submod=users&action=ideskcreate&user=" . $_GET['user'];
      
#$idesk_link = new HyperlinkTpl($idesk_url, "modules/base/graph/computers/idesk_shortcut.png");
#//http://pulse-server/mmc/main.php?module=base&submod=users&action=create&user=admin
#$f->add(new TrFormElement(_("Create ticket"), $idesk_link));

$paramArray = array('cn' => $_SESSION['cn'], 'objectUUID' => $_SESSION['objectUUID']);

$ideskAction = new ActionItem(_("iDesk issue"), "ideskcreate", "idesk", "computer", "base", "computers");


$actions = array($ideskAction);

echo "<ul class='action'>";
foreach ($actions as $action){
        echo "<li class=\"".$action->classCss."\" style=\"list-style-type: none; border: none; float:left; \" >";
        echo "<a title=\"".$action->desc."\" href=\"" . $idesk_url . "\">&nbsp;</a>";
        echo "</li>";
}
echo "</ul>";
?>

<script type='text/javascript'>
jQuery('#navbaridesk a').attr('target', '_blank');
jQuery('.idesk a').click(function(event) {
    event.preventDefault();
    window.open(jQuery(this).attr("href"), "popupWindow", "width=600,height=400,scrollbars=yes, top=100, left=100, resizable=yes, scrollbars=yes, toolbar=no, menubar=no, location=no,directories=no, status=no'");
});
</script>
