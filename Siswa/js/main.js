$(function(){
  $('#isi').load('home.php');	
});

function show_detail(ujian, kategori){
  $('#isi').load('detail.php?ujian=' + ujian + '&kategori=' + kategori);	
}
function show_nilai(ujian){
  $('#isi').load('nilai.php?ujian='+ujian);	
}

function show_petunjuk(ujian){
  $('#isi').load('petunjuk.php?ujian='+ujian);		
}

function show_ujian(ujian, kategori){
  switch (kategori) {
    case 'pilgan':
      $('#isi').load('ujian_pilgan.php?ujian=' + ujian);
      break;
    case 'essay':
      $('#isi').load('ujian.php?ujian='+ujian);
      break;
  
    default:
      break;
  }	
  return false;
}

function selesai_ujian(ujian){
  $.ajax({
    url: "ajax_ujian.php?action=selesai_ujian",
    type: "POST",
    data: "ujian="+ujian,
    success: function(data){
        if(data=="ok"){
          $('#modal-selesai').modal('hide');
          $('#modal-selesai').on('hidden.bs.modal', function(){
              $('#isi').load('home.php');
          });	
        }else{
          alert(data);
        }
    },
    error: function(){
        alert('Tidak dapat memproses nilai!');
    }
  });
  return false;
}