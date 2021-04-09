<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 from-wrapper">
            <div class="container">
                <h3>Request password reset</h3>
                <hr>
                <?= form_open('forgot') ?>
						<div class="form-group">
                            <label for="email">Email address</label>
                            <?= form_input('email', '', 'id="email" class="form-control"', 'email') ?>
                        </div>
						<?php if (isset($validation)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
						<?php endif; ?>
						<div class="row">
							<div class="col-12 col-sm-4">
								<button id="submit" name="submit" value="Submit" type="submit" class="btn btn-primary">Request reset</button>
							</div>
                    	</div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</div>