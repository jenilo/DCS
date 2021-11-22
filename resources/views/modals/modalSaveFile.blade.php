<div class="modal fade" id="saveFileModal" tabindex="-1" aria-labelledby="addFormLabel"   aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="addFormLabel">Crear formulario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{--$errors--}}
            <form method="POST" action="{{route('createfile')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-4 col-form-label text-right fw-bold">Nombre</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                             @error('name')
                                <span class="invalid-feedback">{{$errors->first('name')}}</span>
                             @enderror
                        </div>
                    </div>
                    <div class="mb-0 row">
                        <label for="name" class="col-sm-4 col-form-label text-right fw-bold">Archivo</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" value="{{ old('file') }}" required>
                             @error('file')
                                <span class="invalid-feedback">{{$errors->first('file')}}</span>
                             @enderror
                        </div>
                    </div>
                    <input type="hidden" name="medical_record_id" value="{{$patient->medical_records->id}}">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-warning text-white" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary bg-aquablue fw-bold">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->any())
    <script>
        $(function() {
            $('#addFormModal').modal('show');
        });
    </script>
@endif