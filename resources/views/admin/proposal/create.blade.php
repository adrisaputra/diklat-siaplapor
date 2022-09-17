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
                                <li class="breadcrumb-item"><a href="{{ url('office')}}">{{ __($title) }}</a>
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
									<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Usul <span class="required" style="color: #dd4b39;">*</span> </label>
									<div class="col-sm-9">
										<input type="date" name="date" class="form-control @if ($errors->has('date')) is-invalid @endif " value="{{ old('date') }}">
										@if ($errors->has('date')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('date') }}</label>@endif
									</div>
								</div>

                                <div class="form-group row">
                                    <label class="col-form-label col-sm-3 text-sm-right"> Jenis Usul <span class="required" style="color: #dd4b39;">*</span> </label>
                                    <div class="col-sm-9">
                                        <select class="select2 form-control @if ($errors->has('type')) is-invalid @endif " id="default-select" name="type">
                                            <option value="">- Pilih Jenis Usul -</option>
                                            <option value="1" @if(old('type')=="Draft SK") selected @endif>Draft SK</option>
                                            <option value="2" @if(old('type')=="Pergub") selected @endif>Pergub</option>
                                            <option value="3" @if(old('type')=="Perda") selected @endif>Perda</option>
                                            <option value="3" @if(old('type')=="MOU") selected @endif>MOU</option>
                                            <option value="3" @if(old('type')=="NPHD") selected @endif>NPHD</option>
                                            <option value="3" @if(old('type')=="Nota Kesepahaman") selected @endif>Nota Kesepahaman</option>
                                            <option value="3" @if(old('type')=="Lainnya") selected @endif>Lainnya</option>
                                        </select>
                                        @if ($errors->has('type')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('type') }}</label>@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-sm-3 text-sm-right"> Tentang <span class="required" style="color: #dd4b39;">*</span> </label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @if ($errors->has('type')) is-invalid @endif " name="about" id="basicTextarea" rows="3"></textarea>
                                        @if ($errors->has('about')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('about') }}</label>@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-sm-3 text-sm-right"> Surat Pengantar <span class="required" style="color: #dd4b39;">*</span> </label>
                                    <div class="col-sm-9">
										<i style="font-size:10px">Ukuran File Tidak Boleh Lebih Dari 50 mb (PDF)</i><br>
                                        <div class="custom-file">
                                            <input type="file" name="cover_letter" class="custom-file-input  @if ($errors->has('cover_letter')) is-invalid @endif " id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        @if ($errors->has('cover_letter')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('cover_letter') }}</label>@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-sm-3 text-sm-right"> Telaah Staf <span class="required" style="color: #dd4b39;">*</span> </label>
                                    <div class="col-sm-9">
										<i style="font-size:10px">Ukuran File Tidak Boleh Lebih Dari 50 mb (PDF)</i><br>
                                        <div class="custom-file">
                                            <input type="file" name="review_staff" class="custom-file-input  @if ($errors->has('review_staff')) is-invalid @endif " id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        @if ($errors->has('review_staff')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('review_staff') }}</label>@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-sm-3 text-sm-right"> Nota Dinas <span class="required" style="color: #dd4b39;">*</span> </label>
                                    <div class="col-sm-9">
										<i style="font-size:10px">Ukuran File Tidak Boleh Lebih Dari 50 mb (PDF)</i><br>
                                        <div class="custom-file">
                                            <input type="file" name="official_memo" class="custom-file-input  @if ($errors->has('official_memo')) is-invalid @endif " id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        @if ($errors->has('official_memo')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('official_memo') }}</label>@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-sm-3 text-sm-right"> Konsep Persetujuan Naskah Dinas <span class="required" style="color: #dd4b39;">*</span> </label>
                                    <div class="col-sm-9">
										<i style="font-size:10px">Ukuran File Tidak Boleh Lebih Dari 50 mb (PDF)</i><br>
                                        <div class="custom-file">
                                            <input type="file" name="approval_concept" class="custom-file-input  @if ($errors->has('approval_concept')) is-invalid @endif " id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        @if ($errors->has('approval_concept')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('approval_concept') }}</label>@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-sm-3 text-sm-right"> Draf SK/Pergub/Perda <span class="required" style="color: #dd4b39;">*</span> </label>
                                    <div class="col-sm-9">
										<i style="font-size:10px">Ukuran File Tidak Boleh Lebih Dari 50 mb (doc,xls)</i><br>
                                        <div class="custom-file">
                                            <input type="file" name="draft" class="custom-file-input  @if ($errors->has('draft')) is-invalid @endif " id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        @if ($errors->has('draft')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('draft') }}</label>@endif
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