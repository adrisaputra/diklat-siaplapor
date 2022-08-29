@extends('admin.layout')
@section('konten')
        <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									<h3>Edit {{ __($title) }}</h3>
								</div>
								<div class="card-body">
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
									<form action="{{ url('/'.Request::segment(1).'/edit/'.$pegawai[0]->id.'/'.$arsip_digital->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
									{{ csrf_field() }}
									<input type="hidden" name="_method" value="PUT">
									<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Nama Arsip <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input type="text" name="nama_arsip" class="form-control @if ($errors->has('nama_arsip')) is-invalid @endif " value="{{ $arsip_digital->nama_arsip }}">
												@if ($errors->has('nama_arsip')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('nama_arsip') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right">Berkas Arsip Digital <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 100 Mb (jpg,jpeg,png,pdf)</i></span><br>
												<input type="file" name="arsip_digital"  class="form-control @if ($errors->has('arsip_digital')) is-invalid @endif ">
												@if ($errors->has('arsip_digital')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('arsip_digital') }}</label>@endif
												@if($arsip_digital->arsip_digital)
													<br>
													<a href="{{ asset('upload/arsip_digital/'.$arsip_digital->arsip_digital) }}" target="_blank" class="btn btn-sm btn-primary" >Lihat File</a>
												@endif
											</div>
										</div>
										<br><br>
										<div class="form-group row">
											<div class="col-sm-10 ml-sm-auto">
												<button type="submit" class="btn btn-success">Simpan</button>
												<button type="reset" class="btn btn-danger">Reset</button>
												<a href="{{ url('/'.Request::segment(1).'/'.$pegawai[0]->id ) }}" class="btn btn-warning">kembali</a>
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