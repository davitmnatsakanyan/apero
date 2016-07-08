<!-- Modal -->
<div class="modal fade" id="editSubproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form id="updateSubproduct" action="{{ url('caterer/product/single/change_cutom'  )}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form_group">
                        <label>Name</label>
                        <input type="text" name="name">
                        <br>
                        <label>Price</label>
                        <input type="number" name="price">
                        <input type="hidden" name="id">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                <button type="submit" class="btn btn-primary" form="updateSubproduct">Update</button>
            </div>
        </div>
    </div>
</div>
