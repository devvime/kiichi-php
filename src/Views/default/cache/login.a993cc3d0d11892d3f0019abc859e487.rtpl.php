<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("components/layout/nav/nav");?>


<section class="login">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 offset-lg-4 text-center mt-5">
        <h1 class="display-6" data-title></h1>
        <div class="card card-login">
          <form id="login-form" data-if="!state.register && !state.recoverPass">
            <div class="card-body">
              <p>Default component</p>
              <input type="email" name="email" placeholder="Email..."
                class="form-control mb-3" required>
              <input type="password" name="password" placeholder="Password..."
                class="form-control mb-3" required>
            </div>
            <div class="card-footer">
              <div class="d-flex">
                <div class="col">
                  <button class="btn" type="button" data-click="state.goToRecover()">Recover password</button>
                </div>
                <div class="col">
                  <button type="submit" class="btn btn-primary">Login</button>
                  <button type="button" class="btn btn-outline-primary"
                    data-click="state.goToRegister()">Register</button>
                </div>
              </div>
            </div>
          </form>
          <?php require $this->checkTemplate("components/login/register/register");?>

          <?php require $this->checkTemplate("components/login/recover-password/recover");?>

          <div data-if="state.loading">
            <?php require $this->checkTemplate("components/layout/loading/loading");?>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>