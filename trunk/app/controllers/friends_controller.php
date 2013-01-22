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


class FriendsController extends AppController
{
		/**
		 * No....
		 *
		 * @var string
		 */

		var $name = "Friends";
			
		/**
		 * Helpers 
		 *
		 * @var array
		 */

		var $uses = array('Category','User','Subcategory','Article','Fav','Friend');
		var $helpers = array('Html', 'Javascript', 'Session','Head','Javascript', 'Ajax','Form'); 

		public function index(){

		}


		function addtofriends(){

			$this->layout = "ajax";
			$userid = $this->Session->read("User.id");
			$idArtx = $this->params["pass"][0];

			if(!$this->checkfriendexists($userid,$idArtx)){
				$sSQL = "INSERT INTO friends (id,user_id,friend_id) VALUES ('','".$userid."','".$idArtx."')";
				//echo $sSQL; die();

				$this->Friend->query($sSQL);
			}
			//$this->flash('Anuntul a fost salvat la fav.', '/users/myentries/'.$this->Session->read("User.id")); 
		
		}


		function checkfriendexists($userid,$idArtx){

			$criteria = " Friend.user_id ='".$userid."' and Friend.friend_id ='".$idArtx."'  "; // 
			$arTMp = $this->Friend->findAll($criteria,"");

			//print "<pre>"; print_r($arTMp);	die();
			if($arTMp){
				return true;
			}
			else{
				return false;
			}
		}


		function deletefriend() {
			$this->checkIfLogged();
			$idFriend = $this->params["pass"][0];
			$arUsrID = $this->Friend->query("SELECT * FROM friends WHERE friend_id =".$idFriend);
			//print_r($artUsrID); die();
			if($this->Session->read("User.id")==$arUsrID[0]["friends"]["user_id"]){
				//Deletes the message
				$this->Friend->del($arUsrID[0]["friends"]["id"]);
				//Displays a success message and redirects to index.thtml
				$this->flash('Prietenul a fost sters din lista.', '/users/myfriends/'.$this->Session->read("User.id")); 
			}
		}




	}

?>