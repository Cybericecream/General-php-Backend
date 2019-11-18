    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dash.php">
        <div class="sidebar-brand-text mx-3">2019 Grad Show</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

        <?php
                $result = $db->query("SELECT * FROM 'admin-nav'");

                foreach($result as $row)
                {
                    echo '<!-- Nav Item -->';
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="'. $row['path'] .'">';
                    echo '<i class="fas '. $row['fa'] .'"></i>';
                    echo '<span>'. $row['title'] .'</span></a>';
                    echo '</li>';
                }
        ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->