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
									<div class="row">
										<div class="col-md-9">
											<a href="{{ url('/pegawai/edit/'.$pegawai[0]->id) }}" class="btn btn-warning btn-flat" title="Edit Data Pribadi">Edit Data Pribadi</a>    
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
											<tr>
												<td colspan=2>
													<center>
														@if($pegawai[0]->foto)
															<img src="{{ asset('storage/upload/foto_pegawai/thumbnail/'.$pegawai[0]->foto) }}" class="img-circle" alt="User Image"  width="150px" height="150px">
														@else
															<img src="{{ asset('upload/user/15.jpg') }}" class="img-circle" alt="User Image" width="150px" height="150px">
														@endif
														<br><br>
														<p style="font-size:22px;font-weight:bold">{{ $pegawai[0]->nama_pegawai }}</p>
														<p style="font-size:18px;font-weight:bold">{{ $pegawai[0]->nip }}</p>
													</center>
												</td>
											</tr>
											<tr style="background-color: #2196f3;color:white">
												<th style="width: 200px;text-align:center;font-size:16px" colspan=2>DATA PRIBADI</th>
											</tr>
											<tr>
												<th style="width: 200px">Tempat Tanggal Lahir</th>
												<td>: {{ $pegawai[0]->tempat_lahir }}, {{ date('d-m-Y', strtotime($pegawai[0]->tanggal_lahir)) }}</td>
											</tr>
											<tr>
												<th style="width: 200px">Jenis Kelamin</th>
												<td>: {{ $pegawai[0]->jenis_kelamin}}</td>
											</tr>
											<tr>
												<th style="width: 200px">Alamat</th>
												<td>: {{ $pegawai[0]->alamat}}</td>
											</tr>
											<tr>
												<th style="width: 200px">Agama</th>
												<td>: {{ $pegawai[0]->agama}}</td>
											</tr>
											<tr>
												<th style="width: 200px">Gol. Darah</th>
												<td>: {{ $pegawai[0]->gol_darah}}</td>
											</tr>
											<tr>
												<th style="width: 200px">Email</th>
												<td>: {{ $pegawai[0]->email}}</td>
											</tr>
											<tr>
												<th style="width: 200px">No. Telepon</th>
												<td>: {{ $pegawai[0]->telp}}</td>
											</tr>
											<tr>
												<th style="width: 200px">No. KTP</th>
												<td>: {{ $pegawai[0]->no_ktp}}</td>
											</tr>
											<tr>
												<th style="width: 200px">No. BPJS</th>
												<td>: {{ $pegawai[0]->no_bpjs}}</td>
											</tr>
											<tr>
												<th style="width: 200px">Nomor NPWP</th>
												<td>: {{ $pegawai[0]->no_npwp }} </td>
											</tr>
											<tr>
												<th style="width: 200px">Nomor Karpeg</th>
												<td>: {{ $pegawai[0]->no_karpeg }} </td>
											</tr>
											<tr>
												<th style="width: 200px">No. Karsu/Karis</th>
												<td>: {{ $pegawai[0]->no_karsu }} </td>
											</tr>
											<tr>
												<th style="width: 200px">TMT CPNS</th>
												<td>: {{ date('d-m-Y', strtotime($pegawai[0]->tmt_cpns)) }} </td>
											</tr>
											<tr>
												<th style="width: 200px">TMT PNS</th>
												<td>: {{ date('d-m-Y', strtotime($pegawai[0]->tmt_pns)) }} </td>
											</tr>
										</table>
									</div><br>
								</div>
							</div>
						</div>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
@endsection