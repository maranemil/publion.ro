<?php /** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection AutoloadingIssuesInspection */

//uses('L10n');
//uses('I18n');

class AppController extends Controller
{

    /**
     * @var array
     */
    public $cleandata = array();
    /**
     * @var string[]
     */
    public $uses    = array('User', 'Car', 'House', 'Article', 'Friend', 'Fav');
    /**
     * @var string[]
     */
    public $helpers = array('Html', 'Form', 'Javascript', 'Time', 'Text', 'Chart');

    /**
     * @return void
     */
    public function beforeFilter()
    {
        if (!empty($this->data)) {
            uses('sanitize');
            $sanitize = new Sanitize();
            $this->cleandata = $sanitize->clean($this->data);
        }
    }

    /**
     * @param $date
     * @return string
     */
    public function Db2StrDate($date)
    {
        $day = substr($date, 8, 2);
        $month = substr($date, 5, 2);
        $year = substr($date, 0, 4);

        if ($day[0] === '0') {
            $day = str_replace("0", "", $day);
        }
        if ($month[0] === '0') {
            $month = str_replace("0", "", $month);
        }

        return $day . '.' . $month . '.' . $year;
    }

    /**
     * @return void
     */
    public function checkIfLogged()
    {
        if (!$this->Session->read("User")) {
            $this->Session->setFlash('Sorry, the information you\'ve entered is incorrect.');
            $this->redirect("/users/login");
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function checkIfBelongsToArea($id)
    {
        if ($this->Session->read("User.id") !== $id) {
            $this->flash('This Page not exist...', '/');
        }
    }

}

