@extends('layouts.app')

@section('content')
<div class="modal fade" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{"Delete Confirmation"}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>{{__("Are you sure you want to delete?")}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" style="background: lightgray" data-bs-dismiss="modal">{{__('Cancel')}}</button>
          <form action="" method="POST" id="modal-delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">{{__('Delete Account')}}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<div class="container" style="min-height: 85vh">
    <div class="row justify-content-center">
        <div class="table-responsive col-md-8">
            <table class="table table-striped text-center">
                <thead>
                  <tr>
                    <th scope="col" colspan="1" class="fs-4 col-md-6">{{__('Account')}}</th>
                    <th scope="col" colspan="2" class="fs-4 col-md-6">{{__('Action')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->first_name.' '.$user->last_name}} - {{$user->role->role_name}}</td>
                            <td><a href="{{route('role.form', ['id' => $user->user_id, 'lang' => App::getLocale()])}}" class="btn btn-warning">{{__('Update Role')}}</a></td>
                            <td><a href="#" class="btn btn-danger btn-delete-account" data-route-name="{{route('account.delete', ['id' => $user->user_id])}}" data-bs-toggle="modal" data-bs-target="#modal-form">{{__('Delete Account')}}</a></td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="d-flex flex-column align-items-center mb-2">
            {{$users->onEachSide(1)->withQueryString()->links()}}
            <p class="text-center mt-2">{{__('Page').' '.$users->currentPage()}}</p>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('a.btn-delete-account').click(function(e){
            $('#modal-delete-form').attr('action', $(this).attr('data-route-name'))
        })
    })
</script>
@endsection
