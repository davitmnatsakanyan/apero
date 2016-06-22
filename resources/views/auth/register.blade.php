<!-- Modal -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registration</h4>
      </div>
      <div class="modal-body">
      
          
          
          
          
       <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#user_register" aria-controls="home" role="tab" data-toggle="tab">User</a>
    </li>
    <li role="presentation">
        <a href="#caterer_register" aria-controls="profile" role="tab" data-toggle="tab">Caterer</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="user_register">
          @include ('auth/forms/user_reg',['userType' => 'user'])
      </div>
    <div role="tabpanel" class="tab-pane" id="caterer_register">
         @include ('auth/forms/caterer_reg',['userType' => 'caterer'])
    </div>
  </div>

</div>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
      </div>
   <!--   <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
