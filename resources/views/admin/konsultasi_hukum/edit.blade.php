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
									<form action="{{ url('/'.Request::segment(1).'/edit/'.$konsultasi_hukum->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
									{{ csrf_field() }}
									<input type="hidden" name="_method" value="PUT">
									<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Judul <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input type="text" name="judul" class="form-control @if ($errors->has('judul')) is-invalid @endif " value="{{ $konsultasi_hukum->judul }}">
												@if ($errors->has('judul')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('judul') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Deskripsi <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<textarea name="deskripsi" class="form-control @if ($errors->has('deskripsi')) is-invalid @endif ">{{ $konsultasi_hukum->deskripsi }}</textarea>
												@if ($errors->has('deskripsi')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('deskripsi') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Tahun <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<select name="tahun" class="form-control @if ($errors->has('tahun')) is-invalid @endif ">
													<option value=""> -Pilih Tahun-</option>
													@for($i=2019;$i<=date('Y');$i++)
														<option value="{{ $i }}" @if($konsultasi_hukum->tahun==$i) selected @endif> {{ $i }}</option>
													@endfor
												</select>
												@if ($errors->has('tahun')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('tahun') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right">Berkas Arsip Konsultasi Hukum <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 100 Mb (jpg,jpeg,png,pdf)</i></span><br>
												<input type="file" name="arsip_non_litigasi"  class="form-control @if ($errors->has('arsip_non_litigasi')) is-invalid @endif ">
												@if ($errors->has('arsip_non_litigasi')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('arsip_non_litigasi') }}</label>@endif
												@if($konsultasi_hukum->arsip_non_litigasi)
													<br>
													<a href="{{ asset('upload/arsip_non_litigasi/'.$konsultasi_hukum->arsip_non_litigasi) }}" target="_blank" class="btn btn-sm btn-primary" >Lihat File</a>
												@endif
											</div>
										</div>
										<br><br>
										<div class="form-group row">
											<div class="col-sm-10 ml-sm-auto">
												<button type="submit" class="btn btn-success">Simpan</button>
												<button type="reset" class="btn btn-danger">Reset</button>
												<a href="{{ url('/'.Request::segment(1)) }}" class="btn btn-warning">kembali</a>
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