<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

/** @noinspection AutoloadingIssuesInspection */

class Message extends AppModel
{
    /**
     * Nome del modello.
     * @var string
     */
    public $name = 'Message';

    /**
     * Relazione uno a molti.
     * @var mixed
     */

    public $belongsTo = 'User';

}


