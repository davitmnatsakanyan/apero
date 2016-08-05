<div ng-controller="CatererProfileController">
    <table class="table table-bordered table-striped table-hover">
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
                <p><a href class="btn btn-default btn-lg " ng-click="showEditCookingTime('group1', cooking_time.group1)">Edit</a></p>
            </td>
        </tr>
        <tr>
            <td> 1-5 </td>
            <td> <% cooking_time.group2 %></td>
            <td>
                <p><a href class="btn btn-default btn-lg " ng-click="showEditCookingTime('group2', cooking_time.group2)">Edit</a></p>
            </td>
        </tr>
        <tr>
            <td> 6-10 </td>
            <td> <% cooking_time.group3 %></td>
            <td>
                <p><a href class="btn btn-default btn-lg " ng-click="showEditCookingTime('group3', cooking_time.group3)">Edit</a></p>
            </td>
        </tr>
        <tr>
            <td> 11-x </td>
            <td> <% cooking_time.group4 %></td>
            <td>
                <p><a href class="btn btn-default btn-lg " ng-click="showEditCookingTime('group4', cooking_time.group4)">Edit</a></p>
            </td>
        </tr>
        </tbody>
    </table>
</div>
