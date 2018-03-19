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
        $this->redirect('Search:searchengine', ['content' => $values->content, 'category' => $values->category]);

    }

    public function renderSearchEngine($content, $category)
    {
        if($category == "Přihlašovací jméno")
        {
            $userscount = $this->database->table('users')->where('user_name', $content)->count();
            if ($userscount == 0)
            {
                $this->getPresenter()->flashMessage('Žádný takový uživatel neexistuje!', 'danger');
                $this->redirect('Search:searchform');
            }
            elseif ($userscount == 1)
            {
                $this->redirect('Search:searchresult', ['content' => $content, 'category' => $category]);
            }
            else
            {
                $this->redirect('Search:searchresults', ['content' => $content, 'category' => $category]);
            }
        }
        elseif ($category == "Křestní jméno")
        {
            $userscount = $this->database->table('users')->where('first_name', $content)->count();
            if ($userscount == 0)
            {
                $this->getPresenter()->flashMessage('Žádný takový uživatel neexistuje!', 'danger');
                $this->redirect('Search:searchform');
            }
            elseif ($userscount == 1)
            {
                $this->redirect('Search:searchresult', ['content' => $content, 'category' => $category]);
            }
            else
            {
                $this->redirect('Search:searchresults', ['content' => $content, 'category' => $category]);
            }
        }
        else
        {
            $userscount = $this->database->table('users')->where('last_name', $content)->count();
            if ($userscount == 0)
            {
                $this->getPresenter()->flashMessage('Žádný takový uživatel neexistuje!', 'danger');
                $this->redirect('Search:searchform');
            }
            elseif ($userscount == 1)
            {
                $this->redirect('Search:searchresult', ['content' => $content, 'category' => $category]);
            }
            else
            {
                $this->redirect('Search:searchresults', ['content' => $content, 'category' => $category]);
            }
        }
    }

    public function renderSearchResult($content, $category)
    {
        if($category == "Přihlašovací jméno")
        {
            $users = $this->database->table('users')->where('user_name', $content)->fetch();
            $this->template->users = $users;
        }
        elseif ($category == "Křestní jméno")
        {
            $users = $this->database->table('users')->where('first_name', $content)->fetch();
            $this->template->users = $users;
        }
        else
        {
            $users = $this->database->table('users')->where('last_name', $content)->fetch();
            $this->template->users = $users;
        }
    }

    public function renderSearchResults($content, $category)
    {
        if($category == "Přihlašovací jméno")
        {
            $usersArray = [];
            $foundusers = $this->database->table('users')->where('user_name', $content);
            foreach ($foundusers as $iUser)
            {
                $usersArray[$iUser->user_id] = [
                    'users' => $iUser,
                ];
            }
            $this->template->foundusers = $usersArray;

        }
        elseif ($category == "Křestní jméno")
        {
            $usersArray = [];
            $foundusers = $this->database->table('users')->where('first_name', $content);
            foreach ($foundusers as $iUser)
            {
                $usersArray[$iUser->user_id] = [
                    'users' => $iUser,
                ];
            }
            $this->template->foundusers = $usersArray;
        }
        else
        {
            $usersArray = [];
            $foundusers = $this->database->table('users')->where('last_name', $content);
            foreach ($foundusers as $iUser)
            {
                $usersArray[$iUser->user_id] = [
                    'users' => $iUser,
                ];
            }
            $this->template->foundusers = $usersArray;
        }
    }






}