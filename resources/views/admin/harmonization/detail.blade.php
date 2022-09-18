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
                                <li class="breadcrumb-item"><a href="{{ url('proposal')}}">{{ __($title) }}</a>
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
                                    <h4 class="card-title">Detail {{ __($title) }}</h4>
                                </div>
                                <p><center style="font-size:20px;"> Data Usulan</center></p>
                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Usul </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="{{ date('d-m-Y', strtotime($proposal->date)) }}" readonly>
									</div>
								</div>
	
                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Jenis Usul</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="{{ $proposal->type }}" readonly>
									</div>
								</div>

                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Tentang</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="{{ $proposal->about }}" readonly>
									</div>
								</div>

                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Surat Pengantar</label>
									<div class="col-sm-9">
                                        <a href="{{ asset('upload/cover_letter/'.$proposal->cover_letter ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a>
									</div>
								</div>

                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Telaah Staf</label>
									<div class="col-sm-9">
                                        <a href="{{ asset('upload/review_staff/'.$proposal->review_staff ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a>
									</div>
								</div>

                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Nota Dinas</label>
									<div class="col-sm-9">
                                        <a href="{{ asset('upload/official_memo/'.$proposal->official_memo ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a>
									</div>
								</div>

                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Konsep Persetujuan Naskah Dinas</label>
									<div class="col-sm-9">
                                        <a href="{{ asset('upload/approval_concept/'.$proposal->approval_concept ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a>
									</div>
								</div>

                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Draf SK/Pergub/Perda</label>
									<div class="col-sm-9">
                                        <a href="{{ asset('upload/draft/'.$proposal->draft ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a>
									</div>
								</div>

                                <hr>
                                
                                @if($harmonization->upload_fix)
                                
                                    <p><center style="font-size:20px;"> Data Perbaikan</center></p>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3 text-sm-right"> File Perbaikan</label>
                                        <div class="col-sm-9">
                                            <a href="{{ asset('upload/upload_fix/'.$harmonization->upload_fix ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3 text-sm-right"> Tanggal Upload </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ date('d-m-Y', strtotime($harmonization->upload_date)) }}" readonly>
                                        </div>
                                    </div>
        
                                @endif

                                @if($harmonization->taker_name)
                                
                                    <p><center style="font-size:20px;"> Data Pengambil Berkas</center></p>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3 text-sm-right"> Nama Pengambil Berkas Fisik </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $harmonization->taker_name }}" readonly>
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3 text-sm-right"> No HP. Pengambil Berkas Fisik </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $harmonization->taker_phone }}" readonly>
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3 text-sm-right"> Tanggal Ambil Berkas Fisik </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ date('d-m-Y', strtotime($harmonization->taker_date)) }}" readonly>
                                        </div>
                                    </div>
        
                                @endif
                                @if($harmonization->depositor_name)
                                
                                    <p><center style="font-size:20px;"> Data Penyetor Berkas</center></p>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3 text-sm-right"> Nama Penyetor Berkas Fisik </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $harmonization->depositor_name }}" readonly>
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3 text-sm-right"> Tanggal Setor Berkas Fisik </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $harmonization->depositor_date }}" readonly>
                                        </div>
                                    </div>
        
                                @endif
								<br><br>
								<div class="form-group row">
									<div class="col-sm-12 ml-sm-auto">
										<a href="{{ url('/'.Request::segment(1)) }}" class="btn btn-warning">Kembali</a>
									</div>
								</div>
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