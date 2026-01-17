@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Master Car Rental</h1>
          <a href="{{ route('car-rental.create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Car Rental
          </a>
      </div>

      <!-- Content Row -->
      <div class="row">
          <div class="card-body" style="overflow-x: auto">
              <div class="table-responsive">
                  <table class="table table-bordered yajra-datatable table-striped" id="table_car_rental" width="100%" cellspacing="0">
                      <thead>
                      <tr>
                          {{-- <th>Destination ID</th> --}}
                          <th>Type</th>
                          <th>Half Day (4 hrs)</th>
                          <th>Full Day (8 hrs)</th>
                          <th>Whole Days (12 hrs)</th>
                          <th>Additional Hours</th>
                          <th>Includes</th>
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

    <!-- Modal Upload Image List -->
    <div class="modal fade" id="uploadImageModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="uploadImageLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadImageLabel">Manage Images</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <button type="button" class="btn btn-primary mb-3" id="btnAddImage">
                        <i class="fa fa-plus"></i> Add Image
                    </button>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tableImages">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Preview Image (untuk upload/edit) -->
    <div class="modal fade" id="modalImage" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formImage" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="carrentalserviceid" id="carrentalserviceid">
                <input type="hidden" name="carrentalserviceimgid" id="carrentalserviceimgid">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Image</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="imgUrl" id="imageInput" class="form-control" accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <img id="previewImage" 
                                src="" 
                                style="max-width:100%;display:none"
                                class="img-thumbnail">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="imgDesc" id="imgDesc" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- /.container-fluid -->
    <script>
        $(document).ready(function () {
            var table = $('#table_car_rental').DataTable({
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
                    url: "{{ route('car-rental.index') }}",
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
                    {data: 'type', name: 'type',
                        render: function(data, type, row){
                            if(row.type != null){
                                return row.type;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {data: 'pricehalfday', name: 'pricehalfday',
                        render: function(data, type, row){
                            if(row.pricehalfday != null){
                                var price = parseInt(row.pricehalfday);
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
                    {data: 'pricefullday', name: 'pricefullday',
                        render: function(data, type, row){
                            if(row.pricefullday != null){
                                var price = parseInt(row.pricefullday);
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
                    {data: 'pricewholeday', name: 'pricewholeday',
                        render: function(data, type, row){
                            if(row.pricewholeday != null){
                                var price = parseInt(row.pricewholeday);
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
                    {data: 'priceadditional', name: 'priceadditional',
                        render: function(data, type, row){
                            if(row.priceadditional != null){
                                var price = parseInt(row.priceadditional);
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
                    {data: 'includes', name: 'includes',
                        render: function(data, includes, row){
                            if(row.includes != null){
                                return row.includes;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        data: 'carrentalserviceid',
                        width: 150,
                        render: function(data, type, row) {
                            // 1. Buat URL dasar menggunakan route Laravel dengan placeholder ':id'
                            var editUrl = "{{ route('car-rental.edit', ':id') }}";
                            var deleteUrl = "{{ route('car-rental.destroy', ':id') }}";
                            // 2. Ganti placeholder ':id' dengan id asli dari row data
                            editUrl = editUrl.replace(':id', row.carrentalserviceid);
                            deleteUrl = deleteUrl.replace(':id', row.carrentalserviceid);
                            // 3. Return HTML string
                            return `
                                <a href="${editUrl}" class="btn btn-sm btn-info">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-warning btn-image" data-id="${row.carrentalserviceid}">
                                    <i class="fa fa-image"></i>
                                </button>
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

            // Klik btn-image → buka uploadImageModal
            $(document).on('click', '.btn-image', function(){
                var carrentalserviceid = $(this).data('id');
                $('#carrentalserviceid').val(carrentalserviceid);
                loadImages(carrentalserviceid);
                $('#uploadImageModal').modal('show');
            });

            // Klik btnAddImage → buka modalImage
            $(document).on('click', '#btnAddImage', function(){
                resetFormImage();
                $('#modalImage').modal('show');
            });

            // Preview image
            $(document).on('change', '#imageInput', function(){
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(this.files[0]);
            });

            // Submit form image
            $('#formImage').on('submit', function(e){
                e.preventDefault();
                var formData = new FormData(this);
                var carrentalserviceid = $('#carrentalserviceid').val();
                
                $.ajax({
                    url: "{{ route('car-rental-image.store') }}", // Sesuaikan dengan route Anda
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        alert('Image uploaded successfully');
                        $('#modalImage').modal('hide');
                        loadImages(carrentalserviceid);
                    },
                    error: function(error){
                        alert('Error uploading image');
                        console.log(error);
                    }
                });
            });

            // Load images list
            function loadImages(carrentalserviceid) {
                $.ajax({
                    url: "{{ route('car-rental-image.list') }}", // Sesuaikan dengan route Anda
                    type: 'GET',
                    data: { carrentalserviceid: carrentalserviceid },
                    success: function(response){
                        var html = '';
                        $.each(response.data, function(index, image){
                            html += `
                                <tr>
                                    <td><img src="${image.imgUrl}" style="max-width:100px;"></td>
                                    <td>${image.imgDesc}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger btn-delete-image" data-id="${image.carrentalserviceimgid}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#tableImages tbody').html(html);
                    }
                });
            }

            // Delete image
            $(document).on('click', '.btn-delete-image', function(){
                if(confirm('Delete this image?')){
                    var imageId = $(this).data('id');
                    var carrentalserviceid = $('#carrentalserviceid').val();
                    $.ajax({
                        url: "{{ route('car-rental-image.destroy', ':id') }}".replace(':id', imageId),
                        type: 'POST',
                        data: { _method: 'DELETE', _token: '{{ csrf_token() }}' },
                        success: function(){
                            loadImages(carrentalserviceid);
                        }
                    });
                }
            });

            function resetFormImage() {
                $('#formImage')[0].reset();
                $('#previewImage').hide();
                $('#carrentalserviceimgid').val('');
            }
        });
    </script>
@endsection
