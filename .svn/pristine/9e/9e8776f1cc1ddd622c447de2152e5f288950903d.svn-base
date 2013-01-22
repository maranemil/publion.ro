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

class RecipesController extends AppController
{
	/**
	 * No....
	 *
	 * @var string
	 */

	var $name = "Recipes";
	
	/**
	 * Helpers 
	 *
	 * @var array
	 */
	
	var $uses = array('Recipe','User');
	var $helpers = array('Html', 'Javascript', 'Session','Head','Javascript', 'Ajax','Form','Pagination'); 
	var $components = array('Pagination'); 
	

	public function index()
	{
		$criteria = null;	
		$paging['sortBy']="id";
		$paging['direction']='ASC';
		//$page = $_GET['page'];
		
		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpRecipe = $this->Recipe->findAll($criteria,"", $order, $limit, $page);
		$arTmpCategs = $this->Recipe->query("SELECT cat FROM recipes GROUP BY cat");


	
		if($arTmpRecipe){
			$this->set("arTmpRecipe", $arTmpRecipe);
			$this->set("arTmpCategs", $arTmpCategs);
			$this->pageTitle = 'Articles - Retete Culinare';
		}else{
			$this->pageTitle = ' - No Articles';
			$this->set('message',"No Article were found,...");
			$this->render(null,null,'views/errors/cc_die');
		} 

		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);

	//	print_r($this->Session ->read("User"));
	}

	



public function searchrecipe($searchq = NULL) 
	{
		$searchq	= $this->params['url']['catrecipe'];
		$searchqalt = $this->params['url']['categorie'];

		if($searchq!=NULL){
			$criteria = " `Recipe`.`cat` LIKE '%".$searchq."%'";
		}
		else if($searchqalt!=NULL){
			$criteria = " `Recipe`.`cat` LIKE '%".$searchqalt."%'";
		}
		else{
			$criteria = " `Recipe`.`cat` LIKE '%ciocolata%'";
		}

		$paging['sortBy']="id";
		$paging['direction']='DESC';
		$paging['show']='6';
		
		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpRecipe = $this->Recipe->findAll($criteria,"", $order, $limit, $page);
		$arTmpCategs = $this->Recipe->query("SELECT cat FROM recipes GROUP BY cat");
				
		//print "<pre>"; print_r($arTmpCatSubCats); print "</pre>"; 
	
		if(!empty($arTmpRecipe)){
			$this->set("arTmpRecipe", $arTmpRecipe);
			$this->set("arTmpCategs", $arTmpCategs);
			$this->pageTitle = 'Articles - Retete Culinare';
			$this->set('message',"Nu exista rezultate pentru aceasta cautare.");
		}else{
			$this->pageTitle = ' - No Articles';
			$this->set('message',"No Article were found,...");
			$this->set('message',"Nu exista rezultate pentru aceasta cautare.");
			$this->render(null,null,'views/errors/cc_die');
		} 
		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);
	//	print_r($this->Session ->read("User"));
	}



public function searchrecipename($searchq = NULL) 
	{
		
		$searchq = $this->params['url']['searchq'];
		//$searchq = $this->params['pass']['0'];
		//print_r($this->params);

		if($searchq!=NULL){
			$criteria = " `Recipe`.`title` LIKE '%".$searchq."%'";
		}
		else{
			$criteria = " `Recipe`.`title` LIKE '%spanac%'";
		}

		$paging['sortBy']="title";
		$paging['direction']='ASC';
		$paging['show']='10';


		list($order,$limit,$page) = $this->Pagination->init($criteria,$paging);
		$arTmpRecipe = $this->Recipe->findAll($criteria,"", $order, $limit, $page);
		$arTmpCategs = $this->Recipe->query("SELECT cat FROM recipes GROUP BY cat");
				
		//print "<pre>"; print_r($arTmpRecipe); print "</pre>"; 
	
		if(is_array($arTmpRecipe)){
			$this->set("arTmpRecipe", $arTmpRecipe);
			$this->set("arTmpCategs", $arTmpCategs);
			$this->pageTitle = 'Articles - Retete Culinare';
			$this->set('message',"Nu exista rezultate pentru aceasta cautare.");
		}else{
			$this->pageTitle = ' - No Articles';
			$this->set('message',"No Article were found,...");
			$this->set('message',"Nu exista rezultate pentru aceasta cautare.");
			$this->render(null,null,'views/errors/cc_die');
		} 
		$arTmpUsr = $this->Session->read("User");
		$this->set("arTmpUsr", $arTmpUsr);
	
	}



}

?>
