<div ng-include='"templates/nav.blade.php"'></div>

<!-- Content -->
<section id="content">

	<div  class="hillfe-content caterer-content">
		<div class="container">

			<div class="row">

				<div class="col-md-10 col-md-offset-1">

					<div class="apero-carterer clearfix">

						<h2 class="clearfix">Ihr Warenkorb bei Spitzen-Apero Caterer
							<img src="../images/layer7.png" alt="">
						</h2>

						<div class="lieferdatum carterer-lieferdatum">
							<label>
								<span>Lieferdatum</span>
								<input type="text" id="datetimepicker4">
							</label>
						</div>

						<div class="carterer-product" ng-repeat="data in [1, 2, 3, 4]">
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
							<a ng-href="#/bestellen">Bestellen</a>
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