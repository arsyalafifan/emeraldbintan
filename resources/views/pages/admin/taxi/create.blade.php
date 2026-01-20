@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Taxi Service</h1>
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
                <form action="{{ route('taxi.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="destinationid_from">Destination From</label>
                        <select class="form-control" name="destinationid_from">
                            <option value="">Pilih Destination</option>
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->destinationid }}">{{ $destination->destinationName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="destinationid">Destination To</label>
                        <select class="form-control" name="destinationid">
                            <option value="">Pilih Destination</option>
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->destinationid }}">{{ $destination->destinationName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price7seatoneway">Price 7 Seats One Way</label>
                        <input type="number" class="form-control" name="price7seatoneway" value="{{ old('price7seatoneway') }}">
                    </div>
                    <div class="form-group">
                        <label for="price7seattwoway">Price 7 Seats Two Way</label>
                        <input type="number" class="form-control" name="price7seattwoway" value="{{ old('price7seattwoway') }}">
                    </div>
                    <div class="form-group">
                        <label for="price14seatoneway">Price 14 Seats One Way</label>
                        <input type="number" class="form-control" name="price14seatoneway" value="{{ old('price14seatoneway') }}">
                    </div>
                    <div class="form-group">
                        <label for="price14seattwoway">Price 14 Seats Two Way</label>
                        <input type="number" class="form-control" name="price14seattwoway" value="{{ old('price14seattwoway') }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
