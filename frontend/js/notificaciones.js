var primera_vez = true;
var anterior = 0;
var banderaPre = false;
var bandera = false;
$("#campana").click(function (e) {
    if ($("#box-notify").css("display") == 'none') {
        $("#box-notify").css("display", 'block')
        if(primera_vez)
            setTimeout(() => {
                cargarNotificacion(0)                
            }, 3000);
    } else {
        $("#box-notify").css("display", 'none')
    }
})

$("#box-notify").scroll(function (e) {
    max = document.getElementById("box-notify").scrollHeight - 300

    if($("#box-notify").scrollTop() > document.getElementById("box-notify").scrollHeight - 400){
        if(banderaPre){
            banderaPre = false 
            var ul = document.getElementById("ul-notify"),
            li = `<div class="preloader-wrapper small active">
                        <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                        </div>
                    </div>`
            liNode = document.createElement("li")
            liNode.className = "collection-item"
            liNode.id = "preloader-notify"
            liNode.innerHTML = li
            ul.appendChild(liNode)   
        }
    }

    if ($("#box-notify").scrollTop() > max) {
        if(bandera){
            bandera = false
            setTimeout(() => {
                cargarNotificacion(anterior)                
            }, 3000);
        }
    }
})

window.onload = notificacionesNoLeidas()

function cargarNotificacion(a) {
    $.ajax({
        type: "POST",
        url: "notificaciones",
        data: { anterior: a, cargar:1 },
        enctype: 'application/x-www-form-urlencoded',
        success: function (response) {
            var data = JSON.parse(response),
                noleidas = 0;
            var ul = document.getElementById("ul-notify");

            if(primera_vez){
                bandera = true
                banderaPre = true
            }

            ul.removeChild(document.getElementById("preloader-notify"))
            primera_vez = false
            let existen = false
            data.forEach(e => {
                existen = true
                li = document.createElement("li"),
                li.id = "li"+e.id_noti
                a = '<a class="enlace-notificacion" onclick="marcarLeida('+e.id_noti+')" id="a'+e.id_noti+'">'
                div1 = document.createElement("div"),
                div2 = document.createElement("div"),
                span = document.createElement("span")
                small = document.createElement("small")

                texto = document.createTextNode(e.texto);
                fecha = document.createTextNode(e.fecha);

                li.className = "collection-item notificacion-color"
                div1.className = "texto-notificacion"
                div2.className = "fecha-notificacion"
                span.className = "span-notificacion"
                ul.appendChild(li)


                small.appendChild(fecha)
                span.appendChild(small)
                div2.appendChild(span)

                div1.appendChild(texto)
                li.innerHTML = a
                
                var enlace = document.getElementById("a"+e.id_noti)
                enlace.appendChild(div1)
                enlace.appendChild(div2)
                if(e.leido == 0){
                    li.className = "collection-item no-leida notificacion-color"
                    enlace.title = "Marcar como leída"
                }

                if(e.link !=null){
                    enlace.href = e.link
                }
                anterior++
            });

            if(existen){
                banderaPre = true
                bandera = true
            }
        }
    })
}

function notificacionesNoLeidas(){
    $.ajax({
        type: "POST",
        url: "notificaciones",
        data: {no_leidas:1},
        enctype: 'application/x-www-form-urlencoded',
        success: function (response) {
            $("#no-leidas").html(response)
        }
    })
}

function marcarLeida(id){
    console.log("PP"+id)
    $.ajax({
        type: "POST",
        url: "notificaciones",
        data: {marcar:1,noti:id},
        enctype: 'application/x-www-form-urlencoded',
        success: function (response) {
            if(response == "ok"){
                let a = document.getElementById("a"+id);
                let li = document.getElementById("li"+id);
                li.className = "collection-item notificacion-color"
                a.title = ""
            } 
        }
    })
}