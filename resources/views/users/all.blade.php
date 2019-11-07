@extends('layouts.app')

@section('title')  Users @stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                @include('partials.menu')
            </div>
            <div class="col-sm-9">
                <div><i class="fas fa-users"></i> Users</div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <table class="table table-borderless table-hover">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Join Date</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($users as $u)
                            <tr>
                                <td>{{$u->name}}</td>
                                <td>{{$u->email}}</td>
                                <td>
                                    @if($u->hasAnyRole(['Admin','Member']))
                                        {{$u->roles()->first()->name}}
                                        @else
                                        Role not assign.
                                    @endif
                                </td>
                                <td>{{$u->created_at->diffForHumans()}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#r{{$u->id}}" href="#" class="btn btn-outline-info btn-sm">
                                        <span data-toggle="tooltip" data-placement="top" title="Assign User Role">
                                            <i class="fas fa-user-cog"></i>
                                        </span>
                                    </a>
                                    <!-- User role assign modal -->
                                    <div id="r{{$u->id}}" class="modal fade" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <form method="post" action="{{route('assign.user.role')}}">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Assign role for <b>"{{$u->name}}"</b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="user_id" value="{{$u->id}}">
                                                   <div class="form-group">
                                                       <label for="role">Select Role</label>
                                                       <select name="role" id="role" class="custom-select">
                                                           @foreach($roles as $r)
                                                               <option>{{$r->name}}</option>
                                                               @endforeach

                                                       </select>
                                                   </div>
                                                    @csrf
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End User role assign modal -->

                                    <a href="#" class="btn btn-outline-primary btn-sm"><i class="fas fa-user-edit"></i></a>
                                    <a href="#" class="btn btn-outline-danger btn-sm"><i class="fas fa-user-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if(Session('info'))
        <div class="alert alert-success myAlert">
            {{Session('info')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

@stop



