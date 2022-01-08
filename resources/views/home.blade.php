@extends('adminlte::page')

@section('title', 'Beranda')

@section('content_header')
@role('admin')
<h2>Admin</h2>
@endrole

@role('petugas')
<h2>Petugas</h2>
@endrole
@endsection

@section('content')
@role('admin')
<div class="container">
    <div class="row mt-5">
        <div class="col-xl-3 col-md-6">
          <div class="card mb-4" style="width: 18rem;">
               <img src="{{ asset('assets/img/supplier.jpeg') }}" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Total Data Diri Supplier</h5>
             <p class="card-text"> ..... </h3>
            <a href="{{ url('supplier') }}" class="btn btn-primary">Lihat Selengkapnya..</a>
          </div>
         </div>
         </div>
          <div class="col-xl-3 col-md-6">
          <div class="card mb-4" style="width: 18rem;">
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
@endrole
@role('petugas')
<div class="container">
    <div class="row mt-5">
        <div class="col-xl-3 col-md-6">
          <div class="card mb-4" style="width: 18rem;">
               <img src="{{ asset('assets/img/supplier.jpeg') }}" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Total Data Diri Supplier</h5>
             <p class="card-text"> ..... </h3>
            <a href="{{ url('supplier') }}" class="btn btn-primary">Lihat Selengkapnya..</a>
          </div>
         </div>
         </div>
          <div class="col-xl-3 col-md-6">
          <div class="card mb-4" style="width: 18rem;">
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
@endrole
@endsection

@section('css')

@endsection

@section('js')

@endsection
