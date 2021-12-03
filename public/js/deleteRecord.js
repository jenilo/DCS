function deleteRecord(identifier,url,tr){

    Swal.fire({
        title: '¿Esta seguro?',
        text: "No se puede revertir esta acción.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            console.log("Eliminado falso");
            axios.delete(url+"/"+identifier,{
                id: identifier,
                _token:'{{ csrf_token() }}',
            }).then(function (response) {
                console.log(response.data);
                if(response.data.code == '200'){
                    Swal.fire(
                        'Eliminado!',
                        response.data.message,
                        'success'
                    );
                    $('#'+tr).remove();
                }
                else{
                    Swal.fire(
                        'Error!',
                        response.data.message,
                        'error'
                    );
                }

            })
            .catch(function (error) {
                console.log(error);
                swal("Error!",{icon: "error"});
            });
        }
    });
}  

function deleteRow(url,id,target){

    Swal.fire({
        title: '¿Esta seguro?',
        text: "Esta acción no se puede revertir.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            console.log("Eliminado falso");
            console.log(id);
            console.log(url);
            
            axios.delete(url+"/"+id).then(function (response) {
                console.log(response.data);
                if(response.data.code == '200'){
                    Swal.fire(
                        'Eliminado!',
                        response.data.message,
                        'success'
                    );
                    table.row( $(target).parents('tr') ).remove().draw();
                }
                else{
                    Swal.fire(
                        'Error!',
                        response.data.message,
                        'error'
                    );
                }

            })
            .catch(function (error) {
                console.log(error);
                Swal.fire("Error!",{icon: "error"});
            });
        }
    });
}