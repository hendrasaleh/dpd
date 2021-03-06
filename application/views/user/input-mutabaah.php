
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-body">
          <div class="box">
            <form action="<?= base_url('mutabaah/tambah'); ?>" method="post">
              <div class="box-header col-sm-6">
                <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                  <?= validation_errors(); ?>
                </div>
                <?php endif; ?>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Jenis Kegiatan</th>
                            <th>Pelaksanaan/Pekan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Tanggal Pelaksanaan UPA</td>
                            <td>
                              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal" data-date-format="yyyy-mm-dd" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Kehadiran UPA</td>
                            <td>
                              <select name="liqo" id="liqo" class="form-control select2">
                                <option value="1">Hadir</option>
                                <option value="0">Tidak Hadir</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Tilawah Al Qur'an 1 Juz/hari</td>
                            <td>
                              <select name="tilawah" id="tilawah" class="form-control select2">
                                <?php for ($i = 1; $i <= 7; $i++) : ?>
                                <option value="<?= $i; ?>"><?= $i . ' Juz'; ?></option>
                                <?php endfor; ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Dzikir pagi Al Ma'tsuraat</td>
                            <td>
                              <select name="dzikir_pagi" id="dzikir_pagi" class="form-control select2">
                                <?php for ($i = 1; $i <= 7; $i++) : ?>
                                <option value="<?= $i; ?>"><?= $i . ' Juz'; ?></option>
                                <?php endfor; ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>Dzikir petang Al Ma'tsuraat</td>
                            <td>
                              <select name="dzikir_petang" id="dzikir_petang" class="form-control select2">
                                <?php for ($i = 1; $i <= 7; $i++) : ?>
                                <option value="<?= $i; ?>"><?= $i . ' Juz'; ?></option>
                                <?php endfor; ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>Dzikir Tasbih, Tahmid, Takbir, Tahlil 100x / hari</td>
                            <td>
                              <select name="dzikir_lain" id="dzikir_lain" class="form-control select2">
                                <?php for ($i = 1; $i <= 7; $i++) : ?>
                                <option value="<?= $i; ?>"><?= $i . ' Juz'; ?></option>
                                <?php endfor; ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>7</td>
                            <td>Membaca sholawat 100x / hari</td>
                            <td>
                              <select name="shalawat" id="shalawat" class="form-control select2">
                                <?php for ($i = 1; $i <= 7; $i++) : ?>
                                <option value="<?= $i; ?>"><?= $i . ' Juz'; ?></option>
                                <?php endfor; ?>
                              </select>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Jenis Kegiatan</th>
                            <th>Pelaksanaan/Pekan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Tanggal Pelaksanaan UPA</td>
                            <td>
                              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal" data-date-format="yyyy-mm-dd" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Kehadiran UPA</td>
                            <td>
                              <div class="icheck-success d-inline">
                                <input type="radio" id="liqo1" name="liqo" value="1" required>
                                <label for="liqo1">Ya
                                </label>
                              </div>&nbsp;
                              <div class="icheck-danger d-inline">
                                <input type="radio" id="liqo2" name="liqo" value="0" required>
                                <label for="liqo2">Tidak
                                </label>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Tilawah Al Qur'an 1 Juz/hari</td>
                            <td>
                              <select name="tilawah" id="tilawah" class="form-control select2">
                                <?php for ($i = 1; $i <= 7; $i++) : ?>
                                <option value="<?= $i; ?>"><?= $i . ' Juz'; ?></option>
                                <?php endfor; ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Dzikir pagi Al Ma'tsuraat</td>
                            <td>
                              <select name="dzikir_pagi" id="dzikir_pagi" class="form-control select2">
                                <?php for ($i = 1; $i <= 7; $i++) : ?>
                                <option value="<?= $i; ?>"><?= $i . ' Juz'; ?></option>
                                <?php endfor; ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>Dzikir petang Al Ma'tsuraat</td>
                            <td>
                              <select name="dzikir_petang" id="dzikir_petang" class="form-control select2">
                                <?php for ($i = 1; $i <= 7; $i++) : ?>
                                <option value="<?= $i; ?>"><?= $i . ' Juz'; ?></option>
                                <?php endfor; ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>Dzikir Tasbih, Tahmid, Takbir, Tahlil 100x / hari</td>
                            <td>
                              <select name="dzikir_lain" id="dzikir_lain" class="form-control select2">
                                <?php for ($i = 1; $i <= 7; $i++) : ?>
                                <option value="<?= $i; ?>"><?= $i . ' Juz'; ?></option>
                                <?php endfor; ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>7</td>
                            <td>Membaca sholawat 100x / hari</td>
                            <td>
                              <select name="shalawat" id="shalawat" class="form-control select2">
                                <?php for ($i = 1; $i <= 7; $i++) : ?>
                                <option value="<?= $i; ?>"><?= $i . ' Juz'; ?></option>
                                <?php endfor; ?>
                              </select>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <input type="hidden" name="email" value="<?= $user['email']; ?>">
                <input type="hidden" name="upa_id" value="<?= $user['upa_id']; ?>">
                <button class="btn btn-success" type="submit" name="tamu-add">Submit</button>
                <a class="btn btn-warning" href="<?= base_url('mutabaah'); ?>">Batal</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
