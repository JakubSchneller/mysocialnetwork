<?php

namespace App\Presenters;

use Nette\Database\Context;

class HomepagePresenter extends BasePresenter
{
    private $database;


    public function __construct(Context $database)
    {
        $this->database = $database;
    }

    public function renderDefault()
	{

	}
}
