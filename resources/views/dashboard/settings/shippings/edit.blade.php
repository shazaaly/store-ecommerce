@extends('layouts.admin')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <a href="" class="card-title" id="horz-layout-card-center">الرئيسية</a>

                    <a href="" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"> وسائل التوصيل</a>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">
                        <div class="card-text">

                            <p style="color: rgb(12,165,230);" class="card-title" id="horz-layout-card-center">تعديل وسائل التوصيل: </p>

                        </div>
                        <form  method="PUT" action="{{route('update.shippings.methods',$shippingMethod->id)}}" class="form form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput1">Full Name</label>
                                    <div class="col-md-9">
                                        <input type="hidden" value="{{$shippingMethod->id}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput2">Title</label>
                                    <div class="col-md-9">
                                        <input type="text" id="eventRegInput2" class="form-control" value="{{$shippingMethod->value}}" name="title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput3">Company</label>
                                    <div class="col-md-9">
                                        <input type="text" id="eventRegInput3" class="form-control" placeholder="company" name="company">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput4">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" id="eventRegInput4" class="form-control" placeholder="email" name="email">
                                    </div>`
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput5">Contact Number</label>
                                    <div class="col-md-9">
                                        <input type="tel" id="eventRegInput5" class="form-control" name="contact" placeholder="contact number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">Existing Customer</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="d-inline-block custom-control custom-radio mr-1">
                                                <input type="radio" name="customer1" class="custom-control-input" checked="" id="yes">
                                                <label class="custom-control-label" for="yes">Yes</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="customer1" class="custom-control-input" id="no">
                                                <label class="custom-control-label" for="no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions center">
                                <button type="button" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop


