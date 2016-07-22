<div id="edit_cooking_time" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Product: <strong class="product_name"></strong> </h4>
            </div>
            <div class="modal-body">
                <form id="form_count" action="{{ url('admin/caterers/edit-cooking-time') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form_group">
                        <label>Cooking time</label>
                        <input type="number" name="time">
                        <input type="hidden" name="caterer_id" value = "{{ $caterer->id }}">
                        <input type="hidden" name="group">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                <button type="submit" form="form_count"  class="btn green">Save</button>
            </div>
        </div>
    </div>
</div>