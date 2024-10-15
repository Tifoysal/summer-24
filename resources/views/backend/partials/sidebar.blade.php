<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
      <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('dashboard')}}">
                <svg class="bi"><use xlink:href="#house-fill"/></svg>
                Dashboard
              </a>
            </li>
            <li class="nav-item">

              <a class="nav-link d-flex align-items-center gap-2" href="{{route('admin.orders')}}">
                <svg class="bi"><use xlink:href="#file-earmark"/></svg>
                Orders
              </a>

            </li>

            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{route('category.list')}}">
                <svg class="bi"><use xlink:href="#cart"/></svg>
                Category
              </a>
            </li>



            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{route('product.list')}}">
                <svg class="bi"><use xlink:href="#cart"/></svg>
                Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{route('customer.list')}}">
                <svg class="bi"><use xlink:href="#people"/></svg>
                Customers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{route('admin.report')}}">
                <svg class="bi"><use xlink:href="#graph-up"/></svg>
                Reports
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{route('admin.role')}}">
                <svg class="bi"><use xlink:href="#graph-up"/></svg>
                Role
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{route('admin.business.settings')}}">
                <svg class="bi"><use xlink:href="#graph-up"/></svg>
                Business Settings
              </a>
            </li>

          </ul>




          <hr class="my-3">

          <ul class="nav flex-column mb-auto">

            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{route('logout')}}">
                <svg class="bi"><use xlink:href="#door-closed"/></svg>
                Sign out
              </a>
            </li>


          </ul>
        </div>
      </div>
    </div>
