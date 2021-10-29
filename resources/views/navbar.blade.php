<nav class="bg-white border-b border-gray-100">
    <div class="row g-0">
        <div class="navbar-brand m-0" style="width: 220px">
            <h1 class="ml-4 my-auto">icon</h1>
        </div>
        <div class="col d-flex justify-content-between">
            <button onclick="$('#sidebar').animate({width: 'toggle'},'medium');" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="d-flex g-0 mr-3">
                <!--<h1 class="">Otro espacio</h1>-->
                <div class=" m-2 mr-3 my-auto border rounded-full">
                    <button class=" flex text-sm p-1 border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        <span class="my-auto ml-2">{{ Auth::user()->name }}</span>
                        <svg class="my-auto ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul class="dropdown-menu shadow border" aria-labelledby="dropdownMenu2">
                        <li class="dropdown-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="text-decoration-none fw-bold fs-6 text-dark" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    Cerrar sesión
                                </a>
                            </form>
                        </li>
                        <li class="dropdown-item">Another action</li>
                        <li class="dropdown-item">Something else here</li>
                    </ul>
                </div>
                
            </div>
            
        </div>

    </div>
</nav>