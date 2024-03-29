<?php /** @noinspection PhpMultipleClassDeclarationsInspection */
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

class CategoriesController extends AppController
{
    /**
     * No....
     * @var string
     */

    public $name = "Category";

    /**
     * Helpers
     * @var array
     */

    public $uses    = array('Category', 'User', 'Subcategory');
    public $helpers = array('Html', 'Javascript', 'Session', 'Head', 'Javascript', 'Ajax', 'Form');

    /**
     *
     */
    public function index()
    {
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

}

