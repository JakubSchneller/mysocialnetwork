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
        $sharedposts = $this->database->table("posts_shared");

        foreach ($posts as $iPost) {
            $postsArray[$iPost->post_id] = [
                'posts' => $iPost,
                'likesCount' => $this->database->table("likes")->where("post_id", $iPost->post_id)->count(),
                'sharesCount' => $this->database->table("posts_shared")->where("post_id", $iPost->post_id)->count()

            ];
        }

        foreach ($sharedposts as $iSharedPost) {
            $sharedpostsArray[$iSharedPost->id] = [
                'posts' => $iSharedPost,
                'likesCount' => $this->database->table("likes_shared")->where("post_id = ? AND shared_post_id = ?", $iSharedPost->post_id, $iSharedPost->id)->count()
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
            $this->flashMessage('Tohle jsi už lajknul', 'warning');
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
        $share = $this->database->table('posts')->where('post_id = ?', $postId)->fetch();
        $alreadyshared = $this->database->table('posts_shared')->where('post_id = ? AND post_sharer_id = ?', $postId, $this->getUser()->getId())->fetch();
        if ($alreadyshared) {
            $this->flashMessage('Tohle jsi už sdílel', 'warning');
        }
        else {
            $this->database->table('posts_shared')->insert([
                'post_id' => $postId,
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
        }
        $this->redirect('Homepage:default');
    }
    public function handleDeleteSharedPost($postId, $sharedId)
    {
        $this->database->table('posts_shared')->where('post_id = ? AND id = ?', $postId, $sharedId)->delete();
        $this->flashMessage('Příspěvek byl úspěšně smazán', 'success');
    }

    public function actionLikeSharedPost($postId, $sharedId) {
        $like = $this->database->table('likes_shared')
            ->where('post_id = ? AND user_id = ? AND shared_post_id = ?', $postId, $this->getUser()->getId(), $sharedId)
            ->fetch();
        if ($like) {
            $this->flashMessage('Tohle jsi už lajknul', 'warning');
        }
        else {
            $this->database->table('likes_shared')
                ->insert(['post_id' => $postId, 'user_id' => $this->getUser()->getId(), 'shared_post_id' => $sharedId]);
        }
        $this->redirect('Homepage:default');
    }


}