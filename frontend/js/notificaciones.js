$("#campana").click(function (e) {
    if ($("#box-notify").css("display") == 'none') {
        $("#box-notify").css("display", 'block')
    } else {
        $("#box-notify").css("display", 'none')
    }
})

var anterior = 0;
$("#box-notify").scroll(function (e) {
    // console.log($("#box-notify").scrollTop())
    // console.log(document.getElementById("box-notify").scrollHeight)
    max = document.getElementById("box-notify").scrollHeight - 300

    if ($("#box-notify").scrollTop() > max) {
        cargarNotificacion(anterior)
    }
})

window.onload = cargarNotificacion(anterior)

function cargarNotificacion(a) {
    $.ajax({
        type: "POST",
        url: "notificaciones",
        data: { anterior: a },
        enctype: 'application/x-www-form-urlencoded',
        success: function (response) {
            var data = JSON.parse(response),
                noleidas = 0;
            console.log(data)
            data.forEach(e => {
                var ul = document.getElementById("ul-notify"),
                li = document.createElement("li"),
                a = document.createElement("a"),
                div1 = document.createElement("div"),
                div2 = document.createElement("div"),
                span = document.createElement("span")
                small = document.createElement("small")

                texto = document.createTextNode(e.texto);
                fecha = document.createTextNode(e.fecha);

                li.className = "collection-item notificacion-color"                
                a.className = "enlace-notificacion"
                div1.className = "texto-notificacion"
                div2.className = "fecha-notificacion"
                span.className = "span-notificacion"

                small.appendChild(fecha)
                span.appendChild(small)
                div2.appendChild(span)

                div1.appendChild(texto)
                a.appendChild(div1)
                a.appendChild(div2)
                li.appendChild(a)
                ul.appendChild(li)
                if(e.leido == 0){
                    noleidas++
                    li.className = "collection-item no-leida notificacion-color"
                }

                if(e.link !=null){
                    a.href = e.link
                }
                anterior++
            });
            if(noleidas > 0)
                $("#no-leidas").html(noleidas)
        }
    })
}

    // $(window).scroll(function(e) {
    //     console.log($(window).scrollTop())
    //     console.log($(window).height())
    //     console.log($(document).height())
    // })

	// if($(window).scrollTop() + $(window).height() == $(document).height()){
    //         console.log("A")
    //     }
    // })