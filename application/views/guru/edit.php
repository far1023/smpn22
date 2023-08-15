<section class="content">
    <div class="row">
        <div class="col-xs-12">

          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Edit Guru</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
                echo form_open('guru/edit', 'role="form" class="form-horizontal"');
                echo form_hidden('id_guru', $guru['id_guru']);
                echo form_hidden('id_user', $guru['id_user']);
            ?>

                <div class="box-body">

                  <div class="form-group">
                      <label class="col-sm-2 control-label">NIP</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $guru['nuptk']; ?>" name="nuptk" class="form-control" placeholder="Masukkan NIP">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Nama Guru</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $guru['nama_guru']; ?>" name="nama_guru" class="form-control" placeholder="Masukkan Nama Lengkap Guru">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Jenis Kelamin</label>

                      <div class="col-sm-5">
                        <?php
                          echo form_dropdown('gender', array('Pilih Jenis Kelamin', 'P'=>'Laki-Laki', 'W'=>'Perempuan'), $guru['gender'], "class='form-control'");
                        ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Password</label>

                      <div class="col-sm-9">
                        <input type="password" value="" name="password" class="form-control" placeholder="Masukan Password">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-1">
                        <button type="submit" name="submit" class="btn btn-primary btn-flat">Simpan</button>
                      </div>

                      <div class="col-sm-1">
                        <?php
                          echo anchor('guru', 'Kembali', array('class'=>'btn btn-danger btn-flat'));
                        ?>
                      </div>
                  </div>

                </div>
                <!-- /.box-body -->
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
