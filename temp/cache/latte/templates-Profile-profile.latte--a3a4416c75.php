<?php
// source: /Applications/MAMP/htdocs/mysocialnetwork/mysocialnetwork/app/presenters/templates/Profile/profile.latte

use Latte\Runtime as LR;

class Templatea3a4416c75 extends Latte\Runtime\Template
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
								<div id="cover" class="col-md-12">
									<div align="center">
										<a class="" href="#">
											<img class="media-object dp img-circle" src="../<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($users->image)) /* line 11 */ ?>" style="width: 180px;height:180px;">
										</a>
									</div>
								</div>
								<div class="col-md-12">
									<h2 align="center"><?php echo LR\Filters::escapeHtmlText($users->first_name) /* line 16 */ ?> <?php
		echo LR\Filters::escapeHtmlText($users->last_name) /* line 16 */ ?></h2>
									<div class="text-center">
<?php
		if ($user->isInRole('admin') || $user->isInRole('owner')) {
			?>										<a type="button" class="btn btn-success" style="margin: auto" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:editprofile", ['userId' => $users->user_id])) ?>">Editovat</a>
<?php
		}
		elseif ($loggedin->user_id == $users->user_id) {
			?>										<a type="button" class="btn btn-success" style="margin: auto" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:editprofile", ['userId' => $users->user_id])) ?>">Editovat</a>
<?php
		}
		if ($users->user_id == $user->getId()) {
		}
		else {
			if ($arewefriends == false) {
				?>											<a type="button" class="btn btn-success" style="margin: auto" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:addFriend", ['friendId' => $users->user_id])) ?>">Přidat přítele</a>
<?php
			}
			elseif ($arewefriends == true) {
				?>											<a onClick="return confirm('Opravdu odebrat přítele?');" type="button" class="btn btn-success" style="margin: auto" href="<?php
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Profile:deleteFriend", ['friendId' => $users->user_id])) ?>">Přátelé <span class="glyphicon glyphicon-ok"></span></a>
<?php
			}
		}
?>


									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="disabledInput">Křestní jméno:</label>
										<input class="form-control" id="disabledInput" placeholder="<?php echo LR\Filters::escapeHtmlAttr($users->first_name) /* line 38 */ ?>" disabled="" type="text">
									</div>

									<div class="form-group">
										<label class="control-label" for="disabledInput">Příjmení:</label>
										<input class="form-control" id="disabledInput" placeholder="<?php echo LR\Filters::escapeHtmlAttr($users->last_name) /* line 43 */ ?>" disabled="" type="text">
									</div>
									<div class="form-group">
										<label class="control-label" for="disabledInput">Datum registrace:</label>
										<input class="form-control" id="disabledInput" placeholder="<?php echo LR\Filters::escapeHtmlAttr($users->date_created) /* line 47 */ ?>" disabled="" type="text">
									</div>
									<div class="form-group">
										<label class="control-label" for="disabledInput">Email:</label>
										<input class="form-control" id="disabledInput" placeholder="<?php echo LR\Filters::escapeHtmlAttr($users->user_email) /* line 51 */ ?>" disabled="" type="text">
									</div>
									<div class="form-group">
										<label class="control-label" for="disabledInput">Přihlašovací jméno:</label>
										<input class="form-control" id="disabledInput" placeholder="<?php echo LR\Filters::escapeHtmlAttr($users->user_name) /* line 55 */ ?>" disabled="" type="text">
									</div>
									<div class="form-group">
										<label class="control-label" for="disabledInput">Role:</label>
										<input class="form-control" id="disabledInput" placeholder="<?php echo LR\Filters::escapeHtmlAttr($users->role) /* line 59 */ ?>" disabled="" type="text">
									</div>
									<div class="form-group">
										<label class="control-label" for="disabledInput">Počet přátel:</label>
										<input class="form-control" id="disabledInput" placeholder="<?php echo LR\Filters::escapeHtmlAttr($friendscount) /* line 63 */ ?>" disabled="" type="text">
									</div>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</div>
<?php
	}

}
