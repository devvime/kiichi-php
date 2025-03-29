<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create new user</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="create-user-form">
        <div class="modal-body">
          <input type="text" name="name" placeholder="Name..." class="form-control mb-3" required>
          <input type="email" name="email" placeholder="Email..." class="form-control mb-3" required>
          <input type="password" name="password" placeholder="Password..." class="form-control mb-3" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
          <div data-if="state.loading">
            <?php require $this->checkTemplate("components/dashboard/users/../../layout/loading/loading");?>

          </div>
        </div>
    </form>
    </div>
  </div>
</div>