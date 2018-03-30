<?php
// source: /Applications/MAMP/htdocs/mysocialnetwork/mysocialnetwork/app/presenters/templates/Profile/changeimages.latte

use Latte\Runtime as LR;

class Templateeaeadc6f02 extends Latte\Runtime\Template
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
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6 col-lg-offset-3">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div align="center">
										<a class="" href="#">
										</a>
									</div>
								</div>
								<div class="col-md-12 text-left">
									<p>
<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["changeImagesForm"];
		?>									<form <?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		), false) ?>>
										<div class="form-group">
											<label class="control-label" for="inputDefault">Profilový obrázek:</label>
											<input class="form-control" placeholder="Vybrat obrázek" type="file"<?php
		$_input = end($this->global->formsStack)["image"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'placeholder' => NULL,
		'type' => NULL,
		))->attributes() ?>>
										</div>
										<div class="form-group">
											<label class="control-label" for="inputDefault">Úvodní obrázek:</label>
											<input class="form-control" placeholder="Vybrat obrázek" type="file"<?php
		$_input = end($this->global->formsStack)["header"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'placeholder' => NULL,
		'type' => NULL,
		))->attributes() ?>>
										</div>
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

}
