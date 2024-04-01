<?php 
    include './includes/templates/header.php';
?>


     <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

            <picture>
                <source srcset="build/img/destacada.webp" type="image/webp">
                <source srcset="build/img/destacada.jpg" type="image/jepg">
                <img loading="lazy" src="build/img/destacada.jpg" alt="Casa en venta">
            </picture>

            <div class="resumen-propiedad">
                <p class="precio">600.000€</p>         

                <ul class="iconos-caracteristicas">
                    <li>
                        <img loading="lazy" src="build/img//icono_wc.svg" alt="Icono wc" height="100%" width="100%">
                        <p>3</p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img//icono_estacionamiento.svg" alt="Icono estacionamiento" height="100%" width="100%">
                        <p>3</p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img//icono_dormitorio.svg" alt="Icono dormitorios" height="100%" width="100%">
                        <p>5</p>
                    </li>
                </ul>
                
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, consequatur? Provident porro sit tempore illum! Nam explicabo magnam commodi natus blanditiis placeat veritatis fugiat perferendis eveniet, consequuntur iusto dolorem iure!
                Mollitia aut aspernatur blanditiis qui quis quidem amet tempora accusantium tenetur, aperiam expedita? Minus sequi perferendis iusto, molestiae facere ut. Magni suscipit dolorum omnis, quis quasi saepe eos temporibus reiciendis?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, consequatur? Provident porro sit tempore illum! Nam explicabo magnam commodi natus blanditiis placeat veritatis fugiat perferendis eveniet, consequuntur iusto dolorem iure!
                Mollitia aut aspernatur blanditiis qui quis quidem amet tempora accusantium tenetur, aperiam expedita? Minus sequi perferendis iusto, molestiae facere ut. Magni suscipit dolorum omnis, quis quasi saepe eos temporibus reiciendis?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, consequatur? Provident porro sit tempore illum! Nam explicabo magnam commodi natus blanditiis placeat veritatis fugiat perferendis eveniet, consequuntur iusto dolorem iure!
                Mollitia aut aspernatur blanditiis qui quis quidem amet tempora accusantium tenetur, aperiam expedita? Minus sequi perferendis iusto, molestiae facere ut. Magni suscipit dolorum omnis, quis quasi saepe eos temporibus reiciendis?</p>

                
            </div><!-- .Contenido Anuncio -->
        </div><!--.anuncio-->


     </main>

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