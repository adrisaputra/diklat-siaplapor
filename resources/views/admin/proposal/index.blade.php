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
                                                    @if(Auth::user()->group == 1)
                                                        <td>OPD</td>
                                                    @endif
                                                    <th>Status</th>
                                                    @if(Request::segment(1)!="proposal_done")
                                                        <th style="width: 20%">#aksi</th>
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
                                            @if(Auth::user()->group == 1)
											    <td>{{ $v->office->name }}</td>
                                            @endif
											<td>
                                                @if(Auth::user()->group == 1)
                                                    
                                                    @if($v->status=="Masuk")
                                                        <div class="badge badge-success">Usulan Masuk</div>
                                                    @endif
                                                    @if(Request::segment(1)=="proposal_process")
                                                        <div class="badge badge-warning">Sedang Diproses</div>
                                                    @endif
                                                    @if($v->status=="Selesai")
                                                        <div class="badge badge-success">Telah Diverifikasi dan Menunggu Perbaikan Admin</div>
                                                    @endif
                                                @elseif(Auth::user()->group == 3)
                                                    @if($v->status=="Masuk")
                                                        <div class="badge badge-success">Telah Dikirim Ke Admin</div>
                                                    @endif
                                                    @if(Request::segment(1)=="proposal_process")
                                                        <div class="badge badge-warning">Sedang Diproses Oleh Admin</div>
                                                    @endif
                                                    @if(Request::segment(1)=="proposal_revision")
                                                        <div class="badge badge-danger">Usul Tidak Lengkap</div>
                                                    @endif
                                                    @if($v->status=="Selesai")
                                                        <div class="badge badge-success">Telah Diverifikasi dan Menunggu Perbaikan Admin</div>
                                                    @endif
                                                @endif    
                                            </td>
                                            
                                            @if($v->status!="Selesai")
											<td>
                                                @if(Auth::user()->group == 1)
                                                    @if($v->status=="Masuk")
												        <a href="{{ url(Request::segment(1).'/control_sheet/'.$v->id ) }}" class="btn btn-sm btn-flat btn-success">Verifikasi</a>
                                                    @elseif($v->status=="Proses")
												        <a href="{{ url(Request::segment(1).'/disposition_sheet/'.$v->id ) }}" class="btn btn-sm btn-flat btn-primary btn-block">Cetak Disposisi</a>
												        <a href="{{ url(Request::segment(1).'/disposition/'.$v->id ) }}" class="btn btn-sm btn-flat btn-success btn-block">Proses Disposisi</a>
                                                    @endif
                                                @elseif(Auth::user()->group == 3)
                                                    @if($v->status=="Perbaiki")
												        <a href="{{ url(Request::segment(1).'/edit/'.$v->id ) }}" class="btn btn-sm btn-flat btn-warning">Perbaiki</a>
                                                    @else
                                                        <a href="{{ url(Request::segment(1).'/detail/'.$v->id ) }}" class="btn btn-sm btn-flat btn-info">Detail</a>
                                                    @endif
                                                @endif
											</td>
                                            @endif
										</tr>
                                        
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