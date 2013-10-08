<?php
/**
 * Template Name: Page Registro
 */
?>
<?php get_header(); ?>
<?php
$regiones = getRegiones();
$comunas = getComunas();
?>
<script type="text/javascript">
    var comunas = JSON.parse('<?php echo json_encode($comunas, JSON_HEX_QUOT | JSON_HEX_APOS ); ?>');
</script>
<div id="registro" class="col-sm-10 content4">
    
    <div class="cont-effect"></div>
        
    <h2>Regístrate</h2>

    

    <form name="data" id="data" method="post" action="" class="row form-horizontal" for="form">
                
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputNomb">Nombre</label>
                <div class="col-sm-9">
                  <input type="text" name="firstname" id="firstname" value="<?php if($userData->firstname) echo $userData->firstname ?>" class="required text form-control" text="Ingresa tu nombre">
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputApel">Apellido</label>
                <div class="col-sm-9">
                    <input type="text" name="lastname" id="lastname" value="<?php if($userData->lastname) echo $userData->lastname ?>" class="required text form-control" text="Ingresa tu apellido">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputRut">RUT</label>
                <div class="col-sm-9">
                    <input type="text" name="rut" id="rut" value="" class="form-control required rut" text="Ingresa tu rut">
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputEmail">E-Mail</label>
                <div class="col-sm-9">
                    <input type="text" name="email" id="email" value="<?php if($userData->email) echo $userData->email ?>" class="required email form-control" text="Ingresa tu email">
                </div>

            </div>
        </div>

        <div class="col-sm-6">
            
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputCelu">Celular</label>
                <div class="col-sm-9">
                    <input type="text" name="phone" id="phone" value="" class="required phone form-control" text="Ingresa tu celular">
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputDirec">Dirección</label>
                <div class="col-sm-9">
                    <input type="text" name="address" id="address" value="" class="required notempty form-control" text="Ingresa tu dirección">
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputDirec">Región</label>
                <div class="col-sm-9">
                    <select name="region_id" id="region_id" class="required select form-control" text="Selecciona tu región">
                            <option value="">Selecciona</option>
                            <?php foreach ( $regiones as $region ) { ?>
                            <option value="<?php print $region->id; ?>"><?php print $region->name; ?></option>
                            <?php } ?>
                    </select>
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputDirec">Comuna</label>
                <div class="col-sm-9">
                    <select name="comuna_id" id="comuna_id" class="required select form-control" text="Selecciona tu comuna">
                            <option value="">Selecciona</option>
                    </select>
                </div>

            </div>

        </div>
        
        <div class="clearfix"></div>

        <p>Términos y condiciones La información entregada es de uso exclusivo de Evercrisp S.A. Tus datos serán tratados de forma confidencial y bajo ningún motivo serán utilizados con fines ajenos a la promoción, ni entregados a terceros.</p>

        <div class="text-center bases_concurso">

            <input type="checkbox" class="required checkbox pull-left" text="Debes aceptar las bases." id="bases" name="bases">
            <p class="pull-left">Declaro ser mayor de 18 años y<br>acepto las <a target="_blank" href="#">bases de la promoción.</a></p>
            
        </div>


    </form>
    
    <div class="row intro_links">
        <div class="pull-left alert alert-danger alert-error error hide">
            <p class="text-center"></p>
        </div>

        <div class="pull-right">

            <a id="enviar" href="" class="text-center btncaja nr8">
                <div class="btn_out_right"></div>
                <span>&lt;&lt;</span>
                Enviar
            </a>

        </div>

    </div>

</div>
<?php get_footer(); ?>
