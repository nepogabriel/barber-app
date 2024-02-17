document.addEventListener('DOMContentLoaded', function() {

// Get the element
var element = document.querySelector('.calendar-hour');
// Create the calendar
var myCalendar = jsCalendar.new(element);
// Get the inputs
var inputA = document.getElementById("my-input-a");
var inputB = document.getElementById("my-input-b");
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
    console.log('DATA: ', dataFormatada);
});

/*
let table = document.querySelector('.calendar-hour table');

if (table) {
    //table.setAttribute('id', 'calendar_hour');

    table.addEventListener('click', function(event) {
        // Verificar se o clique ocorreu em uma célula de dia
        if (event.target.tagName === 'TD') {
            // Capturar o valor do dia clicado
            var dia = event.target.innerText;
            var mes = document.getElementsByClassName('jsCalendar-title-name')[0].innerText;

            // Exibir o valor do dia (você pode ajustar isso conforme necessário)
            alert(`Dia clicado: ${dia} Mês: ${mes}`);

            // var dados = {
            //     dia: event.target.innerText,
            //     mes: document.getElementsByClassName('jsCalendar-title-name')[0].innerText
            // };

            // getHoursByDay(dados, 'POST');
        }
    });
} else {
    console.log('Elemento não encontrado.');
}
*/

function listarHorarios(date) {
    var data = {
        date: date
    };

    var url = getUrl() + '/horarios/buscar';

    sendRequest(data, url, function(error, response) {
        if (error) {
            console.error(error);
        } else {
            console.log('Resposta:', response);
        }
    });
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
                // A requisição foi bem-sucedida
                var response = JSON.parse(xhr.responseText);
                callback(null, response);
            } else {
                // A requisição falhou
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