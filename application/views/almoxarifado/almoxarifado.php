<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aVenda')){ ?>
    <a href="<?php echo base_url();?>index.php/almoxarifado/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Pedido</a>
<?php } ?>

<?php

if(!$results){?>
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-tags"></i>
         </span>
        <h5>Pedidos Almoxarifado</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Data </th>
            <th>Nome</th>
            <th>Observação</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="6">Nenhuma pedido Cadastrada</td>
        </tr>
    </tbody>
</table>
</div>
</div>
<?php } else{?>


<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-tags"></i>
         </span>
        <h5>Pedidos</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Data</th>
            <th>Nome</th>
            <th>Observação</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            $dataAlmox = date(('d/m/Y'),strtotime($r->dataAlmox));
                     
            echo '<tr>';
            echo '<td>'.$r->idAlmox.'</td>';
            echo '<td>'.$dataAlmox.'</td>';
            echo '<td><a href="'.base_url().'index.php/usuarios/visualizar/'.$r->idUsuarios.'">'.$r->nome.'</a></td>';
            echo '<td>'.$r->obs.'</td>';
            
            echo '<td>';
            if($this->permission->checkPermission($this->session->userdata('permissao'),'vVenda')){
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/almoxarifado/visualizar/'.$r->idAlmox.'" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'eVenda')){
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/almoxarifado/editar/'.$r->idAlmox.'" class="btn btn-info tip-top" title="Editar"><i class="icon-pencil icon-white"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'dVenda')){
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" almoxarifado="'.$r->idAlmox.'" class="btn btn-danger tip-top" title="Excluir"><i class="icon-remove icon-white"></i></a>'; 
            }

            echo '</td>';
            echo '</tr>';
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
	
<?php echo $this->pagination->create_links();}?>


<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/almoxarifado/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idAlmox" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>






<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var almoxarifado = $(this).attr('almoxarifado');
        $('#idAlmox').val(almoxarifado);

    });

});

</script>