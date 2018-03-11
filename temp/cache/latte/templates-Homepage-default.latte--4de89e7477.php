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
		if (isset($this->params['post'])) trigger_error('Variable $post overwritten in foreach on line 4');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="container bootstrap snippet">
<div class="col-sm-8 col-sm-offset-2">
<?php
		$iterations = 0;
		foreach ($posts as $post) {
?>
    <div class="panel panel-white post panel-shadow">
        <div class="post-heading">
            <div class="pull-left image">
                <img src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($post['posts']->post_creator_image)) /* line 8 */ ?>" class="img-circle avatar" alt="user profile image">
            </div>
            <div class="pull-left meta">
                <div class="title h5">
                    <a href="#"><b><?php echo LR\Filters::escapeHtmlText($post['posts']->post_creator) /* line 12 */ ?></b></a>
                    vytvořil/a příspěvek
                </div>
                <h6 class="text-muted time"><?php echo LR\Filters::escapeHtmlText($post['posts']->post_date) /* line 15 */ ?></h6>
            </div>
        </div>
        <div class="post-description">
            <p><?php echo LR\Filters::escapeHtmlText($post['posts']->post_content) /* line 19 */ ?></p>
            <div class="stats">
<?php
			if ($post['likesCount'] == 0) {
				?>                    <a class="btn btn-default stat-item" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:likePost", ['postId' => $post['posts']->post_id])) ?>">
                        <i class="glyphicon glyphicon-thumbs-up"></i>
                    </a>
<?php
			}
			else {
				?>                    <a class="btn btn-default stat-item" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:likePost", ['postId' => $post['posts']->post_id])) ?>">
                        <i class="glyphicon glyphicon-thumbs-up"></i> <?php echo LR\Filters::escapeHtmlText($post['likesCount']) /* line 27 */ ?>

                    </a>
<?php
			}
?>
                <a href="#" class="btn btn-default stat-item">
                    <i class="glyphicon glyphicon-share"></i> 12
                </a>
            </div>
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
