<?php

namespace App\Presenters;

use Nette;
use App\Forms;
use Nette\Application\UI\Form;
use Nette\Application\UI;
use Nette\Database\Context;
use Nette\Security\Passwords;
use Nette\Security\User;
use Tracy\Debugger;
use App\Model\UserManager;
use Nette\Utils\DateTime;
use Nette\Http\Session;

class PostPresenter extends BasePresenter
{
    private $database;
    private $user;
    private $userManager;

    public function __construct(Context $database, User $user, UserManager $userManager)
    {
        $this->database = $database;
        $this->user = $user;
        $this->userManager = $userManager;
    }

    public function renderAdd($topicId)
    {
        $myUser = $this->user->getIdentity();
        $this->template->currentUser = $myUser;
        $this->template->topicId = $topicId;
    }

    protected function createComponentAddArticle()
    {

        $form = new form;
        $form->addText("name")
            ->setRequired("Vyplňte prosím název příspěvku");
        $form->addText("description")
            ->setRequired("Vyplňte prosím popis příspěvku");
        $form->addText("content")
            ->setRequired("Vyplňte prosím obsah příspěvku");
        $form->addSubmit("submit");
        $form->onSuccess[] = [$this, 'addArticleSuccess'];
        return $form;
    }

    public function AddArticleSuccess($form, $values)
    {
        $this->database->table("posts")->insert([

            'post_name'=> $values->name,
            'post_content'=>$values->content,
            'post_description'=>$values->description,
            'topic_id'=>$this->getParameter('topicId'),
            'post_date'=>new DateTime,
            'post_creator'=>$this->getUser()->getIdentity()->user_name,
            'post_creator_id'=>$this->getUser()->getIdentity()->user_id,
            'post_creator_role' => $this->getUser()->getIdentity()->role
        ]);

        $this->flashMessage('Článek byl úspěšně přidán.');
        $this->redirect('Forum:posts', array("topicId" => $this->getParameter('topicId')));
    }

    protected function createComponentCommentForm()
    {
        $form = new Form;

        $form->addText('name', 'Jméno:')
            ->setRequired();

        $form->addTextArea('content', 'Komentář:')
            ->setRequired();

        $form->addSubmit('submit', 'Publikovat komentář');

        return $form;
    }



}