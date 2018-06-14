<?php
namespace App\Controller;
session_start();
use Cake\ORM\TableRegistry;	
use Cake\ORM\Query;
use Cake\ORM\Entity;
use Cake\Event\Event;
use Cake\Mailer\Email;

class SeminarController extends AppController{

	public function initialize(){
		$this->loadModel('Categorys'); 
		$this->loadModel('Matchings'); 
		$this->loadModel('Seminars'); 
		$this->loadModel('Ideas'); 
		$this->loadModel('Students');
		$this->loadModel('Teachers');
																																																																																																																																																	 
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

		$teacher = array();
		if($this->Teachers !== false){
			foreach ($this->Teachers->find()->all() as $tmp){
				$teacher += array($tmp->teacherId=>$tmp->teacherName);
			}
			$this->set('teacher', $teacher);
		}

		$entryFee = array();
		if($this->Ideas !== false){
			foreach ($this->Ideas->find()->all() as $tmp){
				$entryFee += array($tmp->ideaId=>$tmp->entryFee);
			}
			$this->set('entryFee', $entryFee);
		}

		$today = strtotime(date('Y-m-d'));
		$endSeminar = $this->Ideas->find('all', [
			'conditions'=>['ideaFlag'=>2, 'eventDate <'=>$today],
			'fields'=>['ideaId']
		]);
		$this->Seminars->updateAll(
			['seminarFlag'=>4],
			['seminarFlag'=>3, 'ideaId'=>$endSeminar]
		);
	}

	public $paginate = [
		'limit' => 10
	]; 
	  
	
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

				$seminar = $this->Seminars->find('all', [
					'conditions'=>['seminarFlag'=>4],
					'fields'=>['seminarId']
				]);
				$rateCnt = $this->Matchings->find('all', [
					'conditions'=>['seminarId IN'=>$seminar, 'studentId'=>$this->request->data['id'], 'estFlag'=>1]
				])->count();

				if($rateCnt == 0){
					$this->redirect(['action'=>'studentTop']);
				}else{
					$this->redirect(['action'=>'studentmypage#est']);
				}
			}
			
		}	
	}

    public function teacherTop(){
		 	$session = $this->request->session();
		    $loginid = $session->read('login.loginid');
				$this->autoRender = true; 
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
						$allData = $this->Ideas->find() 
							->where(['ideaFlag' => 1, 'categoryId' => $tmp_category, 'ideaId NOT IN' => $joinedSeminar]); 
					}else{ 
						$data = $this->Ideas->find() 
							->where(['ideaFlag' => 1, 'ideaId IN' => $joinedSeminar]); 
						$allData = $this->Ideas->find() 
							->where(['ideaFlag' => 1, 'ideaId NOT IN' => $joinedSeminar]); 
					
					} 
			
				} 


				$i = 0;
				$id = array();
				foreach($joinedSeminar as $obj){ 
					$id[$i] = $obj->ideaId; 
					$i = $i + 1; 
				} 

				$this->set('joinedId', $id);
				$this->set('data', $this->paginate($data));
				$this->set('allData', $this->paginate($allData));
				//$this->set('data', $data);
	}

	public function studentTop(){
		$session = $this->request->session();
		$loginid = $session->read('login.loginid');
		$this->name = 'Seminar';
		$this->autoRender = true;
		$this->Seminar = TableRegistry::get('Seminars');
		$tmp_category = 0;
		$tmp_teacher = '';
		if($this->Seminars !== false){
			$this->set('entity', $this->Seminars->newEntity());
			$joinedSeminar = $this->Matchings->find('all', [
				'conditions'=>['studentId' => $loginid],
				'fields'=>['seminarId']
			]);
			if($this->request->is('post') && (!empty($this->request->data['search']) || !empty($this->request->data['category']))){
				$tmp_teacher = $this->request->data['search'];
				$tmp_category = $this->request->data['category'];
				if(!empty($tmp_category) && empty($tmp_teacher)){
					$data = $this->Seminars->find()
							->where(['seminarFlag' => 2, 'categoryId' => $tmp_category, 'seminarId IN' => $joinedSeminar]);
					$allData = $this->Seminars->find()
							   ->where(['seminarFlag' => 2, 'categoryId' => $tmp_category, 'seminarId NOT IN' => $joinedSeminar]);

				}elseif(!empty($tmp_teacher) && empty($tmp_category)){
					$data = $this->Seminars->find()
							->where(['seminarFlag' => 2, 'teacherId' => $tmp_teacher, 'seminarId IN' => $joinedSeminar]);
					$allData = $this->Seminars->find()
							   ->where(['seminarFlag' => 2, 'teacherId' => $tmp_teacher, 'seminarId NOT IN' => $joinedSeminar]);

				}else{
					$data = $this->Seminars->find()
							->where(['seminarFlag' => 2, 'categoryId' => $tmp_category, 'teacherId' => $tmp_teacher, 'seminarId IN' => $joinedSeminar]);
					$allData = $this->Seminars->find()
							   ->where(['seminarFlag' => 2, 'categoryId' => $tmp_category, 'teacherId' => $tmp_teacher, 'seminarId NOT IN' => $joinedSeminar]);
				}

			}else{
				$data = $this->Seminars->find()
						->where(['seminarFlag' => 2, 'seminarId IN' => $joinedSeminar]);
				$allData = $this->Seminars->find()
						   ->where(['seminarFlag' => 2,'seminarId NOT IN' => $joinedSeminar]);
			}

		}

		$data = $data->union($allData);

		foreach ($data as $obj) {

			$query = $this->Matchings->find('all', [
				'conditions'=>array(
					'seminarId' => $obj->seminarId
				)
			]);
			$num[$obj->seminarId] = $query->count();

		}

		$i = 0;
		$id = array();
		foreach($joinedSeminar as $obj){
			$id[$i] = $obj->seminarId;
			$i = $i + 1;
		}

		if (!empty($num)){
			$this->set('cnt', $num);
		}
		$this->set('joinedId', $id);
        $this->set('data', $this->paginate($data));
    }

	public function createSeminar(){
		$session = $this->request->session();
		$loginid = $session->read('login.loginid');
		$this->set('entity', $this->Ideas->newEntity());
		if ($this->request->is('post')){
			switch($this->request->data['confirm']) {
				case 'confirm':
					$this->render('create_seminar_confirm');
					break;
				case 'registry':
					$data = array(
						'studentId'=>h($loginid),
						'title'=>h($this->request->data['title']),
						'eventDate'=>h($this->request->data['eventDate']),
						'entryFee'=>h($this->request->data['entryFee']),
						'requirementDetail'=>h($this->request->data['requirementDetail']),
						'categoryId'=>h($this->request->data['category'])
					);
					$this->Ideas->save($this->Ideas->newEntity($data));
					$this->redirect(['action' => 'student_top']);
					break;
			}
		}
    }
	
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

	public function studentRegistry(){
		$this->Student = TableRegistry::get('students'); 
		$this->set('entity', $this->Students->newEntity());
		if($this->request->is('post')){
			switch($this->request->data['confirm']) {
				case 'confirm':
					if ($this->request->data['password']==$this->request->data['chk_pass']){
						$this->render('student_confirm');
					}else{
						$this->redirect(['action'=> 'studentRegistry']);
					}
					break;
				case 'registry':
					$student = $this->Students->newEntity($this->request->data);
					$this->Students->save($student);
					$this->redirect(['action' => 'login']);
					break;
			}				
		}
	}

	public function seminarStudentRegistry(){
		$session = $this->request->session();
		$loginid = $session->read('login.loginid');
		$this->set('entity', $this->Seminars->newEntity());
		if($this->request->is('post')){
			switch($this->request->data['confirm']) {
				case 'confirm':
					$this->render('seminar_student_registry');
					break;
				case 'registry':
					$row = $this->Matchings->newEntity();
					$row = array(
						'seminarId'=>$this->request->data['seminarId'],
						'studentId'=>h($loginid)
					);
					$this->Matchings->save($this->Matchings->newEntity($row));
					$this->redirect(['action' => 'student_top']);
					break;
			}
		}
	}

	public function seminarStudentCancel(){
		$session = $this->request->session();
		$loginid = $session->read('login.loginid');
		$this->set('entity', $this->Seminars->newEntity());
		if($this->request->is('post')){
			switch($this->request->data['confirm']) {
				case 'confirm':
					$this->render('seminar_student_cancel');
					break;
				case 'cancel':
					$matching = $this->Matchings->find('all', [
						'conditions'=>['seminarId'=>$this->request->data['seminarId'], 'studentId'=>$loginid]
					]);
					foreach($matching as $obj) {
						$row = $this->Matchings->get([$obj->seminarId, $obj->studentId]);
						$this->Matchings->delete($row);
					}
					$this->redirect(['action' => 'student_top']);
					break;
			}
		}

	}

	public function teacherSeminarRegistry(){
		$session = $this->request->session();
		$loginid = $session->read('login.loginid');
		$today = strtotime(date('Y-m-d'));
		$seminar = $this->Seminars->find('all', [
			'conditions'=>['teacherId'=>$loginid, 'seminarFlag'=>2]
		]);
		$seminarList = array();
		$i = 0;
		foreach($seminar as $obj){
			$studentCnt = $this->Matchings->find('all', [
				'conditions'=>['seminarId'=>$obj->seminarId]
			])->count();

			$idea = $this->Ideas->find('all', [
				'conditions'=>['ideaId'=>$obj->ideaId],
			]);
			if(strtotime($obj->dueDate) < strtotime(date('Y-m-d')) || $obj->capacity <= $studentCnt){
				foreach($idea as $tmp){
					$seminarList += [$i=>[
						'id'=>$obj->seminarId,
						'title'=>$obj->seminarTitle,
						'eventDate'=>$tmp->eventDate,
						'count'=>$studentCnt,
						'reward'=>$tmp->entryFee * $studentCnt
						]];
				}
				
			}
			$i = $i + 1;
		}
		$this->set('seminarList', $seminarList);
	}

	public function teacherSeminarCancel($id){
		$seminar = $this->Seminars->find('all', [
			'conditions'=>['seminarId'=>$id]
		]);

		foreach($seminar as $obj){
			//$this->sendNotification($student, $obj->seminarTitle);
			$this->sendNotification($id, $obj->seminarTitle);
		}
		$this->Matchings->deleteAll(['seminarId'=>$id]);

		$this->redirect(['action'=>'student_top']);

	}

	public function checkTeacherProfile(){
		$teacher = $this->Teachers->find('all', [
			'conditions'=>['teacherId'=>'teacher1']
		]);
		$achievement = $this->achievementList('teacher1');
		foreach($teacher as $obj) {
			$this->set('photograph', $obj->photograph);
			$this->set('teacherName', $obj->teacherName);
			$this->set('rate', $obj->rate);
		}
		$this->set('achievement', $achievement);
	}

	public function achievementList($teacherId){
		$result = $this->Seminars->find('all', [
			'conditions'=>['teacherId'=>$teacherId, 'seminarFlag'=>4]
		]);
		return $result;
	}

	public function sendNotification($id, $title){
		$studentId = $this->Matchings->find('all', [
			'conditions'=>['seminarId'=>$id],
			'fields'=>['studentId']
		]);
		$student = $this->Students->find('all', [
			'conditions'=>['studentId IN'=>$studentId]
		]);

		$sourceFunc = debug_backtrace();
		if($sourceFunc[1]['function'] == 'teacherSeminarCancel') {
			$template = 'cancel_notification';
		}else{
			$template = 'open_notification';
		}

		foreach($student as $obj){
			$email = new Email('default');
			$email->setFrom(['zigbee3608@gmail.com'=>'emazemi'])
				  ->setTo($obj->mailAddress)
				  ->setSubject('セミナー情報')
				  ->template($template)
				  ->viewVars([
					  'name'=>$obj->studentName,
					  'seminar'=>$title,
					  //'date'=>$date
				  ])
				  ->emailFormat('html')
				  ->send();
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
				if($seminars->seminarFlag == 3) {
					$this->sendNotification($seminars->seminarId, $seminars->seminarTitle);
				}
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

	public function ideadelete(){
		$ideasTable = TableRegistry::get('Ideas');
		$ideas = $ideasTable->get([$this->request->data['ideaId']]);
		try{
			$ideasTable->delete($ideas);
		}catch(Exception $e){
			print($e);
			exit();
		}
		$this->redirect(['action'=>'studentmypage']);
	}


	//評価更新機能
	public function estupdata(){
		$id = 123;
		$teachersTable = TableRegistry::get('Teachers');
		$matchingsTable = TableRegistry::get('Matchings');
		$matchings = $matchingsTable->get([$this->request->data['seminarId'],$this->request->data['studentId']]);
		$teachers = $teachersTable->get($this->request->data['teacherId']);
		$teachers->rate += $this->request->data['rate'];
		$teachers->rateCnt += 1;
		$matchings->estFlag +=1;
		if($teachersTable->save($teachers)){
			if($matchingsTable->save($matchings)){
				$this->redirect(['action' => 'studentmypage']);
			}
			print("マッチングテーブルエラー");
		}
	}



	//マッチング削除
	public function Matchingdelete(){
		$MatchingsTable = TableRegistry::get('Matchings');
		$Matchings = $MatchingsTable->get([$this->request->data['seminarId'],$this->request->data['studentId']]);
		try{
			$MatchingsTable->delete($Matchings);
		}catch(Exception $e){
			print($e);
			exit();
		}
		$this->redirect(['action'=>'studentmypage']);
	}
	public function topguestteacher(){
		$this->set('entity', $this->Ideas->newEntity());
		$data = $this->Ideas->find()->where(['ideaFlag'=>'1']);
		$this->set('data',$data);
	}
	public function studentmypage(){
		//プロフィール
		$id = 123;
		//受講者プロフィールに表示する内容
		$profile = $this->Students->find()->where(['studentId'=>$id]);
		foreach($profile as $data){
			$this->set('profile',$data);
		}

		//発案
		//post判定
		if($this->request->is('post')){
			//categoryidが０またはnull場合は全て取得
			if(empty($this->request->data['ideassearch'])){
				$ideas = $this->Ideas->find()->where(['studentId'=>$id])->where(['Ideas.ideaFlag'=>'1']);
			}else{
				//categoryIDで指定をした発案を取得
				$categoryid = $this->request->data['ideassearch'];
				$ideas = $this->Ideas->find()->where(['Ideas.studentId'=>$id,'Ideas.CategoryId'=>$categoryid,'Ideas.ideaFlag'=>'1']);
			}
		}else{
			//studentIDに一致する発案を全て取得
			$ideas = $this->Ideas->find()->where(['studentId'=>$id])->where(['Ideas.ideaFlag'=>'1']);
		}
		$this->set('ideas',$ideas);
		
		//セミナー
		if($this->request->is('post')){
			//categoryidが０またはnullの場合は全て取得
			if(empty($this->request->data['seminarsearch'])){
				//MatchingsテーブルにSeminarsテーブルを結合し参加中のセミナー全てを取得
				$seminars = $this->Matchings->find()->contain(['Seminars'])->where(['Matchings.studentId'=>$id])->where(['Matchings.estFlag'=>'1']);
			}else{
				$categoryid = $this->request->data['seminarsearch'];
				//MatchingsテーブルにSeminarsテーブルを結合しcategoryIdの一致するセミナー全てを取得
				$seminars = $this->Matchings->find()->contain(['Seminars'])->where(['Matchings.studentId'=>$id])->where(['Seminars.categoryId'=>$categoryid])->where(['Matchings.estFlag'=>'2']);
			}
		}else{
			//MatchingsテーブルにSeminarsテーブルを結合し参加中のセミナー全てを取得
			$seminars = $this->Matchings->find()->contain(['Seminars'])->where(['Matchings.studentId'=>$id])->where(['Matchings.estFlag'=>'1']);
		}
		$this->set('seminars',$seminars);

		//評価
		$estteacher = 0;
		if($this->request->is('post')){
			if(!empty($this->request->data['estimation'])){
				$estteacher = $this->request->data['estimation'];
			}
		}
		switch ($estteacher){
			case 0:
				$teacherlist = $this->Matchings->find('all')->contain(['Seminars.Teachers'])->where(['Matchings.estFlag'=>'1'])->where(['Matchings.studentId'=>$id]);
				break;
			case 1;
				$teacherlist = $this->Matchings->find('all')->contain(['Seminars.Teachers'])->where(['Matchings.estFlag'=>'2'])->where(['Matchings.studentId'=>$id]);
				break;
			default:

		}
		$this->set('ests',$teacherlist);
	}


	//受講者プロフィール編集
	public function studentprofileeditor(){
		$id = 123;
		$studentsTable = TableRegistry::get('Students');
		$students = $studentsTable->get($id);
		$this->set('entity', $this->Students->newEntity());
		if(!empty($this->request->data['editor'])){
			if(empty($this->request->data['photograph'])){
			}else{
				$students->photograph = file_get_contents($this->request->data['photograph']['tmp_name']);
			}
			$students->mailAddress = $this->request->data['mail'];
			$students->studentName = $this->request->data['studentName'];
			$students->phoneNumber = $this->request->data['phone'];
			$students->password = $this->request->data['pass'];
			$students->creditInfo = $this->request->data['creditInfo'];
			if($studentsTable->save($students)){
				$this->redirect(['action' => 'studentmypage']);
			}
		}
	}


	//応募講師一覧
	public function proposalteacherlist(){
		$id = 123;
		$getId = $_GET['id'];
		$getStudentId = $_GET['student'];
		$proposalteacher = $this->Seminars->find('all')->contain(['Teachers'])->where(['Seminars.ideaId'=>$getId])->where(['Seminars.seminarFlag'=>'1']);
		$this->set('prsteacher',$proposalteacher);
		$this->set('studentId',$getStudentId);
	}
	
	public function topgueststudent(){
		$this->seminars = TableRegistry::get('seminars');
		$data=$this->seminars->find('all');
		$this->set('data',$data);
		$this->set('data',$this->paginate($data));
	}
	
	public function teacherProfileEdit(){
		$teachersTable = TableRegistry::get('teachers');
		$this->set('entity', $teachersTable->newEntity());
		if($this->request->is('post')){
			if($this->request->data['password'] == $this->request->data['password_confirm']){
				$teacher = $teachersTable->newEntity($this->request->data);
				$teachersTable->save($teacher);
				$this->redirect(['action' => 'teacherMyPage']);
			}else{
				$this->redirect(['action' => 'teacherProfileEdit']);
			}
		}
	}
	
	public function teacherMyPage(){
		$teacherId='test';
		$teachersTable = TableRegistry::get('teachers');
		$teacher=$teachersTable->find()->where(['teacherId'=>$teacherId])->first();
		$this->set('teacher',$teacher);
		//セミナー
		$seminarsTable = TableRegistry::get('seminars');
		$categorysTable = TableRegistry::get('categorys');
		$ideasTable = TableRegistry::get('ideas');
		$categoryId = $this->request->data['category'];
		if($categoryId==null){
			$seminarId=$seminarsTable->find('all')->toArray();
			$this->set('seminarId',$seminarId);
		}else{
			$categoryId=$this->request->data['categoryId'];
			$ideaId=$ideasTable->find()->select(['ideaId'])->where(['categoryId'=>$categoryId]);
			$seminarId=$seminarsTable->find()->where(['ideaId'=>$ideaId])
											->toArray();
			$this->set('seminarId',$seminarId);
		}
		$this->redirect(['action' => 'teacherMyPage']);
		//開催予定
		$seminarsTable = TableRegistry::get('seminars');
		$categorysTable = TableRegistry::get('categorys');
		$ideasTable = TableRegistry::get('ideas');
		$categoryId = $this->request->data['category'];
		if($categoryId==null){
			$seminarId=$seminarsTable->find()->where(['teacherid'=>$teacherId])->toArray();
			$this->set('seminarId',$seminarId);
		}else{
			$categoryId=$this->request->data['categoryId'];
			$ideaId=$ideasTable->find()->select(['ideaId'])->where(['categoryId'=>$categoryId]);
			$seminarId=$seminarsTable->find()->where(['teacherId'=>$teacherId,'ideaId'=>$ideaId])
											->toArray();
			$this->set('seminarId',$seminarId);
		}
		$this->redirect(['action' => 'teacherMyPage']);
	}
	
	public function createProposal(){
		$seminarsTable = TableRegistry::get('seminars');
		$this->set('entity', $seminarsTable->newEntity());
		if($this->request->is('post')){
			switch($this->request->data['proposal_confirm']) {
				case 'confirm':
				if ($this->request->data['seminarTitle'] != null){
					$this->render('proposal_confirm');
				}else{
					$this->redirect(['action'=> 'createProposal']);
				}
				break;
				case 'proposal':
				$seminar = $seminarsTable->newEntity($this->request->data);
				$seminarsTable->save($seminar);
				$this->redirect(['action' => 'teacherTop']);
				break;
			}
		}
	}
}



	
