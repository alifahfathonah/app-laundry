<div class="ibox-content m-b-sm border-bottom">
    <div class="row">
        <div class="col-sm-12">
            <?= form_button('tambah', '<i class="fa fa-plus"></i> Entri Laundry Masuk', 'id=bt_tambah_laundry_masuk class="btn btn-primary"') ?>
            <?= form_button('pencarian', '<i class="fa fa-search"></i> Pencarian', 'id=bt_pencarian_laundry_masuk class="btn btn-success"') ?></li>
            <?= form_button('reset', '<i class="fa fa-refresh"></i> Reload Data', 'id=bt_reset class="btn"') ?></li>
        </div>
    </div>
</div>


<input type="hidden" name="page_now" id="page_now" />
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <!-- data table laundry masuk -->
                <table class="table table-hover table-condensed" id="table_data">
                    <thead>
                        <tr class="info">
                            <th width="5%" style="text-align: center;">NO</th>
                            <th width="11%" style="text-align: center;">NO REGISTER</th>
                            <th width="12%" style="text-align: center;">WAKTU MASUK</th>
                            <th width="9%" style="text-align: center;">NO CM</th>
                            <th width="18%">NAMA</th>
                            <th width="12%" style="text-align: center;">WAKTU SELESAI</th>
                            <th width="8%" style="text-align: center;">ST CM</th>
                            <th width="5%" style="text-align: center;">STATUS</th>
                            <th width="10%" style="text-align: center;">PETUGAS</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <!-- end data table -->

                <div class="pages_summary" id="p_summary"></div>
                <div id="pagination"></div>

                <!-- modal laundry masuk -->
                <div class="modal inmodal fade" id="modal_laundry_masuk" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width: 80%;">
                        <div class="modal-content animated">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="modal_title_laundry_masuk">Pendaftaran Laundry Masuk</h4>
                            </div>
                            <div class="modal-body">
                                <?= form_open('', 'id=formadd role=form class=form-horizontal') ?>
                                <input type="hidden" name="no_antri" id="antrian" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <!-- Data Customer -->
                                            <div class="col-lg-12">
                                                <div class="form-group tight">
                                                    <label class="col-lg-3 control-label">No. Transaksi</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="no_transaksi" class="form-control validate_input" id="no_transaksi" placeholder="<?= $noreg; ?>" value="<?= $noreg; ?>" style="width: 300px;" disabled />
                                                    </div>
                                                </div>
                                                <div class="form-group tight">
                                                    <label class="col-lg-3 control-label">No. CM</label>
                                                    <div class="col-lg-4">
                                                        <input type="hidden" name="id_customer" id="id_customer">
                                                        <input type="text" name="no_customer" class="select2-input" id="no_customer" placeholder="No. Customer" style="width: 300px;">
                                                    </div>
                                                </div>
                                                <div class="form-group tight">
                                                    <label class="col-lg-3 control-label">Nama&nbsp;Customer</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="nama_customer" class="form-control validate_input" id="nama_customer" placeholder="Nama Customer" style="width: 300px;" />
                                                    </div>
                                                </div>
                                                <div class="form-group tight">
                                                    <label class="col-lg-3 control-label">Alamat</label>
                                                    <div class="col-lg-9">
                                                        <textarea name="alamat" class="form-control validate_input" id="alamat" placeholder="Alamat" style="width: 300px;"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group tight">
                                                    <label class="col-lg-3 control-label">Telp.</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="telp" class="form-control validate_input" id="telp" placeholder="No. Telp" style="width: 300px;" />
                                                    </div>
                                                </div>
                                                <div class="form-group tight">
                                                    <label class="col-lg-3 control-label">No. Antri</label>
                                                    <div class="col-lg-6">
                                                        <h4 style="padding-top:4px;" id="no_antri"></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Data Customer -->
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <!-- Data User -->
                                            <div class="col-lg-12">
                                                <div class="form-group tight">
                                                    <label class="col-lg-3 control-label">Tanggal Masuk</label>
                                                    <div class="col-lg-6">
                                                        <h4 id="tanggal"><?= date('d/m/Y') ?></h4>
                                                    </div>
                                                    <!-- <div class="col-lg-9">
                                                            <input type="text" name="waktu_daftar" class="form-control" id="waktu_daftar" placeholder="<?= date('d/m/Y');  ?>" value="<?= date('d/m/Y');  ?>" style="width: 300px;" disabled/>
                                                        </div> -->
                                                </div>
                                                <div class="form-group tight">
                                                    <label class="col-lg-3 control-label">Nama User</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="id_user" class="form-control validate_input" id="id_user" style="width: 300px;" placeholder="<?= $this->session->userdata('nama'); ?>" disabled />
                                                    </div>
                                                </div>
                                                <div class="form-group tight">
                                                    <label class="col-lg-3 control-label">Jenis Pewangi</label>
                                                    <div class="col-lg-4">
                                                        <input type="text" name="jenis_pewangi" class="select2-input" id="jenis_pewangi" placeholder="Jenis Pewangi" style="width: 300px;">
                                                    </div>
                                                </div>
                                                <div class="form-group tight">
                                                    <label class="col-lg-3 control-label">Jenis Cucian</label>
                                                    <div class="col-lg-4">
                                                        <input type="text" name="jenis_paket" class="select2-input" id="jenis_paket" placeholder="" style="width: 300px;">
                                                    </div>
                                                </div>
                                                <div class="form-group tight">
                                                    <label for="kode" class="col-lg-3 control-label">Satuan</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="jml" class="form-control" id="jml" placeholder="Jml" style="width: 70px; float: left; margin-right: 5px;" value="1">
                                                        <input type="text" name="satuan" class="form-control" id="satuan" placeholder="" style="max-width: 100px; float: left; margin-right: 5px;" disabled>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="kode" class="col-lg-3 control-label"></label>
                                                    <div class="col-lg-9">
                                                        <button type="button" class="btn btn-primary" id="pilih"><i class="fa fa-arrow-circle-down"></i> Tambahkan</button>
                                                        <button type="button" class="btn" onclick="reset_form()"><i class="fa fa-refresh"></i> Reset Form</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Data User -->
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-hover table-condensed" id="table_laundry">
                                            <thead>
                                                <tr class="info">
                                                    <th width="5%" style="text-align: center;">NO</th>
                                                    <th width="45%">NAMA ITEM</th>
                                                    <th width="10%" style="text-align: center;">SATUAN</th>
                                                    <th width="10%" style="text-align: center;">JUMLAH</th>
                                                    <th width="10%" style="text-align: center;">HARGA</th>
                                                    <th width="10%" style="text-align: center;">SUBTOTAL</th>
                                                    <th width="10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <!-- Data Pembayaran -->
                                    <div class="col-lg-12">
                                        <div class="form-group tight">
                                            <label class="col-lg-9 control-label">Status Bayar</label>
                                            <div class="col-lg-3">
                                                <select name="status_bayar" id="status_bayar" class="form-control">
                                                    <option value="Belum Lunas">Belum Lunas</option>
                                                    <option value="Lunas">Lunas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group tight">
                                            <label class="col-lg-9 control-label">Grand Total</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="grandtotal" onkeyup="convertToCurrency(this)" class="form-control validate_input" id="grandtotal" style="text-align: right;" disabled="" />
                                            </div>
                                        </div>
                                        <div class="form-group tight">
                                            <label class="col-lg-9 control-label">Pembayaran/DP</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="bayar" onkeyup="convertToCurrency(this)" class="form-control validate_input" id="bayar" style="text-align: right;" />
                                            </div>
                                        </div>
                                        <div class="form-group tight">
                                            <label for="nama" class="col-lg-9 control-label">Kembalian</label>
                                            <div class="col-lg-3">
                                                <span id="kembalian_detail" style="font-size: 30px; float: right;"></span>
                                                <input type="hidden" name="kembalian" id="kembalian">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Data Pembayaran -->
                                </div>
                                <?= form_close() ?>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" onclick="reset_data()"><i class="fa fa-refresh"></i> Reset</button>
                                <button type="button" class="btn btn-primary" onclick="konfirmasi_simpan()"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal laundry masuk -->

                <!-- modal cari -->
                <div class="modal inmodal fade" id="search_modal" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="modal_title_search">Pencarian Data Laundry</h4>
                            </div>
                            <div class="modal-body">
                                <?= form_open('', 'id=formsearch role=form class=form-horizontal') ?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Tanggal</label>
                                    <div class="col-lg-3">
                                        <input type="text" name="awal" value="<?= date('d/m/Y') ?>" class="form-control" id="awal" placeholder="Awal">
                                    </div>
                                    <div class="col-lg-1">
                                        <center>
                                            <h5 style="padding-top:9px;">s.d</h5>
                                        </center>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" name="akhir" value="<?= date('d/m/Y') ?>" class="form-control" id="akhir" placeholder="Akhir">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">No. Register</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="no_register" class="form-control" id="no_register_search" placeholder="No. Register">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_customer" class="col-lg-3 control-label">No. RM</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="no_customer" class="form-control" id="no_customer_search" placeholder="No. RM">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_customer" class="col-lg-3 control-label">Nama</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="nama_customer" class="form-control" id="nama_customer_search" placeholder="Nama Pasien">
                                    </div>
                                </div>
                                <?= form_close() ?>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal"><i class="fa fa-refresh"></i> Keluar</button>
                                <button type="button" class="btn btn-primary" onclick="search_data()"><i class="fa fa-search"></i> Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal cari -->

                <!-- modal detail data laundry -->
                <div class="modal inmodal" id="modal_data_detail" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" style="width: 80%; height: 100%;">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <i class="fa fa-laptop modal-icon"></i>
                                <h4 class="modal-title">Detail Data Laundry</h4>
                                <!-- <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small> -->
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <table class="table table-striped table-hover">
                                            <tbody class="ibox-content">
                                                <tr>
                                                    <td width="30%"><strong>No Customer</strong></td>
                                                    <td><span id="no_customer_detail"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Nama Customer</strong></td>
                                                    <td><span id="nama_customer_detail"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Alamat</strong></td>
                                                    <td><span id="alamat_detail"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Telp</strong></td>
                                                    <td><span id="telp_detail"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status Customer</strong></td>
                                                    <td><span id="sts_customer_detail"></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table class="table table-striped table-hover">
                                            <tbody class="ibox-content">
                                                <tr>
                                                    <td width="30%"><strong>No Transaksi</strong></td>
                                                    <td><span id="no_register_detail"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Waktu Masuk</strong></td>
                                                    <td><span id="waktu_daftar_detail"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>No Antrian</strong></td>
                                                    <td><span id="no_antri_detail"></span>&nbsp;&nbsp;<button type="button" class="btn btn-success btn-xs" id="cetak_no_antrian"><i class="fa fa-print"></i> Cetak</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status Laundry</strong></td>
                                                    <td><span id="status_laundry_detail" class="blink"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status Bayar</strong></td>
                                                    <td><span id="bayar_detail"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Nama Pewangi</strong></td>
                                                    <td><span id="jenis_pewangi_detail"></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="list-group">
                                            <li class="list-group-item active"><strong>DETAIL ITEM LAUNDRY</strong></li>
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-content">
                                                    <li class="list-group-item">
                                                        <table class="table table-striped table-hover" id="item_detail_laundry">
                                                            <thead>
                                                                <tr class="info">
                                                                    <th width="5%" style="text-align: center;">NO</th>
                                                                    <th width="45%">NAMA ITEM</th>
                                                                    <th width="10%" style="text-align: center;">JUMLAH</th>
                                                                    <th width="10%" style="text-align: center;">SATUAN</th>
                                                                    <th width="10%" style="text-align: center;">HARGA</th>
                                                                    <th width="10%" style="text-align: center;">SUBTOTAL</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th colspan="5">JUMLAH</th>
                                                                    <th id="grand_total" style="text-align: center; color: red"></th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </li>
                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="reset_detail_form()"><i class="fa fa-check"></i>&nbsp;Oke</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal detail -->

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        get_list_laundry_masuk(1, '');

        $("#awal, #akhir").datepicker({
            format: 'dd/mm/yyyy'
        }).on('changeDate', function() {
            $(this).datepicker('hide');
        });

        $('#bt_tambah_laundry_masuk').click(function() {
            $('#modal_laundry_masuk').modal('show');
            $('#modal_title_laundry_masuk').html('Entri Pendaftaran Laundry');
            reset_data();
        });

        $('#bt_pencarian_laundry_masuk').click(function() {
            reset_data();
            $('#search_modal').modal('show');
        });

        $('#formadd').submit(function() {
            return false;
        });

        $('#bt_reset').click(function() {
            reset_data();
            get_list_laundry_masuk(1, '');
        });

        $('.validate_input').keyup(function() {
            if ($(this).val() !== '') {
                dc_validation_remove(this);
            }
        });

        $('.validate_input').change(function() {
            if ($(this).val() !== '') {
                dc_validation_remove(this);
            }
        });

        $('#no_customer').change(function() {
            var tanggal = $('#tanggal').html();
            get_antrian(tanggal, $(this).val(), '#no_antri', '#antrian');
        });

        $('#nama_customer').change(function() {
            var tanggal = $('#tanggal').html();
            get_antrian(tanggal, $(this).val(), '#no_antri', '#antrian');
        });

        $('#no_customer').select2({
            ajax: {
                url: "<?= base_url('api/transaksi_auto/customer_auto') ?>",
                dataType: 'json',
                quietMillis: 100,
                data: function(term, page) { // page is the one-based page number tracked by Select2
                    return {
                        q: term, //search term
                        page: page, // page number
                    };
                },
                results: function(data, page) {
                    var more = (page * 20) < data.total; // whether or not there are more results available

                    // notice we return the value of more so Select2 knows if more results can be loaded
                    return {
                        results: data.data,
                        more: more
                    };
                }
            },
            formatResult: function(data) {
                var markup = '<b>' + data.id + '</b>' + ' ' + data.nama_customer + '<br/>' + data.alamat;
                return markup;
            },
            formatSelection: function(data) {
                fill_data_customer(data);
                // cek_pelunasan(data.id);
                return data.id;
            }
        });

        $('#jenis_pewangi').select2({
            ajax: {
                url: "<?= base_url('api/transaksi_auto/jenis_pewangi_auto') ?>",
                dataType: 'json',
                quietMillis: 100,
                data: function(term, page) { // page is the one-based page number tracked by Select2
                    return {
                        q: term, //search term
                        page: page, // page number
                    };
                },
                results: function(data, page) {
                    var more = (page * 20) < data.total; // whether or not there are more results available

                    // notice we return the value of more so Select2 knows if more results can be loaded
                    return {
                        results: data.data,
                        more: more
                    };
                }
            },
            formatResult: function(data) {
                var markup = data.nama_pewangi;
                return markup;
            },
            formatSelection: function(data) {
                return data.nama_pewangi;
            }
        });

        $('#jenis_paket').select2({
            ajax: {
                url: "<?= base_url('api/transaksi_auto/jenis_paket_auto') ?>",
                dataType: 'json',
                quietMillis: 100,
                data: function(term, page) { // page is the one-based page number tracked by Select2
                    return {
                        q: term, //search term
                        page: page, // page number
                    };
                },
                results: function(data, page) {
                    var more = (page * 20) < data.total; // whether or not there are more results available

                    // notice we return the value of more so Select2 knows if more results can be loaded
                    return {
                        results: data.data,
                        more: more
                    };
                }
            },
            formatResult: function(data) {
                var markup = data.nama_paket;
                return markup;
            },
            formatSelection: function(data) {
                fill_data_paket(data);
                return data.nama_paket;
            }
        });

        $('#pilih').click(function() {
            var id_paket = $('#jenis_paket').val();
            var nama_paket = $('#s2id_jenis_paket a .select2-chosen').html();
            var jumlah = $('#jml').val();
            var satuan = $('#satuan').val();

            if (nama_paket !== '') {
                add_new_rows(id_paket, nama_paket, jumlah, satuan);
                reset_paket();
            } else {
                //message_custom('error', 'Nama Paket Harus Diisi');
                dc_validation('#jenis_paket', 'Jenis Cucian harus diisi!');
            }
        });

        $('#jumlah').keydown(function(e) {
            if (e.keyCode === 13) {
                $('#pilih').click();
            }
        });

        $('#bayar').keyup(function() {
            var grandtotal = parseInt(currencyToNumber($('#grandtotal').val()));
            var bayar = parseInt(currencyToNumber($('#bayar').val()));
            var kembalian = bayar - grandtotal;
            if (kembalian < 0) {
                kembalian = 0;
            };

            $('#kembalian_detail').html(numberToCurrency(kembalian));
            $('#kembalian').val(kembalian);
        });


    });

    function add_new_rows(id_paket, nama_paket, jumlah, satuan) {
        var jml = $('.tr_rows').length;
        var str = '<tr class="tr_rows">' +
            '<td align="center">' + (jml + 1) + '</td>' +
            '<td>' + nama_paket + ' <input type="hidden" name="id_paket[]" id="id_paket' + jml + '" value="' + id_paket + '" class="form-control control" /></td>' +
            '<td align="center">' + satuan + ' <input type="hidden" name="id_satuan[]" id="id_satuan' + jml + '" class="form-control control" /></td>' +
            '<td><input type="text" name="jumlah[]" id="jumlah' + jml + '" class="form-control control" value="' + jumlah + '" style="text-align: center;" size=5 /></td>' +
            '<td align=right><span id="harga' + jml + '">-</span><input type="hidden" name="harga[]" id="hargahide' + jml + '" class="form-control control" /></td>' +
            '<td align=right><span id="subtotal' + jml + '">-</span><input type="hidden" name="subtotal[]" id="subtotalhide' + jml + '" class="form-control control" /></td>' +
            '<td>' +
            '<button type="button" class="btn btn-xs" onclick="removeMe(this);"><i class="fa fa-trash-o"></i> Hapus</button>' +
            '</td>' +
            '</tr>';
        $('#table_laundry tbody').append(str);
        var total = 0;
        $.ajax({
            type: 'GET',
            url: '<?= base_url('api/masterdata/jenis_paket') ?>?id=' + id_paket,
            dataType: 'json',
            cache: false,
            success: function(data) {
                var harga = data.data.harga_paket;
                var subtotal = Math.ceil(data.data.harga_paket) * jumlah;
                $('#harga' + jml).html(numberToCurrency(Math.ceil(harga)));
                $('#hargahide' + jml).val(Math.ceil(harga));
                $('#subtotal' + jml).html(numberToCurrency(subtotal));
                $('#subtotalhide' + jml).val(subtotal);
                hitung_total();
            }
        });

        $('#jumlah' + jml).keyup(function() {
            var jml = $(this).val();
            var hna = $('#hargahide' + jml).val();
            if (jml !== '') {
                var subtotal = jml * hna;
                $('#subtotal' + jml).html(numberToCurrency(subtotal));
                $('#subtotalhiden' + jml).val(numberToCurrency(subtotal));
            }
        });
    }

    function hitung_total() {
        var jml_baris = $('.tr_rows').length;
        var estimasi = 0;
        for (i = 0; i <= jml_baris - 1; i++) {
            var subtotal = parseInt(currencyToNumber($('#subtotal' + i).html()));
            estimasi = estimasi + subtotal;
        }
        $('#grandtotal').val(numberToCurrency(parseInt(estimasi)));
    }

    function hitungGrangTotal() {
        var jumlah = $('.tr_rows').length - 1;
        var total = 0;
        for (i = 0; i <= jumlah; i++) {
            var subtotal = $('#subtotalhiden' + i).val();
            if (subtotal !== '') {
                total = total + parseInt(subtotal);
            }
        }
        $('#grandtotal').val(numberToCurrency(total));
    }

    function get_antrian(tanggal, id_unit, elemen_html, elemen_value) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url("api/transaksi/laundry_get_antrian") ?>/',
            data: 'tanggal=' + tanggal + '&id_unit=' + id_unit,
            cache: false,
            dataType: 'json',
            success: function(data) {
                $(elemen_html).html(data.antrian);
                $(elemen_value).val(data.antrian);
            },
            error: function(e) {
                access_failed(e.status);
            }
        });
    }

    function removeMe(el) {
        var parent = el.parentNode.parentNode;
        parent.parentNode.removeChild(parent);
        var jumlah = $('.tr_rows').length;
        var col = 0;
        for (i = 1; i <= jumlah; i++) {
            $('.tr_rows:eq(' + col + ')').children('td:eq(0)').html(i);
            $('.tr_rows:eq(' + col + ')').children('td:eq(1)').children('.id_paket').attr('id', 'id_paket' + i);
            $('.tr_rows:eq(' + col + ')').children('td:eq(2)').children('.nama_paket').attr('id', 'nama_paket' + i);
            $('.tr_rows:eq(' + col + ')').children('td:eq(3)').children('.jumlah').attr('id', 'jumlah' + i);
            col++;
        }

    }

    function reset_detail_form() {
        $('#item_detail_laundry tbody').empty();
        $('#modal_data_detail').modal("hide");
    }

    function reset_data() {
        $('#id, #pencarian, #antrian, #nama_customer_search, #no_register_search, #no_customer_search').val('');
        $('#nama_customer').val('');
        $('#alamat').val('');
        $('#telp').val('');
        $('#jml').val('');

        $('#grandtotal').val('');
        $('#bayar').val('');

        $('#s2id_no_customer a .select2-chosen').html('');
        $('#s2id_jenis_pewangi a .select2-chosen').html('');
        $('#s2id_jenis_paket a .select2-chosen').html('');

        $('#no_customer, #no_antri').html('');
        $('#awal, #akhir').val('<?= date("d/m/Y") ?>');
        dc_validation_remove('.validate_input');
        dc_validation_remove('.select2-input');
    }

    function reset_paket() {
        $('#jml').val('');
        $('#s2id_jenis_paket a .select2-chosen').html('');
        dc_validation_remove('.validate_input');
        dc_validation_remove('.select2-input');
    }

    function reset_form() {
        $('#table_laundry tbody').empty();
        $('#grandtotal').val('');
        $('#bayar').val('');
    }

    function reset_antri() {
        $('#no_antri2').html('');
        $('#antrian2, #layanan_antri').val('');
        dc_validation_remove('.validate_input');
    }

    function fill_data_customer(data) {
        $('#nama_customer').val(data.nama_customer);
        $('#alamat').val(data.alamat);
        $('#telp').val(data.telp);
    }

    function fill_data_paket(data) {
        $('#jml').val('1');
        $('#satuan').val(data.satuan_paket);
    }

    function search_data() {
        get_list_laundry_masuk(1, '');
        $('#search_modal').modal('hide');
    }

    function konfirmasi_simpan() {
        var stop = false;

        if ($('#nama_customer').val() === '') {
            dc_validation('#nama_customer', 'Nama customer harus diisi!');
            stop = true;
        };

        if ($('#alamat').val() === '') {
            dc_validation('#alamat', 'Alamat harus diisi!');
            stop = true;
        };


        if ($('#telp').val() === '') {
            dc_validation('#telp', 'Telp harus diisi!');
            stop = true;
        };

        if (stop) {
            return false;
        };

        klik = null;
        Swal({
            title: 'Simpan Laundry',
            text: "Anda yakin akan mengentri data ini ?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#ddd',
            confirmButtonText: 'Simpan!'
        }).then((result) => {
            if (result.value) {
                save_data();
            }
        })
    }

    function save_data() {
        var update = '';
        if ($('#no_customer').val() !== '') {
            update = 'id/' + $('#no_customer').val();
        }

        if (klik === null) {
            show_ajax_indicator();
            klik = $.ajax({
                type: 'POST',
                url: '<?= base_url("api/transaksi/laundry") ?>/' + update,
                data: $('#formadd').serialize(),
                cache: false,
                dataType: 'json',
                success: function(data) {
                    $('#modal_laundry_masuk').modal('hide');
                    if ($('#id_customer').val() !== '') {
                        message_edit_success();
                        get_list_laundry_masuk($('#page_now').val());
                    } else {
                        $('#table_laundry tbody').empty();
                        message_add_success();
                        reset_data();
                        get_list_laundry_masuk(1, '');
                    }
                },
                error: function(e) {
                    if ($('#id').val() !== '') {
                        message_edit_failed();
                    } else {
                        message_add_failed();
                    }
                }
            });
        }


    }

    function get_list_laundry_masuk(p, id) {
        $('#page_now').val(p);
        $.ajax({
            type: 'GET',
            url: '<?= base_url("api/transaksi/laundry_masuk_list") ?>/page/' + p,
            data: $('#formsearch').serialize() + '&id=' + id,
            cache: false,
            dataType: 'json',
            success: function(data) {
                if ((p > 1) & (data.data.length === 0)) {
                    get_list_laundry_masuk(p - 1, '');
                    return false;
                };

                $('#pagination').html(pagination(data.jumlah, data.limit, data.page, 1));
                $('#p_summary').html(page_summary(data.jumlah, data.data.length, data.limit, data.page));

                $('#table_data tbody').empty();
                var str = '';
                var lunas = '';
                var disabled = '';
                $.each(data.data, function(i, v) {
                    disabled = '';
                    if (v.waktu_keluar !== null) {
                        disabled = 'disabled';
                    };

                    if (v.status == 'Baru') {
                        status = "<span class='label label-info'><i class='fa fa-plus'></i>&nbsp;Baru</span>"
                    } else if (v.status == 'Lama') {
                        status = "<span class='label label-primary'><i class='fa fa-history'></i>&nbsp;Lama</span>"
                    }

                    if (v.status_laundry === 'Request') {
                        status_laundry = "<span class='blink'><i>Request</i></span>";
                        button = '<button ' + disabled + ' title="Proses Laundry" type="button" class="btn btn-xs" onclick="proses_laundry(\'' + v.id + '\')"><i class="fa fa-sign-in"></i></button> '
                    } else if (v.status_laundry === 'Proses') {
                        status_laundry = "<span class='label label-warning'><i class='fa fa-spinner fa-spin'></i>&nbsp;Proses</span>"
                        button = '<button ' + disabled + ' title="Verifikasi Laundry Selesai" type="button" class="btn btn-xs" onclick="laundry_selesai(\'' + v.id + '\')"><i class="fa fa-check"></i></button> '
                    } else if (v.status_laundry === 'Selesai') {
                        status_laundry = "<span class='label label-primary'><i class='fa fa-check'></i>&nbsp;Selesai</span>"
                        button = '<button ' + disabled + ' title="Verifikasi Laundry Selesai" type="button" class="btn btn-xs" onclick="laundry_selesai(\'' + v.id + '\')"><i class="fa fa-check"></i></button> '
                    } else if (v.status_laundry === 'Batal') {
                        status_laundry = "<span class='label label-danger'><i class='fa fa-ban'></i>&nbsp;Batal</span>"
                        button = ''
                    }


                    str = '<tr>' +
                        '<td align="center">' + ((i + 1) + ((data.page - 1) * data.limit)) + '</td>' +
                        '<td align="center">' + v.no_register + '</td>' +
                        '<td align="center">' + ((v.waktu_daftar !== null) ? datetimefmysql(v.waktu_daftar) : '') + '</td>' +
                        '<td align="center">' + v.id_customer + '</td>' +
                        '<td>' + v.nama_customer + '</td>' +
                        '<td align="center">' + ((v.waktu_keluar !== null) ? datetimefmysql(v.waktu_keluar) : '') + '</td>' +
                        '<td align="center">' + status + '</td>' +
                        '<td align="center">' + status_laundry + '</td>' +
                        '<td align="center">' + v.user + '</td>' +
                        '<td align="right" class="aksi">' +
                        '<button title="Detail Data Laundry" type="button" class="btn btn-xs" onclick="detail_data_laundry(\'' + v.id + '\')"><i class="fa fa-eye"></i></button> ' +
                        button +
                        '<button ' + disabled + ' title="Batalkan Laundry Masuk" type="button" class="btn btn-xs" onclick="batal_laundry_masuk(\'' + v.id + '\')"><i class="fa fa-trash-o"></i></button> ' +
                        '</td>' +
                        '</tr>';
                    $('#table_data tbody').append(str);
                });
            },
            error: function(e) {
                access_failed(e.status);
            }
        });
    }

    function paging(p) {
        get_list_laundry_masuk(p, '');
    }

    function detail_data_laundry(id) {
        $('#item_detail_laundry tbody').empty();
        $.ajax({
            type: 'GET',
            url: '<?= base_url("api/transaksi/laundry_masuk_detail"); ?>/id/' + id,
            cache: false,
            dataType: 'json',
            success: function(data) {
                if (data.customer !== null) {
                    hasil = data.customer;

                    $('#no_register_detail').html(hasil.no_register);
                    $('#no_customer_detail').html(hasil.id_customer);
                    $('#nama_customer_detail').html(hasil.nama_customer);
                    $('#alamat_detail').html(hasil.alamat);
                    $('#telp_detail').html(hasil.telp);
                    $('#waktu_daftar_detail').html(datetimefmysql(hasil.waktu_daftar));
                    $('#sts_customer_detail').html(hasil.status);
                    $('#jenis_pewangi_detail').html(hasil.nama_pewangi);
                    $('#no_antri_detail').html(hasil.no_antri);
                    $('#status_laundry_detail').html(hasil.status_laundry);
                    $('#bayar_detail').html(hasil.bayar);
                    $('#total_detail').html(hasil.total);
                    $('#jumlahbayar_detail').html(hasil.jumlahbayar);

                    $('#cetak_no_antrian').click(function() {
                        alert(hasil.no_antri);
                    });

                    var str = '';
                    if (data.detail.length > 0) {
                        var grandtotal = 0;
                        $.each(data.detail, function(i, v) {
                            var subtotal = v.jumlah * v.harga;
                            str = '<tr>' +
                                '<td align="center">' + (i + 1) + '</td>' +
                                '<td>' + v.nama_paket + '</td>' +
                                '<td align="center">' + v.jumlah + '</td>' +
                                '<td align="center">' + v.satuan_paket + '</td>' +
                                '<td align="center">' + numberToCurrency(v.harga) + '</td>' +
                                '<td align="center">' + numberToCurrency(subtotal) + '</td>' +
                                '</tr>';
                            $('#item_detail_laundry tbody').append(str);
                            grandtotal += (v.jumlah * v.harga);
                            $('#grand_total').html(numberToCurrency(grandtotal));
                        });
                    }

                    $('#modal_data_detail').modal("show");
                }
            },

            error: function(e) {
                access_failed(e.status);
            }

        });

    }

    function convertToCurrency(obj) {
        if ($(obj).val() !== '') {
            var conv = currencyToNumber($(obj).val());
            $(obj).val(numberToCurrency(conv));
        } else {
            $(obj).val(0);
        }
    }

    function proses_laundry(id) {
        Swal({
            title: 'Proses Laundry',
            text: "Anda yakin ingin memproses laundry ini ?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#ddd',
            confirmButtonText: 'Proses!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url("api/transaksi/proses_laundry"); ?>/id/' + id,
                    cache: false,
                    dataType: 'json',
                    success: function(data) {
                        get_list_laundry_masuk(1, '');
                        message_custom('success', 'Laundry Sedang Di Proses');
                    },

                    error: function(e) {
                        access_failed(e.status);
                    }

                });
            }
        })
    }

    function laundry_selesai(id) {
        Swal({
            title: 'Verifikasi Laundry',
            text: "Apakah laundry sudah selesai ?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1ab394',
            cancelButtonColor: '#ddd',
            confirmButtonText: 'Selesai'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url("api/transaksi/laundry_selesai"); ?>/id/' + id,
                    cache: false,
                    dataType: 'json',
                    success: function(data) {
                        get_list_laundry_masuk(1, '');
                        message_custom('success', 'Laundry sudah selesai');
                    },

                    error: function(e) {
                        access_failed(e.status);
                    }

                });
            }
        })
    }

    function batal_laundry_masuk(id) {
        Swal({
            title: 'Pembatalan Laundry',
            text: "Apakah anda yakin melakukan pembatalan ?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: '#ddd',
            confirmButtonText: 'Batalkan'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url("api/transaksi/batal_laundry"); ?>/id/' + id,
                    cache: false,
                    dataType: 'json',
                    success: function(data) {
                        get_list_laundry_masuk(1, '');
                        message_custom('info', 'Laundry dibatalkan');
                    },

                    error: function(e) {
                        access_failed(e.status);
                    }

                });
            }
        })
    }

    function cek_pelunasan(id) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url("api/transaksi/cek_pelunasan_customer") ?>/' + id,
            cache: false,
            dataType: 'json',
            success: function(data) {
                if (data.sisa == 'Belum') {
                    bootbox.dialog({
                        message: "Pasien in belum melunasi tagihan kunjungan sebelumnya. <br/> Segera lunasi tagihan sebelummnya!",
                        title: "Pemberitahuan!",
                        buttons: {
                            hapus: {
                                label: '<i class="fa fa-check"></i>  OK',
                                className: "btn-primary",
                                callback: function() {

                                }
                            }
                        }
                    });
                }
            },
            error: function(e) {
                access_failed(e.status);
            }
        });
    }
</script>