<?php /** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpUnused */

/**
 * @property $Session
 * @property $Pagination
 * @property $Getnews
 * Controller Companies
 * @author         Maran Emil | Maran Project | maran_emil@yahoo.com
 * @copyright      Copyright 2009, Maran Project.
 * @link           http://maran.pamil-visions.com
 * @version        1.0
 * @license        http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class GetnewsController extends AppController {
   /**
	* No....
	* @var string
	*/

   public $name = "Getnews";

   /**
	* Helpers
	* @var array
	*/

   public $uses       = array('Getnew', 'User');
   public $helpers    = array('Html', 'Javascript', 'Session', 'Head', 'Javascript', 'Ajax', 'Form', 'Pagination');
   public $components = array('Pagination', 'Upload');

   public function index() {
	  $criteria = null;

	  $paging['sortBy']    = "date";
	  $paging['direction'] = 'DESC';
	  $paging['show']      = '6';

	  list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
	  $arTmpArt = $this->Getnews->findAll($criteria, "", $order, $limit, $page);


	  if ($arTmpArt) {
		 //$this->set(compact('comments','currentDateTime'));
		 $this->set("arTmpArt", $arTmpArt);
		 $this->pageTitle = 'Publion - Anunturi';
	  }
	  else {
		 $this->pageTitle = ' - No Articles';
		 $this->set('message', "No Article were found,...");
		 $this->render(null, null, 'views/errors/cc_die');
	  }

	  $arTmpUsr = $this->Session->read("User");
	  $this->set("arTmpUsr", $arTmpUsr);
   }

}


