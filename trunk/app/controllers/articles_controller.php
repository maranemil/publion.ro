<?php /** @noinspection PhpUndefinedVariableInspection */
/** @noinspection PhpDynamicAsStaticMethodCallInspection */
/** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

/** @noinspection PhpUnused */
/**
 * Controller Companies
 * @author         Maran Emil | Maran Project | maran_emil@yahoo.com
 * @copyright      Copyright 2009, Maran Project.
 * @link           http://maran.pamil-visions.com
 * @version        1.0
 * @license        http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::import('Sanitize');

/**
 * Class ArticlesController
 * @property $Pagination
 * @property $Article
 * @property $Category
 * @property $Session
 * @property $Rating
 * @property $Upload
 */
class ArticlesController extends AppController
{
    /**
     * No....
     * @var string
     */

    public $name = "Articles";

    /**
     * Helpers
     * @var array
     */

    public $uses       = array('Article', 'User', 'Category', 'Subcategory', 'Rating', 'Fav');
    public $helpers    = array('Html', 'Javascript', 'Session', 'Head', 'Javascript', 'Ajax', 'Form', 'Pagination');
    public $components = array('Pagination', 'Upload');

    public function index()
    {
        $criteria = " Article.category_id !='8' ";
        // exclude matrimoniale din index
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');

        #$criteria = " Article.id > 2220 ORDER BY Article.date DESC";
        //$criteria = array ('conditions' => "Article.category_id"=>"!=8");

        $paging['sortBy'] = "id";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);

        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        //$arTmpArt = $this->Article->findAll($criteria,"", array('Article.id' => 'DESC'), $limit, $page);
        // array('Article.id' => 'DESC', 'Article.firstname' => 'ASC')

        /*$arTmpArt = $this->Article->find(
         'all', array(
         //'conditions' => array("Article.category_id !='8' ")
         //'conditions' => array('Article.user_id' => "> 0"),
         'order' => 'Article.id DESC',
         'group' => 'Article.date, Article.user_id',
         'limit' => $limit
         )
         );*/

        /*$arTmpArt = $this->Article->find(
         array(
         //'conditions' => array('Article.id' => $thisValue), //Array mit Bedingungen
         'recursive' => 1, //int
         //'fields' => array('Article.field1', 'DISTINCT Model.field2'), //Array mit Feldnamen
         'order' => array('Article.user_id', 'Article.id DESC'), //String oder Array mit Feldern, die mit ORDER BY verwendet werden
         'group' => array('Article.user_id'), //Felder, die mit GROUP BY verwendet werden
         'limit' => $limit, //int
         'page' => $page, //int
         'callbacks' => false //weitere m�gliche Werte: false, 'before', 'after'
         )
         );*/

        /*$options = array(
         'conditions' => array('Article.category_id!=8'),
         'fields'=>array('Category.*','COUNT(`Entity`.`id`) as `entity_count`'),
         'joins' => array('LEFT JOIN `entities` AS Entity ON `Entity`.`category_id` = `Category`.`id`'),
         'group' => '`Article`.`user_id`',
         //'contain' => array('Domain' => array('fields' => array('title'))),
         'limit' => $limit, //int
         'page' => $page, //int
         'order' => 'Article.id DESC'
         );*/

        //$arTmpArt =  $this->Article->find('all', $options);
        //$this->Article->find('all', array('conditions' => array('Article.user_id' =>$iduser),'order' => 'Article.id DESC', 'limit' => $limit));

        $sSQLA = 'SELECT * FROM categories ORDER BY categories.name ASC';
        $this->Category->query($sSQLA);

        $sSQLB = 'SELECT * FROM categories 
    					LEFT JOIN subcategories ON categories.id = subcategories.category_id 
				ORDER BY categories.name ASC';
        $arTmpCatSubCats = $this->Category->query($sSQLB);


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
        //	print_r($this->Session ->read("User"));
    }

    public function articlesbyuser($id = null)
    {
        $criteria = " Article.user_id ='" . $id . "' ";
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        #$criteria = " Article.id > 2220 ORDER BY Article.date DESC";

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');

        //print "<pre>"; print_r($arTmpCatSubCats); print "</pre>";

        if (isset($arTmpArt)) {
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
        //	print_r($this->Session ->read("User"));
    }

    /**
     * @param $limit
     * @return false
     */
    public function lastarticles($limit = 9)
    {
        if(!isset($_GET['page'])) {
            $page = 1;
        }
        if (isset($this->params['requested']) && $this->params['requested']) {
            $criteria = " Article.image !='' ";
            $order = 'order by Article.id DESC';

            //return 	$this->Company->find('all', array('order' => 'Company.id DESC', 'limit' => $limit));
            return $this->Article->findAll($criteria, "", $order, $limit, $page);
        }

        return false;
    }

    public function toparticles()
    {
        $criteria = null;
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');

        $paging['sortBy'] = "views";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');

        //print "<pre>"; print_r($arTmpCatSubCats); print "</pre>";

        if ($arTmpArt) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            $this->set("arTmpCatSubCats", $arTmpCatSubCats);
            //$this->pageTitle = 'Publion - Anunturi';
            $this->pageTitle = "Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza !";
        } else {
            $this->pageTitle = ' - No Articles';
            $this->set('message', "No Article were found,...");
            $this->render(null, null, 'views/errors/cc_die');
        }

        $arTmpUsr = $this->Session->read("User");
        $this->set("arTmpUsr", $arTmpUsr);
        //	print_r($this->Session ->read("User"));
    }

    public function view($id = null)
    {
        //$article_id = $this->params["pass"][0];
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        $this->Article->id = $id;

        $ratingTMP = $this->Rating->query("SELECT SUM(rateval) as Gesamt, COUNT(rateval) as Votes FROM ratings WHERE article_id=" . $id . " ");

        $arTmp = $this->Article->query('SELECT * FROM articles WHERE id=' . $id);
        $viewsplus = $arTmp[0]['articles']['views'] + 1;
        $this->Article->query("UPDATE articles SET views = '" . $viewsplus . "' WHERE id=" . $id);

        //print "<pre>"; print_r($article_id); print "</pre>";
        //print "<pre>"; print_r($ratingTMP); print "</pre>";

        //if(!isset($ratingTMP[0][0]['Gesamt'])) $ratingTMP[0][0]['Gesamt'] = 1;
        //if(!isset($ratingTMP[0][0]['Votes'])) $ratingTMP[0][0]['Votes'] = 1;
        $ratingVal = round($ratingTMP[0][0]['Gesamt'] / $ratingTMP[0][0]['Votes']);
        //if(!$ratingVal) $ratingVal = 1;

        /*
         if($ratingTMP){
         $ratingVal = round($ratingTMP[0][0]['Gesamt']/$ratingTMP[0][0]['Votes']);
         }
         else{
         $ratingVal = 0;
         $ratingTMP[0][0]['Votes'] = 0;
         }
         */

        $this->Article->id = $id;
        $arTmp = $this->Article->query('SELECT * FROM articles WHERE id=' . $id);
        //echo $id;

        $this->set("Article", $arTmp);
        $this->set("rating", $ratingVal);
        $this->set("votes", $ratingTMP[0][0]['Votes']);
    }

    public function checkIfLogged()
    {
        //	$this->checkSession();
        if (!$this->Session->read("User")) {
            $this->flash('Please login or register first...', '/');
            $this->redirect("/users/login");
            exit;
        }
    }

    public function step1($id = null)
    {
        $this->checkIfLogged();
        $this->pageTitle = 'Adauga anunt...';

        $max_quota_daily = $this->Article->query("SELECT id FROM articles WHERE user_id='" . trim($id) . "' AND date ='" . date("Y-m-d") . "' LIMIT 20");
        if (count($max_quota_daily) > 5) {
            $this->flash('Ati depasit numarul maxim de anunturi / zi...', '/');
        }

        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');
        $this->set("arTmpCatSubCats", $arTmpCatSubCats);
        /*
         id 	category_id 	subcategory_id 	descr 	phone 	date 	image 	price 	webpage 	ip1 	ip2 	user_id
         */
    }

    public function step2()
    {
        $this->checkIfLogged();
        //print "<pre>"; print_r($this->data);	print "</pre>"; die();
        $this->pageTitle = 'saving data...';
        //$this->checkSession();

        $max_quota_daily = $this->Article->query("SELECT id FROM articles WHERE user_id='" . trim($id) . "' AND date ='" . date("Y-m-d") . "' LIMIT 20");
        if (count($max_quota_daily) > 15) {
            $this->flash('Ati depasit numarul maxim de anunturi / zi...', '/');
        }

        /*
         if(copy($this->data["images"]["File"]["tmp_name"], $destination.$output))
         {
         echo "uploaded!!!!!!!!!!!!!!!!!!!!!";
         }
         else{
         echo "not uploaded!!!!!!!!!!!!!!!!!!!!!";
         }
         */

        #####################################################################################
        // .......................start of GD1.6...........................................
        #####################################################################################
        if ($this->data["images"]["File"]["tmp_name"]) {
            $output = date('Ymdhis') . ".jpg";

            $this->Upload->PbTempFile = $this->data["images"]["File"]["tmp_name"];
            $this->Upload->PbDestinationDirFile = "../../app/webroot/img/upload/" . date("Ym") . "/" . $output;
            $this->Upload->PbDestinationDir = "../../app/webroot/img/upload/" . date("Ym") . "/";
            $this->Upload->PbNewFileName = $output;

            if ((stripos($this->data['Article']['title'], "erotic") !== false) || (stripos($this->data['Article']['descr'], "erotic") !== false)) {// Massage Masaj Erotice
                $this->Upload->isNude = 1;
            }

            if (!$this->Upload->uploadNewFile()) {
                $this->flash('Wrong data!', 'articles/step1/');
            }

            $arCat = explode("-", $this->data['Article']['category']);

            $form_data = array('Article' => array('category_id' => $arCat[0], 'subcategory_id' => $arCat[1], 'title' => $this->data['Article']['title'], 'descr' => $this->data['Article']['descr'], 'phone' => $this->data['Article']['phone'], 'date' => date("Y-m-d"), 'image' => $output, 'price' => $this->data['Article']['price'], 'webpage' => $this->data['Article']['webpage'], 'ip1' => $REMOTE_ADDR, 'ip2' => $_SERVER['REMOTE_ADDR'], 'user_id' => $this->Session->read("User.id")));

            if ($this->Article->save($form_data)) {
                //Displays a Message on success
                $this->flash('' . $lbls["registred_ok"] . 'Anuntul a fost adaugat', '/articles');
            }
        } else {
            $this->flash('Wrong data!',"");
        }
        #####################################################################################

        //print "<pre>"; print_r($this->data);	print "</pre>";// die();

        /*
         [images] => Array
         (
         [File] => Array
         (
         [name] => badea.jpg
         [type] => image/jpeg
         [tmp_name] => D:\xampp\tmp\php1E.tmp
         [error] => 0
         [size] => 35835
         )
         */
    }

    public function showcategory($id)
    {
        $currCat = "Default";

        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');

        foreach ($arTmpCatSubCats as $sCat) {
            if ($sCat['categories']["id"] === $id) {
                $currCat = $sCat['categories']["name"];
            }
        }
        return ucfirst($currCat);
    }

    public function showsubcategory($id)
    {
        $currCat = "Default";

        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');

        foreach ($arTmpCatSubCats as $sCat) {
            if ($sCat['subcategories']["id"] === $id) {
                $currCat = $sCat['subcategories']["name"];
            }
        }
        return ucfirst($currCat);
    }

    public function automoto($subcat = null)
    {
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        if ($subcat === "cumparare") {
            $subcatID = 1;
        }
        elseif ($subcat === "vanzare") {
            $subcatID = 2;
        }

        if ($subcat) {
            $criteria = " Article.category_id = 1 AND subcategory_id = " . $subcatID . " ";
        } else {
            $criteria = " Article.category_id = 1 ";
        }

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');


        if ($arTmpArt) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            $this->set("arTmpCatSubCats", $arTmpCatSubCats);
            $this->pageTitle = 'Publion - Anunturi - Matrimoniale';
        } else {
            $this->pageTitle = ' - No Articles';
            $this->set('message', "No Article were found,...");
            $this->render(null, null, 'views/errors/cc_die');
        }

        $arTmpUsr = $this->Session->read("User");
        $this->set("arTmpUsr", $arTmpUsr);
        //	print_r($this->Session ->read("User"));
    }

    public function calculatoare($subcat = null)
    {
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        if ($subcat === "componente") {
            $subcatID = 3;
        }
        elseif ($subcat === "servicii") {
            $subcatID = 4;
        }
        elseif ($subcat === "sisteme") {
            $subcatID = 5;
        }
        elseif ($subcat === "software") {
            $subcatID = 6;
        }

        if ($subcat) {
            $criteria = " Article.category_id = 2 AND subcategory_id = " . $subcatID . " ";
        } else {
            $criteria = " Article.category_id = 2 ";
        }
        #$criteria = " Article.id > 2220 ORDER BY Article.date DESC";

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');

        //print "<pre>"; print_r($arTmpCatSubCats); print "</pre>";

        if ($arTmpArt) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            $this->set("arTmpCatSubCats", $arTmpCatSubCats);
            $this->pageTitle = 'Publion - Anunturi - Matrimoniale';
        } else {
            $this->pageTitle = ' - No Articles';
            $this->set('message', "No Article were found,...");
            $this->render(null, null, 'views/errors/cc_die');
        }

        $arTmpUsr = $this->Session->read("User");
        $this->set("arTmpUsr", $arTmpUsr);
        //	print_r($this->Session ->read("User"));
    }

    public function constructii($subcat = null)
    {
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        if ($subcat === "materiale") {
            $subcatID = 7;
        }
        elseif ($subcat === "utilaje") {
            $subcatID = 8;
        }

        if ($subcat) {
            $criteria = " Article.category_id = 3 AND subcategory_id = " . $subcatID . " ";
        } else {
            $criteria = " Article.category_id = 3 ";
        }
        #$criteria = " Article.id > 2220 ORDER BY Article.date DESC";

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');

        //print "<pre>"; print_r($arTmpCatSubCats); print "</pre>";

        if ($arTmpArt) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            $this->set("arTmpCatSubCats", $arTmpCatSubCats);
            $this->pageTitle = 'Publion - Anunturi - Matrimoniale';
        } else {
            $this->pageTitle = ' - No Articles';
            $this->set('message', "No Article were found,...");
            $this->render(null, null, 'views/errors/cc_die');
        }

        $arTmpUsr = $this->Session->read("User");
        $this->set("arTmpUsr", $arTmpUsr);
        //	print_r($this->Session ->read("User"));
    }

    public function diverse($subcat = null)
    {
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        if ($subcat === "agricultura") {
            $subcatID = 9;
        }
        if ($subcat === "animale") {
            $subcatID = 10;
        }
        if ($subcat === "antichitati") {
            $subcatID = 11;
        }
        if ($subcat === "carti") {
            $subcatID = 12;
        }
        if ($subcat === "diverse") {
            $subcatID = 13;
        }
        if ($subcat === "hobby") {
            $subcatID = 14;
        }
        if ($subcat === "servicii") {
            $subcatID = 15;
        }

        if ($subcat) {
            $criteria = " Article.category_id = 4 AND subcategory_id = " . $subcatID . " ";
        } else {
            $criteria = " Article.category_id = 4 ";
        }
        #$criteria = " Article.id > 2220 ORDER BY Article.date DESC";

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');


        if ($arTmpArt) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            $this->set("arTmpCatSubCats", $arTmpCatSubCats);
            $this->pageTitle = 'Publion - Anunturi - Matrimoniale';
        } else {
            $this->pageTitle = ' - No Articles';
            $this->set('message', "No Article were found,...");
            $this->render(null, null, 'views/errors/cc_die');
        }

        $arTmpUsr = $this->Session->read("User");
        $this->set("arTmpUsr", $arTmpUsr);
        //	print_r($this->Session ->read("User"));
    }

    public function electronice($subcat = null)
    {
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        if ($subcat === "audio_video") {
            $subcatID = 16;
        }
        if ($subcat === "telefoane") {
            $subcatID = 17;
        }
        if ($subcat === "uz_casnic") {
            $subcatID = 18;
        }

        if ($subcat) {
            $criteria = " Article.category_id = 5 AND subcategory_id = " . $subcatID . " ";
        } else {
            $criteria = " Article.category_id = 5 ";
        }
        #$criteria = " Article.id > 2220 ORDER BY Article.date DESC";

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');


        if ($arTmpArt) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            $this->set("arTmpCatSubCats", $arTmpCatSubCats);
            $this->pageTitle = 'Publion - Anunturi - Matrimoniale';
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
     * @param null $subcat
     */
    public function funerare($subcat = null)
    {
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        if ($subcat === "decese") {
            $subcatID = 19;
        }
        if ($subcat === "servicii") {
            $subcatID = 20;
        }

        if ($subcat) {
            $criteria = " Article.category_id = 6 AND subcategory_id = " . $subcatID . " ";
        } else {
            $criteria = " Article.category_id = 6 ";
        }
        #$criteria = " Article.id > 2220 ORDER BY Article.date DESC";

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');

        //print "<pre>"; print_r($arTmpCatSubCats); print "</pre>";

        if ($arTmpArt) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            $this->set("arTmpCatSubCats", $arTmpCatSubCats);
            $this->pageTitle = 'Publion - Anunturi - Matrimoniale';
        } else {
            $this->pageTitle = ' - No Articles';
            $this->set('message', "No Article were found,...");
            $this->render(null, null, 'views/errors/cc_die');
        }

        $arTmpUsr = $this->Session->read("User");
        $this->set("arTmpUsr", $arTmpUsr);
        //	print_r($this->Session ->read("User"));
    }

    public function imobiliare($subcat = null)
    {
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        if ($subcat === "cumparari") {
            $subcatID = 21;
        }
        if ($subcat === "inchirieri") {
            $subcatID = 22;
        }
        if ($subcat === "schimburi") {
            $subcatID = 23;
        }
        if ($subcat === "vanzari") {
            $subcatID = 24;
        }

        if ($subcat) {
            $criteria = " Article.category_id = 7 AND subcategory_id = " . $subcatID . " ";
        } else {
            $criteria = " Article.category_id = 7 ";
        }
        #$criteria = " Article.id > 2220 ORDER BY Article.date DESC";

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');


        if ($arTmpArt) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            $this->set("arTmpCatSubCats", $arTmpCatSubCats);
            $this->pageTitle = 'Publion - Anunturi - Matrimoniale';
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
     * @param null $subcat
     */
    public function matrimoniale($subcat = null)
    {
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        if ($subcat === "barbati") {
            $subcatID = 25;
        }
        if ($subcat === "femei") {
            $subcatID = 26;
        }
        if ($subcat) {
            $criteria = " Article.category_id = 8 AND subcategory_id = " . $subcatID . " ";
        } else {
            $criteria = " Article.category_id = 8 ";
        }

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');

        //print "<pre>"; print_r($arTmpCatSubCats); print "</pre>";

        if ($arTmpArt) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            $this->set("arTmpCatSubCats", $arTmpCatSubCats);
            $this->pageTitle = 'Publion - Anunturi - Matrimoniale';
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
     * @param null $subcat
     */
    public function locuridemunca($subcat = null)
    {
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        if ($subcat === "cereri") {
            $subcatID = 27;
        }
        if ($subcat === "oferte") {
            $subcatID = 28;
        }

        if ($subcat) {
            $criteria = " Article.category_id = 9 AND subcategory_id = " . $subcatID . " ";
        } else {
            $criteria = " Article.category_id = 9 ";
        }

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');

        //print "<pre>"; print_r($arTmpCatSubCats); print "</pre>";

        if ($arTmpArt) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            $this->set("arTmpCatSubCats", $arTmpCatSubCats);
            $this->pageTitle = 'Publion - Anunturi - Matrimoniale';
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
     * @param null $subcat
     */
    public function produse($subcat = null)
    {
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        if ($subcat === "imbracaminte") {
            $subcatID = 29;
        }
        if ($subcat === "incaltaminte") {
            $subcatID = 30;
        }
        if ($subcat === "cosmetice") {
            $subcatID = 31;
        }

        if ($subcat) {
            $criteria = " Article.category_id = 10 AND subcategory_id = " . $subcatID . " ";
        } else {
            $criteria = " Article.category_id = 10 ";
        }
        #$criteria = " Article.id > 2220 ORDER BY Article.date DESC";

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');

        if ($arTmpArt) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            $this->set("arTmpCatSubCats", $arTmpCatSubCats);
            $this->pageTitle = 'Publion - Anunturi - Produse';
        } else {
            $this->pageTitle = ' - No Articles';
            $this->set('message', "No Article were found,...");
            $this->render(null, null, 'views/errors/cc_die');
        }

        $arTmpUsr = $this->Session->read("User");
        $this->set("arTmpUsr", $arTmpUsr);
        //	print_r($this->Session ->read("User"));
    }

    /*
     public function list_latest($limit = 5)
     {
     if ( isset($this->params['requested']) AND $this->params['requested'] )
     {
     return 	$this->Company->find('all', array('order' => 'Company.id DESC', 'limit' => $limit));
     }
     else
     {
     return FALSE;
     }
     }
     */

    /**
     *
     */
    public function searcharticle()
    {
        unset($arTmpArt);
        //$searchq = $this->params['url']['searchq'];
        $searchq = Sanitize::clean($this->params['url']['searchq']);

        /*
         http://book.cakephp.org/de/view/153/Data-Sanitization
         * 4.2.1 paranoid
         * 4.2.2 html
         * 4.2.3 escape
         * 4.2.4 clean
         */

        $cntwords = str_word_count($str);

        if ($cntwords > 1) {
            list($searchqStr1,$searchqStr2) = explode(" ", $searchq);
            $criteria = " `Article`.`descr` LIKE '%" . $searchqStr1 . "%' AND `Article`.`descr` LIKE '%" . $searchqStr2 . "%' OR `Article`.`title` LIKE '%" . $searchqStr1 . "%' AND `Article`.`title` LIKE '%" . $searchqStr2 . "%' ";
        } else if ($searchq !== null) {
            $criteria = " `Article`.`descr` LIKE '%" . $searchq . "%' OR `Article`.`phone` LIKE '%" . $searchq . "%' OR `Article`.`title` LIKE '%" . $searchq . "%' ";
        } else {
            $criteria = " `Article`.`descr` LIKE '%brasov%'";
        }

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';

        $listtype = $this->params['url']['listtype'];
        if (!$listtype) {
            $listtype = 2;
        }

        if ($listtype === 1) {
            $paging['show'] = '10';
        } else if ($listtype === 2) {
            $paging['show'] = '20';
        } else if ($listtype === 3) {
            $paging['show'] = '10';
        }

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Article->findAll($criteria, "", $order, $limit, $page);

        $this->Category->query('SELECT * FROM categories ORDER BY categories.name ASC');
        $arTmpCatSubCats = $this->Category->query('SELECT * FROM categories LEFT JOIN subcategories ON categories.id = subcategories.category_id ORDER BY categories.name ASC');

        //print "<pre>"; print_r($arTmpCatSubCats); print "</pre>";

        if (!empty($arTmpArt)) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            $this->set("arTmpCatSubCats", $arTmpCatSubCats);
            $this->pageTitle = 'Publion - Anunturi - Search';
        } else {
            $this->pageTitle = ' - No Articles';
            $this->set('message', "Nu sunt rezultate pentru cuvantul cautat...");
            //$this->render(null,null,'views/errors/cc_die');
        }

        $arTmpUsr = $this->Session->read("User");
        $this->set("arTmpUsr", $arTmpUsr);
        //	print_r($this->Session ->read("User"));
    }

    /**
     * @param null $id
     */
    public function deletearticle($id = null)
    {
        $this->checkIfLogged();
        $artUsrID = $this->Article->query("SELECT user_id FROM articles WHERE id =" . $id);
        //print_r($artUsrID); die();
        if ($this->Session->read("User.id") === $artUsrID[0]["articles"]["user_id"]) {
            //Deletes the message
            $this->Article->del($id);
            //Displays a success message and redirects to index.thtml
            $this->flash('Anuntul a fost sters.', '/users/myentries/' . $this->Session->read("User.id"));
        }
    }

    /**
     *
     */
    public function ratingsave()
    {
        $this->layout = "ajax";
        list($ratingval,$articleid) = $this->params["pass"];
        $userid = $this->Session->read("User.id");

        $tmpdata = array("Rating" => array("article_id" => $articleid, "rateval" => $ratingval, "user_id" => $userid, "user_ip" => $_SERVER['REMOTE_ADDR']));

        $chekcRate = $this->Rating->query("SELECT * FROM ratings WHERE user_ip='" . $_SERVER['REMOTE_ADDR'] . "' AND article_id='" . $articleid . "'");
        if (!$chekcRate) {
            $this->Rating->save($tmpdata);
        }
    }

    /**
     * @param int $limit
     */
    public function statistics($limit = 5)
    {
        if ($limit > 10) {
            $limit = 10;
        }
        /* TOP 10 suer / anunturi
         ------------------------------------------------*/
        $sSQL = "SELECT user_id, count(*)as total 
                    FROM articles
                    WHERE user_id != 0 group by user_id 
                    ORDER BY total 
                    DESC LIMIT " . $limit;
        $arTmp = $this->Article->query($sSQL);

        foreach ($arTmp as $sTmp) {
            //$dataByUser[$this->requestAction('users/getusernamebyid/'.$sTmp["articles"]["user_id"])."-".$sTmp[0]["total"]] = $sTmp[0]["total"];
            $dataByUser[$this->requestAction('users/getusernamebyid/' . $sTmp["articles"]["user_id"])] = $sTmp[0]["total"];
        }

        //print "<pre>"; print_r($dataByUser); print "</pre>";
        $this->set("dataByUser", $dataByUser);

        /* TOP anunturi / luna
         ------------------------------------------------*/
        // lunile precendete
        $smonth[] = date("Y-m", time() - (2592000 * 8));
        $smonth[] = date("Y-m", time() - (2592000 * 7));
        $smonth[] = date("Y-m", time() - (2592000 * 6));
        $smonth[] = date("Y-m", time() - (2592000 * 5));
        $smonth[] = date("Y-m", time() - (2592000 * 4));
        $smonth[] = date("Y-m", time() - (2592000 * 3));
        $smonth[] = date("Y-m", time() - (2592000 * 2));
        $smonth[] = date("Y-m", time() - 2592000);
        // luna curenta
        $smonth[] = date("Y-m");

        foreach ($smonth as $distMonth) {
            $sSQL = "SELECT date, count(*)as total FROM articles WHERE user_id != 0 AND date like '" . $distMonth . "%'";
            $arTmp = $this->Article->query($sSQL);

            foreach ($arTmp as $sTmp) {
                if ($sTmp[0]["total"] === 0) {
                    $sTmp[0]["total"] = 50;
                }
                $dataByMonth[$distMonth] = array("total" => $sTmp[0]["total"] / 10);
            }
        }

        $this->set("dataByMonth", $dataByMonth);

        /* TOP category / anunturi
         ------------------------------------------------*/
        $sSQL = "select category_id, count(*)as total from articles WHERE category_id!=0 GROUP BY category_id ORDER BY total DESC";
        $arTmp = $this->Article->query($sSQL);

        foreach ($arTmp as $sTmp) {
            //$dataByCategory[$this->requestAction('articles/showcategory/'.$sTmp["articles"]["category_id"])."-".$sTmp[0]["total"]] = $sTmp[0]["total"];
            $dataByCategory[$this->requestAction('articles/showcategory/' . $sTmp["articles"]["category_id"]) . "-" . $sTmp[0]["total"]] = $sTmp[0]["total"];
        }

        //print "<pre>"; print_r($dataByUser); print "</pre>";
        $this->set("dataByCategory", $dataByCategory);

        /* TOP cars / an
         ------------------------------------------------*/
        $sSQL = "select years, count(*)as total from cars WHERE years!=0 GROUP BY years ORDER BY total DESC LIMIT 10";
        $arTmp = $this->Article->query($sSQL);

        foreach ($arTmp as $sTmp) {
            $dataCarsByYear[$sTmp["cars"]["years"]] = $sTmp[0]["total"];
        }

        //print "<pre>"; print_r($dataByUser); print "</pre>";
        $this->set("dataCarsByYear", $dataCarsByYear);

        /* TOP type imobilare
         ------------------------------------------------*/
        $sSQL = "select type, count(*)as total from houses WHERE type!='' GROUP BY type ORDER BY total DESC LIMIT 10";
        $arTmp = $this->Article->query($sSQL);

        foreach ($arTmp as $sTmp) {
            $dataHousesByType[$sTmp["houses"]["type"]] = $sTmp[0]["total"];
        }

        //print "<pre>"; print_r($dataByUser); print "</pre>";
        $this->set("dataHousesByType", $dataHousesByType);
    }

    /**
     * getRandomVideoTags videos
     *
     * @param integer $limit
     *
     * @return array|false
     * @license        http://www.opensource.org/licenses/mit-license.php The MIT License
     * @copyright      Copyright 2009, Maran Project.
     * @version        1.0
     * @author         :        maran_emil@yahoo.com
     * @web            :            http://maran-emil.de
     * @web2            http://maran.pamil-visions.com
     */
    public function getRandomArticleTags($limit = 10)
    {
        if(!is_numeric($limit)) {
            $this->redirect('/');
        }
        if (isset($this->params['requested']) && $this->params['requested']) {
            //return 	$this->Company->find('all', array('order' => 'Company.id DESC', 'limit' => $limit));
            return $this->Article->query("SELECT title 
                            FROM `articles` 
                            WHERE title != '' ORDER BY RAND() LIMIT " . $limit . " ");
        }

        return false;
    }

    /**
     * @param int $iduser
     *
     * @return array|false|null
     */
    public function getlastarticlebyuser($iduser = 70)
    {
        $limit = 4;
        if (isset($this->params['requested']) && $this->params['requested']) {
            return $this->Article->find('all', array('conditions' => array('Article.user_id' => $iduser), 'order' => 'Article.id DESC', 'limit' => $limit));
        }

        return false;
    }

}


