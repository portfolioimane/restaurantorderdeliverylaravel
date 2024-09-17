<div id="sidebar" class="bg-dark text-white">
    <h2 class="text-center">Restaurant Driver</h2>
    <ul class="nav flex-column">
    
      
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('driver.orders.index') }}">My Orders</a>
        </li>

        <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    </li>
    </ul>
</div>
