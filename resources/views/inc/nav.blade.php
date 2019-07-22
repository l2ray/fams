<nav class="navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand" href="#">LOGO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown"
      
    >
        <ul class="navbar-nav" style="float:left; margin-right:25%;">
            <li class="nav-item active">
                <a class="nav-link" href="/asset">Asset List <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/trackmovement/create">Asset Movement</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/depreciatedAssets">Depreciated Assets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/valuableAssets">Valuable Assets</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Configuration
                </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="/assetlocation">Asset's Location</a>
                <a class="dropdown-item" href="/assetcategory">Asset Category</a>
                <a class="dropdown-item" href="/instdepartment">Institution's Department</a>
                <a class="dropdown-item" href="/departmentunit">Department Unit</a>
            </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarSecurityMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Security
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarSecurityMenuLink">
                    <a class="dropdown-item" href="/user">Users</a>
                    <a class="dropdown-item" href="/login">Logout</a>
                    <a class="dropdown-item">Change Password</a>
                </div>

            </li>
        </ul>
       <div >
       <span>Welcome </span>{{Session::get("uName")}}
       </div>
        
       
    </div>
</nav>