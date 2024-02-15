@extends('Layouts.template')

@section('title')
Dorra dhahri
@endsection


@section('content')

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>User</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('acceuil')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page"> User</li>
								</ol>
							</nav>
						</div>
					
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					
					
						<form action="{{route('listadmin')}}" method="POST" id="form" enctype="multipart/Form-data">
                            	 	   @csrf 
							<h5>Information </h5>
							<br>
							<section>
						
                                 


							
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label >Name & Family name </label>
											 <input type="text" class="form-control " name="name" value="{{ $admins->name }}" readonly="readonly">
										</div>
									</div>
										<div class="col-md-6">
										<div class="form-group">
											<label>Email </label>
											  <input type="email" class="form-control" name="email" value="{{ $admins->email }}"  readonly="readonly">
                           			    </div>
									</div>
									
								</div>

									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
											<label>Role </label>
                                                <input type="text" class="form-control" name="role" value="{{ $admins->role }}" required  readonly="readonly">
                                                   
							            </div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Password </label>
											 <input type="text" class="form-control" name="motdepass"value="{{ $admins->motdepass }}" readonly>


										</div>
									</div>
									

								</div>
							
							</section>
							<center>
							<button type="submit" class="fc-month-button btn btn-primary active">Back</button>
                            </center>
						</form>
					
				</div>

			

			</div>
	
</div>
</div>
@endsection