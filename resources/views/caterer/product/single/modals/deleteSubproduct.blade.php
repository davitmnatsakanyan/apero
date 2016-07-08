<!-- Modal -->
<div class="modal fade" id="deleteSubproductModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                Do you really whant delete this product?
                <form method="post" id="deleteSubproduct" action = "{{ url('caterer/product/single/deleteSubproduct') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name = "id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                <button type="submit" class="btn btn-default" form = "deleteSubproduct">Delete</button>
            </div>
        </div>
    </div>
</div>