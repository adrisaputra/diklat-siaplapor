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
						  	<form action="{{ url('/proposal/search') }}" method="GET">
							<div class="row">
								<div class="col-md-9">
									<a href="{{ url('/proposal') }}" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>
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
                                                    <th style="width: 20%">#aksi</th>
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
											<td>{{ $v->status }}</td>
											<td>
												<a href="#" class="btn btn-sm btn-flat btn-info" data-toggle="modal" data-target="#default">Detail</a>
                                                @if(Auth::user()->group == 3)
												    <a href="{{ url('proposal/edit/'.$v->id ) }}" class="btn btn-sm btn-flat btn-warning">Edit</a>
                                                @endif
											</td>
										</tr>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="basicModalLabel1">Detail</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Tanggal Usul</label>
                                                            <label class="col-form-label col-sm-8"> : {{ date('d-m-Y', strtotime($v->date)) }}</label>
                                                        </div>
    
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Jenis Usul</label>
                                                            <label class="col-form-label col-sm-8"> : {{ $v->type }}</label>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Tentang</label>
                                                            <label class="col-form-label col-sm-8"> : {{ $v->about }}</label>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Surat Pengantar</label>
                                                            <label class="col-form-label col-sm-8"> : <a href="{{ asset('upload/cover_letter/'.$v->cover_letter ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></label>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Telaah Staf</label>
                                                            <label class="col-form-label col-sm-8"> : <a href="{{ asset('upload/review_staff/'.$v->review_staff ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></label>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Nota Dinas</label>
                                                            <label class="col-form-label col-sm-8"> : <a href="{{ asset('upload/official_memo/'.$v->official_memo ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></label>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Konsep Persetujuan Naskah Dinas</label>
                                                            <label class="col-form-label col-sm-8"> : <a href="{{ asset('upload/approval_concept/'.$v->approval_concept ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></label>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Draf SK/Pergub/Perda</label>
                                                            <label class="col-form-label col-sm-8"> : <a href="{{ asset('upload/draft/'.$v->draft ) }}" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></label>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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