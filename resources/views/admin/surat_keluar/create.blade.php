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
											<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Surat <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input class="form-control" type="text" name="tanggal_surat" value="{{ old('tanggal_surat') }}">
												@if ($errors->has('tanggal_surat')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('tanggal_surat') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Perihal <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<textarea name="perihal" class="form-control @if ($errors->has('perihal')) is-invalid @endif ">{{ old('perihal') }}</textarea>
												@if ($errors->has('perihal')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('perihal') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> {{ __('Klasifikasi') }}</label>
											<div class="col-sm-9">
												<select class="form-control @if ($errors->has('klasifikasi_id')) is-invalid @endif " name="klasifikasi_id" id="klasifikasi_id" onChange="Tampil()">
													<option value="">- Pilih -</option>
													@foreach ($klasifikasi as $v)
														<option value="{{ $v->kode }}">{{ $v->nama }}</option>
													@endforeach
												</select>
												@if ($errors->has('klasifikasi_id')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('klasifikasi_id') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> No. Surat Terakhir</label>
											<div class="col-sm-9">
											<input type="text" id="no_surat_terakhir" class="form-control" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> No. Surat <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input type="text" name="nomor_surat" id="nomor_surat" class="form-control @if ($errors->has('nomor_surat')) is-invalid @endif " value="{{ old('nomor_surat') }}">
												@if ($errors->has('nomor_surat')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('nomor_surat') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Tujuan Surat <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input type="text" name="tujuan" class="form-control @if ($errors->has('tujuan')) is-invalid @endif " value="{{ old('tujuan') }}">
												@if ($errors->has('tujuan')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('tujuan') }}</label>@endif
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
<script>
	function Tampil() {
		klasifikasi_id = document.getElementById("klasifikasi_id").value;
		// document.getElementById("nomor_surat").value = "W.2.IMI.IMI.1-"+klasifikasi_id+".01.01-";
		url = "{{ url('/get_klasifikasi') }}"
		$.ajax({
			url:""+url+"/"+klasifikasi_id+"",
			success: function(response){
				document.getElementById("no_surat_terakhir").value = response;
			}
		});
		return false;
}

</script>
@endsection