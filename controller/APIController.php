<?php
class APIController 
{
    public function getLocations()
    {
        header('Content-Type: application/json');
        $publication = new PublicationManager;
        $pubs = $publication->getInformations();
        echo json_encode($pubs);
        exit();
    }
}
?>