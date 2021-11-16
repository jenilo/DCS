<div class="modal fade" id="showAppointmentModal" tabindex="-1" aria-labelledby="showAppointmentLabel"   aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showAppointmentLabel">Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="row g-0 mb-2">
                    <div class="d-flex">
                        <h1 class="mr-2 mb-0"><i class="far fa-user-circle" style="font-size: 80px;"></i></h1>
                        <div class="px-2 ml-2 flex-grow-1">
                            <h4 class="fw-bold mb-0 text-capitalize"><span id="name_patient">Nombre del paciente</span></h4>
                            <h6 class="text-muted mb-1"><span id="dateBirth">0000-00-00</span> &middot; <span id="age">00 años</span></h6>
                            <h6><span class="border px-2 rounded-pill mr-2"> <i class="fas fa-phone-alt"></i> <span class="text-muted" id="phone">0000000000</span> </span> <span class="border px-2 rounded-pill"> <i class="fas fa-briefcase"></i> <span class="text-muted" id="employment">ocupación</span> </span></h6>
                        </div>
                    </div>
                    
                </div>
                <div class="">
                    <h6 class="fw-bold">Fecha de la cita: <span class="fw-normal" id="dateAppointment">0000-00-00</span></h6>
                    <h6 class="fw-bold">Hora: <span class="fw-normal" id="timeAppointment">00:00 am</span> &middot; <span class="fw-normal text-muted" id="relativeTime">en 1 hora</span></h6>
                    <h6 class="fw-bold">Tratamiento: <span class="fw-normal" id="treatment"> tratamiento</span></h6>
                    <h6 class="fw-bold">Notas:</h6>
                    <p id="notes">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi tempora temporibus amet maiores dolores placeat dolor, fugiat ut quo asperiores vitae aliquam ea, corporis rem, blanditiis sint. Illo, aliquid, fugit.</p>
                    <div class="">
                        <button id="addMedicalRecord" class="btn btn-success"><i class="fas fa-folder-plus"></i> Añadir registro médico</button>
                        <button id="showMedicalRecord" class="btn btn-primary"><i class="far fa-folder-open"></i> Ver expediente</button>
                    </div>
                    
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>