function sendForm(formsend, url) {
    var form = document.getElementById(formsend);
    var btnsend = document.getElementById('btnsend');
    var xhr = new XMLHttpRequest();
    var fd = new FormData(form);

    if (btnsend.value === 'Enviado!') {
        alert('Os dados já foram enviados!');
    } else {
        btnsend.value = 'Enviando...';
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                btnsend.value = 'Enviado!';
                alert(this.responseText);
                history.back();
            }
        };
        xhr.open("POST", url, true);
        xhr.send(fd);
    }
}