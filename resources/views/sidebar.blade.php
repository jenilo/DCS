<div id="sidebar" class="p-2 sm-hidden bg-aquablue border-b border-gray-100" style="width: 220px; height: 90vh;">
    <ul class="m-0 p-0">
        {{--<li class="m-2 mb-3 border-bottom">
            <a href="{{route('home')}}" class="d-block my-2 text-start fw-bold fs-5 text-white text-decoration-none">
                <div class="row g-0">
                    <div class="col-2">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="col-10">
                        Inicio
                    </div>
                </div>
                 
            </a>
        </li>--}}
        <li class="m-2 mb-3 border-bottom">
            <a class="d-block my-2 text-start fw-bold fs-5 text-white text-decoration-none" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <div class="row g-0">
                    <div class="col-2">
                        <i class="far fa-calendar"></i>
                    </div>
                    <div class="col-10">
                        Citas <i class="fas fa-chevron-down float-end"></i>
                    </div>
                </div>
                 
            </a>
            <ul class="p-0 collapse show" id="collapseExample">
                <li class="m-2 {{ request()->routeIs('createappointment') ? 'bg-secondary bg-opacity-10' : '' }}">
                    <a href="{{route('createappointment')}}" class="d-block px-2 my-2 text-start fw-bold fs-6 text-white text-decoration-none">
                        <div class="row g-0">
                            <div class="col-2">
                                <i class="far fa-calendar-plus"></i>
                            </div>
                            <div class="col-10">
                                Agendar cita
                            </div>
                        </div>
                         
                    </a>
                </li>
                <li class="m-2 {{ request()->routeIs('appointments') ? 'bg-secondary bg-opacity-10' : '' }}">
                    <a href="{{route('appointments')}}" class="d-block px-2 my-2 text-start fw-bold fs-6 text-white text-decoration-none">
                        <div class="row g-0">
                            <div class="col-2">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <div class="col-10">
                                Calendario
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="m-2 mb-3 border-bottom">
            <a href="{{route('patients')}}" class="d-block my-2 text-start fw-bold fs-5 text-white text-decoration-none">
                <div class="row g-0">
                    <div class="col-2">
                        <i class="fas fa-user"></i></i>
                    </div>
                    <div class="col-10">
                        Pacientes
                    </div>
                </div>
                 
            </a>
        </li>
        <li class="m-2 mb-3 border-bottom">
            <a href="{{route('treatments')}}" class="d-block my-2 text-start fw-bold fs-5 text-white text-decoration-none">
                <div class="row g-0">
                    <div class="col-2">
                        <img class="d-inline-flex" src="{{asset('icons/taladro-de-dentistas2.png')}}" alt="" style="width:25px;height: 25px;">   
                    </div>
                    <div class="col-10">
                        Tratamientos
                    </div>
                </div>
                
            </a>
        </li>
        <li class="m-2 mb-3 border-bottom">
            <a href="{{route('forms')}}" class="d-block my-2 text-start fw-bold fs-5 text-white text-decoration-none">
                <div class="row g-0">
                    <div class="col-2">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="col-10">
                        Formularios
                    </div>
                </div>
            </a>
        </li>
        <li class="m-2 mb-3 border-bottom">
            <a href="{{route('users')}}" class="d-block my-2 text-start fw-bold fs-5 text-white text-decoration-none">
                <div class="row g-0">
                    <div class="col-2">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="col-10">
                        Usuarios
                    </div>
                </div>
            </a>
        </li>
    </ul>
</div>
