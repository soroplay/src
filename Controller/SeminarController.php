<?php
namespace App\Controller;
session_start();
use Cake\ORM\TableRegistry;	
use Cake\ORM\Query;
use Cake\Event\Event;
class SeminarController extends AppController{

	public function initialize(){
		$this->loadModel('Categorys'); 
		$this->loadModel('Matchings'); 
		$this->loadModel('Seminars'); 
		$this->loadModel('Ideas'); 
		$this->loadModel('Students');
																																																																																																																																																	 
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
	public function login(){
		$session = $this->request->session();
		$this->Students = TableRegistry::get('students');
		$this->Teachers= TableRegistry::get('teachers');
		$this->Seminars= TableRegistry::get('seminars');
		
		$this->Matchings= TableRegistry::get('matchings');
		$this->set('entity',$this->Students->newEntity());
		$this->set('entity',$this->Teachers->newEntity());
		$this->set('entity',$this->Seminars->newEntity());
		$this->set('entity',$this->Matchings->newEntity());
		if($this->request->is('post')){
			$id = $this->request->data['id'];
			
			$password = $this->request->data['password'];
			$student = $this->Students->find('all',[
				'conditions'=>array(['studentId'=>$id],
				['password'=>$password])]
			);			
			$this->set('student',  $student);
			if($student->isEmpty()){
				$teacher = $this->Teachers->find('all',[                              
					'conditions'=>array(['teacherId'=>$id],
					['password'=>$password])]
				);
				$this->set('teacher', $teacher);
			
				if($teacher->isEmpty()){
					$this->redirect(['action'=> 'login']);
				}else{
					$capacity = $this->Seminars->find('all',[
						'conditions'=>['teacherId'=>$id],
						'fields'=>['capacity']]
					);
					
					$seminars = $this->Seminars->find()
					->select(['seminarId','dueDate','capacity'])
					->where(['teacherId'=>$id]);
					
					
					foreach($seminars  as  $obj){
						$studentid = $this->Matchings->find()
						->select(['studentId'])
						->where(['seminarId'=>$obj->seminarId]);
					
						   if((strtotime($obj->dueDate) <= strtotime(date('Y/m/d')))||($obj->capacity <= $studentid->count())){
							$session->write('loginid',$this->request->data['id']);
								$this->redirect(['action'=> 'teacherseminar_Registry']);
						   }
					}
					$session->write('loginid',$this->request->data['id']);
					$this->redirect(['action'=> 'teacherTop']);
			   
				}
	  		}else{
				$student = $this->Students->find('all',[
					'conditions'=>array(['studentId'=>$this->request->data['id']],
					['password'=>$this->request->data['password']])]
				);
				$session->write('login.studentid',$this->request->data['id']);
				$this->redirect(['action'=> 'studentTop']);
			}
			
		}	
	}	
   /* public function teacherTop(){
		 	$session = $this->request->session();
		    $loginid = $session->read('loginid'); 
				$this->autoRender = true; 
				$this->Category = TableRegistry::get('categorys');
				$this->Seminars = TableRegistry::get('seminars'); 
				$this->Ideas = TableRegistry::get('ideas'); 
				$tmp_category = 0; 
				
				if($this->Seminars !== false){ 
					$this->set('entity', $this->Ideas->newEntity()); 
					$joinedSeminar = $this->Seminars->find('all', [ 
					'conditions'=>['teacherId' => $loginid,'seminarFlag'=> 1], 
					'fields'=>['ideaId'] 	
					
					]); 

					if($this->request->is('post') && !empty($this->request->data['category'])){ 
						$tmp_category = $this->request->data['category']; 
						$data = $this->Ideas->find() 
						->where(['ideaFlag' => 1, 'categoryId' => $tmp_category, 'ideaId IN' => $joinedSeminar]); 
						$Data = $this->Ideas->find() 
							->where(['ideaFlag' => 1, 'categoryId' => $tmp_category, 'ideaId NOT IN' => $joinedSeminar]); 
					}else{ 
						$data = $this->Ideas->find() 
							->where(['ideaFlag' => 1, 'ideaId IN' => $joinedSeminar]); 
						$Data = $this->Ideas->find() 
							->where(['ideaFlag' => 1, 'ideaId NOT IN' => $joinedSeminar]); 
					
					} 
			
				} 
				echo $loginid;
			   echo $data->count();
			   echo $Data->count();
				$i = 0; 
				foreach($joinedSeminar as $obj){ 
					$id[$i] = $obj->ideaId; 
					$i = $i + 1; 
				} 
				echo $joinedSeminar->count();
				//echo $data_tmp->count();
				//print_r($data);
				echo $Data->count();
				$this->set('joinedId', $id); 
				//$this->set('data', $this->paginate($data));
				$this->set('Date',$this->paginate($Data));

		

	}*/
	
	
	public function logout(){
		$session = $this->request->session();
		$session->destroy();
		$this->redirect(['action'=> 'guestTop']);
	}


	public function teacherRegistry(){
		$this->Teachers = TableRegistry::get('teachers'); 
		$this->set('entity', $this->Teachers->newEntity());
		if($this->request->is('post')){
			switch($this->request->data['confirm']) {
				case 'confirm':
					if ($this->request->data['password']==$this->request->data['chk_pass']){
						$this->render('teacher_confirm');
					}else{
						$this->redirect(['action'=> 'teacherRegistry']);
					}
					break;
				case 'registry':
					$teacher = $this->Teachers->newEntity($this->request->data);
					$this->Teachers->save($teacher);
					$this->redirect(['action' => 'login']);
					break;
			}				
		}
	}


	//(セミナーフラグ・アイデアフラグ)カウントアップ
	public function flagup(){
		if(!empty($this->request->data['seminarId'])){
			//seminarId更新
			$seminarsTable = TableRegistry::get('Seminars');
			$seminars = $seminarsTable->get([$this->request->data['seminarId']]);
			$seminars->seminarFlag += 1;
			try{
				$seminarsTable->save($seminars);
			}catch(\Exception $e){
				print("データベース保存エラー(seminar)");
				print('時間を置いてもう一度お願いします');
				exit();
			}
		}
		if(!empty($this->request->data['ideaId'])){
			//ideaId更新
			$ideasTable = TableRegistry::get('Ideas');
			$ideas = $ideasTable->get([$this->request->data['ideaId']]);
			$ideas->ideaFlag += 1;
			try{
				$ideasTable->save($ideas);
			}catch(\Exception $e){
				print('データベース保存エラー(idea)');
				print('時間を置いてもう一度お願いします');
				exit();
			}
		}
		if(!empty($this->request->data['matchinginput']) && $this->request->data['matchinginput'] == true){
			$matchingsTable = TableRegistry::get('matchings');
			$matching = $matchingsTable->newEntity();
			$matching->seminarId = $this->request->data['seminarId'];
			$matching->studentId = $this->request->data['studentId'];
			$matching->estFlag = 1;
			try{
				$matchingsTable->save($matching);
			}catch(\Exception $e){
				print('データセーブエラー');
				exit();
			}
		}
		$this->redirect(['action'=>'index']);
	}
}
   
