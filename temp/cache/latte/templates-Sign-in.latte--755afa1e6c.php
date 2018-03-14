<?php
// source: /Applications/MAMP/htdocs/mysocialnetwork/mysocialnetwork/app/presenters/templates/Sign/in.latte

use Latte\Runtime as LR;

class Template755afa1e6c extends Latte\Runtime\Template
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
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Přihlásit se</h3>
                </div>
                <div class="panel-body">
<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["login"];
		?>                    <form role="form"<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		'role' => NULL,
		), false) ?>>
                        <fieldset>
                            <div class="form-group"  >
                                <input class="form-control" placeholder="Přihlašovací jméno" autofocus<?php
		$_input = end($this->global->formsStack)["username"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'placeholder' => NULL,
		'autofocus' => NULL,
		))->attributes() ?>>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Heslo"<?php
		$_input = end($this->global->formsStack)["password"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'placeholder' => NULL,
		))->attributes() ?>>
                            </div>


                            <input class="btn btn-lg btn-success btn-block" value="Přihlásit se"<?php
		$_input = end($this->global->formsStack)["login"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'value' => NULL,
		))->attributes() ?>>
                        </fieldset>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	}

}
