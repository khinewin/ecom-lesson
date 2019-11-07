@extends('layouts.app')
@section('title') Orders @stop

@section('content')

    <div class="container mt-5">
        <div class="row">

            <div class="col-sm-2"><i class="fas fa-user-astronaut"></i> Orders</div>
            <div class="col-sm-4">
                <form method="get" id="form_filter_by_date" action="{{route('filter_by_date')}}">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Filter by Date</div>
                            </div>
                            <input type="date" id="filer_by_date" class="form-control" name="filter_by_date">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-4">
                <form method="get" id="form_filter_by_month" action="{{route('filter_by_month')}}">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Filter by Month</div>
                            </div>
                            <select name="filter_by_month" id="filter_by_month" class="form-control">
                                <option value="">Select Month</option>
                                <option value="2019-01">Jan 2019</option>
                                <option value="2019-02">Feb 2019</option>
                                <option value="2019-11">Nov 2019</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="dropdown-divider"></div>

            <div class="accordion" id="accordionExample">
                @foreach($orders as $od)
                <div class="card">
                    <div class="card-header  @if($od->status) bg-success @else bg-info @endif " id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed text-white" type="button" data-toggle="collapse" data-target="#c{{$od->id}}" aria-expanded="false" aria-controls="collapseTwo">
                               <i class="fas fa-caret-down"></i> Order ID : {{$od->id}}
                            </button>
                        </h2>
                    </div>
                    <div id="c{{$od->id}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3" style="border-right: 2px solid orangered">
                                    <p>
                                        {!! DNS2D::getBarcodeHTML($od->id, "QRCODE"); !!}
                                    </p>
                                    <p>
                                      <i class="fas fa-user"></i>  Name : {{$od->user->name}}
                                    </p>
                                    <p>
                                       <i class="fas fa-envelope-open"></i> Email : {{$od->user->email}}
                                    </p>
                                    <p>
                                        <i class="fas fa-phone"></i> Phone : {{$od->phone}}
                                     </p>
                                    <p>
                                        <i class="fas fa-map-pin"></i> Address : {{$od->address}}
                                    </p>
                                    <p>
                                        <i class="fas fa-calendar-day"></i> Date : {{date("D(d) m/Y h:i A",strtotime($od->created_at))}}
                                    </p>
                                </div>
                                <div class="col-sm-9">
                                    <table class="table table-borderless table-hover">
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Amount</th>
                                        </tr>
                                        <?php  $totalAmount=0; ?>
                                        @foreach($od->orderitem as $i)
                                            <?php $totalAmount += $i->amount ?>
                                            <tr>
                                                <td>{{$i->item_name}}</td>
                                                <td>{{$i->price}}</td>
                                                <td>{{$i->qty}}</td>
                                                <td>{{$i->amount}}</td>
                                            </tr>
                                            @endforeach
                                        <tr>
                                            <td colspan="3" class="text-right">Total Amount</td>
                                            <td>{{$totalAmount}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>



    </div>

@stop