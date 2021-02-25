<?php
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

class InfosController extends AppController {

   var $name = 'Infos';
   #var $pageTitle = "Pages";
   #var $layout = 'default';
   var $uses    = array("Info");
   var $helpers = array('Html', 'Javascript', 'Session', 'Head', 'Javascript', 'Ajax', 'Form', 'Pagination');

   public function index() {
	  $this->pageTitle = ' - Contact Us';
   }

   public function contact() {
	  $this->pageTitle = ' - Contact Us';
   }

   public function terms() {
	  $this->pageTitle = ' - Termeni de utilizare';
   }

   public function faq() {
	  $this->pageTitle = ' - Contact Us';
   }

   public function telefoaneutile() {
	  $this->pageTitle = ' - Telefoane Utile ';
   }

   public function prefixeromania() {
	  $this->pageTitle = ' - Telefoane Utile ';
   }

   public function prefixetari() {
	  $this->pageTitle = ' - Telefoane Utile ';
   }

   public function ambasade() {
	  $this->pageTitle = ' - Telefoane Utile ';
   }

   public function consulate() {
	  $this->pageTitle = ' - Telefoane Utile ';
   }

}

