<div ng-include='"templates/nav.blade.php"'></div>

<!-- Content -->
<section id="content">

	<div  class="hillfe-content caterer-content">
		<div class="container">

			<div class="row">

				<div class="col-md-10 col-md-offset-1">

					<div class="apero-carterer clearfix">

						<h2 class="clearfix">Ihr Warenkorb bei Spitzen-Apero Caterer
							<img ng-src="/images/<% caterer.avatar %>" alt="">
						</h2>

						<div class="lieferdatum carterer-lieferdatum">
							<label>
								<span>Lieferdatum</span>
								{{-- <input type="datetime" id="datetimepicker4" ng-model="" ng-change="setTime()">--}}
								<div class="dropdown">
									<a class="dropdown-toggle" id="dropdown2" role="button" data-toggle="dropdown" data-target="#" >
										<input type="text" class="form-control" data-ng-model="delivery_time">
									</a>
									<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
										<datetimepicker data-ng-model="delivery_time" data-datetimepicker-config="{ dropdownSelector: '#dropdown2' }"/>
									</ul>
								</div>
							</label>
						</div>

						<div class="carterer-product" ng-repeat="product in products track by $index">
							<ul>
								<li>
									<img ng-src="/images/products/<% product.avatar %>" alt="">
								</li>
								<li>
									<p>
										<% product.count %>x <% product.name %>
										<span class="bestellung-produkt-number-price" >
											<i class="fa fa-times-circle btn" aria-hidden="true"  ng-click="removeFromCart($index, total_price, 'product')"></i>
										</span>
										<span class="bestellung-produkt-number-price"><% product.price %> &euro;</span>
									</p>
								</li>
							</ul>
						</div>

						<div class="carterer-product" ng-repeat="package in packages track by $index">
							<ul>
								<li>
									<img ng-src="/images/packages/<% package.avatar %>" alt="">
								</li>
								<li>
									<p>
										<% package.count %>x <% package.name %>
										<span class="bestellung-produkt-number-price" >
											<i class="fa fa-times-circle btn" aria-hidden="true"  ng-click="removeFromCart($index, total_price, 'package')"></i>
										</span>
										<span class="bestellung-produkt-number-price"><% package.price %> &euro;</span>
									</p>
								</li>
							</ul>
						</div>


						<div class="bestellung-produkts-total">
							Total <span ng-bind="total_price"></span>
						</div>

						<div class="bestellung-bestellen">
							<a ng-href="#/order">Bestellen</a>
						</div>

					</div>

					<div class="einlosern">
						<h2>Gutschein einlosern</h2>
						<div class="gutschein clearfix">
							<input type="text">
							<div class="gutschein-einlosern">
								<a ng-href="#/">Gutschein einlosern</a>
							</div>
							<div class="einlosern-bestellen">
								<a ng-href="#/bestellen">Bestellen</a>
							</div>
						</div>
					</div>

				</div>

			</div>

		</div>
	</div>

</section>
<!-- End Content -->

<div ng-include='"templates/footer.blade.php"'></div>