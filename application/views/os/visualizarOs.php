<?php $totalServico = 0; $totalProdutos = 0;?>
<div class="row-fluid" style="margin-top: 0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Ordem de Serviço</h5>
                <div class="buttons">
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'eOs')){
                        echo '<a title="Icon Title" class="btn btn-mini btn-info" href="'.base_url().'index.php/os/editar/'.$result->idOs.'"><i class="icon-pencil icon-white"></i> Editar</a>'; 
                    } ?>
                    
                    <a id="imprimir" title="Imprimir" class="btn btn-mini btn-inverse" href=""><i class="icon-print icon-white"></i> Imprimir</a>
                </div>
            </div>
            <div class="widget-content" id="printOs">
                <div class="invoice-content">
                    <div class="invoice-head" style="margin-bottom: 0">

                        <table class="table">
                            <tbody>
                                <?php if($emitente == null) {?>
                                            
                                <tr>
                                    <td colspan="3" class="alert">Você precisa configurar os dados do emitente. >>><a href="<?php echo base_url(); ?>index.php/mapos/emitente">Configurar</a><<<</td>
                                </tr>
                                <?php } else {?>
                                <tr>
                                    <td style="width: 25%"><img src=" <?php echo $emitente[0]->url_logo; ?> "></td>
                                    <td> <span> <?php echo $emitente[0]->nome; ?></span> </br><span><?php echo $emitente[0]->cnpj; ?> </br> <?php echo $emitente[0]->rua.', nº:'.$emitente[0]->numero.', '.$emitente[0]->bairro.' - '.$emitente[0]->cidade.' - '.$emitente[0]->uf; ?> </span> </br> <span> E-mail: <?php echo $emitente[0]->email.' - Fone: '.$emitente[0]->telefone; ?></span></td>
                                    <td style="width: 18%; text-align: center">#Protocolo: <span ><?php echo $result->idOs?> <?php if($result->status == 'Orçamento'){?> - ORÇAMENTO <?php }?></span></br> </br> <span>Emissão: <?php echo date('d/m/Y')?></span> </td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>

                
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 33%; padding-left: 0">
                                        <ul>
                                            <li>
                                                <span ><h5>Cliente</h5>
                                                <span><?php echo $result->nomeCliente;?> - <?php echo $result->celular;?></span><br/>
                                                <span><?php echo $result->rua?>, <?php echo $result->numero?>, <?php echo $result->bairro?></span><br/>
                                                <span ><?php echo $result->cidade?> - <?php echo $result->estado?></span></br>
                                                <span>DESCRIÇÃO: <?php echo $result->descricaoProduto?></span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td style="width: 33%; padding-left: 0">
                                        <ul>
                                            <li>
                                                <span><h5>Responsável</h5></span>
                                                <span><?php echo $result->nome?></span> <br/>
                                                <span>Telefone: <?php echo $result->telefone?></span><br/>
                                                <span>Email: <?php echo $result->email?></span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td style="width: 33%; padding-left: 0">
                                        <ul>
                                            <li>
                                                <span><h5>Prazo de Entrega:</h5></span>
                                                <span><?php echo date(('d/m/Y'),strtotime($result->dataFinal)) ?></span>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
      
                    </div>


                   

                    <?php if($result->defeito != null){?>
                    <hr style="margin-top: 0">
                    <h5>Defeito</h5>
                    <p>
                        <?php echo $result->defeito?>
                    </p>
                    <?php }?>
                    <?php if($result->laudoTecnico != null){?>
                    <hr style="margin-top: 0">
                    <h5>Laudo Técnico</h5>
                    <p>
                        <?php echo $result->laudoTecnico?>
                    </p>
                    <?php }?>
                    <?php if($result->observacoes != null){?>
                    <hr style="margin-top: 0">
                    <h5><b><font color = "red">Observações</b></h5>
                    <p>
                        <?php echo $result->observacoes?>
                    </p></font>
                    <?php }?>

                        <?php if($produtos != null){?>
                        <br />
                        <table class="table table-bordered" id="tblProdutos">
                                    <thead>
                                        <tr>
                                            <th>Descriçao</th>
                                            <th>Dimensões / Quantidade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        foreach ($produtos as $p) {

                                            $frontao = (($p->espelho1 + $p->espelho2)-$p->espelho1)*100;
                                            $saia = (($p->saia1 + $p->saia2)-$p->saia1)*100;
                                            $totalProdutos = $totalProdutos + $p->subTotal;
                                            echo '<tr>';
                                            
                                            if ($p->unidade == "M2"){
                                                echo '<td>'.$p->descricao.' - '.$p->descp;
                                                echo '<br>Frontão de '.$frontao.' cm<br>Saia de '.$saia.' cm</td>';
                                               echo  '<td>'.$p->quantidade. ' x '.$p->quantidade2.'</td>';; 
                                            }else{
                                               echo '<td>'.$p->descricao.'</td>';
                                               echo '<td>'.$p->quantidade.'</td>';
                                            }
                                            
                                        }
                                        setlocale(LC_MONETARY, 'en_US');
                                        foreach ($servicos as $s) {
                                            $preco = $s->totalsrv;
                                            $totalServico = $totalServico + $preco;
                                            echo '<tr>';
                                            echo '<td>'.$s->descricao.'</td>';
                                            echo '<td>'.'-'.'</td>';
                                            echo '</tr>';
                                        }
                                        
                                        ?>
                                      

                                        
                                    </tbody>
                                </table>
                               <?php }?>
                        
                                   
                                        
                    
                        <h4 style="text-align: right">Valor Total: R$ <?php echo number_format($totalProdutos + $totalServico,2,',','.');?></h4>

                    </div>
                   
                    <h5 style="text-align: right" >Condições de Pagamento: 1/30/60/90 ou 5% à vista</h5>
                    </br>
                    <h5 style="text-align: center" ><b><font color = "red">Granitos, Mármores e Pedras em geral por sua própria natureza estão sujeitos a variações de cores, veios e desenhos, não podendo ser recusados pelas diferenças naturais</font></b></h5>

            

                    
                    
              
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#imprimir").click(function(){         
            PrintElem('#printOs');
        })

        function PrintElem(elem)
        {
            Popup($(elem).html());
        }

        function Popup(data)
        {
            var mywindow = window.open('', 'MapOs', 'height=600,width=800');
            mywindow.document.write('<html><head><title>Map Os</title>');
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/bootstrap.min.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/bootstrap-responsive.min.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/matrix-style.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/matrix-media.css' />");


            mywindow.document.write("</head><body >");
            mywindow.document.write(data);          
            mywindow.document.write("</body></html>");

            setTimeout(function(){
                mywindow.print();
            }, 50);

            return true;
        }

    });
</script>