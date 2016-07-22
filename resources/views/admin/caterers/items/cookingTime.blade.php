<div style="width: 400px">
    <table class="table table-bordered table-striped table-hover">
        <tbody>
        <tr>
            <th>Persons count</th>
            <th>Time(Minute)</th>
            <th> Action </th>
        </tr>
        <tr>
            <td> Anlassgrosse </td>
            <td> {{ $caterer->cookingtime->group1 }}</td>
            <td>
                <a
                        class="btn btn-primary btn-xs edit_cooking_time"
                        data-group="group1"
                        data-time="{{  $caterer->cookingtime->group1 }}"
                        data-toggle="modal"
                        data-target="#edit_cooking_time"
                        href="#edit_cooking_time">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Edit Cooking Time" />
                </a>
            </td>
        </tr>
        <tr>
                <td> 1-5 </td>
                <td> {{ $caterer->cookingtime->group2 }}</td>
                <td>
                    <a
                            class="btn btn-primary btn-xs edit_cooking_time"
                            data-group="group2"
                            data-time="{{  $caterer->cookingtime->group2 }}"
                            data-toggle="modal"
                            data-target="#edit_cooking_time"
                            href="#edit_cooking_time">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Edit Cooking Time" />
                    </a>
                </td>
            </tr>
            <tr>
                <td> 6-10 </td>
                <td> {{ $caterer->cookingtime->group3 }}</td>
                <td>
                    <a
                            class="btn btn-primary btn-xs edit_cooking_time"
                            data-group="group3"
                            data-time="{{  $caterer->cookingtime->group3 }}"
                            data-toggle="modal"
                            data-target="#edit_cooking_time"
                            href="#edit_cooking_time">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Edit Cooking Time" />
                    </a>
                </td>
            </tr>
            <tr>
                <td> 11-x </td>
                <td> {{ $caterer->cookingtime->group4 }}</td>
                <td>
                    <a
                            class="btn btn-primary btn-xs edit_cooking_time"
                            data-group="group3"
                            data-time="{{  $caterer->cookingtime->group3 }}"
                            data-toggle="modal"
                            data-target="#edit_cooking_time"
                            href="#edit_cooking_time">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Edit Cooking Time" />
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

    @include('admin.caterers.modals.edit_cooking_time')
</div>