@extends('adminlte::page')

@section('title', 'Beranda')

@section('content_header')

<h2><br></h2>

@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    Selamat Datang <b>{{Auth::user()->name}}</b>
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

