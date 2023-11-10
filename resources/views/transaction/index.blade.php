@extends('layouts.app')

@section('content')

<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Orders
                            <small>Bigdeal Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Sales</li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Manage Order</h5>
                    </div>
                    <div class="card-body order-datatable">
                        <table class="display table-border" id="basic-1">
                            <thead>
                            <tr>
                                <th>Transaction Id</th>
                                <th>Date</th>
                                <th>Transaction Type</th>
                                <th>Amount</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allTransaction as $trans)
                            <tr>
                                <td>{{$trans->id}}</td>
                                <td>
                                    {{$trans->date}}
                                </td>
                                <td><span class="badge badge-secondary">{{$trans->transaction_type}}</span></td>
                                <td>{{$trans->amount}}</td>

                            </tr>

                            @endforeach
                            <tr>
                                <hr>
                                <td colspan="3">Current Balance</td>
                                <td colspan="2">{{$balance->balance}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

</div>

@endsection
