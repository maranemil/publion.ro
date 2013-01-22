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

class MessagesController extends AppController
{
	/**
	 * No....
	 *
	 * @var string
	 */

	var $name = "Messages";
	
	/**
	 * Helpers 
	 *
	 * @var array
	 */
	
	var $uses = array('User','Message');
	var $helpers = array('Html', 'Javascript', 'Session','Head','Javascript', 'Ajax','Form','Pagination'); 
	var $components = array('Pagination','Email'); 
	

	
	function index(){
		$this->checkIfLogged();
	
		$criteria = null;	
		$arNoMsg = "";
		$criteria = " Message.user_id ='".$this->Session->read("User.id")."' AND Message.delfrom ='0' ";	
		$paging['sortBy']="id";
		$paging['direction']='DESC';
		$paging['show']='10';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpMsg = $this->Message->findAll($criteria,"", $order, $limit, $page);
	
		//print "<pre>"; print_r($arTmpMsg);

		if(isset($arTmpMsg)){
			$this->set("arTmpMsg", $arTmpMsg);
			$this->set("arNoMsg", "");
		}else{
			//$this->set('message',"No Article were found,...");
			//$this->render(null,null,'views/errors/cc_die');
			$arNoMsg = "Nu sunt mesage";
			$this->set("arNoMsg", $arNoMsg);
		} 

		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);

	//	print_r($this->Session ->read("User"));
	}



	function view($id=null){
		$this->checkIfLogged();
	
		$this->Message->query("UPDATE messages SET unread='0' WHERE id='".$id."' ");
		
		$criteria = null;	
		$criteria = " Message.id ='".$id."' AND Message.user_id='".$this->Session->read("User.id")."' ";	
		$paging['sortBy']="id";
		$paging['direction']='DESC';
		$paging['show']='10';

		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpMsg = $this->Message->findAll($criteria,"", $order, $limit, $page);
	
		//print "<pre>"; print_r($arTmpMsg);

		if(isset($arTmpMsg)){
			$this->set("arTmpMsg", $arTmpMsg);
		}else{
			$arNoMsg = "Nu sunt mesage";
			$this->set("arNoMsg", $arNoMsg);
		} 

		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);
		
	//	print_r($this->Session ->read("User"));
	}



	function newmsg(){
		$this->checkIfLogged();

		if($this->data){
			if($this->Message->save($this->data)){
				$this->flash('Mesajul sa trimis...', '/messages/index/');
			}
			else{
				$this->flash('Mesajul nu se poate trimite...', '/messages/index/');
			}
		}else{

			$arToSend = array(
				"from_user_id" => $this->Session ->read("User.id"),
				"user_id" => $this->params["pass"][0]
				);

			$this->set('arToSend',$arToSend);
		}

	}

	function replaymsg($id){
		$this->checkIfLogged();

		if($this->data){
			//print_r($this->data); die();
			/* Array ( [Messages] => 
			Array ( 
			[subject] => how are you 
			[body] => dfgd 
			[from_user_id] => 1 
			[user_id] => 10 
			[unread] => 1 
			[approved] => 1 
			[date] => 2010-06-13 
			*/
			//$this->Message->set("id","4");
			/*
			$this->repmsg = array(
					"Message"=>array(
						"subject"=>$this->data["Message"]["subject"],
						"body"=>$this->data["Message"]["body"],
						"from_user_id"=>$this->data["Message"]["from_user_id"],
						"user_id"=>$this->data["Message"]["user_id"],
						"unread"=>$this->data["Message"]["unread"],
						"approved"=>$this->data["Message"]["approved"],
						"date"=>$this->data["Message"]["date"]
					));
*/
			if($this->Message->save($this->data)){
				$this->flash('Mesajul sa trimis...', '/messages/index/');
			}
			else{
				$this->flash('Mesajul nu se poate trimite...', '/messages/index/');
			}
		}

		$arMsg = $this->Message->findById($id);
		$this->set("arMsg", $arMsg);
		
	}





	function deletemsgfrom($id){

		$this->checkIfLogged();

		//if( isset($this->params['requested']) AND $this->params['requested'] ){
			//$id = $this->params["pass"][0];

			if(!is_numeric($id)){
				//$this->flash('Eroare...', '/messages/index/');
			}
			
			$update = $this->Message->query("UPDATE messages SET delfrom='1' WHERE id=".$id."");
			//if(isset($update)){
				//$this->flash('OK','/messages/index/');
				$this->redirect('/messages/index/');
			//}
		//}
	}










} // end class

?>
