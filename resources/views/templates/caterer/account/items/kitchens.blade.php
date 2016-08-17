<h2>Add kitchen</h2>
<% addingKitchens %>
<div ng-controller="CatererProfileController">
    <form href="#" method="post" class='form-horizontal' id="updateKitchens">
        <label for="kitchens" class="title fmlbold fz17">Kitchens</label>
        <ui-select searchEnabled="false" multiple ng-model="selectedKitchens.selected" class="selectpicker form-control" on-remove="removeKitchenFromSelect($item, $model)" on-select="addKitchenToSelect($item, $model)">
            <ui-select-match placeholder="Select Kitchen">
                <% $item.name %>
            </ui-select-match>

            <ui-select-choices repeat="kitchen in addingKitchens track by kitchen.id">
                <% kitchen.name %>
            </ui-select-choices>
        </ui-select>
        <div class="kitchen-add">
        <div class="save-btn">
            <input type="submit" class="fmlreg fz25" ng-click="addKitchens()" value="Add"/>
        </div>
            </div>
    </form>

    <h2>Kitchens</h2>
    <table class="table table-bordered table-striped table-hover">
        <tbody>
        <tr ng-repeat="kitchen in filteredKitchens">
            <th class="kitchens-number"><% (currentKitchensPage-1)*numPerPageForKitchens+$index+1 %></th>
            <th ng-model="kitchen"><% kitchen.name %></th>
            <td class="kitchens-td">
                <button class="btn btn-danger btn-xs" title="Remove from kitchens"
                        ng-click="removeKitchen(kitchen.id)">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"/>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
    <ul uib-pagination ng-model="currentKitchensPage"
        total-items="kitchens.length"
        max-size="kitchensMaxSize"
        boundary-links="true"
        items-per-page="numPerPageForKitchens"
        ng-show="currentKitchensPage">
    </ul>
</div>



