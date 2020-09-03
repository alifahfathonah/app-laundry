<div class="ibox-content m-b-sm border-bottom">
    <div class="row">
        <div class="col-sm-10">
           <?= form_button('tambah', '<i class="fa fa-plus"></i> Tambah Customer' ,'id=bt_tambah_customer class="btn btn-primary"')?>
            <?= form_button('reset', '<i class="fa fa-refresh"></i> Reload Data' ,'id=bt_reset_customer class="btn"')?></li>
        </div>
        <div class="col-sm-2">
            <input type="text" class="search form-control" onkeyup="get_list_customer(1)" id="pencarian_customer" placeholder="Pencarian">
        </div>
    </div>
</div>


<input type="hidden" name="page_now" id="page_now"/>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">            
            <div class="ibox-content">                
                <table class="table table-striped table-hover" id="table_customer">
                    <thead>
                        <tr class="info">
                            <th width="5%" style="text-align: center;">NO</th>
                            <th width="12%" style="text-align: center;">NO CUSTOMER</th>
                            <th width="15%">NAMA</th>
                            <th width="15%">TELP</th>
                            <th width="28%">ALAMAT</th>
                            <th width="5%" style="text-align: center;">STATUS</th>
                            <th width="10%" style="text-align: center;">DISC</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div class="pages_summary" id="p_summary"></div>       
                <div id="pagination"></div>

                <div class="modal inmodal" id="modal_customer" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated flipInY">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="modal_title_customer">Tambah customer</h4>
                            </div>
                            <div class="modal-body">
                                <?= form_open('', 'id=formadd role=form class=form-horizontal'); ?>
                                    <input type="hidden" name="inc" id="id_customer">

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Nama customer</label>

                                        <div class="col-lg-9">
                                            <input type="text" name="nama_customer" id="nama_customer" placeholder="Nama customer" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Telp customer</label>

                                        <div class="col-lg-9">
                                            <input type="text" name="telp" id="telp" placeholder="Telp customer" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="col-lg-3 control-label">Alamat</label>
                                        <div class="col-lg-9">
                                          <textarea id="alamat" name="alamat" placeholder="Alamat" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Status</label>

                                        <div class="col-lg-5">
                                            <?= form_dropdown('status', $status, array(), 'class=form-control id=status');?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Diskon</label>

                                        <div class="col-lg-3">
                                            <div class="input-group m-b"><span class="input-group-addon">%</span> <input type="text" name="disc" id="disc" placeholder="" class="form-control"></div>
                                        </div>
                                    </div>


                                <?= form_close(); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="float-e-margins btn btn-white" data-dismiss="modal"><i class="fa fa-refresh"></i> Batal</button>
                                <button type="button" class="btn btn-primary" onclick="simpan_customer()"><i class="fa fa-save"></i> Simpan</button>
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
        get_list_customer(1);

        $('#bt_tambah_customer').click(function(){
            $('#modal_customer').modal('show');
            $('#modal_title_customer').html('Tambah customer');
            reset_data_customer();
        });

        $('#bt_reset_customer').click(function(){
            reset_data_customer();
            get_list_customer(1);
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

    function reset_data_customer() {
        $('#id_customer, .form-control,  #pencarian_customer').val('');
        dc_validation_remove('.form-control');
    }

    function get_customer(id) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/customer") ?>/id/'+id,
            cache : false,
            dataType : 'JSON',
            success: function(data) {
                $('#pagination').html('&nbsp;<br>&nbsp;<br>');
                $('#p_summary').html(page_summary(1, 1, data.limit, data.page));

                $('#table_customer tbody').empty();

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
                                '<td align="center">'+data.data.id+'</td>'+
                                '<td>'+data.data.nama_customer+'</td>'+
                                '<td>'+data.data.telp+'</td>'+
                                '<td>'+data.data.alamat+'</td>'+
                                '<td align="center">'+status+'</td>'+
                                '<td align="center">'+data.data.disc+'%</td>'+
                                '<td align="center" class="aksi">'+
                                    '<button type="button" class="btn btn-xs" onclick="edit_customer(\''+data.data.inc+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i></button> '+
                                    // '<button type="button" class="btn btn-xs" onclick="delete_customer(\''+data.data.inc+'\', '+data.page+')"><i class="fa fa-trash"></i></button>'+
                                '</td>'+
                            '</tr>';
                $('#table_customer tbody').append(str);
            },
            error: function(e) {
                access_failed(e.status);
            }
        });
    }

    function get_list_customer(p) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/customer_list"); ?>/page/'+p,
            cache : false,
            data : 'pencarian='+$('#pencarian_customer').val(),
            dataType : 'json',
            success: function(data) {
                if ((p > 1) & (data.data.length === 0)) {
                    get_list_customer(p - 1);
                    return false;
                };

                $('#pagination').html(pagination(data.jumlah, data.limit, data.page, 2));
                $('#p_summary').html(page_summary(data.jumlah, data.data.length, data.limit, data.page));

                $('#table_customer tbody').empty();

                var str = '';
                $.each(data.data, function(i, v) {

                    if (v.status == 'Aktif') {
                        active_status = '';
                        status = '<i class="fa fa-check"></i>';
                    } else if (v.status == 'Tidak Aktif') {
                        active_status = "id = 'active-status'";
                        status = '<i class="fa fa-times"></i>';
                    }

                    str = '<tr '+active_status+'>'+
                            '<td align="center">'+((i+1) + ((data.page - 1) * data.limit))+'</td>'+
                            '<td align="center">'+v.id+'</td>'+
                            '<td>'+v.nama_customer+'</td>'+
                            '<td>'+v.telp+'</td>'+
                            '<td>'+v.alamat+'</td>'+
                            '<td align="center">'+status+'</td>'+
                            '<td align="center">'+v.disc+'%</td>'+
                            '<td align="center" class="aksi">'+
                                '<button type="button" class="btn btn-xs" onclick="edit_customer(\''+v.inc+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i></button> '+
                                '<button type="button" class="btn btn-xs" onclick="delete_customer(\''+v.inc+'\', '+data.page+')"><i class="fa fa-trash"></i></button>'+
                            '</td>'+
                          '</tr>';
                    $('#table_customer tbody').append(str);
                });
            },
            error: function(e){
                access_failed(e.status);
            }
        });
    }

    function paging(p) {
        get_list_customer(p);
    }

    function simpan_customer() {
        var stop = false;

        if ($('#nama_customer').val() === '') {
            dc_validation('#nama_customer', 'Nama customer harus diisi!');
            stop = true;
        };

        if ($('#telp').val() === '') {
            dc_validation('#telp', 'Telp customer harus diisi!');
            stop = true;
        };

        if ($('#status').val() === '') {
            dc_validation('#status', 'Status customer harus diisi!');
            stop = true;
        };
        
        if (stop) {
            return false;
        }

        var update = '';
        if ($('#id_customer').val() !== '') {
            update = 'id/'+ $('#id_customer').val();
        }

        show_ajax_indicator();
        $.ajax({
            type : 'POST',
            url : '<?= base_url("api/masterdata/customer") ?>/'+update,
            data : $('#formadd').serialize(),
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#modal_customer').modal('hide');

                if ($('#id_customer').val() !== '') {
                    message_edit_success();
                    get_list_customer($('#page_now').val());
                } else {
                    message_add_success();
                    get_customer(data.id);
                }

                hide_ajax_indicator();
            },
            error: function(e) {
                if ($('#id_customer').val() !== '') {
                    message_edit_failed();
                } else {
                    message_add_failed();
                }

                hide_ajax_indicator();
            }
        });
    }

    function edit_customer(inc, p) {
        reset_data_customer();
        $('#page_now').val(p);
        $('#modal_title_customer').html('Edit customer');
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/customer"); ?>/id/'+inc,
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#id_customer').val(data.data.inc);
                $('#nama_customer').val(data.data.nama_customer);
                $('#telp').val(data.data.telp);
                $('#alamat').val(data.data.alamat);
                $('#status').val(data.data.status);
                $('#disc').val(data.data.disc);

                $('#modal_customer').modal('show');
            },
            error : function(e) {
                access_failed(e.status);
            }
        });
    }

    function delete_customer(inc, p) {
        Swal({
            title: 'Apakah anda yakin ?',
            text: '"Data tidak bisa dikembalikan jika sudah terhapus"',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Data',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6'
        }).then((result) => {
            if (result.value === true) {
                $.ajax({
                    type : 'DELETE',
                    url : '<?= base_url("api/masterdata/customer") ?>/id/'+inc,
                    cache : false,
                    dataType: 'json',
                    success: function(data){
                        get_list_customer(p);
                        message_delete_success();
                    },
                    error: function(e){
                        get_list_customer(p);
                        message_delete_success();
                    }
                });
            }
        })
    }
</script>