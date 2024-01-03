		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{asset('admin')}}/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Admin</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
                <li>
					<a href="widgets.html">
						<div class="parent-icon"><i class='bx bx-cookie'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>

                <li class="menu-label">Category Manage</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Category</div>
					</a>
					<ul>
						<li> <a href="{{route('admin.all.category')}}"><i class="bx bx-right-arrow-alt"></i>All Category</a>
						<li> <a href="{{route('admin.add.category')}}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>

						</li>
					</ul>
				</li>

				<li class="menu-label">Product Manage</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Products</div>
					</a>
					<ul>
                        <li> <a href="{{route('admin.add.product')}}"><i class="bx bx-right-arrow-alt"></i>Add Products</a>
                        </li>
						<li> <a href="{{route('admin.all.product')}}"><i class="bx bx-right-arrow-alt"></i>All Products</a>
						</li>
					</ul>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
