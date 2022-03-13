<?php /** @noinspection SqlNoDataSourceInspection */
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SqlDialectInspection */
/** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpUnused */

/**
 * Controller Companies
 * @property $Session
 * @property $Fav
 * @author         Maran Emil | Maran Project | maran_emil@yahoo.com
 * @copyright      Copyright 2009, Maran Project.
 * @link           http://maran.pamil-visions.com
 * @version        1.0
 * @license        http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class FavsController extends AppController
{
    /**
     * No....
     * @var string
     */

    public $name = "Favs";

    /**
     * Helpers
     * @var array
     */

    public $uses    = array('Category', 'User', 'Subcategory', 'Article', 'Fav');
    public $helpers = array('Html', 'Javascript', 'Session', 'Head', 'Javascript', 'Ajax', 'Form');

    public function index()
    {
    }

    /**
     *
     */
    public function addarticletofav()
    {
        $this->layout = "ajax";
        $userid = $this->Session->read("User.id");
        $idArtx = $this->params["pass"][0];

        if (!$this->checkfavexists($userid, $idArtx)) {
            $sSQL = "INSERT INTO favs (id,user_id,article_id) VALUES ('','" . $userid . "','" . $idArtx . "')";
            //echo $sSQL; die();

            $this->Fav->query($sSQL);
        }
        //$this->flash('Anuntul a fost salvat la fav.', '/users/myentries/'.$this->Session->read("User.id"));

    }

    public function checkfavexists($userid, $idArtx)
    {
        $criteria = " Fav.user_id ='" . $userid . "' and Fav.article_id ='" . $idArtx . "'  "; //
        $arTMp = $this->Fav->findAll($criteria, "");

        //print "<pre>"; print_r($arTMp);	die();
        if ($arTMp) {
            return true;
        }

        return false;
    }

    /**
     *
     */
    public function deletefav()
    {
        $this->checkIfLogged();

        $idFav = $this->params["pass"][0];
        $arFavID = $this->Fav->query("SELECT * FROM favs WHERE article_id ='" . $idFav . "' AND user_id='" . $this->Session->read("User.id") . "' ");
        //print_r($artUsrID); die();
        if ($this->Session->read("User.id") === $arFavID[0]["favs"]["user_id"]) {
            //Deletes the message
            $this->Fav->del($arFavID[0]["favs"]["id"]);
            //Displays a success message and redirects to index.thtml
            $this->flash('Anuntul a fost sters din lista de favorite.', '/users/myfavs/' . $this->Session->read("User.id"));
        }
    }

}

