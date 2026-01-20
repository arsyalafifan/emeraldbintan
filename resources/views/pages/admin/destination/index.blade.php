@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Master Destinasi</h1>
          <a href="{{ route('destination.create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Destinasi
          </a>
      </div>

      @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fa fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fa fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

      <!-- Content Row -->
      <div class="row">
          <div class="card-body" style="overflow-x: auto">
              <div class="table-responsive">
                  <table class="table table-bordered yajra-datatable table-striped" id="table_destination" width="100%" cellspacing="0">
                      <thead>
                      <tr>
                          {{-- <th>Destination ID</th> --}}
                          <th>Destination</th>
                          <th>Desc</th>
                          <th>Url Maps</th>
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
            var table = $('#table_destination').DataTable({
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
                    url: "{{ route('destination.index') }}",
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
                    {data: 'destinationName', name: 'destinationName',
                        render: function(data, type, row){
                            if(row.destinationName != null){
                                return row.destinationName;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {data: 'destinationDesc', name: 'destinationDesc',
                        render: function(data, type, row){
                            if(row.destinationDesc != null){
                                return row.destinationDesc;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {data: 'destinationUrl', name: 'destinationUrl',
                        render: function(data, type, row){
                            if(row.destinationUrl != null){
                                return row.destinationUrl;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        data: 'destinationid',
                        render: function(data, type, row) {
                            // 1. Buat URL dasar menggunakan route Laravel dengan placeholder ':id'
                            var editUrl = "{{ route('destination.edit', ':id') }}";
                            var deleteUrl = "{{ route('destination.destroy', ':id') }}";

                            // 2. Ganti placeholder ':id' dengan id asli dari row data
                            editUrl = editUrl.replace(':id', row.destinationid);
                            deleteUrl = deleteUrl.replace(':id', row.destinationid);

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
