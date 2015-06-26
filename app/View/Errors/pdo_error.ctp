<h2><?php echo __d('cake_dev', 'Error al guardar el reporte:'); ?></h2>
<p class="alert alert-error">
        <button class="close" data-dismiss="alert">×</button>
        <strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
        <?php echo h($error->getMessage()); ?>
</p>

<p class="alert alert-info">
        <button class="close" data-dismiss="alert">×</button>
        <strong><?php echo __d('cake_dev', 'Nota'); ?>: </strong>
        <?php echo __d('cake_dev', 'Si desea cambiar datos anteriores comuniquese con el administrador del Sistema'); ?>
</p>

<div class="box-footer">
							<div class="row">
								<div class="col-md-12">
									<a href="javascript:history.go(-4)">Volver a la salida</a>
								</div>
							</div>
						</div>