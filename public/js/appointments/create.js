let $doctor, $date, $specialty, $hours;
let iRadio;
const noHoursAlert = `
    <div class="alert alert-danger" role="alert">
        <strong>Lo sentimos!</strong>
        No se encontraron horas disponibles para el medico, en el dia seleccionado
    </div>
`;


$(function () {
    $specialty =  $("#specialty");
    $date =  $("#date");
    $doctor = $("#doctor");
    $hours = $("#hours");

    $specialty.change(()=>{
        let specialtyID = $specialty.val();
        let url = `/api/specialties/${specialtyID}/doctors`;
        $.getJSON(url, onDoctorsLoaded);
    });

    $doctor.change(loadHours);
    $date.change(loadHours);
});


const onDoctorsLoaded = function (doctors){
    let htmlOption = '';
    doctors.forEach(doctor => {
        htmlOption += `<option value="${doctor.id}">${doctor.name}</option>`;
    });
    $doctor.html(htmlOption);
    loadHours();
};


const loadHours = function(){
    const selectDate = $date.val();
    const doctor_id = $doctor.val();
    let url = `/api/schedule/hours?date=${selectDate}&doctor_id=${doctor_id}`;
    $.getJSON(url, displayHours);
};


const displayHours = function (data){
    if (!data.morning && !data.afternoon){
        $hours.html(noHoursAlert);
        return;
    }

    let htmlHours = '';
    iRadio = 0;

    // console.log(data);
    if(data.morning){
        const morning_intervals = data.morning;
        morning_intervals.forEach(interval => {
            // console.log(`${interval.start} - ${interval.end}`);
            htmlHours += getRadioIntervalHtml(interval);
        });
    }

    if(data.afternoon){
        const afternoon_intervals = data.afternoon;
        afternoon_intervals.forEach(interval => {
            // console.log(`${interval.start} - ${interval.end}`);
            htmlHours += getRadioIntervalHtml(interval);
        });
    }

    $hours.html(htmlHours);
};


const getRadioIntervalHtml = function(interval){
    const text = `${interval.start} - ${interval.end}`;
    return `
        <div class="custom-control custom-radio mb-3">
          <input name="scheduled_time" value="${interval.start}" class="custom-control-input" id="interval${iRadio}" type="radio" required>
          <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
        </div>
    `;
};
