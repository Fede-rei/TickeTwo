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
    let req = new XMLHttpRequest()

    req.open('get', '../include/changeQ.php?&carrello=' + element.id + '&c=' + element.value)
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