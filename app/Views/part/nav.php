<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid d-flex justify-content-between">
    <ul class="navbar-nav mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Create
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item d-flex align-items-center" href="<?= base_url('photos/create') ?>">Photos</a></li>
          <li><a class="dropdown-item d-flex align-items-center" href="<?= base_url('album/create') ?>">Album</a></li>
        </ul>
      </li>
      <?php if(session()->get('username')): ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          My Gallery
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item d-flex align-items-center" href="<?= base_url('photos/myphotos') ?>">My Photos</a></li>
          <li><a class="dropdown-item d-flex align-items-center" href="<?= base_url('album/') ?>">My Album</a></li>
        </ul>
      </li>
      <?php endif ?>
    </ul>
    <!-- <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form> -->
    <ul class="navbar-nav">
      <li class="nav-item dropdown border-start">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?= (session()->get('username')) ? session()->get('username') : 'Account' ?>
        </a>
        <ul class="dropdown-menu">
          <?php if (!session()->get('username')) : ?>
            <li><a class="dropdown-item d-flex align-items-center" href="<?= base_url('auth/login') ?>"><span class="iconoir-log-in"></span> Login</a></li>
            <li><a class="dropdown-item d-flex align-items-center" href="<?= base_url('auth/register') ?>"><span class="iconoir-user-plus"></span> Register</a></li>

          <?php else : ?>
            <li><a class="dropdown-item d-flex align-items-center" href="<?= base_url('auth/logout') ?>"><span class="iconoir-log-out"></span> Logout</a></li>

          <?php endif ?>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="#">Apps by ozn</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>