<div ng-controller="CatererProfileController">
    <table class="table table-bordered table-striped table-hover cooking-time">
        <tbody>
        <tr>
            <th>Persons count</th>
            <th>Time(Minute)</th>
            <th> Action </th>
        </tr>
        <tr>
            <td> Anlassgrosse </td>
            <td> <% cooking_time.group1 %></td>
            <td>
                <button class="btn btn-primary btn-xs" title="Edit" ng-click="open('sm','group1', cooking_time.group1)">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"/>
                </button>
            </td>
        </tr>
        <tr>
            <td> 1-5 </td>
            <td> <% cooking_time.group2 %></td>
            <td>
                <button class="btn btn-primary btn-xs" title="Edit" ng-click="open('sm','group2', cooking_time.group2)">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"/>
                </button>
            </td>
        </tr>
        <tr>
            <td> 6-10 </td>
            <td> <% cooking_time.group3 %></td>
            <td>
                <button class="btn btn-primary btn-xs" title="Edit" ng-click="open('sm','group3', cooking_time.group3)">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"/>
                </button>
            </td>
        </tr>
        <tr>
            <td> 11-x </td>
            <td> <% cooking_time.group4 %></td>
            <td>
                <button class="btn btn-primary btn-xs" title="Edit" ng-click="open('sm','group4', cooking_time.group4)">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"/>
                </button>
            </td>
        </tr>
        </tbody>
    </table>

</div>

<div ng-include='"templates/caterer/account/modals/cooking_time.blade.php"'></div>