@extends('admin.layout')
@section('konten')
        <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3>{{ __($title) }}</h3>
								</div>
								<div class="card-body">
									<form action="{{ url('/'.Request::segment(1).'/search/'.$pegawai[0]->id) }}" method="GET">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label >NIP</label>
												<input type="text" class="form-control" placeholder="NIP" value="{{ $pegawai[0]->nip }}" disabled>
											</div>

										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label >Nama Pegawai</label>
												<input type="text" class="form-control" placeholder="Nama Pegawai" value="{{ $pegawai[0]->nama_pegawai }}" disabled>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-9">
											<a href="{{ url('/'.Request::segment(1).'/create/'.$pegawai[0]->id) }}" class="btn btn-success btn-flat" title="Tambah Data">Tambah</a>
											<a href="{{ url('/'.Request::segment(1).'/'.$pegawai[0]->id) }}" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>    
											<a href="{{ url('/pegawai') }}" class="btn btn-danger btn-flat" title="Kembali">Kembali</a>  
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
									  <div class="alert alert-primary alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<div class="alert-message">
												{{ $message }}
											</div>
										</div>
									@endif
									<div class="table-responsive table-bordered">
										<table class="table mb-0">
											<thead>
											<tr style="background-color: gray;color:white">
												<th style="width: 60px">No</th>
												<th>Nama Arsip</th>
												<th>Arsip</th>
												<th style="width: 20%">#aksi</th>
											</tr>
											</thead>
											<tbody>
											@foreach($arsip_digital as $v)
											<tr>
												<td>{{ ($arsip_digital ->currentpage()-1) * $arsip_digital ->perpage() + $loop->index + 1 }}</td>
												<td>{{ $v->nama_arsip }}</td>
												<td>
													@if($v->arsip_digital)
														<a href="{{ asset('upload/arsip_digital/'.$v->arsip_digital) }}" class="btn btn-sm btn-primary" >Download File</a>
													@endif
												</td>
												<td>
													<a href="{{ url('/'.Request::segment(1).'/edit/'.$pegawai[0]->id.'/'.$v->id ) }}" class="btn btn-xs btn-flat btn-warning">Edit</a>
													<a href="{{ url('/'.Request::segment(1).'/hapus/'.$pegawai[0]->id.'/'.$v->id ) }}" class="btn btn-xs btn-flat btn-danger" onclick="return confirm('Anda Yakin ?');">Hapus</a>
												</td>
											</tr>

											@endforeach
											</tbody>
										</table>
									</div><br>
									<div align="right">{{ $arsip_digital->appends(Request::only('search'))->links() }}</div>
								</div>
							</div>
						</div>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
@endsection