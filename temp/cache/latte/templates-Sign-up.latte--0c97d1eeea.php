<?php
// source: /Applications/MAMP/htdocs/mysocialnetwork/mysocialnetwork/app/presenters/templates/Sign/up.latte

use Latte\Runtime as LR;

class Template0c97d1eeea extends Latte\Runtime\Template
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
                    <h3 class="panel-title">Registrace</h3>
                </div>
                <div class="panel-body">
<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["registration"];
		?>                    <form role="form" enctype="multipart/form-data"<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		'role' => NULL,
		'enctype' => NULL,
		), false) ?>>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Křestní jméno" type="text"<?php
		$_input = end($this->global->formsStack)["surname"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'placeholder' => NULL,
		'type' => NULL,
		))->attributes() ?>>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Příjmení" type="text"<?php
		$_input = end($this->global->formsStack)["lastname"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'placeholder' => NULL,
		'type' => NULL,
		))->attributes() ?>>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Přihlašovací jméno" type="text"<?php
		$_input = end($this->global->formsStack)["username"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'placeholder' => NULL,
		'type' => NULL,
		))->attributes() ?>>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" type="e-mail"<?php
		$_input = end($this->global->formsStack)["email"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'placeholder' => NULL,
		'type' => NULL,
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
                            <div class="form-group">
                                <input class="form-control" placeholder="Potvrdit heslo" type="password"<?php
		$_input = end($this->global->formsStack)["passwordconfirm"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'placeholder' => NULL,
		'type' => NULL,
		))->attributes() ?>>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Něco málo o mě" type="text"<?php
		$_input = end($this->global->formsStack)["aboutme"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'placeholder' => NULL,
		'type' => NULL,
		))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></textarea>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Vybrat obrázek" type="file"<?php
		$_input = end($this->global->formsStack)["image"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'placeholder' => NULL,
		'type' => NULL,
		))->attributes() ?>>
                            </div>


                            <input class="btn btn-lg btn-success btn-block" value="Registrovat"<?php
		$_input = end($this->global->formsStack)["submit"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'value' => NULL,
		))->attributes() ?>>

                        </fieldset>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>                    </form>
                    <div align="center">
                        <br><b>Už jste zaregistrován/na?</b> <br></b><a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:in")) ?>">Přihlásit se</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php
	}

}
