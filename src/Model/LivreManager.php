<?php

namespace App\Model;

use PDO;

class LivreManager extends AbstractManager
{
    /**
     *
     */
    public const TABLE = 'livre';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
