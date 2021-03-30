<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 from-wrapper">
            <div class="container">
                <h3>Login</h3>
                <hr>
                <?php if (session()->get('loggedin')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('loggedin') ?>
                    </div>
                <?php endif; ?>
                <div class="container box">
                <?= form_open('login') ?>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <?= form_input('email', '', 'id="email" class="form-control"', 'email') ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <?= form_input('password', '', 'id="password" class="form-control"', 'password') ?>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" onchange="viewPassword('password',this.id)" id="showPassword">
                            <label class="custom-control-label" for="showPassword">Show password</label>
                        </div>
                        <br>
                        <?php if (isset($validation)) : ?>
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors() ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <button value="Submit" name="submit" type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="col-12 col-sm-8 text-right">
                                <a href="/index/register">Don't have an account yet? Register now!</a>
                                <br>
                                <a href="/forgot">Forgot password?</a>
                            </div>
                        </div>
                    <?=form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>