<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Event\Event;

class SeminarController extends AppController{
	public function initialize(){
		parent::initialize();
		$this->viewBuilder()->autoLayout(true);
        $this->viewBuilder()->layout("seminar");
		date_default_timezone_set('Asia/Tokyo');
		$this->loadModel('Categorys');
		$this->loadModel('Matchings');
		$this->loadModel('Seminars');
		$this->loadModel('Ideas');
		$this->loadModel('Teachers');
		$this->loadModel('Stuents');
		
		//$this->Categorys = TableRegistry::get("categorys");
		/*$this->viewBuilder()->layout("Seminar");*/
	}


	
	public function beforeFilter(Event $event){
		parent::beforeFilter($event);
		$category = array();
		if($this->Categorys !== false){
			foreach ($this->Categorys->find()->all() as $tmp){
				$category += array($tmp->categoryId=>$tmp->categoryName);
			}
			$this->set('category', $category);
		}

	}
	
    public function index(){
		$this->name = 'Seminar';
		$this->Seminar = TableRegistry::get('Seminars');
		if($this->Seminars !== false){
			$this->set('entity', $this->Seminars->newEntity());
			if($this->request->is('post')){
				$data = $this->Seminars->find('all',[
					'conditions'=>array(
						'teacherId' => $this->request->data['search'],
						'seminarFlag' => 2
					)
				]);
			}else{
				$data = $this->Seminars->find('all', [
					'conditions'=>['seminarFlag' => 2]
				]);
			}
		}
        $this->set('data', $data);

		/*$sum = 0;
		foreach($data as $obj){
			$sum += $obj->value;
		}
		$remain = 50000 - $sum;
		$this->set('remain', $remain);

		$today = date("Y-m-d");
		$interval_day = $this->day_diff($today, $end);

		$dayValue = $remain / $interval_day;
		$imageName = "";
		if($dayValue >= 3000){
			$imageName = "good.png";
		}else if($dayValue >= 1500){
			$imageName = "normal.png";
		}else if($dayValue >= 500){
			$imageName = "bad.png";
		}else{
			$imageName = "verybad.png";
		}
		$this->set('imageName', $imageName);*/
    }

    public function input(){
		$entity = $this->Seminars->newEntity();
		$this->set('entity',$entity);
    }

	public function topguestteacher(){
		
	}

	/*
    public function addRecord(){
        if($this->request->is('post')){
            $data = array(
                'costdate'=>h($this->request->data['costdate']),
                'usedetail'=>h($this->request->data['usedetail']),
                'value'=>h($this->request->data['value'])
            );
            $this->Costs->save($this->Costs->newEntity($data));
        }
		$this->set('costdate', isset($data) ? $data['costdate'] : null);
		$this->set('usedetail', isset($data) ? $data['usedetail'] : null);
		$this->set('value', isset($data) ? $data['value'] : null);
    }
	*/

	/*
	public function delRecord($id){
        if($id != null){
            try{
                $entity = $this->Costs->get($id);
                $this->Costs->delete($entity);
            }catch(Exception $e){
                Log::write('debug', $e->getMessage());
            }
        }
        return $this->redirect(['action' => 'index']);
	}
	*/

	/*
    function day_diff($date1, $date2) {
	    // 日付をUNIXタイムスタンプに変換
	    $timestamp1 = strtotime($date1);
	    $timestamp2 = strtotime($date2);
	 
	    // 何秒離れているかを計算
	    $seconddiff = abs($timestamp2 - $timestamp1);
	 
	    // 日数に変換
	    $daydiff = $seconddiff / (60 * 60 * 24);
	 
	    // 戻り値
	    return $daydiff;
    }
	*/
}