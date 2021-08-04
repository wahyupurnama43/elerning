<?php
  session_start();
  include "../config/koneksi.php";
?>
<div class="content-wrapper">
  <h4> <b>Pengumuman</b> <small class="text-muted">/ </small></h4>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Data Pengumuman</h4>
            <div class="table-responsive">
              <table class="table table-condensed table-striped table-hover" id="data">
                <thead>
                  <tr>
                    <th class="text-center">No.</th> 
                    <th class="text-center">Mapel</th> 
                    <th class="text-center">Judul</th> 
                    <th class="text-center">Isi</th> 
                    <th class="text-center">Tanggal</th>                
                  </tr>                        
                </thead>  
                <tbody>
                  <?php 
                    function tgl_indo($tanggal){
                      $bulan = array (
                        1 =>   'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                      );
                      $pecahkan = explode('-', $tanggal);
                      return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    $no   = 1;
                    $pengumuman = mysqli_query($con, "SELECT * FROM tb_pengumuman 
                      JOIN tb_roleguru ON tb_pengumuman.roleguru = tb_roleguru.id_roleguru
                      JOIN tb_master_mapel ON tb_roleguru.id_mapel = tb_master_mapel.id_mapel
                      WHERE tb_roleguru.id_kelas = $_SESSION[id_kelas]
                      ORDER BY id ASC
                    ");
                    foreach ($pengumuman as $d) { ?>
                      <tr>
                        <td width="50" class="text-center"><b><?=$no++; ?>.</b> </td>
                        <td class="text-center"><?=$d['mapel']?> </td>
                        <td class="text-center"><?=$d['judul']?> </td>
                        <td class="text-center"><?=$d['isi']?> </td>
                        <td class="text-center"><?= tgl_indo(substr($d['tgl'], 0, 10)); ?></td>    
                      </tr>  
                    <?php } 
                  ?>                      
                </tbody>                      
              </table>                    
            </div>
          </div>
        </div>                  
      </div>
    </div>
  </div>
