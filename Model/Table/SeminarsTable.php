<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Costs Model
 *
 * @method \App\Model\Entity\Cost get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cost newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cost[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cost|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cost patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cost[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cost findOrCreate($search, callable $callback = null, $options = [])
 */
class SeminarsTable extends Table
{
    public function initialize(array $config){
        $this->belongsTo('Teachers',[
            'dependent'=>'true',
            'foreignKey' => 'TeacherId',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Ideas',[
            'dependent'=>'true',
            'foreignKey'=>'ideaId'
        ]);
    }
}
