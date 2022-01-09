<?php
require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
// reference to the Twig Environment;
use Twig\Environment;
// reference tp filesystem
use Twig\Loader\FilesystemLoader;

class RequestAction {
    var $client;
    var $view;
    function __construct() {
        //constructor make connection to SLIM server
        //localhost server connection
        $this->client = new Client(['base_uri' => 'http://localhost/RESTServer4648451/']);
        //virtual server connection
        // $this->client = new Client(['base_uri' => 'http://18.215.30.228/RESTServer4648451/']);
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        $this->view = new Environment($loader);
    }
    function index() {
        // view index page
        echo $this->view->render('index.twig');
    }
    //get all database from server
    function getBreeds() {
        $uri = 'breeds';
        $response = $this->client->get($uri);
        $records = json_decode($response->getBody()->getContents(), true);
        //view table content
        echo $this->view->render('breed_table.twig', ['records' => $records]);
    }
    //add data to database
    function addBreed() {
        //has user submitted the Breed form
        if (isset($_POST['submit'])) {
            // _FILES supper global array
            // after submit it contain information
            $filename = $_FILES['image']['name'];
            $temp_file = $_FILES['image']['tmp_name'];
            // define upload directory destination
            $destination = 'static/assets/photos/';
            // define target destination
            $target_file = $destination . $filename;
            // now move the files destination directory
            move_uploaded_file($temp_file, $target_file);
            // fast way to retrieve form from post
            $_POST['filename'] = $filename;
            $uri = 'breeds';
            $response = $this->client->request('POST', $uri, ['form_params' => $_POST]);
            $data = json_decode($response->getBody()->getContents(), true);
            $message = $data['message'];
            echo $this->view->render('message.twig', ['message' => $message]);
        } else {
            // No form submission yet display the form by default
            echo $this->view->render('breed_form.twig');
        }
    }
    // searching data
    function searchBreeds() {
        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $uri = "breeds/keyword/$keyword";
            $response = $this->client->get($uri);
            $records = json_decode($response->getBody()->getContents(), true);
            echo $this->view->render('breed_table.twig', ['records' => $records]);
        } else {
            echo $this->view->render('search_form.twig');
        }
    }
} // end class
