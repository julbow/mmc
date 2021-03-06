 <?php
/**
 * (c) 2004-2007 Linbox / Free&ALter Soft, http://linbox.com
 * (c) 2007-2008 Mandriva, http://www.mandriva.com/
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
 * along with MMC; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// load ZabbixApi
require("modules/monitoring/includes/ZabbixApiAbstract.class.php");
require("modules/monitoring/includes/ZabbixApi.class.php");
require("modules/monitoring/includes/functions.php");
require_once("modules/monitoring/includes/xmlrpc.php");

require("graph/navbar.inc.php");
require("localSidebar.php");

if (isset($_GET['apiId']))
	$apiId = $_GET['apiId'];
else {
	new NotifyWidgetFailure(_T("No api authentification token found!!!", "monitoring"));
	return;
}

$p = new PageGenerator(_T("Media", 'monitoring'));
$p->setSideMenu($sidemenu);
$p->display();

if (isset($_GET["mediatypeid"])) {
	$mediatypeid = $_GET["mediatypeid"];
	try {
		// connect to Zabbix API
		$api = new ZabbixApi();
		$api->setApiUrl(getZabbixUri()."/api_jsonrpc.php");
		$api->setApiAuth($apiId);

		$result = $api->mediatypeDelete(array(
			$mediatypeid
		));

	} catch(Exception $e) {

		// Exception in ZabbixApi catched
		new NotifyWidgetFailure("error ".$e->getMessage());
		redirectTo(urlStrRedirect("monitoring/monitoring/editconfiguration"));
	}
	new NotifyWidgetSuccess("Media deleted");
	redirectTo(urlStrRedirect("monitoring/monitoring/editconfiguration"));
}


$f = new ValidatingForm();

// Display result
if (isset($_POST['bvalid'])) {
	$description = $_POST['description'];
	$address = $_POST['address'];
	$server = $_POST['server'];
	if ($address != "" && $server != "") {
		try {
			// connect to Zabbix API
			$api = new ZabbixApi();
			$api->setApiUrl(getZabbixUri()."/api_jsonrpc.php");
			$api->setApiAuth($apiId);

			$result = $api->mediatypeCreate(array(
				'description' => $description,
				'type' => 0,
				'smtp_server' => $server,
				'smtp_email' => $address
			));

		} catch(Exception $e) {

			// Exception in ZabbixApi catched
			new NotifyWidgetFailure("error ".$e->getMessage());
			redirectTo(urlStrRedirect("monitoring/monitoring/editconfiguration"));
		}
		new NotifyWidgetSuccess("Media created");
		redirectTo(urlStrRedirect("monitoring/monitoring/editconfiguration"));
	} else {
		new NotifyWidgetFailure(_T("No address", "monitoring"));
		redirectTo(urlStrRedirect("monitoring/monitoring/mediaManager&apiId=".$api->getApiAuth()));
	}
}
// Display field
else {

	$f->push(new Table());
	$f->add(
	    new TrFormElement(_T("Description", "monitoring"), new InputTpl("description"),
		array("value" => "", "required" => false)
	    )
	);
	$f->add(
	    new TrFormElement(_T("Mail address", "monitoring"), new InputTpl("address"),
		array("value" => "", "required" => true)
	    )
	);
	$f->add(
	    new TrFormElement(_T("SMTP Server", "monitoring"), new InputTpl("server"),
		array("value" => "", "required" => true)
	    )
	);
	$f->pop();
	$f->addButton("bvalid", _T("Add"), "monitoring");
	$f->pop();
	$f->display();
}

?>
