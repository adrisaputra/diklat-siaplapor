@extends('admin.layout')
@section('konten')
        <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									<h3>Edit Pegawai</h3>
								</div>
								<div class="card-body">
									<form action="{{ url('/pegawai/edit/'.$pegawai->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
									{{ csrf_field() }}
									<input type="hidden" name="_method" value="PUT">
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> NIP <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-10">
												<input type="text" name="nip" class="form-control @if ($errors->has('nip')) is-invalid @endif " value="{{ $pegawai->nip }}">
												<input type="hidden" class="form-control" placeholder="NIP" name="nip2" value="{{ $pegawai->nip }}" >
												@if ($errors->has('nip')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('nip') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Nama Pegawai <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-10">
												<input type="text" name="nama_pegawai" class="form-control @if ($errors->has('nama_pegawai')) is-invalid @endif " value="{{ $pegawai->nama_pegawai  }}">
												@if ($errors->has('nama_pegawai')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('nama_pegawai') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Tempat Lahir</label>
											<div class="col-sm-10">
												<input type="text" name="tempat_lahir" class="form-control @if ($errors->has('tempat_lahir')) is-invalid @endif " value="{{ $pegawai->tempat_lahir }}">
												@if ($errors->has('tempat_lahir')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('tempat_lahir') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Tanggal Lahir</label>
											<div class="col-sm-10">
												<input class="form-control" type="text" name="tanggal_lahir" value="	@php
																										$date=date_create(" $pegawai->tanggal_lahir ");
																										echo date_format($date,"m/d/Y");
																										@endphp">
												@if ($errors->has('tanggal_lahir')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('tanggal_lahir') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Jenis Kelamin</label>
											<div class="col-sm-10">
												<select  class="form-control" name="jenis_kelamin">
													<option value=""> -Pilih Jenis Kelamin-</option>
													<option value="Pria" @if($pegawai->jenis_kelamin=="Pria") selected @endif> Pria</option>
													<option value="Wanita" @if($pegawai->jenis_kelamin=="Wanita") selected @endif> Wanita</option>
												</select>
												@if ($errors->has('jenis_kelamin')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('jenis_kelamin') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Alamat</label>
											<div class="col-sm-10">
												<textarea name="alamat" class="form-control @if ($errors->has('alamat')) is-invalid @endif ">{{ $pegawai->alamat }}</textarea>
												@if ($errors->has('alamat')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('alamat') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Agama</label>
											<div class="col-sm-10">
												<select  class="form-control" name="agama">
													<option value=""> -Pilih Agama-</option>
													<option value="Islam" @if($pegawai->agama=="Islam") selected @endif> Islam</option>
													<option value="Katolik" @if($pegawai->agama=="Katolik") selected @endif> Katolik</option>
													<option value="Hindu" @if($pegawai->agama=="Hindu") selected @endif> Hindu</option>
													<option value="Budha" @if($pegawai->agama=="Budha") selected @endif> Budha</option>
													<option value="Sinto" @if($pegawai->agama=="Sinto") selected @endif> Sinto</option>
													<option value="Konghucu" @if($pegawai->agama=="Konghucu") selected @endif> Konghucu</option>
													<option value="Protestan" @if($pegawai->agama=="Protestan") selected @endif> Protestan</option>
												</select>
												@if ($errors->has('agama')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('agama') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Gol. Darah</label>
											<div class="col-sm-10">
												<select  class="form-control" name="gol_darah">
													<option value=""> -Pilih Gol. Darah-</option>
													<option value="A" @if($pegawai->gol_darah=="A") selected @endif> A</option>
													<option value="B" @if($pegawai->gol_darah=="B") selected @endif> B</option>
													<option value="AB" @if($pegawai->gol_darah=="AB") selected @endif> AB</option>
													<option value="O" @if($pegawai->gol_darah=="O") selected @endif> O</option>
												</select>
												@if ($errors->has('gol_darah')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('gol_darah') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Email</label>
											<div class="col-sm-10">
												<input type="email" name="email" class="form-control @if ($errors->has('email')) is-invalid @endif " value="{{ $pegawai->email }}">
												@if ($errors->has('email')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('email') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> No. Telepon</label>
											<div class="col-sm-10">
												<input type="text" name="telp" class="form-control @if ($errors->has('telp')) is-invalid @endif " value="{{ $pegawai->telp }}">
												@if ($errors->has('telp')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('telp') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right">No. KTP</label>
											<div class="col-sm-10">
												<input type="text" name="no_ktp" class="form-control @if ($errors->has('no_ktp')) is-invalid @endif " value="{{ $pegawai->no_ktp }}">
												@if ($errors->has('no_ktp')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('no_ktp') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> No. BPJS</label>
											<div class="col-sm-10">
												<input type="text" name="no_bpjs" class="form-control @if ($errors->has('no_bpjs')) is-invalid @endif " value="{{ $pegawai->no_bpjs }}">
												@if ($errors->has('no_bpjs')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('no_bpjs') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> No. NPWP</label>
											<div class="col-sm-10">
												<input type="text" name="no_npwp" class="form-control @if ($errors->has('no_npwp')) is-invalid @endif " value="{{ $pegawai->no_npwp }}">
												@if ($errors->has('no_npwp')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('no_npwp') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> No. Karpeg</label>
											<div class="col-sm-10">
												<input type="text" name="no_karpeg" class="form-control @if ($errors->has('no_karpeg')) is-invalid @endif " value="{{ $pegawai->no_karpeg }}">
												@if ($errors->has('no_karpeg')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('no_karpeg') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> No. Karsu/Karis</label>
											<div class="col-sm-10">
												<input type="text" name="'no_karsu'" class="form-control @if ($errors->has('no_karsu')) is-invalid @endif " value="{{ $pegawai->no_karsu }}">
												@if ($errors->has('no_karsu')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('no_karsu') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> TMT CPNS</label>
											<div class="col-sm-10">
												<input class="form-control" type="text" name="tmt_cpns" value="	@php
																										$date=date_create(" $pegawai->tmt_cpns ");
																										echo date_format($date,"m/d/Y");
																										@endphp">
												@if ($errors->has('tmt_cpns')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('tmt_cpns') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> TMT PNS</label>
											<div class="col-sm-10">
												<input class="form-control" type="text" name="tmt_pns" value="	@php
																										$date=date_create(" $pegawai->tmt_pns ");
																										echo date_format($date,"m/d/Y");
																										@endphp">
												@if ($errors->has('tmt_pns')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('tmt_pns') }}</label>@endif
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right">Foto</label>
											<div class="col-sm-10">
												<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 500 Kb (jpg,jpeg,png)</i></span><br>
												<input type="file" name="foto" >
												@if ($errors->has('foto')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('foto') }}</label>@endif
												@if($pegawai->foto)
													<br>
													<img src="{{ asset('storage/upload/foto_pegawai/thumbnail/'.$pegawai->foto) }}" width="150px" height="150px">
												@endif
											</div>
										</div>
										<br><br>
										<div class="form-group row">
											<div class="col-sm-10 ml-sm-auto">
												<button type="submit" class="btn btn-success">Simpan</button>
												<button type="reset" class="btn btn-danger">Reset</button>
												<a href="{{ url('/pegawai') }}" class="btn btn-warning">kembali</a>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
@endsection