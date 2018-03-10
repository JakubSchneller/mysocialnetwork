<?php
// source: /Applications/MAMP/htdocs/mysocialnetwork/app/presenters/templates/Profile/editprofile.latte

use Latte\Runtime as LR;

class Template86fc5bcd76 extends Latte\Runtime\Template
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
		if ($userId == $users->user_id) {
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div align="center">
										<a class="" href="#">
											<img class="media-object dp img-circle" src="../<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($users->image)) /* line 18 */ ?>" style="width: 180px;height:180px;">
										</a>
									</div>
								</div>
								<div class="col-md-12 text-left">
									<h2 align="center"><?php echo LR\Filters::escapeHtmlText($users->first_name) /* line 23 */ ?> <?php
			echo LR\Filters::escapeHtmlText($users->last_name) /* line 23 */ ?></h2><br>
									<p>
<?php
			$form = $_form = $this->global->formsStack[] = $this->global->uiControl["editUserForm"];
			?>									<form <?php
			echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
			), false) ?>>
									<div class="form-group">
										<label class="control-label" for="inputDefault">Křestní jméno:</label>
										<input value="<?php echo LR\Filters::escapeHtmlAttr($users->first_name) /* line 28 */ ?>" class="form-control" id="InputDefault"  type="text"<?php
			$_input = end($this->global->formsStack)["firstname"];
			echo $_input->getControlPart()->addAttributes(array (
			'value' => NULL,
			'class' => NULL,
			'id' => NULL,
			'type' => NULL,
			))->attributes() ?>>
									</div>

									<div class="form-group">
										<label class="control-label" for="inputDefault">Příjmení:</label>
										<input value="<?php echo LR\Filters::escapeHtmlAttr($users->last_name) /* line 33 */ ?>"class="form-control" id="inputDefault"  type="text"<?php
			$_input = end($this->global->formsStack)["lastname"];
			echo $_input->getControlPart()->addAttributes(array (
			'value' => NULL,
			'class' => NULL,
			'id' => NULL,
			'type' => NULL,
			))->attributes() ?>>
									</div>
									<div class="form-group">
										<label class="control-label" for="inputDefault">Email:</label>
										<input value="<?php echo LR\Filters::escapeHtmlAttr($users->user_email) /* line 37 */ ?>" class="form-control" id="inputDefault" type="text"<?php
			$_input = end($this->global->formsStack)["email"];
			echo $_input->getControlPart()->addAttributes(array (
			'value' => NULL,
			'class' => NULL,
			'id' => NULL,
			'type' => NULL,
			))->attributes() ?>>
									</div>
									<div class="form-group">
										<label class="control-label" for="inputDefault">Přihlašovací jméno:</label>
										<input value="<?php echo LR\Filters::escapeHtmlAttr($users->user_name) /* line 41 */ ?>" class="form-control" id="inputDefault" type="text"<?php
			$_input = end($this->global->formsStack)["username"];
			echo $_input->getControlPart()->addAttributes(array (
			'value' => NULL,
			'class' => NULL,
			'id' => NULL,
			'type' => NULL,
			))->attributes() ?>>
									</div>
<?php
			if ($user->isInRole('admin') || $user->isInRole('owner')) {
?>
									<div class="form-group">
										<label class="control-label" for="inputDefault">Role:</label>
										<select class="form-control"<?php
				$_input = end($this->global->formsStack)["role"];
				echo $_input->getControlPart()->addAttributes(array (
				'class' => NULL,
				))->attributes() ?>>
<?php echo $_input->getControl()->getHtml() ?>										</select>
									</div>
<?php
			}
?>
									<div class="text-center">
									<button type="submit" class="btn btn-primary">Uložit</button>
									</div>
<?php
			echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>									</form>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
		}
?>
	</body>
</hmtl>
<?php
	}

}
