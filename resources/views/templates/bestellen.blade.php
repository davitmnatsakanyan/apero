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
									<input type="text" id="datetimepicker4">
								</label>
							</div>

							<div class="carterer-product" ng-repeat="data in [1,2,3,4]">
								<ul>
									<li>
										<img src="../images/layer7.png" alt="">
									</li>
									<li>
										<p>
											2x Produkt 1
											<span class="bestellung-produkt-number-price">
												<i class="fa fa-times-circle btn" aria-hidden="true"></i>
											</span>
											<span class="bestellung-produkt-number-price">10.50</span>
										</p>
									</li>
								</ul>
							</div>

							<div class="bestellung-produkts-total">
								Total <span>21.70</span>
							</div>

							<div class="bestellung-bestellen">
								<a ng-href="#/">Bestellen</a>
							</div>

						</div>

						<div class="col-sm-5 no-padding">

							<div class="lieferdatum carterer-lieferdatum clearfix">
								<span class="bestellen-etap">2</span>
								<span>Ihre Adresse</span>
							</div>

							<div class="adresse-col">

								<form class="form-inline">

									<input-text class="form-group" label="{{data.label}}" placeholder="{{data.placeholder}}" type="{{data.type}}" ng-repeat="data in datas"></input-text>

									<div class="loging">

										<label class="checkbox-inline"><input type="checkbox" value="">Liferadrese Entspricht Recjungsadresse  </label>

										<div class="loging-login">
											<p>Login fur bestehande Kunden </p>
											<div class="form-group">
												<label for="exampleInputName8">E-mail</label>
												<input type="email" class="form-control" id="exampleInputName8">
											</div>

											<div class="form-group">
												<label for="exampleInputName9">Password</label>
												<input type="password" class="form-control" id="exampleInputName9">
											</div>
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
									  <input type="radio" name="optradio" checked="">
									  <img src="../images/visa.png">
										<img src="../images/master.png">
										<span>Kreditkarte(Stripe)</span>
									</label>


									 <label class="radio">
										<input type="radio" name="optradio">
										<img src="../images/paypal.png">

										<span>PayPal</span>
									</label>


									 <label class="radio">
										<input type="radio" name="optradio">
										<span>Barzahlung Bei Liferung</span>
									</label>
								</form>

								<div class="bestellen-etap-left">
									<ul>
										<li><img src="../images/block.png"></li>
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
									  <textarea class="" rows="4" id="comment"></textarea>
									</div>
									<label class="checkbox-inline"><input type="checkbox" value="">Ich Akzeptiere die  AGB</label>
									<a ng-href="#/">Bestellen</a>
								</div>
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