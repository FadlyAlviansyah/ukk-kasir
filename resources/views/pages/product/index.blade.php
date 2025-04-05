@extends('layouts.main')

@section('header')
  @include('components.header')
@endsection

@section('aside')
  @include('components.aside')
@endsection

@section('content')
  @if (Session::get('deleted'))
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        showBasicAlert('', 'Berhasil Menghapus Data Produk!', 'success');
      });
    </script>     
  @endif
  @if (Session::get('added'))
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        showBasicAlert('', 'Berhasil Menambah Data Produk!', 'success');
      });
    </script>     
  @endif
  @if (Session::get('updated'))
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        showBasicAlert('', 'Berhasil Mengubah Data Produk!', 'success');
      });
    </script>     
  @endif
  @if (Session::get('error'))
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        showBasicAlert('', 'Produk sudah tertaut transaksi!', 'error');
      });
    </script>     
  @endif
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
            @if (Auth::user()->role === 'admin')
              <div class="card-body text-end">
                <a href="{{ route('product.create') }}" class="btn btn-primary text-white">Tambah Produk</a>
              </div>
            @endif
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col"></th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
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
                    <td>Rp. {{ number_format($product['price'], 0, ',', '.') }}</td>
                    <td>{{ $product['stock'] }}</td>
                    @if (Auth::user()->role === 'admin')
                      <td>
                        <div class="d-flex justify-content-around">
                          <a href="{{ route('product.edit', $product['id']) }}" class="btn btn-warning">Edit</a>
                          <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateStockModal-{{ $product['id'] }}">Update Stock</button>
                          <form action="{{ route('product.delete', $product['id']) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="showDeleteConfirmationAlert(event, this.form)">Hapus</button>
                          </form>
                        </div>
                      </td>
                    @endif
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
                                    <input type="number" name="stock" value="{{ $product['stock'] }}" class="form-control form-control-line @error('stock') is-invalid @enderror">
                                    @error('stock')
                                      <div class="invalid-feedback">
                                        Stock produk harus diisi!
                                      </div>
                                    @enderror
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