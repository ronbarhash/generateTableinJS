
$(document).ready(function(){
    $( "#form" ).submit(function( event ) {
        event.preventDefault();
        var search = parseInt($( "input:first" ).val());
        if (search > 0) {
          $.post('data.php',{id : search},function(data){
              var responce = JSON.parse(data);
              console.log(responce);
              renderTable(responce);

          });
          $( "span" ).text( "Validated..." ).show();
          return;
        }

        $( "span" ).text( "Not valid!" ).show().fadeOut( 2000 );
       
      });
});

function renderTable(data){
    var table = document.getElementsByTagName("table")[0];
    table.innerHTML="";

    table.appendChild(createRowElement("информация про клиента", null, 2));
    table.appendChild(createRowElement("название клиента", data.name_customer, 1));
    table.appendChild(createRowElement("название клиента", data.company, 1));
    table.appendChild(createRowElement("информация про договор", null, 2));
    table.appendChild(createRowElement("номер договора", data.number, 1));
    table.appendChild(createRowElement("дата подписания", data.date_sign, 1));
    table.appendChild(createRowElement("информация про сервисы", null, 2));
    table.appendChild(createRowElement(null, data.title_service, 1));
}

function createRowElement(title, content, col=1){
    var tr = document.createElement("tr");

    switch(col){
        case 1: 
            var td1 = document.createElement("td");
            td1.innerHTML = title;
            var td2 = document.createElement("td");
            td1.innerHTML = content;
            tr.appendChild(td1);
            tr.appendChild(td2);
            return tr;
        case 2:
        var b = document.createElement("b");
        b.innerHTML = title;    
        var td = document.createElement("td");
            td.setAttribute("colspan",2);
            td.appendChild(b);
            tr.appendChild(td);
            return tr; 
    }
}