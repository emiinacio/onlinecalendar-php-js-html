$(document).ready(function() {
    $('.js-date--europe').mask('00-00-0000')
    // Validation
    $('#js-form').formValidation({
      framework: 'bootstrap',
      icon: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
        datebirth: {
          trigger: 'blur',
          validators: {
            notEmpty: {
              message: 'Preencha sua data de nascimento'
            },
            date: {
              format: 'DD/MM/YYYY',
              message: 'Sua data de nascimento não é valida'
            }
          }
        },
      }
    });
  });