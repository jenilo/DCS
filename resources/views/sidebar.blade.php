<div id="sidebar" class="p-2 vh-100 sm-hidden bg-white border-b border-gray-100" style="width: 220px">
    <ul class="m-0 p-0">
        <li class="m-2">
            <a class="d-block my-2 text-start fw-bold fs-6 text-dark text-decoration-none" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="far fa-calendar"></i> Citas <i class="fas fa-chevron-down float-end"></i>
            </a>
            <ul class="p-0 collapse show" id="collapseExample">
                <li class="m-2 {{ request()->routeIs('createappointment') ? 'bg-secondary bg-opacity-10' : '' }}">
                    <a href="{{route('createappointment')}}" class="d-block px-2 my-2 text-start fw-bold fs-6 text-dark text-decoration-none">
                        <i class="far fa-calendar-plus"></i> Agendar cita
                    </a>
                </li>
                <li class="m-2 {{ request()->routeIs('appointments') ? 'bg-secondary bg-opacity-10' : '' }}">
                    <a href="{{route('appointments')}}" class="d-block px-2 my-2 text-start fw-bold fs-6 text-dark text-decoration-none">
                        <i class="far fa-calendar-alt"></i> Calendario
                    </a>
                </li>
            </ul>
        </li>
        <li class="m-2">
            <a href="{{route('patients')}}" class="d-block my-2 text-start fw-bold fs-6 text-dark text-decoration-none">
                <i class="fas fa-user"></i></i> Pacientes
            </a>
        </li>
        <li class="m-2">
            <a href="{{route('treatments')}}" class="d-block my-2 text-start fw-bold fs-6 text-dark text-decoration-none">
                <i class="fas fa-user"></i></i> Tratamientos
            </a>
        </li>
        <li class="m-2">
            <a href="{{route('forms')}}" class="d-block my-2 text-start fw-bold fs-6 text-dark text-decoration-none">
                <i class="fas fa-user"></i></i> Formularios
            </a>
        </li>
    </ul>
</div>
