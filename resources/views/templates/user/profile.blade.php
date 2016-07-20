<div ng-include='"templates/nav.blade.php"'></div>
<!-- Content -->
<ul>
    <form ng-submit="update()">
    <li><input type="text" ng-model="data.name" ng-value="data.name"></li>
    <li><input type="text" ng-model="data.title" ng-value="data.title"></li>
    <li><input type="text" ng-model="data.address" ng-value="data.address"></li>
    <li><input type="text" ng-model="data.pobox" ng-value="data.pobox"></li>
    <li><input type="text" ng-model="data.zip" ng-value="data.zip"></li>
    <li><input type="text" ng-model="data.city" ng-value="data.city"></li>
    <li><input type="text" ng-model="data.country" ng-value="data.country"></li>
    <li><input type="text" ng-model="data.phone" ng-value="data.phone"></li>
    <li><input type="text" ng-model="data.mobile" ng-value="data.mobile"></li>
    <li><input type="text" ng-model="data.fax" ng-value="data.fax"></li>
        <input type="submit" value="Save">
    </form>
</ul>
<!-- End Content -->
<div ng-include='"templates/footer.blade.php"'></div>