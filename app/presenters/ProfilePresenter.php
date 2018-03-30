<?php

namespace App\Presenters;

use Nette;
use Nette\Database\Context;
use Nette\Security\User;
use Nette\Security\Identity;
use Nette\Application\UI\Form;

class ProfilePresenter extends \App\Presenters\BasePresenter
{
    private $database;


    public function __construct(Context $database)
    {
        $this->database = $database;
    }


    public function renderProfile($userId)
    {
        $users = $this->database->table("users")->where("user_id", $userId)->fetch();
        $this->template->users = $users;

        $friends = $this->database->table("friends")->where("user_id = ? AND friend_id = ?", $this->getUser()->getId(), $users->user_id)->fetch();

        if (empty($friends))
        {
            $arewefriends = false;
        }
        else
        {
            $arewefriends = true;
        }

        $this->template->arewefriends = $arewefriends;


    }
    public function renderProfileTest($userId)
    {
        $users = $this->database->table("users")->where("user_id", $userId)->fetch();
        $this->template->users = $users;

    }
    public function renderEditProfile($userId)
    {
        $users = $this->database->table("users")->where("user_id", $userId)->fetch();
        $this->template->users = $users;
        $this->template->userId = $userId;
    }
    public function createComponentEditUserForm()
    {
        if ($this->database->table('users')->get($this->getParameter('userId'))->role == "owner") {
            $roles = [
                'value1' => 'owner',
                'value2' => 'admin',
                'value3' => 'user'
            ];
        }
        elseif($this->database->table('users')->get($this->getParameter('userId'))->role == "admin")
        {
            $roles = [
                'value1' => 'admin',
                'value2' => 'user'
            ];
        }
        else
        {
            $roles = [
                'value1' => 'user',
                'value2' => 'admin'
            ];
        }

        $form = new Form;
        $form->addText('firstname', 'Křestní jméno:')
            ->setRequired('Zadejte prosím křestní jméno');
        $form->addText('lastname', 'Příjmení: ')
            ->setRequired('Zadejte prosím příjmení jméno');
        $form->addEMail('email', 'Email:')
            ->setRequired('Zadejte prosím email');
        $form->addText('username', 'Přihlašovací jméno:')
            ->setRequired('Zadejte prosím přihlašovací jméno');
        if ($this->getUser()->isInRole('admin') || $this->getUser()->isInRole('owner')) {
            $form->addSelect('role', 'Role:')
                ->setItems($roles, false);
        }
        $form->addSubmit('add','Uložit');
        $form->onSuccess[] = [$this, 'EditUserFormSuccess'];
        return $form;
    }
    public function EditUserFormSuccess($form, $values) {
        $editeduser = $this->database->table('users')->get($this->getParameter('userId'));
        if ($editeduser->user_name == $values->username || $this->database->table('users')->where("user_name", $values->username)->count() == 0) {
            if ($editeduser->role == "user" && $this->getUser()->getRoles() == "user")
            {
                if ($editeduser->first_name == $values->firstname && $editeduser->last_name == $values->lastname && $editeduser->user_name == $values->username &&  $editeduser->user_email == $values->email)
                {
                    $form->getPresenter()->flashMessage('Žádne údaje nebyly změněny', 'warning');
                    $form->getPresenter()->redirect('this');
                }
                else
                {

                    if ($this->getUser()->isInRole('admin') || $this->getUser()->isInRole('owner')) {
                        $editeduser->update([
                            'first_name' => $values->firstname,
                            'last_name' => $values->lastname,
                            'user_email' => $values->email,
                            'user_name' => $values->username,
                            'role' => $values->role,
                            'last_updated' => new Nette\Utils\DateTime
                        ]);
                    }
                    else {
                        $editeduser->update([
                            'first_name' => $values->firstname,
                            'last_name' => $values->lastname,
                            'user_email' => $values->email,
                            'user_name' => $values->username,
                            'last_updated' => new Nette\Utils\DateTime
                        ]);
                    }
                    if ($editeduser->user_id == $this->getUser()->getId()) {
                        $this->getUser()->logout();
                        $form->getPresenter()->flashMessage('Profil byl úspěšně aktualizován. Přihlaste se prosím znovu.', 'success');
                        $form->getPresenter()->redirect('Sign:in');
                    }
                    else {
                        $form->getPresenter()->flashMessage('Profil byl úspěšně aktualizován.', 'success');
                        $form->getPresenter()->redirect('this');
                    }
                }
            }
            else
            {
                if ($editeduser->first_name == $values->firstname && $editeduser->last_name == $values->lastname && $editeduser->user_name == $values->username &&  $editeduser->user_email == $values->email && $editeduser->role == $values->role)
                {
                    $form->getPresenter()->flashMessage('Žádne údaje nebyly změněny', 'warning');
                    $form->getPresenter()->redirect('this');
                }
                else
                {

                    if ($this->getUser()->isInRole('admin') || $this->getUser()->isInRole('owner')) {
                        $editeduser->update([
                            'first_name' => $values->firstname,
                            'last_name' => $values->lastname,
                            'user_email' => $values->email,
                            'user_name' => $values->username,
                            'role' => $values->role,
                            'last_updated' => new Nette\Utils\DateTime
                        ]);
                    }
                    else {
                        $editeduser->update([
                            'first_name' => $values->firstname,
                            'last_name' => $values->lastname,
                            'user_email' => $values->email,
                            'user_name' => $values->username,
                            'last_updated' => new Nette\Utils\DateTime
                        ]);
                    }
                    if ($editeduser->user_id == $this->getUser()->getId()) {
                        $this->getUser()->logout();
                        $form->getPresenter()->flashMessage('Profil byl úspěšně aktualizován. Přihlaste se prosím znovu.', 'success');
                        $form->getPresenter()->redirect('Sign:in');
                    }
                    else {
                        $form->getPresenter()->flashMessage('Profil byl úspěšně aktualizován.', 'success');
                        $form->getPresenter()->redirect('this');
                    }
                }
            }
        }
        else {
            $form->getPresenter()->flashMessage('Toto uživatelské jméno již někdo používá.', 'danger');
        }
    }

    public function actionAddFriend($friendId) {
            $this->database->table('friends')->insert([
                'user_id' => $this->getUser()->getId(),
                'friend_id' => $friendId
            ]);
        $this->redirect('Profile:profile', ['userId' => $friendId]);
    }

    public function actionDeleteFriend($friendId) {
        $this->database->table("friends")->where("user_id = ? AND friend_id = ?", $this->getUser()->getId(), $friendId)->delete();
        $this->redirect('Profile:profile', ['userId' => $friendId]);
    }
}