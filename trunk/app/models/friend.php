<?php

/**
 * Modello delle Categorie.
 * @author         Pereira Pulido Nuno Ricardo | Namaless | namaless@gmail.com
 * @copyright      Copyright 1981-2008, Namaless.
 * @link           http://www.namaless.com Namaless Blog
 * @version        1.0
 * @license        http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class Friend extends AppModel {
   /**
	* Nome del modello.
	* @var string
	*/
   var $name = 'Friend';

   /**
	* Relazione uno a molti.
	* @var mixed
	*/

   var $belongsTo = 'User';

   /*
	   var $belongsTo = array('Users' =>
							   array('className' => 'User',
											   'foreignKey' => 'user_id',
											   'conditions' => '',
											   'fields' => '',
											   'order' => '',
											   'dependent' => ''
							   )

	   ); */

   /*
	   var $hasOne = array('Prices' =>
						   array('className' => 'Price',
							   'foreignKey' => 'company_id',
							   'conditions' => '',
							   'fields' => '',
							   'order' => '',
							   'dependent' => ''
							   )
	   );
   */

   /*
	   var $hasMany = array('Prices' =>	array('className' => 'Price',
											   'foreignKey' => 'company_id',
											   'conditions' => '',
											   'fields' => '',
											   'order' => '',
											   'dependent' => ''
							   )
	   );
   */

   /*
	   var $hasAndBelongsToMany = array('Article' => array('className' => 'Article',
							   'joinTable' => 'Articles',
							   'foreignKey' => 'category_id',
							   'associationForeignKey' => 'company_id',
							   'with' => 'Companies',
							   'unique' => true
			   )
	   );
   */

   /**
	* Validazione dei campi.
	* @var array
	*/

   /*
	   var $validate = array(
		   'title' => array(
			   'rule'		=> array('minLength', 1),
			   'required'	=> TRUE
		   )
	   );
   */

}


