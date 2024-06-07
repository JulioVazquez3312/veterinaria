<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-primary text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Nueva contraseña</h2>
              <p class="text-white-50 mb-5">Porfavor establece tu nueva contraseña!</p>
              <form action="login.php?action=recovery&token=<?php echo $token; ?>" method="post">
                <div class="form-outline form-white mb-4">
                  <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" />
                  <label class="form-label" for="typePasswordX">Password</label>
                </div>
                  <!-- Submit button -->
                  <input type="submit" class="btn btn-primary btn-block mb-4" value="Establecer">
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>