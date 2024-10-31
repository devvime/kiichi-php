<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("components/layout/nav/nav");?>


<section class="about">
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 text-center mt-5">
        <h1 class="display-6">Login page</h1>
        <div class="card">
          <form id="login-form">
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
                  <button type="button" class="btn btn-outline-primary">Register</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>