@extends('admin.layout')
@section('konten')
        <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3>{{ __('PEGAWAI') }}</h3>
								</div>
								<div class="card-body">
									<form action="{{ url('/pegawai/search') }}" method="GET">
									<div class="row">
										<div class="col-md-9">
											@if(Auth::user()->group==1)
												<a href="{{ url('/pegawai/create') }}" class="btn btn-success btn-flat" title="Tambah Data">Tambah</a>
												<a href="{{ url('/pegawai') }}" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>
											@else
												<a href="{{ url('/pegawai') }}" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>    
											@endif
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
												<th>NIP</th>
												<th>Nama Pegawai</th>
												<th>Jenis Kelamin</th>
												<th>Foto</th>
												@if(Auth::user()->group==1)
													<th style="width: 22%">#aksi</th>
												@endif
											</tr>
											</thead>
											<tbody>
											@foreach($pegawai as $v)
											<tr>
												<td>{{ ($pegawai ->currentpage()-1) * $pegawai ->perpage() + $loop->index + 1 }}</td>
												<td>{{ $v->nip }}</td>
												<td>{{ $v->nama_pegawai }}</td>
												<td>{{ $v->jenis_kelamin }}</td>
												
												<td><center>
												@if($v->foto)
															<img src="{{ asset('storage/upload/foto_pegawai/thumbnail/'.$v->foto) }}" class="img-circle" alt="User Image"  width="150px" height="150px">
														@else
															<img src="{{ asset('upload/user/15.jpg') }}" class="img-circle" alt="User Image" width="150px" height="150px">
														@endif
												</td>
												@if(Auth::user()->group==1)
												<td>
													<a href="{{ url('/arsip_digital/'.$v->id ) }}" class="btn btn-xs btn-primary btn-block">Arsip Digital</a>
													<a href="{{ url('/pegawai/edit/'.$v->id ) }}" class="btn btn-xs btn-warning btn-block">Edit</a>
													<a href="{{ url('/pegawai/hapus/'.$v->id ) }}" class="btn btn-xs btn-danger btn-block" onclick="return confirm('Anda Yakin ?');">Hapus</a>
												</td>
												@endif
											</tr>

											@endforeach
											</tbody>
										</table>
									</div><br>
									<div align="right">{{ $pegawai->appends(Request::only('search'))->links() }}</div>
								</div>
							</div>
						</div>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
@endsection