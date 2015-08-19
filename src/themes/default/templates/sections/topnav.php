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
        <img class="default-logo" src="/images/logo.png" height="44" alt="Logo">
        <img class="small-logo" src="/images/theme/logo-small.png" width="48" height="44" alt="Logo">
    </a>
  </div>

  <div id="bs-example-navbar-collapse" class="collapse navbar-collapse">
    <ul class="navbar-left">
      <li><a href="#" class="active">Home</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Claims <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Open Claims</a></li>
          <li><a href="#">Your Claims</a></li>
          <li><a href="#">New Claim</a></li>
        </ul>
      </li>
      <li><a href="">Accounting</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Directory <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/admin/staff">Staff</a></li>
          <li><a href="">Clients</a></li>
          <li><a href="">Customers</a></li>
        </ul>
      </li>
    </ul>

    <ul class="navbar-right">
      <li class="dropdown">
        <div class="btn-group">
          <button type="button" class="primary">New &lt;type&gt; Ticket</button>
          <button type="button" class="primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="#">New Type1 Ticket</a></li>
            <li><a href="#">New Type2 Ticket</a></li>
            <li><a href="#">New Type3 Ticket</a></li>
          </ul>
        </div>
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
