<?php 

    require 'includes/funciones.php';
    $inicio = true;
    incluirTemplate('header', $inicio);
?>



     <main class="contenedor seccion">
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
     </main>

     <section class="seccion contenedor">
        <h2>Casas y apartamentos en venta</h2>
        <div class="contenedor-anuncios">
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio1.webp" type="image/webp">
                    <source srcset="build/img/anuncio1.jpg" type="image/jepg">
                    <img loading="lazy" src="build/img/anuncio1.jpg" alt="Casa en venta">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa de Lujo en el lago</h3>
                    <p>Casa en el lago con excelente vista, acabados de lujos a un excelente precio</p>
                    <p class="precio">250.000€</p>

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

                    <a href="anuncio.php" class="boton boton-amarillo-block">Ver Propiedad</a>
                </div><!-- .Contenido Anuncio -->
            </div><!--.anuncio-->
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio2.webp" type="image/webp">
                    <source srcset="build/img/anuncio2.jpg" type="image/jepg">
                    <img loading="lazy" src="build/img/anuncio2.jpg" alt="Casa en venta">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa Terminados de Lujo</h3>
                    <p>Casa con diseño moderno, así como tecnología inteligente y amueblada</p>
                    <p class="precio">230.000€</p>

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

                    <a href="anuncio.php" class="boton boton-amarillo-block">Ver Propiedad</a>
                </div><!-- .Contenido Anuncio -->
            </div><!--.anuncio-->
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio3.webp" type="image/webp">
                    <source srcset="build/img/anuncio3.jpg" type="image/jepg">
                    <img loading="lazy" src="build/img/anuncio3.jpg" alt="Casa en venta">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa extra Lujo con piscina</h3>
                    <p>Casa con piscina y acabados de lujo en la ciudad, excelente oportunidad</p>
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

                    <a href="anuncio.php" class="boton boton-amarillo-block">Ver Propiedad</a>
                </div><!-- .Contenido Anuncio -->
            </div><!--.anuncio-->
        </div><!--.contenedor-anuncios-->

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>

     </section>

     <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Rellena el formulario de contacto y un asesor se pondrá en contacto contigo en breve</p>
        <a href="contacto.html" class="boton-amarillo">Contáctanos</a>
     </section>

     <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp"/>
                        <source srcset="build/img/blog1.jpg" type="image/jepg"/>
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Imagen blog" height="100%" width="100%">
                    </picture>
                </div><!--.Imagen Entrada-->
                <div class="texto-entrada">
                    <a href="entrada.php"><h4>Terraza en el techo de tu casa</h4></a>
                    
                    <p class="informacion-meta">Escrito el <span>20/03/2024</span> por <span>Admim</span></p>

                    <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y poco coste</p>
                </div>
            </article>
            <article class="entrada-blog"> 
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp"/>
                        <source srcset="build/img/blog2.jpg" type="image/jepg"/>
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Imagen blog" height="100%" width="100%">
                    </picture>
                </div><!--.Imagen Entrada-->
                <div class="texto-entrada">
                    <a href="entrada.php"><h4>Guía para la decoración de tu hogar</h4></a>
                    
                    <p class="informacion-meta">Escrito el <span>20/03/2024</span> por <span>Admim</span></p>

                    <p>Maximiza el espacio en tu hogar con esta guía. Aprende a combinar muebles y colores para darle vida a tu espacio</p>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.

                </blockquote>
                <p>- Pedro de María</p>
            </div>
        </section>
     </div>

<?php 
    incluirTemplate('footer');
?>