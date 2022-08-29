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
									<form action="{{ url('/'.Request::segment(1).'/edit/'.$arsip_biasa->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
									{{ csrf_field() }}
									<input type="hidden" name="_method" value="PUT">
									<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> No. Surat <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input type="text" name="nomor_arsip" class="form-control @if ($errors->has('nomor_arsip')) is-invalid @endif " value="{{ $arsip_biasa->nomor_arsip }}">
												@if ($errors->has('nomor_arsip')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('nomor_arsip') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Perihal <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<textarea name="perihal" class="form-control @if ($errors->has('perihal')) is-invalid @endif ">{{ $arsip_biasa->perihal }}</textarea>
												@if ($errors->has('perihal')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('perihal') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Surat <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												@php
													$tgl_arsip = substr($arsip_biasa->tanggal_arsip,8,2);
													$bln_arsip = substr($arsip_biasa->tanggal_arsip,5,2);
													$thn_arsip = substr($arsip_biasa->tanggal_arsip,0,4);
												@endphp
												<input class="form-control" type="text" name="tanggal_arsip" value="{{ $bln_arsip }}/{{ $tgl_arsip }}/{{ $thn_arsip }}">
												@if ($errors->has('tanggal_arsip')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('tanggal_arsip') }}</label>@endif
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right">Dokumen <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 100 Mb (jpg,jpeg,png,pdf)</i></span><br>
												<input type="file" name="arsip"  class="form-control @if ($errors->has('arsip')) is-invalid @endif ">
												@if ($errors->has('arsip')) <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email">{{ $errors->first('arsip') }}</label>@endif
												@if($arsip_biasa->arsip)
													<br>
													<a href="{{ asset('upload/arsip/'.$arsip_biasa->arsip) }}" target="_blank" class="btn btn-sm btn-primary" >Lihat File</a>
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