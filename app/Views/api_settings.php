<?= form_open('API', 'class="cbox"') ?>
	<h3>Get API key</h2>
	<?php
		if(!isset($key))
		{
			echo '<button class="btn btn-success" name="submit">Get API key</button>';
		}
	?>
	<br><br>

<div class="row form-group">
	<div class="col-sm-12">
		<div class="input-group input-group-lg">
		<?php
			if(isset($key))
			{
				echo '<input type="text" id="key" class="form-control" readonly value='."$key".'>';
				echo '<button type="button" onclick="copyKey()" class="btn btn-primary">Copy API key</button>'; 
			}
			else
				echo '<input type="text" class="form-control" readonly value="">';
		?>
		</div>
	</div>
</div>
<?= form_close() ?>
