<?php
// source: /Applications/MAMP/htdocs/mysocialnetwork/mysocialnetwork/app/presenters/templates/Search/searchform.latte

use Latte\Runtime as LR;

class Template9f95c9b0c6 extends Latte\Runtime\Template
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
    <div class="col-sm-8 col-sm-offset-2">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["search"];
		?>                <form class="input-group"<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		'class' => NULL,
		), false) ?>>
                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span id="search_concept">Filtrovat </span><span class="caret"></span>
                        </button>
                        <select class="dropdown-menu"<?php
		$_input = end($this->global->formsStack)["category"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>
<?php echo $_input->getControl()->getHtml() ?>                        </select>
                    </div>
                    <input type="text" class="form-control" placeholder="Vyhledávat..."<?php
		$_input = end($this->global->formsStack)["content"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		'placeholder' => NULL,
		))->attributes() ?>>
                    <span class="input-group-btn">
                    <button class="btn btn-default"<?php
		$_input = end($this->global->formsStack)["submit"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>><span class="glyphicon glyphicon-search"></span></button>
                </span>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>                </form>
            </div>
        </div>
    </div>
<?php
	}

}
