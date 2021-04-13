<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 from-wrapper">
            <div class="container">
                <h3>Reset password</h3>
                <hr>
                <?= form_open('reset') ?>
                    <?php if (isset($uid)) : ?>
                        <?=form_hidden('uid', $uid); ?>
                    <?php endif; ?>
                        <div class="form-group">
                            <label for="password">Current password</label>
                            <?= form_input('old-password', '', 'id="cur-password" class="form-control"', 'password') ?>
                        </div>
                        <div class="form-group">
                            <label for="password">New password</label>
                            <?= form_input('password', '', 'id="password" class="form-control"', 'password') ?>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" onchange="viewPassword('password',this.id)" id="showPassword">
                            <label class="custom-control-label" for="showPassword">Show password</label>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <!-- <input type="password" class="form-control" name="confirm-password" id="c-password" value=""> -->
                            <?= form_input('confirm-password', '', 'id="confirm-password" class="form-control" oninput="matchPasswords()"', 'password') ?>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" onchange="viewPassword('confirm-password', this.id)" id="showCPassword">
                                <label class="custom-control-label" for="showCPassword">Show confirm password</label>
                            </div>
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
                            <!-- <div class="col-12 col-sm-8 text-right">
                                <a href="/login">Already have an account? Login!</a>
                                <br>
                            </div> -->
                        </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</div>