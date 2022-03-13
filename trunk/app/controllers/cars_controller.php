<?php /** @noinspection PhpUnusedParameterInspection */
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SqlDialectInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpUnused */
/**
 * Controller Companies
 * @author         Maran Emil | Maran Project | maran_emil@yahoo.com
 * @copyright      Copyright 2009, Maran Project.
 * @link           http://maran.pamil-visions.com
 * @version        1.0
 * @license        http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Class CarsController
 * @property $Pagination
 * @property $Car
 * @property $Session
 * @property $Judet
 * @property $Upload
 */
class CarsController extends AppController
{
    /**
     * No....
     * @var string
     */

    public $name = "Cars";

    /**
     * Helpers
     * @var array
     */

    public $uses       = array('Car', 'User', 'Judet');
    public $helpers    = array('Html', 'Javascript', 'Session', 'Head', 'Javascript', 'Ajax', 'Form', 'Pagination');
    public $components = array('Pagination', 'Upload');

    /**
     * @return void
     */
    public function index()
    {
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        $criteria = null;

        $paging['sortBy'] = "id";
        $paging['direction'] = 'DESC';
        $paging['show'] = '6';

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Car->findAll($criteria, "", $order, $limit, $page);

        //print "<pre>"; print_r($arTmpArt); print "</pre>";

        if ($arTmpArt) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
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

    public function lastcars($limit = 9)
    {
        if (isset($this->params['requested']) && $this->params['requested']) {
            $criteria = " Car.image !='' ";
            $order = 'order by Car.id DESC';

            //return 	$this->Company->find('all', array('order' => 'Company.id DESC', 'limit' => $limit));
            $page = 1;
            return $this->Car->findAll($criteria, "", $order, $limit, $page);
        }

        return false;
    }

    public function view($id = null)
    {
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        $this->Car->id = $id;
        $arTmp = $this->Car->query('SELECT * FROM cars WHERE id=' . $id);
        $viewsplus = $arTmp[0]['cars']['views'] + 1;
        $this->Car->query("UPDATE cars SET views = '" . $viewsplus . "' WHERE id=" . $id);

        $this->Car->id = $id;
        $arTmp = $this->Car->query('SELECT * FROM cars WHERE id=' . $id);
        //echo $id;
        $this->set("Car", $arTmp);
    }

    /**
     * @param null $searchq
     */
    public function searcharticle($searchq = null)
    {
        $this->set('title_for_layout', 'Publion - Anunturi Gratuite - Timisoara - Vanzari - Cumparari - Anunturi cu Poza');
        if (empty($searchq)) {
            $searchq = $this->params['url']['searchq'];
        }

        if ($searchq !== null) {
            $criteria = " `Car`.`info` LIKE '%" . $searchq . "%'";
        } else {
            $criteria = " `Car`.`info` LIKE '%logan%'";
        }

        $paging['sortBy'] = "date";
        $paging['direction'] = 'DESC';
        $paging['show'] = '6';

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arTmpArt = $this->Car->findAll($criteria, "", $order, $limit, $page);

        //print "<pre>"; print_r($arTmpCatSubCats); print "</pre>";

        if (!empty($arTmpArt)) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arTmpArt", $arTmpArt);
            #$this->set("arTmpCatSubCats", $arTmpCatSubCats);
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
    public function step1($id = null)
    {
        $this->checkIfLogged();
        $this->pageTitle = 'Adauga anunt...';

        $arTmpState = $this->Judet->query('SELECT * FROM judets ORDER BY judets.judet ASC');
        $this->set("arTmpState", $arTmpState);
    }

    public function step2()
    {
        $this->checkIfLogged();

        //	print "<pre>"; print_r($this->data);	print "</pre>"; die();

        $this->pageTitle = 'saving data...';
        //$this->checkSession();

        #####################################################################################
        // .......................start of GD1.6...........................................
        #####################################################################################
        if ($this->data["images"]["File"]["tmp_name"]) {
            $output = date('Ymdhis') . ".jpg";
            /*
                        $GLOBALS["mupload_file_cakephp"] = $this->data["images"]["File"]["tmp_name"];
                        $GLOBALS["mupload_dest_cakephp"] = "../../app/webroot/img/upload2/".date("Ym")."/".$output;
                        $GLOBALS["mupload_dpth_cakephp"] = "../../app/webroot/img/upload2/".date("Ym")."/";
                        $GLOBALS["mupload_filx_cakephp"] = $output;
            */
            $this->Upload->PbTempFile = $this->data["images"]["File"]["tmp_name"];
            $this->Upload->PbDestinationDirFile = "../../app/webroot/img/upload2/" . date("Ym") . "/" . $output;
            $this->Upload->PbDestinationDir = "../../app/webroot/img/upload2/" . date("Ym") . "/";
            $this->Upload->PbNewFileName = $output;

            if (!$this->Upload->uploadNewFile()) {
                $this->flash('Wrong data!', 'articles/step1/');
            }

            $form_data = array(
                'Car' => array(
                    'state'   => $this->data['Car']['state'],
                    'info'    => $this->data['Car']['info'],
                    'type'    => $this->data['Car']['type'],
                    'price'   => $this->data['Car']['price'],
                    'years'   => $this->data['Car']['years'],
                    'km'      => $this->data['Car']['km'],
                    'power'   => $this->data['Car']['power'],
                    'cmc'     => $this->data['Car']['cmc'],
                    'speeds'  => $this->data['Car']['speeds'],
                    'person'  => $this->data['Car']['person'],
                    'phone'   => $this->data['Car']['phone'],
                    'web'     => $this->data['Car']['web'],
                    'views'   => '1',
                    'date'    => date("Y-m-d"),
                    'image'   => $output,
                    'ip1'     => $_SERVER['REMOTE_ADDR'],
                    'ip2'     => $_SERVER['REMOTE_ADDR'],
                    'user_id' => $this->Session->read("User.id")
                )
            );

            if ($this->Car->save($form_data)) {
                //Displays a Message on success
                $this->flash('Uploaded succesfully', '/cars/');
            }
        } else {
            $this->flash('Wrong data!', '/cars/step1/');
        }
    }

    public function checkIfLogged()
    {
        //	$this->checkSession();
        if (!$this->Session->read("User")) {
            $this->flash('Please login or register first...', '/users/login');
            //$this->redirect("");
            exit;
        }
    }

    public function deletecar($id = null)
    {
        $this->checkIfLogged();
        $artUsrID = $this->Car->query("SELECT user_id FROM cars WHERE id =" . $id);
        if ($this->Session->read("User.id") === $artUsrID[0]["cars"]["user_id"]) {
            //Deletes the message
            $this->Car->del($id);
            //Displays a success message and redirects to index.thtml
            $this->flash('Anuntul a fost sters.', '/users/myentries/' . $this->Session->read("User.id"));
        }
    }

}


