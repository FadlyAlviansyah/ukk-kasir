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
              <div class="card-body text-end">
                  <a href="{{ route('product.create') }}" class="btn btn-primary text-white">Tambah Produk</a>
              </div>
              <div class="table-responsive">
                  <table class="table table-hover">
                      <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col"></th>
                              <th scope="col">Nama Produk</th>
                              <th scope="col">Harga</th>
                              <th scope="col">Stok</th>
                              <th scope="col"></th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($products as $product)
                        <tr>
                          <th>{{ $i++ }}</th>
                          <td style="width: 100px"><img src="storage/{{ $product['image'] }}" alt="{{ $product['name'] }}" style="width: 100%"></td>
                          <td>{{ $product['name'] }}</td>
                          <td>{{ $product['price'] }}</td>
                          <td>{{ $product['stock'] }}</td>
                          <td>
                            <div class="d-flex justify-content-around">
                              <a href="{{ route('product.edit', $product['id']) }}" class="btn btn-warning">Edit</a>
                              <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateStockModal-{{ $product['id'] }}">Update Stock</button>
                              <form action="{{ route('product.delete', $product['id']) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Hapus</button>
                              </form>
                            </div>
                          </td>
                        </tr>
                        <form action="{{ route('product.updateStock', $product['id']) }}" method="POST">
                          @csrf
                          @method('PATCH')
                          <div class="modal fade" id="updateStockModal-{{ $product['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Update Stok Produk</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="" class="col-md-12">Nama Produk <span class="text-danger">*</span></label>
                                        <div class="col-md-12">
                                          <input type="text" name="name" value="{{ $product['name'] }}" class="form-control form-control-line" readonly>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="" class="col-md-12">Stok <span class="text-danger">*</span></label>
                                        <div class="col-md-12">
                                          <input type="number" name="stock" value="{{ $product['stock'] }}" class="form-control form-control-line">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
        </div>
      </div>
  </div>
</div>


@endsection