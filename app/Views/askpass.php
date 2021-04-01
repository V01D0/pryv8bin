<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 from-wrapper">
	<?= form_open('getpass'); ?>
		<?= form_hidden('link', $link) ?>
		<div class="form-group">
			<label for="password">Password</label>
				<?= form_input('password', '', 'name="Password" id="password" class="form-control"', 'password') ?>
		</div>

		<div class="row">
			<div class="col-12 col-sm-4">
				<button id="submit" name="submit" value="Submit" type="submit" class="btn btn-primary">View paste</button>
			</div>
		</div>
	<?=form_close();?>
</div>