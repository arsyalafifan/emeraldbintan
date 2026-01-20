@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Master Taxi Service</h1>
          <a href="{{ route('taxi.create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Taxi Service
          </a>
      </div>

      <!-- Content Row -->
      <div class="row">
          <div class="card-body" style="overflow-x: auto">
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-striped nowrap w-100" id="table_taxi" width="100%" cellspacing="0">
                      <thead>
                      <tr>
                          {{-- <th>Destination ID</th> --}}
                          <th>Destination From</th>
                          <th>Destination To</th>
                          <th>7 Seats One Way</th>
                          <th>7 Seats Two Way</th>
                          <th>14 Seats One Way</th>
                          <th>14 Seats Two Way</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
    </div>
    <!-- /.container-fluid -->
    <script>
        $(document).ready(function () {
            var table = $('#table_taxi').DataTable({
                responsive: true,
                processing: true,
                serverSide: false,
                // dom: 'Bfrtip',
                ordering: false,
                searching: true,
                language: {
                    lengthMenu: "Menampilkan _MENU_ data per halaman",
                    zeroRecords: "Tidak ada data",
                    info: "Halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data",
                    infoFiltered: "(difilter dari _MAX_ data)",
                    search: "Pencarian :",
                    paginate: {
                    previous: "Sebelumnya",
                    next: "Selanjutnya",
                    }
                },
                ajax: {
                    url: "{{ route('taxi.index') }}",
                    dataSrc: function(response){
                        response.recordsTotal = response.data.count;
                        response.recordsFiltered = response.data.count;
                        return response.data.data;
                    },
                    data: function ( d ) {
                        return $.extend( {}, d, {
                            // "search": $("#search").val().toLowerCase(),
                            // "kelid": $("#kelid").val().toLowerCase()
                        } );
                    }
                },
                columns: [
                    // {data: 'destinationid', name: 'destinationid', visible: false},
                    {data: 'destinationNameFrom', name: 'destinationNameFrom',
                        render: function(data, type, row){
                            if(row.destinationNameFrom != null){
                                return row.destinationNameFrom;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {data: 'destinationName', name: 'destinationName',
                        render: function(data, type, row){
                            if(row.destinationName != null){
                                return row.destinationName;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {data: 'price7seatoneway', name: 'price7seatoneway',
                        render: function(data, type, row){
                            if(row.price7seatoneway != null){
                                var price = parseInt(row.price7seatoneway);
                                if(price >= 1000000) {
                                    return 'IDR ' + (price / 1000000).toFixed(1) + 'M';
                                } else if(price >= 1000) {
                                    return 'IDR ' + (price / 1000).toFixed(0) + 'K';
                                }
                                return 'IDR ' + price;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {data: 'price7seattwoway', name: 'price7seattwoway',
                        render: function(data, type, row){
                            if(row.price7seattwoway != null){
                                var price = parseInt(row.price7seattwoway);
                                if(price >= 1000000) {
                                    return 'IDR ' + (price / 1000000).toFixed(1) + 'M';
                                } else if(price >= 1000) {
                                    return 'IDR ' + (price / 1000).toFixed(0) + 'K';
                                }
                                return 'IDR ' + price;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {data: 'price14seatoneway', name: 'price14seatoneway',
                        render: function(data, type, row){
                            if(row.price14seatoneway != null){
                                var price = parseInt(row.price14seatoneway);
                                if(price >= 1000000) {
                                    return 'IDR ' + (price / 1000000).toFixed(1) + 'M';
                                } else if(price >= 1000) {
                                    return 'IDR ' + (price / 1000).toFixed(0) + 'K';
                                }
                                return 'IDR ' + price;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {data: 'price14seattwoway', name: 'price14seattwoway',
                        render: function(data, type, row){
                            if(row.price14seattwoway != null){
                                var price = parseInt(row.price14seattwoway);
                                if(price >= 1000000) {
                                    return 'IDR ' + (price / 1000000).toFixed(1) + 'M';
                                } else if(price >= 1000) {
                                    return 'IDR ' + (price / 1000).toFixed(0) + 'K';
                                }
                                return 'IDR ' + price;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        data: 'taxiserviceid',
                        render: function(data, type, row) {
                            // 1. Buat URL dasar menggunakan route Laravel dengan placeholder ':id'
                            var editUrl = "{{ route('taxi.edit', ':id') }}";
                            var deleteUrl = "{{ route('taxi.destroy', ':id') }}";
                            // 2. Ganti placeholder ':id' dengan id asli dari row data
                            editUrl = editUrl.replace(':id', row.taxiserviceid);
                            deleteUrl = deleteUrl.replace(':id', row.taxiserviceid);

                            // 3. Return HTML string
                            return `
                                <a href="${editUrl}" class="btn btn-sm btn-info">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <form action="${deleteUrl}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            `;
                        },
                        orderable: false,
                    }
                ]
            });
        });
    </script>
@endsection
