@extends('template')

@section('content')
<div class="container-fluid">        
    <div class="card card-success">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="card mb-2 bg-gradient-dark">
                    <img class="card-img-top" src="<?php echo asset('public/adminlte/dist/img/photo1.png')?>" alt="Dist Photo 1">
                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                        <h4 class="card-title text-primary text-white">Travel Orders</h4>
                        <p class="card-text text-white pb-2 pt-1">Module for Travel Orders</p>
                        <a href="{{ route('travel.index') }}" class="text-white">Apply </a>
                    </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="card mb-2">
                    <img class="card-img-top" src="<?php echo asset('public/adminlte/dist/img/photo2.png')?>" alt="Dist Photo 2">
                    <div class="card-img-overlay d-flex flex-column justify-content-center">
                        <h5 class="card-title text-white mt-5 pt-2">Leave</h5>
                        <p class="card-text pb-2 pt-1 text-white">
                        Module for leave application
                        </p>
                        <a href="#" class="text-white">Apply</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="card mb-2">
                    <img class="card-img-top" src="<?php echo asset('public/adminlte/dist/img/photo3.jpg')?>" alt="Dist Photo 3">
                    <div class="card-img-overlay">
                        <h5 class="card-title text-primary">Card Title</h5>
                        <p class="card-text pb-1 pt-1 text-white">
                        Lorem ipsum dolor <br>
                        sit amet, consectetur <br>
                        adipisicing elit sed <br>
                        do eiusmod tempor. </p>
                        <a href="#" class="text-primary">Last update 3 days ago</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end container-fluid -->
@endsection
