<?php
//header('Content-Type: application/JSON');
$api = new APIController;
$pubs = $api->getLocations();
//echo json_encode($pubs);
?>