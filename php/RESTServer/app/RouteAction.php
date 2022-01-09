<?php
include_once 'BreedDB.php';
class RouteAction {
    var $breeds;
    // constructor function
    function __construct() {
        $this->breeds = new BreedsDB();
    }
    // home page views
    function index($request, $response, $args) {
        echo "<h1>Welcome to REST Client Home Page</h1>";
    }
    // retrieve database
    function getBreeds($request, $response, $args) {
        $records = $this->breeds->getBreeds();
        return $response->withHeader('Content-Type', 'application/json')
            ->write(json_encode($records));
    }
    // add to database
    function addBreed($request, $response, $args) {
        $post = $request->getParsedBody();
        foreach ($post as $key => $value) {
            ${$key} = $value;
        }
        $values = [$name, $origin, $type, $coat_colour, $temperament, $temperament, $filename];
        $success = $this->breeds->addBreed($values);
        if ($success) {
            // show message when success
            $data = ['message' => 'Breed record saved to database'];
        } else {
            // show message when fail
            $data = ['message' => 'Fail to saved to database'];
        }
        return $response->withHeader('Content-Type', 'application/json')
            ->write(json_encode($data));
    }
    // search data from database
    function searchBreeds($request, $response, $args) {
        $keyword = $args['keyword'];
        $records = $this->breeds->searchBreeds($keyword);
        return $response->withHeader('Content-Type', 'application/json')
            ->write(json_encode($records));
    }
} //end class
