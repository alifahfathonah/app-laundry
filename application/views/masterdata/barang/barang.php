<div class="ibox-content m-b-sm border-bottom">
    <div class="row">
        <div class="col-sm-10">
           <?= form_button('tambah', '<i class="fa fa-plus"></i> Tambah Data Barang' ,'id=bt_tambah_barang class="btn btn-primary"')?>
            <?= form_button('reset', '<i class="fa fa-refresh"></i> Reload Data' ,'id=bt_reset_barang class="btn"')?></li>
        </div>
        <div class="col-sm-2">
            <input type="text" class="search form-control" onkeyup="get_list_barang(1)" id="pencarian_barang" placeholder="Pencarian">
        </div>
    </div>
</div>


<input type="hidden" name="page_now" id="page_now"/>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">            
            <div class="ibox-content">                
                <table class="table table-striped table-hover" id="table_barang">
                    <thead>
                        <tr class="info">
                            <th width="5%" style="text-align: center;">NO</th>
                            <th width="8%">KODE</th>
                            <th width="15%">NAMA</th>
                            <th width="5%">STOCK</th>
                            <th width="15%" style="text-align: center;">HPP</th>
                            <th width="15%" style="text-align: center;">TOTAL</th>
                            <th width="20%">KATEGORI</th>
                            <th width="5%">STATUS</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div class="pages_summary" id="jp_summary"></div>       
                <div id="pagination"></div>

                <div class="modal inmodal" id="modal_barang" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated flipInY">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="modal_title_barang">Tambah Barang</h4>
                            </div>
                            <div class="modal-body">
                                <?= form_open('', 'id=formjp role=form class=form-horizontal'); ?>
                                    <input type="hidden" name="id" id="id_barang">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Kategori Barang</label>

                                        <div class="col-lg-9">
                                            <select name="kategori" id="kategori" class="form-control">
                                                <?php foreach ($kategoris as $data) { echo '<option value="'.$data->id.'">'.$data->nama.'</option>'; } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Kode Barang</label>

                                        <div class="col-lg-3">
                                            <input type="text" name="kode_barang" id="kode_barang" placeholder="Kode Barang" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Nama Barang</label>

                                        <div class="col-lg-9">
                                            <input type="text" name="nama_barang" id="nama_barang" placeholder="Nama Barang" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Stock</label>

                                        <div class="col-lg-4">
                                            <input type="text" name="stock" id="stock" placeholder="Stock Barang" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Harga Pokok</label>

                                        <div class="col-lg-7">
                                            <input type="text" name="harga_pokok" id="harga_pokok" placeholder="Harga Paket" class="form-control" onkeyup="convertToCurrency(this)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Status</label>

                                        <div class="col-lg-4">
                                            <?= form_dropdown('status', $status, array(), 'class=form-control id=status');?>
                                        </div>
                                    </div>
                                <?= form_close(); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="float-e-margins btn btn-white" data-dismiss="modal"><i class="fa fa-refresh"></i> Batal</button>
                                <button type="button" class="btn btn-primary" onclick="simpan_barang()"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        get_list_barang(1);

        $('#bt_tambah_barang').click(function(){
            $('#modal_barang').modal('show');
            $('#modal_title_barang').html('Tambah Barang');
            reset_data_barang();
        });

        $('#bt_reset_barang').click(function(){
            reset_data_barang();
            get_list_barang(1);
        });

        $('.form-control').keyup(function(){
            if ($(this).val() !== '') {
                dc_validation_remove(this);
            }
        });

        $('.form-control').change(function(){
            if ($(this).val() !== '') {
                dc_validation_remove(this);
            }
        });

    });

    function convertToCurrency(obj){
    	if ($(obj).val() !== '') {
    		var conv = currencyToNumber($(obj).val());
    		$(obj).val(numberToCurrency(conv));
    	}else{
    		$(obj).val(0);
    	}
    }

    function reset_data_barang() {
        $('#id_barang, .form-control,  #pencarian_barang').val('');
        dc_validation_remove('.form-control');
    }

    function get_barang(id) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/barang") ?>/id/'+id,
            cache : false,
            dataType : 'JSON',
            success: function(data) {
                $('#pagination').html('&nbsp;<br>&nbsp;<br>');
                $('#jp_summary').html(page_summary(1, 1, data.limit, data.page));

                $('#table_barang tbody').empty();
                var total = data.data.harga_pokok * data.data.stock;

                var status = '';
                var active_status = '';

                if (data.data.status == 'Aktif') {
                    active_status = '';
                    status = '<i class="fa fa-check"></i>';
                } else if (data.data.status == 'Tidak Aktif') {
                    active_status = "id = 'active-status'";
                    status = '<i class="fa fa-times"></i>';
                }

                var str =   '<tr '+active_status+'>'+
                                '<td align="center">1</td>'+
                                '<td>'+data.data.kode_barang+'</td>'+
                                '<td>'+data.data.nama+'</td>'+
                                '<td>'+data.data.stock+'</td>'+
                                '<td align="center">'+numberToCurrency(data.data.harga_pokok)+'</td>'+
                                '<td align="center">'+numberToCurrency(total)+'</td>'+
                                '<td>'+data.data.kategori+'</td>'+
                                '<td>'+status+'</td>'+
                                '<td align="center" class="aksi">'+
                                    '<button type="button" class="btn btn-xs" onclick="edit_barang(\''+data.data.id+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i></button> '+
                                    '<button type="button" class="btn btn-xs" onclick="delete_barang(\''+data.data.id+'\', '+data.page+')"><i class="fa fa-trash"></i></button>'+
                                '</td>'+
                            '</tr>';
                $('#table_barang tbody').append(str);
            },
            error: function(e) {
                access_failed(e.status);
            }
        });
    }

    function get_list_barang(p) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/barang_list"); ?>/page/'+p,
            cache : false,
            data : 'pencarian='+$('#pencarian_barang').val(),
            dataType : 'json',
            success: function(data) {
                if ((p > 1) & (data.data.length === 0)) {
                    get_list_barang(p - 1);
                    return false;
                };

                $('#pagination').html(pagination(data.jumlah, data.limit, data.page, 2));
                $('#jp_summary').html(page_summary(data.jumlah, data.data.length, data.limit, data.page));

                $('#table_barang tbody').empty();

                var str = '';
                $.each(data.data, function(i, v) {
                    var total = v.harga_pokok * v.stock;
                    if (v.status == 'Aktif') {
                        active_status = '';
                        status = '<i class="fa fa-check"></i>';
                    } else if (v.status == 'Tidak Aktif') {
                        active_status = "id = 'active-status'";
                        status = '<i class="fa fa-times"></i>';
                    }
                    str = '<tr '+active_status+'>'+
                            '<td align="center">'+((i+1) + ((data.page - 1) * data.limit))+'</td>'+
                            '<td>'+v.kode_barang+'</td>'+
                            '<td>'+v.nama+'</td>'+
                            '<td>'+v.stock+'</td>'+
                            '<td align="center">'+numberToCurrency(v.harga_pokok)+'</td>'+
                            '<td align="center">'+numberToCurrency(total)+'</td>'+
                            '<td>'+v.kategori+'</td>'+
                            '<td>'+status+'</td>'+
                            '<td align="center" class="aksi">'+
                                '<button type="button" class="btn btn-xs" onclick="edit_barang(\''+v.id+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i></button> '+
                                '<button type="button" class="btn btn-xs" onclick="delete_barang(\''+v.id+'\', '+data.page+')"><i class="fa fa-trash"></i></button>'+
                            '</td>'+
                          '</tr>';
                    $('#table_barang tbody').append(str);
                });
            },
            error: function(e){
                access_failed(e.status);
            }
        });
    }

    function paging(p) {
        get_list_barang(p);
    }

    function simpan_barang() {
        var stop = false;

        if ($('select#kategori').val() === '') {
            dc_validation('select#kategori', 'Kategori harus dipilih!');
            stop = true;
        };

        if ($('#nama_barang').val() === '') {
            dc_validation('#nama_barang', 'Nama barang harus diisi!');
            stop = true;
        };

        if ($('#stock').val() === '') {
            dc_validation('#stock', 'Stock barang harus diisi!');
            stop = true;
        };

        if ($('#harga_pokok').val() === '') {
            dc_validation('#harga_pokok', 'Harga pokok harus diisi!');
            stop = true;
        };

        if ($('#status').val() === '') {
            dc_validation('#status', 'Status harus dipilih!');
            stop = true;
        };

        if (stop) {
            return false;
        }

        var update = '';
        if ($('#id_barang').val() !== '') {
            update = 'id/'+ $('#id_barang').val();
        }

        show_ajax_indicator();
        $.ajax({
            type : 'POST',
            url : '<?= base_url("api/masterdata/barang") ?>/'+update,
            data : $('#formjp').serialize(),
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#modal_barang').modal('hide');

                if ($('#id_barang').val() !== '') {
                    message_edit_success();
                    get_list_barang($('#page_now').val());
                } else {
                    message_add_success();
                    get_barang(data.id);
                }

                hide_ajax_indicator();
            },
            error: function(e) {
                if ($('#id_barang').val() !== '') {
                    message_edit_failed();
                } else {
                    message_add_failed();
                }

                hide_ajax_indicator();
            }
        });
    }

    function edit_barang(id, p) {
        reset_data_barang();
        $('#page_now').val(p);
        $('#modal_title_barang').html('Edit Barang');
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/barang"); ?>/id/'+id,
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#kategori').val(data.data.kategori);
                $('#id_barang').val(data.data.id);
                $('#kode_barang').val(data.data.kode_barang);
                $('#nama_barang').val(data.data.nama);
                $('#stock').val(data.data.stock);
                $('#harga_pokok').val(numberToCurrency(data.data.harga_pokok));
                $('#status').val(data.data.status);

                $('#modal_barang').modal('show');
            },
            error : function(e) {
                access_failed(e.status);
            }
        });
    }

    function delete_barang(id, p) {
        Swal({
            title: 'Apakah anda yakin ?',
            text: '"Data tidak bisa dikembalikan jika sudah terhapus"',
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Data',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6'
        }).then((result) => {
            if (result.value === true) {
                $.ajax({
                    type : 'DELETE',
                    url : '<?= base_url("api/masterdata/barang") ?>/id/'+id,
                    cache : false,
                    dataType: 'json',
                    success: function(data){
                        get_list_barang(p);
                        message_delete_success();
                    },
                    error: function(e){
                        get_list_barang(p);
                        message_delete_success();
                    }
                });
            }
        })
    }
</script>