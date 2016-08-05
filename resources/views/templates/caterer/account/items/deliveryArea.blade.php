<h2>Add delivery area</h2>
<div ng-controller="CatererProfileController">
    <form href="#" method="post" class='form-horizontal' id="updateDeliveryArea">
        <label for="zip_codes" class="title fmlbold fz17">Zip Codes</label>

        <ui-select multiple ng-model="selectedZipCodes" class="selectpicker form-control"
                   id="zip_codes" name="zip_codes"
                   on-remove="removeZipFromSelect($item, $model)" on-select="addZipToSelect($item, $model)">
            <ui-select-match placeholder="Select zip codes"><% $item.name %></ui-select-match>
            <ui-select-choices repeat="zip in zip_codes track by zip.id">
                <% zip.name %>
            </ui-select-choices>
        </ui-select>
        <div class="save-btn">
            <input type="submit" class="fmlreg fz25" ng-click="addDeliveryArea()" value="Add"/>
        </div>
    </form>

    <h2>Delivery areas</h2>
    <table class="table table-bordered table-striped table-hover">
        <tbody>
        <tr ng-repeat="zip in filteredZips">
            <th><% (currentZipsPage-1)*numPerPageForZips+$index+1 %></th>
            <th ng-model="zip"><% zip.name %></th>
            <td>
                <button class="btn btn-danger btn-xs" title="Remove from delivery areas"
                        ng-click="removeDeliveryArea(zip.id)">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"/>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
    <ul uib-pagination ng-model="currentZipsPage"
        total-items="caterer_zips.length"
        max-size="zipsMaxSize"
        boundary-links="true"
        items-per-page="numPerPageForZips"
        ng-show="currentZipsPage">
    </ul>
</div>



