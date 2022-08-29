@extends('admin.layout')
@section('konten')
        <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									<h3>Tambah {{ __($title) }}</h3>
								</div>
								<div class="card-body">
									<form action="{{ url('/'.Request::segment(1)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
										{{ csrf_field() }}
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Kode <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input type="text" name="kode" class="form-control @if ($errors->has('kode')) is-invalid @endif " value="{{ old('kode') }}">
												@if ($errors->has('kode')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('kode') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Nama <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input type="text" name="nama" class="form-control @if ($errors->has('nama')) is-invalid @endif " value="{{ old('nama') }}">
												@if ($errors->has('nama')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('nama') }}</label>@endif
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