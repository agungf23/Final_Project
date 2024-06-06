 <!-- Sidebar Toggle-->
 <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
         class="fas fa-bars"></i></button>
 <!-- Navbar-->
 <ul class="navbar-nav ms-auto me-md-0 ms-3 ms-lg-4">
     <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
             aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
         <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
             <li><a class="dropdown-item" href="#!">Settings</a></li>
             <li><a class="dropdown-item" href="#!">Activity Log</a></li>
             <li>
                 <hr class="dropdown-divider" />
             </li>
             <form method="POST" action="{{ route('logout') }}">
                 @csrf
                 <li><button type="submit" class="dropdown-item" href="#!">Logout</button></li>
                 <x-responsive-nav-link :href="route('logout')"
                     onclick="event.preventDefault();
                               this.closest('form').submit();">
                     {{ __() }}
                 </x-responsive-nav-link>
             </form>
         </ul>
     </li>
 </ul>
