<?php
//include function pages;
include_once 'config.php';
include_once 'app/RequestAction.php';
$requestAction = new RequestAction();
// has the user selected the addBreed link
if (isset($_GET['action'])) {
    //retrieve the action value
    $action = $_GET['action'];
    // check if it is addBreed
    if ($action == 'addBreed') {
        $requestAction->addBreed();
    } elseif ($action == 'getBreeds') {
        // create dummy records
        $requestAction->getBreeds();
    } elseif ($action == 'searchBreeds') {
        $requestAction->searchBreeds();
    }
} else {
    //No links selected page loads default home
    $requestAction->index();
}
