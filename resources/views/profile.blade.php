@extends('adminlte::page')

@section('title','Dashboard')
@section('content_header')
<br>
<br>
<br>

@stop
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2><div class="card-header">{{ __('Profil') }}</div></h2>
                
                <div class="card-body">
                                <div class="table-responsive">
                                  <center><img src="{{asset('assets/dist/img/user.jpg')}}" alt="AdminLTE Logo" class="" height="200" width="150" style="opacity: .8"> </center>
                                  <br>
                                  <table class="table">
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>{{Auth::user()->name}}</td>

                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>{{Auth::user()->alamat}}</td>

                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td>:</td>
                                            <td>{{Auth::user()->agama}}</td>

                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td>
                                            <td>:</td>
                                            <td>{{Auth::user()->tanggal_lahir}}</td>

                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td>{{Auth::user()->email}}</td>

                                        </tr>
                                        <tr>
                                            <td>Nama Perusahaan</td>
                                            <td>:</td>
                                            <td>{{Auth::user()->nama_perusahaan}}</td>

                                        </tr>
                                      

                                    </table>
                                </div>
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

