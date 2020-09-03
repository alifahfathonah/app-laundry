<br><input type="hidden" name="page_now" id="page_now_group"/>
<div class="row">
	<div class="col-sm-10">
       <?= form_button('tambah', '<i class="fa fa-plus"></i> Tambah Group User' ,'id=bt_tambah_group_user class="btn btn-primary"')?>
        <?= form_button('reset', '<i class="fa fa-refresh"></i> Reload Data' ,'id=bt_reset_group_user class="btn"')?></li>
    </div>
    <div class="col-sm-2">
        <input type="text" class="search form-control" onkeyup="get_list_group_user(1)" id="pencarian_group_user" placeholder="Pencarian">
    </div>
</div>
<div class="row"><br></div>

<table class="table table-striped table-hover" id="table_group_user">
    <thead>
        <tr class="info">
            <th width="5%" style="text-align: center;">NO</th>
            <th width="70%">NAMA</th>
            <th width="25%"></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<div class="pages_summary" id="p_summary"></div>       
<div id="pagination"></div>

<div class="modal inmodal" id="modal_group_user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="modal_title_group_user">Tambah Group User</h4>
            </div>
            <div class="modal-body">
                <?= form_open('', 'id=formadd role=form class=form-horizontal'); ?>
                    <input type="hidden" name="id" id="id_group_user">

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Nama Group</label>

                        <div class="col-lg-9">
                            <input type="text" name="nama_group" id="nama_group" placeholder="Nama Group" class="form-control">
                        </div>
                    </div>
                    
                <?= form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="float-e-margins btn btn-white" data-dismiss="modal"><i class="fa fa-refresh"></i> Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpan_group_user()"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modal_privileges" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="modal_title_group_user"><i class="fa fa-gears"></i> &nbsp;Edit User Privileges</h4>
                <small class="font-bold">Mengontrol Privileges untuk setiap pengguna</small>
            </div>
            <div class="modal-body">
            	<div class="row">
					<div class="col-sm-12">
						<?= form_button('', '<i class="fa fa-list"></i> Check All' ,'onclick=check_all() class="btn btn-primary"')?>
                		<?= form_button('', '<i class="fa fa-list-alt"></i> Uncheck All' ,'onclick=uncheck_all() class="btn btn-primary"')?>
				    </div>
				</div>
				<br>
                <?= form_open('', 'id=formprivileges role=form class=form-horizontal'); ?>
                    <input type="hidden" name="id" id="id">

                    <table class="table table-bordered table-stripped table-hover" id="table_priv">
			            <thead>
			                <tr>
			                    <th align="center" width="5%">No.</th>
			                    <th width="20%" class="left">Modul</th>
			                    <th width="65%" class="left">Nama Menu</th>
			                    <th align="center" width="10%"></th>
			                </tr>
			                    
			            </thead>

			            <tbody ></tbody>
			        </table>
                    
                <?= form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="float-e-margins btn btn-white" data-dismiss="modal"><i class="fa fa-refresh"></i> Batal</button>
                <button type="button" class="btn btn-primary" onclick="save_priv()"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        get_list_group_user(1);

        var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });


        $('#bt_tambah_group_user').click(function(){
            $('#modal_group_user').modal('show');
            $('#modal_title_group_user').html('Tambah Group User');
            reset_data_group_user();
        });

        $('#bt_reset_group_user').click(function(){
            reset_data_group_user();
            get_list_group_user(1);
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

    function reset_data_group_user() {
        $('#id_group_user, .form-control,  #pencarian_group_user').val('');
        dc_validation_remove('.form-control');
    }

    function check_all(){
		$(".check").each( function() {
            $(this).attr("checked",'checked');
        });
	}

	function uncheck_all(){
		$(".check").each( function() {
            $(this).removeAttr('checked');
        });
	}

    function get_group_user(id) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/sistem/group_user") ?>/id/'+id,
            cache : false,
            dataType : 'JSON',
            success: function(data) {
                $('#pagination').html('&nbsp;<br>&nbsp;<br>');
                $('#p_summary').html(page_summary(1, 1, data.limit, data.page));

                $('#table_group_user tbody').empty();
                var str =   '<tr>'+
                                '<td align="center">1</td>'+
                                '<td>'+data.data.nama+'</td>'+
                                '<td align="center" class="aksi">'+
                                	'<button type="button" class="btn btn-xs" onclick="edit_privileges(\''+data.data.id+'\', '+data.page+')"><i class="fa fa-gears"></i> Edit Privileges</button> '+
                                    '<button type="button" class="btn btn-xs" onclick="edit_group_user(\''+data.data.id+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i> Edit</button> '+
                                    '<button type="button" class="btn btn-xs" onclick="delete_group_user(\''+data.data.id+'\', '+data.page+')"><i class="fa fa-trash"></i> Hapus</button>'+
                                '</td>'+
                            '</tr>';
                $('#table_group_user tbody').append(str);
            },
            error: function(e) {
                access_failed(e.status);
            }
        });
    }

    function get_list_group_user(p) {
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/sistem/group_users"); ?>/page/'+p,
            cache : false,
            data : 'pencarian='+$('#pencarian_group_user').val(),
            dataType : 'json',
            success: function(data) {
                if ((p > 1) & (data.data.length === 0)) {
                    get_list_group_user(p - 1);
                    return false;
                };

                $('#pagination').html(pagination(data.jumlah, data.limit, data.page, 2));
                $('#p_summary').html(page_summary(data.jumlah, data.data.length, data.limit, data.page));

                $('#table_group_user tbody').empty();

                var str = '';
                $.each(data.data, function(i, v) {
                    str = '<tr>'+
                            '<td align="center">'+((i+1) + ((data.page - 1) * data.limit))+'</td>'+
                            '<td>'+v.nama+'</td>'+
                            '<td align="center" class="aksi">'+
                            	'<button type="button" class="btn btn-xs" onclick="edit_privileges(\''+v.id+'\', '+data.page+')"><i class="fa fa-gears"></i> Edit Privileges</button> '+
                                '<button type="button" class="btn btn-xs" onclick="edit_group_user(\''+v.id+'\', '+data.page+')"><i class="fa fa-pencil-square-o"></i> Edit</button> '+
                                '<button type="button" class="btn btn-xs" onclick="delete_group_user(\''+v.id+'\', '+data.page+')"><i class="fa fa-trash"></i> Hapus</button>'+
                            '</td>'+
                          '</tr>';
                    $('#table_group_user tbody').append(str);
                });
            },
            error: function(e){
                access_failed(e.status);
            }
        });
    }

    function paging(p) {
        get_list_group_user(p);
    }

    function simpan_group_user() {
        var stop = false;

        if ($('#nama_group').val() === '') {
            dc_validation('#nama_group', 'Nama group harus diisi!');
            stop = true;
        };

        if (stop) {
            return false;
        }

        var update = '';
        if ($('#id_group_user').val() !== '') {
            update = 'id/'+ $('#id_group_user').val();
        }

        show_ajax_indicator();
        $.ajax({
            type : 'POST',
            url : '<?= base_url("api/sistem/group_user") ?>/'+update,
            data : $('#formadd').serialize(),
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#modal_group_user').modal('hide');

                if ($('#id_group_user').val() !== '') {
                    message_edit_success();
                    get_list_group_user($('#page_now_group').val());
                } else {
                    message_add_success();
                    get_group_user(data.id);
                }

                hide_ajax_indicator();
            },
            error: function(e) {
                if ($('#id_group_user').val() !== '') {
                    message_edit_failed();
                } else {
                    message_add_failed();
                }

                hide_ajax_indicator();
            }
        });
    }

    function edit_group_user(id, p) {
        reset_data_group_user();
        $('#page_now_group').val(p);
        $('#modal_title_group_user').html('Edit Group User');
        $.ajax({
            type : 'GET',
            url : '<?= base_url("api/sistem/group_user"); ?>/id/'+id,
            cache : false,
            dataType : 'json',
            success: function(data) {
                $('#id_group_user').val(data.data.id);
                $('#nama_group').val(data.data.nama);

                $('#modal_group_user').modal('show');
            },
            error : function(e) {
                access_failed(e.status);
            }
        });
    }

    function edit_privileges(id){
		$.ajax({
            type : 'GET',
            url: '<?= base_url("api/sistem/group_user_privileges") ?>/id/'+id,
            cache: false,
            dataType : 'json',
            success: function(data) {
            	$('#id').val(id);
            	$('#table_priv tbody').empty();          
                var str = '';
              	var modul = '';
              	var no = 1;
                $.each(data,function(i, v){
              
                	var cek = '';
                	if (v.id_group_users !== null) {
                		cek = 'checked="checked"';
                	};

                    var highlight = 'odd';
                    if ((i % 2) == 1) {
                        highlight = 'even';
                    };

                    str = '<tr class="'+highlight+'">'+
                            '<td align="center"><b>'+((modul !== v.module)?no:'')+'</b></td>'+
                            '<td><b>'+((modul !== v.module)?v.module:'')+'</b></td>'+
                            '<td>'+v.menu+'</td>'+
                            '<td align="center" class="aksi">'+
                            	'<input type="checkbox" name="data[]" value="'+ v.id +'" '+cek+' class="check" />';
                            '</td>'+
                        '</tr>;'
                    $('#table_priv tbody').append(str);

                    if (modul !== v.module) {
                    	no++;
                    	modul = v.module;
                    };
                });

                $('#modal_privileges').modal('show');
            },
            error: function(e){
                access_failed(e.status);
            }
        });
	}

    function delete_group_user(id, p) {
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
                    url : '<?= base_url("api/sistem/group_user") ?>/id/'+id,
                    cache : false,
                    dataType: 'json',
                    success: function(data){
                        get_list_group_user(p);
                        message_delete_success();
                    },
                    error: function(e){
                        get_list_group_user(p);
                        message_delete_success();
                    }
                });
            }
        })
    }

    function save_priv(){
		var id = $('#id').val();
		$.ajax({
            type : 'POST',
            url: '<?= base_url("api/sistem/group_user_privileges") ?>/id/'+id,
            cache: false,
            data: $('#formprivileges').serialize(),
            dataType : 'json',
            success: function(data) {
            	$('#modal_privileges').modal('hide');
                message_edit_success();
            },
            error: function(e){
                message_edit_failed();  
            }
        });
		
	}
</script>