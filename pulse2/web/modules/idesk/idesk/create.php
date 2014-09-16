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
require("modules/idesk/includes/idesk-xmlrpc.inc.php");
require("modules/inventory/includes/xmlrpc.php");

$login = $_SESSION['login'];
$last_user = $_GET["user"];

if (isset($_GET["cn"])){
    // List of computers	
    $url_params = array();	 
    foreach($_GET as $key => $value){
        if (!in_array($key, array("module", "submod","action"))){
	    $url_params[$key] = $value;  
	}	    
    }
} else {
    // List of users	
    $machine = getMachineByLastLoggedUser($last_user);
    foreach($machine as $key => $value){
	if (is_array($value)){    
	    $url_params[$key] = $value[0];
	} else {
  	    $url_params[$key] = $value;

	}

    }

}
$url_params["machinename"] = $url_params["cn"];

if (!isset($last_user)) {
 
    $inv = getLastMachineInventoryPart2("Summary", array('uuid'=>$_GET["objectUUID"]));
    $last_user = "nobody"; 
    foreach ($inv as $lines){
        foreach($lines as $items){
            if ($items[0] == 'Last Logged User'){
               $last_user = $items[1];
               break;
            }
        }
    }
}

$url = get_url() . "tickets/". $login . "/" . $last_user ."?" . http_build_query($url_params);

header("Location: $url");
?>
