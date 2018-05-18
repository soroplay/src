<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Matching extends Entity {
    protected $_accessible = [
        'seminarid' => true,
        'studentid' => true
    ];
}