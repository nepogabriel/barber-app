document.addEventListener('DOMContentLoaded', function() {

let table = document.querySelector('.calendar-hour table');

if (table) {
    //table.setAttribute('id', 'calendar_hour');

    table.addEventListener('click', function(event) {
        // Verificar se o clique ocorreu em uma célula de dia
        if (event.target.tagName === 'TD') {
            // Capturar o valor do dia clicado
            var valorDoDia = event.target.innerText;
            var mes = document.querySelector('.jsCalendar-title-name input').value;

            // Exibir o valor do dia (você pode ajustar isso conforme necessário)
            alert(`Dia clicado: ${valorDoDia} Mês: ${mes}`);
        }
    });
} else {
    console.log('Elemento não encontrado.');
}

});