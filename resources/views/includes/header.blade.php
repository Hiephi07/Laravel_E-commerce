  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: ;">
              @csrf
              <button type="submit">Logout</button>
          </form>
          <script>
            function logout() {
                document.getElementById('logout-form').submit();
            }
        </script>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->