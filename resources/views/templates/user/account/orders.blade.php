<div ng-include='"templates/nav.blade.php"'></div>

<!-- Content -->
<section id="content">
    <div  class="hillfe-content kategori-content">
        <div class="container">

            <div class="row">
                <ul>
                    <li ng-repeat="order in orders"><% order.delivery_address %></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- End Content -->

<div ng-include='"templates/footer.blade.php"'></div>