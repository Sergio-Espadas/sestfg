document.addEventListener('DOMContentLoaded', function () {
    // Validación global
    const forms = document.querySelectorAll('form');

    // Función para validar un formulario de aula
    const validateAulaForm = (form) => {
        const nombre = form.querySelector('input[name="aulaNombre"]');
        const capacidad = form.querySelector('input[name="aulaCapacidad"]');
        const nombreErrorMessage = document.getElementById('aulaNombreError');
        const capacidadErrorMessage = document.getElementById('aulaCapacidadError');

        const validateField = (field, condition, message, errorMessage) => {
            if (condition) {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
                errorMessage.innerHTML = '';
            } else {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
                errorMessage.innerHTML = `<strong>${message}</strong>`;
            }
        };

        nombre.addEventListener('input', () => {
            validateField(nombre, nombre.value.trim() !== '', 'Nombre es requerido', nombreErrorMessage);
        });

        capacidad.addEventListener('input', () => {
            validateField(capacidad, capacidad.value.trim() !== '' && !isNaN(capacidad.value) && parseInt(capacidad.value) >= 1, 'Capacidad debe ser un número mayor o igual que 1', capacidadErrorMessage);
        });

        form.addEventListener('submit', (event) => {
            validateField(nombre, nombre.value.trim() !== '', 'Nombre es requerido', nombreErrorMessage);
            validateField(capacidad, capacidad.value.trim() !== '' && !isNaN(capacidad.value) && parseInt(capacidad.value) >= 1, 'Capacidad debe ser un número mayor o igual que 1', capacidadErrorMessage);

            if (form.querySelectorAll('.is-invalid').length > 0) {
                event.preventDefault();
            }
        });
    };


    // Función para validar un formulario de trabajo
    const validateTrabajoForm = (form) => {
        const nombreInput = form.querySelector('input[name="nombre"]');
        const nombreError = document.getElementById('nombreError');

        const validateField = (field, condition, message, errorMessage) => {
            if (condition) {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
                errorMessage.innerText = '';
            } else {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
                errorMessage.innerHTML = `<strong>${message}</strong>`;
            }
        };

        nombreInput.addEventListener('input', () => {
            validateField(nombreInput, nombreInput.value.trim() !== '', 'El nombre es obligatorio', nombreError);
        });

        form.addEventListener('submit', (event) => {
            validateField(nombreInput, nombreInput.value.trim() !== '', 'El nombre es obligatorio', nombreError);

            if (form.querySelectorAll('.is-invalid').length > 0) {
                event.preventDefault();
            }
        });
    };




    // Función para validar un formulario de clase
    const validateClaseForm = (form) => {
        const today = new Date().toISOString().split('T')[0];
        const idAula = form.querySelector('select[name="id_aula"]');
        const idTrabajo = form.querySelector('select[name="id_trabajo"]');
        const fecha = form.querySelector('input[name="fecha"]');
        const hora = form.querySelector('input[name="hora"]');

        const validateField = (field, condition, message) => {
            const errorMessage = field.nextElementSibling;
            if (condition) {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
                errorMessage.innerHTML = '';
            } else {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
                errorMessage.innerHTML = `<strong>${message}</strong>`;
            }
        };

        idAula.addEventListener('change', () => {
            validateField(idAula, idAula.value !== '', 'Seleccione Aula');
        });

        idTrabajo.addEventListener('change', () => {
            validateField(idTrabajo, idTrabajo.value !== '', 'Seleccione Trabajo');
        });

        fecha.addEventListener('change', () => {
            const isFechaValid = fecha.value > today;
            validateField(fecha, isFechaValid, 'La fecha debe ser posterior al día actual.');

            // Si la fecha no es válida, también marcar la hora como inválida
            if (!isFechaValid) {
                validateField(hora, false, 'Corregir la fecha primero.');
            }
        });

        hora.addEventListener('change', () => {
            validateField(hora, hora.value !== '', 'Hora es requerida');
        });

        form.addEventListener('submit', (event) => {
            const isFechaValid = fecha.value > today;

            validateField(idAula, idAula.value !== '', 'Seleccione Aula');
            validateField(idTrabajo, idTrabajo.value !== '', 'Seleccione Trabajo');
            validateField(fecha, isFechaValid, 'La fecha debe ser posterior al día actual.');
            validateField(hora, hora.value !== '', 'Hora es requerida');

            // Si la fecha no es válida, marcar la hora como inválida
            if (!isFechaValid) {
                validateField(hora, false, 'Corregir la fecha primero.');
            }

            if (form.querySelectorAll('.is-invalid').length > 0) {
                event.preventDefault();
            }
        });
    };


    // Función para validar un formulario de tarifa
    const validateTarifaForm = (form) => {
        const nameInput = form.querySelector('input[name="name"]');
        const priceInput = form.querySelector('input[name="price"]');
        const numClasesInput = form.querySelector('input[name="num_clases"]');

        const validateField = (field, condition, message) => {
            const errorMessage = field.nextElementSibling;
            if (condition) {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
                errorMessage.innerHTML = '';
            } else {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
                errorMessage.innerHTML = `<strong>${message}</strong>`;
            }
        };

        nameInput.addEventListener('input', () => {
            validateField(nameInput, nameInput.value.trim() !== '', 'El nombre es requerido.');
        });

        priceInput.addEventListener('input', () => {
            const priceValue = priceInput.value.trim();
            validateField(priceInput, priceValue !== '' && !isNaN(priceValue) && parseFloat(priceValue) > 0, 'El precio debe ser un número válido y mayor que 0.');
        });

        numClasesInput.addEventListener('input', () => {
            const numClasesValue = numClasesInput.value.trim();
            validateField(numClasesInput, numClasesValue !== '' && !isNaN(numClasesValue) && parseInt(numClasesValue) > 0, 'El número de clases debe ser un número válido y mayor que 0.');
        });

        form.addEventListener('submit', (event) => {
            validateField(nameInput, nameInput.value.trim() !== '', 'El nombre es requerido.');

            const priceValue = priceInput.value.trim();
            validateField(priceInput, priceValue !== '' && !isNaN(priceValue) && parseFloat(priceValue) > 0, 'El precio debe ser un número válido y mayor que 0.');

            const numClasesValue = numClasesInput.value.trim();
            validateField(numClasesInput, numClasesValue !== '' && !isNaN(numClasesValue) && parseInt(numClasesValue) > 0, 'El número de clases debe ser un número válido y mayor que 0.');

            if (form.querySelectorAll('.is-invalid').length > 0) {
                event.preventDefault();
            }
        });
    };


    // Función para validar un formulario de rol
    const validateRoleForm = (form) => {
        const nameInput = form.querySelector('input[name="name"]');
        const nameError = document.getElementById('rolNameError'); // Asegúrate de que el ID coincida con el mensaje de error en tu plantilla

        const validateField = (field, condition, message, errorMessage) => {
            if (condition) {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
                errorMessage.innerHTML = '';
            } else {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
                errorMessage.innerHTML = `<strong>${message}</strong>`;
            }
        };

        nameInput.addEventListener('input', () => {
            validateField(nameInput, nameInput.value.trim() !== '', 'El nombre es requerido', nameError);
        });

        form.addEventListener('submit', (event) => {
            validateField(nameInput, nameInput.value.trim() !== '', 'El nombre es requerido', nameError);

            if (form.querySelectorAll('.is-invalid').length > 0) {
                event.preventDefault();
            }
        });
    };


    // Función para validar un formulario de user
    const validateUserForm = (form) => {
        const nameInput = form.querySelector('input[name="name"]');
        const apellido1Input = form.querySelector('input[name="apellido_1"]');
        const apellido2Input = form.querySelector('input[name="apellido_2"]');
        const emailInput = form.querySelector('input[name="email"]');
        const dniInput = form.querySelector('input[name="dni"]');

        const validateField = (field, condition, message) => {
            const errorMessage = field.nextElementSibling;
            if (condition) {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
                errorMessage.innerHTML = '';
            } else {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
                errorMessage.innerHTML = `<strong>${message}</strong>`;
            }
        };

        nameInput.addEventListener('input', () => {
            validateField(nameInput, nameInput.value.trim() !== '' && nameInput.value.length <= 50, 'El nombre es requerido y no debe exceder 50 caracteres.');
        });

        apellido1Input.addEventListener('input', () => {
            validateField(apellido1Input, apellido1Input.value.trim() !== '' && apellido1Input.value.length <= 40, 'El primer apellido es requerido y no debe exceder 40 caracteres.');
        });

        apellido2Input.addEventListener('input', () => {
            validateField(apellido2Input, apellido2Input.value.trim() !== '' && apellido2Input.value.length <= 40, 'El segundo apellido no debe exceder 40 caracteres.');
        });

        emailInput.addEventListener('input', () => {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|es)$/i;
            validateField(emailInput, emailInput.value.trim() !== '' && emailInput.value.length <= 255 && emailRegex.test(emailInput.value), 'El correo electrónico es requerido, debe tener un formato válido (ej: user@gmail.com)');
        });

        dniInput.addEventListener('input', () => {
            const dniRegex = /^(?:(?:[XYZ]\d{7})|(?:\d{8}))[A-Z]$/;
            validateField(dniInput, dniInput.value.trim() !== '' && dniRegex.test(dniInput.value), 'El DNI es requerido y debe tener un formato válido. (ej: 12345678A, X1234567L)');
        });

        form.addEventListener('submit', (event) => {
            validateField(nameInput, nameInput.value.trim() !== '' && nameInput.value.length <= 50, 'El nombre es requerido y no debe exceder 50 caracteres.');
            validateField(apellido1Input, apellido1Input.value.trim() !== '' && apellido1Input.value.length <= 40, 'El primer apellido es requerido y no debe exceder 40 caracteres.');
            validateField(apellido2Input, apellido2Input.value.trim() !== '' && apellido2Input.value.length <= 40, 'El segundo apellido no debe exceder 40 caracteres.');
            validateField(emailInput, emailInput.value.trim() !== '' && emailInput.value.length <= 255 && /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|es)$/i.test(emailInput.value), 'El correo electrónico es requerido, debe tener un formato válido (ej: user@gmail.com)');
            validateField(dniInput, dniInput.value.trim() !== '' && /^(?:(?:[XYZ]\d{7})|(?:\d{8}))[A-Z]$/.test(dniInput.value), 'El DNI es requerido y debe tener un formato válido. (ej: 12345678A, X1234567L)');

            if (form.querySelectorAll('.is-invalid').length > 0) {
                event.preventDefault();
            }
        });
    };

    // Función para validar un formulario de registro de usuario
    const validateUserRegisterForm = (form) => {
        const nameInput = form.querySelector('input[name="name"]');
        const apellido1Input = form.querySelector('input[name="apellido_1"]');
        const apellido2Input = form.querySelector('input[name="apellido_2"]');
        const emailInput = form.querySelector('input[name="email"]');
        const dniInput = form.querySelector('input[name="dni"]');
        const passwordInput = form.querySelector('input[name="password"]');
        const confirmPasswordInput = form.querySelector('input[name="password_confirmation"]');

        const showError = (input, message) => {
            const errorDiv = input.nextElementSibling;
            errorDiv.innerHTML = `<strong>${message}</strong>`;
            input.classList.add('is-invalid');
        };

        const hideError = (input) => {
            const errorDiv = input.nextElementSibling;
            errorDiv.innerText = '';
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        };


        // Función para validar la fortaleza de la contraseña
        const validatePasswordStrength = (password) => {
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/;
            return regex.test(password);
        };

        const validateField = (input, condition, message) => {
            if (condition) {
                hideError(input);
            } else {
                showError(input, message);
            }
        };


        nameInput.addEventListener('input', () => {
            validateField(nameInput, nameInput.value.trim() !== '' && nameInput.value.length <= 50, 'El nombre es requerido y no debe exceder 50 caracteres.');
        });

        apellido1Input.addEventListener('input', () => {
            validateField(apellido1Input, apellido1Input.value.trim() !== '' && apellido1Input.value.length <= 40, 'El primer apellido es requerido y no debe exceder 40 caracteres.');
        });

        apellido2Input.addEventListener('input', () => {
            validateField(apellido2Input, apellido2Input.value.trim() !== '' && apellido2Input.value.length <= 40, 'El segundo apellido no debe exceder 40 caracteres.');
        });

        emailInput.addEventListener('input', () => {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|es)$/i;
            validateField(emailInput, emailInput.value.trim() !== '' && emailInput.value.length <= 255 && emailRegex.test(emailInput.value), 'El correo electrónico es requerido, debe tener un formato válido (ej: user@gmail.com)');
        });

        dniInput.addEventListener('input', () => {
            const dniRegex = /^(?:(?:[XYZ]\d{7})|(?:\d{8}))[A-Z]$/;
            validateField(dniInput, dniInput.value.trim() !== '' && dniRegex.test(dniInput.value), 'El DNI es requerido y debe tener un formato válido. (ej: 12345678A, X1234567L)');
        });

        form.addEventListener('submit', (event) => {
            validateField(nameInput, nameInput.value.trim() !== '' && nameInput.value.length <= 50, 'El nombre es requerido y no debe exceder 50 caracteres.');
            validateField(apellido1Input, apellido1Input.value.trim() !== '' && apellido1Input.value.length <= 40, 'El primer apellido es requerido y no debe exceder 40 caracteres.');
            validateField(apellido2Input, apellido2Input.value.trim() !== '' && apellido2Input.value.length <= 40, 'El segundo apellido no debe exceder 40 caracteres.');
            validateField(emailInput, emailInput.value.trim() !== '' && emailInput.value.length <= 255 && /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|es)$/i.test(emailInput.value), 'El correo electrónico es requerido, debe tener un formato válido (ej: user@gmail.com)');
            validateField(dniInput, dniInput.value.trim() !== '' && /^(?:(?:[XYZ]\d{7})|(?:\d{8}))[A-Z]$/.test(dniInput.value), 'El DNI es requerido y debe tener un formato válido. (ej: 12345678A, X1234567L)');

            if (!validatePasswordStrength(passwordInput.value)) {
                showError(passwordInput, 'La contraseña debe contener 8-16 caracteres, mayúscula, minúscula, número y carácter especial');
                event.preventDefault();
            } else if (passwordInput.value !== confirmPasswordInput.value) {
                showError(confirmPasswordInput, 'Las contraseñas no coinciden.');
                event.preventDefault();
            }
        });
    };


    const validateLoginForm = (form) => {
        const emailInput = form.querySelector('input[name="email"]');
        const passwordInput = form.querySelector('input[name="password"]');

        const showError = (input, message) => {
            const errorDiv = input.nextElementSibling;
            errorDiv.innerHTML = `<strong>${message}</strong>`;
            input.classList.add('is-invalid');
        };

        const hideError = (input) => {
            const errorDiv = input.nextElementSibling;
            errorDiv.innerText = '';
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        };

        const validateField = (input, condition, message) => {
            if (condition) {
                hideError(input);
            } else {
                showError(input, message);
            }
        };

        form.addEventListener('submit', (event) => {
            // Validar campos
            validateField(emailInput, emailInput.value.trim() !== '', 'El correo electrónico es requerido.');
            validateField(passwordInput, passwordInput.value.trim() !== '', 'La contraseña es requerida.');

            // Si hay campos inválidos, prevenir el envío del formulario
            if (form.querySelectorAll('.is-invalid').length > 0) {
                event.preventDefault();
            }
        });
    };


    // Validación de formularios individuales
    forms.forEach(form => {
        if (form.id === 'crear-aula-form' || form.id === 'editar-aula-form') {
            validateAulaForm(form);
        } else if (form.id === 'crear-trabajo-form' || form.id === 'editar-trabajo-form') {
            validateTrabajoForm(form);
        } else if (form.id === 'crear-clase-form' || form.id === 'actualizar-clase-form') {
            validateClaseForm(form);
        } else if (form.id === 'crear-tarifa-form' || form.id === 'editar-tarifa-form') {
            validateTarifaForm(form);
        } else if (form.id === 'crear-rol-form' || form.id === 'editar-rol-form') {
            validateRoleForm(form);
        } else if (form.id === 'editar-user-form') {
            validateUserForm(form);
        } else if (form.id === 'register-user-form') {
            validateUserRegisterForm(form);
        } else if (form.id === 'loginAuthForm') {
            validateLoginForm(form);
        }

    });

});