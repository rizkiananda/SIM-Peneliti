@extends('layout.peneliti')
@section('title', 'Daftar Publikasi Jurnal')
@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/"> Beranda</a></li>
		<li><a href="/profil">Profil</a></li>
		<li class="active">Daftar Publikasi Jurnal</li>
	</ol>
	<h2>Daftar Publikasi Jurnal</h2>
	<div class="box box-info" style="border: 1px solid #00c0ef; border-top: 5px solid #00c0ef;">
		<div class="box-header with-border">
			<div class="table-responsive">
				<table id="daftar_penelitian" class="table table-striped">
					<thead>
						<tr>
							<th>Peneliti</th>
							<th>Judul Buku</th>
							<th>Judul Book Chapter</th>
							<th>Tahun Terbit</th>
							<th>Nama Penerbit</th>
							<th>ISBN</th>
						</tr>
					</thead>
					<tbody>
					@if($peserta_pubbukus!=null)
						@foreach($peserta_pubbukus as $peserta_pubbuku)
							<tr>	
								<td> @foreach($peserta_pubbuku as $pubbuku)
										@if($pubbuku->peneliti->peneliti_psb!=null)
											{{$pubbuku->peneliti->peneliti_psb->pegawai->nama}},
										@else
											{{$pubbuku->peneliti->peneliti_nonpsb->nama_peneliti}}
										@endif
									@endforeach
								</td>
								<td>{{$pubbuku->publikasi_buku->judul_buku}}</td>
								<td>{{$pubbuku->publikasi_buku->judul_book_chapter}}</td>
								<td>{{$pubbuku->publikasi_buku->tahun_terbit}}</td>
								<td>{{$pubbuku->publikasi_buku->nama_penerbit}}</td>
								<td>{{$pubbuku->publikasi_buku->isbn}}</td>
							</tr>
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