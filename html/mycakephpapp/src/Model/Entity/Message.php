<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Messages extends Entity {

    protected $_accessible = [
        'person_id' => true,
        'message' => true
    ];
}
?>