@extends('admin.layout')
@section('konten')
        
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __($title) }}</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ url('agenda')}}">{{ __($title) }}</a>
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
                                    <h4 class="card-title">Tambah {{ __($title) }}</h4>
                                </div>
						  	<form action="{{ url('/'.Request::segment(1)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
								{{ csrf_field() }}
                                
								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Masuk <span class="required" style="color: #dd4b39;">*</span> </label>
									<div class="col-sm-9">
										<input type="date" name="date_of_entry" class="form-control @if ($errors->has('date_of_entry')) is-invalid @endif " value="{{ old('date_of_entry') }}">
										@if ($errors->has('date_of_entry')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('date_of_entry') }}</label>@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Surat <span class="required" style="color: #dd4b39;">*</span></label>
									<div class="col-sm-9">
										<input type="date" name="letter_date" class="form-control @if ($errors->has('letter_date')) is-invalid @endif " value="{{ old('letter_date') }}">
										@if ($errors->has('letter_date')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('letter_date') }}</label>@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> No. Surat <span class="required" style="color: #dd4b39;">*</span></label>
									<div class="col-sm-9">
										<input type="text" name="letter_number" class="form-control @if ($errors->has('letter_number')) is-invalid @endif " value="{{ old('letter_number') }}">
										@if ($errors->has('letter_number')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('letter_number') }}</label>@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Asal Surat </label>
									<div class="col-sm-9">
										<input type="text" name="letter_from" class="form-control @if ($errors->has('letter_from')) is-invalid @endif " value="{{ old('letter_from') }}">
										@if ($errors->has('letter_from')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('letter_from') }}</label>@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Tentang</label>
									<div class="col-sm-9">
										<input type="text" name="about" class="form-control @if ($errors->has('about')) is-invalid @endif " value="{{ old('about') }}">
										@if ($errors->has('about')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('about') }}</label>@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Diproses</label>
									<div class="col-sm-9">
										<input type="text" name="on_process" class="form-control @if ($errors->has('on_process')) is-invalid @endif " value="{{ old('on_process') }}">
										@if ($errors->has('on_process')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('on_process') }}</label>@endif
									</div>
								</div>
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