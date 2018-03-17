<?php

namespace App\Presenters;

use Nette\Database\Context;
use Nette\Application\UI\Form;
use Nette\Utils\DateTime;

class HomepagePresenter extends BasePresenter
{
    private $database;


    public function __construct(Context $database)
    {
        $this->database = $database;
    }

    public function renderDefault()
    {
        $postsArray = [];
        $sharedpostsArray = [];
        $posts = $this->database->table("posts")->order('post_id DESC');
        $sharedposts = $this->database->table("posts_shared")->order('post_id DESC');

        foreach ($posts as $iPost) {
            $postsArray[$iPost->post_id] = [
                'posts' => $iPost,
                'likesCount' => $this->database->table("likes")->where("post_id", $iPost->post_id)->count()
            ];
        }

        foreach ($sharedposts as $iSharedPost) {
            $sharedpostsArray[$iSharedPost->post_id] = [
                'posts' => $iSharedPost,
                'sharesCount' => $this->database->table("posts_shared")->where("post_id", $iPost->post_id)->count()
            ];
        }
        $this->template->posts = $postsArray;
        $this->template->sharedposts = $sharedpostsArray;
    }

    public function actionLikePost($postId) {
        $like = $this->database->table('likes')
            ->where('post_id = ? AND user_id = ?', $postId, $this->getUser()->getId())
            ->fetch();
        if ($like) {
            $this->flashMessage('Tohle jsi už lajknul');
        }
        else {
            $this->database->table('likes')
                ->insert(['post_id' => $postId, 'user_id' => $this->getUser()->getId()]);
        }
        $this->redirect('Homepage:default');
    }

    protected function createComponentAddPost()
    {
        $form = new Form;
        $form->addText("content")
            ->setRequired("Vyplňte prosím obsah komentáře");
        $form->addSubmit("submit");
        $form->onSuccess[] = [$this, 'addPostSuccess'];
        return $form;
    }

    public function addPostSuccess($form, $values)
    {
        $this->database->table('posts')->insert([
            'post_content' => $values->content,
            'post_date' => new DateTime(),
            'post_creator' => $this->getUser()->getIdentity()->user_name,
            'post_creator_id'   => $this->getUser()->getIdentity()->user_id,
            'post_creator_image' => $this->getUser()->getIdentity()->image
        ]);
        $this->redirect('this');
    }

    public function handleDeletePost($postId)
    {
        $this->database->table('posts')->get($postId)->delete();
        $this->database->table('likes')->where("post_id", $postId)->delete();
        $this->flashMessage('Příspěvek byl úspěšně smazán', 'success');
    }

    public function actionSharePost($postId) {
        $share = $this->database->table('posts')->where('post_id', $postId)->fetch();
        $this->database->table('posts_shared')->insert([
                'post_content' => $share->post_content,
                'post_date' => $share->post_date,
                'post_shareddate' => new DateTime(),
                'post_creator' => $share->post_creator,
                'post_sharer' => $this->getUser()->getIdentity()->user_name,
                'post_creator_id'   => $share->post_creator_id,
                'post_sharer_id'   => $this->getUser()->getIdentity()->user_id,
                'post_creator_image'   => $share->post_creator_image,
                'post_sharer_image' => $this->getUser()->getIdentity()->image
            ]);
        $this->redirect('Homepage:default');
    }
    public function handleDeleteSharedPost($postId)
    {
        $this->database->table('posts_shared')->get($postId)->delete();
        $this->flashMessage('Příspěvek byl úspěšně smazán', 'success');
    }


}