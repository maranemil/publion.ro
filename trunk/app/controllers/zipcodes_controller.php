<?php
/**
 * Controller Companies
 * @author         Maran Emil | Maran Project | maran_emil@yahoo.com
 * @copyright      Copyright 2009, Maran Project.
 * @link           http://maran.pamil-visions.com
 * @version        1.0
 * @license        http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class ZipcodesController extends AppController {
   /**
	* No....
	* @var string
	*/

   var $name = "Zipcodes";

   /**
	* Helpers
	* @var array
	*/

   var $uses       = array('Zipcode', 'User');
   var $helpers    = array('Html', 'Javascript', 'Session', 'Head', 'Javascript', 'Ajax', 'Form', 'Pagination');
   var $components = array('Pagination');

   public function index() {
	  $criteria            = null;
	  $paging['sortBy']    = "id";
	  $paging['direction'] = 'ASC';
	  $paging['show']      = '16';

	  list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
	  $arTmpZip = $this->Zipcode->findAll($criteria, "", $order, $limit, $page);

	  if ($arTmpZip) {
		 $this->set("arTmpZip", $arTmpZip);
		 $this->pageTitle = 'Articles - Anunturi';
	  }
	  else {
		 $this->pageTitle = ' - No Articles';
		 $this->set('message', "No Article were found,...");
		 $this->render(null, null, 'views/errors/cc_die');
	  }

	  $arTmpUsr = $this->Session->read("User");
	  $this->set("arTmpUsr", $arTmpUsr);
	  //	print_r($this->Session ->read("User"));
   }

   /**
	* @param null $search_state
	*/
   public function searchcode($search_state = null) {
	  $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
	  $search_state  = $this->params['url']['search_state'];
	  $search_town   = $this->params['url']['search_town'];
	  $search_street = $this->params['url']['search_street'];

	  if ($search_state != null) {
		 $criteria = " Zipcode.judet LIKE '%" . $search_state . "%' AND Zipcode.localitate LIKE '%" . $search_town . "%' AND Zipcode.adresa LIKE '%" . $search_street . "%' ";
	  }
	  else {
		 $criteria = " Zipcode.judet LIKE '%Timis%' OR Zipcode.localitate LIKE '%Timisoara%' OR Zipcode.adresa LIKE '%Silistra%' ";
	  }

	  $paging['sortBy']    = "id";
	  $paging['direction'] = 'DESC';
	  $paging['show']      = '6';

	  list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
	  $arTmpZip = $this->Zipcode->findAll($criteria, "", $order, $limit, $page);

//print_r($arTmpZip);

	  if (isset($arTmpZip)) {
		 $this->set("arTmpZip", $arTmpZip);
		 $this->pageTitle = 'Articles - Anunturi';
	  }
	  else {
		 $this->pageTitle = ' - No Articles';
		 $this->set('message', "No Article were found,...");
		 $this->render(null, null, 'views/errors/cc_die');
	  }
	  $arTmpUsr = $this->Session->read("User");
	  $this->set("arTmpUsr", $arTmpUsr);
	  //	print_r($this->Session ->read("User"));
   }

}


