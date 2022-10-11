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
                                <p><center style="font-size:20px;"> LAMBAR KONTROL</center></p>
                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> OPD/BIRO </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="{{ $proposal->office->name }}" readonly>
									</div>
								</div>
	
                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> NO. AGENDA REGISTRASI </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="" readonly>
									</div>
								</div>
	
                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> TANGGAL MASUK SK </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="{{ date('d-m-Y', strtotime($proposal->date)) }}" readonly>
									</div>
								</div>
	
                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> TENTANG</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="{{ $proposal->about }}" readonly>
									</div>
								</div>

                                <table class="table">
                                    <thead class="bg-info white">
                                        <tr>
                                            <th>NO</th>
                                            <th>KELENGKAPAN PELAYANAN</th>
                                            <th>ADA</th>
                                            <th>TIDAK</th>
                                            <th>KETERANGAN</th>
                                        <tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td> Surat Pengantar</td>
                                            <td><a href="{{ asset('upload/cover_letter/'.$proposal->cover_letter ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
                                            <td>
                                                @if($proposal->status1=="Tidak Lengkap")
                                                    Tidak Lengkap
                                                @endif
                                            </td>
                                            <td>
                                                @if($proposal->status1=="Tidak Lengkap")
                                                    $proposal->desc1
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Telaah Staf</td>
                                            <td><a href="{{ asset('upload/review_staff/'.$proposal->review_staff ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
                                            <td>
                                                @if($proposal->status2=="Tidak Lengkap")
                                                    Tidak Lengkap
                                                @endif
                                            </td>
                                            <td>
                                                @if($proposal->status2=="Tidak Lengkap")
                                                    $proposal->desc2
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Nota Dinas</td>
                                            <td><a href="{{ asset('upload/official_memo/'.$proposal->official_memo ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
                                            <td>
                                                @if($proposal->status3=="Tidak Lengkap")
                                                    Tidak Lengkap
                                                @endif
                                            </td>
                                            <td>
                                                @if($proposal->status3=="Tidak Lengkap")
                                                    $proposal->desc3
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Konsep Persetujuan Naskah Dinas</td>
                                            <td><a href="{{ asset('upload/approval_concept/'.$proposal->approval_concept ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
                                            <td>
                                                @if($proposal->status4=="Tidak Lengkap")
                                                    Tidak Lengkap
                                                @endif
                                            </td>
                                            <td>
                                                @if($proposal->status4=="Tidak Lengkap")
                                                    $proposal->desc4
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Draft SK/Pergub/Perda</td>
                                            <td><a href="{{ asset('upload/draft/'.$proposal->draft ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
                                            <td>
                                                @if($proposal->status5=="Tidak Lengkap")
                                                    Tidak Lengkap
                                                @endif
                                            </td>
                                            <td>
                                                @if($proposal->status5=="Tidak Lengkap")
                                                    $proposal->desc5
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <hr>
                                
                                {{-- @if($harmonization->upload_fix)
                                
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
        
                                @endif --}}

                                <hr>
                                
                                    <p><center style="font-size:20px;"> RIWAYAT HARMONISASI</center></p>

                                        <table class="table">
                                            <thead class="bg-info white">
                                                <tr>
                                                    <th>NAMA/NOMOR HP</th>
                                                    <th>TANGGAL PENGAMBILAN</th>
                                                    <th>TANGGAL PENGEMBALIAN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($history as $v)
                                            <tr>
                                                <td>
                                                    @if($v->taker_name)
                                                        {{ $v->taker_name }}
                                                    @else
                                                        {{ $v->depositor_name }}
                                                    @endif
                                                </td>
                                                <td>@if($v->taker_date!=NULL) {{ date('d-m-Y', strtotime($v->taker_date)) }} @endif</td>
                                                <td>@if($v->depositor_date!=NULL) {{ date('d-m-Y', strtotime($v->depositor_date)) }} @endif</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                
								<br><br>
								<div class="form-group row">
									<div class="col-sm-12 ml-sm-auto">
										<a href="{{ url('/'.Request::segment(1).'/print/'.$proposal->id) }}" class="btn btn-primary">Cetak</a>
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