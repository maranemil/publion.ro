<?php /** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpUnused */

/**
 * Controller Companies
 * @property $Pagination
 * @property $Drugstore
 * @property $Session
 * @author         Maran Emil | Maran Project | maran_emil@yahoo.com
 * @copyright      Copyright 2009, Maran Project.
 * @link           http://maran.pamil-visions.com
 * @version        1.0
 * @license        http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class DrugstoresController extends AppController
{
    /**
     * No....
     * @var string
     */

    public $name = "Drugstores";

    /**
     * Helpers
     * @var array
     */

    public $uses       = array('Drugstore', 'User');
    public $helpers    = array('Html', 'Javascript', 'Session', 'Head', 'Javascript', 'Ajax', 'Form', 'Pagination');
    public $components = array('Pagination');

    /**
     * @return void
     */
    public function index()
    {
        $criteria = null;
        $paging['sortBy'] = "id";
        $paging['direction'] = 'ASC';
        $paging['show'] = '16';

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpDrog = $this->Drugstore->findAll($criteria, "", $order, $limit, $page);

        if ($arTmpDrog) {
            $this->set("arTmpDrog", $arTmpDrog);
            $this->pageTitle = 'Articles - Retete Culinare';
        } else {
            $this->pageTitle = ' - No Articles';
            $this->set('message', "No Article were found,...");
            $this->render(null, null, 'views/errors/cc_die');
        }

        $arTmpUsr = $this->Session->read("User");
        $this->set("arTmpUsr", $arTmpUsr);
    }

    /*
    public function searchrecipe($searchq = NULL)
        {
            $this->set('title_for_layout','Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
            $searchq = $this->params['url']['catrecipe'];

            if($searchq!=NULL){
                $criteria = " `Recipe`.`cat` LIKE '%".$searchq."%'";
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
    */

}


