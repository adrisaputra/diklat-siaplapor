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
									<form action="{{ url('/surat_masuk/search') }}" method="GET">
									<div class="row">
										<div class="col-md-9">
											<a href="{{ url('/surat_masuk/create') }}" class="btn btn-success btn-flat" title="Tambah Data">Tambah</a>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#defaultModalPrimary">Print</button>
											{{--<a href="{{ url('/surat_masuk/report_excel?search='.Request::get('search')) }}" class="btn btn-primary btn-flat" title="Refresh halaman">Print</a>--}}										
											<a href="{{ url('/surat_masuk') }}" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>										
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

									<div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
									<form action="{{ url('/surat_masuk/report_excel') }}" method="GET">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Cetak Surat Masuk</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body m-3">
													<div class="form-group">
														<label class="form-label">Masukkan Tanggal</label>
														<input class="form-control" type="text" name="daterange" value="{{ date('m/d/Y') }} - {{ date('m/d/Y') }}" required>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Print</button>
												</div>
											</div>
										</div>
									</form>
									</div>

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
												<th>No</th>
												<th>Tanggal Surat</th>
												<th style="width: 20%">Perihal</th>
												<th>No. Surat</th>
												<th>Asal Surat</th>
												<th>Dokumen</th>
												<th style="width: 16%">Aksi</th>
											</tr>
											</thead>
											<tbody>
											@foreach($surat_masuk as $v)
											<tr>
												<td>{{ ($surat_masuk ->currentpage()-1) * $surat_masuk ->perpage() + $loop->index + 1 }}</td>
												<td>{{ date('d-m-Y', strtotime($v->tanggal_surat)) }}</td>
												<td>{{ $v->perihal }}</td>
												<td>{{ $v->nomor_surat }}</td>
												<td>{{ $v->pengirim }}</td>
												<td>
													@if($v->arsip_surat_masuk)
														<a href="{{ asset('upload/arsip_surat_masuk/'.$v->arsip_surat_masuk) }}" class="btn btn-sm btn-primary" >Download File</a>
													@endif
												</td>
												<td>
													<a href="{{ url('/surat_masuk/edit/'.$v->id ) }}" class="btn btn-xs btn-warning">Edit</a>
													<a href="{{ url('/surat_masuk/hapus/'.$v->id ) }}" class="btn btn-xs btn-danger" onclick="return confirm('Anda Yakin ?');">Hapus</a>
												</td>
											</tr>

											@endforeach
											</tbody>
										</table>
									</div><br>
									<div align="right">{{ $surat_masuk->appends(Request::only('search'))->links() }}</div>
								</div>
							</div>
						</div>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
@endsection