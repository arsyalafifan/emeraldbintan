@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Car Rental</h1>
      </div>

      <!-- Content Row -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('car-rental.update', $item->carrentalserviceid) }}" method="post">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" class="form-control" name="type" value="{{ old('type', $item->type) }}">
                    </div>
                    <div class="form-group">
                        <label for="pricehalfday">Price Half Day (4 hrs)</label>
                        <input type="number" class="form-control" name="pricehalfday" value="{{ old('pricehalfday', $item->pricehalfday) }}">
                    </div>
                    <div class="form-group">
                        <label for="pricefullday">Price Full Day (8 hrs)</label>
                        <input type="number" class="form-control" name="pricefullday" value="{{ old('pricefullday', $item->pricefullday) }}">
                    </div>
                    <div class="form-group">
                        <label for="pricewholeday">Price Whole Day (12 hrs)</label>
                        <input type="number" class="form-control" name="pricewholeday" value="{{ old('pricewholeday', $item->pricewholeday) }}">
                    </div>
                    <div class="form-group">
                        <label for="priceadditional">Price Additional Hours</label>
                        <input type="number" class="form-control" name="priceadditional" value="{{ old('priceadditional', $item->priceadditional) }}">
                    </div>
                    <div class="form-group">
                        <label for="includes">Includes</label>
                        <input type="text" class="form-control" name="includes" value="{{ old('includes', $item->includes) }}">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Ubah
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
