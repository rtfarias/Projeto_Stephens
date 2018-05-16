$(document).ready(function(){

  /* DataTable PARA AS LISTAGENS */
  $('#list-data-table, .list-data-table').DataTable({
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
		"order": [[ 0, "desc" ]],
		"language": {
			"sEmptyTable": "Nenhum registro encontrado",
		    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
		    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
		    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
		    "sInfoPostFix": "",
		    "sInfoThousands": ".",
		    "sLengthMenu": "_MENU_ resultados por página",
		    "sLoadingRecords": "Carregando...",
		    "sProcessing": "Processando...",
		    "sZeroRecords": "Nenhum registro encontrado",
		    "sSearch": "Pesquisar",
		    "oPaginate": {
		        "sNext": "Próximo",
		        "sPrevious": "Anterior",
		        "sFirst": "Primeiro",
		        "sLast": "Último"
		    },
		    "oAria": {
		        "sSortAscending": ": Ordenar colunas de forma ascendente",
		        "sSortDescending": ": Ordenar colunas de forma descendente"
		    }
		}
   });

	/*
	Script para submeter o formulário caso não possua campos required em branco.
	Faz a validação dos campos required do #mainForm
	*/
  $('.box-footer [type="submit"]').click(function(e){
	e.preventDefault();
	var wrongValidation = 0;
	var inputsNumber = 0;
   $('#mainForm [required]').each(function(){
		//console.log(tinyMCE.editors[$(this).attr('id')].getContent());
     if(!$(this).val() || ($(this).is('textarea') && $(this).hasClass('tinymce') && !tinyMCE.editors[$(this).attr('id')].getContent())){
		 inputsNumber++;
       $(this).css('border-color', '#dd4b39');
		 if($(this).is('textarea') && $(this).hasClass('tinymce')){
			if(!tinyMCE.editors[$(this).attr('id')].getContent()){
				$(this).prev().css('border-color', '#dd4b39');
			}else{
				wrongValidation++;
			}
		 }
     }
   });
	if(inputsNumber > wrongValidation){
		$('[href="#info-tab"]').closest('ul').find('li.active').removeClass('active');
      $('[href="#info-tab"]').closest('li').attr('class', 'active');
      $('.tab-content .tab-pane').removeClass('in active');
      $('#info-tab').addClass('in active');
		alertUtil.alertError('Verifique os erros do formulário.');
	}else{
		$('#mainForm').submit();
	}
  });

  $('#mainForm input').focus(function(){
    $(this).css('border-color', '#3c8dbc');
  });

  $('#mainForm input').blur(function(){
    $(this).css('border-color', '#d2d6de');
  });


  /*
  $('.session-return-wrapper .fa-times').click(function(){
  	$('.session-return-wrapper').fadeOut();
  });*/

  $('[href="#"]').click(function(e){
    e.preventDefault();
  });

  $('.fecha-alerta').click(function(){
    $(this).parents('.alerta').removeClass('active');
    $('.alerta').hide();
    $('.alerta').remove();
  });

  /* MASCARAS */
  //Datemask dd/mm/yyyy
  $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
  //Datemask2 mm/dd/yyyy
  $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
  //Money Euro
  $("[data-mask]").inputmask();

  /* BUSCA DE ENDERECO POR CEP */
  $('[name="cep"]').blur(function() {
      buscaCep();      
  });

  $('[name="cep"]').keypress(function(e) {
    if(e.which == 13) {
        buscaCep(); 
    }
  });



  /* VERIFICAR SE EMAIL JA EXISTE */
  /*$('[name="email"]').blur(function() {
      verificaSeEmailExiste($('[name="email"]').val());
  });

  $('[name="email"]').keypress(function(e) {
    if(e.which == 13) {
        verificaSeEmailExiste($('[name="email"]').val());
    }
  });

  $('[name="email"]').keydown(function(e){
      if(e.keyCode == 9) {
        verificaSeEmailExiste($('[name="email"]').val());
        console.log({{Route::getCurrentRoute()->getPath()}});
      }
  });*/


  var verificaSeEmailExiste = function(email){

      $.ajax({
        url: "/admin/verifica_email",
        dataType: 'json',
        type: 'POST',
        data: {
            'email': email,
        },
        success: function(resultado) {
          
          if(resultado == true){
            alert('E-mail já existe na base de dados! Você não pode cadastrar duas vezes o mesmo e-mail.');
            $('#email').focus();
            $('#email').val('');
          }

        },
        error: function(xhr, ajaxOptions, thrownError) {
            alertUtil.alertError(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });

  }




  /* BUSCA DE ENDERECO POR CEP */
  $('[name="numero"]').blur(function() {
      //$('#enderecoGmaps').val($('#enderecoGmaps').val() + ", " + $('#numero').val());
      $('#enderecoGmaps').focus();
  });

  $('[name="numero"]').keypress(function(e) {
    if(e.which == 13) {
        $('#enderecoGmaps').val($('#enderecoGmaps').val() + ", " + $('#numero').val());
        $('#enderecoGmaps').focus();
    }
  });

  $('[name="cep"]').keydown(function(e){
      if(e.keyCode == 9) {
        buscaCep();
      }
  });

  var buscaCep = function(){
    var cep = $('#cep').val().replace('-', '').replace('.', '');
      var verify = $.trim(cep);
      $.ajax({
          url: "/admin/getcep",
          dataType: 'json',
          type: 'POST',
          data: {
              'cep': verify,
              '_token': $('[name="_token"]').val()
          },
          success: function(resultadoCEP) {
              if (resultadoCEP["resultado"] == "1" || resultadoCEP["resultado"] == "2") {
                  //$(div_endereco).find('[name="endereco-fieldset[cidade]"]').val(unescape(resultadoCEP["cidade"]));
                  $('#bairro').val(unescape(resultadoCEP["bairro"]));
                  $('#endereco').val(unescape(resultadoCEP["tipo_logradouro"]) + " " + unescape(resultadoCEP["logradouro"]));
                  //$('#cidade').val(unescape(resultadoCEP["cidade"]));

                  $("#select2-cidade-container").attr("title", unescape(resultadoCEP["cidade"]));
                  $("#select2-cidade-container").text(unescape(resultadoCEP["cidade"]));
                  $("#cidade option").filter(function() {
                      return this.text == unescape(resultadoCEP["cidade"]); 
                  }).attr('selected', true);
                  
                  $('#enderecoGmaps').val(unescape(resultadoCEP["tipo_logradouro"]) + " " + unescape(resultadoCEP["logradouro"]));
                  $('#numero').focus();
              }

          },
          error: function(xhr, ajaxOptions, thrownError) {
              alertUtil.alertError(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
      });
  }

  var buscaCidade = function(id_estado){
    $.ajax({
      url: "/admin/busca_cidades/"+id_estado,
      dataType: 'json',
      type: 'GET',
      success: function(result) {
          return result;
      },
      error: function(xhr, ajaxOptions, thrownError) {
          alertUtil.alertError(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }

    });
  }

  /* UPLOAD E CROP DE IMAGEM */
  //Dropzone.js Options - Upload an image via AJAX.
  if(window.image_campo){
      Dropzone.options.myDropzone = {
        uploadMultiple: false,
        // previewTemplate: '',
        addRemoveLinks: false,
        // maxFiles: 1,
        dictDefaultMessage: '',
        init: function() {
          this.on("addedfile", function(file) {
            // console.log('addedfile...');
          });
          this.on("thumbnail", function(file, dataUrl) {
            // console.log('thumbnail...');
            $('.dz-image-preview').hide();
            $('.dz-file-preview').hide();
          });
          this.on("success", function(file, res) {
              console.log('upload success...');
              $('#img-thumb').attr('src', res.path);
              $('input[name="pic_url"]').val(res.path);
              var image = document.getElementById('img-thumb');
              var cropper = new Cropper(image, {
                crop: function(e) {
                  /*console.log(e.detail.x);
                  console.log(e.detail.y);
                  console.log(e.detail.width);
                  console.log(e.detail.height);*/
                }
              });
              $('#upload-submit').hide();
              $('#crop-image').fadeIn();

              $('#crop-image').click(function(){
                $('#cropForm [name="data_crop"]').val(JSON.stringify(cropper.getData()));
                $('#cropForm [name="file_name"]').val(res.file_name);
                $.ajax({
                  url:$('#cropForm').attr('action'),
                  type:$('#cropForm').attr('method'),
                  dataType:'JSON',
                  data:$('#cropForm').serialize(),
                  beforeSend:function(){

                  },
                  success:function(data){
                    if(data.status){
                      $('#img-thumb').attr('src',data.path);
                      $('[name="'+image_campo+'"]').val(data.file_name);
                      cropper.destroy();
                      $('#crop-image').hide();
                      $('#upload-submit').fadeIn();
                    }else{
                      alert(data.message);
                    }
                  }
                });
              });
          });
        }
      };
      var myDropzone = new Dropzone("#my-dropzone");

      $('#upload-submit').on('click', function(e) {
        e.preventDefault();
        //trigger file upload select
        $("#my-dropzone").trigger('click');
      });
  }

  if(window.image2_campo){
      Dropzone.options.myDropzone2 = {
        uploadMultiple: false,
        addRemoveLinks: false,
        dictDefaultMessage: '',
        init: function() {
          this.on("addedfile", function(file) {
            // console.log('addedfile...');
          });
          this.on("thumbnail", function(file, dataUrl) {
            // console.log('thumbnail...');
            $('.dz-image-preview').hide();
            $('.dz-file-preview').hide();
          });
          this.on("success", function(file, res) {
              console.log('upload success...');
              $('#img-thumb2').attr('src', res.path);
              $('input[name="pic_url"]').val(res.path);
              var image = document.getElementById('img-thumb2');
              var cropper = new Cropper(image, {
                crop: function(e) {
                }
              });
              $('#upload-submit2').hide();
              $('#crop-image2').fadeIn();

              $('#crop-image2').click(function(){
                $('#cropForm2 [name="data_crop"]').val(JSON.stringify(cropper.getData()));
                $('#cropForm2 [name="file_name"]').val(res.file_name);
                $.ajax({
                  url:$('#cropForm2').attr('action'),
                  type:$('#cropForm2').attr('method'),
                  dataType:'JSON',
                  data:$('#cropForm2').serialize(),
                  beforeSend:function(){

                  },
                  success:function(data){
                    if(data.status){
                      $('#img-thumb2').attr('src',data.path);
                      $('[name="'+image2_campo+'"]').val(data.file_name);
                      cropper.destroy();
                      $('#crop-image2').hide();
                      $('#upload-submit2').fadeIn();
                    }else{
                      alert(data.message);
                    }
                  }
                });
              });
          });
        }
      };
      var myDropzone2 = new Dropzone("#my-dropzone2");

      $('#upload-submit2').on('click', function(e) {
        e.preventDefault();
        //trigger file upload select
        $("#my-dropzone2").trigger('click');
      });
  }

  tinymce.init({
    selector:'.tinymce',
    force_br_newlines : true,
    force_p_newlines : false,
	 entity_encoding: "raw",
    forced_root_block : '', // Needed for 3.x
    plugins: [
      "advlist autolink lists link image charmap print preview anchor",
      "searchreplace visualblocks code fullscreen",
      "insertdatetime media table contextmenu paste jbimages"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
    relative_urls: false
  });

  $(document).on('click', '.deletar', function(e){
	  if(!confirm('Você tem certeza? Isso não pode ser desfeito.')){
		 e.preventDefault();
	  }
  });

  $('[name^="titulo"], [name^="nome"]').slugify({ slug: '[name="slug"]', type: '-' });

  $('.delete-image').click(function(){
	  var id = $(this).attr('data');
	  var modulo = $(this).attr('data-modulo');
	  $.ajax({
			 url: '/admin/'+modulo+'/delete_imagem/'+id,
			 dataType: 'JSON',
			 data:{
				 _token : $('[name="_token"]').val()
			 },
			 type: "POST",
			 success: function(data) {
				 $( '.imagem-galeria-' + id).remove();
				 if(data.status){
					 alertUtil.alertSuccess(data.message);
				 }else{
					 alertUtil.alertError(data.message);
				 }

			  }

		 });

  });

  $('.select2').select2();

  $('.select-icone').change(function(){
	  $('.icone-viewer i').attr('class','');
	  $('.icone-viewer i').attr('class', 'fa fa-3x '+$(this).val());
  });if($('.select-icone') !== undefined) $('.select-icone').trigger('change');

  $('.busca-cupom-box form').submit(function(e){
	  e.preventDefault();
	  window.location.href = "/admin/cupom/perfil/"+$(this).find('[name="codigo"]').val();
  });

});
