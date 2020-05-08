<?php
namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController {
    //public $autoRender = false;

    public function index() {
        $this->viewBuilder()->autoLayout(false);
        $this->set('title','Hello!');
    }

    public function form() {
        $this->viewBuilder()->autoLayout(false);
        $name = $this->request->data['name'];
        $mail = $this->request->data['mail'];
        $age = $this->request->data['age'];

        $res = 'こんにちは、' . $name . '(' . $age .
                ')さん。メールアドレスは、' . $mail . '　ですね？';
        $values = [
            'title'=>'Rsult',
            'message'=>'$res'
        ];
        $this->set($values);
    }
}
?>