<?php 
    include './includes/templates/header.php';
?>


     <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen-nosotros">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jepg"/> <!-- si no soporta webp carga este-->
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Imagen sobre nosotros" width="100%" height="100%">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>25 años de experiencia</blockquote>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit voluptas id ipsam quia nam sapiente eius, fuga doloribus pariatur sunt minima tempore saepe quibusdam ducimus dolorem animi blanditiis est doloremque!
                Ratione illo, tempore repellendus quod, quaerat molestias magnam deserunt ex tenetur perferendis rerum officiis saepe dicta voluptates, perspiciatis obcaecati laboriosam delectus maiores. Suscipit dolor accusamus voluptas neque, praesentium deleniti impedit. </p>
                <p> Sapiente consectetur architecto nulla iste sint quasi laudantium a, officiis alias magnam cumque, facere quisquam natus at dolorum! Reiciendis dolores cupiditate nam.
                Reiciendis incidunt possimus dicta unde porro! Consequatur eum laboriosam saepe sapiente, ut repudiandae recusandae odio sequi perferendis culpa error vitae minima ipsam hic impedit exercitationem? Voluptatum quos molestiae ducimus accusantium!</p>
            </div>
        </div>


     </main>

     <section class="contenedor seccion">
        <h1>Más sobre nosotros</h1>


        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono de Seguridad" width="100%" height="100%" loading="lazy">
                <h3>Seguridad</h3>  
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate amet sit sapiente id, aperiam cumque, aspernatur exercitationem distinctio praesentium saepe ratione, sequi ad nemo molestiae repellendus laboriosam impedit repudiandae! Natus!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono de Precio "width="100%" height="100%" loading="lazy">
                <h3>Precio</h3>  
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate amet sit sapiente id, aperiam cumque, aspernatur exercitationem distinctio praesentium saepe ratione, sequi ad nemo molestiae repellendus laboriosam impedit repudiandae! Natus!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono de tiempo" width="100%" height="100%" loading="lazy">
                <h3>A tiempo</h3>  
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate amet sit sapiente id, aperiam cumque, aspernatur exercitationem distinctio praesentium saepe ratione, sequi ad nemo molestiae repellendus laboriosam impedit repudiandae! Natus!</p>
            </div>
        </div>
     </section>

     <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.html">Nosotros</a>
                <a href="anuncios.html">Anuncios</a>
                <a href="blog.html">Blog</a>
                <a href="contacto.html">Contacto</a>
            </nav>
            
        </div>
        <p class="copyright">Todos los derechos Reservados 2024 &copy;</p>
     </footer>



    <script src="build/js/bundle.min.js"></script>
</body>
</html>