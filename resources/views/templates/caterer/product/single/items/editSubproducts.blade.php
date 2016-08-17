<div ng-controller="EditProductController">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover mt20">
            <thead>
            <tr>
                <th>S.No</th>
                <th>Subroduct name</th>
                <th>Subroduct pice</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="subproduct in filteredSubproducts">
                <td><% (currentSubproductsPage-1)*numPerPageForSubproducts+$index+1  %></td>
                <td><% subproduct.name  %>  </td>
                <td><% subproduct.price %></td>
                <th>
                    <a hraf="#" class="btn btn-primary btn-xs" title="Edit Subproduct" ng-click="open('sm',subproduct.id)">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"/>
                    </a>
                   <a hraf="#" class="btn btn-danger btn-xs" ng-click="removeSubproduct(subproduct.id)">
                       <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Caterer" />
                   </a>
                </th>
            </tr>
            </tbody>
        </table>
    </div>
    <ul uib-pagination ng-model="currentSubproductsPage"
        total-items="product.subproducts.length"
        max-size="subproductsMaxSize"
        boundary-links="true"
        items-per-page="numPerPageForSubproducts"
        ng-show="currentSubproductsPage">
    </ul>
</div>

<div ng-include='"templates/caterer/product/single/modals/editSubproduct.blade.php"'></div>