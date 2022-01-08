@extends('adminlte::page')

@section('title', 'Beranda')

@section('content_header')

<h2><br></h2>

@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
          <div class="card" style="width: 18rem;">
               <img src="{{ asset('assets/img/supplier.jpeg') }}" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Total Data Diri Supplier</h5>
             <p class="card-text"> ..... </h3>
            <a href="{{ url('supplier') }}" class="btn btn-primary">Lihat Selengkapnya..</a>
          </div>
         </div>
          <div class="card" style="width: 18rem;">
               <img src="{{ asset('assets/img/customer.png') }}" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Total Data Diri Customer</h5>
             <p class="card-text"> ..... </h3>
            <a href="{{ url('customer') }}" class="btn btn-primary">Lihat Selengkapnya..</a>
          </div>
         </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop

