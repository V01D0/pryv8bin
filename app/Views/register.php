<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 from-wrapper">
            <div class="container">
                <h3>Register</h3>
                <hr>
                <?php if (session()->get('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('success') ?>
                    </div>
                <?php endif; ?>
                <?= form_open('register') ?>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <?= form_input('email', '', 'name="Email" id="email" class="form-control"', 'email') ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <?= form_input('password', '', 'name="Password" id="password" class="form-control"', 'password') ?>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" onchange="viewPassword('password',this.id)" id="showPassword">
                            <label class="custom-control-label" for="showPassword">Show password</label>
                        </div>
                        <br>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <!-- <input type="password" class="form-control" name="confirm-password" id="c-password" value=""> -->
                        <?= form_input('confirm-password', '', 'name="Confirm Password" id="confirm-password" class="form-control" oninput="matchPasswords()"', 'password') ?>
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
                            <button id="submit" name="submit" value="Submit" type="submit" class="btn btn-primary">Register</button>
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                            <a href="/index/login">Already have an account? Login!</a>
                            <br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>