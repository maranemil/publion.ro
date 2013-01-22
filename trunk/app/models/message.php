<?php

class Message extends AppModel
{
	/**
	 * Nome del modello.
	 *
	 * @var string
	 */
	var $name = 'Message';

	/**
	 * Relazione uno a molti.
	 *
	 * @var mixed
	 */

	var $belongsTo = 'User';

}

?>
