<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("components/layout/nav/nav");?>


<section class="login">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 offset-lg-4 text-center mt-5">
        <h1 class="display-6" data-title></h1>
        <div class="card card-login">
          <form id="login-form" data-if="!state.register">
            <div class="card-body">
              <p>Default component</p>
              <input type="email" name="email" placeholder="Email..." class="form-control mb-3" required>
              <input type="password" name="password" placeholder="Password..." class="form-control mb-3" required>            
            </div>
            <div class="card-footer">
              <div class="d-flex">
                <div class="col">
                  <a href="#">Recover password</a>
                </div>
                <div class="col">
                  <button type="submit" class="btn btn-primary">Login</button>
                  <button type="button" class="btn btn-outline-primary" data-click="state.goToRegister()">Register</button>
                </div>
              </div>
            </div>
          </form>
          <form id="register-form" data-if="state.register">
            <div class="card-body">
              <p>Default component</p>
              <input type="text" name="name" placeholder="Name..." class="form-control mb-3" required>
              <input type="email" name="email" placeholder="Email..." class="form-control mb-3" required>
              <input type="password" name="password" placeholder="Password..." class="form-control mb-3" required>            
            </div>
            <div class="card-footer">
              <div class="d-flex">
                <div class="col">
                  <button type="button" class="btn btn-outline-primary" data-click="state.goToLogin()">Back</button>
                  <button type="submit" class="btn btn-primary" data-click="state.goToRegister()">Register</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>