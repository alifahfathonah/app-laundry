<div class="ibox-content m-b-sm border-bottom">
    <div class="row">
        <div class="col-sm-10">
           <?= form_button('tambah', '<i class="fa fa-plus"></i> Tambah Data' ,'id=bt_tambah_pegawai class="btn btn-primary"')?>
            <?= form_button('reset', '<i class="fa fa-refresh"></i> Reload Data' ,'id=bt_reset_pegawai class="btn"')?></li>
        </div>
        <div class="col-sm-2">
            <input type="text" class="search form-control" onkeyup="get_list_pegawai(1)" id="pencarian_pegawai" placeholder="Pencarian">
        </div>
    </div>
</div>


<input type="hidden" name="page_now" id="page_now"/>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">            
            <div class="ibox-content">                
                <table class="table table-striped table-hover" id="table_pegawai">
                    <thead>
                        <tr class="info">
                            <th width="5%" style="text-align: center;">NO</th>
                            <th width="20%">NAMA</th>
                            <th width="15%">JABATAN</th>
                            <th width="10%" style="text-align: center;">KELAMIN</th>
                            <th width="15%" style="text-align: center;">TANGGAL LAHIR</th>
                            <th width="10%" style="text-align: center;">TELP</th>
                            <th width="5%">DETAIL</th>
                            <th width="5%">STATUS</th>
                            <th width="15%"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div class="pages_summary" id="p_summary"></div>       
                <div id="pagination"></div>
                
                <script type="text/javascript">
                    $(function(){
                      $('.mypopover').popover();
                    });
                </script>

                <div class="modal inmodal" id="modal_pegawai" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" style="width: 80%;">
                        <div class="modal-content animated flipInY">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="modal_title_pegawai">Tambah Pegawai</h4>
                            </div>
                            <div class="modal-body">
                                <?= form_open('', 'id=formadd role=form class=form-horizontal'); ?>
                                    <input type="hidden" name="id" id="id_pegawai">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Nama Pegawai</label>

                                                <div class="col-lg-9">
                                                    <input type="text" name="nama" id="nama" placeholder="Nama Pegawai" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Kelamin</label>

                                                <div class="col-lg-5">
                                                    <?= form_dropdown('kelamin', $kelamin, array(), 'class=form-control id=kelamin');?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Tempat Lahir</label>

                                                <div class="col-lg-9">
                                                    <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Tanggal Lahir</label>

                                                <div class="col-lg-4">
                                                    <input type="text" name="tanggal_lahir" class="datepicker form-control" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?= date('d/m/Y')?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat" class="col-lg-3 control-label">Alamat</label>
                                                <div class="col-lg-9">
                                                  <textarea id="alamat" name="alamat" placeholder="Alamat" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="agama" class="col-lg-3 control-label">Agama</label>
                                                <div class="col-lg-4">
                                                  <?= form_dropdown('agama', $agama, array(), 'class=form-control id=agama');?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jabatan" class="col-lg-3 control-label">Jabatan</label>
                                                <div class="col-lg-4">
                                                  <input type="text" name="jabatan" class="select2-input" id="jabatan_auto" placeholder="Jabatan">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="telp" class="col-lg-3 control-label">No. Telp</label>
                                                <div class="col-lg-9">
                                                  <input type="text" name="telp" class="form-control" id="telp" placeholder="No. Telp">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Status</label>

                                                <div class="col-lg-5">
                                                    <?= form_dropdown('status', $status, array(), 'class=form-control id=status');?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?= form_close(); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="float-e-margins btn btn-white" data-dismiss="modal"><i class="fa fa-refresh"></i> Batal</button>
                                <button type="button" class="btn btn-primary" onclick="simpan_pegawai()"><i class="fa fa-save"></i> Simpan</button>
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
        get_list_pegawai(1);

        $('#bt_tambah_pegawai').click(function(){
            $('#modal_pegawai').modal('show');
            $('#modal_title_pegawai').html('Tambah Pegawai');
            reset_data_pegawai();
        });

        $('#bt_reset_pegawai').click(function(){
            reset_data_pegawai();
            get_list_pegawai(1);
        });

        $("#tanggal_lahir").datepicker({
            format: 'dd/mm/yyyy',
            endDate: "1d"
        }).on('changeDate', function(){
            $(this).datepicker('hide');
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

        $('#jabatan_auto').select2({
            ajax: {
                url: "<?= base_url('api/masterdata_auto/jabatan_auto') ?>",
                dataType: 'json',
                quietMillis: 100,
                data: function (term, page) { // page is the one-based page number tracked by Select2
                    return {
                        q: term, //search term
                        page: page, // page number
                    };
                },
                results: function (data, page) {
                    var more = (page * 20) < data.total; // whether or not there are more results available
         
                    // notice we return the value of more so Select2 knows if more results can be loaded
                    return {results: data.data, more: more};
                }
            },
            formatResult: function(data){
                var markup = data.nama;
                return markup;
            }, 
            formatSelection: function(data){
                return data.nama;
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

    function reset_data_pegawai() {
        $('#id_pegawai, .form-control, #pencarian_pegawai').val('');
        dc_validation_remove('.form-control');
    }

    function get_pegawai(id) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/pegawai") ?>/id/'+id,
            cache : false,
            dataType : 'JSON',
            success: function(data) {
                $('#pagination').html('&nbsp;<br>&nbsp;<br>');
                $('#p_summary').html(page_summary(1, 1, data.limit, data.page));

                var kelamin = '';
                if (data.data.kelamin == 'L') {
                    kelamin = 'Laki-laki';
                } else if (data.data.kelamin == 'P') {
                    kelamin = 'Perempuan';
                }

                var status = '';
                var active_status = '';

                if (data.data.status == 'Aktif') {
                    active_status = '';
                    status = '<i class="fa fa-check"></i>';
                } else if (data.data.status == 'Tidak Aktif') {
                    active_status = "id = 'active-status'";
                    status = '<i class="fa fa-times"></i>';
                }

                var detail = '<table>'+
                                '<tr><td>Tempat Lahir</td><td> : </td><td>'+data.data.tempat_lahir+'</td></tr>'+
                                '<tr><td>Agama</td><td> : </td><td>'+data.data.agama+'</td></tr>'+
                                '<tr><td>Alamat</td><td> : </td><td>'+data.data.alamat+'</td></tr>'+
                            '</table>';

                $('#table_pegawai tbody').empty();

                var str =  '<tr '+active_status+'>'+
                            '<td align="center">1</td>'+
                            '<td>'+data.data.nama+'</td>'+
                            '<td>'+data.data.jabatan+'</td>'+
                            '<td align="center">'+kelamin+'</td>'+
                            '<td align="center">'+((data.data.tanggal_lahir !== null)?datefmysql(data.data.tanggal_lahir):'')+'</td>'+
                            '<td align="center">'+data.data.telp+'</td>'+
                            '<td align="center">'+
                                '<button type="button" class="btn btn-xs mypopover" data-container="body" data-toggle="popover" data-placement="top" data-title="Detail"'+
                              ' data-content="'+detail+'">'+
                              'show</button>'+
                            '</td>'+
                            '<td align="center">'+status+'</td>'+
                            '<td align="center" class="aksi">'+
                                '<button type="button" class="btn btn-xs" onclick="edit_pegawai(\''+data.data.id+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i> Edit</button> '+
                                '<button type="button" class="btn btn-xs" onclick="delete_pegawai(\''+data.data.id+'\', '+data.page+')"><i class="fa fa-trash"></i> Hapus</button>'+
                            '</td>'+
                          '</tr>';
                $('#table_pegawai tbody').append(str);
                $('.mypopover').popover({html: true, trigger:'hover'}); 
            },
            error: function(e) {
                access_failed(e.status);
            }
        });
    }

    function get_list_pegawai(p) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/pegawai_list"); ?>/page/'+p,
            cache : false,
            data : 'pencarian='+$('#pencarian_pegawai').val(),
            dataType : 'json',
            success: function(data) {
                if ((p > 1) & (data.data.length === 0)) {
                    get_list_pegawai(p - 1);
                    return false;
                };

                $('#pagination').html(pagination(data.jumlah, data.limit, data.page, 2));
                $('#p_summary').html(page_summary(data.jumlah, data.data.length, data.limit, data.page));

                $('#table_pegawai tbody').empty();

                var str = '';
                var kelamin = '';
                var detail = '';
                var status = '';
                var active_status = '';

                $.each(data.data, function(i, v) {

                    if (v.kelamin == 'L') {
                        kelamin = 'Laki-laki';
                    }else if(v.kelamin == 'P'){
                        kelamin = 'Perempuan';
                    }

                    if (v.status == 'Aktif') {
                        active_status = '';
                        status = '<i class="fa fa-check"></i>';
                    } else if (v.status == 'Tidak Aktif') {
                        active_status = "id = 'active-status'";
                        status = '<i class="fa fa-times"></i>';
                    }

                    detail = '<table>'+
                                '<tr><td>Tempat Lahir</td><td> : </td><td>'+v.tempat_lahir+'</td></tr>'+
                                '<tr><td>Agama</td><td> : </td><td>'+v.agama+'</td></tr>'+
                                '<tr><td>Alamat</td><td> : </td><td>'+v.alamat+'</td></tr>'+
                            '</table>';
                    str = '<tr '+active_status+'>'+
                            '<td align="center">'+((i+1) + ((data.page - 1) * data.limit))+'</td>'+
                            '<td>'+v.nama+'</td>'+
                            '<td>'+v.jabatan+'</td>'+
                            '<td align="center">'+kelamin+'</td>'+
                            '<td align="center">'+((v.tanggal_lahir !== null)?datefmysql(v.tanggal_lahir):'')+'</td>'+
                            '<td align="center">'+v.telp+'</td>'+
                            '<td align="center">'+
                                '<button type="button" class="btn btn btn-xs mypopover" data-container="body" data-toggle="popover" data-placement="top" data-title="Detail"'+
                                  ' data-content="'+detail+'">'+
                                  'show</button>'+
                            '</td>'+
                            '<td align="center">'+status+'</td>'+
                            '<td align="center" class="aksi">'+
                                '<button type="button" class="btn btn-xs" onclick="edit_pegawai(\''+v.id+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i> Edit</button> '+
                                '<button type="button" class="btn btn-xs" onclick="delete_pegawai(\''+v.id+'\', '+data.page+')"><i class="fa fa-trash"></i> Hapus</button>'+
                            '</td>'+
                          '</tr>';
                    $('#table_pegawai tbody').append(str);
                });

                $('.mypopover').popover({html: true, trigger:'hover'});
            },
            error: function(e){
                access_failed(e.status);
            }
        });
    }

    function paging(p) {
        get_list_pegawai(p);
    }

    function simpan_pegawai() {
        var stop = false;

        if ($('#nama').val() === '') {
            dc_validation('#nama', 'Nama pegawai harus diisi!');
            stop = true;
        };

        if ($('#kelamin').val() === '') {
            dc_validation('#kelamin', 'Jenis kelamin harus dipilih!');
            stop = true;
        };

        if ($('#tempat_lahir').val() === '') {
            dc_validation('#tempat_lahir', 'Tempat lahir harus diisi!');
            stop = true;
        };

        if ($('#tanggal_lahir').val() === '') {
            dc_validation('#tanggal_lahir', 'Tanggal lahir harus diisi!');
            stop = true;
        };

        if ($('#jabatan_auto').val() === '') {
            dc_validation('#jabatan_auto', 'Jabatan harus diisi!');
            stop = true;
        };

        if ($('#telp').val() === '') {
            dc_validation('#telp', 'No telp harus diisi!');
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
        if ($('#id_pegawai').val() !== '') {
            update = 'id/'+ $('#id_pegawai').val();
        }

        show_ajax_indicator();
        $.ajax({
            type : 'POST',
            url : '<?= base_url("api/masterdata/pegawai") ?>/'+update,
            data : $('#formadd').serialize(),
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#modal_pegawai').modal('hide');

                if ($('#id_pegawai').val() !== '') {
                    message_edit_success();
                    get_list_pegawai($('#page_now').val());
                } else {
                    message_add_success();
                    get_pegawai(data.id);
                }

                hide_ajax_indicator();
            },
            error: function(e) {
                if ($('#id_pegawai').val() !== '') {
                    message_edit_failed();
                } else {
                    message_add_failed();
                }

                hide_ajax_indicator();
            }
        });
    }

    function edit_pegawai(id, p) {
        reset_data_pegawai();
        $('#page_now').val(p);
        $('#modal_title_pegawai').html('Edit Pegawai');
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/masterdata/pegawai"); ?>/id/'+id,
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#id_pegawai').val(data.data.id);
                $('#nama').val(data.data.nama);
                $('#kelamin').val(data.data.kelamin);
                $('#tempat_lahir').val(data.data.tempat_lahir);
                $('#tanggal_lahir').val((data.data.tanggal_lahir !== null)?datefmysql(data.data.tanggal_lahir):'');
                $('#alamat').val(data.data.alamat);
                $('#agama').val(data.data.agama);
                $('#s2id_jabatan_auto a .select2-chosen').html(data.data.jabatan);
                $('#telp').val(data.data.telp);
                $('#status').val(data.data.status);

                $('#modal_pegawai').modal('show');
            },
            error : function(e) {
                access_failed(e.status);
            }
        });
    }

    function delete_pegawai(id, p) {
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
                    url : '<?= base_url("api/masterdata/pegawai") ?>/id/'+id,
                    cache : false,
                    dataType: 'json',
                    success: function(data){
                        get_list_pegawai(p);
                        message_delete_success();
                    },
                    error: function(e){
                        get_list_pegawai(p);
                        message_delete_success();
                    }
                });
            }
        })
    }
</script>