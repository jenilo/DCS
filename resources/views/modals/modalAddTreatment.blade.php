<div class="modal fade" id="addTreatmentModal" tabindex="-1" aria-labelledby="addTreatmentLabel"   aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTreatmentLabel">Añadir tratamiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{url('treatments')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-4 col-form-label text-right">Nombre</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                             @error('name')
                                <span class="invalid-feedback">{{$errors->first('name')}}</span>
                             @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->any())
    <script>
        $(function() {
            $('#addTreatmentModal').modal('show');
        });
    </script>
@endif