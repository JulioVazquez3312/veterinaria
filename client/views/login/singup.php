<section class="vh-100 gradient-custom">
<form action="register.php" method="post">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-primary text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Registro</h2>
              <p class="text-white-50 mb-5">Por favor ingrese sus datos para registrarse!</p>

              <div class="form-outline form-white mb-4">
                <input type="email" id="typeEmailX" name="correo" class="form-control form-control-lg" required />
                <label class="form-label" for="typeEmailX">Correo</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" required />
                <label class="form-label" for="typePasswordX">Contraseña</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="text" id="primerApellidoX" name="primer_apellido" class="form-control form-control-lg" required />
                <label class="form-label" for="primerApellidoX">Primer Apellido</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="text" id="segundoApellidoX" name="segundo_apellido" class="form-control form-control-lg" required />
                <label class="form-label" for="segundoApellidoX">Segundo Apellido</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="text" id="nombreX" name="nombre" class="form-control form-control-lg" required />
                <label class="form-label" for="nombreX">Nombre</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="text" id="rfcX" name="rfc" class="form-control form-control-lg" />
                <label class="form-label" for="rfcX">RFC</label>
              </div>

              <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Registrar"></input>

            </div>

            <div>
              <p class="mb-0">Ya tienes una cuenta? <a href="login.php" class="text-white-50 fw-bold">Inicia Sesión</a></p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
</section>