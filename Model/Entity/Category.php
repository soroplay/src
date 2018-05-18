<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Category extends Entity {
    protected $_accessible = [
        'categoryId' => true,
        'categoryName' => true
    ];
}