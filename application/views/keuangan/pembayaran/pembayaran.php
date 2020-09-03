<div class="ibox-content m-b-sm border-bottom">
    <div class="row">
        <div class="col-sm-12">
            <?= form_button('pencarian', '<i class="fa fa-search"></i> Pencarian' ,'id=bt_pencarian_pembayaran class="btn btn-success"')?></li>
            <?= form_button('reset', '<i class="fa fa-refresh"></i> Reload Data' ,'id=bt_reset class="btn"')?></li>
        </div>
    </div>
</div>


<input type="hidden" name="page_now" id="page_now"/>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">            
            <div class="ibox-content">
                <!-- data table laundry masuk -->
                <table class="table table-hover table-condensed" id="table_data">
                    <thead>
                        <tr class="info">
                            <th width="5%" style="text-align: center;">NO</th>
                            <th width="10%" style="text-align: center;">NO REGISTER</th>
                            <th width="12%" style="text-align: center;">WAKTU MASUK</th>
                            <th width="10%" style="text-align: center;">NO CM</th>
                            <th width="40%">NAMA</th>
                            <th width="13%" style="text-align: center;">STATUS</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <!-- end data table -->

                <div class="pages_summary" id="p_summary"></div>       
                <div id="pagination"></div>
                    
                <!-- modal cari -->
                <div class="modal inmodal fade" id="search_modal" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="modal_title_search">Pencarian Data Laundry</h4>
                            </div>
                            <div class="modal-body">
                                <?= form_open('','id=formsearch role=form class=form-horizontal') ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Tanggal</label>
                                        <div class="col-lg-3">
                                          <input type="text" name="awal" value="<?= date('d/m/Y') ?>" class="form-control" id="awal" placeholder="Awal">
                                        </div>
                                        <div class="col-lg-1">
                                            <center><h5 style="padding-top:9px;">s.d</h5></center>
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

                <!-- modal Bayar -->
                <div class="modal inmodal fade" id="modal_bayar" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" style="width: 85%">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="modal_title_search">Form Pembayaran</h4>
                            </div>
                            <div class="modal-body">
                                <?= form_open('','id=formadd role=form class=form-horizontal') ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <table class="table table-striped table-hover">
                                          <tbody class="ibox-content">
                                            <tr>
                                                <td width="40%"><strong>No Customer</strong></td>
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
                                        <br><br>
                                        <h2><strong>Bayar</strong></h2><br>
                                        <div class="row">
                                            <!-- Data Pembayaran -->
                                            <input type="hidden" name="id" id="id">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="nama" class="col-lg-4 control-label" style="font-size: 40px">Tagihan</label>
                                                    <div class="col-lg-8">
                                                        <span id="tagihan" style="font-size: 40px; float: right;"></span>
                                                        <input type="hidden" name="tagihan" id="tagihan">
                                                    </div>
                                                </div><br><br>
                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label">Bayar</label>
                                                    <div class="col-lg-8 input-group">
                                                        <span class="input-group-addon">Rp.</span>
                                                        <input type="text" name="bayar" class="form-control" id="bayar" onkeyup="convertToCurrency(this)">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label">Uang Diserahkan</label>
                                                    <div class="col-lg-8 input-group">
                                                        <span class="input-group-addon">Rp.</span>
                                                        <input type="text" name="serah" class="form-control" id="serah" onkeyup="convertToCurrency(this)">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama" class="col-lg-4 control-label">Kembalian</label>
                                                    <div class="col-lg-8">
                                                        <span id="kembalian_detail" style="font-size: 30px; float: right;">0</span>
                                                        <input type="hidden" name="kembalian" id="kembalian" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Data Pembayaran -->
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <h2><strong>Rincian Tagihan</strong></h2>
                                        <ul class="list-group">
                                            <li class="list-group-item active"><strong>DETAIL ITEM LAUNDRY</strong></li>
                                            <!-- <div class="ibox float-e-margins">            
                                                <div class="ibox-content"> -->
                                                    <li class="list-group-item">
                                                        <table class="table table-striped table-hover" id="item_detail_laundry">
                                                            <thead>
                                                                <tr class="info">
                                                                    <th width="5%" style="text-align: center;">NO</th>
                                                                    <th width="45%">NAMA ITEM</th>
                                                                    <th width="10%" style="text-align: center;">JUMLAH</th>
                                                                    <th width="10%" style="text-align: center;">SATUAN</th>
                                                                    <th width="10%" style="text-align: center;">HARGA</th>
                                                                    <th width="10%" style="text-align: center;">TOTAL</th>
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
                                            <!--     </div>
                                            </div> -->
                                        </ul>
                                    </div>
                                </div>
                                <?= form_close() ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal"><i class="fa fa-refresh"></i> Keluar</button>
                                <button type="button" class="btn btn-primary" onclick="konfirmasi_simpan()"><i class="fa fa-money"></i> Bayar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal Bayar -->

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        var klik = null;
        var dWidth = $(window).width();
        var dHeight= $(window).height();
        var x = screen.width/2 - dWidth/2;
        var y = screen.height/2 - dHeight/2;
        
        get_list_pembayaran(1,'');

        $("#awal, #akhir").datepicker({
            format: 'dd/mm/yyyy'
        }).on('changeDate', function(){
            $(this).datepicker('hide');
        });

        $('#bt_pencarian_pembayaran').click(function(){
            reset_data();
            $('#search_modal').modal('show');
        });

        $('#formadd').submit(function(){
            return false;
        });

        $('#bt_reset').click(function(){
            reset_data();
            get_list_pembayaran(1, '');
        });

        $('.validate_input').keyup(function(){
            if($(this).val() !== ''){
                dc_validation_remove(this);
            }
        });

        $('.validate_input').change(function(){
            if($(this).val() !== ''){
                dc_validation_remove(this);
            }
        });

        $('#jumlah').keydown(function(e) {
            if (e.keyCode === 13) {
                $('#pilih').click();
            }
        });

        $('#serah').keyup(function(){
            var grandtotal = parseInt(currencyToNumber($('#bayar').val()));
            var serah = parseInt(currencyToNumber($('#serah').val()));
            var kembalian = serah - grandtotal;
            if (kembalian < 0) {
                kembalian = 0;
            };

            $('#kembalian_detail').html(numberToCurrency(kembalian));
            $('#kembalian').val(kembalian);
        });


    });

    function hitungGrangTotal() {
        var jumlah = $('.tr_rows').length-1;
        var total = 0;
        for (i = 0; i <= jumlah; i++) {
            var subtotal = $('#subtotalhiden'+i).val();
            if (subtotal !== '') {
                total = total + parseInt(subtotal);
            }
        }
        $('#grandtotal').val(numberToCurrency(total));
    }
    

    function reset_data(){
        $('#id, #pencarian, #nama_customer_search, #no_register_search, #no_customer_search').val('');
        $('#awal, #akhir').val('<?= date("d/m/Y") ?>');
        dc_validation_remove('.validate_input');
        dc_validation_remove('.select2-input');
    }

    function reset_pembayaran() {
        $('#serah').val('');
        $('#kembalian').val('');
        $('#kembalian_detail').html('0');
        dc_validation_remove('.validate_input');
        dc_validation_remove('.select2-input');
    }

    function search_data(){
        get_list_pembayaran(1, '');
        $('#search_modal').modal('hide');
    }

    function konfirmasi_simpan(){
        show_ajax_indicator();
        var stop = false;
        
        if ($('#serah').val() === '') {
            dc_validation('#serah', 'Uang yang diserahkan harus lebih besar atau sama dengan nominal yang akan dibayarkan!');
            stop = true;   
        };

        if (stop) {
            return false;
        };

        klik = null;
        Swal({
            title: 'Konfirmasi Pembayaran',
            text: "Anda yakin akan melakukan transaksi pembayaran ?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#ddd',
            confirmButtonText: 'Ya!'
        }).then((result) => {
          if (result.value) {
            save_data();
          }
        })
    }

    function save_data() {
        show_ajax_indicator();
        var update = '';
        if($('#id').val() !== ''){
            update = 'id/'+ $('#id').val();
        }

        if (klik === null) {
            show_ajax_indicator();
            klik = $.ajax({
                type : 'POST',
                url: '<?= base_url("api/keuangan/pembayaran") ?>/'+update,
                data: $('#formadd').serialize(),
                cache: false,
                dataType : 'json',
                success: function(data) {
                    $('#modal_bayar').modal('hide');
                    if ($('#id').val() !== '') {
                        $('#table_laundry tbody').empty();
                        message_custom('success', 'Pembayaran Sukses');
                        reset_data();
                        get_list_pembayaran(1, '');
                    }
                },
                error: function(e){
                    if ($('#id').val() !== '') {
                        message_edit_failed();
                    }                }
            });
        }
        

    }

    function get_list_pembayaran(p, id) {
        $('#page_now').val(p);
        $.ajax({
            type : 'GET',
            url: '<?= base_url("api/keuangan/pembayaran_list") ?>/page/'+p,
            data: $('#formsearch').serialize()+'&id='+id,
            cache: false,
            dataType : 'json',
            success: function(data) {
                if ((p > 1) & (data.data.length === 0)) {
                    get_list_pembayaran(p-1, '');
                    return false;
                };
                
                $('#pagination').html(pagination(data.jumlah, data.limit, data.page, 1));
                $('#p_summary').html(page_summary(data.jumlah, data.data.length, data.limit, data.page));

                $('#table_data tbody').empty();          
                var str = ''; var lunas = '';
                $.each(data.data,function(i, v){

                    if (v.status_bayar === 'Belum Lunas') {
                        status_bayar = "<span class='blink'><i class='fa fa-spinner fa-spin'></i><i>&nbsp;Belum Lunas</i></span>";
                        disabled = '';
                    } else if (v.status_bayar === 'Lunas') {
                        status_bayar = "<span class='label label-primary'><i class='fa fa-check'></i>&nbsp;Sudah Lunas</span>"
                        disabled = 'disabled';
                    }

                    str = '<tr>'+
                            '<td align="center">'+((i+1) + ((data.page - 1) * data.limit))+'</td>'+
                            '<td align="center">'+v.no_register+'</td>'+
                            '<td align="center">'+((v.waktu_daftar !== null)?datetimefmysql(v.waktu_daftar):'')+'</td>'+
                            '<td align="center">'+v.id_customer+'</td>'+
                            '<td>'+v.nama_customer+'</td>'+
                            '<td align="center">'+status_bayar+'</td>'+
                            '<td align="right" class="aksi">'+
                                '<button title="Klik untuk melakukan pembayaran" type="button" class="btn btn-xs" onclick="pembayaran_laundry(\''+v.id+'\')" '+disabled+'><i class="fa fa-plus"></i></button> '+
                                '<button title="Riwayat Pembayaran" type="button" class="btn btn-xs" onclick="cetak_kwitansai_pembayaran_laundry(\''+v.id+'\')"><i class="fa fa-print"></i></button> '+
                            '</td>'+
                        '</tr>';
                    $('#table_data tbody').append(str);
                });                
            },
            error: function(e){
                access_failed(e.status);
            }
        });
    }

    function paging(p){
        get_list_pembayaran(p, '');
    }

    function pembayaran_laundry(id) {
        $('#item_detail_laundry tbody').empty();
        reset_pembayaran();
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/keuangan/pembayaran_detail"); ?>/id/'+id,
            cache : false,
            dataType : 'json',
            success: function (data) {
                if (data.customer !== null) {
                    hasil = data.customer;

                    $('#id').val(hasil.id);
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

                    var str = '';
                    if (data.detail.length > 0) {
                        var grandtotal = 0;
                        $.each(data.detail, function(i, v){
                            var subtotal = v.jumlah * v.harga;
                            str =   '<tr>'+
                                        '<td align="center">'+(i+1)+'</td>'+
                                        '<td>'+v.nama_paket+'</td>'+
                                        '<td align="center">'+v.jumlah+'</td>'+
                                        '<td align="center">'+v.satuan_paket+'</td>'+
                                        '<td align="center">'+numberToCurrency(v.harga)+'</td>'+
                                        '<td align="center">'+numberToCurrency(subtotal)+'</td>'+
                                    '</tr>';
                            $('#item_detail_laundry tbody').append(str);
                            grandtotal += (v.jumlah * v.harga);
                            $('#bayar').val(numberToCurrency(grandtotal));
                            $('#grand_total').html(numberToCurrency(grandtotal));
                            $('#tagihan').html(numberToCurrency(grandtotal));
                        });
                    }

                    $('#modal_bayar').modal('show');
                }
            },

            error: function(e){
                access_failed(e.status);
            }

        });
    }

    function cetak_kwitansai_pembayaran_laundry(id) {
        window.open('<?= base_url() ?>printing/nota_pembayaran/'+id,'Cetak Nota Pembayaran');
    }

    function convertToCurrency(obj){
        if ($(obj).val() !== '') {
            var conv = currencyToNumber($(obj).val());
            $(obj).val(numberToCurrency(conv));
        }else{
            $(obj).val(0);
        }
    }

</script>