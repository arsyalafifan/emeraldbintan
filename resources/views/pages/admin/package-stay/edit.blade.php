@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Destination {{ $item->destinationName }}</h1>
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
                <form action="{{ route('destination.update', $item->destinationid) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="destinationName">Destination</label>
                        <input type="text" class="form-control" name="destinationName" placeholder="destination" value="{{ old('destinationName', $item->destinationName) }}">
                    </div>
                    <div class="form-group">
                        <label for="destinationDesc">Description</label>
                        <input type="text" class="form-control" name="destinationDesc" placeholder="description" value="{{ old('destinationDesc', $item->destinationDesc) }}">
                    </div>
                    <div class="form-group">
                        <label for="destinationUrl">Url Maps</label>
                        <input type="text" class="form-control" name="destinationUrl" placeholder="Url Maps" value="{{ old('destinationUrl', $item->destinationUrl) }}">
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
