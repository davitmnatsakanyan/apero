<div ng-include='"templates/nav.blade.php"'></div>

<!-- Content -->
<section id="content">

	<div  class="hillfe-content caterer-content">
		<div class="container">

			<div class="row">

				<div class="col-md-10 col-md-offset-1">

					<div class="apero-carterer apero-bestellen clearfix">

						<h2 class="clearfix">Ihr Warenkorb bei Spitzen-Apero Caterer</h2>

						<div class="col-sm-7 no-padding border-right">

							<div class="lieferdatum carterer-lieferdatum">
								<span class="bestellen-etap">1</span>
								<label>
									<span>Apero-Bestelliste</span>
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
										<img ng-src="../images/products/<% product.avatar %>" alt="">
									</li>
									<li>
										<p>
											<% product.count %>x <% product.name %>
											<span class="bestellung-produkt-number-price">
												<i class="fa fa-times-circle btn" ng-click="removeFromCart($index, total_price, 'product')" aria-hidden="true"></i>
											</span>
											<span class="bestellung-produkt-number-price"><% product.price %> &euro;</span>
										</p>
									</li>
								</ul>
							</div>

							<div class="carterer-product" ng-repeat="package in packages track by $index">
								<ul>
									<li>
										<img ng-src="../images/products/<% package.avatar %>" alt="">
									</li>
									<li>
										<p>
											<% product.count %>x <% product.name %>
											<span class="bestellung-produkt-number-price">
												<i class="fa fa-times-circle btn" ng-click="removeFromCart($index, total_price, 'package')" aria-hidden="true"></i>
											</span>
											<span class="bestellung-produkt-number-price"><% package.price %> &euro;</span>
										</p>
									</li>
								</ul>
							</div>

							<div class="bestellung-produkts-total">
								Total <span ng-bind="total_price"></span>
							</div>

						</div>

						<div class="col-sm-5 no-padding">

							<div class="lieferdatum carterer-lieferdatum clearfix">
								<span class="bestellen-etap">2</span>
								<span>Ihre Adresse</span>
							</div>

							<div class="adresse-col">

								<form class="form-inline">
									<div class="form-group ">
										<label for="" class="order-page-label" class="order-page-label" class="pr8">Company</label>
										<input type="text"  class="form-control order-input"  placeholder="company" ng-model="company" required>
									</div>
									<div class="form-group order-block1 ">
										<label for="" class="order-page-label">Country</label>
										<span class="order-blade-select">
											<ui-select ng-model="country" class="selectpicker form-control order1" on-select = "selectCountry($select.selected, $model)">
												<ui-select-match placeholder="Select Country" class="order-blade-select1"><% $select.selected.name %></ui-select-match>
												<ui-select-choices repeat="country in countries track by country.id">
													<% country.name %>
												</ui-select-choices>
											</ui-select>
										</span>
									</div>
									<div class="form-group ">
										<label for="" class="order-page-label">City</label>
										<input type="text"  class="form-control order-input"  placeholder="city" ng-model="city" required>
									</div>
									<div class="form-group ">
										<label for="" class="order-page-label">address</label>
										<input type="text"  class="form-control order-input"  placeholder="address" ng-model="address" required>
									</div>
									<div class="form-group ">
										<label for="" class="order-page-label">PLZ</label>
										{{--<input type="text"  class="form-control"  placeholder="PLZ" ng-model="delivery_zip" required>--}}
										<ui-select ng-model="delivery_zip" class="selectpicker form-control order1" on-select = "selectZip($select.selected, $model)">
											<ui-select-match placeholder="Select zip codes" class="order-blade-select1"><% $select.selected.name %></ui-select-match>
											<ui-select-choices repeat="zip in zips track by zip.id">
												<% zip.name %>
											</ui-select-choices>
										</ui-select>
									</div>
									<div class="form-group ">
										<label for="" class="order-page-label">ort</label>
										<input type="text"  class="form-control order-input"  placeholder="ort" ng-model="home" required>
									</div>
									<div class="form-group ">
										<label for="" class="order-page-label">email</label>
										<input type="email"  class="form-control order-input"  placeholder="email" ng-model="email" required>
									</div>
									<div class="form-group ">
										<label for="" class="order-page-label">mobile</label>
										<input type="text"  class="form-control order-input"  placeholder="mobile" ng-model="mobile" required>
									</div>
									<div class="form-group last">
										<label for="" class="order-page-label">phone</label>
										<input type="text"  class="form-control order-input"  placeholder="phone" ng-model="phone" required>
									</div>

									<div ng-init="is_different = false" ng-show="is_different" class="form-group billing_address">
										<label for="" class="order-page-label">address</label>
										<input type="text"  class="form-control order-input"  placeholder="address" ng-model="billing_address" required>
									</div>


									<div class="loging">

										<label class="checkbox-inline"><input type="checkbox" value="" ng-model="other_address" ng-change="change()" >Liferadrese Entspricht Recjungsadresse  </label>

										<div class="loging-login" ng-show="$root.is_logedin == 0">
											<div ng-if="error_msg == 1" class="alert alert-danger"><button class="close" data-dismiss="alert"></button><% error_msg_text %></div>

											<p>Login fur bestehande Kunden </p>
											<div class="form-group">
												<label for="exampleInputName8">E-mail</label>
												<input type="email" class="form-control" id="exampleInputName8" ng-init="user.email = ''" ng-model="user.email">
											</div>

											<div class="form-group">
												<label for="exampleInputName9">Password</label>
												<input type="password" class="form-control" id="exampleInputName9" ng-init="user.password = ''" ng-model="user.password">
											</div>
											<div class="bestellung-bestellen">
												<a ng-click="submit_login()">Login</a>
											</div>
										</div>
										<div ng-model="$root.is_logedin"></div>
										<div ng-show="$root.is_logedin == 1">
											You are loged in
										</div>
									</div>

								</form>

							</div>

						</div>

					</div>

					<div class="einlosern">

						<h2><span class="bestellen-etap">3</span>Zahlung</h2>

						<div class="gutschein zahlung clearfix">

							<div class="col-sm-7 no-padding">

							  <form role="form">

								   <label class="radio">
									  <input type="radio" name="optradio" checked=""  ng-model="payment.name" value="stripe">
									  <img ng-src="../images/visa.png">
										<img ng-src="../images/master.png">
										<span>Kreditkarte(Stripe)</span>
									</label>


									 <label class="radio">
										<input type="radio" name="optradio"  ng-model="payment.name" value="paypal">
										<img ng-src="../images/paypal.png">

										<span>PayPal</span>
									</label>


									 <label class="radio">
										<input type="radio" name="optradio"  ng-model="payment.name" value="cash"  >
										<span>Barzahlung Bei Liferung</span>
									</label>
								</form>

								<div class="bestellen-etap-left">
									<ul>
										<li><img ng-src="../images/block.png"></li>
										<li>
											<p>
												Lorem Ipsum is simply dummy text of the printing and typesetting
												industry. Lorem Ipsum has been the industry's standard dummy
												text ever since the 1500s, when an unknown printer took a make
												a type specimen book.
											</p>
										</li>
									</ul>
								</div>
							</div>

							<div class="col-sm-5 no-padding">
								<div class="einlosern-bestellen">

									<div class="form-group">
									  <label for="comment">Bemerkungen</label>
									  <textarea class="" rows="4" id="comment" ng-model="comment"></textarea>
									</div>
									<label class="checkbox-inline"><input type="checkbox" ng-init="is_accepted = false" ng-model="is_accepted" >Ich Akzeptiere die  AGB</label>
									<div class="bestellen1">
									<a ng-click="submitOrder(payment)">Bestellen</a>
									</div>

								</div>
							</div>

						</div>

					</div>

				</div>

			</div>

		</div>
	</div>
	<div ng-include='"templates/stripe.blade.php"'></div>

</section>
<!-- End Content -->

<div ng-include='"templates/footer.blade.php"'></div>