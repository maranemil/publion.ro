<?php /** @noinspection PhpUndefinedVariableInspection */
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */
/** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpUnused */

/* users_controller.php, Provides Functions for User Authentification and Managment
    Copyright (C) 2007  Christoph Hochstrasser

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.*/

/**
 * @property $Pagination
 * @property $User
 * @property $Session
 * @property $Upload
 * @property $House
 * @property $Article
 * @property $Car
 * @property $Fav
 * @property $Friend
 * @property $Email
 * @method checkSession()
 */
class UsersController extends AppController
{

    public $name       = 'Users';
    public $uses       = array('User', 'Car', 'House', 'Article', 'Friend', 'Fav');
    public $helpers    = array('Html', 'Javascript', 'Session', 'Head', 'Javascript', 'Ajax', 'Form', 'Pagination');
    public $components = array('Pagination', 'Upload', 'Email');

    /* lastusers -
    --------------------------------------------------------------------- */
    public function index()
    {
        $criteria = null;
        $paging['sortBy'] = 'name';
        $paging['direction'] = 'ASC';
        //$page = $_GET['page'];

        $this->flash('Redirectionare...', '/articles/');

        list($order, $limit, $page) = $this->Pagination->init($criteria, $paging);
        $arUser = $this->User->findAll($criteria, "", $order, $limit, $page);

        if ($arUser) {
            //$this->set(compact('comments','currentDateTime'));
            $this->set("arUser", $arUser);
            $this->pageTitle = ' - Companies';
        } else {
            $this->pageTitle = ' - No results';
            $this->set('message', "No info were found, add some...");
            $this->render(null, null, 'views/errors/cc_die.ctp');
        }
    }

    /* lastusers -
    --------------------------------------------------------------------- */
    public function lastusers($limit = 8)
    {
        $criteria = null;
        //$criteria = " User.image !='' ";
        //$order = 'order by User.id DESC';
        $order = 'ORDER BY Rand()';
        if (isset($this->params['requested']) && $this->params['requested']) {
            //return 	$this->User->find('all', array('order' => 'User.id DESC', 'limit' => $limit));
            return $this->User->findAll($criteria, "", $order, $limit, $page);
        }

        return false;
    }


    /**
     * @return void
     */
    public function login()
    {
        $this->pageTitle = 'Inregistrare';
        //Sets the error variable to false
        $this->set('error', 'false');

        //If the form is submitted and form data is available,
        //the form data is compared with the data in the database table.
        if (!empty($this->data)) {
            session_start();

            $someone = $this->User->findByUsername(trim($this->data['User']['username']));

            if (!empty($someone['User']['password']) &&
                $someone['User']['active'] === "true" &&
                $someone['User']['password'] === md5($this->data['User']['password'])
                ) {
                //Sets the session variable with the user information
                $this->Session->write('User', $someone['User']);
                //Sets the authentication variable
                $this->Session->write('authenticated', 'true');
                //Sets the rights variable, which contains the rights of the current user
                $this->Session->write('rights', $someone['User']['rights']);
                //Sets the status of the user to "online"
                $user = $this->Session->read('User');
                $this->User->id = $user['id'];
                $this->User->saveField("online", "true");
                $this->flash('Redirectionare......', '/users/view/' . $this->User->id);
            } else {
                //If the user cannot be authenticated, the error variable is set to "true"
                $this->flash('Informatia contine erori...', '/');
                //$this->Flash('Sorry, the information you\'ve entered is incorrect.');
                $this->set('error', 'true');
            }
        }
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->set('error', 'false');
        $this->pageTitle = 'Registrierung';
        //If the form is submitted and the two passwords match, the data will be processed
        if (!empty($this->data) && $this->data['User']['password'] === $this->data['User']['password_confirm']) {
            //Processing of the data

            $form_data = array(
                'User' => array(
                    'username' => $this->data['User']['username'],
                    'password' => md5($this->data['User']['password']),
                    'e-mail'   => $this->data['User']['e-mail'],
                    'name'     => $this->data['User']['name'],
                    'pastname' => $this->data['User']['pastname'],
                    'active'   => 'true',
                    'showhide' => '1'
                )
            );

            //Writes the data into the Table "users"
            if ($this->User->save($form_data)) {
                //Displays a Message on success
                $this->flash('' . $lbls["registred_ok"] . $this->data['User']['username'] . $lbls["registred_ok_sec"], '/users/login');
            } else {
                $this->set('error', 'true');
            }
        } elseif ($this->data['User']['password'] === $this->data['User']['password_confirm']) {
            //Otherwise the error variable is set to "true"
            $this->set('error', 'true');
        }
    }

    /**
     * @return void
     */
    public function all()
    {
        //Displays the Usernames of all Members including a link to their blog and user informations
        $this->pageTitle = 'Alle Mitglieder';
        $this->checkSession();
        $this->set('users', $this->User->findAll(null, array('id', 'username', 'online'), "username ASC"));
    }

    /**
     * @return void
     */
    public function newest()
    {
        //Displays the newest Members
        $this->pageTitle = 'Neueste Mitglieder';
        $this->checkSession();
        $this->set('users', $this->User->findAll(null, array('id', 'username', 'online', 'created'), 'created DESC', 10));
    }

    /**
     * @param $id
     * @return void
     */
    public function view($id = null)
    {
        $this->checkIfLogged();
        //echo "aaaaa";
        //Displays the user information of the user with the supplied user id
        $this->pageTitle = 'User ansehen';
        //$this->checkSession();
        $this->User->id = $id;
        $this->set('user', $this->User->read("id,username,e-mail,online,name,pastname,created,interests,userpage,nickname,image,showhide"));
    }


    /**
     * @param $id
     * @return void
     */
    public function myprofile($id = null)
    {
        $this->checkIfLogged();
        $this->checkIfBelongsToArea($id);

        //Displays the user information of the user with the supplied user id
        $this->pageTitle = 'User ansehen';
        //$this->checkSession();
        $this->User->id = $id;
        $this->set('user', $this->User->read("id,username,e-mail,name,pastname,interests,userpage,nickname,showhide"));
    }


    /**
     * @param $id
     * @return void
     */
    public function savemyprofile($id = null)
    {
        //echo "aaaaa";
        //Displays the user information of the user with the supplied user id
        $this->pageTitle = 'saving data...';
        $this->checkIfLogged();
        //$this->checkSession();
        $this->User->id = $id;

        //echo $this->data["User"]["showhide"];   die();
        //print "<pre>";   print_r($this->data); print "</pre>"; die();

        #####################################################################################
        // .......................start of GD1.6...........................................
        #####################################################################################
        $output = date('Ymdhis') . ".jpg";
        if ($this->data["images"]["File"]["tmp_name"] && $this->data["images"]["File"]["error"] === 0) {


            /*
                            $GLOBALS["mupload_file_cakephp"] = $this->data["images"]["File"]["tmp_name"];
                            $GLOBALS["mupload_dest_cakephp"] = "../../app/webroot/img/user/".$output;
                            $GLOBALS["mupload_dpth_cakephp"] = "../../app/webroot/img/user/";
                            $GLOBALS["mupload_filx_cakephp"] = $output;
            */
            $this->Upload->PbTempFile = $this->data["images"]["File"]["tmp_name"];
            $this->Upload->PbDestinationDirFile = "../../app/webroot/img/user/" . $output;
            $this->Upload->PbDestinationDir = "../../app/webroot/img/user/";
            $this->Upload->PbNewFileName = $output;

            if (!$this->Upload->uploadNewFile()) {
                $this->flash('Wrong data!', 'users/');
            }
            //$this->User->save($this->data["User"]["image"]);
        }

        //$arCat = explode("-",$this->data['Article']['category']);
        /*
        $form_data = array(
                    'User' => array(
                        'descr'				=>	$this->data['User']['descr'],
                        'showhide'			=>	$this->data['User']['showhide'],
                        'date'				=>	date("Y-m-d"),
                        'image'				=>	$output,
                        'ip1'				=>	$REMOTE_ADDR,
                        'ip2'				=>	$_SERVER['REMOTE_ADDR'],
                        'user_id'			=>	$this->Session->read("User.id")
                    )
                );
        */
        /*
        if($this->Session->read("User.id")==$this->Company->user_id) {
                //Displays a Message on success
                $this->Company->save($this->data);
                $this->flash('Sie haben sich als '.$this->data['Company']['firstname'].' saved', '/companies/mycompany/'.$this->Company->id);
            }
            else{
                $this->flash('Wrong data!');
            }

        */
        //print "<pre>";   print_r($this->data); print "</pre>"; die();

        if ($this->Session->read("User.id") === $this->User->id) {
            //Displays a Message on success
            $this->data["User"]["image"] = $output;

            if ($this->data["User"]["showhide"] === "on") {
                $this->data["User"]["showhide"] = 1;
            } else {
                $this->data["User"]["showhide"] = 0;
            }

            $this->User->query("UPDATE users SET showhide = '" . $this->data["User"]["showhide"] . "' WHERE id = '" . $this->Session->read("User.id") . "' ");

            $this->User->save($this->data);
            //$this->User->save($form_data);
            $this->flash('... ' . $this->data['User']['name'] . ' saved', '/users/view/' . $this->User->id);
        }
        //$this->set('user', $this->User->read("id,username,e-mail,online,name,pastname,created,interests,userpage,nickname"));
    }


    /**
     * @return void
     */
    public function logout()
    {
        //Destroys all session variables and sets the status of the user to "offline"
        $this->pageTitle = 'Deconectare';
        //Reads the user id out of the session variable
        $user = $this->Session->read('User');
        $this->User->id = $user['id'];
        //Sets the status to "offline"
        $this->User->saveField("online", "false");
        //Destroys all session variables
        $this->Session->delete('User');
        $this->Session->delete('authenticated');
        $this->Session->delete('rights');
        //Displays a success message and redirects to the Homepage for not registered users
        $this->flash('Redirectionare...', '/');
    }


    /**
     * @param $id
     * @return void
     */
    public function myentries($id)
    {
        $this->checkIfLogged();
        $criteria = " House.user_id =" . $id . " ";
        $this->set('Houses', $this->House->findAll($criteria, "", $order, $limit, $page));

        $criteria = " Car.user_id =" . $id . " ";
        $this->set('Cars', $this->Car->findAll($criteria, "", $order, $limit, $page));

        $criteria = " Article.user_id =" . $id . " ";
        $this->set('Articles', $this->Article->findAll($criteria, "", $order, $limit, $page));
    }

    /* getusernamebyid - get this username by id
    --------------------------------------------------------------------- */
    public function getusernamebyid($id = null)
    {
        $this->User->id = $id;
        $tmpUsr = $this->User->find(array('User.id' => $id));
        if ($tmpUsr["User"]["name"]) {
            return ucwords(strtolower($tmpUsr["User"]["name"]));
        }

        if ($tmpUsr["User"]["pastname"]) {
            return ucwords(strtolower($tmpUsr["User"]["pastname"]));
        }

        if ($tmpUsr["User"]["nickname"]) {
            return ucwords(strtolower($tmpUsr["User"]["nickname"]));
        }
        //$this->set("commdet", $commdet);
        return false;
    }

    /**
     * @param $id
     * @return void
     */
    public function myfavs($id)
    {
        $this->checkIfLogged();

        $criteria = " Fav.user_id =" . $id . " ";
        //$this->set('Favs', $this->Fav->findAll($criteria,"", $order, $limit, $page));

        $Favs = $this->Fav->findAll($criteria, "", $order, $limit, $page);
        $arArtIDs = [];
        foreach ($Favs as $Fav) {
            $arArtIDs[] = $Fav['Fav']['article_id'];
        }

        $sArtList = implode(",", $arArtIDs);
        if (count($arArtIDs) > 1) {
            $sArtList = substr($sArtList, 0, -1);
        }

        $criteria = " Article.id IN (" . $sArtList . ") ";
        $this->set('Articles', $this->Article->findAll($criteria, "", $order, $limit, $page));
        //print "<pre>"; print_r($arArtIDs); die();

    }

    /**
     * @param $id
     * @return void
     */
    public function myfriends($id)
    {
        $this->checkIfLogged();

        $criteria = " Friend.user_id =" . $id . " ";
        //$this->set('Friends', $this->Friend->findAll($criteria,"", $order, $limit, $page));
        $arFrIDs = [];
        $Friends = $this->Friend->findAll($criteria, "", $order, $limit, $page);

        foreach ($Friends as $Friend) {
            $arFrIDs[] = $Friend['Friend']['friend_id'];
        }

        //print "<pre>"; print_r($arFrIDs); die();
        $srFrIDs = implode(",", $arFrIDs);

        //echo $sFrList; die();
        if (count($arFrIDs) > 1) {
            $srFrIDs = substr($srFrIDs, 0, -1);
        }

        //echo $sFrList; die();

        $criteria = " User.id IN (" . $srFrIDs . ") ";
        $this->set('Friends', $this->User->findAll($criteria, "", $order, $limit, $page));
    }

    /**
     * @return void
     */
    public function forgotpassword()
    {
        $this->layout = "default";

        ini_set("display_errors", 1);
        error_reporting(1);

        if ($this->data) {
            $criteria = array("User.username" => $this->data["User"]["username"]);
            $uDetails = $this->User->findAll($criteria, "", $order, $limit, $page);

            if ($uDetails && $this->data["User"]["username"] === $uDetails[0]["User"]["username"]) {
                //print "<pre>";   print_r($uDetails); print "</pre>"; die();
                //echo "inside............";

                $newToken = $this->create_password(20);

                $to = $this->data["User"]["username"];
                $nameto = "Publion User";
                $from = "info@publion.ro";
                $namefrom = "Publion Anunturi";
                $subject = "Recuperare Parola Publion Anunturi";

                $message = "Pentru a putea schimba parola acceseaza urmatorul link:  - <A HREF='http://publion.ro/users/forgotpasswordtoken/" . $newToken . "'> http://publion.ro/users/forgotpasswordtoken/" . $newToken . " </A>";

                //$message = "Pentru a putea schimba parola acceseaza urmatorul link:  - ".$this->webroot."users/forgotpasswordtoken/".$newToken." ";

                $this->User->query("UPDATE users SET token='" . $newToken . "' WHERE username='" . $uDetails[0]["User"]["username"] . "' ");

                $this->Email->authSendEmail($from, $namefrom, $to, $nameto, $subject, $message);
                //die($message);
                //mail( $to, $subject, $message, "From: $from \n" ."MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1");
                $this->flash('In scurt timp vei  primi un email...', '/');
            } else {
                $this->set('error', 1);
            }
        }
    }

    /* forgotpasswordtoken -
    --------------------------------------------------------------------- */
    public function forgotpasswordtoken()
    {
        $sToken = $this->params["pass"][0];

        if ($this->data) {
            $this->layout = "default";

            //print "<pre>";   print_r($this->data); print "</pre>"; die();

            if ($this->data["User"]["newpassword1"] === $this->data["User"]["newpassword2"]) {
                $sNewPass = md5($this->data["User"]["newpassword1"]);
                $this->User->query("UPDATE users SET password='" . $sNewPass . "',token='' WHERE token='" . $this->data["User"]["token"] . "' ");
                $this->flash('Parola a fost schimbata...', '/');
            } else {
                $this->flash('Parola nu e corecta. ', '/');
            }
        } else if ($sToken) {
            $criteria = array("User.token" => $sToken);
            $uDetails = $this->User->findAll($criteria, "", $order, $limit, $page);

            //print "<pre>";   print_r($sToken); print "</pre>";
            //print "<pre>";   print_r($uDetails); print "</pre>"; die();

            if ($uDetails[0]["User"]["token"] === $sToken) {
                //$this->flash('Introdu o noua parola...', '/');
                $this->set("token", $sToken);
            } else {
                $this->flash('Parola sau datele sunt incorecte. Nu se pot schimba.', '/');
            }
        }
    }

    /**
     * @return void
     */
    public function changepassword()
    {
        $this->checkIfLogged();
        $this->layout = "default";

        if ($this->data) {
            /*
                    print "<pre>";   print_r($this->data); print "</pre>";
                    print "<pre>";   print_r($this->Session); print "</pre>";
                    print "<pre>";   print_r($uDetails); print "</pre>"; die();
            */
            //print "<pre>";   print_r($this->Session->read("User.id")); print "</pre>"; die();
            //print "<pre>";   print_r($uDetails); print "</pre>"; die();
            //debug($this->data);
            //$uDetails = $this->User->find($this->Session->read("User.id"));

            $criteria = array("User.id" => $this->Session->read("User.id"));
            $uDetails = $this->User->findAll($criteria, "", $order, $limit, $page);

            if ($uDetails && $this->Session->read("User.id") === $uDetails[0]["User"]["id"]) {
                if (
                    $this->data["User"]["newpassword1"] === $this->data["User"]["newpassword2"] &&
                    md5($this->data["User"]["oldpassword"]) === $uDetails[0]["User"]["password"]

                ) {
                    $sNewPass = md5($this->data["User"]["newpassword1"]);
                    $this->User->query("UPDATE users SET password='" . $sNewPass . "' WHERE id='" . $this->Session->read("User.id") . "' ");
                    $this->flash('Parola a fost schimbata...', '/');
                } else {
                    $this->flash('Parola nu este corecta. Nu se poate schimba.', '/users/changepassword');
                }
            } else {
                $this->set('error', 1);
            }
        }
    }

    /* generatePassword - Generate a random password
    --------------------------------------------------------------------- */
    public function generatePassword($length = 9, $strength = 0)
    {
        $vowels = 'aeuy';
        $consonants = 'bdghjmnpqrstvz';
        if ($strength & 1) {
            $consonants .= 'BDGHJLMNPQRSTVWXZ';
        }
        if ($strength & 2) {
            $vowels .= "AEUY";
        }
        if ($strength & 4) {
            $consonants .= '23456789';
        }
        if ($strength & 8) {
            $consonants .= '@#$%';
        }

        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt === 1) {
                $password .= $consonants[(mt_rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(mt_rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }

    /* generatePW - Generate a random password
  --------------------------------------------------------------------- */

    public function generatePW($length = 8)
    {
        $dummy = array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'), array('#', '&', '@', '$', '_', '%', '?', '+'));

        // shuffle array

        mt_srand((double)microtime() * 1000000);

        for ($i = 1; $i <= (count($dummy) * 2); $i++) {
            $swap = mt_rand(0, count($dummy) - 1);
            $tmp = $dummy[$swap];
            $dummy[$swap] = $dummy[0];
            $dummy[0] = $tmp;
        }

        // get password

        return substr(implode('', $dummy), 0, $length);
        # echo generatePW(10); // 10stelliges Passwort ausgeben...
    }

    /* create_password - Generate a random password
  --------------------------------------------------------------------- */
    public function create_password($length = 8, $use_upper = 1, $use_lower = 1, $use_number = 1, $use_custom = "")
    {
        $upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $lower = "abcdefghijklmnopqrstuvwxyz";
        $number = "0123456789";
        $password = '';
        $seed_length = 0;
        $seed = '';

        if ($use_upper) {
            $seed_length += 26;
            $seed .= $upper;
        }

        if ($use_lower) {
            $seed_length += 26;
            $seed .= $lower;
        }

        if ($use_number) {
            $seed_length += 10;
            $seed .= $number;
        }

        if ($use_custom) {
            $seed_length += strlen($use_custom);
            $seed .= $use_custom;
        }

        for ($x = 1; $x <= $length; $x++) {
            $password .= $seed{mt_rand(0, $seed_length - 1)};
        }

        return ($password);

        //USAGE
        /*
        echo create_password(); // Returns for example a7YmTwG4
        echo create_password(16); // Returns for example Z77OzzS3DgV3OxxP
        echo create_password(8,0,0); // Returns for example 40714215
        echo create_password(10,1,1,1,";,:.-_()"); // Returns for example or)ZA10kpX
        */
    }

}

