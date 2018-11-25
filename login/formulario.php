<div class="container-fluid formLoginCont">
	<div class="row">
		<div class="col-0 col-md-8"></div>
		<div class="col-0 col-md-4 formLogin d-flex align-items-center">
			<div id="formLog" class="col-12">
				<div class="form-group">
					<input type="email" class="form-control from-1 place-letras-separadas" id="usuario" placeholder="Ingresar correo" autocomplete="on"  required minlength="8" maxlength="30" onkeypress="if (event.keyCode == 13) focusClave()">
				</div>

				<div class="form-group">
					<input type="password" class="form-control from-1 place-letras-separadas" id="password" placeholder="Contraseña" required minlength="6" maxlength="30" onkeypress="if (event.keyCode == 13) iniciar_sesion()">
				</div>
				<div class="form-group" id="infosesion"></div>
				<div class="form-group">
					<button type="button" class="btn btn-block btn-outline-light letras-separadas" id="btn-ini-sesion" onclick="iniciar_sesion()">Ingresar</button>
				</div>
			</div>
		</div>
	</div>
</div>