<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- add "navbar-no-scroll" class to disable the scrolling of the sidebar menu -->
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<form class="sidebar-search" action="extra_search.html" method="POST">
						<div class="form-container">
							<div class="input-box">
								<a href="javascript:;" class="remove">
								</a>
								<input type="text" placeholder="Search..."/>
								<input type="button" class="submit" value=" "/>
							</div>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="start active ">
					<a href="{{ url('admin/dashboard') }}">
						<i class="fa fa-home"></i>
						<span class="title">
							Dashboard
						</span>
						<span class="selected">
						</span>
					</a>
				</li>
				<li>
					<a href="javascript:;">
						<i class="fa fa-shopping-cart"></i>
						<span class="title">
							Members
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="{{ url('admin/members/create') }}">
								<i class="fa fa-bullhorn"></i>
								New Member
							</a>
						</li>
						<li>
							<a href="{{ url('admin/members') }}">
								<i class="fa fa-shopping-cart"></i>
								All Members
							</a>
						</li>
						<li>
							<a href="{{ url('admin/caterers') }}">
								<i class="fa fa-shopping-cart"></i>
								Caterers
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;">
						<i class="fa fa-gift"></i>
						<span class="title">
							Product Managmnet
						</span>
						<span class="arrow">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Kitchen managment">
							<a href="{{ url('admin/kitchens') }}" target="_self">
								<span class="title">
									Kitchen
								</span>
							</a>
						</li>
						<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Menu managment">
							<a href="{{ url('admin/menus') }}" target="_self">
								<span class="title">
									Menu
								</span>
							</a>
						</li>
						<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Products managment">
							<a href="{{ url('admin/products') }}" target="_self">
								<span class="title">
									Products
								</span>
							</a>
						</li>
						<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Packages managment">
							<a href="{{ url('admin/packages') }}" target="_self">
								<span class="title">
									Packages
								</span>
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="{{url('admin/orders')}}">
						<i class="fa fa-shopping-cart"></i>
						<span class="title">
							Orders
						</span>
						<span class="arrow ">
						</span>
					</a>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>