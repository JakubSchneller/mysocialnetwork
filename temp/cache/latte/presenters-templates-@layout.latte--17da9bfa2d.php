<?php
// source: /Applications/MAMP/htdocs/mysocialnetwork/mysocialnetwork/app/presenters/templates/@layout.latte

use Latte\Runtime as LR;

class Template17da9bfa2d extends Latte\Runtime\Template
{
	public $blocks = [
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html>
	<meta charset="utf-8">

	<title>Fórum</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 13 */ ?>/css/style.css">
	<link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 14 */ ?>/css/mojestyly.css">
	<link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 15 */ ?>/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 16 */ ?>/bootstrap/css/bootstrap-theme.css">


	<style>
		html {
			position: relative;
			min-height: 100%;
		}

		@import url(http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);
	</style>
<body>
<header>
<?php
		/* line 29 */
		$this->createTemplate("components/header.latte", $this->params, "include")->renderToContentType('html');
?>
</header>
<?php
		$iterations = 0;
		foreach ($flashes as $flash) {
			if ($flash->type == 'success') {
?>
		<div class="alert alert-success" role="alert">
            <?php echo LR\Filters::escapeHtmlText($flash->message) /* line 34 */ ?>

		</div>
<?php
			}
			elseif ($flash->type == 'danger') {
?>
		<div class="alert alert-danger" role="alert">
            <?php echo LR\Filters::escapeHtmlText($flash->message) /* line 38 */ ?>

		</div>
<?php
			}
			elseif ($flash->type == 'warning') {
?>
		<div class="alert alert-warning" role="alert">
            <?php echo LR\Filters::escapeHtmlText($flash->message) /* line 42 */ ?>

		</div>
<?php
			}
			else {
?>
		<div class="alert alert-secondary" role="alert">
            <?php echo LR\Filters::escapeHtmlText($flash->message) /* line 46 */ ?>

		</div>
<?php
			}
			$iterations++;
		}
		$this->renderBlock('content', $this->params, 'html');
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('scripts', get_defined_vars());
?>
</body>
</html><?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['flash'])) trigger_error('Variable $flash overwritten in foreach on line 31');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockScripts($_args)
	{
		extract($_args);
?>
	<script src="http://code.jquery.com/jquery-3.3.1.slim.js" integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA=" crossorigin="anonymous"></script>
	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 54 */ ?>/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 55 */ ?>/js/main.js"></script>
	<script src="https://nette.github.io/resources/js/netteForms.min.js"></script>
<?php
	}

}
