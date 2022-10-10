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
						  	<form action="{{ url('/'.Request::segment(1).'/search') }}" method="GET">
							<div class="row">
								<div class="col-md-9">
									<a href="{{ url('/'.Request::segment(1)) }}" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>
								</div>
								<div class="col-md-3">
									<div class="input-group">
										<input type="text" class="form-control" name="search" placeholder="Cari Data">
										<span class="input-group-btn">
											<input type="submit" name="submit" class="btn btn-info btn-flat" value="Cari">
										</span>
									</div>
								</div>
							</div>
							</form><br>

							@if ($message = Session::get('status'))
								<div class="alert alert-success mb-2" role="alert">
									{{ $message }}
								</div>
							@endif

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="bg-info white">
                                                <tr>
                                                    <th style="width: 60px">No</th>
                                                    <th>Tanggal Usul</th>
                                                    <th>Jenis Usul</th>
                                                    <th>Tentang</th>
                                                    @if(Auth::user()->group == 1 || Auth::user()->group == 2)
                                                        <td>OPD</td>
                                                        @if(Request::segment(1)=="harmonization_get_document") 
                                                            <th style="width: 20%">Keterangan</th>
                                                            <th style="width: 20%">#aksi</th>
                                                        @else
                                                            <th style="width: 20%">#aksi</th>
                                                        @endif

                                                    @elseif(Auth::user()->group == 3)
                                                    
                                                        @if(Request::segment(1)=="harmonization_opd" || Request::segment(1)=="harmonization_done") 
                                                            <th style="width: 20%">#aksi</th>
                                                        @else
                                                            <td>Keterangan</td>
                                                            <th style="width: 20%">#aksi</th>
                                                        @endif
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
								   	 	@foreach($proposal as $v)
										<tr>
											<td>{{ ($proposal ->currentpage()-1) * $proposal ->perpage() + $loop->index + 1 }}</td>
											<td>{{ date('d-m-Y', strtotime($v->date)) }}</td>
											<td>{{ $v->type }}</td>
											<td>{{ $v->about }}</td>
                                            @if(Auth::user()->group == 1 || Auth::user()->group == 2)
											    <td>{{ $v->office->name }}</td>
                                            @elseif(Auth::user()->group == 3)
                                                @if($v->status == "kirim ke opd")
                                                    <td>Silahkan download file perbaikan, dan datang di Biro Hukum untuk ambil berkas fisik</td> 
                                                @elseif($v->status == "ambil berkas fisik")
                                                    <td>Silahkan perbaiki file draft doc dari admin, kemudian upload kembali</td> 
                                                @elseif($v->status == "kirim ke admin")
                                                    <td>Laporan telah dikirim ke admin, Silahkan Setor Ulang Berkas Fisik ke Biro Hukum</td> 
                                                @elseif($v->status == "setor berkas fisik")
                                                    <td>Laporan sedang diverifikasi</td> 
                                                @endif       
                                            @endif
                                           
                                                @if(Auth::user()->group == 1)
                                                    @if(Request::segment(1)=="harmonizations") 
                                                        <td>
                                                            <a href="{{ url(Request::segment(1).'/detail/'.$v->id ) }}" class="btn btn-sm btn-flat btn-primary btn-block">Detail</a>
                                                         @if($v->status == "perbaikan") 
                                                            <a href="{{ asset('upload/draft/'.$v->draft ) }}" target="blank" class="btn btn-sm btn-flat btn-info btn-block">Download File Draft</a>
                                                         @else
                                                            <a href="{{ asset('upload/draft_fix/'.$v->draft_fix ) }}" target="blank" class="btn btn-sm btn-flat btn-info btn-block">Download File Draft</a>
                                                         @endif
                                                            <a href="#" data-toggle="modal" data-target="#default{{ $v->id }}" class="btn btn-sm btn-flat btn-success  btn-block">Upload File Perbaikan</a>
                                                        </td>
                                                    @elseif(Request::segment(1)=="harmonization_opd") 
                                                        <td> 
                                                            <a href="{{ url(Request::segment(1).'/detail/'.$v->id ) }}" class="btn btn-sm btn-flat btn-primary btn-block">Detail</a>
                                                            <a href="#" data-toggle="modal" data-target="#default2{{ $v->id }}" class="btn btn-sm btn-flat btn-danger btn-block">OPD Ambil Berkas Fisik</a>
                                                        </td>
                                                    @elseif(Request::segment(1)=="harmonization_get_document") 
                                                        <td>Menunggu File Perbaikan Dari OPD</td>
                                                        <td><a href="{{ url(Request::segment(1).'/detail/'.$v->id ) }}" class="btn btn-sm btn-flat btn-primary btn-block">Detail</a></td>
                                                    @elseif(Request::segment(1)=="harmonization_send_document") 
                                                        <td>
                                                            <a href="{{ url(Request::segment(1).'/detail/'.$v->id ) }}" class="btn btn-sm btn-flat btn-primary btn-block">Detail</a>
                                                            <a href="{{ asset('upload/upload_fix/'.$v->upload_fix ) }}" target="blank" class="btn btn-sm btn-flat btn-info btn-block">Download File Draft Perbaikan OPD</a>
                                                            <a href="#" data-toggle="modal" data-target="#default4{{ $v->id }}" class="btn btn-sm btn-flat btn-danger btn-block">OPD Setor Berkas Fisik</a>
                                                        </td>
                                                    @elseif(Request::segment(1)=="harmonization_verification") 
                                                        <td>
                                                            <a href="{{ url(Request::segment(1).'/detail/'.$v->id ) }}" class="btn btn-sm btn-flat btn-primary btn-block">Detail</a>
                                                            <a href="{{ asset('upload/upload_fix/'.$v->upload_fix ) }}" target="blank" class="btn btn-sm btn-flat btn-info btn-block">Download File Draft Perbaikan OPD</a>
                                                            <a href="{{ url(Request::segment(1).'/fix_again/'.$v->id ) }}"  class="btn btn-sm btn-flat btn-danger btn-block" onclick="return confirm('Anda Yakin ?');">Perbaiki Kembali</a>
                                                            <a href="#" data-toggle="modal" data-target="#default5{{ $v->id }}" class="btn btn-sm btn-flat btn-success btn-block">Selesai</a>
                                                        </td>
                                                    @elseif(Request::segment(1)=="harmonization_done") 
                                                        <td>
                                                            <a href="{{ url(Request::segment(1).'/detail/'.$v->id ) }}" class="btn btn-sm btn-flat btn-primary btn-block">Detail</a>
                                                        </td>
                                                    @endif

                                                @elseif(Auth::user()->group == 2)
                                                
                                                    @if(Request::segment(1)=="harmonization_get_document") 
                                                        <td>Menunggu File Perbaikan Dari OPD</td>
                                                        <td>
                                                            <a href="{{ url(Request::segment(1).'/detail/'.$v->id ) }}" class="btn btn-sm btn-flat btn-primary btn-block">Detail</a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <a href="{{ url(Request::segment(1).'/detail/'.$v->id ) }}" class="btn btn-sm btn-flat btn-primary btn-block">Detail</a>
                                                        </td>
                                                    @endif
                                                @elseif(Auth::user()->group == 3)

                                                    @if($v->status == "perbaikan" || $v->status == "perbaiki kembali" || $v->status == "kirim ke admin" || $v->status == "setor berkas fisik" || $v->status == "selesai") 
                                                        <td>
                                                            <a href="{{ url(Request::segment(1).'/detail/'.$v->id ) }}" class="btn btn-sm btn-flat btn-primary btn-block">Detail</a>
                                                        </td>
                                                    @elseif($v->status == "kirim ke opd") 
                                                        <td>
                                                            <a href="{{ url(Request::segment(1).'/detail/'.$v->id ) }}" class="btn btn-sm btn-flat btn-primary btn-block">Detail</a>
                                                            <a href="{{ asset('upload/upload_fix/'.$v->upload_fix ) }}" target="blank" class="btn btn-sm btn-flat btn-info btn-block">Download File Perbaikan</a>
                                                        </td>
                                                    @elseif($v->status == "ambil berkas fisik") 
                                                        <td>
                                                            <a href="{{ url(Request::segment(1).'/detail/'.$v->id ) }}" class="btn btn-sm btn-flat btn-primary btn-block">Detail</a>
                                                            <a href="{{ asset('upload/upload_fix/'.$v->upload_fix ) }}" target="blank" class="btn btn-sm btn-flat btn-info btn-block">Download File Perbaikan</a>
                                                            <a href="#" data-toggle="modal" data-target="#default3{{ $v->id }}" class="btn btn-sm btn-flat btn-success  btn-block">Upload File Perbaikan</a>
                                                        </td>
                                                    @else<td></td>@endif
                                                @endif
										</tr>
                                        <!-- Modal -->
                                        
                                        <form action="{{ url('/'.Request::segment(1).'/upload_file_fix/'.$v->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="modal fade text-left" id="default{{ $v->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="basicModalLabel1">Upload File Perbaikan Ke OPD</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="custom-file">
                                                            <input type="file" name="upload_fix" class="custom-file-input" required>
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                            <i style="font-size:10px">Ukuran File Tidak Boleh Lebih Dari 50 mb (doc,xls)</i>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Simpan</button>
                                                        <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>

                                        <form action="{{ url('/'.Request::segment(1).'/get_document/'.$v->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="modal fade text-left" id="default2{{ $v->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="basicModalLabel1">Data Pengambil</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-3 text-sm-right"> Nama Pengambil <span class="required" style="color: #dd4b39;">*</span> </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="taker_name" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-3 text-sm-right"> No HP <span class="required" style="color: #dd4b39;">*</span> </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="taker_phone" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-3 text-sm-right"> Tanggal Ambil <span class="required" style="color: #dd4b39;">*</span> </label>
                                                            <div class="col-sm-9">
                                                                <input type="date" name="taker_date" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Simpan</button>
                                                        <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>

                                        <form action="{{ url('/'.Request::segment(1).'/deposit_document/'.$v->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="modal fade text-left" id="default4{{ $v->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="basicModalLabel1">Data Penyetor</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-3 text-sm-right"> Nama Penyetor <span class="required" style="color: #dd4b39;">*</span> </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="depositor_name" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-3 text-sm-right"> Tanggal Menyetor <span class="required" style="color: #dd4b39;">*</span> </label>
                                                            <div class="col-sm-9">
                                                                <input type="date" name="depositor_date" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Simpan</button>
                                                        <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>

                                        <form action="{{ url('/'.Request::segment(1).'/done/'.$v->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="modal fade text-left" id="default5{{ $v->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="basicModalLabel1">Verifikasi Berkas</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-8"> Berkas fisik sudah diparaf Karo</label>
                                                                <input type="checkbox" required/>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-8"> Berkas fisik sudah diparaf Kabag</label>
                                                            <input type="checkbox" required/>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Selesai</button>
                                                        <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>

                                        <form action="{{ url('/'.Request::segment(1).'/send_document/'.$v->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="modal fade text-left" id="default3{{ $v->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="basicModalLabel1">Upload File Perbaikan Ke Admin</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="custom-file">
                                                            <input type="file" name="upload_fix" class="custom-file-input" required>
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                            <i style="font-size:10px">Ukuran File Tidak Boleh Lebih Dari 50 mb (doc,xls)</i>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Simpan</button>
                                                        <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>

										@endforeach
                                            </tbody>
                                        </table>
								        <div align="right">{{ $proposal->appends(Request::only('search'))->links() }}</div>
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