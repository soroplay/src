<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class MatchingsTable extends Table {
    public function initialize(array $config){
        $this->belongsTo('Seminars',[
            'dependent'=>'true',
            'foreignKey' => 'seminarId',
            'joinType' => 'INNER'
        ]);
    }
}