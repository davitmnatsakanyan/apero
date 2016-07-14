<div class="modal-header">
    <h3 class="modal-title"><% product.name %></h3>
</div>
<div class="modal-body sub_prod_modal">
    <div class="row">
        <div class="col-md-7">
            <form>
                <div class="form-group">
                    <ul class="prod_list">
                        <li ng-repeat="item in items" >
                            <label ng-init="i.sub_id = item.id" ng-model="i.id" for="<% item.id %>"><% item.name %>
                                <input value="<% item.price %>" ng-model="i.price" class="pull-right" ng-checked="$first == true" type="radio" name="sub_product" id="<% item.id %>">
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="form-group notes">
                    <p>Your notes about order</p>
                    <textarea class="form-control " name="notes" ng-model="i.description"></textarea>
                </div>
            </form>
        </div>
        <div class="col-md-5">
            <ul class="rigth_items">
                <li>
                    <img class="img-responsive" src="/images/products/<% product.avatar %>">
                </li>
                <li>
                    <div class="count">Count: <strong><% product_count %></strong></div>
                </li>
                <li>
                    <div class="price">Price: &euro; <strong><% i.price %></strong></div>
                </li>
                <li>
                    <div class="total_price">Total price: &euro;
                        <strong> <% product_count * i.price %></strong>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-primary" type="button" ng-click="add()">Add to cart</button>
    <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
</div>