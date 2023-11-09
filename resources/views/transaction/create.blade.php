@extends('layouts.app')

@section('content')

<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Deposit
                            <small>Make Deposit</small>
                        </h3>
                    </div>
                </div>
                {{-- <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Physical</li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </div> --}}
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
                        <h5>Add Transaction</h5>
                    </div>
                    <div class="card-body">
                        <div class="row product-adding">
                            <div class="col-xl-5">
                                <div class="add-product">
                                    <div class="row">

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7">
                                <form class="needs-validation add-product-form" action="{{route('transaction.store')}}" method="POST">
                                    @csrf
                                    <div class="form">
                                        <div class="form-group mb-3 row">
                                            <label for="validationCustom01" class="col-xl-3 col-sm-4 mb-0">Amount : </label>
                                            <input class="form-control col-xl-8 col-sm-7" id="validationCustom01" type="text" name="amount" required="">
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>

                                        <div class="form-group mb-3 row">
                                            <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Date :</label>
                                            <input class="form-control col-xl-8 col-sm-7" id="validationCustom02" name="date" type="date" required="">
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>

                                        <div class="form-group mb-3 row">
                                            <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Type</label>
                                            <input class="form-control col-xl-8 col-sm-7" id="validationCustom02" type="hidden" required="" name="user_id" value="{{Auth::User()->id}}">
                                            <select class="form-control digits col-xl-8 col-sm-7" id="exampleFormControlSelect1" name="transaction_type">
                                                <option value="deposit">Deposit</option>
                                                <option value="withdrawal">withdraw</option>
                                                {{-- <option>Large</option>
                                                <option>Extra Large</option> --}}
                                            </select>
                                            <input class="form-control col-xl-8 col-sm-7" id="validationCustom02" type="hidden" required="" name="transaction_type" value="deposit">
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-sm-4"> Description :</label>
                                            <div class="col-xl-8 col-sm-7 pl-0 description-sm">
                                                <textarea id="editor1" name="description" cols="80" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-xl-3 offset-sm-4">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-light">Discard</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

</div>

@endsection
