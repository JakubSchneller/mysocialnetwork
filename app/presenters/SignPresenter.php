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
use Nette\Security;

class SignPresenter extends BasePresenter
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

	public function actionOut(){
	    $this->user->logout();
    }

	protected function createComponentRegistration()
    {
        $form = new Form;
        $form->addText("surname")
            ->setRequired("Vyplňte prosím křestní jméno");
        $form->addText("lastname")
            ->setRequired("Vyplňte prosím přijmení");
        $form->addText("username")
            ->setRequired("Vyplňte prosím přihlašovací jméno");
        $form->addEmail("email")
            ->setRequired("Vyplňte prosím email");
        $form->addPassword("password")
            ->setRequired("Vyplňte prosím heslo");
        $form->addPassword("passwordconfirm")
            ->setRequired("Vyplňte prosím heslo pro ověření");
        $form->addText("aboutme");
        $form->addUpload('image','Obrázek: ')
            ->setRequired("Prosím vyberte obrázek k nahrání.");
        $form->addSubmit("submit");
        $form->onSuccess[] = [$this, 'registrationSuccess'];
        return $form;
    }

    public function registrationSuccess($form, $values)
    {
        $file = $values->image;


        if ($values->username != "" && $file->isImage()) {

            $file_ext=strtolower(mb_substr($file->getSanitizedName(), strrpos($file->getSanitizedName(), ".")));

            $filename = Nette\Utils\Random::generate(15);
            $filename = $filename . $file_ext;


            $isUnique = ($this->database->table('users')
                    ->where("image", $filename)->count() <= 0);


            while(!$isUnique) {
                $filename = Nette\Utils\Random::generate(15);
                $filename = $filename . ".png";

                $isUnique = ($this->database->table('users')
                        ->where("img_filename", $filename)->count() <= 0);
            }

            $file->move("images/".$filename);

            $this->userManager->add($values->username, $values->email, $values->password, $values->surname, $values->lastname, $values->aboutme, $values->image);


            $form->getPresenter()->flashMessage('Byl jste úspěšně zaregistrován', 'success');
            $form->getPresenter()->redirect('Sign:in');
        }
        else
        {
            $form->getPresenter()->flashMessage('Nebyl jste zaregistrován kvůli chybě. Zkuste to znovu později. ', 'danger');
            $form->getPresenter()->redirect('this');
        }
    }




    protected function createComponentLogin()
    {

        $form = new UI\Form;
        $form->addText('username', 'Jméno: ')
            ->setRequired('Zadejte prosím jméno');
        $form->addPassword('password','Heslo:')
            ->setRequired('Zadejte prosím heslo');
        $form->addSubmit('login','Přihlásit se');
        $form->onSuccess[] = [$this, 'loginSuccess'];
        return $form;
    }

    public function loginSuccess($form, $values)
    {
        try{
            $this->user->login($values->username, $values->password);
            $form->getPresenter()->flashMessage('Úspěšné přihlášení','success');
            $form->getPresenter()->redirect('Homepage:default');
        }
        catch (Security\AuthenticationException $e){
            $this->flashMessage($e->getMessage(), 'warning');
            $this->getPresenter()->redirect("Sign:in");
        }

    }
}
