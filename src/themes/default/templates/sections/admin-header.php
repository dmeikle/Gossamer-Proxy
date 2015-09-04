<header>
  <nav>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed primary" data-toggle="collapse"
        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/" class="navbar-brand">
        <img class="default-logo" src="/images/logo.png" alt="Logo">
      </a>
    </div>

    <div id="bs-example-navbar-collapse" class="collapse navbar-collapse">
      <ul class="navbar-left">
        <li><a href="/admin/dashboard" class="active">Home</a></li>
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown">Claims <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/admin/claims">Claims List</a></li>
            <li><a href="#">Your Claims</a></li>
            <li><a href="#">New Claim</a></li>
          </ul>
        </li>
        <li><a href="">Accounting</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Directory <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="">Clients</a></li>
            <li><a href="">Customers</a></li>
          </ul>
        </li>
        <li>
          <a href="/admin/staff">Staff</a>
        </li>
      </ul>

      <ul class="navbar-right">
        <li class="dropdown" id="context-button">
          <!---context-button--->
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img class="userimage" src="http://placehold.it/25x25" alt=""> User Name <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#">Profile</a></li>
            <li><a href="#">Your Tickets</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
