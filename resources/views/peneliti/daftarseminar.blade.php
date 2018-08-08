@extends('layout.peneliti')
@section('title', 'Daftar Seminar Ilmiah')
@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/"> Beranda</a></li>
		<li><a href="/profil">Profil</a></li>
		<li class="active">Daftar Seminar Ilmiah</li>
	</ol>
	<h2>Daftar Seminar Ilmiah</h2>
	<div class="box box-info" style="border: 1px solid #00c0ef; border-top: 5px solid #00c0ef;">
		<div class="box-header with-border">
			<div class="table-responsive">
				<table id="daftar_penelitian" class="table table-striped">
					<thead>
						<tr>
							<th>Peneliti</th>
							<th>Nama Kegiatan</th>
							<th>Judul Paper</th>
							<th>Tanggal</th>
							<th>Lokasi</th>
						</tr>
					</thead>
					<tbody>
					@if($peserta_seminars!=null)
						@foreach($peserta_seminars as $key => $peserta_seminar)
							@if($peserta_seminar[0]->kegiatan!=null)
							<tr>
								<td> 
									@foreach($peserta_seminar as $seminar)
										@if($seminar->peneliti->peneliti_psb!=null)
											{{$seminar->peneliti->peneliti_psb->pegawai->nama}},
										@else
											{{$seminar->peneliti->peneliti_nonpsb->nama_peneliti}}
										@endif
									@endforeach
								</td>
								<td>{{$seminar->kegiatan->nama_kegiatan}}</td>
								<td>{{$seminar->kegiatan->berkas[0]->judul}}</td>
								<td>{{Carbon\Carbon::parse($seminar->kegiatan->tanggal_awal)->format('d F Y')}} - {{Carbon\Carbon::parse($seminar->kegiatan->tanggal_akhir)->format('d F Y')}}</td>
								<td>{{$seminar->kegiatan->lokasi}}</td>
							</tr>
							@endif
						@endforeach
					@else
						<tr>
							<td><br></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
					@endif
				</table>
			</div>
		</div>
	</div>
		
</div>
@endsection

@section('script')
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script type="text/javascript">
    $('#daftar_penelitian').DataTable()
</script>
@endsection