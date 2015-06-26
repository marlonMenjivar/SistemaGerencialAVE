<!DOCTYPE html>
<?php
$cakeDescription = __d('cake_dev', 'Sistema Gerencial AVE');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<html>
  <head>
    <?php echo $this->Html->charset(); ?>
    <title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
    </title>
    <?php
        echo $this->Html->css(array('bootstrap',
            'font-awesome.min.css',
            'ionicons.min.css',
            'dataTables.bootstrap',
            'AdminLTE',
            'skin-blue',
            'datepicker'
            ));
    ?>
  </head>
  <body class="skin-blue sidebar-mini">
      <?php 
        //Lee el rol de usuario
        $role = $this->element('userRole')
      ?>
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="../pages/home" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><?php echo $this->Html->image('logo-mini.png',array('alt'=>'Logo mini'));?>
          </span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><?php echo $this->Html->image('logo-small.png',array('alt'=>'User Image'));?></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar
                  <img src="dist/img/photo.jpg" class="user-image" alt="User Image"/>-->
                  <?php echo $this->Html->image('photo.jpg',array(
                                                            'class'=>'user-image',
                                                            'alt'=>'User Image'
                  ))?>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $this->element('userName')?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <!--<img src="dist/img/photo.jpg" class="img-circle" alt="User Image" />-->
                    <?php echo $this->Html->image('photo.jpg',array(
                                                            'class'=>'img-circle',
                                                            'alt'=>'User Image'
                  ))?>
                    <p>
                      <?php echo $this->element('userName')?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">                     
                            <?php
                              echo $this->Html->link('Editar Cuenta',
                                                      array(
                                                              'controller'=>'Users',
                                                              'action'=>'editMe'
                                                          ),
                                                      array('class'=>'btn btn-default btn-flat')
                                      );  
                            ?>
                    </div>
                    <div class="pull-right">
                            <?php
                              echo $this->Html->link(
                                      'Cerrar Sesión',
                                                      array(
                                                              'controller'=>'Users',
                                                              'action'=>'logout',
                                                          ),
                                                      array('class'=>'btn btn-default btn-flat')
                                      );  
                            ?>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">



          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">SALIDAS</li>
            <!-- Optionally, you can add icons to the links -->
           <li>
                <?php 
                    echo $this->Html->link("Historial carga de datos", array('controller'=>'EtlUsers','action'=>'index'));
                ?>
            </li>
            <li class="treeview">
              <a href="#"><i class='fa fa-link'></i> <span>Salidas Tácticas</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                  <li><?php 
                        echo $this->Html->link("Comparativo de cumplimiento de metas por línea aérea por periodo BSP",
                                array('controller'=>'GoalAirlines','action'=>'comparativoMetasAerolinea'));
                        ?>
                  </li>
                  <li><?php 
                      echo $this->Html->link("Semi-resumen venta de boletos por líneas aéreas por destino semanal", 
                                             array('controller'=>'Airlines','action'=>'boletosPorDestinoSemanal'));
?>
                  </li>
                  <li><?php
                        echo $this->Html->link("Semi-resumen venta de boletos de líneas aéreas por rutas semanal", array('controller'=>'Airlines','action'=>'boletosPorRutaSemanal'));
                        ?>
                  </li>
                  <li>
                      <?php echo $this->Html->link("Comparativo de cumplimiento de venta de boletos aéreos por sucursal",
                                array('controller'=>'GoalBranchOffices','action'=>'comparativoMetas'));
                      ?>
                  </li>
                  <li>
                      <?php echo $this->Html->link("Comparativo de cumplimiento de venta de servicios terrestres por sucursal",
                                array('controller'=>'GoalBranchOffices','action'=>'comparativoMetasTerrestres'));
                      ?>
                  </li>
                  <li>
					<?= $this->Html->link(__('Semi-resumen de venta de servicios terrestres por tipo de servicio semanal'), array('controller' => 'reports', 'action' => 'show', 6)); ?>
                  </li>
                  <li>
					<?= $this->Html->link(__('Semi-resumen de venta de servicios terrestres por proveedor semanal'), array('controller' => 'reports', 'action' => 'show', 7)); ?>
                  </li>
              </ul>
            </li>
            <?php if ($role != 'tactic')  { ?>
                <li class="treeview">
              <a href="#"><i class='fa fa-link'></i> <span>Salidas Estratégicas</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
				<li><?= $this->Html->link(__('Total de venta de boletos aéreos por línea aérea por periodo BSP'), array('controller' => 'reports', 'action' => 'show', 8)); ?></li>
                <li><?php 
                        echo $this->Html->link("Acumulado de venta de boletos aéreos por líneas aéreas mensual",
                                array('controller'=>'GoalAirlines','action'=>'ventaBoletoAereosMensual'));
                        ?>
                </li>
                 <li><?php 
                        echo $this->Html->link("Acumulado venta de servicios terrestres por tipo de servicio mensual",
                                array('controller'=>'Reports','action'=>'ventaServicioTerrestreTipoServicioMensual'));
                        ?>
                  </li>
                   <li><?php 
                        echo $this->Html->link("Acumulado venta de servicios terrestres por proveedor mensual",
                                array('controller'=>'Reports','action'=>'ventaProveedorServicioTerrestreMensual'));
                        ?>
                  </li>
               
              </ul>
            </li>
            <?php } ?>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $this->fetch('pageHeader');?>
          </h1>
          <?php echo $this->fetch('pagePath');?>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <?php echo $this->Session->flash(); ?>
          <?php echo $this->fetch('content'); ?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer 
      <footer class="main-footer">
        <!-- To the right
        <div class="pull-right hidden-xs">
          Anything you want
        </div>
        <!-- Default to the left
        <strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.
      </footer>-->
      
      <!-- Control Sidebar -->      
      <aside class="control-sidebar control-sidebar-dark">                
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane active" id="control-sidebar-settings-tab">            

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">CONFIGURACIONES GENERALES</li>
            <!-- Optionally, you can add icons to the links -->
            <?php if ($role != 'tactic')  { ?>
                <?php if ($role != 'strategic')  { ?>
                    <li><?php echo $this->Html->link('Sucursales',array('controller'=>'BranchOffices',
                                                      'action'=>'index'
                        ))?>
                    </li>
                    <li><?php echo $this->Html->link('Metas por Sucursales',array('controller'=>'GoalBranchOffices',
                                                              'action'=>'index'
                        ))?>
                    </li>
                    <li><?php echo $this->Html->link('Aerolínea',array('controller'=>'Airlines',
                                                              'action'=>'index'
                        ))?>
                    </li>
                    <li><?php echo $this->Html->link('Metas por Aerolínea',array('controller'=>'GoalAirlines',
                                                              'action'=>'index'
                        ))?>
                    </li>
                    <li><?php echo $this->Html->link('Usuarios',array('controller'=>'Users',
                                                              'action'=>'index'
                        ))?>
                    </li>
                <?php } ?>      
            <?php } ?>          
          </ul><!-- /.sidebar-menu -->
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>-->
    <?php echo $this->Html->script('jQuery-2.1.4.min.js') ?>
    
    <!-- Bootstrap 3.3.2 JS
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->
    <?php echo $this->Html->script('bootstrap.min.js') ?>
    
    <!-- DATA TABES SCRIPT 
    <script src="../../plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>-->
    <?php echo $this->Html->script('jquery.dataTables.min.js') ?>
    <!--<script src="../../plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>-->
    <?php echo $this->Html->script('dataTables.bootstrap.min.js') ?>
    <!-- SlimScroll 
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>-->
    <?php echo $this->Html->script('jquery.slimscroll.min.js') ?>
    <!-- FastClick 
    <script src='../../plugins/fastclick/fastclick.min.js'></script>-->
    <?php echo $this->Html->script('fastclick.min.js') ?>
    <!-- AdminLTE App 
    <script src="dist/js/app.min.js" type="text/javascript"></script>-->
    <?php echo $this->Html->script('app.min.js') ?>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
    <?php
    echo $this->Html->script(array('bootstrap-datepicker','bootstrap-datepicker.es.min'));
    ?>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('.fecha').datepicker({
                    language: "es",
                    format: "yyyy/mm/dd",
                    todayHighlight: true,
                    autoclose:true
                }); 
                $('.mes').datepicker({
                    format: "yyyy/mm/dd",
                    startView: "months", 
                    minViewMode: "months",
                    autoclose:true,
                    language:"es"
                });
                
                <?php echo $this->fetch('scriptReady');?>
            });
			

            
        </script>
        <!-- page script -->
        <script type="text/javascript">
          $(function () {
            $(".tablitaBonita").dataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Sin registros encontrados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "paginate": {
                        first:      "Primero",
                        previous:   "Anterior",
                        next:       "Siguiente",
                        last:       "Último"
                    }
                },
                searching: false,
            });
            $('#example2').dataTable({
              "bPaginate": true,
              "bLengthChange": false,
              "bFilter": false,
              "bSort": true,
              "bInfo": true,
              "bAutoWidth": false
            });
          });
        </script>
  </body>
</html>