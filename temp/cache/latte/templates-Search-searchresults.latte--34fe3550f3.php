<?php
// source: /Applications/MAMP/htdocs/mysocialnetwork/mysocialnetwork/app/presenters/templates/Search/searchresults.latte

use Latte\Runtime as LR;

class Template34fe3550f3 extends Latte\Runtime\Template
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
		if (isset($this->params['user'])) trigger_error('Variable $user overwritten in foreach on line 18');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                            <tr>
                                <th><span>Přihlašovací jméno</span></th>
                                <th><span>Email</span></th>
                                <th><span>Založeno</span></th>
                                <th><span>Naposledy upraveno</span></th>
                            </tr>
                            </thead>
                            <tbody>
<?php
		$iterations = 0;
		foreach ($users as $user) {
?>
                            <tr>
                                <td>
                                    <img src="../<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($user->image)) /* line 21 */ ?>" alt="">
                                    <a class="user-link" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:profile", ['userId' => $user->user_id])) ?>"><?php
			echo LR\Filters::escapeHtmlText($user->first_name) /* line 22 */ ?> <?php echo LR\Filters::escapeHtmlText($user->last_name) /* line 22 */ ?></a>
                                    <span class="user-subhead"><?php echo LR\Filters::escapeHtmlText($user->role) /* line 23 */ ?></span>
                                </td>
                                <td>
                                    <a href="#"><?php echo LR\Filters::escapeHtmlText($user->user_email) /* line 26 */ ?></a>
                                </td>
                                <td><?php echo LR\Filters::escapeHtmlText($user->date_created) /* line 28 */ ?></td>
                                <td><?php echo LR\Filters::escapeHtmlText($user->last_updated) /* line 29 */ ?></td>
                            </tr>
<?php
			$iterations++;
		}
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php
	}

}
