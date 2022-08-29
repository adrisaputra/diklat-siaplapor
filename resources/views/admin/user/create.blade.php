@extends('admin.layout')
@section('konten')
        
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('User') }}</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ url('user')}}">{{ __('User') }}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-4 col-12 d-block d-md-none"><a class="btn btn-warning btn-min-width float-md-right box-shadow-4 mr-1 mb-1" href="chat-application.html"><i class="ft-mail"></i> Email</a></div>
            </div>
            <div class="content-body">
                <!-- Basic Tables start -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body">
							
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('Tambah User') }}</h4>
                                </div>
						  	<form action="{{ url('/'.Request::segment(1)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
								{{ csrf_field() }}
								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Nama User</label>
									<div class="col-sm-9">
										<input type="text" name="name" class="form-control @if ($errors->has('name')) is-invalid @endif " value="{{ old('name') }}">
										@if ($errors->has('name')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('name') }}</label>@endif
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Email</label>
									<div class="col-sm-9">
										<input type="text" name="email" class="form-control @if ($errors->has('email')) is-invalid @endif " value="{{ old('email') }}">
										@if ($errors->has('email')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('email') }}</label>@endif
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Password</label>
									<div class="col-sm-9">
										<input type="password" name="password" class="form-control @if ($errors->has('password')) is-invalid @endif ">
										@if ($errors->has('password')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('password') }}</label>@endif
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Konfirmasi Password</label>
									<div class="col-sm-9">
										<input type="password" name="password_confirmation" class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif "">
										@if ($errors->has('password_confirmation')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('password_confirmation') }}</label>@endif
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Group</label>
									<div class="col-sm-9">
                                        <select class="select2 form-control @if ($errors->has('group')) is-invalid @endif " id="default-select" name="group" onchange=" if (this.selectedIndex==3){ 
												document.getElementById('office').style.display = 'inline'; 
											} else {
												document.getElementById('office').style.display = 'none'; 
											};">
                                            <option value="">- Pilih Group -</option>
                                            <option value="1" @if(old('group')==1) selected @endif>Administrator</option>
                                            <option value="2" @if(old('group')==2) selected @endif>Pimpinan</option>
                                            <option value="3" @if(old('group')==3) selected @endif>Admin OPD</option>
                                        </select>
										@if ($errors->has('group')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('group') }}</label>@endif
									</div>
								</div>
                                @if(old('group') =="3")
                                    <span id="office" style="display:inline;">
                                @else
                                    <span id="office" style="display:none;">
                                @endif
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3 text-sm-right"> OPD</label>
                                        <div class="col-sm-9">
                                            <select class="select2 form-control @if ($errors->has('office_id')) is-invalid @endif " id="default-select" name="office_id">
                                                <option value="">- Pilih OPD -</option>
                                                @foreach($office as $v)
                                                    <option value="{{ $v->id }}">{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('office_id')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('office_id') }}</label>@endif
                                        </div>
                                    </div>
                                </span>
								<br><br>
								<div class="form-group row">
									<div class="col-sm-10 ml-sm-auto">
										<button type="submit" class="btn btn-success">Simpan</button>
										<button type="reset" class="btn btn-danger">Reset</button>
										<a href="{{ url('/'.Request::segment(1)) }}" class="btn btn-warning">kembali</a>
									</div>
								</div>
							</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection