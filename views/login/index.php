

<section style="display: flex; align-items: center; width: 100%;height: 100vh; ">
    <div class="container" style="display: flex; justify-content: center;  width:100%;">
        <div class="card" style="width: 60%; max-width: 400px;">
            <div class="card-body">
                <h1 style="text-align: center;">Login</h1>
                <form action="<?= URL ?>login/authentication" method="POST">
                    <label for="">Correo</label>
                    <input type="email" class="form-control" name="emailInput">

                    <label for="">Contraseña</label>
                    <input type="password" class="form-control" name="passwordInput">

                    <button type="submit" class="btn btn-primary form-control">Ingresar</button>
                </form>
            </div>
        </div>

    </div>
</section>

<style>

 section{
     background: url("<?=URL?>resource/img/wallpaper.jpg");
 }
 .card{
     color: #fff;
     background-color: rgba(0, 0, 0, 0.5);
     border-radius: 10px;
     backdrop-filter: blur(10px);
 }  
</style>