<?php

//uses('L10n');
//uses('I18n');

class AppController extends Controller {

   var $cleandata = array();
   var $uses      = array('User', 'Car', 'House', 'Article', 'Friend', 'Fav');
   var $helpers   = array('Html', 'Form', 'Javascript', 'Time', 'Text', 'Chart');

   function beforeFilter() {
	  if (!empty($this->data)) {
		 uses('sanitize');
		 $sanitize        = new Sanitize();
		 $this->cleandata = $sanitize->clean($this->data);
	  }
   }

   function Db2StrDate($date) {
	  $day   = substr($date, 8, 2);
	  $month = substr($date, 5, 2);
	  $year  = substr($date, 0, 4);

	  if (substr($day, 0, 1) == '0') {
		 $day = str_replace("0", "", $day);
	  }
	  if (substr($month, 0, 1) == '0') {
		 $month = str_replace("0", "", $month);
	  }

	  $DataTransformInput = $day . '.' . $month . '.' . $year;
	  return $DataTransformInput;
   }

   function checkIfLogged() {
	  //	$this->checkSession();
	  if (!$this->Session->read("User")) {
		 //$this->flash('Please login or register first...', '/users/login');
		 $this->Session->setFlash('Sorry, the information you\'ve entered is incorrect.');
		 $this->redirect("/users/login");
	  }
   }

   function checkIfBelongsToArea($id) {
	  if ($this->Session->read("User.id") != $id) {
		 $this->flash('This Page not exist...', '/');
	  }
   }

}

?>