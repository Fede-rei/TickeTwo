function increaseCount(a, b) {
    var input = b.previousElementSibling;
    var value = parseInt(input.value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    input.value = value;
}

function decreaseCount(a, b) {
    var input = b.nextElementSibling;
    var value = parseInt(input.value, 10);
    if (value > 1) {
        value = isNaN(value) ? 0 : value;
        value--;
        input.value = value;
    }
}

let aggCarr = document.querySelector('.aggCarr')
let c = document.querySelector('.count')

aggCarr.onclick = function() {
    let req = new XMLHttpRequest()

    req.open('get', 'aggiungi.php?biglietto=' + aggCarr.value + '&user=' + uid + '&c=' + c.value)
    req.send()

    req.onreadystatechange = function() {
        if(req.readyState === 4 && (req.status >= 200 || req.status < 300)) {
            let r = JSON.parse(req.response)

            if(r === 1){
                window.location.replace('cart.php')
            }
        }
    }
}