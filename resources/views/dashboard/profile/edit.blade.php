@extends('layouts.admin')
@section('title')
    تعديل الملف الشخصي
    @stop


@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <a href="" class="card-title" id="horz-layout-card-center">الرئيسية</a>

                    <a href="" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"> بيانات دخول الأدمن</a>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">
                        <div class="card-text">

                            <p style="color: rgb(12,165,230);" class="card-title" id="horz-layout-card-center">تعديل بيانات الدخول: </p>

                        </div>
                        @include('dashboard.includes.alerts.errors')
                        @include('dashboard.includes.alerts.success')

                        <form  method="post" action="{{route('update.profile')}}" class="form form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput1"></label>
                                    <div class="col-md-9">
                                        <input type="hidden" name="id" value="{{$admin->id}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput2">اسم المستخدم</label>
                                    <div class="col-md-9">
                                        <input type="text" id="eventRegInput2" class="form-control" value="{{$admin->name}}" name="name">
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>



                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput3">الإيميل</label>
                                    <div class="col-md-9">
                                        <input type="email" id="eventRegInput3" class="form-control" value="{{$admin->email}}" name="email">
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput2">  كلمة المرور</label>
                                    <div class="col-md-9">
                                        <input type="password" id="eventRegInput2" class="form-control" value="" name="password">
                                        @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput2">تأكيد كلمة المرور</label>
                                    <div class="col-md-9">
                                        <input type="password" id="eventRegInput2" class="form-control" value="" name="password_confirmation">
                                        @error('password_confirmation')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>




                            </div>
                            <div class="form-actions center">
                                <button type="button" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> تراجع
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> تحديث
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop


