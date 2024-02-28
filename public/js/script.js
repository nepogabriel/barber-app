document.addEventListener('DOMContentLoaded', function() {

var urlAtual = window.location.pathname;
var parteAposUltimaBarra = urlAtual.substring(urlAtual.lastIndexOf('/') + 1);

//function showCalendar() {
if (parteAposUltimaBarra == 'horarios' || parteAposUltimaBarra == 'public/horarios') {
    var element = document.querySelector('.calendar-hour');
    var myCalendar = jsCalendar.new(element); // Create the calendar

    // Add events
    myCalendar.onDateClick(function(event, date){
        dataOriginal = new Date(date.toString());

        // Obter ano, mês e dia
        var ano = dataOriginal.getFullYear();
        var mes = ("0" + (dataOriginal.getMonth() + 1)).slice(-2); // Adiciona zero à esquerda se for menor que 10
        var dia = ("0" + dataOriginal.getDate()).slice(-2); // Adiciona zero à esquerda se for menor que 10

        // Formatar a data no formato desejado: yyyy-mm-dd
        var dataFormatada = `${ano}-${mes}-${dia}`;

        listarHorarios(dataFormatada);
    });
}

function listarHorarios(date) {
    var data = {
        date: date
    };

    var url = getUrl() + '/horarios/buscar';

    sendRequest(data, url, function(error, response) {
        if (error) {
            console.error(error);
        } else {
            // Enquanto houver um primeiro filho, remova-o
            var listHours = document.getElementById('list_hours');
                
            while (listHours.firstChild) {
                listHours.removeChild(listHours.firstChild);
            }

            if (response.hours && response.hours.length === 0) {
                var li = document.createElement('li');
                li.className = 'list-group-item text-center list-group-item-secondary';
                li.textContent = 'Esta data não possui horários.';

                listHours.appendChild(li);
            } else {
                montarHorarios(response);
            }
        }
    });
}

function montarHorarios(response) {
    var listHours = document.getElementById('list_hours');
    var horas = response.hours;

    for (var i = 0; i < horas.length; i++) {
        var hour = horas[i];

        // Cria um elemento <li> com o conteúdo específico
        var li = document.createElement('li');
        li.className = 'list-group-item';

        var input = document.createElement('input');
        input.className = 'form-check-input me-1';
        input.type = 'radio';
        input.name = 'hour_id';
        input.value = hour.id;
        input.id = 'hour_' + hour.id;

        if (response.order_hour_id && response.order_hour_id == hour.id) {
            input.checked = true;
        }

        var label = document.createElement('label');
        label.className = 'form-check-label';
        label.htmlFor = 'hour_' + hour.id;
        label.textContent = hour.time;

        // Adiciona os elementos criados à li
        li.appendChild(input);
        li.appendChild(label);

        // Adiciona a li à lista
        listHours.appendChild(li);
    }
}

function sendRequest(data, url, callback) {
    var xhr = new XMLHttpRequest();
    var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

    // Configurar a função de retorno de chamada
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                callback(null, response);
            } else {
                callback('Erro na requisição. Status: ' + xhr.status, null);
            }
        }
    };

    // Converter dados para JSON e enviar a requisição
    xhr.send(JSON.stringify(data));
}

function getUrl() {
    var protocolo = window.location.protocol;

    // Obtém o nome do host (domínio)
    var host = window.location.host;

    // Combina o protocolo e o nome do host para obter a URL raiz
    var urlRaiz = protocolo + '//' + host;

    return urlRaiz;
}

});