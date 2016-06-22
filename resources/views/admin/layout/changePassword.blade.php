<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="login">Login</h4>
      </div>
      <div class="modal-body">
        <div>
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#user" aria-controls="user" role="tab" data-toggle="tab">User</a>
            </li>
            <li role="presentation">
                <a href="#caterer" aria-controls="caterer" role="tab" data-toggle="tab">Caterer</a>
            </li>
          </ul>
          <div class="tab-content">
              @include('layouts/messages')
            <div role="tabpanel" class="tab-pane active" id="user">
                <h3>Login as User</h3>
               
            </div>
            <div role="tabpanel" class="tab-pane" id="caterer">
                <h3>Login as Caterer</h3>
               
            </div>
          </div> 
            <a href="{{url('social/facebook_login')}}">Login whit facebook</a>
            <a href="{{url('social/twitter_login')}}">Login whit Twitter</a>
        </div>    
      </div>
   <!--   <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

