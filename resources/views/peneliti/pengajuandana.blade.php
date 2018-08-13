@extends('layout.peneliti')
@section('title', 'SIMPEL - Form Penggunaan Dana')
@section('styles')

@endsection
@section('content')
<div class="container">
<ol class="breadcrumb" style="font-size: 20px">
	<li><a href="/"></i> Beranda</a></li>
	<li class="active">Pengajuan Dana Kegiatan</li>
</ol>
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="panel panel-default">
			<div class="container-fluid">
				<div class="panel-body">
					<div style="text-align: center">
						<h2 class="hidden-xs" style="color: #448aff;text-align: center;"> Form Pengajuan Penggunaan Dana </h2>
						<h3 class="hidden-xs" style="color: #808080;text-align: center">{{$kegiatan->nama_kegiatan}}</h3>
					</div>
					<hr>
					<form method="POST" action="{{url('/mengajukanDana')}}">
						<input type="text" name="id_kegiatan" id="id_kegiatan" value="{{$kegiatan->id}}" hidden>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="exampleInputEmail1">Tanggal Pengajuan</label>
										<input type="date" class="form-control" id="" name="tanggal" required>
									</div>
								</div>
							</div>
							<div class="table table-responsive">
							<table id="data_table" class="table table-striped">
								<thead>
									<tr>
										<th class="col-md-4">Keterangan</th>
										<th class="col-md-2">Jumlah</th>
										<th class="col-md-2">Unit jumlah</th>
										<th class="col-md-2">Perkiraan biaya</th>
										<th class="col-md-2">Subtotal</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<input type="text" class="form-control" id="keterangan0" name="keterangan[]" required>
										</td>
										<td>
											<input type="text" class="form-control" id="jumlah0" name="jumlah[]" oninput="subtotals(0)">
											<span id="alertjumlah0" style="color: red"></span>
										</td>
										<td>
											<input type="text" class="form-control" id="unit0" name="unit[]" placeholder="ex : kg, ml, lusin, dll">
										</td>
										<td>
											<input type="text" class="form-control" id="nominal0" name="nominal[]" oninput="subtotals(0)" required>
											<span id="alertnominal0" style="color: red"></span>
										</td>
										<td>
											<input type="text" class="form-control uang" id="subtotal0" name="subtotal[]" readonly>
										</td>
										<td>
											<button class="btn btn-danger" onclick="myDeleteFunction(this)"><i class="fas fa-trash-alt"></i> Delete</button>
										</td>
									</tr>
								</tbody>

								<tfoot>
									<tr>
										<td colspan="4">
											<button class="btn btn-primary" onclick=" myCreateFunction()"><i class="fas fa-plus"></i> Tambah</button>
										</td>
									</tr>
								</tfoot>
						
							</table>
							</div>
						<button id="simpan" type="submit" class="btn btn-success btn-lg pull-right">Simpan</button>
						{{csrf_field()}}
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection

@section('script')
{{-- <script src="{{URL::asset('js/jquery.mask.js')}}"></script>
 --}}{{-- <script type="text/javascript">
    $(document).ready(function(){
        	$(".form control uang").mask('00000,000,000,000,000.0000', {reverse: true});
    	})
</script> --}}

<script type="text/javascript">
	var t = $('#data_table').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true
    })

	var statusButton = true

  function myCreateFunction() {
      var table = document.getElementById("data_table");
      var row = table.insertRow(1);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      var cell5 = row.insertCell(4);
      var cell6 = row.insertCell(5);

  		let count = table.rows.length - 3

      cell1.innerHTML = '<input type="text" class="form-control" id="keterangan'+count+'" name="keterangan[]" required><br>';
      cell2.innerHTML = '<input type="text" class="form-control" id="jumlah'+count+'" name="jumlah[]" oninput="subtotals('+count+')"><span id="alertjumlah'+count+'" style="color: red"></span><br>';
      cell3.innerHTML =  '<input type="text" class="form-control" id="unit'+count+'" name="unit[]" placeholder="ex : kg, ml, lusin"><br>'; 
      cell4.innerHTML = '<input type="text" class="form-control" id="nominal'+count+'" name="nominal[]" oninput="subtotals('+count+')" required><span id="alertnominal'+count+'" style="color: red"></span><br>'; 
      cell5.innerHTML =  '<input type="text" class="form-control" id="subtotal'+count+'" name="subtotal[]" readonly><br>';
      cell6.innerHTML = '<button class="btn btn-danger" onclick="myDeleteFunction(this)"><i class="fas fa-trash-alt"></i> Delete</button><br><br><br>';

  }

  function myDeleteFunction(self) {
    // console.log($(self).closest("tr").index())
      document.getElementById("data_table").deleteRow($(self).closest("tr").index()+1);
      let tables = document.getElementById("data_table");
	  let trlength = tables.rows.length - 2
	  if(trlength == 0){
			document.getElementById("simpan").setAttribute("disabled","disabled");
		}		
  }

	function subtotals(count){
		var jumlah = 'jumlah'
		var alertjumlah = 'alertjumlah'
		var nominal = 'nominal'
		var alertnominal = 'alertnominal'
		var subtotal = 'subtotal'
		var subs = '#subtotal'

		jumlah = jumlah + count
		alertjumlah = alertjumlah + count
		nominal = nominal + count
		alertnominal = alertnominal + count
		subtotal = subtotal + count
		subs = subs + count


		if(document.getElementById(jumlah).value!="" && document.getElementById(nominal).value!=""){
			document.getElementById(subtotal).value=document.getElementById(jumlah).value*document.getElementById(nominal).value;
			
		}
		else if(document.getElementById(jumlah).value==""){
			document.getElementById(subtotal).value=document.getElementById(nominal).value;
		}

		else if(document.getElementById(jumlah).value!="" && document.getElementById(jumlah).value == ""){
			document.getElementById(subtotal).value=document.getElementById(nominal).value;
		}

		if(document.getElementById(nominal).value!="" && document.getElementById(nominal).value.search(/[A-Za-z ~ ` ! @ # $ % ^ & * ( ) _ - + = | \ / ' ' " " ; : ? > . < ,]/g) !== -1 || document.getElementById(nominal).value!="" && document.getElementById(nominal).value == ""){
			document.getElementById(alertnominal).innerHTML = "Isi dengan angka";
			document.getElementById(subtotal).value="";
			document.getElementById("simpan").setAttribute("disabled","disabled");
		}
		else{
			document.getElementById(alertnominal).innerHTML = "";
		}

		if(document.getElementById(jumlah).value!="" && document.getElementById(jumlah).value.search(/[A-Za-z ~ ` ! @ # $ % ^ & * ( ) _ - + = | \ / ' ' " " ; : ? > . < ,]/g) !== -1 ){
			document.getElementById(alertjumlah).innerHTML = "Isi dengan angka";
			document.getElementById(subtotal).value="";
			document.getElementById("simpan").setAttribute("disabled","disabled");
		}
		else{
			document.getElementById(alertjumlah).innerHTML = "";
		}

		
		// console.log(count);
		let tables = document.getElementById("data_table");
		let trlength = tables.rows.length - 2
		let tableLength;
		
		if (count > trlength){
			tableLength = count + 1
		} else {
			tableLength = trlength
		}

		for(var i=0; i<tableLength; i++){
			let jmlh = 'jumlah'
			let nom = 'nominal'
	
			jmlh = jmlh + i
			nom = nom + i

			if(document.getElementById(jmlh) != null && document.getElementById(nom) != null){
				if(document.getElementById(jmlh).value!="" && document.getElementById(jmlh).value.search(/[A-Za-z ~ ` ! @ # $ % ^ & * ( ) _ - + = | \ / ' ' " " ; : ? > . < ,]/g) !== -1 ){
					this.statusButton = false
				
					break
				}
				else{
					this.statusButton = true
				}

				if(document.getElementById(nom).value!="" && document.getElementById(nom).value.search(/[A-Za-z ~ ` ! @ # $ % ^ & * ( ) _ - + = | \ / ' ' " " ; : ? > . < ,]/g) !== -1 ){
					this.statusButton = false
					break
				}
				else{
					this.statusButton = true
				}
			}
		}


		if(this.statusButton){
			document.getElementById("simpan").removeAttribute("disabled","disabled");
		}		

	}

</script>


@endsection
