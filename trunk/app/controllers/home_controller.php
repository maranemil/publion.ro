<?php /** @noinspection SqlNoDataSourceInspection */
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SqlDialectInspection */
/** @noinspection AutoloadingIssuesInspection */

/** @noinspection PhpUnused */

/**
 * @property $Pagination
 * @property $Article
 * @property $Category
 * @property $Session
 */
class HomeController extends AppController
{
    public $name = 'Home';

    public $uses       = array('Article', 'User', 'Category', 'Subcategory');
    public $helpers    = array('Html', 'Javascript', 'Session', 'Head', 'Javascript', 'Ajax', 'Form', 'Pagination');
    public $components = array('Pagination', 'Upload');

    public function index()
    {
        $criteria = null;
        #$criteria = " Article.id > 2220 ORDER BY Article.date DESC";

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');

        //print "<pre>"; print_r($arTmpCatSubCats); print "</pre>";

        if ($arTmpArt) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            $this->set("arTmpCatSubCats", $arTmpCatSubCats);
            $this->pageTitle = 'Publion - Anunturi';
        } else {
            $this->pageTitle = ' - No Articles';
            $this->set('message', "No Article were found,...");
            $this->render(null, null, 'views/errors/cc_die');
        }

        $arTmpUsr = $this->Session->read("User");
        $this->set("arTmpUsr", $arTmpUsr);
    }

}


