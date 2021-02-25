

<div class="register-box">
  <div class="register-logo">
    <b>PKS</b> Kuningan
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Silakan isi form berikut untuk registrasi</p>

      <form action="<?= base_url('auth/registration'); ?>" method="post">
        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="name" name="name" placeholder="Nama lengkap" value="<?= set_value('name'); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <div class="col-6">
            <td>
              <div class="icheck-primary d-inline">
                <input type="radio" id="jenis_kelamin1" name="jenis_kelamin" value="1" required>
                <label for="jenis_kelamin1">
                  Laki-laki
                </label>
              </div>
            </td>
          </div>
          <div class="col-6">
            <td>
              <div class="icheck-success d-inline">
                <input type="radio" id="jenis_kelamin2" name="jenis_kelamin" value="0" required>
                <label for="jenis_kelamin2">
                  Perempuan
                </label>
              </div>
            </td>
          </div>
        </div>
        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="email" name="email" placeholder="No handphone (WA)" value="<?= set_value('email'); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <br />
      <p class="text-center">
        <a href="<?= base_url('auth'); ?>" class="text-center">Saya sudah mempunyai akun</a>
      </p>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
