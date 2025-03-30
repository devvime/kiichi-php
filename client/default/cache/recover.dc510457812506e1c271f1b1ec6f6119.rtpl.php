<?php if(!class_exists('Rain\Tpl')){exit;}?><form id="recover-form" data-if="state.recoverPass" style="display: none;">
  <div class="card-body">
    <p>Default component</p>
    <input type="email" name="email" placeholder="Email..." class="form-control mb-3" required>         
  </div>
  <div class="card-footer">
    <div class="d-flex">
      <div class="col">
        <button type="button" class="btn btn-outline-primary" data-click="state.goToLogin">Back</button>
        <button type="submit" class="btn btn-primary">Recover password</button>
      </div>
    </div>
  </div>
</form>