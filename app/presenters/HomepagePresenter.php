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
        $postsArray = [];
        $posts = $this->database->table("posts");

        foreach ($posts as $iPost) {
            $postsArray[$iPost->post_id] = [
                'posts' => $iPost,
                'likesCount' => $this->database->table("likes")->where("post_id", $iPost->post_id)->count()
            ];
        }
        $this->template->posts = $postsArray;
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

}
