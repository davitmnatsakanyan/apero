@include('templates/nav')
	<!-- Content -->
	<section id="content">
		<div  class="hillfe-content kategori-content">
			<div class="container" ng-init = 'getDetails()'>
				<div class="row">
					<div class="col-md-9 col-sm-8">
						<div class="apero-anbieter clearfix">
							<h1>Apero - Anbieter in 9000 St. Gallin</h1>
							<div class="col-md-12 anbieter-item">
								<div class="col-md-6">
									<div class="anbieter-img">
										<img ng-src="../images/caterers/<% caterer.avatar %>" alt="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="anbieter-adres">
										<div class="anbiter-name">
											<% caterer.company %> - Apero Caterer
										</div>
										<div class="anbiter-place">
											Bahnhofstrasse 18, 9000 St. Gallen
										</div>
									</div>
									<div class="ratings">
										<fieldset class="rating">
											<input type="radio" id="star-1-5" name="rating" value="5">
											<label class="full" for="star-1-5" title="Awesome - 5 stars"></label>
											<input type="radio" id="star-1-4half" name="rating" value="4 and a half">
											<input type="radio" id="star-1-4" name="rating" value="4">
											<label class="full" for="star-1-4" title="Pretty good - 4 stars"></label>
											<input type="radio" id="star-1-3half" name="rating" value="3 and a half">
											<input type="radio" id="star-1-3" name="rating" value="3">
											<label class="full" for="star-1-3" title="Meh - 3 stars"></label>
											<input type="radio" id="star-1-2half" name="rating" value="2 and a half">
											<input type="radio" id="star-1-2" name="rating" value="2">
											<label class="full" for="star-1-2" title="Kinda bad - 2 stars"></label>
											<input type="radio" id="star-1-1half" name="rating" value="1 and a half">
											<input type="radio" id="star-1-1" name="rating" value="1">
											<label class="full" for="star-1-1" title="Sucks big time - 1 star"></label>
											<input type="radio" id="starha-1-lf" name="rating" value="half">
										</fieldset>
			                        </div>
			                        <div class="anbieter-filter">
				                        <div class="" data-toggle="buttons-checkbox"> 
									        <button class="btn" type="submit"><i class="fa fa-user-times" aria-hidden="true"></i>1-5</button>
									        <button class="btn" type="submit"><i class="fa fa-user-times" aria-hidden="true"></i>6-10</button>
									        <button class="btn" type="submit"><i class="fa fa-user-times" aria-hidden="true"></i>11-X</button>
									        <a href="#">Bestellen</a>
									    </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-9 col-sm-8">
						<div class="apero-kat clearfix">
							<div class="package-tab">
							<uib-tabset active="activeForm" id="caterer_page">
								<uib-tab index="0" heading="Products" class="w50">
									<div class="mt20">
									<div class="col-md-12 anbieter-kat-item" ng-repeat="menu in menus">
										<div class="col-md-12">
											<div class="kategori-name">
												<% menu.name %>
											</div>
										</div>
										<div class="col-md-5">
											<div class="anbieter-img">
												<img ng-src="../images/menus/<% menu.avatar  %>" alt="">
											</div>
										</div>
										<div class="col-md-7">
											<div class="kategori-item">
												<form name="myForm" >
												  <label ng-repeat="product in menu.products track by $index">
													<span ><a id="product_name" ng-click="show_modal(product, product_count)"><% product.name %></a>
														<div ng-if="!product.subproducts.length" class="fr">CHF <% product.price %></div></span>
													  <input type="number" ng-model="product_count" name="input"  min="0" max="99" required>
													<i class="fa fa-shopping-cart btn" ng-init="product_count = 0" ng-disabled="product_count == 0" ng-click="addToCart(product, product_count, 'product')" aria-hidden="true"></i>
												  </label>
												 </form>
											</div>
										</div>
									</div>
									</div>
								</uib-tab>
								<uib-tab index="1" heading="Packages" class="w50">
									<div class="mt20">
									<div class="col-md-12 anbieter-kat-item" ng-repeat="package in packages">
										<div class="col-md-12">
											<div class="kategori-name">
												<% package.name %>
											</div>
										</div>
										<div class="col-md-5">
											<div class="anbieter-img">
												<img ng-src="/images/packages/<% package.avatar  %>" alt="">
											</div>
										</div>
										<div class="col-md-7">
											<div class="kategori-item">
												<form name="myForm" >
													<label ng-repeat="product in package.products track by $index">
														<span ><% product.name %> </span><% product.pivot.product_count %>
													</label>
												</form>
											</div>

										</div>
										<div class="row">
											<div class="pull-right add_cart ">
												<input type="number" ng-model="package_count" name="input"  min="0" max="99" required>
												<i class="fa fa-shopping-cart btn" ng-init="package_count = 0" ng-disabled="package_count == 0" ng-click="addToCart(package, package_count, 'package')" aria-hidden="true"></i>
											</div>
											</div>
									</div>
										</div>
								</uib-tab>
							</uib-tabset>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-4">
						<div class="filter bestellung">
							<h2>Bestellung</h2>
							<div class="filter-content">
								<form action="" class="clearfix">

									<h4>Lieferdatum</h4>
									<div class="lieferdatum">
										{{--<input type="text" id="datetimepicker4">--}}
										<div class="dropdown">
											<a class="dropdown-toggle" id="dropdown2"  role="button" data-toggle="dropdown" data-target="#" >
												<input type="text" class="form-control" data-ng-model="delivery_time">
											</a>
											<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
												<datetimepicker data-ng-model="delivery_time" data-datetimepicker-config="{ dropdownSelector: '#dropdown2' }"/>
											</ul>
										</div>
									</div>
									<div class="product-text">
									<p>Products</p>
									</div>
									<div class="bestellung-produkt-number" ng-repeat="product in $root.products track by $index">
										<p><% product.count %>x <% product.name %> <span class="bestellung-produkt-number-price"><% product.price %></span></p>
									</div>
									<div class="product-text package-text">
									<p>Packages</p>
										</div>
									<div class="bestellung-produkt-number" ng-repeat="package in $root.packages track by $index">
										<p><% package.count %>x <% package.name %> <span class="bestellung-produkt-number-price"><% package.price %></span></p>
									</div>

									<div class="bestellung-produkts-total">
										Total <span><% $root.total_price %></span>
									</div>
									<div class="bestellung-bestellen">
										<a ng-href="/#/cart">Bestellen</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Content -->
@include('templates/footer')
