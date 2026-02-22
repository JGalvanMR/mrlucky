@php
$config = new Larapack\ConfigWriter\Repository('rentas');
@endphp
<style>
{{-- Sidebar --}}
.sidebar-nav ul li a{ color: {{ $config->get('colorEnlaces') }}; }
.sidebar-nav > ul > li.active > a{ color: {{ $config->get('colorEnlaces') }}; }
.sidebar-nav > ul > li > a i{ color: {{ $config->get('colorEnlaces') }}; }
.sidebar-nav > ul > li.active > a i{ color: {{ $config->get('colorEnlaces') }}; }
</style>
<aside class="left-sidebar" style="background-color: {{ $config->get('colorPrincipal') }};">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav" style="background-color: {{ $config->get('colorPrincipal') }};">
            <ul id="sidebarnav">

                {{-- <li class="nav-small-cap">Menú</li> --}}

                <li class="user-profile">
                    <a class="waves-effect waves-dark" href="{{ route('es.inicio') }}" aria-expanded="false" target="_blank">
                        <i class="fa fa-home"></i> <span class="hide-menu">Web </span>
                    </a>
                </li>

                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-picture-o"></i> <span class="hide-menu">Slides</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('slides.agregar_form') }}">Agregar</a></li>
                        <li><a href="{{ route('slides') }}">Listado</a></li>
                        <li><a href="{{ route('slides.ordenar_form') }}">Ordenar</a></li>
                    </ul>
                </li>

                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-tags"></i> <span class="hide-menu">Categorías</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('categorias_productos.agregar_form') }}">Agregar</a></li>
                        <li><a href="{{ route('categorias_productos') }}">Listado</a></li>
                        <li><a href="{{ route('categorias_productos.ordenar_form') }}">Ordenar</a></li>
                    </ul>
                </li>

                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-envira"></i> <span class="hide-menu">Productos</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('productos.agregar_form') }}">Agregar</a></li>
                        <li><a href="{{ route('productos') }}">Listado</a></li>
                        <li><a href="{{ route('productos.ordenar_form') }}">Ordenar</a></li>
                    </ul>
                </li>

                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-book"></i> <span class="hide-menu">Blogs</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('posts.agregar_form') }}">Agregar</a></li>
                        <li><a href="{{ route('posts') }}">Listado</a></li>
                    </ul>
                </li>

                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-tags"></i> <span class="hide-menu">Categorías Recetas</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('categorias_recetas.agregar_form') }}">Agregar</a></li>
                        <li><a href="{{ route('categorias_recetas') }}">Listado</a></li>
                        <li><a href="{{ route('categorias_recetas.ordenar_form') }}">Ordenar</a></li>
                    </ul>
                </li>

                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-cutlery"></i> <span class="hide-menu">Ingredientes</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('ingredientes.agregar_form') }}">Agregar</a></li>
                        <li><a href="{{ route('ingredientes') }}">Listado</a></li>
                    </ul>
                </li>

                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-file-text-o"></i> <span class="hide-menu">Recetas</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('recetas.agregar_form') }}">Agregar</a></li>
                        <li><a href="{{ route('recetas') }}">Listado</a></li>
                    </ul>
                </li>

                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-briefcase"></i> <span class="hide-menu">Vacantes</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('vacantes.agregar') }}">Agregar</a></li>
                        <li><a href="{{ route('vacantes') }}">Listado</a></li>
                    </ul>
                </li>

                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-certificate"></i>
                        <span class="hide-menu">Ranchos & Cert.</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('ranchos.agregar_form') }}">Agregar</a></li>
                        <li><a href="{{ route('ranchos') }}">Listado</a></li>
                    </ul>
                </li>


                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-list-ol"></i> <span class="hide-menu">Preguntas</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('preguntas.agregar_form') }}">Agregar</a></li>
                        <li><a href="{{ route('preguntas') }}">Listado</a></li>
                        <li><a href="{{ route('preguntas.ordenar') }}">Ordenar</a></li>
                    </ul>
                </li>

                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-language"></i> <span class="hide-menu">Traducciones</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('traducciones.agregar_form') }}">Agregar</a></li>
                        <li><a href="{{ route('traducciones') }}">Listado</a></li>
                    </ul>
                </li>

                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-globe"></i> <span class="hide-menu">Idiomas</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('idiomas.agregar_form') }}">Agregar</a></li>
                        <li><a href="{{ route('idiomas') }}">Listado</a></li>
                        <li><a href="{{ route('idiomas.ordenar') }}">Ordenar</a></li>
                    </ul>
                </li>

                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-user"></i> <span class="hide-menu">Usuarios</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('usuarios.agregar_form') }}">Agregar</a></li>
                        <li><a href="{{ route('usuarios') }}">Listado</a></li>
                    </ul>
                </li>

                <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-cog"></i> <span class="hide-menu">Configuraciones</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('configuraciones.editar_form') }}">General</a></li>
                        <li><a href="{{ route('paginas') }}">Páginas</a></li>
                        <li><a href="#.">WhatsApp</a></li>
                        <li><a href="#.">Formularios</a></li>
                        <li><a href="#.">Optimizar</a></li>
                        <li><a href="{{ route('clear_cache') }}">Eliminar cache</a></li>
                    </ul>
                </li>

                {{-- <li class="user-profile">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="fa fa-th"></i> <span class="hide-menu">Components</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('components_date') }}">Date</a></li>
                <li><a href="{{ route('components_summernote') }}">Summernote</a></li>
                <li><a href="{{ route('components_toggle') }}">Bootstrap Toggle</a></li>
                <li><a href="{{ route('components_datatables') }}">Data Tables</a></li>
                <li><a href="{{ route('components_eliminar') }}">Btn Eliminar</a></li>
                <li><a href="{{ route('components_select2') }}">Select2</a></li>
                <li><a href="{{ route('components_money') }}">MaskMoney</a></li>
                <li><a href="{{ route('components_colorpicker') }}">ColorPicker</a></li>
                <li><a href="{{ route('components_tagsinput') }}">TagsInput</a></li>
                <li><a href="{{ route('components_fileinput') }}">FileInput</a></li>
                <li><a href="{{ route('components_slugify') }}">Slugify</a></li>
                <li><a href="{{ route('components_maxlength') }}">Maxlength</a></li>
                <li><a href="{{ route('components_fontpicker') }}">FontPicker</a></li>
                <li><a href="{{ route('components_iconpicker') }}">IconPicker</a></li>
            </ul>
            </li> --}}


            <li class="user-profile">
                <a class="waves-effect waves-dark" href="{{ url('salir') }}" aria-expanded="false">
                    <i class="fa fa-power-off"></i> <span class="hide-menu">Salir </span>
                </a>
            </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
