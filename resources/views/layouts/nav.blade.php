<nav class="navbar is-primary is-fixed-top" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="/">
     KAUNG SAN
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true">d</span>
      <span aria-hidden="true">d</span>
      <span aria-hidden="true">d</span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
        <div class="dropdown">
          <div class="dropdown is-hoverable">
            <div class="dropdown-trigger">
              <button class="button is-warning" aria-haspopup="true" aria-controls="dropdown-menu4">
              <span>Logged in as {{ Auth::user()->username }}</span>
                <span class="icon is-small">
                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                </span>
              </button>
            </div>
            <div class="dropdown-menu" id="dropdown-menu4" role="menu">
              <div class="dropdown-content">
                <div class="dropdown-item">
                  <a href="{{ route('register') }}">
                    Register new user
                  </a>
                </div>
                <div class="dropdown-item">
                  <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Logout
                 </a>                
                </div>
              </div>
            </div>
          </div>
    
            
          
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf 
        </form>
        </div>
      </div>
    </div>
  </div>
</nav>
