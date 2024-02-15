<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>XML</title>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>



<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
		responsive:true,
		lengthChange:false,
		autoWidth:false,
        dom: 'Bfrtip',
        extend: 'collection',
        buttons: [
          
              {
               extend: 'pdfHtml5',
                exportOptions: {
                   columns: [ 0, 1, 2,3,4]
                               }
              },
             {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2,3,4]
                }
            },
       

            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2,3,4]
                }
            },
            
        ]



    } );
} );
</script>



<link rel="apple-touch-icon" sizes="180x180" href="{{asset('vendors/images/logo.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('vendors/images/logo.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('vendors/images/logo.png')}}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/style.css')}}">

	
</head>
<body>

<!-- header -->
@include('Layouts.header')
<!-- //header -->
<!-- header -->
@include('Layouts.sidebar')
<!-- //header -->

<div class="main-container1">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Source List</h4>
								 @if(Session::has('success'))
        <div class="alert alert-success">
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
       @if(Session::has('danger'))
        <div class="alert alert-danger">
            <p>{{ Session::get('danger') }}</p>
        </div>
    @endif
							</div>
							<div class="clearfix">
                      
                        <form name="frmImage" role="form" method="Post" action="{{route('AjoutXML')}}" ENCTYPE="multipart/Form-data" data-toggle="validator" onsubmit="return validation(thisform)">
						@csrf     
						<div class="pull-right">
                                <button type="submit" name="submit" class="btn pull-right btn-dore">Add XML</button>
                            </div>

                        </form>

                    </div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('acceuil')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">XML</li>
								</ol>
							</nav>
						</div>
					
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Source List</h4>
						<div class="clearfix">
                      
                        <form name="frmImage" role="form" method="Post" action="{{route('convertAndDownloadXmlAll')}}" ENCTYPE="multipart/Form-data" data-toggle="validator" onsubmit="return validation(thisform)">
						@csrf     
						<div class="pull-right">
                                <button type="submit" name="submit" class="btn pull-right btn-dore">Download All </button>
                            </div>

                        </form>

                    </div>
					</div>
					@if ($Sourcetotal==0) 
  <center>
    <h3 class="alert alert-warning">
      <strong> You do not have any sources at the moment</strong>
    </h3>
  </center>
   @else
					<div class="pb-20">
					<table class="table display nowrap" id="example">
							<thead>
								<tr>
								
								<th >Source</th>
                                <th >Action</th>
								
								</tr>
							</thead>
							<tbody>

							@foreach ($sources as $source)
                                <tr>
                                    <td>{{ $source->Source }}</td>
									<td>
                          
						  <div class="dropdown">
							  <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
								  <i class="dw dw-more"></i>
							  </a>
							  <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
							  
						  <form action="{{ route('convertAndDownloadXml') }}" method="POST" >
                        @csrf
                        <input type="hidden" name="source" value="{{ $source->Source }}">
						<a class="dropdown-item" href="#"><button type="submit" class="button2">  <i class="dw dw-download"></i> Download XML</button></a>

                        
                    </form>

					<form action="{{ route('convertAndDownloadCsv') }}" method="POST" >
                        @csrf
                        <input type="hidden" name="source" value="{{ $source->Source }}">
						<a class="dropdown-item" href="#"><button type="submit" class="button2">  <i class="dw dw-download"></i> Download Csv</button></a>

                        
                    </form>

					<form action="{{ route('showFeedData') }}" method="POST" >
                        @csrf
                        <input type="hidden" name="source" value="{{ $source->Source }}">
						<a class="dropdown-item" href="#"><button type="submit" class="button2">  <i class="dw dw-download"></i>  Data list</button></a>

                        
                    </form>

				
							 
						 
								  
							  </div>
						  </div>
					  </td>
                                </tr>
                            @endforeach


							
						
							</tbody>
						</table>
					</div>
				
				</div>
			</div>
		    


					
  @endif 
			
				
			</div>
			

	<!-- footer -->
@include('Layouts.footer')
<!-- //footer -->
</div>
</div>
</body>
	<!-- js -->
	<script src="{{asset('vendors/scripts/core.js')}}"></script>
	<script src="{{asset('vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('vendors/scripts/process.js')}}"></script>
	<script src="{{asset('vendors/scripts/layout-settings.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>

	<script src="{{asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
	<!-- buttons for Export datatable -->
	<script src="{{asset('src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/buttons.print.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/pdfmake.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/vfs_fonts.js')}}"></script>
	<!-- Datatable Setting js -->
	<script src="{{asset('vendors/scripts/datatable-setting.js')}}"></script></body>
</html>