function changeVisibility(t, id) {
    let inp = document.querySelector(id)

    if(t.innerHTML === 'visibility_off') {
        inp.type = 'text'
        t.innerHTML = 'visibility'
    } else {
        inp.type = 'password'
        t.innerHTML = 'visibility_off'
    }
}