<?php
    $this->start('pageHeader');
    echo '<h1>Comparativo de Metas por Aerolínea</h1>';
    $this->end();
?>
<?php echo $this->Form->create('salida1',array('class'=>'form')); 

?>

<?php echo $this->Form->end((array('label'=>'Botoncito',
                                    'class'=>'btn btn-primary')));

