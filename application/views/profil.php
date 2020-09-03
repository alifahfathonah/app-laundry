<div class="row animated fadeInRight">
    <div class="col-md-4">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>My Profile</h5>
            </div>
            <div>
            <div class="ibox-content no-padding border-left-right">
                <center><br>
                    <?php if ($this->session->userdata('foto') == NULL): ?>
                        <img src="<?= base_url('img/user.png'); ?>" class="img-fluid" width="100%" alt="Foto User">
                    <?php else: ?>
                        <img alt="image" class="img-fluid" width="100%" src="<?= base_url("foto/"); ?><?= $this->session->userdata('foto'); ?>">
                    <?php endif ?>
                </center>
            </div>
            <div class="ibox-content profile-content">
                <h4><strong><?= $this->session->userdata('nama'); ?></strong></h4>
                <p><i class="fa fa-map-marker"></i> <?= $this->session->userdata('alamat'); ?></p>
                <h5>
                    About me
                </h5>
                <p>
                    Tanggal lahir : <?= $this->session->userdata('tanggal_lahir'); ?><br>
                    Agama : <?= $this->session->userdata('agama'); ?><br>
                    No Telp : <?= $this->session->userdata('telp'); ?><br><br>
                    
                    <br>
                    <form class="form-horizontal" id="submit">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $this->session->userdata('id_user'); ?>">
                            <center><input type="file" class="form-control" name="file" id="foto"></center>
                            <center><small><i>Update foto profil kamu</i></small></center>
                        </div>
         
                        <div class="form-group">
                            <center><button class="btn btn-primary" id="btn_upload" type="submit">Upload</button></center>
                        </div>
                    </form> 
                </p>
            </div>
        </div>
    </div>
        </div>
    <div class="col-md-8">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Deskripsi</h5>
            </div>
            <div class="ibox-content">
                <p align="justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa sit veniam, harum omnis a quidem corporis distinctio vel qui ab laudantium earum perspiciatis nam dolores ipsam hic saepe unde nemo, ipsa at mollitia pariatur. Officiis cumque magnam nihil iure beatae illum vero dicta aliquam ea numquam expedita, et molestias inventore necessitatibus quaerat accusantium, similique dolore repellendus porro corrupti? Facilis, excepturi molestias voluptas expedita, odio architecto, cupiditate accusamus recusandae mollitia voluptatum provident quidem distinctio dolor dolorem! Animi aspernatur, dolores quas rerum! Nesciunt at, asperiores, nemo esse eveniet iure aliquid? Sed praesentium quod odio, eos, impedit ex quo earum doloribus aperiam hic assumenda maxime, rem, ratione nesciunt odit repellat voluptatem voluptatibus molestiae! Animi illo beatae maxime quibusdam corporis, suscipit quo libero! Deleniti similique id impedit quae reiciendis sit dolore repellat quas pariatur praesentium explicabo molestiae esse corrupti delectus aut fugit labore, fugiat totam odit recusandae optio ipsa qui dolores sed. Maxime culpa alias perspiciatis tenetur neque iusto a impedit aliquam quas ipsa, placeat voluptate assumenda praesentium iure ut ipsum debitis blanditiis nemo tempore sunt! Sequi non, unde. Nostrum vitae inventore in veritatis consequuntur dicta illum, rerum ea perferendis nisi sapiente saepe itaque, commodi voluptas. Sunt nemo, consectetur accusantium dolores totam numquam non deserunt tenetur necessitatibus corrupti doloribus quibusdam qui eveniet. Delectus repudiandae necessitatibus quibusdam ipsam, ad sapiente, veritatis doloremque officiis. Cumque laboriosam repellendus tempore odio accusantium totam aliquid nemo asperiores ut, deleniti nobis inventore ipsam eius vel temporibus, autem similique expedita nostrum, est iusto perspiciatis magnam amet! Nobis explicabo numquam, ex molestias saepe aliquam sit reiciendis, eligendi quod fugiat provident dolorum cum dignissimos modi incidunt repudiandae quam enim ipsa tempora pariatur ducimus. Enim aut rerum neque dolor ex laudantium aperiam natus, ab obcaecati fugit explicabo perspiciatis, aspernatur tempora, maiores doloremque reiciendis architecto. Recusandae alias perspiciatis in laborum magnam id eos doloremque porro voluptas ea sequi reprehenderit maxime odit deserunt earum magni ducimus architecto possimus totam, autem. Assumenda eaque quasi numquam deserunt totam quae praesentium optio. Mollitia nulla aliquid unde enim. Quibusdam, distinctio dolores harum dolorem, id optio quod iusto accusamus facilis assumenda nesciunt natus. Tempore, nam enim error sapiente dolores, sit asperiores molestias eum accusamus dolore unde illum nemo earum a libero, non ut placeat veritatis aliquid fuga provident perspiciatis deleniti pariatur. Tenetur impedit quis ad error architecto nisi nesciunt magnam deleniti, ducimus quas aliquid perferendis voluptas molestiae tempora est saepe iure sapiente, officia quam, non nobis cupiditate. Suscipit eos labore fugit illum et at harum rem necessitatibus, voluptatum consequatur ducimus molestiae sint earum ullam modi commodi tempore similique. Dolorem commodi optio qui magni, illum vero in recusandae libero nemo ipsam omnis impedit earum ipsa reiciendis. Aspernatur, ipsum, dolorem? Praesentium autem odit voluptatum fuga accusamus amet ut nisi error est accusantium voluptate asperiores quas eius incidunt aperiam, assumenda quam soluta fugiat totam debitis voluptas sequi, animi excepturi! Quidem corporis obcaecati, id, illum laudantium veritatis quae perspiciatis optio culpa, omnis porro numquam vero nam odit iste quas enim beatae dignissimos aliquam deserunt recusandae veniam consequatur qui! Corporis modi, quas laboriosam, repellat assumenda similique!</p>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#submit').submit(function (e) {
            var stop = false;
            e.preventDefault();
            if ($('#foto').val() !== '') {
                $.ajax({
                    type : 'POST',
                    url : '<?= base_url("app/do_upload"); ?>',
                    data : new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    success: function(data) {
                        $('#foto, .form-control').val('');
                        dc_validation_remove('.form-control');
                        message_custom('success', 'Upload Image Berhasil');
                    }

                });    
            } else {
                dc_validation('#foto', 'Foto harus dipilih dahulu!');
                stop = true;
                // message_custom('info', 'Silahkan pilih file!')
            }
            
        })
    })
</script>