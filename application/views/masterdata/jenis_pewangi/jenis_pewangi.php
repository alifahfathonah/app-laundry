<div class="ibox-content m-b-sm border-bottom">
    <div class="row">
        <div class="col-sm-10">
           <?= form_button('tambah', '<i class="fa fa-plus"></i> Tambah Data' ,'id=bt_tambah_jenis_pewangi class="btn btn-primary"')?>
            <?= form_button('reset', '<i class="fa fa-refresh"></i> Reload Data' ,'id=bt_reset_jenis_pewangi class="btn"')?></li>
        </div>
        <div class="col-sm-2">
            <input type="text" class="search form-control" onkeyup="get_list_jenis_pewangi(1)" id="pencarian_jenis_pewangi" placeholder="Pencarian">
        </div>
    </div>
</div>


<input type="hidden" name="page_now" id="page_now"/>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">            
            <div class="ibox-content">                
                <table class="table table-striped table-hover" id="table_jenis_pewangi">
                    <thead>
                        <tr class="info">
                            <th width="5%" style="text-align: center;">NO</th>
                            <th width="50%">NAMA</th>
                            <th width="25%" style="text-align: center;">STATUS</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div class="pages_summary" id="jp_summary"></div>       
                <div id="pagination"></div>

                <div class="modal inmodal" id="modal_jenis_pewangi" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated flipInY">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="modal_title_jenis_pewangi">Tambah Jenis Pewangi</h4>
                            </div>
                            <div class="modal-body">
                                <?= form_open('', 'id=formjp role=form class=form-horizontal'); ?>
                                    <input type="hidden" name="id" id="id_jenis_pewangi">

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Nama Pewangi</label>

                                        <div class="col-lg-9">
                                            <input type="text" name="nama_pewangi" id="nama_pewangi" placeholder="Nama Pewangi" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Status</label>

                                        <div class="col-lg-5">
                                            <?= form_dropdown('status', $status, array(), 'class=form-control id=status');?>
                                        </div>
                                    </div>
                                <?= form_close(); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="float-e-margins btn btn-white" data-dismiss="modal"><i class="fa fa-refresh"></i> Batal</button>
                                <button type="button" class="btn btn-primary" onclick="simpan_jenis_pewangi()"><i class="fa fa-save"></i> Simpan</button>
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
        get_list_jenis_pewangi(1);

        $('#bt_tambah_jenis_pewangi').click(function(){
            $('#modal_jenis_pewangi').modal('show');
            $('#modal_title_jenis_pewangi').html('Tambah Jenis Pewangi');
            reset_data_jenis_pewangi();
        });

        $('#bt_reset_jenis_pewangi').click(function(){
            reset_data_jenis_pewangi();
            get_list_jenis_pewangi(1);
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

    function reset_data_jenis_pewangi() {
        $('#id_jenis_pewangi, .form-control,  #pencarian_jenis_pewangi').val('');
        dc_validation_remove('.form-control');
    }

    function get_jenis_pewangi(id) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/jenis_pewangi") ?>/id/'+id,
            cache : false,
            dataType : 'JSON',
            success: function(data) {
                $('#pagination').html('&nbsp;<br>&nbsp;<br>');
                $('#jp_summary').html(page_summary(1, 1, data.limit, data.page));

                $('#table_jenis_pewangi tbody').empty();

                if (data.data.status == 'Aktif') {
                    active_status = '';
                    status = '<i class="fa fa-check"></i>';
                } else if (data.data.status == 'Tidak Aktif') {
                    active_status = "id = 'active-status'"
                    status = '<i class="fa fa-times"></i>';
                }

                var str =   '<tr '+active_status+'>'+
                                '<td align="center">1</td>'+
                                '<td>'+data.data.nama_pewangi+'</td>'+
                                '<td align="center">'+status+'</td>'+
                                '<td align="center" class="aksi">'+
                                    '<button type="button" class="btn btn-xs" onclick="edit_jenis_pewangi(\''+data.data.id+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i> Edit</button> '+
                                    '<button type="button" class="btn btn-xs" onclick="delete_jenis_pewangi(\''+data.data.id+'\', '+data.page+')"><i class="fa fa-trash"></i> Hapus</button>'+
                                '</td>'+
                            '</tr>';
                $('#table_jenis_pewangi tbody').append(str);
            },
            error: function(e) {
                access_failed(e.status);
            }
        });
    }

    function get_list_jenis_pewangi(p) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/jenis_pewangi_list"); ?>/page/'+p,
            cache : false,
            data : 'pencarian='+$('#pencarian_jenis_pewangi').val(),
            dataType : 'json',
            success: function(data) {
                if ((p > 1) & (data.data.length === 0)) {
                    get_list_jenis_pewangi(p - 1);
                    return false;
                };

                $('#pagination').html(pagination(data.jumlah, data.limit, data.page, 2));
                $('#jp_summary').html(page_summary(data.jumlah, data.data.length, data.limit, data.page));

                $('#table_jenis_pewangi tbody').empty();

                var str = '';
                $.each(data.data, function(i, v) {
                    
                    if (v.status == 'Aktif') {
                        active_status = '';
                        status = '<i class="fa fa-check"></i>';
                    } else if (v.status == 'Tidak Aktif') {
                        active_status = "id = 'active-status'"
                        status = '<i class="fa fa-times"></i>';
                    }

                    str = '<tr '+active_status+'>'+
                            '<td align="center">'+((i+1) + ((data.page - 1) * data.limit))+'</td>'+
                            '<td>'+v.nama_pewangi+'</td>'+
                            '<td align="center">'+status+'</td>'+
                            '<td align="center" class="aksi">'+
                                '<button type="button" class="btn btn-xs" onclick="edit_jenis_pewangi(\''+v.id+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i> Edit</button> '+
                                '<button type="button" class="btn btn-xs" onclick="delete_jenis_pewangi(\''+v.id+'\', '+data.page+')"><i class="fa fa-trash"></i> Hapus</button>'+
                            '</td>'+
                          '</tr>';
                    $('#table_jenis_pewangi tbody').append(str);
                });
            },
            error: function(e){
                access_failed(e.status);
            }
        });
    }

    function paging(p) {
        get_list_jenis_pewangi(p);
    }

    function simpan_jenis_pewangi() {
        var stop = false;

        if ($('#nama_pewangi').val() === '') {
            dc_validation('#nama_pewangi', 'Nama Pewangi harus diisi!');
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
        if ($('#id_jenis_pewangi').val() !== '') {
            update = 'id/'+ $('#id_jenis_pewangi').val();
        }

        show_ajax_indicator();
        $.ajax({
            type : 'POST',
            url : '<?= base_url("api/masterdata/jenis_pewangi") ?>/'+update,
            data : $('#formjp').serialize(),
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#modal_jenis_pewangi').modal('hide');

                if ($('#id_jenis_pewangi').val() !== '') {
                    message_edit_success();
                    get_list_jenis_pewangi($('#page_now').val());
                } else {
                    message_add_success();
                    get_jenis_pewangi(data.id);
                }

                hide_ajax_indicator();
            },
            error: function(e) {
                if ($('#id_jenis_pewangi').val() !== '') {
                    message_edit_failed();
                } else {
                    message_add_failed();
                }

                hide_ajax_indicator();
            }
        });
    }

    function edit_jenis_pewangi(id, p) {
        reset_data_jenis_pewangi();
        $('#page_now').val(p);
        $('#modal_title_jenis_pewangi').html('Edit Jenis Pewangi');
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/jenis_pewangi"); ?>/id/'+id,
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#id_jenis_pewangi').val(data.data.id);
                $('#nama_pewangi').val(data.data.nama_pewangi);
                $('#status').val(data.data.status);

                $('#modal_jenis_pewangi').modal('show');
            },
            error : function(e) {
                access_failed(e.status);
            }
        });
    }

    function delete_jenis_pewangi(id, p) {
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
                    url : '<?= base_url("api/masterdata/jenis_pewangi") ?>/id/'+id,
                    cache : false,
                    dataType: 'json',
                    success: function(data){
                        get_list_jenis_pewangi(p);
                        message_delete_success();
                    },
                    error: function(e){
                        get_list_jenis_pewangi(p);
                        message_delete_success();
                    }
                });
            }
        })
    }
</script>