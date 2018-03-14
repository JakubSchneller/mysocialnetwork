<?php
// source: /Applications/MAMP/htdocs/mysocialnetwork/mysocialnetwork/app/presenters/templates/Profile/profiletest.latte

use Latte\Runtime as LR;

class Templatef9924001e6 extends Latte\Runtime\Template
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
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card hovercard">
					<div class="cardheader">
					</div>
					<div class="avatar">
						<img alt="" src="../images/cover.jpg">
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="disabledInput">Křestní jméno:</label>
							<input class="form-control" id="disabledInput" placeholder="<?php echo LR\Filters::escapeHtmlAttr($users->first_name) /* line 14 */ ?>" disabled="" type="text">
						</div>

						<div class="form-group">
							<label class="control-label" for="disabledInput">Příjmení:</label>
							<input class="form-control" id="disabledInput" placeholder="<?php echo LR\Filters::escapeHtmlAttr($users->last_name) /* line 19 */ ?>" disabled="" type="text">
						</div>
						<div class="form-group">
							<label class="control-label" for="disabledInput">Datum registrace:</label>
							<input class="form-control" id="disabledInput" placeholder="<?php echo LR\Filters::escapeHtmlAttr($users->date_created) /* line 23 */ ?>" disabled="" type="text">
						</div>
						<div class="form-group">
							<label class="control-label" for="disabledInput">Email:</label>
							<input class="form-control" id="disabledInput" placeholder="<?php echo LR\Filters::escapeHtmlAttr($users->user_email) /* line 27 */ ?>" disabled="" type="text">
						</div>
						<div class="form-group">
							<label class="control-label" for="disabledInput">Přihlašovací jméno:</label>
							<input class="form-control" id="disabledInput" placeholder="<?php echo LR\Filters::escapeHtmlAttr($users->user_name) /* line 31 */ ?>" disabled="" type="text">
						</div>
						<div class="form-group">
							<label class="control-label" for="disabledInput">Role:</label>
							<input class="form-control" id="disabledInput" placeholder="<?php echo LR\Filters::escapeHtmlAttr($users->role) /* line 35 */ ?>" disabled="" type="text">
						</div>
						</p>
					</div>
				</div>

			</div>

		</div>
	</div>
<?php
	}

}
