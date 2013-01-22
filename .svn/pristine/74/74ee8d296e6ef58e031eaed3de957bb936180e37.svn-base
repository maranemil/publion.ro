<?php
/**
 * Controller Companies
 *
 * @author		Maran Emil | Maran Project | maran_emil@yahoo.com
 * @copyright	Copyright 2009, Maran Project.
 * @link		http://maran.pamil-visions.com 
 * @version		1.0
 * @license		http://www.opensource.org/licenses/mit-license.php The MIT License
 */


class HousesController extends AppController
{
	/**
	 * No....
	 *
	 * @var string
	 */

	var $name = "Houses";
	
	/**
	 * Helpers 
	 *
	 * @var array
	 */
	
	var $uses = array('House','User','Judet');
	var $helpers = array('Html', 'Javascript', 'Session','Head','Javascript', 'Ajax','Form','Pagination'); 
	var $components = array('Pagination','Upload'); 
	

	public function index()
	{
		$criteria = null;
		$this->set('title_for_layout','Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
		$paging['sortBy']="id";
		$paging['direction']='DESC';
		$paging['show']='6';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpArt = $this->House->findAll($criteria,"", $order, $limit, $page);

		//print "<pre>"; print_r($arTmpArt); print "</pre>"; 
	
		if($arTmpArt){
			//$this->set(compact('comments','currentDateTime'));
			$this->set("arTmpArt", $arTmpArt);
			$this->pageTitle = 'Publion - Anunturi';
		}else{
			$this->pageTitle = ' - No Articles';
			$this->set('message',"No Article were found,...");
			$this->render(null,null,'views/errors/cc_die');
		} 

		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);

	//	print_r($this->Session ->read("User"));
	}
	

	public function lasthouses($limit = 9) {

		if( isset($this->params['requested']) AND $this->params['requested'] )
		{

		$criteria = " House.image !='' ";
		$order = 'order by House.id DESC';

			//return 	$this->Company->find('all', array('order' => 'Company.id DESC', 'limit' => $limit));
			return $this->House->findAll($criteria,"", $order, $limit, $page);
		}
		else
		{
			return FALSE;
		}
	}




	public function view($id = NULL) {
		$this->set('title_for_layout','Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
		$this->House->id = $id;
		$arTmp  = $this->House->query('SELECT * FROM houses WHERE id='.$id);
		$viewsplus = $arTmp[0]['houses']['views']+1;
		$update = $this->House->query("UPDATE houses SET views = '".$viewsplus."' WHERE id=".$id);


		$this->House->id = $id;			
		$arTmp  = $this->House->query('SELECT * FROM houses WHERE id='.$id);
		//echo $id;
		//print "<pre>"; print_r($comm); print "</pre>";
		$this->set("House", $arTmp);
		
	}



public function searcharticle($searchq = NULL) 
	{
		$this->set('title_for_layout','Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
		$searchq = $this->params['url']['searchq'];

		if($searchq!=NULL){
			$criteria = " `House`.`info` LIKE '%".$searchq."%' ";
		}
		else{
			$criteria = " `House`.`info` LIKE '%brasov%'";
		}

		$paging['sortBy']="date";
		$paging['direction']='DESC';
		$paging['show']='6';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpArt = $this->House->findAll($criteria,"", $order, $limit, $page);
				
		//print "<pre>"; print_r($arTmpCatSubCats); print "</pre>"; 
	
		if(!empty($arTmpArt)){
			//$this->set(compact('comments','currentDateTime'));
			$this->set("arTmpArt", $arTmpArt);
			$this->set("arTmpCatSubCats", $arTmpCatSubCats);
			$this->pageTitle = 'Publion - Anunturi - Search';
		}else{
			$this->pageTitle = ' - No Articles';
			$this->set('message',"Nu sunt rezultate pentru cuvantul cautat...");
			//$this->render(null,null,'views/errors/cc_die');
		} 

		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);
	//	print_r($this->Session ->read("User"));
	}


	public function step1($id = NULL) {
		$this->checkIfLogged();
		$this->pageTitle = 'adauga anunt...';
		$arTmpState = $this->Judet->query('SELECT * FROM judets ORDER BY judets.judet ASC');
		$this->set("arTmpState", $arTmpState);
	}


	public function step2(){
		$this->checkIfLogged();
		//print "<pre>"; print_r($this->data);	print "</pre>"; die();
		$this->pageTitle = 'saving data...';
		//$this->checkSession();

		#####################################################################################
		// .......................start of GD1.6...........................................
		#####################################################################################
		if ($this->data["images"]["File"]["tmp_name"]){

			$output=date('Ymdhis').".jpg";
/*
			$GLOBALS["mupload_file_cakephp"] = $this->data["images"]["File"]["tmp_name"];
			$GLOBALS["mupload_dest_cakephp"] = "../../app/webroot/img/upload2/".date("Ym")."/".$output;
			$GLOBALS["mupload_dpth_cakephp"] = "../../app/webroot/img/upload2/".date("Ym")."/";
			$GLOBALS["mupload_filx_cakephp"] = $output;
*/
			$this->Upload->PbTempFile				= $this->data["images"]["File"]["tmp_name"];
			$this->Upload->PbDestinationDirFile	= "../../app/webroot/img/upload2/".date("Ym")."/".$output;
			$this->Upload->PbDestinationDir		= "../../app/webroot/img/upload2/".date("Ym")."/";
			$this->Upload->PbNewFileName			= $output;
		
			if(!$this->Upload->uploadNewFile()){
				$this->flash('Wrong data!','articles/step1/');
			}
		
		$form_data = array(
						'House' => array(
						'type'				=>	$this->data['House']['type'], 
						'price'				=>	$this->data['House']['price'], 
						'state'				=>	$this->data['House']['state'], 
						'town'				=>	$this->data['House']['town'], 
						'street'			=>	$this->data['House']['street'], 
						'position'			=>	$this->data['House']['position'], 
						'info'				=>	$this->data['House']['info'], 
						'person'			=>	$this->data['House']['person'], 
						'email'				=>	$this->data['House']['email'], 
						'phone'				=>	$this->data['House']['phone'], 
						'web'				=>	$this->data['House']['web'], 
						'date'				=>	date("Y-m-d"), 
						'image'				=>	$output,
						'ip1'				=>	$REMOTE_ADDR,
						'ip2'				=>	$_SERVER['REMOTE_ADDR'],
						'user_id'			=>	$this->Session->read("User.id")
					)
				); 

		if($this->House->save($form_data)) {
				//Displays a Message on success
				$this->flash(''.$lbls["registred_ok"].'Uploaded succesfully', '/articles');
			} 
		}
		else{
			$this->flash('Wrong data!');
		}
		#####################################################################################	
		//print "<pre>"; print_r($this->data);	print "</pre>";// die();
	}


	public function checkIfLogged(){
	//	$this->checkSession();
		if(!$this->Session->read("User")){
			$this->flash('Please login or register first...', '/users/login');
			//$this->redirect(""); 
			exit;
		}
	}



	public function deletehouse($id = NULL) {
		$this->checkIfLogged();
		$artUsrID = $this->House->query("SELECT user_id FROM houses WHERE id =".$id);
		if($this->Session->read("User.id")==$artUsrID[0]["houses"]["user_id"]){
			//Deletes the message
			$this->House->del($id);
			//Displays a success message and redirects to index.thtml
			$this->flash('Anuntul a fost sters.', '/users/myentries/'.$this->Session->read("User.id")); 
		}
	}


		public function getJudetNameById($id = NULL) {
			if( isset($this->params['requested']) AND $this->params['requested'] )
			{
				$criteria = " Judet.id =".$id." ";
				return $this->Judet->findAll($criteria,"", $order, $limit, $page);
			}
		}




}

?>
