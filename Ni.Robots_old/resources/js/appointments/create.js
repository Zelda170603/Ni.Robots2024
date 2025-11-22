document.addEventListener('DOMContentLoaded', function () {
    const specialtySelect = document.getElementById('specialty');
    const doctorSelect = document.getElementById('doctor');
    const date = document.getElementById('date');

    const titleMorning = document.getElementById('titleMorning');
    const hoursMorning = document.getElementById('hoursMorning');
    const titleAfternoon = document.getElementById('titleAfternoon');
    const hoursAfternoon = document.getElementById('hoursAfternoon');

    const titleMorningText = 'En la mañana';
    const titleAfternoonText = 'En la tarde';
    const noHoursMessage = '<h5 class="text-red-400">No hay horas disponibles.</h5>';

    let doctorid = ''; // Asegúrate de inicializar doctorid

    // Function to load doctors based on the selected specialty
    function loadDoctors(especialidad) {
        fetch(`/getDoctores/${especialidad}`)
            .then(response => response.json())
            .then(data => {
                doctorSelect.innerHTML = '<option value="">Seleccionar medico</option>';
                data.forEach(doctor => {
                    const option = document.createElement('option');
                    doctorid = option.value = doctor.id_doc;
                    option.textContent = doctor.name;
                    doctorSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al obtener medicos:', error);
                doctorSelect.innerHTML = '<option value="">Seleccionar medico</option>';
            });
    }

    // Add event listener for specialty selection change
    specialtySelect.addEventListener('change', function () {
        const specialtyId = this.value;
        if (specialtyId) {
            loadDoctors(specialtyId);
        } else {
            doctorSelect.innerHTML = '<option value="">Seleccionar medico</option>';
        }
    });

    date.addEventListener('change', function () {
        const selectedDate = this.value;
        const url = `/horario/horas?date=${selectedDate}&doctor_id=${doctorid}`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                displayHours(data);
                console.log('Datos recibidos:', data); // Muestra los datos en la consola
            })
            .catch(error => {
                console.error('Hubo un problema con la operación fetch:', error);
            });
    });

    doctorSelect.addEventListener('change', function () {
        const selectedDate = date.value; // Obtén la fecha seleccionada del campo de fecha
        const doctorId = this.value;
        const url = `/horario/horas?date=${selectedDate}&doctor_id=${doctorId}`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                displayHours(data);
                console.log('Datos recibidos:', data); // Muestra los datos en la consola
            })
            .catch(error => {
                console.error('Hubo un problema con la operación fetch:', error);
            });
    });

    function displayHours(data) {
        let htmlHoursM = '';
        let htmlHoursA = '';

        // Asegúrate de que el índice se reinicie a 0 para cada llamada de `displayHours`
        let iRadio = 0;

        if (data.morning && data.morning.length > 0) {
            data.morning.forEach(intervalo => {
                htmlHoursM += getRadioIntervaloHTML(intervalo, iRadio++);
            });
        } else {
            htmlHoursM = noHoursMessage; // Mostrar mensaje si no hay horas disponibles
        }

        if (data.afternoon && data.afternoon.length > 0) {
            data.afternoon.forEach(intervalo => {
                htmlHoursA += getRadioIntervaloHTML(intervalo, iRadio++);
            });
        } else {
            htmlHoursA = noHoursMessage; // Mostrar mensaje si no hay horas disponibles
        }

        // Actualiza el contenido del DOM
        hoursMorning.innerHTML = htmlHoursM;
        hoursAfternoon.innerHTML = htmlHoursA;

        titleMorning.innerHTML = titleMorningText;
        titleAfternoon.innerHTML = titleAfternoonText;
    }

    function getRadioIntervaloHTML(intervalo, index) {
        const text = `${intervalo.start} - ${intervalo.end}`;
        return `
    <div class="flex items-center mb-4">
        <input type="radio" id="interval${index}" name="scheduled_time" value="${intervalo.start}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required>
        <label class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="interval${index}">${text}</label>
    </div>
`;
    }
});