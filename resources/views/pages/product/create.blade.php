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
                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
                  </ol>
                </nav>
              <h1 class="mb-0 fw-bold">Produk</h1> 
          </div>
      </div>
  </div>
  <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <form class="form-horizontal form-material mx-2" method="POST" enctype="multipart/form-data" action="{{ route('product.store') }}">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name" class="col-md-12">Nama Produk <span class="text-danger">*</span></label>
                      <div class="col-md-12">
                        <input type="text" name="name" id="name" class="form-control form-control-line">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="image" class="col-md-12">Gambar Produk <span class="text-danger">*</span></label>
                      <div class="col-md-12">
                        <input type="file" name="image" id="image" class="form-control form-control-line">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="price" class="col-md-12">Harga <span class="text-danger">*</span></label>
                      <div class="col-md-12">
                        <input type="text" name="price" id="price" class="form-control form-control-line">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="stock" class="col-md-12">Stok <span class="text-danger">*</span></label>
                      <div class="col-md-12">
                        <input type="number" name="stock" id="stock" class="form-control form-control-line">
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