<?php
class APIController 
{
    public function getLocations()
    {
        header('Content-Type: application/json');
        $publication = new PublicationManager;
        $pubs = $publication->getLocations();
        //var_dump($pubs);
        echo json_encode($pubs);
    }
}
?>