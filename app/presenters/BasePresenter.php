<?php

namespace App\Presenters;

use Nette;
use Nette\Database\Context;
use Nette\Application\UI\Form;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    private $database;


    public function __construct(Context $database)
    {
        $this->database = $database;
    }

    public function beforeRender()
    {
        $user = $this->getUser();
        if ($user->isLoggedIn())
        {
            $this->template->loggedin = $user->getIdentity();
            $this->template->loggedin_image = $user->getIdentity()->image;
        }

    }
}