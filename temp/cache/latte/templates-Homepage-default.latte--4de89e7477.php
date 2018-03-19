<?php
// source: /Applications/MAMP/htdocs/mysocialnetwork/mysocialnetwork/app/presenters/templates/Homepage/default.latte

use Latte\Runtime as LR;

class Template4de89e7477 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['post'])) trigger_error('Variable $post overwritten in foreach on line 21');
		if (isset($this->params['sharedpost'])) trigger_error('Variable $sharedpost overwritten in foreach on line 63');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="container bootstrap snippet">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="bootstrap snippet">
                    <div class="well well-sm well-social-post">
<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["addPost"];
		?>                        <form<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		), false) ?>>
                            <ul class="list-inline" id='list_PostActions'>
                                <li class='active'><a href='#'>Přidat příspěvek</a></li>
                                <li><a href='#'>Přidat obrázek</a></li>
                                <li><a href='#'>Přidat video</a></li>
                            </ul>
                            <textarea class="form-control" placeholder="Jak se cítíš?"<?php
		$_input = end($this->global->formsStack)["content"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'placeholder' => NULL,
		))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></textarea>
                            <ul class='list-inline post-actions'>
                                <li class='pull-left'><button class='btn btn-primary btn-sm'<?php
		$_input = end($this->global->formsStack)["submit"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>Přidat příspěvek</button></li>
                                <br>
                                <br>
                            </ul>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>                        </form>
                    </div>
        </div>
<?php
		$iterations = 0;
		foreach ($posts as $post) {
?>
            <div class="panel panel-white post panel-shadow">
                <div class="post-heading">
                    <div class="pull-left image">
                        <img src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($post['posts']->post_creator_image)) /* line 25 */ ?>" class="img-circle avatar" alt="user profile image">
                    </div>
<?php
			if ($user->isInRole('admin') || $user->isInRole('owner')) {
?>
                        <div class="pull-right">
                            <a onClick="return confirm('Opravdu smazat?');" type="button" class="btn-remove btn btn-danger btn-xs" href="<?php
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("deletePost!", ['postId' => $post['posts']->post_id])) ?>"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>
<?php
			}
			elseif ($post['posts']->post_creator_id == $loggedin->user_id) {
?>
                        <div class="pull-right">
                            <a onClick="return confirm('Opravdu smazat?');" type="button" class="btn-remove btn btn-danger btn-xs" href="<?php
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("deletePost!", ['postId' => $post['posts']->post_id])) ?>"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>
<?php
			}
?>
                    <div class="pull-left meta">
                        <div class="title h5">
                            <a href="#"><b><?php echo LR\Filters::escapeHtmlText($post['posts']->post_creator) /* line 38 */ ?></b></a>
                            vytvořil/a příspěvek
                        </div>
                        <h6 class="text-muted time"><?php echo LR\Filters::escapeHtmlText($post['posts']->post_date) /* line 41 */ ?></h6>
                    </div>
                </div>
                <div class="post-description">
                    <p><?php echo LR\Filters::escapeHtmlText($post['posts']->post_content) /* line 45 */ ?></p>
                    <div class="stats">
<?php
			if ($post['likesCount'] == 0) {
				?>                            <a class="btn btn-default stat-item" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:likePost", ['postId' => $post['posts']->post_id])) ?>">
                                <i class="glyphicon glyphicon-thumbs-up"></i>
                            </a>
<?php
			}
			else {
				?>                            <a class="btn btn-default stat-item" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:likePost", ['postId' => $post['posts']->post_id])) ?>">
                                <i class="glyphicon glyphicon-thumbs-up"></i> <?php echo LR\Filters::escapeHtmlText($post['likesCount']) /* line 53 */ ?>

                            </a>
<?php
			}
			?>                        <a class="btn btn-default stat-item" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:sharePost", ['postId' => $post['posts']->post_id])) ?>">
                            <i class="glyphicon glyphicon-share"></i> <?php echo LR\Filters::escapeHtmlText($post['sharesCount']) /* line 57 */ ?>

                        </a>
                    </div>
                </div>
            </div>
<?php
			$iterations++;
		}
		$iterations = 0;
		foreach ($sharedposts as $sharedpost) {
?>
            <div class="panel panel-white post panel-shadow">
                <div class="post-heading">
                    <div class="pull-left image">
                        <img src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($sharedpost['posts']->post_sharer_image)) /* line 67 */ ?>" class="img-circle avatar" alt="user profile image">
                    </div>
<?php
			if ($user->isInRole('admin') || $user->isInRole('owner')) {
?>
                    <div class="pull-right">
                        <a onClick="return confirm('Opravdu smazat?');" type="button" class="btn-remove btn btn-danger btn-xs" href="<?php
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("deleteSharedPost!", ['postId' => $sharedpost['posts']->post_id, 'sharedId' => $sharedpost['posts']->id])) ?>"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>
<?php
			}
			elseif ($sharedpost['posts']->post_sharer == $loggedin->user_name) {
?>
                    <div class="pull-right">
                        <a onClick="return confirm('Opravdu smazat?');" type="button" class="btn-remove btn btn-danger btn-xs" href="<?php
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("deleteSharedPost!", ['postId' => $sharedpost['posts']->post_id, 'sharedId' => $sharedpost['posts']->id])) ?>"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>
<?php
			}
?>
                    <div class="pull-left meta">
                        <div class="title h5">
                            <a href="#"><b><?php echo LR\Filters::escapeHtmlText($sharedpost['posts']->post_sharer) /* line 80 */ ?></b></a>
                            sdílel/a příspěvek uživatele <b><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:profile", ['userId' => $sharedpost['posts']->post_creator_id])) ?>"><?php
			echo LR\Filters::escapeHtmlText($sharedpost['posts']->post_creator) /* line 81 */ ?></a></b>
                        </div>
                        <h6 class="text-muted time"><?php echo LR\Filters::escapeHtmlText($sharedpost['posts']->post_shareddate) /* line 83 */ ?></h6>
                    </div>
                </div>

                    <div class="panel panel-white post panel-shadow" style="margin-left: 30px; margin-right: 30px">
                        <div class="post-heading">
                            <div class="pull-left image">
                                <img src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($sharedpost['posts']->post_creator_image)) /* line 90 */ ?>" class="img-circle avatar" alt="user profile image">
                            </div>
                            <div class="pull-left meta">
                                <div class="title h5">
                                    <a href="#"><b><?php echo LR\Filters::escapeHtmlText($sharedpost['posts']->post_creator) /* line 94 */ ?></b></a>
                                    vytvořil/a příspěvek
                                </div>
                                <h6 class="text-muted time"><?php echo LR\Filters::escapeHtmlText($sharedpost['posts']->post_shareddate) /* line 97 */ ?></h6>
                            </div>
                        </div>
                        <div class="post-description">
                            <p><?php echo LR\Filters::escapeHtmlText($sharedpost['posts']->post_content) /* line 101 */ ?></p>
                        </div>
                    </div>

                <div class="stats" style="padding-left: 15px; padding-bottom: 15px">
<?php
			if ($sharedpost['likesCount'] == 0) {
				?>                        <a class="btn btn-default stat-item" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:likeSharedPost", ['postId' => $sharedpost['posts']->post_id, 'sharedId' => $sharedpost['posts']->id])) ?>">
                            <i class="glyphicon glyphicon-thumbs-up"></i>
                        </a>
<?php
			}
			else {
				?>                        <a class="btn btn-default stat-item" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:likeSharedPost", ['postId' => $sharedpost['posts']->post_id, 'sharedId' => $sharedpost['posts']->id])) ?>">
                            <i class="glyphicon glyphicon-thumbs-up"></i> <?php echo LR\Filters::escapeHtmlText($sharedpost['likesCount']) /* line 112 */ ?>

                        </a>
<?php
			}
?>
                </div>
            </div>
<?php
			$iterations++;
		}
?>

    </div>
</div>
<?php
	}

}
