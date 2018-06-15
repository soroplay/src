<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class TeachersTable extends Table {
    public function validationDefault(Validator $validator){
        $validator->notEmpty('teacherId','登録');

        return $validator;
    }
    
    public function buildRules(RulesChecker $rules){
        $rules->add(isUnique(['teacherId'],'このteacherIdはすでに使用されています。'));
        //$rules->addCreate(new IsUnique(['teacherId']), 'このteacherIdはすでに使用されています。');

        return $rules;
    }

    
}