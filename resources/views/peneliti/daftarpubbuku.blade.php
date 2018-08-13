@extends('layout.peneliti')
@section('title', 'SIMPEL - Daftar Publikasi Buku')
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
							<th></th>
							<th></th>
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
								<td>
									<a href="/getPubbuku/{{$pubbuku->publikasi_buku->id}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
								</td>
								<td>
									<form method="POST" action="{{url('/hapusPubbuku/'.$pubbuku->publikasi_buku->id)}}" enctype="multipart/form-data">
									<input type="hidden" name="_method" value="DELETE"/>
									{{-- <input type="hidden" name="_method" value="PUT"> --}}
									<button type="submit" class="btn btn-danger" id="delete" data-id="{{$pubbuku->publikasi_buku->id}}" data-name="{{$pubbuku->publikasi_buku->judul_buku}}" data-table="publikasi_buku"><i class="fas fa-trash-alt"></i></button>
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