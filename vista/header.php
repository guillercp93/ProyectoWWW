<div class="top">
	<span id="fecha"></span>
	<nav>
		<ul>
			<li class="drop">
				<label><?php echo utf8_encode($_SESSION['nombre'])." ".utf8_encode($_SESSION['apellido'])?></label>
				<div class="dropdownContain">
					<div class="dropOut">
						<div class="triangle"></div>
						<ul>
							<li onclick="cargarAjax('vista/editarUsuario.php', 'escritorio');">Editar Perfil</li>
							<li onclick="cargarAjax('vista/cambiarContrasenia.php', 'escritorio');">Cambiar Contraseña</li>
							<li onclick="cerrarSesion('controlador/Usuario_Control.php', 'contenedor');">Cerrar Sesión</li>
						</ul>
					</div>
				</div>
			</li>
		</ul>
	</nav>
</div>
<header>
	<img src="img/salud.jpg">
	<h1>Gestor de Citas</h1>
</header>