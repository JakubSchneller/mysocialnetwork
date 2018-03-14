<?php

namespace App\Presenters;

use Nette\Database\Context;
use Nette\Application\UI\Form;
use Nette\Utils\DateTime;

class SearchPresenter extends BasePresenter
{
    private $database;


    public function __construct(Context $database)
    {
        $this->database = $database;
    }

    public function renderSearchForm()
    {

    }
    public function createComponentSearch() {
        $categories = [
            'value1' => 'Přihlašovací jméno',
            'value2' => 'Křestní jméno',
            'value3' => 'Příjmení'
        ];

        $form = new Form;
        $form->addText('content', 'Hledat:')->setRequired(TRUE);
        $form->addSelect('category')->setItems($categories, false);
        $form->addSubmit('submit');
        $form->onSuccess[] = [$this, 'SearchSuccess'];
        return $form;
    }

    public function SearchSuccess($form, $values) {
        $this->redirect('Search:searchresults', ['content' => $values->content, 'category' => $values->category]);

    }

    public function renderSearchResults($content, $category)
    {
        if($category == "Přihlašovací jméno")
        {
            $users = $this->database->table('users')->where('user_name', $content);
            $this->template->users = $users;
            if (empty($row['user_id']))
            {
                $this->getPresenter()->flashMessage('Žádný takový uživatel neexistuje!', 'danger');
                $this->redirect('Search:searchform');
            }
        }
        elseif ($category == "Křestní jméno")
        {
            $users = $this->database->table('users')->where('first_name', $content);
            $this->template->users = $users;
            if (empty($row['user_id']))
            {
                $this->getPresenter()->flashMessage('Žádný takový uživatel neexistuje!', 'danger');
                $this->redirect('Search:searchform');
            }
        }
        else
        {
            $users = $this->database->table('users')->where('last_name', $content);
            $this->template->users = $users;
            if (empty($row['user_id']))
            {
                $this->getPresenter()->flashMessage('Žádný takový uživatel neexistuje!', 'danger');
                $this->redirect('Search:searchform');
            }
        }
    }




}