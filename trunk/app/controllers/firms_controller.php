<?php /** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpUnused */

/**
 * Controller Companies
 * @property $Pagination
 * @property $Firm
 * @property $Session
 * @author         Maran Emil | Maran Project | maran_emil@yahoo.com
 * @copyright      Copyright 2009, Maran Project.
 * @link           http://maran.pamil-visions.com
 * @version        1.0
 * @license        http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class FirmsController extends AppController
{
    /**
     * No....
     * @var string
     */

    public $name = "Firms";

    /**
     * Helpers
     * @var array
     */

    public $uses       = array('Firm', 'User');
    public $helpers    = array('Html', 'Javascript', 'Session', 'Head', 'Javascript', 'Ajax', 'Form', 'Pagination');
    public $components = array('Pagination');

    public function index()
    {
        $criteria = null;
        $paging['sortBy'] = "company";
        $paging['direction'] = 'ASC';
        $paging['show'] = '10';

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpFirm = $this->Firm->findAll($criteria, "", $order, $limit, $page);

        if ($arTmpFirm) {
            $this->set("arTmpFirm", $arTmpFirm);
            $this->pageTitle = 'Articles - Retete Culinare';
        } else {
            $this->pageTitle = ' - No Articles';
            $this->set('message', "No Article were found,...");
            $this->render(null, null, 'views/errors/cc_die');
        }

        $arTmpUsr = $this->Session->read("User");
        $this->set("arTmpUsr", $arTmpUsr);
        //	print_r($this->Session ->read("User"));
    }

    /**
     * @param $searchq
     * @return void
     */
    public function showfirmbyletter($searchq = null)
    {
        if(empty($searchq)){
            $searchq = $this->params['pass']['0'];
        }

        if ($searchq !== null) {
            $criteria = " `Firm`.`company` LIKE '" . $searchq . "%'";
        } else {
            $criteria = " `Firm`.`company` LIKE '%SRL%'";
        }

        $paging['sortBy'] = "id";
        $paging['direction'] = 'DESC';
        $paging['show'] = '10';

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpFirm = $this->Firm->findAll($criteria, "", $order, $limit, $page);

        if (isset($arTmpFirm)) {
            $this->set("arTmpFirm", $arTmpFirm);
            $this->pageTitle = 'Articles - Retete Culinare';
        } else {
            $this->pageTitle = ' - No Articles';
            $this->set('message', "No Article were found,...");
            $this->render(null, null, 'views/errors/cc_die');
        }

        $arTmpUsr = $this->Session->read("User");
        $this->set("arTmpUsr", $arTmpUsr);
    }

    /**
     * @param $searchq
     * @return void
     */
    public function searchfirma($searchq = null)
    {
        $searchq = $this->params['url']['searchq'];
        //$searchq = $this->params['pass']['0'];

        if ($searchq !== null) {
            $criteria = " `Firm`.`company` LIKE '" . $searchq . "%'";
        } else {
            $criteria = " `Firm`.`company` LIKE '%SRL%'";
        }

        $paging['sortBy'] = "company";
        $paging['direction'] = 'ASC';
        $paging['show'] = '10';

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpFirm = $this->Firm->findAll($criteria, "", $order, $limit, $page);

        if (isset($arTmpFirm)) {
            $this->set("arTmpFirm", $arTmpFirm);
            $this->pageTitle = 'Articles - Retete Culinare';
            $this->set('message', "Nu exista rezultate pentru aceasta cautare.");
        } else {
            $this->pageTitle = ' - No Articles';
            $this->set('message', "No Article were found...");
            $this->set('message', "Nu exista rezultate pentru aceasta cautare.");
            $this->render(null, null, 'views/errors/cc_die');
        }

        $arTmpUsr = $this->Session->read("User");
        $this->set("arTmpUsr", $arTmpUsr);
    }

}


