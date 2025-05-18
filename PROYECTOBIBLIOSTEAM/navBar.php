<nav class="navbar">
  <div class="navbar-container">
    <div class="navbar-logo">
      <a href="/PROYECTOBIBLIOSTEAM/">LevelUP Shelf</a>
    </div>

    <ul class="navbar-menu">
      <li class="navbar-item">
        <a href="/PROYECTOBIBLIOSTEAM/games" class="navbar-link">Catalog</a>
      </li>

      <?php

      if (isset($_SESSION["user"])) {
        if ($_SESSION['user']['name'] === 'admin'){
          echo '<li class="navbar-item">
        <a href="/PROYECTOBIBLIOSTEAM/admin" class="navbar-link">Admin</a>
      </li>';
        }

        echo ' 
      <li class="navbar-item">
      <a href="/PROYECTOBIBLIOSTEAM/account" class="navbar-link">My Account</a>
    </li>
    <li class="navbar-item">
      <a href="/PROYECTOBIBLIOSTEAM/library" class="navbar-link">My Libraries</a>
    </li>
    <li class="navbar-item">
      <a href="/PROYECTOBIBLIOSTEAM/create-library" class="navbar-link">Create libraries</a>
    </li>
        <li class="navbar-item">
      <a href="/PROYECTOBIBLIOSTEAM/steam" class="navbar-link">Steam</a>
    </li>
    <li class="navbar-item">
      <a href="/PROYECTOBIBLIOSTEAM/logout" class="navbar-link logout-link">Log Out</a>
    </li>
    
    ';
      } else {
        echo ' <li class="navbar-item">
          <a href="/PROYECTOBIBLIOSTEAM/login" class="navbar-link">Login/Register</a>
        </li>';
      }
      ?>
    </ul>
  </div>
</nav>