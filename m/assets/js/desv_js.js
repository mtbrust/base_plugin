


// Ao carregar página.
jQuery(document).ready(function () {


  // Cria a caixa de Poopup
  jQuery('body').append("<div id='popup-desv-memb' style='display: none;'><div class='poup-desv-memb-caixa'><div class='popup-desv-memb-caixa-close' onclick='dm_popup_close()'></div><div class='popup-desv-memb-inner'><div class='popup-desv-memb-close'><a class='dm_icon_btn' onclick='dm_popup_close()'><i class='fas fa-times'></i></a></div><h5 id='popup-dm-titulo'><i class='fas fa-sync-alt'></i> Carregando</h5><div id='popup-dm-conteudo'></div></div></div>");


  // Função que abre menu passado por ancora.
  var hash = window.location.hash;
  jQuery(hash).closest("#desv_memb_conteudo").children('div').hide();
  jQuery(hash).show();
  //window.location.hash = hash;


});



// Função que exibe e esconde menu de acordo com a ancora enviada.
function desv_memb_menu(e) {
  hash = jQuery(e).attr("href");
  jQuery(hash).closest("#desv_memb_conteudo").children('div').hide();
  jQuery(hash).show();
  window.location.hash = hash;
}



// Função que exibe e esconde menu de acordo com parametro enviado.
function desv_memb_menu_direct(e) {
  hash = e;
  jQuery(hash).closest("#desv_memb_conteudo").children('div').hide();
  jQuery(hash).show();
  window.location.hash = hash;
}



// Função que fecha o popup.
function dm_popup_close() {
  jQuery('#popup-desv-memb').hide();
}




// Exibe popup para [i] informação de descrição.
function desv_memb_popup_desc(desc) {
  // Limpa popup.
  jQuery("#popup-dm-titulo").html('<i class="fas fa-sync-alt"></i> Carregando');
  jQuery("#popup-dm-conteudo").html(desc);
  // Escreve título
  jQuery("#popup-dm-titulo").html('<i class="fas fa-info"></i> Informação');
  // Exibe o popup
  jQuery('#popup-desv-memb').show();
}





// Busca CEP.
String.prototype.removeCharAt = function (i) {
  var tmp = this.split(''); // convert to an array
  tmp.splice(i - 1 , 1); // remove 1 element from the array (adjusting for non-zero-indexed counts)
  return tmp.join(''); // reconstruct the string
}

function desv_memb_get_endereco(e) {
  var cep = e.value;
  if (cep.length == 9){
    cep = cep.removeCharAt(6);
    jQuery.ajax({
      method: "GET",
      url: "https://viacep.com.br/ws/" + cep + "/json/",
      dataType: "json",
      success: function (result) {
        //console.log(result);
        jQuery("#f-endereco").val(result.logradouro);
        jQuery("#f-bairro").val(result.bairro);
        jQuery("#f-cidade").val(result.localidade);
        jQuery("#f-estado").val(result.uf);
      }
    });
  }
  else
    return;
}



// Copia texto para área de transferência.
function copiarTexto(texto){
  inputTest = document.createElement("input");
  inputTest.style.visibile = 'none';
  inputTest.value = texto;
  document.body.appendChild(inputTest);
  inputTest.select();
  document.execCommand('copy');
  document.body.removeChild(inputTest);
};