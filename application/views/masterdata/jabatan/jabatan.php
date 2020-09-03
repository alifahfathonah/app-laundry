<div class="ibox-content m-b-sm border-bottom">
    <div class="row">
        <div class="col-sm-10">
           <?= form_button('tambah', '<i class="fa fa-plus"></i> Tambah Data' ,'id=bt_tambah_jabatan class="btn btn-primary"')?>
            <?= form_button('reset', '<i class="fa fa-refresh"></i> Reload Data' ,'id=bt_reset_jabatan class="btn"')?></li>
        </div>
        <div class="col-sm-2">
            <input type="text" class="search form-control" onkeyup="get_list_jabatan(1)" id="pencarian_jabatan" placeholder="Pencarian">
        </div>
    </div>
</div>


<input type="hidden" name="page_now" id="page_now"/>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">            
            <div class="ibox-content">                
                <table class="table table-striped table-hover" id="table_jabatan">
                    <thead>
                        <tr class="info">
                            <th width="5%" style="text-align: center;">NO</th>
                            <th width="75">NAMA</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div class="pages_summary" id="jp_summary"></div>       
                <div id="pagination"></div>

                <div class="modal inmodal" id="modal_jabatan" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated flipInY">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="modal_title_jabatan">Tambah Jabatan</h4>
                            </div>
                            <div class="modal-body">
                                <?= form_open('', 'id=formjp role=form class=form-horizontal'); ?>
                                    <input type="hidden" name="id" id="id_jabatan">

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Nama Jabatan</label>

                                        <div class="col-lg-9">
                                            <input type="text" name="nama" id="nama" placeholder="Nama Jabatan" class="form-control">
                                        </div>
                                    </div>
                                <?= form_close(); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="float-e-margins btn btn-white" data-dismiss="modal"><i class="fa fa-refresh"></i> Batal</button>
                                <button type="button" class="btn btn-primary" onclick="simpan_jabatan()"><i class="fa fa-save"></i> Simpan</button>
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
        get_list_jabatan(1);

        $('#bt_tambah_jabatan').click(function(){
            $('#modal_jabatan').modal('show');
            $('#modal_title_jabatan').html('Tambah Jabatan');
            reset_data_jabatan();
        });

        $('#bt_reset_jabatan').click(function(){
            reset_data_jabatan();
            get_list_jabatan(1);
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

    function reset_data_jabatan() {
        $('#id_jabatan, .form-control,  #pencarian_jabatan').val('');
        dc_validation_remove('.form-control');
    }

    function get_jabatan(id) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/jabatan") ?>/id/'+id,
            cache : false,
            dataType : 'JSON',
            success: function(data) {
                $('#pagination').html('&nbsp;<br>&nbsp;<br>');
                $('#jp_summary').html(page_summary(1, 1, data.limit, data.page));

                $('#table_jabatan tbody').empty();

                var str =   '<tr>'+
                                '<td align="center">1</td>'+
                                '<td>'+data.data.nama+'</td>'+
                                '<td align="center" class="aksi">'+
                                    '<button type="button" class="btn btn-xs" onclick="edit_jabatan(\''+data.data.id+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i> Edit</button> '+
                                    '<button type="button" class="btn btn-xs" onclick="delete_jabatan(\''+data.data.id+'\', '+data.page+')"><i class="fa fa-trash"></i> Hapus</button>'+
                                '</td>'+
                            '</tr>';
                $('#table_jabatan tbody').append(str);
            },
            error: function(e) {
                access_failed(e.status);
            }
        });
    }

    function get_list_jabatan(p) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/jabatan_list"); ?>/page/'+p,
            cache : false,
            data : 'pencarian='+$('#pencarian_jabatan').val(),
            dataType : 'json',
            success: function(data) {
                if ((p > 1) & (data.data.length === 0)) {
                    get_list_jabatan(p - 1);
                    return false;
                };

                $('#pagination').html(pagination(data.jumlah, data.limit, data.page, 2));
                $('#jp_summary').html(page_summary(data.jumlah, data.data.length, data.limit, data.page));

                $('#table_jabatan tbody').empty();

                var str = '';
                $.each(data.data, function(i, v) {

                    str = '<tr>'+
                            '<td align="center">'+((i+1) + ((data.page - 1) * data.limit))+'</td>'+
                            '<td>'+v.nama+'</td>'+
                            '<td align="center" class="aksi">'+
                                '<button type="button" class="btn btn-xs" onclick="edit_jabatan(\''+v.id+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i> Edit</button> '+
                                '<button type="button" class="btn btn-xs" onclick="delete_jabatan(\''+v.id+'\', '+data.page+')"><i class="fa fa-trash"></i> Hapus</button>'+
                            '</td>'+
                          '</tr>';
                    $('#table_jabatan tbody').append(str);
                });
            },
            error: function(e){
                access_failed(e.status);
            }
        });
    }

    function paging(p) {
        get_list_jabatan(p);
    }

    function simpan_jabatan() {
        var stop = false;

        if ($('#nama').val() === '') {
            dc_validation('#nama', 'Nama Jabatan harus diisi!');
            stop = true;
        };
        
        if (stop) {
            return false;
        }

        var update = '';
        if ($('#id_jabatan').val() !== '') {
            update = 'id/'+ $('#id_jabatan').val();
        }

        show_ajax_indicator();
        $.ajax({
            type : 'POST',
            url : '<?= base_url("api/masterdata/jabatan") ?>/'+update,
            data : $('#formjp').serialize(),
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#modal_jabatan').modal('hide');

                if ($('#id_jabatan').val() !== '') {
                    message_edit_success();
                    get_list_jabatan($('#page_now').val());
                } else {
                    message_add_success();
                    get_jabatan(data.id);
                }

                hide_ajax_indicator();
            },
            error: function(e) {
                if ($('#id_jabatan').val() !== '') {
                    message_edit_failed();
                } else {
                    message_add_failed();
                }

                hide_ajax_indicator();
            }
        });
    }

    function edit_jabatan(id, p) {
        reset_data_jabatan();
        $('#page_now').val(p);
        $('#modal_title_jabatan').html('Edit Jabatan');
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/jabatan"); ?>/id/'+id,
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#id_jabatan').val(data.data.id);
                $('#nama').val(data.data.nama);

                $('#modal_jabatan').modal('show');
            },
            error : function(e) {
                access_failed(e.status);
            }
        });
    }

    function delete_jabatan(id, p) {
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
                    url : '<?= base_url("api/masterdata/jabatan") ?>/id/'+id,
                    cache : false,
                    dataType: 'json',
                    success: function(data){
                        get_list_jabatan(p);
                        message_delete_success();
                    },
                    error: function(e){
                        get_list_jabatan(p);
                        message_delete_success();
                    }
                });
            }
        })
    }
</script>