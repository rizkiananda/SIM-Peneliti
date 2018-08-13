@extends('layout.peneliti')
@section('title', 'SIMPEL - Daftar Publikasi Jurnal')
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
							<th>Judul Paper</th>
							<th>Nama Jurnal Ilmiah</th>
							<th>Volume dan Halaman</th>
							<th>Status Akreditasi</th>
							<th>URL</th>
							<th>Tahun Terbit</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					@if($peserta_pubjurnals!=null)
						@foreach($peserta_pubjurnals as $peserta_pubjurnal)
							<tr>	
								<td> @foreach($peserta_pubjurnal as $pubjurnal)
										@if($pubjurnal->peneliti->peneliti_psb!=null)
											{{$pubjurnal->peneliti->peneliti_psb->pegawai->nama}},
										@else
											{{$pubjurnal->peneliti->peneliti_nonpsb->nama_peneliti}}
										@endif
									@endforeach
								</td>
								<td>{{$pubjurnal->publikasi_jurnal->judul_artikel}}</td>
								<td>{{$pubjurnal->publikasi_jurnal->nama_berkala}}</td>
								<td>{{$pubjurnal->publikasi_jurnal->volume_halaman}}</td>
								<td>{{$pubjurnal->publikasi_jurnal->status_akreditasi}}</td>
								<td>{{$pubjurnal->publikasi_jurnal->url}}</td>
								<td>{{$pubjurnal->publikasi_jurnal->tahun_terbit}}</td>
								
								<td>
									<a href="/getPubjurnal/{{$pubjurnal->publikasi_jurnal->id}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
								</td>
								<td>
								<form method="POST" action="{{url('/hapusPubjurnal/'.$pubjurnal->publikasi_jurnal->id)}}" enctype="multipart/form-data">
									<input type="hidden" name="_method" value="DELETE"/>
									{{-- <input type="hidden" name="_method" value="PUT"> --}}
									<button type="submit" class="btn btn-danger" id="delete" data-id="{{$pubjurnal->publikasi_jurnal->id}}" data-name="{{$pubjurnal->publikasi_jurnal->judul_artikel}}" data-table="publikasi_jurnal"><i class="fas fa-trash-alt"></i></button>
								{{csrf_field()}}
								</form>
								</td>
								
								
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

<script type="text/javascript">
	@if(Session::has('msg'))
      swal("{{ Session::get('title')}}","{{ Session::get('msg')}}","{{ Session::get('alert-type')}}");
  	@endif
</script>

<script type="text/javascript">
$('button#delete').on('click',function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    var nama = $(e.currentTarget).attr('data-name');
    var tabel = $(e.currentTarget).attr('data-table');
    swal({
      title: 'Hapus',
      text: "Anda yakin akan menghapus "+nama+" ? ",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      buttonsStyling: false
    },
    function (isConfirm) {
        if(isConfirm) form.submit();
    });
  });
</script>
@endsection