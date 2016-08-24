<div ng-include='"templates/nav.php"'></div>
<!-- Content -->
<section id="content">

	<!-- Section Filter -->
	<div class="section-filter">
		<div class="container">
			<div class="row">
				<div class="col-md-12 no-padding">
					<div class="col-md-8 col-md-offset-2 no-padding search-content">
						<form class="clearfix">
							<div class="col-sm-4">
								<div class="search">
									<input type="text" name="search" placeholder="PLZ  eingeben...">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="anlassgrosse">
									<select name="anlassgrosse">
										<option value="volvo">Anlassgrösse</option>
										<option value="saab">1-5</option>
										<option value="opel">6-10</option>
										<option value="audi">11-X</option>
									</select>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="lieferdatum">
									<input type='text' placeholder="Lieferdatum" id='datetimepicker4'>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="finden">
									<a ng-href="#/hillfe" class="btn">Apero-Anbieter finden</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Section Filter -->

	<!-- Section Home Content -->
	<div class="home-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Apero online bestellen</h1>
					<p>
						Lorem Ipsum is simply dummy text of the printing and typesetting industry.
						Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
						when an unknown printer took a galley of type and scrambled it to make a type
						specimen book. It has survived not only five centuries, but also the leap into
						electronic typesetting, remaining essentially unchanged , when an unknown printer
						took a galley of type and scrambled it to make a type  specimen book.
					</p>
				</div>
			</div>
		</div>
	</div>
	<!-- End Section Home Content -->

</section>
<!-- End Content -->
<div ng-include='"templates/footer.php"'></div>