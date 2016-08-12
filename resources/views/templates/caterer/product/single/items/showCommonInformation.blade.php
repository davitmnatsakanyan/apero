<h1> <% product.name %></h1>
<div class="table-responsive">
    <div class="cater-pic caterer-pic-width" ng-hide="$flow.files.length">
        <img class="ithumbnail"  src="images/products/<% product.avatar %>" , alt="Mountain View" />
    </div>
    <table class="table table-bordered table-striped table-hover">
        <tbody>
        <tr>
            <th>ID</th>
            <td><% product.id %></td>
        </tr>
        <tr>
            <th>Ingredients</th>
            <td><% product.ingredients %></td>
        </tr>
        <tr>
            <th>Kitchen</th>
            <td><% product.kitchen.name %></td>
        </tr>
        <tr>
            <th>Kitchen</th>
            <td><% product.menu.name %></td>
        </tr>
        <tr ng-if="!product.subproducts.length">
            <th>Price (EUR)</th>
            <td><% product.price %></td>
        </tr>
        </tbody>
    </table>
</div>