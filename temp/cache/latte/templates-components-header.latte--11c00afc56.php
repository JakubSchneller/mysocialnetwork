<?php
// source: /Applications/MAMP/htdocs/mysocialnetwork/mysocialnetwork/app/presenters/templates/components/header.latte

use Latte\Runtime as LR;

class Template11c00afc56 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<nav class="navbar navbar-inverse bs-dark">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Mysocialnetwork</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li ><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:default")) ?>">Příspěvky <span class="sr-only"></span></a></li>
				<li ><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Search:searchform")) ?>">Vyhledávání <span class="sr-only"></span></a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
<?php
		if ($user->isLoggedIn()) {
?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:profile")) ?>">
							Přihlášen jako: <?php echo LR\Filters::escapeHtmlText($loggedin->user_name) /* line 21 */ ?>

						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:profile", ['userId' => $loggedin->user_id])) ?>">Můj profil</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:out")) ?>"> Odhlášení</a></li>
						</ul>
					</li>

<?php
		}
		else {
			?>					<li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:up")) ?>"> Registrace</a></li>
					<li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:in")) ?>"> Přihlášení</a></li>
<?php
		}
?>
			</ul>
		</div>
	</nav>
<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}

}
