<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-md-12" >
			<div class="form-group">
      			<label for="input_nombre">Institución:</label>
	     		<input type="text" class="form-control" name="input_nombre" id="input_nombre" placeholder="Ingrese nombre de Institución" autocomplete="on" autofocus onkeypress="if (event.keyCode == 13) comprobar_registrar_institucion()">
	     	</div>
	    </div>
	    <div class="col-xs-12 col-md-6" >
	    	<div class="form-group">
      			<label for="input_nombre">Imagen Institución:</label>
	     		<input name='subir_logo_certificacion' type='file' class="form-control" />
	     	</div>
	    </div>
	    <div class="col-xs-12 col-md-6" >
	    	<div class="form-group">
      			<label for="input_nombre">Imagen Certificación:</label>
	     		<input name='subir_logo_certificacion' type='file' class="form-control"/>
	     	</div>
	    </div>
	    <div class="col-xs-12  col-md-12" >
	    	<div class="form-group">
	      		<button type="submit" class="btn btn-primary" onclick="comprobar_registrar_institucion()">Registrar</button>
	      	</div>
	    </div>
	</div>
    <!--<div class="form-group">
    	<label for="input_nombre">Institución:</label>
      	<input type="text" class="form-control" name="input_nombre" id="input_nombre" placeholder="Ingrese nombre de Institución" autocomplete="on" autofocus onkeypress="if (event.keyCode == 13) comprobar_registrar_institucion()">
    </div>
    <div id="errorInstitucion"></div>-->

</div>