<?php if(!class_exists('Rain\Tpl')){exit;}?><section class="dashboard">
  <div class="row g-0">
    <div class="col-md-2">
      <?php require $this->checkTemplate("components/dashboard/sidebar-menu/menu");?>

    </div>
    <div class="col-md-10 page">
      <div class="content-page">
        <h1 class="display-6" data-title></h1>
        <hr>
        <div id="dashboard-page"></div>
        <div data-if="state.loading">
          <?php require $this->checkTemplate("components/layout/loading/loading");?>

        </div>
      </div>
    </div>
  </div>
  <?php require $this->checkTemplate("components/dashboard/users/create/create");?>

</section>