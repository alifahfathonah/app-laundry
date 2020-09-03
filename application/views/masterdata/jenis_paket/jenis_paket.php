<div class="ibox-content m-b-sm border-bottom">
    <div class="row">
        <div class="col-sm-10">
           <?= form_button('tambah', '<i class="fa fa-plus"></i> Tambah Data' ,'id=bt_tambah_jenis_paket class="btn btn-primary"')?>
            <?= form_button('reset', '<i class="fa fa-refresh"></i> Reload Data' ,'id=bt_reset_jenis_paket class="btn"')?></li>
        </div>
        <div class="col-sm-2">
            <input type="text" class="search form-control" onkeyup="get_list_jenis_paket(1)" id="pencarian_jenis_paket" placeholder="Pencarian">
        </div>
    </div>
</div>


<input type="hidden" name="page_now" id="page_now"/>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">            
            <div class="ibox-content">                
                <table class="table table-striped table-hover" id="table_jenis_paket">
                    <thead>
                        <tr class="info">
                            <th width="5%" style="text-align: center;">NO</th>
                            <th width="30%">NAMA</th>
                            <th width="15%">SATUAN</th>
                            <th width="25%" style="text-align: center;">HARGA</th>
                            <th width="15%"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div class="pages_summary" id="jp_summary"></div>       
                <div id="pagination"></div>

                <div class="modal inmodal" id="modal_jenis_paket" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated flipInY">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="modal_title_jenis_paket">Tambah Jenis Paket</h4>
                            </div>
                            <div class="modal-body">
                                <?= form_open('', 'id=formjp role=form class=form-horizontal'); ?>
                                    <input type="hidden" name="id" id="id_jenis_paket">

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Nama Paket</label>

                                        <div class="col-lg-9">
                                            <input type="text" name="nama_paket" id="nama_paket" placeholder="Nama paket" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Satuan Paket</label>

                                        <div class="col-lg-9">
                                            <input type="text" name="satuan_paket" id="satuan_paket" placeholder="Satuan Paket" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Harga Paket</label>

                                        <div class="col-lg-9">
                                            <input type="text" name="harga_paket" id="harga_paket" placeholder="Harga Paket" class="form-control" onkeyup="convertToCurrency(this)">
                                        </div>
                                    </div>
                                <?= form_close(); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="float-e-margins btn btn-white" data-dismiss="modal"><i class="fa fa-refresh"></i> Batal</button>
                                <button type="button" class="btn btn-primary" onclick="simpan_jenis_paket()"><i class="fa fa-save"></i> Simpan</button>
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
        get_list_jenis_paket(1);

        $('#bt_tambah_jenis_paket').click(function(){
            $('#modal_jenis_paket').modal('show');
            $('#modal_title_jenis_paket').html('Tambah Jenis Paket');
            reset_data_jenis_paket();
        });

        $('#bt_reset_jenis_paket').click(function(){
            reset_data_jenis_paket();
            get_list_jenis_paket(1);
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

    function reset_data_jenis_paket() {
        $('#id_jenis_paket, .form-control,  #pencarian_jenis_paket').val('');
        dc_validation_remove('.form-control');
    }

    function get_jenis_paket(id) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/jenis_paket") ?>/id/'+id,
            cache : false,
            dataType : 'JSON',
            success: function(data) {
                $('#pagination').html('&nbsp;<br>&nbsp;<br>');
                $('#jp_summary').html(page_summary(1, 1, data.limit, data.page));

                $('#table_jenis_paket tbody').empty();
                var str =   '<tr>'+
                                '<td align="center">1</td>'+
                                '<td>'+data.data.nama_paket+'</td>'+
                                '<td>'+data.data.satuan_paket+'</td>'+
                                '<td align="center">'+numberToCurrency(data.data.harga_paket)+'</td>'+
                                '<td align="center" class="aksi">'+
                                    '<button type="button" class="btn btn-xs" onclick="edit_jenis_paket(\''+data.data.id+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i> Edit</button> '+
                                    '<button type="button" class="btn btn-xs" onclick="delete_jenis_paket(\''+data.data.id+'\', '+data.page+')"><i class="fa fa-trash"></i> Hapus</button>'+
                                '</td>'+
                            '</tr>';
                $('#table_jenis_paket tbody').append(str);
            },
            error: function(e) {
                access_failed(e.status);
            }
        });
    }

    function get_list_jenis_paket(p) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/jenis_paket_list"); ?>/page/'+p,
            cache : false,
            data : 'pencarian='+$('#pencarian_jenis_paket').val(),
            dataType : 'json',
            success: function(data) {
                if ((p > 1) & (data.data.length === 0)) {
                    get_list_jenis_paket(p - 1);
                    return false;
                };

                $('#pagination').html(pagination(data.jumlah, data.limit, data.page, 2));
                $('#jp_summary').html(page_summary(data.jumlah, data.data.length, data.limit, data.page));

                $('#table_jenis_paket tbody').empty();

                var str = '';
                $.each(data.data, function(i, v) {
                    str = '<tr>'+
                            '<td align="center">'+((i+1) + ((data.page - 1) * data.limit))+'</td>'+
                            '<td>'+v.nama_paket+'</td>'+
                            '<td>'+v.satuan_paket+'</td>'+
                            '<td align="center">'+numberToCurrency(v.harga_paket)+'</td>'+
                            '<td align="center" class="aksi">'+
                                '<button type="button" class="btn btn-xs" onclick="edit_jenis_paket(\''+v.id+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i> Edit</button> '+
                                '<button type="button" class="btn btn-xs" onclick="delete_jenis_paket(\''+v.id+'\', '+data.page+')"><i class="fa fa-trash"></i> Hapus</button>'+
                            '</td>'+
                          '</tr>';
                    $('#table_jenis_paket tbody').append(str);
                });
            },
            error: function(e){
                access_failed(e.status);
            }
        });
    }

    function paging(p) {
        get_list_jenis_paket(p);
    }

    function simpan_jenis_paket() {
        var stop = false;

        if ($('#nama_paket').val() === '') {
            dc_validation('#nama_paket', 'Nama paket harus diisi!');
            stop = true;
        };

        if ($('#satuan_paket').val() === '') {
            dc_validation('#satuan_paket', 'Satuan paket harus diisi!');
            stop = true;
        };

        if ($('#harga_paket').val() === '') {
            dc_validation('#harga_paket', 'Harga paket harus diisi!');
            stop = true;
        };

        if (stop) {
            return false;
        }

        var update = '';
        if ($('#id_jenis_paket').val() !== '') {
            update = 'id/'+ $('#id_jenis_paket').val();
        }

        show_ajax_indicator();
        $.ajax({
            type : 'POST',
            url : '<?= base_url("api/masterdata/jenis_paket") ?>/'+update,
            data : $('#formjp').serialize(),
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#modal_jenis_paket').modal('hide');

                if ($('#id_jenis_paket').val() !== '') {
                    message_edit_success();
                    get_list_jenis_paket($('#page_now').val());
                } else {
                    message_add_success();
                    get_jenis_paket(data.id);
                }

                hide_ajax_indicator();
            },
            error: function(e) {
                if ($('#id_jenis_paket').val() !== '') {
                    message_edit_failed();
                } else {
                    message_add_failed();
                }

                hide_ajax_indicator();
            }
        });
    }

    function edit_jenis_paket(id, p) {
        reset_data_jenis_paket();
        $('#page_now').val(p);
        $('#modal_title_jenis_paket').html('Edit Jenis Paket');
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/jenis_paket"); ?>/id/'+id,
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#id_jenis_paket').val(data.data.id);
                $('#nama_paket').val(data.data.nama_paket);
                $('#satuan_paket').val(data.data.satuan_paket);
                $('#harga_paket').val(numberToCurrency(data.data.harga_paket));

                $('#modal_jenis_paket').modal('show');
            },
            error : function(e) {
                access_failed(e.status);
            }
        });
    }

    function delete_jenis_paket(id, p) {
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
                    url : '<?= base_url("api/masterdata/jenis_paket") ?>/id/'+id,
                    cache : false,
                    dataType: 'json',
                    success: function(data){
                        get_list_jenis_paket(p);
                        message_delete_success();
                    },
                    error: function(e){
                        get_list_jenis_paket(p);
                        message_delete_success();
                    }
                });
            }
        })
    }
</script>