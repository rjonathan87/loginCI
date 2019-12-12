document.getElementById('usuario').focus();
var base_url = window.location.origin + '/regtech';

const frmLogin = document.getElementById('frmLogin');
frmLogin.addEventListener('submit', async (e) => {
    e.preventDefault();

    const datos = new FormData(document.getElementById('frmLogin'));

    let response = await fetch(`${base_url}/login/validar`, {
        method: 'POST',
        body: datos
    });
    await response.json()
        .then((data) => {
            if (data.message === 'Ok')
                window.location.href = base_url;
            else
                alert(data.message);

        })
        .catch((err) => {
            console.log(`Error: ${err}`);
        });

});