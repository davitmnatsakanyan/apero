@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
		<div class="page-content">
                   <div class = "page-breadcrumb breadcrumb"><h3>User Detalis</h3> </div>
                   <div class = "page-breadcrumb breadcrumb">
                      <div>Name    : {{ $user['name'] }} </div>
                      <div>Address : {{ $user['address'] }} </div>
                      <div>City    : {{ $user['city'] }} </div>
                      <div>Country : {{ $user['country'] }} </div>
                      <div>Pobox   : {{ $user['pobox'] }} </div>
                      <div>Zip     : {{ $user['zip'] }} </div>
                      <div>Email   : {{ $user['email'] }} </div>
                      <div>Phone   : {{ $user['phone'] }} </div>
                      <div>Mobile  : {{ $user['mobile'] }} </div>
                      <div>IP      : {{ $user['created_ip'] }} </div>
                      <div>Deleter Id : {{ $user['deleter_id'] }} </div>
                      <div>Deleted Time  : {{ $user['deleted_time'] }} </div>
                      <div>Role   : @if($user['role']==0)
                                        User  
                                    @else
                                        Guest
                                    @endif
                      </div>  
                      <div>Created Date : {{ $user['created_at'] }} </div>
                      <div>Updated Date : {{ $user['updated_at'] }} </div>
                   </div>
                </div>
    </div>
@stop
