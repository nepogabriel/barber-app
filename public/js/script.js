document.addEventListener('DOMContentLoaded', function() {

var urlAtual = window.location.pathname;
var parteAposUltimaBarra = urlAtual.substring(urlAtual.lastIndexOf('/') + 1);

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

    var url = getUrl() + '/public/horarios/buscar';
    
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
                listHours.classList.remove('row');

                var div = document.createElement('div');
                div.className = 'alert alert-secondary text-center';
                div.textContent = 'Esta data não possui horários.';

                listHours.appendChild(div);
            } else {
                listHours.classList.add('row');
                montarHorarios(response);
            }
        }
    });
}

function montarHorarios(response) {
    var listHours = document.getElementById('list_hours');
    const order_hour_id = response.order_hour_id;
    var horas = response.hours;
    var services = response.services;
    
    for (var j = 0; j < services.length; j++) {
        var div = document.createElement('div');

        if (services.length === 2) {
            div.className = 'col-sm-12 col-md-6';
        } else {
            div.className = 'col-sm-12 col-md-12';
        }

        div.textContent = 'Serviço: ' + services[j]['name'];
        listHours.appendChild(div);

        var ul = document.createElement('ul');
        ul.className = 'list-group';
        div.appendChild(ul);

        for (var i = 0; i < horas.length; i++) {
            var hour = horas[i];

            // Cria um elemento <li> com o conteúdo específico
            var li = document.createElement('li');
            li.className = 'list-group-item';

            var input = document.createElement('input');
            input.className = 'form-check-input me-1';
            input.type = 'radio';
            input.name = `hour_id[${services[j]['id']}]`;
            input.value = hour.id;
            input.id = `hour_${hour.id}_${services[j]['id']}`;

            if (order_hour_id && order_hour_id[services[j]['id']] === hour.id) {
                input.checked = true;
            }

            var label = document.createElement('label');
            label.className = 'form-check-label';
            label.htmlFor = `hour_${hour.id}_${services[j]['id']}`;
            label.textContent = hour.time;

            // Adiciona os elementos criados à li
            li.appendChild(input);
            li.appendChild(label);

            // Adiciona a li à lista
            ul.appendChild(li);
        }
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

var urlAtual = window.location.pathname;
var parteAposUltimaBarra = urlAtual.substring(urlAtual.lastIndexOf('/') + 1);

if ((parteAposUltimaBarra == 'cliente' || parteAposUltimaBarra == 'public/cliente')
    || (parteAposUltimaBarra == 'consultar' || parteAposUltimaBarra == 'public/consultar')
    || (parteAposUltimaBarra == 'buscar' || parteAposUltimaBarra == 'public/contulta/buscar')) {

    const phoneInput = document.getElementById('telephone_client');

    phoneInput.addEventListener('input', function(event) {
        let input = this.value;

        // Remove todos os caracteres que não sejam dígitos
        input = input.replace(/\D/g, '');

        // Limite a entrada a 11 caracteres numéricos
        if (input.length > 11) {
            input = input.slice(0, 11);
        }

        // Formate a entrada para o padrão desejado: (61) 99456-4567
        if (input.length > 2) {
            input = `(${input.substring(0, 2)}) ${input.substring(2, 7)}${input.substring(7)}`;
        }

        // Atualize o valor do campo de entrada com o formato aplicado
        this.value = input;
    });
}

function checkNavbarColor() {
    var navbar = document.querySelector('#navbar-home');
    
    if (navbar) {
        if (window.scrollY > 100) {
            navbar.classList.add('nav-color-home');
        } else {
            navbar.classList.remove('nav-color-home');
        }
    }
}

// Verificar o scroll quando a página é carregada
window.addEventListener("DOMContentLoaded", checkNavbarColor);
// Atualizar o background quando o scroll acontece
window.addEventListener("scroll", checkNavbarColor);