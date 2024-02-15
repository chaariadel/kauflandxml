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
								<h4>Update user </h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('acceuil')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Update user </li>
								</ol>
							</nav>
						</div>
					
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					
					
						<form action="{{route('AdminModifier')}}" method="POST" id="form"enctype="multipart/Form-data" >
                            	 	   @csrf 
							<h5>Information </h5>
							<br>
							<section>
						
                                 


							
								<div class="row">
									<div class="col-md-3">
									<center>
									<div class="men-thumb-item">
										
                                       <label class=newbtn2>
                                       <img id="blah2" src="{{asset('images/'. $admins->photo)}}" class="image_add_article"  width="100">
                                       <input id="certif" class='pis' type="file" name="photo"  value="{{old('photo')}}" onChange="readURL(this);"  >
                                        <!--onChange="readURL(this);"-->
                                       </label>
									   <h6>Photo</h6>
                                     </div>
									 </center>
									</div>
									<div class="col-md-3">
										<div class="form-group">
									
											<label >Name & Family name </label>
											 <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $admins->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
											
										
											
										</div>
									</div>
									
										<div class="col-md-3">
										<div class="form-group">
											<label>Email </label>
											  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $admins->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Role </label>

                                                      <select name="role" class="form-control" >
                                                      	@if($admins->role=='super admin')
                                                         <option value="super admin" selected>Super admin</option>
														 <option value="Superviseur">Superviseur</option>
                                                         <option value="User">User </option>
                                                         <option value="Admin">Admin </option>
                                                         <option value="Guest">Guest </option>
                                                          @elseif($admins->role=='Admin')
                                                         <option value="super admin" >Super admin</option>
														 <option value="Superviseur" >Superviseur</option>
                                                         <option value="User" >User </option>
                                                         <option value="Admin"selected>Admin </option>
                                                         <option value="Guest">Guest </option>
                                                         @elseif($admins->role=='Superviseur')
                                                          <option value="super admin" >Super admin</option>
														 <option value="Superviseur" selected>Superviseur</option>
                                                         <option value="User">User </option>
                                                         <option value="Admin">Admin </option>
                                                         <option value="Guest">Guest </option>
                                                         @elseif($admins->role=='User')
                                                         <option value="super admin" >Super admin</option>
														 <option value="Superviseur" >Superviseur</option>
                                                         <option value="User" selected>User </option>
                                                         <option value="Admin">Admin </option>
                                                         <option value="Guest">Guest </option>
                                                          
                                                         @else
                                                          <option value="super admin" >Super admin</option>
														 <option value="Superviseur" >Superviseur</option>
                                                         <option value="User" >User </option>
                                                         <option value="Admin">Admin </option>
                                                         <option value="Guest"selected>Guest </option>
                                                         @endif
                                                        
                                                      </select>
							            </div>
									</div>
								</div>

								<div class="row">
									
									<div class="col-md-6">
										<div class="form-group">
											<label>Password </label>
											 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror " name="password" autocomplete="new-password">
                                                  @error('password')
                                                   <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                   </span>
                                                  @enderror
                                										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Confirm Password </label>
											 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
										</div>
									</div>
								</div>

								
							
							</section>
							<center>
							<button type="submit" class="fc-month-button btn btn-primary active">Update</button>
                            </center>
						</form>
					
				</div>

			

			</div>

</div>
</div>
<script>
    $('.newbtn2').bind("click", function() {
      $('#certif').click();
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#blah2').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>  
  @endsection