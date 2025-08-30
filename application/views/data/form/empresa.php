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
            <input type="hidden" id="action" name="action" value="edit">
            <input type="hidden" name="id" id="id_" value="<?= $this->session->userdata('empresa')[0]->idempresa ?>">
            <div class="form-group">
                <label for="nomtipo" class="control-label col-md-4 col-sm-3 col-xs-12">Nombre</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="nombre" id="nombre" value="<?= $this->session->userdata('empresa')[0]->nombre ?>" class="form-control col-md-7 col-xs-12" placeholder="Nombre" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="nomtipo" class="control-label col-md-4 col-sm-3 col-xs-12">Teléfono</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="tel" name="telefono" id="telefono" value="<?= $this->session->userdata('empresa')[0]->telefono ?>" class="form-control col-md-7 col-xs-12" placeholder="Teléfono" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="nomtipo" class="control-label col-md-4 col-sm-3 col-xs-12">Dirección</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="direccion" id="direccion" value="<?= $this->session->userdata('empresa')[0]->direccion ?>" class="form-control col-md-7 col-xs-12" placeholder="Nombre" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="nomtipo" class="control-label col-md-4 col-sm-3 col-xs-12">RUC</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="ruc" id="ruc" value="<?= $this->session->userdata('empresa')[0]->ruc ?>" maxlength="13" class="form-control col-md-7 col-xs-12" placeholder="RUC" required="">
                </div>
            </div>
            <div class="text-center">
                <div class="row">

                    <div class="col-md-6 col-sm-6 col-xs-12">
                    </div><div class="col-md-6 col-sm-6 col-xs-12">
                        <button type="submit" id="boton_submit" class="btn btn-success btn-sm">
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