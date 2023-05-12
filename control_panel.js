$(document).ready(function() {
    // wywołaj funkcję pobierającą dane z bazy danych
    getData();

    function getData() {
        // wywołaj plik db_pass_query.php za pomocą metody $.get()
        $.get("db_pass_query.php", function(data) {
            // utwórz tablicę obiektów z pobranych danych JSON
            console.log(JSON.parse(data));
            var parse_data = JSON.parse(data);
            var data_common = parse_data.json1;
            var data_private = parse_data.json2;

            // utwórz wiersze tabeli na podstawie pobranych danych
            $.each(data_common, function(index, row) {
                var tr = $('<tr></tr>');
                $('<td></td>').text(row.place).appendTo(tr);
                $('<td></td>').text(row.login).appendTo(tr);
                $('<td></td>').text(row.password).appendTo(tr);
                tr.appendTo(".table-pass:eq(0)");
            });

            if(data_private.length > 0){
                // utwórz wiersze tabeli na podstawie pobranych danych
                $.each(data_private, function(index, row) {
                var tr = $('<tr></tr>');
                $('<td></td>').text(row.place).appendTo(tr);
                $('<td></td>').text(row.login).appendTo(tr);
                $('<td></td>').text(row.password).appendTo(tr);
                tr.appendTo(".table-pass:eq(1)");
                });
            }
            else{
                var tr = $('<tr></tr>');
                $('<td colspan="3" id="no-data"></td>').text('BRAK WPISÓW').appendTo(tr);
                tr.appendTo(".divtable:eq(1)");
            }


            $('input[value="private"], input[value="common"]').click(function() {
                console.log($(this).val());
                $('input[value="private"], input[value="common"]').not(this).prop('checked', false);
            });
              

            $('form:eq(0)').submit(function(event) {
                // Zatrzymaj domyślne zachowanie formularza (przeładowanie strony)
                event.preventDefault();
                // Wyślij dane formularza za pomocą metody POST
                $.post('append_new_password.php', form_append.serialize(), function(response) {
                    // Obsłuż odpowiedź z serwera
                    var success_send = $('<span>Dane zostały dodane</span>').addClass('success-send');
                    success_send.appendTo(".div-statement");
                    setTimeout(function() {
                        success_send.remove();
                    }, 3000);
                });
            });

            $('.table-pass tr').click(function(e){
                if(!$(this).is(':first-child')){
                    if($(this).hasClass('highlight')){
                        $(this).removeClass('highlight');
                        //$(this).find('td:last-child').text(hashPassword($(this).find('td:last-child').data('password')));
                    } else {
                        // usuń klasę ".highlight" ze wszystkich wierszy tabeli
                        $('.table-pass tr').removeClass('highlight');
                        
                        $(this).toggleClass('highlight');
                        //$(this).find('td:last-child').;
                    }
    
                    // zapobiegaj ponownemu zaznaczeniu wiersza, który został już zaznaczony
                    e.stopPropagation();
                }
            });
            
        });
        
    }
});