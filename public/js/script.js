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

function getHoursByDay(dados, method) {
    var url = getUrl() + '/horarios/buscar'
    // Configuração da requisição
    var configuracao = {
        method: method, // Método HTTP
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dados) // Converte os dados para JSON e os envia no corpo da requisição
    };

    // Realiza a requisição POST usando a API Fetch
    fetch(getUrl(), configuracao)
    .then(response => {
        // Verifica se a resposta é bem-sucedida (código de status 2xx)
        if (!response.ok) {
        throw new Error('Erro na requisição');
        }
        // Pode processar a resposta aqui se necessário
        return response.json();
    })
    .then(data => {
        console.log('Resposta:', data);
    })
    .catch(error => {
        console.error('Erro:', error);
    });

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