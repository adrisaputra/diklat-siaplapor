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
									<form action="{{ url('/surat_keluar/search') }}" method="GET">
									<div class="row">
										<div class="col-md-6">
											<a href="{{ url('/surat_keluar/create') }}" class="btn btn-success btn-flat" title="Tambah Data">Tambah</a>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#defaultModalPrimary">Print</button>
											{{--<a href="{{ url('/surat_keluar/report_excel?klasifikasi_id='.Request::get('klasifikasi_id').'&search='.Request::get('search')) }}" class="btn btn-primary btn-flat" title="Refresh halaman">Print</a>--}}								
											<a href="{{ url('/surat_keluar') }}" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>										
										</div>
										<div class="col-sm-3">
											<select class="form-control @if ($errors->has('klasifikasi_id')) is-invalid @endif " name="klasifikasi_id" id="klasifikasi_id">
												<option value="">- Pilih Kode-</option>
												@foreach ($klasifikasi as $v)
													<option value="{{ $v->id }}"  @if(Request::get('klasifikasi_id')==$v->id) selected @endif>{{ $v->nama }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-md-3">
											<div class="input-group">
												<input type="text" class="form-control" name="search" placeholder="Cari Data" value="{{ Request::get('search') }}">
												<span class="input-group-btn">
													<input type="submit" name="submit" class="btn btn-info btn-flat" value="Cari">
												</span>
											</div>
										</div>
									</div>
									</form><br>

									<div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
									<form action="{{ url('/surat_keluar/report_excel') }}" method="GET">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Cetak Surat Keluar</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body m-3">
													<div class="form-group">
														<label class="form-label">Masukkan Tanggal</label>
														<input class="form-control" type="text" name="daterange" value="{{ date('m/d/Y') }} - {{ date('m/d/Y') }}" required>
													</div>
													<div class="form-group">
														<select class="form-control @if ($errors->has('klasifikasi_id')) is-invalid @endif " name="klasifikasi_id">
															<option value="">- Pilih Kode-</option>
															@foreach ($klasifikasi as $v)
																<option value="{{ $v->id }}"  @if(Request::get('klasifikasi_id')==$v->id) selected @endif>{{ $v->nama }}</option>
															@endforeach
														</select>
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
												<th>Tujuan Surat</th>
												<th>Jenis Surat</th>
												<th style="width: 16%">Aksi</th>
											</tr>
											</thead>
											<tbody>
											@foreach($surat_keluar as $v)
											<tr>
												<td>{{ ($surat_keluar ->currentpage()-1) * $surat_keluar ->perpage() + $loop->index + 1 }}</td>
												<td>{{ date('d-m-Y', strtotime($v->tanggal_surat)) }}</td>
												<td>{{ $v->perihal }}</td>
												<td>{{ $v->nomor_surat }}</td>
												<td>{{ $v->tujuan }}</td>
												<td>{{ $v->klasifikasi->nama }}</td>
												<td>
													<a href="{{ url('/surat_keluar/edit/'.$v->id ) }}" class="btn btn-xs btn-warning">Edit</a>
													<a href="{{ url('/surat_keluar/hapus/'.$v->id ) }}" class="btn btn-xs btn-danger" onclick="return confirm('Anda Yakin ?');">Hapus</a>
												</td>
											</tr>

											@endforeach
											</tbody>
										</table>
									</div><br>
									<div align="right">{{ $surat_keluar->appends(Request::only('search','klasifikasi_id'))->links() }}</div>
								</div>
							</div>
						</div>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
@endsection