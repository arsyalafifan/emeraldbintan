@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Taxi Service</h1>
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
                <form action="{{ route('taxi.update', $item->taxiserviceid) }}" method="post">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="destinationid">Destination</label>
                        <select class="form-control" name="destinationid">
                            <option value="">Pilih Destination</option>
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->destinationid }}"
                                    {{ $destination->destinationid == old('destinationid', $item->destinationid) ? 'selected' : '' }}>
                                    {{ $destination->destinationName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price7seatoneway">Price 7 Seats One Way</label>
                        <input type="number" class="form-control" name="price7seatoneway" value="{{ old('price7seatoneway', $item->price7seatoneway) }}">
                    </div>
                    <div class="form-group">
                        <label for="price7seattwoway">Price 7 Seats Two Way</label>
                        <input type="number" class="form-control" name="price7seattwoway" value="{{ old('price7seattwoway', $item->price7seattwoway) }}">
                    </div>
                    <div class="form-group">
                        <label for="price14seatoneway">Price 14 Seats One Way</label>
                        <input type="number" class="form-control" name="price14seatoneway" value="{{ old('price14seatoneway', $item->price14seatoneway) }}">
                    </div>
                    <div class="form-group">
                        <label for="price14seattwoway">Price 14 Seats Two Way</label>
                        <input type="number" class="form-control" name="price14seattwoway" value="{{ old('price14seattwoway', $item->price14seattwoway) }}">
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
