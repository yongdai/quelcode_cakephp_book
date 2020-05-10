<?php
namespace App\Controller;

use App\Controller\AppController;

class PeopleController extends AppController {

    public function index() {
        $data = $this->People->find('all');
        $this->set('data', $data);
    }
}
?>