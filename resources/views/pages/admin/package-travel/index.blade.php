@extends('layouts.admin')

@section('content')
    
    <style>
        
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Paket Travel</h1>
          {{-- <a href="{{ route('package-travel.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Paket Travel
          </a> --}}
          <button type="button"
                class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                data-toggle="modal"
                data-target="#modalTambahPaket">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Paket Travel
        </button>

      </div>

      <!-- Content Row -->
      <div class="row">
          <div class="card-body" style="overflow-x: auto">
              <div class="table-responsive">
                  <table class="table table-bordered table-striped nowrap w-100" id="table_package" width="100%" cellspacing="0">
                      <thead>
                      <tr>
                          <th>No</th>
                          <th>Judul Paket</th>
                          <th>Deskripsi</th>
                          <th>Tour Time From</th>
                          <th>Tour Time To</th>
                          <th>Show Ribbon</th>
                          <th>Text Ribbon</th>
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
    <!-- Modal Tambah Paket Travel -->
    <div class="modal fade" id="modalTambahPaket" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">

                <!-- HEADER -->
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Paket Travel</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <!-- BODY -->
                <div class="modal-body">

                    <!-- FORM HEADER -->
                    <form id="formTambahPaket">
                        @csrf
                        <input type="hidden" id="travelpackageid" name="travelpackageid">

                        <div class="row">
                            <!-- Judul Paket -->
                            <div class="col-md-6 mb-3">
                                <label>Judul Paket</label>
                                <input type="text" name="packageTitle" id="packageTitle" class="form-control" required>
                            </div>

                            {{-- <!-- Harga -->
                            <div class="col-md-6 mb-3">
                                <label>Harga</label>
                                <input type="number" name="price" id="price" class="form-control" min="0" required>
                            </div> --}}

                            <!-- Deskripsi -->
                            <div class="col-md-12 mb-3">
                                <label>Deskripsi</label>
                                <textarea name="packageDesc" id="packageDesc" class="form-control" rows="3"></textarea>
                            </div>

                            <!-- Tour Time From -->
                            <div class="col-md-6 mb-3">
                                <label>Tour Time From</label>
                                <input type="time" name="tourTimeFrom" id="tourTimeFrom" class="form-control">
                            </div>

                            <!-- Tour Time To -->
                            <div class="col-md-6 mb-3">
                                <label>Tour Time To</label>
                                <input type="time" name="tourTimeTo" id="tourTimeTo" class="form-control">
                            </div>

                            {{-- <!-- Promo -->
                            <div class="col-md-6 mb-3">
                                <div class="form-check mt-4">
                                    <input type="checkbox" class="form-check-input" id="isPromo" name="isPromo" value="1">
                                    <label class="form-check-label" for="isPromo">Promo?</label>
                                </div>
                            </div>

                            <!-- Harga Promo -->
                            <div class="col-md-6 mb-3">
                                <label>Harga Promo</label>
                                <input type="number" name="promoPrice" id="promoPrice" class="form-control" min="0">
                            </div> --}}

                            <!-- Ribbon -->
                            <div class="col-md-6 mb-3">
                                <div class="form-check mt-4">
                                    <input type="checkbox" class="form-check-input" id="isRibbon" name="isRibbon" value="1">
                                    <label class="form-check-label" for="isRibbon">Show Ribbon?</label>
                                </div>
                            </div>

                            <!-- Text Ribbon -->
                            <div class="col-md-6 mb-3">
                                <label>Text Ribbon</label>
                                <input type="text" name="ribbonText" id="ribbonText" class="form-control">
                            </div>
                        </div>

                        <div class="text-right mb-3" id="headerActionCreate">
                            <button type="submit" class="btn btn-primary">
                                Simpan Header
                            </button>
                        </div>

                        <div class="text-right mb-3 d-none" id="headerActionEdit">
                            <button type="button" class="btn btn-warning" id="btnEditHeader">
                                Ubah
                            </button>
                            <button type="button" class="btn btn-success d-none" id="btnSaveHeader">
                                Simpan
                            </button>
                            <button type="button" class="btn btn-secondary d-none" id="btnCancelHeader">
                                Batal
                            </button>
                        </div>
                    </form>

                    <hr>

                    <!-- DETAIL SECTION -->
                    <div id="detailSection" style="display:none">

                        <h5>Detail Paket Travel</h5>

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabDestination">Destination</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabPrice">Price</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabImage">Image</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabInclude">Include</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabExclude">Exclude</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3">

                            <div class="tab-pane fade show active" id="tabDestination">
                                <button class="btn btn-sm btn-primary mb-2" id="btnAddDest">Tambah Destination</button>
                                <table class="table table-bordered" id="tableDest" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Destinasi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade show active" id="tabPrice">
                                <button class="btn btn-sm btn-primary mb-2" id="btnAddPrice">Tambah Harga</button>
                                <table class="table table-bordered" id="tablePrice" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Price Title</th>
                                            <th>Price</th>
                                            <th>Price Per</th>
                                            <th>Promo?</th>
                                            <th>Promo Price</th>
                                            <th>Price Desc</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="tabImage">
                                <button class="btn btn-sm btn-primary mb-2" id="btnAddImg">Tambah Image</button>
                                <table class="table table-bordered" id="tableImg" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Deskripsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="tabInclude">
                                <button class="btn btn-sm btn-primary mb-2" id="btnAddIncl">Tambah Include</button>
                                <table class="table table-bordered" id="tableIncl" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Include</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="tabExclude">
                                <button class="btn btn-sm btn-primary mb-2" id="btnAddExcl">Tambah Exclude</button>
                                <table class="table table-bordered" id="tableExcl" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Exclude</th>
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

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Tambah Destination -->
    <div class="modal fade" id="modalTambahDest" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <form id="formTambahDest">
                @csrf
                <input type="hidden" id="dest_travelpackageid" name="travelpackageid">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Destination</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Destination</label>
                            <select name="destinationid" class="form-control" required>
                                <option value="">-- Pilih Destination --</option>
                                @foreach($destinations as $dest)
                                    <option value="{{ $dest->destinationid }}">
                                        {{ $dest->destinationName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- Modal Tambah Price --}}
    <div class="modal fade" id="modalTambahPrice" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <form id="formTambahPrice">
                @csrf
                <input type="hidden" id="priceMode" value="create">
                <input type="hidden" id="travelpackagepriceid" name="travelpackagepriceid">
                <input type="hidden" id="price_travelpackageid" name="travelpackageid">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Price</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Price Title</label>
                            <input type="text" name="packagePriceTitle" id="packagePriceTitle" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" id="price" class="form-control" min="0">
                        </div>
                        <div class="form-group">
                            <label>Price Per</label>
                            <input type="text" name="pricePer" id="pricePer" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="isPromoPrice" name="isPromo" value="1">
                                <label class="form-check-label" for="isPromoPrice">Promo?</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Promo Price</label>
                            <input type="number" name="promoPrice" id="promoPrice" class="form-control" min="0">
                        </div>
                        <div class="form-group">
                            <label>Price Description</label>
                            <input type="text" name="priceDesc" id="priceDesc" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Preview Image -->
    <div class="modal fade" id="modalImage" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formImage" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="travelpackageid_img" id="travelpackageid_img">
                <input type="hidden" name="travelpackageimgid" id="travelpackageimgid">
                <input type="hidden" id="imageMode">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Image</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <img id="previewImage" 
                                src="" 
                                style="max-width:100%;display:none"
                                class="img-thumbnail">
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" name="imgDesc" id="imgDesc" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Include -->
    <div class="modal fade" id="modalTambahIncl" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <form id="formTambahIncl">
                @csrf
                <input type="hidden" id="incl_travelpackageid" name="travelpackageid">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Include</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Include Text</label>
                            <input type="text" name="includeText" id="includeText" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Include -->
    <div class="modal fade" id="modalTambahExcl" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <form id="formTambahExcl">
                @csrf
                <input type="hidden" id="excl_travelpackageid" name="travelpackageid">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Exclude</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Exclude Text</label>
                            <input type="text" name="excludeText" id="excludeText" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
    <script>
        $(document).ready(function () {

            let headerMode = 'create'; // create | edit
            let headerSnapshot = {};

            function togglePromo() {
                if ($('#isPromoPrice').is(':checked')) {
                    $('#promoPrice').prop('disabled', false);
                    // $('#promoPrice').prop('disabled', false);
                } else {
                    $('#promoPrice')
                        .prop('disabled', true)
                        .val('');
                }
            }

            function toggleRibbon() {
                if ($('#isRibbon').is(':checked')) {
                    $('#ribbonText').prop('disabled', false);
                } else {
                    $('#ribbonText')
                        .prop('disabled', true)
                        .val('');
                }
            }

            // Trigger saat checkbox diubah
            $('#isPromo').on('change', togglePromo);
            $('#isPromoPrice').on('change', togglePromo);
            $('#isRibbon').on('change', toggleRibbon);

            // Trigger saat modal pertama kali dibuka
            $('#modalTambahPaket').on('shown.bs.modal', function () {
                togglePromo();
                toggleRibbon();
            });

            var table = $('#table_package').DataTable({
                responsive: false,
                scrollX: false, 
                autoWidth: false,
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
                    url: "{{ route('package-travel.index') }}",
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
                    {
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'packageTitle', name: 'packageTitle',
                        render: function(data, type, row){
                            if(row.packageTitle != null){
                                return row.packageTitle;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {data: 'packageDesc', name: 'packageDesc',
                        render: function(data, type, row){
                            if(row.packageDesc != null){
                                return row.packageDesc;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {data: 'tourTimeFrom', name: 'tourTimeFrom',
                        render: function(data, type, row){
                            if(row.tourTimeFrom != null){
                                return row.tourTimeFrom.substring(0, 5); // Format HH:MM
                            } else {
                                return '-';
                            }
                        }
                    },
                    {data: 'tourTimeTo', name: 'tourTimeTo',
                        render: function(data, type, row){
                            if(row.tourTimeTo != null){
                                return row.tourTimeTo.substring(0, 5); // Format HH:MM
                            } else {
                                return '-';
                            }
                        }
                    },
                    {data: 'isRibbon', name: 'isRibbon',
                        render: function(data, type, row){
                            if(row.isRibbon){
                                return '<span class="badge badge-success">Yes</span>';
                            } else {
                                return '<span class="badge badge-secondary">No</span>';
                            }
                        }
                    },
                    {data: 'ribbonText', name: 'ribbonText',
                        render: function(data, type, row){
                            if(row.isRibbon && row.ribbonText != null){
                                return '<span class="badge badge-warning text-dark">' + row.ribbonText + '</span>';
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        data: 'travelpackageid',
                        render: function(data, type, row) {
                            // 1. Buat URL dasar menggunakan route Laravel dengan placeholder ':id'
                            var editUrl = "{{ route('travel-package.edit', ':id') }}";
                            var deleteUrl = "{{ route('travel-package.destroy', ':id') }}";
                            var travelpackageid = row.travelpackageid;

                            // 2. Ganti placeholder ':id' dengan id asli dari row data
                            editUrl = editUrl.replace(':id', row.travelpackageid);
                            deleteUrl = deleteUrl.replace(':id', row.travelpackageid);

                            // 3. Return HTML string
                            return `
                                <a href="#" class="btn btn-sm btn-info btn-edit-package" data-id="${travelpackageid}">
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

            function setHeaderReadonly(isReadonly) {
                $('#formTambahPaket input, #formTambahPaket textarea')
                    .not('#travelpackageid')
                    .prop('disabled', isReadonly);
            }

            function snapshotHeader() {
                headerSnapshot = {
                    packageTitle: $('#packageTitle').val(),
                    price: $('#price').val(),
                    packageDesc: $('#packageDesc').val(),
                    tourTimeFrom: $('#tourTimeFrom').val(),
                    tourTimeTo: $('#tourTimeTo').val(),
                    isPromo: $('#isPromo').prop('checked'),
                    promoPrice: $('#promoPrice').val(),
                    isRibbon: $('#isRibbon').prop('checked'),
                    ribbonText: $('#ribbonText').val()
                };
            }

            function restoreHeader() {
                $('#packageTitle').val(headerSnapshot.packageTitle);
                $('#price').val(headerSnapshot.price);
                $('#packageDesc').val(headerSnapshot.packageDesc);
                $('#tourTimeFrom').val(headerSnapshot.tourTimeFrom);
                $('#tourTimeTo').val(headerSnapshot.tourTimeTo);
                $('#isPromo').prop('checked', headerSnapshot.isPromo).trigger('change');
                $('#promoPrice').val(headerSnapshot.promoPrice);
                $('#isRibbon').prop('checked', headerSnapshot.isRibbon).trigger('change');
                $('#ribbonText').val(headerSnapshot.ribbonText);
            }

            $('#btnOpenCreate').on('click', function () {

                headerMode = 'create';

                $('#formTambahPaket')[0].reset();
                $('#travelpackageid').val('');

                $('#detailSection').hide();

                setHeaderReadonly(false);

                $('#headerActionCreate').removeClass('d-none');
                $('#headerActionEdit').addClass('d-none');

                $('#modalTambahPaket').modal('show');
            });

            // fix modal scroll after datatable redraw
            function fixModalScroll() {
                $('#modalTambahPaket').css('overflow-y', 'auto');
                $('#modalTambahPaket .modal-body').scrollTop(0);
            }

            // reset detail tabs to first tab
            function resetDetailTabs() {
                $('#detailSection .nav-link').removeClass('active');
                $('#detailSection .tab-pane').removeClass('show active');

                $('#detailSection .nav-link:first').addClass('active');
                $('#detailSection .tab-pane:first').addClass('show active');
            }


            // show ajax error messages
            function showAjaxError(xhr) {
                let errorMessage = 'Terjadi kesalahan!';
                
                if (xhr.responseJSON?.errors) {
                    let errors = Object.values(xhr.responseJSON.errors).flat();
                    errorMessage = errors.join(', ');
                } else if (xhr.responseJSON?.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: errorMessage
                });
            }


            // Store Header Travel Package
            $('#formTambahPaket').on('submit', function (e) {
                e.preventDefault();

                // HANYA UNTUK MODE CREATE
                if (headerMode !== 'create') return;

                $.ajax({
                    url: "{{ route('package-travel.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (res) {

                        // isi id header
                        $('#travelpackageid').val(res.travelpackageid);

                        // ganti mode
                        headerMode = 'edit';

                        // snapshot data
                        snapshotHeader();

                        // form jadi readonly
                        setHeaderReadonly(true);

                        // tampilkan detail
                        $('#detailSection').show();

                        // init detail tables
                        initAllDetailTables(res.travelpackageid);

                        // switch tombol
                        $('#headerActionCreate').addClass('d-none');
                        $('#headerActionEdit').removeClass('d-none');
                        $('#btnEditHeader').removeClass('d-none');
                        $('#btnSaveHeader, #btnCancelHeader').addClass('d-none');

                        // reload table utama
                        $('#table_package').DataTable().ajax.reload(null, false);

                        // SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Paket travel berhasil ditambahkan',
                            timer: 2000,
                            timerProgressBar: true
                        });
                    },
                    error: function (xhr) {
                        showAjaxError(xhr);
                    }
                });
            });

            $('#modalTambahPaket').on('hidden.bs.modal', function () {

                // mode kembali create
                headerMode = 'create';

                // reset form
                $('#formTambahPaket')[0].reset();
                $('#travelpackageid').val('');

                // readonly OFF
                setHeaderReadonly(false);

                // reset tombol header
                $('#headerActionCreate').removeClass('d-none');
                $('#headerActionEdit').addClass('d-none');

                $('#btnEditHeader').removeClass('d-none');
                $('#btnSaveHeader, #btnCancelHeader').addClass('d-none');

                // hide detail
                $('#detailSection').hide();

                // reset snapshot
                headerSnapshot = {};

                // reset promo & ribbon
                $('#isPromo').prop('checked', false);
                $('#isRibbon').prop('checked', false);
                togglePromo();
                toggleRibbon();

                // reset ke tab pertama
                resetDetailTabs();

                // destroy detail tables (PENTING)
                // if ($.fn.DataTable.isDataTable('#tableDest')) {
                //     $('#tableDest').DataTable().destroy();
                //     $('#tableDest tbody').empty();
                // }
                // if ($.fn.DataTable.isDataTable('#tableImg')) {
                //     $('#tableImg').DataTable().destroy();
                //     $('#tableImg tbody').empty();
                // }
                // if ($.fn.DataTable.isDataTable('#tableIncl')) {
                //     $('#tableIncl').DataTable().destroy();
                //     $('#tableIncl tbody').empty();
                // }
                // if ($.fn.DataTable.isDataTable('#tableExcl')) {
                //     $('#tableExcl').DataTable().destroy();
                //     $('#tableExcl tbody').empty();
                // }
                setTimeout(() => {
                    if ($.fn.DataTable.isDataTable('#tableDest')) {
                        $('#tableDest').DataTable().destroy();
                    }
                }, 0);
                setTimeout(() => {
                    if ($.fn.DataTable.isDataTable('#tableImg')) {
                        $('#tableImg').DataTable().destroy();
                    }
                }, 0);
                setTimeout(() => {
                    if ($.fn.DataTable.isDataTable('#tableIncl')) {
                        $('#tableIncl').DataTable().destroy();
                    }
                }, 0);
                setTimeout(() => {
                    if ($.fn.DataTable.isDataTable('#tableExcl')) {
                        $('#tableExcl').DataTable().destroy();
                    }
                }, 0);
            });

            $(document).on('click', '.btn-edit-package', function () {

                resetDetailTabs();

                let id = $(this).data('id');

                headerMode = 'edit';

                $.get("{{ route('package-travel.show', ':id') }}".replace(':id', id), function (res)  {

                    // isi form
                    $('#travelpackageid').val(res.travelpackageid);
                    $('#packageTitle').val(res.packageTitle);
                    $('#price').val(res.price);
                    $('#packageDesc').val(res.packageDesc);
                    $('#tourTimeFrom').val(res.tourTimeFrom);
                    $('#tourTimeTo').val(res.tourTimeTo);
                    $('#isPromo').prop('checked', res.isPromo).trigger('change');
                    $('#promoPrice').val(res.promoPrice);
                    $('#isRibbon').prop('checked', res.isRibbon).trigger('change');
                    $('#ribbonText').val(res.ribbonText);

                    snapshotHeader();

                    setHeaderReadonly(true);

                    $('#detailSection').show();
                    initAllDetailTables(id);

                    $('#headerActionCreate').addClass('d-none');
                    $('#headerActionEdit').removeClass('d-none');

                    $('#btnEditHeader').removeClass('d-none');
                    $('#btnSaveHeader, #btnCancelHeader').addClass('d-none');

                    $('#modalTambahPaket').modal('show');
                });
            });

            // Edit header
            $('#btnEditHeader').on('click', function () {
                setHeaderReadonly(false);

                snapshotHeader();

                $('#btnEditHeader').addClass('d-none');
                $('#btnSaveHeader, #btnCancelHeader').removeClass('d-none');
            });
            // Cancel edit header
            $('#btnCancelHeader').on('click', function () {
                restoreHeader();
                setHeaderReadonly(true);

                $('#btnSaveHeader, #btnCancelHeader').addClass('d-none');
                $('#btnEditHeader').removeClass('d-none');
            });

            // Save edited header
            $('#btnSaveHeader').on('click', function () {

                let id = $('#travelpackageid').val();
                let url = "{{ route('package-travel.update', ':id') }}".replace(':id', id);

                $.ajax({
                    url: url,
                    method: "PUT",
                    data: $('#formTambahPaket').serialize(),
                    success: function () {

                        snapshotHeader();
                        setHeaderReadonly(true);

                        $('#btnSaveHeader, #btnCancelHeader').addClass('d-none');
                        $('#btnEditHeader').removeClass('d-none');

                        $('#table_package').DataTable().ajax.reload(null, false);

                        // SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Paket travel berhasil diperbarui',
                            timer: 2000,
                            timerProgressBar: true
                        });
                    },
                    error: function (xhr) {
                        showAjaxError(xhr);
                    }
                });
            });
            

            // Initialize all detail tables
            function initAllDetailTables(travelpackageid) {
                initDestTable(travelpackageid);
                initPriceTable(travelpackageid);
                initImageTable(travelpackageid);
                initInclTable(travelpackageid);
                initExclTable(travelpackageid);
            }

            // Destinasi Table
            function initDestTable(travelpackageid) {
                if ($.fn.DataTable.isDataTable('#tableDest')) {
                    $('#tableDest').DataTable().ajax
                        .url("{{ route('package-travel.dest', ':id') }}".replace(':id', travelpackageid))
                        .load();
                    return;
                }

                $('#tableDest').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('package-travel.dest', ':id') }}".replace(':id', travelpackageid),
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'destination.destinationName',
                            name: 'destination.destinationName'
                        },
                        {
                            data: 'travelpackagedestid',
                            orderable: false,
                            searchable: false,
                            render: function (data) {
                                return `
                                    <button class="btn btn-sm btn-danger btnDeleteDest"
                                        data-id="${data}">
                                        Delete
                                    </button>
                                `;
                            }
                        }
                    ]
                });
            }

            // Open Modal Tambah Dest
            $('#btnAddDest').on('click', function () {
                
                let id = $('#travelpackageid').val();

                if (!id) {
                    alert('Simpan paket travel terlebih dahulu');
                    return;
                }

                $('#dest_travelpackageid').val(id);
                $('#modalTambahDest').modal('show');
            });

            // Submit Tambah Destinasi
            $('#formTambahDest').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('package-travel-dest.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (res) {
                        $('#modalTambahDest').modal('hide');
                        $('#formTambahDest')[0].reset();

                        $('#tableDest').DataTable().ajax.reload(null, false);
                        $('#tableDest').on('draw.dt', function () {
                            fixModalScroll();
                        });

                        // SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Destinasi berhasil ditambahkan',
                            timer: 2000,
                            timerProgressBar: true
                        });
                    },
                    error: function (xhr) {
                        showAjaxError(xhr);
                    }
                });
            });

            // Delete Destinasi
            $(document).on('click', '.btnDeleteDest', function () {
                let id = $(this).data('id');

                if (!confirm('Yakin hapus destination ini?')) return;

                $.ajax({
                    url: "{{ route('package-travel.dest.delete', ':id') }}".replace(':id', id),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        $('#tableDest').DataTable().ajax.reload(null, false);
                        $('#tableDest').on('draw.dt', function () {
                            fixModalScroll();
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: 'Destinasi berhasil dihapus',
                            timer: 2000,
                            timerProgressBar: true
                        });
                    },
                    error: function () {
                        alert('Gagal menghapus data');
                    }
                });
            });

            // Price Table
            function initPriceTable(travelpackageid) {
                if ($.fn.DataTable.isDataTable('#tablePrice')) {
                    $('#tablePrice').DataTable().ajax
                        .url("{{ route('package-travel.price', ':id') }}".replace(':id', travelpackageid))
                        .load();
                    return;
                }

                $('#tablePrice').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('package-travel.price', ':id') }}".replace(':id', travelpackageid),
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'packagePriceTitle',
                            name: 'packagePriceTitle'
                        },
                        {
                            data: 'price',
                            name: 'price',
                            render: function (data) {
                                var price = parseInt(data);
                                if(price >= 1000000) {
                                    return 'IDR ' + (price / 1000000).toFixed(1) + 'M';
                                } else if(price >= 1000) {
                                    return 'IDR ' + (price / 1000).toFixed(0) + 'K';
                                }
                                return '-';
                            }
                        },
                        {
                            data: 'pricePer',
                            name: 'pricePer'
                        },
                        {
                            data: 'isPromo',
                            name: 'isPromo',
                            render: function (data) {
                                return data ? 'Yes' : 'No';
                            }
                        },
                        {
                            data: 'promoPrice',
                            name: 'promoPrice',
                            render: function (data) {
                                var price = parseInt(data);
                                if(price >= 1000000) {
                                    return 'IDR ' + (price / 1000000).toFixed(1) + 'M';
                                } else if(price >= 1000) {
                                    return 'IDR ' + (price / 1000).toFixed(0) + 'K';
                                }
                                return '-';
                            }
                        },
                        {
                            data: 'priceDesc',
                            name: 'priceDesc',
                            render: function (data) {
                                return data ? data : '-';
                            }
                        },
                        {
                            data: 'travelpackagepriceid',
                            orderable: false,
                            searchable: false,
                            render: function (data) {
                                return `
                                    <button 
                                        class="btn btn-sm btn-info btnEditPrice"
                                        data-id="${data}">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    <button 
                                        class="btn btn-sm btn-danger btnDeletePrice"
                                        data-id="${data}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                `;
                            }
                        }
                    ]
                });
            }

            // Open Modal Tambah Price
            $('#btnAddPrice').click(function () {
                let travelpackageid = $('#travelpackageid').val();
                if (!travelpackageid) {
                    alert('Simpan header paket travel terlebih dahulu');
                    return;
                }
                $('#price_travelpackageid').val(travelpackageid);
                $('#priceMode').val('create');
                $('#travelpackagepriceid').val('');
                $('#formTambahPrice')[0].reset();
                $('#modalTambahPrice .modal-title').text('Tambah Price');
                $('#modalTambahPrice').modal('show');
            });

            // Trigger saat modal tambah price pertama kali dibuka
            $('#modalTambahPrice').on('shown.bs.modal', function () {
                togglePromo();
            });

            // Submit Tambah / Edit Price
            $('#formTambahPrice').submit(function (e) {
                e.preventDefault();
                
                let mode = $('#priceMode').val();
                let priceId = $('#travelpackagepriceid').val();
                let url = mode === 'create'
                    ? "{{ route('package-travel.price.store') }}"
                    : "{{ route('package-travel.price.update', ':id') }}".replace(':id', priceId);
                
                let formData = $(this).serialize();
                if (mode === 'edit') {
                    formData += '&_method=PUT';
                }
                
                $.ajax({
                    url: url,
                    method: "POST",
                    data: formData,
                    success: function () {
                        $('#modalTambahPrice').modal('hide');
                        $('#formTambahPrice')[0].reset();
                        $('#priceMode').val('create');

                        $('#tablePrice').DataTable().ajax.reload(null, false);
                        $('#tablePrice').on('draw.dt', function () {
                            fixModalScroll();
                        });

                        // SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: mode === 'create' ? 'Price berhasil ditambahkan' : 'Price berhasil diperbarui',
                            timer: 2000,
                            timerProgressBar: true
                        });
                    },
                    error: function (xhr) {
                        showAjaxError(xhr);
                    }
                });
            });

            // Edit Price
            $(document).on('click', '.btnEditPrice', function () {
                let id = $(this).data('id');
                let row = $('#tablePrice').DataTable().row($(this).parents('tr')).data();

                $('#priceMode').val('edit');
                $('#travelpackagepriceid').val(id);
                $('#price_travelpackageid').val(row.travelpackageid);
                $('#packagePriceTitle').val(row.packagePriceTitle);
                $('#priceSeq').val(row.priceSeq);
                $('#price').val(row.price);
                $('#pricePer').val(row.pricePer);
                $('#isPromoPrice').prop('checked', row.isPromo).trigger('change');
                $('#promoPrice').val(row.promoPrice);
                $('#priceDesc').val(row.priceDesc);

                $('#modalTambahPrice .modal-title').text('Edit Price');
                $('#modalTambahPrice').modal('show');
            });

            // Update Price - belum ada fitur update, hanya delete dan create
            // ...

            // Delete Price
            $(document).on('click', '.btnDeletePrice', function () {
                let id = $(this).data('id');
                if (!confirm('Hapus price ini?')) return;
                $.ajax({
                    url: "{{ route('package-travel.price.delete', ':id') }}".replace(':id', id),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function () {
                        $('#tablePrice').DataTable().ajax.reload(null, false);
                        $('#tablePrice').on('draw.dt', function () {
                            fixModalScroll();
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: 'Price berhasil dihapus',
                            timer: 2000,
                            timerProgressBar: true
                        });
                    }
                });
            });

            // Reset modal price saat ditutup
            $('#modalTambahPrice').on('hidden.bs.modal', function () {
                $('#formTambahPrice')[0].reset();
                $('#priceMode').val('create');
                $('#travelpackagepriceid').val('');
                $('#modalTambahPrice .modal-title').text('Tambah Price');
            });

            // Image Table
            function initImageTable(travelpackageid) {
                if ($.fn.DataTable.isDataTable('#tableImg')) {
                    $('#tableImg').DataTable().ajax
                        .url("{{ route('package-travel.image', ':id') }}".replace(':id', travelpackageid))
                        .load();
                    return;
                }

                $('#tableImg').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: "{{ route('package-travel.image', ':id') }}".replace(':id', travelpackageid),
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'imgUrl',
                            orderable: false,
                            searchable: false,
                            render: function (data) {
                                return `
                                    <img src="${data}"
                                        class="img-thumbnail"
                                        style="width:120px;height:80px;object-fit:cover">
                                `;
                            }
                        },
                        {
                            data: 'imgDesc',
                            defaultContent: '-'
                        },
                        {
                            data: 'travelpackageimgid',
                            orderable: false,
                            searchable: false,
                            render: function (data) {
                                return `
                                    <button 
                                        class="btn btn-sm btn-danger btnDeleteImg"
                                        data-id="${data}">
                                        Delete
                                    </button>
                                `;
                            }
                        }
                    ]
                });
            }

            // Preview Image on click
            $(document).on('click', '.img-thumbnail', function () {
                const src = $(this).attr('src');
                $('#previewImg').attr('src', src);
                $('#modalPreviewImg').modal('show');
            });

            // Preview selected image before upload
            $('#imageInput').on('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        $('#previewImage')
                            .attr('src', e.target.result)
                            .show();
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Open Modal Tambah Image
            $('#btnAddImg').click(function () {
                let travelpackageid = $('#travelpackageid').val();

                if (!travelpackageid) {
                    alert('Simpan header paket travel terlebih dahulu');
                    return;
                }

                $('#formImage')[0].reset();
                $('#imageMode').val('create');
                $('#travelpackageimgid').val('');
                $('#travelpackageid_img').val(travelpackageid);
                $('#previewImage').hide();

                $('#modalImage').modal('show');
            });


            // Submit Image Form (Create & Update)
            $('#formImage').submit(function (e) {
                e.preventDefault();

                let mode = $('#imageMode').val();
                let url = mode === 'create'
                    ? "{{ route('package-travel.image.store') }}"
                    : "{{ route('package-travel.image.update') }}";

                let formData = new FormData(this);

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function () {
                        $('#modalImage').modal('hide');
                        $('#tableImg').DataTable().ajax.reload(null, false);
                        $('#tableImg').on('draw.dt', function () {
                            fixModalScroll();
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Image berhasil ditambahkan',
                            timer: 2000,
                            timerProgressBar: true
                        });
                    },
                    error: function (err) {
                        alert('Upload gagal');
                    }
                });
            });

            // Edit Image
            $(document).on('click', '.btnEditImg', function () {
                let data = $('#tableImg').DataTable().row($(this).parents('tr')).data();

                $('#imageMode').val('edit');
                $('#travelpackageimgid').val(data.travelpackageimgid);
                $('#travelpackageid_img').val(data.travelpackageid);
                $('#imgDesc').val(data.imgDesc);

                $('#previewImage')
                    .attr('src', '/' + data.imgUrl)
                    .show();

                $('#modalImage .modal-title').text('Edit Image');
                $('#modalImage').modal('show');
            });

            // Delete Image
            $(document).on('click', '.btnDeleteImg', function () {
                let id = $(this).data('id');
                let url = "{{ route('package-travel.image.delete', ':id') }}".replace(':id', id);

                if (!confirm('Hapus image ini?')) return;

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function () {
                        $('#tableImg').DataTable().ajax.reload(null, false);
                        $('#tableImg').on('draw.dt', function () {
                            fixModalScroll();
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: 'Image berhasil dihapus',
                            timer: 2000,
                            timerProgressBar: true
                        });
                    }
                });
            });



            // Include Table
            function initInclTable(travelpackageid) {
                if ($.fn.DataTable.isDataTable('#tableIncl')) {
                    $('#tableIncl').DataTable().ajax
                        .url("{{ route('package-travel.incl', ':id') }}".replace(':id', travelpackageid))
                        .load();
                    return;
                }
                
                $('#tableIncl').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('package-travel.incl', ':id') }}".replace(':id', travelpackageid),
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        { data: 'includeText', name: 'includeText' },
                        {
                            data: 'travelpackageinclid',
                            orderable: false,
                            searchable: false,
                            render: function (data) {
                                return `
                                    <button class="btn btn-sm btn-danger btnDeleteIncl"
                                        data-id="${data}">
                                        Delete
                                    </button>
                                `;
                            }
                        }
                    ]
                });
            }

            // Open modal tambah include
            $('#btnAddIncl').on('click', function () {
                let id = $('#travelpackageid').val();

                if (!id) {
                    alert('Simpan paket travel terlebih dahulu');
                    return;
                }

                $('#incl_travelpackageid').val(id);
                $('#modalTambahIncl').modal('show');
            });

            // Submit Tambah Include
            $('#formTambahIncl').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('package-travel-incl.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (res) {
                        $('#modalTambahIncl').modal('hide');
                        $('#formTambahIncl')[0].reset();

                        $('#tableIncl').DataTable().ajax.reload(null, false);
                        $('#tableIncl').on('draw.dt', function () {
                            fixModalScroll();
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Include berhasil ditambahkan',
                            timer: 2000,
                            timerProgressBar: true
                        });
                    },
                    error: function (xhr) {
                        showAjaxError(xhr);
                    }
                });
            });

            // Delete Include
            $(document).on('click', '.btnDeleteIncl', function () {
                let id = $(this).data('id');

                if (!confirm('Yakin hapus include ini?')) return;

                $.ajax({
                    url: "{{ route('package-travel.incl.delete', ':id') }}".replace(':id', id),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        $('#tableIncl').DataTable().ajax.reload(null, false);
                        $('#tableIncl').on('draw.dt', function () {
                            fixModalScroll();
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: 'Include berhasil dihapus',
                            timer: 2000,
                            timerProgressBar: true
                        });
                    },
                    error: function () {
                        alert('Gagal menghapus data');
                    }
                });
            });

            // Exclude Table
            function initExclTable(travelpackageid) {
                if ($.fn.DataTable.isDataTable('#tableExcl')) {
                    $('#tableExcl').DataTable().ajax
                        .url("{{ route('package-travel.excl', ':id') }}".replace(':id', travelpackageid))
                        .load();
                    return;
                }
                $('#tableExcl').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('package-travel.excl', ':id') }}".replace(':id', travelpackageid),
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        { data: 'excludeText', name: 'excludeText' },
                        {
                            data: 'travelpackageexclid',
                            orderable: false,
                            searchable: false,
                            render: function (data) {
                                return `
                                    <button class="btn btn-sm btn-danger btnDeleteExcl"
                                        data-id="${data}">
                                        Delete
                                    </button>
                                `;
                            }
                        }
                    ]
                });
            }

            // Open modal tambah exclude
            $('#btnAddExcl').on('click', function () {
                let id = $('#travelpackageid').val();
                if (!id) {
                    alert('Simpan paket travel terlebih dahulu');
                    return;
                }
                $('#excl_travelpackageid').val(id);
                $('#modalTambahExcl').modal('show');
            });

            // Submit Tambah Exclude
            $('#formTambahExcl').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('package-travel-excl.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (res) {
                        $('#modalTambahExcl').modal('hide');
                        $('#formTambahExcl')[0].reset();

                        $('#tableExcl').DataTable().ajax.reload(null, false);
                        $('#tableExcl').on('draw.dt', function () {
                            fixModalScroll();
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Exclude berhasil ditambahkan',
                            timer: 2000,
                            timerProgressBar: true
                        });
                    },
                    error: function (xhr) {
                        showAjaxError(xhr);
                    }
                });
            });

            // Delete Exclude
            $(document).on('click', '.btnDeleteExcl', function () {
                let id = $(this).data('id');

                if (!confirm('Yakin hapus exclude ini?')) return;

                $.ajax({
                    url: "{{ route('package-travel.excl.delete', ':id') }}".replace(':id', id),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        $('#tableExcl').DataTable().ajax.reload(null, false);
                        $('#tableExcl').on('draw.dt', function () {
                            fixModalScroll();
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: 'Exclude berhasil dihapus',
                            timer: 2000,
                            timerProgressBar: true
                        });
                    },
                    error: function () {
                        alert('Gagal menghapus data');
                    }
                });
            });
        });
    </script>
@endsection
