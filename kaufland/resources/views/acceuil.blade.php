@extends('Layouts.template')

@section('title')
Dorra dhahri
@endsection


@section('content')
<div class="main-container">

<div class="card-box pd-20  mb-30">
				<div class="row align-items-center">
				
					<div class="col-md-4">
						<center>
						<img class="hei" src="{{asset('vendors/images/logo.png')}}" alt="">
						</center>
					</div>
					<div class="col-md-8">
						
						<h4 class="font-20 weight-500 mb-10 text-capitalize txtmobile txtmobile1">
						Welcome  </h4>
						<div class="weight-600 font-30 text-blue txtmobile">kaufland</div>
						

						
					</div>
				</div>
			</div>
			  @if(Auth::guard('admin')->user()->role=='super admin' || Auth::guard('admin')->user()->role=='Admin' || Auth::guard('admin')->user()->role=='Superviseur'|| Auth::guard('admin')->user()->role=='User')
			
			
			<div class="row mbr-justify-content-center">

<div class="col-lg-6 mbr-col-md-10">
<a href="" >
	<div class="wrap">
		<div class="ico-wrap">
		<span class="mbr-iconfont fa-user fa"></span>
		</div>
		<div class="text-wrap vcenter">
		<div class="h4 mb-0"></div>
		<div class="weight-600 font-14"><span></span></div>
			
		</div>
	</div>
</a>
</div>
<div class="col-lg-6 mbr-col-md-10">
<a href="" >
	<div class="wrap">
		<div class="ico-wrap">
			<span class="mbr-iconfont fa-book fa"></span>
		</div>
		<div class="text-wrap vcenter">
		<div class="h4 mb-0"></div>
		<div class="weight-600 font-14"><span></span></div>
	</div>
	</div>
</a>
</div>






</div>


			  @endif


</div>
@endsection



<style>

</style>