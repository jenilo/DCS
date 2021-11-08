<div class="modal fade" id="addSearchPatientModal" tabindex="-1" aria-labelledby="addSearchPatientLabel"   aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSearchPatientLabel">Buscar paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
                <div class="modal-body p-0">
                    <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-0 p-2 bg-light">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" id="searchName" name="searchName" placeholder="Ingrese el nombre..." aria-label="Nombre" aria-describedby="basic-addon1">
                        </div>
                        <input type="hidden" name="id" value="">
                    </div>
                    <hr class="m-0">
                    </form>
                    <div>
                        
                        <table class="table mb-0" id="patientsTable" >
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Edad</th>
                                    <th scope="col">Telefono</th>
                                </tr>
                            </thead>
                            <tbody id="patientsTBody">
                            </tbody>
                        </table> 
                    </div>   
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="" data-bs-dismiss="modal" class="btn btn-primary">Seleccionar</button>
                </div>
            
        </div>
    </div>
</div>


<script type="text/javascript">

    $("#searchName").on('input',function(e) {
        var value = $(e.target).val();

        getPatients(value);
        
    });

    function getPatients(value){
        var url = "{{url('patients')}}";

        if (/*value != "" && */value != " " ) {
           axios.get(url+"/search/"+value,{
                _token:'{{ csrf_token() }}',
            }).then(function (response) {
                console.log(response.data);
                addRows(response.data);
            })
            .catch(function (error) {
                console.log(error);
                swal("Error!",{icon: "error"});
            }); 
        }
    }

    function addRows(patients){
        console.log(patients);
        $('#patientsTBody').empty();
        $('#patientsTBody tr').removeClass('bg-light');

        patients.forEach(patient => {
            $('#patientsTable').append(`<tr class="clickableRow" onclick="setRow(this,`+patient['id']+`,'`+patient['name']+`')">
                <td>`+patient['id']+`</td>
                <td>`+patient['name']+`</td>
                <td>`+moment().diff(patient['dateBirth'],'years')+`</td>
                <td>`+patient['phone']+`</td>
            </tr>`);
        });
    }

    function setRow(target,id,name){
        $(target).addClass('bg-light').siblings().removeClass('bg-light');
        $('input[name=id]').val(id);
        $('input[name=name]').val(name);
        $('input[name=patient_id]').val(id);
    }

</script>
