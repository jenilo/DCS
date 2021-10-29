<div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog" aria-labelledby="addPatientLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPatientLabel">Add new Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{url('patients')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-book"></i></span>
                                </div>
                                <input type="text" id="title" name="title" class="form-control" placeholder="Adventure III" aria-label="Title" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Autor</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-book-reader"></i></span>
                                        </div>
                                        <input type="text" id="autor" name="autor" class="form-control" placeholder="Robert James" aria-label="Autor" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="category_id">Options</label>
                                        </div>
                                        <select class="custom-select" name="category_id" id="category_id">
                                            @if(isset($categories))
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-paragraph"></i></span>
                                </div>
                                <textarea id="description" class="form-control" name="description" aria-label="With textarea" cols="5" ></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Year</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="number" id="year" name="year" class="form-control" placeholder="1970" aria-label="year" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Edition</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-list-ol"></i></span>
                                        </div>
                                        <input type="number" id="edition"  name="edition" class="form-control" placeholder="II" aria-label="Edition" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Editorial</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-university"></i></span>
                                        </div>
                                        <input type="text" id="editorial"  name="editorial" class="form-control" placeholder="Cometa" aria-label="Editorial" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ISBN</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" id="isbn" name="isbn"  class="form-control" placeholder="AB-125AC-55" aria-label="ISBN" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pages</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-book-open"></i></span>
                                        </div>
                                        <input type="number" id="pages"  name="pages" class="form-control" placeholder="600" aria-label="Pages" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cover</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01"><i class="fas fa-upload"></i></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="cover" aria-describedby="inputGroupFileAddon01" name="cover">
                                            <label class="custom-file-label" for="cover">Choose file</label>
                                        </div>
                                    </div>
                                </div>
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