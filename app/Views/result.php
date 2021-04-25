<?php
if(isset($title))
	echo '<h3 class="paste__heading">'.esc($title).'</h3>';
?>
  <div class="row">
    <div class="col-sm">
		<span class="info">Author: <?= esc($author)?></span>
		<span class="info">Views: <?= esc($views) ?></span>
	</div>
  </div>

<div class="col-10" style="margin-bottom: 10%">
	<textarea class="form-control" name="paste_content" style="  color: white;
	height: 720px;
	background-color: rgb(51, 51, 51);
	resize: none;
	border-color: yellowgreen;"
	readonly><?= esc($paste) ?></textarea>
</div>