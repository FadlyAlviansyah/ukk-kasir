@extends('layouts.main')

@section('header')
  @include('components.header')
@endsection

@section('aside')
  @include('components.aside')
@endsection

@section('content')
<div class="page-wrapper">
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
            <form class="form-horizontal form-material mx-2" method="POST" action="{{ route('user.update', $user['id']) }}">
              @csrf
              @method('PATCH')
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email" class="col-md-12">Email <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                      <input type="email" name="email" id="email" value="{{ $user['email'] }}" class="form-control form-control-line @error('email') is-invalid @enderror">
                      @error('email')
                        <div class="invalid-feedback">
                          Email harus diisi!
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name" class="col-md-12">Nama <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                      <input type="text" name="name" id="name" value="{{ $user['name'] }}" class="form-control form-control-line @error('name') is-invalid @enderror">
                      @error('name')
                        <div class="invalid-feedback">
                          Nama harus diisi!
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="role" class="col-md-12">Role <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                      <select class="form-select shadow-none form-control-line @error('role') is-invalid @enderror" name="role" id="role">
                        <option selected disabled hidden>Pilih role</option>
                        <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="cashier" {{ $user['role'] == 'cashier' ? 'selected' : '' }}>Cashier</option>
                      </select>
                      @error('role')
                        <div class="invalid-feedback">
                          Role harus dipilih!
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password" class="col-md-12">Password</label>
                    <div class="col-md-12">
                      <input type="password" name="password" id="password" class="form-control form-control-line @error('password') is-invalid @enderror">
                      @error('password')
                        <div class="invalid-feedback">
                          Password harus diisi!
                        </div>
                      @enderror
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