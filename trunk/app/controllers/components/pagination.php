<?php /** @noinspection PhpUndefinedFieldInspection */
/** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpUnused */

/**
 * Pagination Component, responsible for managing the DATA required for pagination.
 * @package  cheeseCake
 */
class PaginationComponent extends Object
{
    // Configuration/Default variables
    /**
     * Specify whether the component will use AJAX links if available.
     * Tests for the presence of the RequestHandler component and if
     * present will generate
     * AJAX links. However, if the prototype library js has not
     * been included, normal updates
     * will take place.
     * @var boolean
     * @access public
     */
    public $ajaxAutoDetect = false;
    /**
     * Specify link style
     * @var string "html"/"ajax"
     * @access public
     */
    public $style = "html";
    /**
     * Specify link parameter style
     * @var string "get"/"pretty"
     * @access public
     */
    public $paramStyle = "get";
    /**
     * Specify DEFAULT start page number
     * @var integer
     * @access public
     */
    public $page = 1;
    /**
     * Specify DEFAULT number of items to be displayed per page. Also used as the limit
     * for the subsequent SQL search.
     * @var integer
     * @access public
     */
    public $show = 15;
    /**
     * Specify DEFAULT sort column.
     * @var string
     * @access public
     */
    public $sortBy = 'id';
    /**
     * Specify DEFAULT sort direction.
     * @var string
     * @access public
     */
    public $direction = 'DESC';
    /**
     * Specify the maximum number of pages to be included in the list of pages. Should be an odd number, otherwise rounded down.
     * @var integer
     * @access public
     */
    public $maxPages = 5;
    /**
     * Options for results per page.
     * @var array
     * @access public
     */
    public $resultsPerPage = array(5, 10, 15, 25, 50, 100, 500);
    /**
     * Show links to the first and last page, if the number of pages exceeds the maxPage count.
     * @var boolean
     * @access public
     */
    public $showLimits = true;

    // Do not edit below this line unless you wish to customize the core functionality of this Component
    /**
     * Place holder for the sort class. Irrelavent for models without associations
     * @var boolean
     * @access private
     */
    public $sortByClass;
    /**
     * Place holder for the base url
     * @var boolean
     * @access private
     */
    public $url;
    /**
     * Place holder for the controller
     * @var boolean
     * @access private
     */
    public $controller = true;
    /**
     * Place holder for the sanitize object
     * @var boolean
     * @access private
     */
    public $sanitize = true;
    /**
     * Place holder for the data array passed to the view
     * @var boolean
     * @access private
     */
    public $paging;

    /**
     * Startup - Link the component to the controller.
     *
     * @param controller
     */
    public function startup(&$controller)
    {
        $this->controller =& $controller;
    }

    /**
     * Initialize the pagination data.
     *
     * @param
     * @param array
     *
     * @return array
     */
    public function init($criteria = null, $parameters = array())
    {
        if (($this->ajaxAutoDetect === true) && (isset($this->controller->RequestHandler))) {
            $this->style = "ajax";
        }

        $ModelClass = isset($parameters['modelClass']) ? $parameters['modelClass'] : null;
        if (!$ModelClass) {
            $ModelClass = $this->controller->modelClass;
        }
        if (!$this->sortByClass) {
            $this->sortByClass = $ModelClass;// Setting the DEFAULT sort class
        }
        if (isset($parameters['url'])) {
            $this->url = $parameters['url'];
            if (substr($this->url, -1, 1) !== "/") {
                $this->url .= "/";
            }
            unset($parameters['url']);
        } else {
            $this->url = "/" . $this->controller->params['url']['url'];
        }
        $this->paging['importParams'] = $parameters;

        uses('sanitize');
        $this->Sanitize = new Sanitize;

        $this->paging['Defaults'] = array(
            "page"        => $this->page,
            "show"        => $this->show,
            "sortBy"      => $this->sortBy,
            "sortByClass" => $this->sortByClass,
            "direction"   => $this->direction
        );

        $this->_setParameter("show", $parameters);
        $this->_setParameter("page", $parameters);
        $this->_setParameter("direction", $parameters);
        $this->_setParameter("sortBy", $parameters);
        $this->_setParameter("sortByClass", $parameters); // Overriding the model class if specified.

        $this->_setPrivateParameter("maxPages");
        $this->_setPrivateParameter("showLimits");
        $this->_setPrivateParameter("style");
        $this->_setPrivateParameter("paramStyle");
        $this->_setPrivateParameter("url");

        if (isset($parameters['total'])) {
            $count = $parameters['total'];
        } else {
            $count = $this->controller->$ModelClass->findCount($criteria, 0);
        }
        $this->trimResultsPerPage($count);
        $this->_setPrivateParameter("resultsPerPage");

        $this->checkPage($count);
        $this->paging['total'] = $count;

        $this->paging['pageCount'] = ceil($count / $this->paging['show']);
        $this->controller->set('paging', $this->paging);

        $this->order = $this->paging['sortByClass'] . "." . $this->paging['sortBy'] . ' ' . strtoupper($this->paging['direction']);

        // For backwards compatability & clarity
        $this->limit = $this->paging['show'];
        $this->page = $this->paging['page'];

        // For less code in the calling method..
        return (array($this->order, $this->paging['show'], $this->paging['page']));
    }

    /**
     * Don't give the choice to display pages with no results
     *
     * @param integer
     */
    public function trimResultsPerPage($count = 0)
    {
        while (($limit = current($this->resultsPerPage)) && (!isset($capKey))) {
            if ($limit >= $count) {
                $capKey = key($this->resultsPerPage);
            }
            next($this->resultsPerPage);

            if (isset($capKey)) {
                array_splice($this->resultsPerPage, ($capKey + 1));
            }
        }
    }

    /**
     * Set the page to the last if there would be no results, and to 1 if a negetive
     * page number is specified
     *
     * @param integer
     */
    public function checkPage($count = 0)
    {
        if ((($this->paging['page'] - 1) * $this->paging['show']) >= $count) {
            $this->paging['page'] = floor($count / $this->paging['show'] + 0.99);
        }
    }

    /**
     * Set a parameter to be passed to the view which cannot be specified/overriden from the url.
     *
     * @param unknown
     */
    public function _setPrivateParameter($parameter)
    {
        $this->paging[$parameter] = $this->$parameter;
    }

    /**
     * Set a parameter to be passed to the view overriden from the url if present.
     *
     * @param $parameterown
     * @param array $parameters
     * @param string $field
     */
    public function _setParameter($parameter, $parameters = array(), $field = null)
    {
        $field = $field ?: $parameter;
        if ($this->paramStyle === "get") {
            if (isset($_GET[$parameter])) {
                $this->paging[$field] = $this->Sanitize->paranoid($_GET[$parameter]);
            } else if (isset($parameters[$parameter])) {
                $this->paging[$field] = $this->Sanitize->paranoid($parameters[$parameter]);
            } else {
                $this->paging[$field] = $this->$field;
            }
        } elseif ($this->paramStyle === "pretty") {
            if (isset($parameters[$parameter])) {
                $this->paging[$field] = $this->Sanitize->paranoid($parameters[$parameter]);
            } else {
                $this->paging[$field] = $this->$field;
            }
        } else {
            echo("parameter error");
            die;
        }
    }
}

