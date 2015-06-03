<h1>Gestión de Usuarios</h1>
<?php 
    echo $this->Html->link("Agregar Usuario", array("action"=>"add",
                                                    'class'=>'btn btn-primary'));
?>
<br>
<br>
<table>
    <tr>
        <th><?php echo $this->Paginator->sort('id')?></th>
        <th><?php echo $this->Paginator->sort('name','Nombres')?></th>
        <th><?php echo $this->Paginator->sort('last_name','Apellidos')?></th>
        <th><?php echo $this->Paginator->sort('user_name','Username')?></th>
        <th><?php echo $this->Paginator->sort('role','Rol')?></th>
        <th><?php echo $this->Paginator->sort('created','Creación')?></th>
        <th><?php echo $this->Paginator->sort('modified','Última Modificación')?></th>
        <th>Editar</th>
        <th>Borrar</th>
    </tr>
    <?php
        foreach ($users as $k=>$user):    ?>
            <tr>
                <td><?php echo $user['User']['id'];?></td>
                <td><?php echo $user['User']['name'];?></td>
                <td><?php echo $user['User']['last_name'];?></td>
                <td><?php echo $user['User']['username'];?></td>
                <td><?php echo $user['User']['role'];?></td>
                <td><?php echo $user['User']['created'];?></td>
                <td><?php echo $user['User']['modified'];?></td>
                <td>
                    <?php echo $this->Html->link('Editar',array('action'=>'edit',$user['User']['id'])) ;
                    ?>
                </td>
                <td>
                    <?php echo $this->Form->postLink('Borrar',array('action'=>'delete',$user['User']['id']),
                            array('confirm'=>'¿Realmente desea eliminar a '.$user['User']['name'].'?'));
                    ?>
                </td>
            </tr>
     <?php   endforeach;?>
    <div class="paging">
        <?php echo $this->Paginator->prev('<', array(),null,array('class'=>'prev disabled'))?>
        <?php echo $this->Paginator->numbers(array('separator'=>''));?>
        <?php echo $this->Paginator->next('>',array(),null,array('class'=> 'next disabled'));?>
    </div>
</table>