<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 from-wrapper">
	<?= form_open('getpass'); ?>
	<?php if(isset($burn)):?>
		<div class="row">
			<div class="col-12">
				<div class="alert alert-danger" role="alert">
					<?= "🔥 Once the paste is accessed, you will not be able to view it again as it will be permanently removed."?>
				</div>
				<?php if(isset($burn) && !isset($link)):?>
					<button id="submit" name="burnit" value="<?=$burn?>" type="submit" class="btn btn-primary">View paste</button>
					<button id="submit" name="later" type="button" onclick="copyLink()" class="btn btn-primary">Copy paste link to clipboard</button>
				<?php endif;?>
			</div>
		</div>
	<?php endif; ?>
	<?php if(isset($link)):?>
		<?= form_hidden('link', $link) ?>
			<div class="form-group">
				<label for="password">Password</label>
					<?= form_input('password', '', 'name="Password" id="password" class="form-control"', 'password') ?>
			</div>
			<div class="row">
				<div class="col-12 col-sm-4">
					<button id="submit" name="submit" value="Submit" type="submit" class="btn btn-primary">View paste</button>
					<?php if(isset($burn)):?>
						<button id="submit" name="later" type="button" onclick="copyLink()" class="btn btn-primary">Copy paste link to clipboard</button>
					<?php endif; ?>
				</div>
			</div>
		<?=form_close();?>
	<?php endif; ?>
</div>