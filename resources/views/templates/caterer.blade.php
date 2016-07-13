<div ng-include='"templates/nav.blade.php"'></div>

	<!-- Content -->
	<section id="content">
			
		<div  class="hillfe-content kategori-content">
			<div class="container">

				<div class="row">

					<div class="col-md-9 col-sm-8">

						<div class="apero-anbieter clearfix">

							<h1>Apero - Anbieter in 9000 St. Gallin</h1>

							<div class="col-md-12 anbieter-item">
								<div class="col-md-6">
									<div class="anbieter-img">
										<img src="../images/caterers/<% caterer.avatar %>" alt="">
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

							<div class="col-md-12 anbieter-kat-item" ng-repeat="menu in menus">

								<div class="col-md-12">
									<div class="kategori-name">
										<% menu.name %>
									</div>
								</div>
								<div class="col-md-5">
									<div class="anbieter-img">
										<img src="../images/menus/<% menu.avatar  %>" alt="">
									</div>
								</div>
								<div class="col-md-7">

									<div class="kategori-item">
										<form name="myForm" >
										  <label ng-repeat="product in menu.products track by $index">
										  	<span><% product.name %></span>
										    <input type="number" ng-model="product_count" name="input"  min="0" max="99" required>
										    <i class="fa fa-shopping-cart btn" ng-init="product_count = 0" ng-disabled="product_count == 0" ng-click="addToCart(product, product_count)" aria-hidden="true"></i>
										  </label>
										 </form>
									</div>

								</div>
								
							</div>

						</div>

					</div>

					<div class="col-md-3 col-sm-4">
						<div class="filter bestellung">
							<h2>Bestellung</h2>
							<div class="filter-content">
								<form action="" class="clearfix">

									<h4>Lieferdatium</h4>
									<div class="lieferdatum">
										<input type="text" id="datetimepicker4">
									</div>

									<div class="bestellung-produkt-number" ng-repeat="order in $root.orders track by $index">
										<p><% order.count %>x <% order.name %> <span class="bestellung-produkt-number-price"><% order.price %></span></p>
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

<div ng-include='"templates/footer.blade.php"'></div>
