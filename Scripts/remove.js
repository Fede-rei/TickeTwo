function remove(element) {
    let req = new XMLHttpRequest()

    req.open('get', '../include/remove_from_cart.php?&carrello=' + element.id)
    req.send()

    req.onreadystatechange = function () {
        if(req.readyState === 4 && (req.status >= 200 || req.status < 300)) {
            let r = JSON.parse(req.response)

            if(r === 1){
                window.location.replace('cart.php')
            }
        }
    }
}

function changeQ(element) {
    if(element.value >= 1) {
        let req = new XMLHttpRequest()

        req.open('get', '../include/changeQ.php?&carrello=' + element.id + '&c=' + element.value)
        req.send()

        req.onreadystatechange = function () {
            if (req.readyState === 4 && (req.status >= 200 || req.status < 300)) {
                let r = JSON.parse(req.response)

                if (r === 1) {
                    window.location.replace('cart.php')
                }
            }
        }
    }
}


let acq = document.querySelector('.acq')
let idCarrello = document.querySelectorAll('.q')


acq.onclick = function() {
    let req = new XMLHttpRequest()
    let idCarr = '';

    idCarr += idCarrello[0].id
    for (let i = 1; i < idCarrello.length; i++) {
        idCarr += ',' + idCarrello[i].id
    }
    req.open('get', '../include/acquistaC.php?carrello=' + idCarr + '&user=' + uid)
    req.send()

    req.onreadystatechange = function() {
        if(req.readyState === 4 && (req.status >= 200 && req.status < 300)) {
            let r = JSON.parse(req.response)

            if(r === 1) {
                window.location.replace('cart.php')
            }
        }
    }
}
