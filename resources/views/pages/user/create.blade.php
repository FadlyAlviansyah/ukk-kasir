@extends('layouts.main')

@section('header')
  @include('components.header')
@endsection

@section('aside')
  @include('components.aside')
@endsection

@section('content')
<div class="page-wrapper">
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <div class="page-breadcrumb">
      <div class="row align-items-center">
          <div class="col-6">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0 d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">User</li>
                  </ol>
                </nav>
              <h1 class="mb-0 fw-bold">User</h1> 
          </div>
      </div>
  </div>
  <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <form class="form-horizontal form-material mx-2" method="POST" action="{{ route('user.store') }}">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email" class="col-md-12">Email <span class="text-danger">*</span></label>
                      <div class="col-md-12">
                        <input type="email" name="email" id="email" class="form-control form-control-line">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name" class="col-md-12">Nama <span class="text-danger">*</span></label>
                      <div class="col-md-12">
                        <input type="text" name="name" id="name" class="form-control form-control-line">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="role" class="col-md-12">Role <span class="text-danger">*</span></label>
                      <div class="col-md-12">
                        <select class="form-select shadow-none form-control-line" name="role" id="role">
                          <option selected disabled hidden>Pilih role</option>
                          <option value="admin">Admin</option>
                          <option value="cashier">Cashier</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="password" class="col-md-12">Password <span class="text-danger">*</span></label>
                      <div class="col-md-12">
                        <input type="password" name="password" id="password" class="form-control form-control-line">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row justify-content-end">
                  <div class="col text-end">
                    <button type="submit" class="btn btn-primary w-25">Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection