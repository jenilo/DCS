<div class="modal fade" id="completeFormModal" tabindex="-1" aria-labelledby="completeFormLabel"   aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="completeFormLabel">Elegir formulario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="complete_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-0 row">
                        <label for="name" class="col-sm-4 col-form-label text-right fw-bold">Nombre</label>
                        <div class="col-sm-8">
                             <select class="col-md-4 form-control" id="form_id" name="form_id" required>
                                <option selected disabled>Elegir</option>
                                @foreach($forms as $form)
                                    <option value="{{$form->id}}">{{$form->name}}</option>
                                @endforeach
                             </select>
                             <input type="hidden" id="medical_record_id" value="{{$patient->medical_records->id}}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-warning text-white" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary bg-aquablue fw-bold">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#complete_form').on('submit', function(event){
        event.preventDefault();
        var form_id = $('#form_id option:selected').val();
        var url = "{{url('/')}}";
        var url = url+"/patient/"+{{$patient->medical_records->id}}+"/form/"+form_id+"/create";
        //console.log(url);
        window.location.href = url;
    });
</script>