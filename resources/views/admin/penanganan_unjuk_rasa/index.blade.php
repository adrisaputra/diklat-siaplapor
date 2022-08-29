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
									<form action="{{ url('/penanganan_unjuk_rasa/search') }}" method="GET">
									<div class="row">
										<div class="col-md-9">
											@if(Auth::user()->group==1)
												<a href="{{ url('/penanganan_unjuk_rasa/create') }}" class="btn btn-success btn-flat" title="Tambah Data">Tambah</a>
												<a href="{{ url('/penanganan_unjuk_rasa') }}" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>
											@else
												<a href="{{ url('/penanganan_unjuk_rasa') }}" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>    
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
												<th style="width: 60%">Judul</th>
												<th>Tahun</th>
												<th>Arsip</th>
												<th style="width: 16%">Aksi</th>
											</tr>
											</thead>
											<tbody>
											@foreach($penanganan_unjuk_rasa as $v)
											<tr>
												<td>{{ ($penanganan_unjuk_rasa ->currentpage()-1) * $penanganan_unjuk_rasa ->perpage() + $loop->index + 1 }}</td>
												<td>{{ $v->judul }}</td>
												<td>{{ $v->tahun }}</td>
												<td>
													@if($v->arsip_non_litigasi)
														<a href="{{ asset('upload/arsip_non_litigasi/'.$v->arsip_non_litigasi) }}" class="btn btn-sm btn-primary" >Download File</a>
													@endif
												</td>
												<td>
													<a href="{{ url('/penanganan_unjuk_rasa/edit/'.$v->id ) }}" class="btn btn-xs btn-warning">Edit</a>
													<a href="{{ url('/penanganan_unjuk_rasa/hapus/'.$v->id ) }}" class="btn btn-xs btn-danger" onclick="return confirm('Anda Yakin ?');">Hapus</a>
												</td>
											</tr>

											@endforeach
											</tbody>
										</table>
									</div><br>
									<div align="right">{{ $penanganan_unjuk_rasa->appends(Request::only('search'))->links() }}</div>
								</div>
							</div>
						</div>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
@endsection