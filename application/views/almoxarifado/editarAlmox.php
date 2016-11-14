<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>


<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Editar</h5>
            </div>
            <div class="widget-content nopadding">


                <div class="span12" id="divProdutosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divEditarAlmox">
                                
                                <form action="<?php echo current_url(); ?>" method="post" id="formAlmox">
                                    <?php echo form_hidden('idAlmox',$result->idAlmox) ?>
                                    
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <h3>#Venda: <?php echo $result->idAlmox ?></h3>
                                        <div class="span2" style="margin-left: 0">
                                            <label for="dataFinal">Data Final</label>
                                            <input id="dataVenda" class="span12 datepicker" type="text" name="dataVenda" value="<?php echo date('d/m/Y', strtotime($result->dataVenda)); ?>"  />
                                        </div>
                                       
                                        <div class="span5">
                                            <label for="tecnico">Vendedor<span class="required">*</span></label>
                                            <input id="tecnico" class="span12" type="text" name="tecnico" value="<?php echo $result->nome ?>"  />
                                            <input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value="<?php echo $result->usuarios_id ?>"  />
                                        </div>
                                        
                                    </div>
                                    
                                    
                                   
                                   
                                    <div class="span12" style="padding: 1%; margin-left: 0">
            
                                        <div class="span8 offset2" style="text-align: center">
                                            
                                            <button class="btn btn-primary" id="btnContinuar"><i class="icon-white icon-ok"></i> Alterar</button>
                                            <a href="<?php echo base_url() ?>index.php/vendas/visualizar/<?php echo $result->idVendas; ?>" class="btn btn-inverse"><i class="icon-eye-open"></i> Visualizar Venda</a>
                                            <a href="<?php echo base_url() ?>index.php/vendas" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                        </div>

                                    </div>

                                </form>
                                
                                <div class="span12 well" style="padding: 1%; margin-left: 0">
                                        
                                        <form id="formProdutos" action="<?php echo base_url(); ?>index.php/almoxarifado/adicionarProduto" method="post">
                                            <div class="span8">
                                                <input type="hidden" name="idProduto" id="idProduto" />
                                                <input type="hidden" name="idVendasProduto" id="idVendasProduto" value="<?php echo $result->idVendas?>" />
                                                <input type="hidden" name="estoque" id="estoque" value=""/>
                                                <label for="">Produto</label>
                                                <input type="text" class="span12" name="produto" id="produto" placeholder="Digite o nome do produto" />
                                            </div>
                                            <div class="span2">
                                                <label for="">Quantidade</label>
                                                <input type="text" placeholder="Quantidade" id="quantidade" name="quantidade" class="span12" />
                                            </div>
                                            <div class="span2">
                                                <label for="">&nbsp</label>
                                                <button class="btn btn-success span12" id="btnAdicionarProduto"><i class="icon-white icon-plus"></i> Adicionar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="span12" id="divProdutos" style="margin-left: 0">
                                        <table class="table table-bordered" id="tblProdutos">
                                            <thead>
                                                <tr>
                                                    <th>Produto</th>
                                                    <th>Quantidade</th>
                                                    <th>Ações</th>
                                                    <th>Sub-total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;
                                                foreach ($produtos as $p) {
                                                    
                                                    $total = $total + $p->subTotal;
                                                    echo '<tr>';
                                                    echo '<td>'.$p->descricao.'</td>';
                                                    echo '<td>'.$p->quantidade.'</td>';
                                                    echo '<td><a href="" idAcao="'.$p->idItens.'" prodAcao="'.$p->idProdutos.'" quantAcao="'.$p->quantidade.'" title="Excluir Produto" class="btn btn-danger"><i class="icon-remove icon-white"></i></a></td>';
                                                    echo '<td>R$ '.number_format($p->subTotal,2,',','.').'</td>';
                                                    echo '</tr>';
                                                }?>
                                               
                                                <tr>
                                                    <td colspan="3" style="text-align: right"><strong>Total:</strong></td>
                                                    <td><strong>R$ <?php echo number_format($total,2,',','.');?></strong> <input type="hidden" id="total-venda" value="<?php echo number_format($total,2); ?>"></td>
                                                </tr>
                                            </tbody>
                                        </table>


                                        


                                    </div>

                            </div>

                        </div>

                    </div>

                </div>


.

        </div>

    </div>
</div>
</div>



 

<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>js/maskmoney.js"></script>
<script type="text/javascript">
$(document).ready(function(){

     $(".money").maskMoney(); 

     $('#recebido').click(function(event) {
        var flag = $(this).is(':checked');
        if(flag == true){
          $('#divRecebimento').show();
        }
        else{
          $('#divRecebimento').hide();
        }
     });

     $(document).on('click', '#btn-faturar', function(event) {
       event.preventDefault();
         valor = $('#total-venda').val();
         valor = valor.replace(',', '' );
         $('#valor').val(valor);
     });
     
     $("#formFaturar").validate({
          rules:{
             descricao: {required:true},
             cliente: {required:true},
             valor: {required:true},
             vencimento: {required:true}
      
          },
          messages:{
             descricao: {required: 'Campo Requerido.'},
             cliente: {required: 'Campo Requerido.'},
             valor: {required: 'Campo Requerido.'},
             vencimento: {required: 'Campo Requerido.'}
          },
          submitHandler: function( form ){       
            var dados = $( form ).serialize();
            $('#btn-cancelar-faturar').trigger('click');
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>index.php/vendas/faturar",
              data: dados,
              dataType: 'json',
              success: function(data)
              {
                if(data.result == true){
                    
                    window.location.reload(true);
                }
                else{
                    alert('Ocorreu um erro ao tentar faturar venda.');
                    $('#progress-fatura').hide();
                }
              }
              });

              return false;
          }
     });

     $("#produto").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteProduto",
            minLength: 2,
            select: function( event, ui ) {

                 $("#idProduto").val(ui.item.id);
                 $("#estoque").val(ui.item.estoque);
                 $("#preco").val(ui.item.preco);
                 $("#quantidade").focus();
                 

            }
      });



      $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteCliente",
            minLength: 2,
            select: function( event, ui ) {

                 $("#clientes_id").val(ui.item.id);


            }
      });

      $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteUsuario",
            minLength: 2,
            select: function( event, ui ) {

                 $("#usuarios_id").val(ui.item.id);


            }
      });



      $("#formAlmox").validate({
          rules:{
             tecnico: {required:true},
             dataVenda: {required:true}
          },
          messages:{
             tecnico: {required: 'Campo Requerido.'},
             dataVenda: {required: 'Campo Requerido.'}
          },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
       });




      $("#formProdutos").validate({
          rules:{
             quantidade: {required:true}
          },
          messages:{
             quantidade: {required: 'Insira a quantidade'}
          },
          submitHandler: function( form ){
             var quantidade = parseInt($("#quantidade").val());
             var estoque = parseInt($("#estoque").val());
             if(estoque < quantidade){
                alert('Você não possui estoque suficiente.');
             }
             else{
                 var dados = $( form ).serialize();
                $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/vendas/adicionarProduto",
                  data: dados,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $("#divProdutos" ).load("<?php echo current_url();?> #divProdutos" );
                        $("#quantidade").val('');
                        $("#produto").val('').focus();
                    }
                    else{
                        alert('Ocorreu um erro ao tentar adicionar produto.');
                    }
                  }
                  });

                  return false;
                }

             }
             
       });

     

       $(document).on('click', 'a', function(event) {
            var idProduto = $(this).attr('idAcao');
            var quantidade = $(this).attr('quantAcao');
            var produto = $(this).attr('prodAcao');
            if((idProduto % 1) == 0){
                $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/vendas/excluirProduto",
                  data: "idProduto="+idProduto+"&quantidade="+quantidade+"&produto="+produto,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $( "#divProdutos" ).load("<?php echo current_url();?> #divProdutos" );
                        
                    }
                    else{
                        alert('Ocorreu um erro ao tentar excluir produto.');
                    }
                  }
                  });
                  return false;
            }
            
       });

       $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });




});

</script>

