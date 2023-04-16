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
            
            // utwórz diva dla menedżera haseł
            var content_menager = $('<div></div>').attr("id", "content-menager");

            // utwórz div dla tutyłów
            var titles = $('<div></div>').attr("id", "titles");
            var title1 = $('<div></div>').addClass("title");
            title1.appendTo(titles);
            var text1 = $('<span></span>').addClass("title-menager").text("Hasła wspólne");
            text1.appendTo(title1);
            var title2 = $('<div></div>').addClass("title");
            title2.appendTo(titles);
            var text2 = $('<span></span>').addClass("title-menager").text("Hasła prywatne");
            text2.appendTo(title2);

            titles.appendTo(content_menager);

            // utwórz nowego diva o klasie "tables"
            var tables = $('<div></div>').attr("id", "tables");

            // utwórz diva dla "tabeli1" o klasie "table1"
            var divtable1 = $('<div></div>').addClass("divtable");
            // utwórz nową tabelę
            var table1 = $('<table></table>').addClass("table-pass");

            // utwórz nagłówek tabeli
            var header = $('<tr></tr>');
            $('<th></th>').addClass("table-header").text('Miejsce').appendTo(header);
            $('<th></th>').addClass("table-header").text('Login').appendTo(header);
            $('<th></th>').addClass("table-header").text('Hasło').appendTo(header);
            header.appendTo(table1);

            // utwórz wiersze tabeli na podstawie pobranych danych
            $.each(data_common, function(index, row) {
                var tr = $('<tr></tr>');
                $('<td></td>').text(row.place).appendTo(tr);
                $('<td></td>').text(row.login).appendTo(tr);
                $('<td></td>').text(row.password).appendTo(tr);
                tr.appendTo(table1);
            });

            // dodaj tabelę do elementu z klasą "divtab1"
            table1.appendTo(divtable1);
            // dodaj diva-tabeli do elementu z klasą "tables"
            divtable1.appendTo(tables);
            
            // utwórz diva dla "tabeli2" o klasie "table2"
            var divtable2 = $('<div></div>').addClass("divtable");
            // utwórz nową tabelę
            var table2 = $('<table></table>').addClass("table-pass");

            // utwórz nagłówek tabeli
            var header = $('<tr></tr>');
            $('<th></th>').addClass("table-header").text('Miejsce').appendTo(header);
            $('<th></th>').addClass("table-header").text('Login').appendTo(header);
            $('<th></th>').addClass("table-header").text('Hasło').appendTo(header);
            header.appendTo(table2);

            // utwórz wiersze tabeli na podstawie pobranych danych
            $.each(data_private, function(index, row) {
            var tr = $('<tr></tr>');
            $('<td></td>').text(row.place).appendTo(tr);
            $('<td></td>').text(row.login).appendTo(tr);
            $('<td></td>').text(row.password).appendTo(tr);
            tr.appendTo(table2);
            });

            // dodaj  tabelę do elementu z klasą "divtab2"
            table2.appendTo(divtable2);
            // dodaj  diva-tabeli do elementu z klasą "tables"
            divtable2.appendTo(tables);

            tables.appendTo(content_menager);

            // dodaj diva do elementu z klasą "content"
            $('.content').append(content_menager);

            var content_nav = $("<div></div>").addClass('content-nav');
            var div_button_append = $("<div></div>").addClass('buttons-div');
            var div_button_delete = $("<div></div>").addClass('buttons-div');
            var form_append = $('<form></form>');
            form_append.append($('<span>Dodawanie nowego hasła</span>').addClass('text-nav'));
            form_append.append($('<input type="text" name="new_place" placeholder="miejsce">'));
            form_append.append($('<input type="text" name="new_login" placeholder="login">'));
            form_append.append($('<input type="password" name="new_password" placeholder="hasło">'));
            form_append.append($('<input type="password" name="new_password_confirm" placeholder="potwierdź hasło">'));
            form_append.append($('<input type="submit" value="Dodaj" id="pass-send">'));
            form_append.append($('<input type="radio" name="privacy" value="private">').addClass('radio-type'));
            form_append.append($('<span>Prywatne</span>').addClass('radio-text'));
            form_append.append($('<input type="radio" name="privacy" value="common">').addClass('radio-type'));
            form_append.append($('<span>Wspólne</span>').addClass('radio-text'));
            form_append.appendTo(div_button_append);
            div_button_append.appendTo(content_nav);
            div_button_delete.appendTo(content_nav);
            $('.content').append(content_nav);

            $('input[value="private"], input[value="common"]').click(function() {
                console.log($(this).val());
                $('input[value="private"], input[value="common"]').not(this).prop('checked', false);
            });
              

            form_append.submit(function(event) {
                // Zatrzymaj domyślne zachowanie formularza (przeładowanie strony)
                event.preventDefault();
                // Wyślij dane formularza za pomocą metody POST
                $.post('append_new_password.php', form_append.serialize(), function(response) {
                    // Obsłuż odpowiedź z serwera
                    var success_send = $('<span>Dane zostały dodane</span>').addClass('success-send');
                    success_send.appendTo(div_button_append);
                    setTimeout(function() {
                        success_send.remove();
                    }, 3000);
                });
            });

              
            //$('.table-pass tr').addClass('highlight');
            // obsłuż kliknięcie wiersza tabeli
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