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
								<h4>Add user</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('acceuil')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add user </li>
								</ol>
							</nav>
						</div>
					
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					
					
						<form action="{{route('createadmin')}}" method="POST" id="form" enctype="multipart/Form-data">
                            	 	   @csrf 
							<h5>Information </h5>
							<br>
							<section>
						
                                 


							
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
									
											<label >Name & Family name  </label>
											 <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
											
										
											
										</div>
									</div>
									
										<div class="col-md-4">
										<div class="form-group">
											<label>Email </label>
											  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Role </label>
 
                                                      <select name="role" class="form-control" required>
                                                      	 <option value=""></option>
                                                         <option value="super admin">Super admin</option>
                                                         <option value="Admin">Admin </option>
                                                         <option value="Superviseur">Superviseur</option>
                                                         <option value="User">User </option>
                                                         <option value="Guest">Guest </option>
                                                         
                                                      </select>
							            </div>
									</div>
								</div>

									<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Photo </label>
											 <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="photo" required>

                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Password </label>
											 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Confirm Password </label>
											 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
										</div>
									</div>
								</div>
							
							</section>
							<center>
							<button type="submit" onclick="return confirm('Voulez-vous Enregistrer')" class="fc-month-button btn btn-primary active">Add</button>
                            </center>
						</form>
					
				</div>

			

			</div>
		</div></div>
			@endsection
