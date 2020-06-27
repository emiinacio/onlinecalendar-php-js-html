const { default: swal } = require("sweetalert");

$(function() {
    
    $("#form-perfil").submit(function(e) {
        e.preventDefault();
    }).validate({
        rules: {
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            phone: {
                required: true,
                number: true
            },
            datebirth: {
                required: true,
                number: true
            },
            address: {
                required: true
            },
            password: {
                required: true
            },
            confirmpass: {
                required: true,
                equalTo: "#password"
            },
        submitHandler: function(form) {
            swal.fire({
                position:'center',
                type: 'success',
                title: 'Registro realizado com sucesso',
                showConfirmButton: false,
                timer: 1500
            })
        }
    });
})