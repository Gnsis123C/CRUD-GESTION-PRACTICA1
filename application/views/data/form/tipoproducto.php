<div class="panel panel-info">
    <div class="panel-heading">
        <div class="row">
            <div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <h2 class="text-primary" style="font-size: 20px">
                        <img src="<?= $img ?>" alt="icon" class="img-circle" width="70">
                        <label id="accion_form"></label> <?= $title ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" id="demo-form2">
            <input type="hidden" id="action" name="action" value="">
            <input type="hidden" name="id" id="id_" value="">
            
            <div class="form-group">
                <label for="nomtipo" class="control-label col-md-4 col-sm-3 col-xs-12">Nombre *</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="nombre" id="nombre" value="" class="form-control col-md-7 col-xs-12" placeholder="Nombre" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="nomtipo" class="control-label col-md-4 col-sm-3 col-xs-12">Estado</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="estado" id="estado" class="form-control">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="text-center">
                <div class="row">
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <button id="ver-lista" type="button" class="btn btn-primary btn-sm">
                            <span class="fa fa-list"></span>
                            <span>Regresar</span>
                        </button>
                    </div><div class="col-md-6 col-sm-6 col-xs-12">
                        <button type="submit" id="boton_submit" class="btn btn-default btn-sm">
                            <span id="loading" class="fa fa-save"></span>
                            <span id="caption">Guardar Registro</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<br>