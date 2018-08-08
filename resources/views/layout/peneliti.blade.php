<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.css')}}">   
    <link rel="stylesheet" href="{{URL::asset('dist/css/AdminLTE.css')}}">
    <link rel="stylesheet" href="{{URL::asset('dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('fonts/font-awesome.min.css')}}">
    <link href="{{URL::asset('webfonts/fontawesome-all.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/sweetalert.css')}}">
    @yield('styles')
  </head>
  <body class="hold-transition skin-blue sidebar-mini fixed" >
    @include('peneliti.navbar')
    @include('peneliti.menu')
  


    <div class="content-wrapper">

      <section class="content-header">
        <h1>
        @yield('title-header')
        </h1>
        
      </section>

      <section class="content">
        @yield('content')
        @yield('test')
      </section>

    </div>

    <footer class="main-footer">
      <strong>Powered by Biofarmaka</strong>
    </footer>
  </div>

</body>



  <script src="{{URL::asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
  

  <script src="{{URL::asset('bootstrap/js/bootstrap.min.js')}}"></script>

  <script src="{{URL::asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>

  <script src="{{URL::asset('plugins/fastclick/fastclick.js')}}"></script>

  <script src="{{URL::asset('dist/js/app.min.js')}}"></script>

  <script src="{{URL::asset('dist/js/demo.js')}}"></script>
  <script src="{{URL::asset('js/sweetalert.min.js')}}"></script>
   @yield('script')
  <script type="text/javascript">
  $('#kegiatan').on('show.bs.modal', function(event) {
        var link = $(event.relatedTarget);
        var id = link.data('id');
        var modal = $(this);
        console.log(id);
        modal.find('#id_kegiatan').val(id);
        modal.find('#kegiatan_id').val(id);
        modal.find('.tipe_kegiatan').html("");
        modal.find('.nama_kegiatan').html("");
        modal.find('.judul').html("");
        modal.find('.tanggal').html("");
        $.ajax({
          url : 'getKolaborasi/' + id,
          type: "GET",
          dataType: "json",
          success:function(data) {
            console.log('success http get')
            console.log('datanya: ', data);
            $(".tipe_kegiatan").html(data.kegiatan.nama_tipe_kegiatan);
            $(".nama_kegiatan").html(data.kegiatan.nama_kegiatan);
            $(".judul").html(data.berkas.judul);
            $(".tanggal").html(data.kegiatan.tanggal_awal);
          },
          error: function(err){
            console.log('error ', err)
          }
        });

  });

  $('#pubjurnal').on('show.bs.modal', function(event) {
        var link = $(event.relatedTarget);
        var id = link.data('id');
        var modal = $(this);
        console.log(id);
        modal.find('#id_pubjurnal').val(id);
        modal.find('#pubjurnal_id').val(id);
        modal.find('.judul_paper').html("");
        modal.find('.status_akreditasi').html("");
        modal.find('.jurnal_ilmiah').html("");
        modal.find('.url').html("");
        modal.find('.tahun_terbit').html("");
        $.ajax({
          url : 'getKolaborasi/' + id,
          type: "GET",
          dataType: "json",
          success:function(data) {
            console.log('success http get')
            console.log('datanya: ', data);
            $(".judul_paper").html(data.pubjurnal.judul_artikel);
            $(".status_akreditasi").html(data.pubjurnal.status_akreditasi);
            $(".jurnal_ilmiah").html(data.pubjurnal.nama_berkala);
            $(".url").html(data.pubjurnal.url);
            $(".tahun_terbit").html(data.pubjurnal.tahun_terbit);
          },
          error: function(err){
            console.log('error ', err)
          }
        });

  });

  $('#pubbuku').on('show.bs.modal', function(event) {
      var link = $(event.relatedTarget);
      var id = link.data('id');
      var modal = $(this);
      console.log(id);
      modal.find('#id_pubbuku').val(id);
      modal.find('#pubbuku_id').val(id);
      modal.find('.judul_buku').html("");
      modal.find('.book_chapter').html("");
      modal.find('.nama_penerbit').html("");
      modal.find('.tahun_terbit').html("");
      modal.find('.isbn').html("");
      $.ajax({
        url : 'getKolaborasi/' + id,
        type: "GET",
        dataType: "json",
        success:function(data) {
          console.log('success http get')
          console.log('datanya: ', data);
          $(".judul_buku").html(data.pubbuku.judul_buku);
          $(".book_chapter").html(data.pubbuku.judul_book_chapter);
          $(".nama_penerbit").html(data.pubbuku.nama_penerbit);
          $(".tahun_terbit").html(data.pubbuku.tahun_terbit);
          $(".isbn").html(data.pubbuku.isbn);
        },
        error: function(err){
          console.log('error ', err)
        }
      });

  });
</script>

<script type="text/javascript">
  @if(Session::has('msg'))
      swal("{{ Session::get('title')}}","{{ Session::get('msg')}}","{{ Session::get('alert-type')}}");
    @endif
</script>


  </html>