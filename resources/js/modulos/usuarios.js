var url = document.getElementById("site_url").value;
const tabla = document.getElementById("tbl_list");

var statusFrm = '';

lista();
var datos = [];

function lista() {
  let urlGet = url + "usuarios/listaUsuariosAll";

  fetch(urlGet)
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      vaciarTbl_list();
      datos = data;
      llenarTabla();
    })
    .catch(function () {
      console.log("Booo");
    });
}


const vaciarTbl_list = () => {
  let tbl_list = document.getElementById("tbl_list");
  tbl_list.removeChild(tbl_list.getElementsByTagName("tbody")[0]);

  if (tbl_list.children[1] != null) {
    //vacía tabla en vista
    var rowCount = tbl_list.rows.length;
    for (var i = rowCount - 1; i > 0; i--) {
      tbl_list.deleteRow(i);
    }
  }
};

function llenarTabla() {
  datos.forEach((element, index) => {
    tbody = tabla.createTBody();
    var row = tbody.insertRow();
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);

    cell1.innerHTML = `<i class="fa fa-user"></i> ${element.nombre} ${element.ap_patern} ${element.ap_matern} `;
    cell2.innerHTML = `<i class="fa fa-phone"></i> ${element.tel1} <br><i class="fa fa-mobile-phone"></i> ${element.tel2}`;
    cell3.innerHTML = `<i class="fa fa-envelope-o"></i> ${element.email}`;
    cell4.innerHTML = ` <button type="button" class="btn btn-success" 
                                data-toggle="modal" data-target="#ModalData" title="Editar" 
                                onClick="edit(${index})"
                            >
                                <i class="fa fa-pencil"></i>
                            </button> 
                            <button type="button" class="btn btn-danger" title="Eliminar" 
                                onClick="deleteU(${element.id_usuario})"
                            >
                                <i class="fa fa-trash"></i>
                            </button>
                            `;
  });
}

function edit(index) {
  statusFrm = 'edit'
  document.getElementById("id_usuario").value = datos[index]["id_usuario"];
  document.getElementById("nombre").value = datos[index]["nombre"];
  document.getElementById("ap_patern").value = datos[index]["ap_patern"];
  document.getElementById("ap_matern").value = datos[index]["ap_matern"];
  document.getElementById("tel1").value = datos[index]["tel1"];
  document.getElementById("tel2").value = datos[index]["tel2"];
  document.getElementById("email").value = datos[index]["email"];
  document.getElementById("usuario").value = datos[index]["usuario"];
  document.getElementById('usuario').readOnly = true;
  document.getElementById("password").value = "";
  document.getElementById("status").value = datos[index]["status"];
  document.getElementById("nivel").value = datos[index]["nivel"];
  // document.getElementById("fotografia").value = datos[index]["fotografia"];
}

const add = () => {
  vaciar();
  statusFrm = 'add';
  document.getElementById('usuario').readOnly = false;
}

var save = () => {
  let id_usuario = document.getElementById("id_usuario").value;
  let pass1 = document.getElementById("password").value;
  let pass2 = document.getElementById("password-confirm").value;

  if (pass1 != "" && pass2 != "") {
    //se va a cambiar el password
    //verifica si los dos password son iguales
    if (pass1 !== pass2) {
      // no son iguales
      alert("Los password no son iguales");
      return;
    }
  }

  if (statusFrm === 'edit') {
    var urlPut = url + "usuarios/guardarUsuario";
  }
  if (statusFrm === 'add') {
    var urlPut = url + "usuarios/agregarUsuario";
  }

  let form = document.getElementById("frmEdit");
  let data = new FormData(form);

  var input = document.querySelector('input[type="file"]')
  data.append('fotografia', input.files[0])

  fetch(urlPut, {
      method: "post",
      headers: new Headers(),
      body: data
    })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      lista();
    })
    .catch(function (err) {
      console.error(err);
    });
};

var deleteU = async id => {
  if (confirm("Está seguro de eliminar?")) {
    let urlDelete = url + `usuarios/deleteUsuario?id_usuario=${id}`;
    let response = await fetch(urlDelete);
    let res = await response.json();
    if (res.success === true) {
      lista();
    }
  }
};

const vaciar = () => {
  document.getElementById('frmEdit').reset();
}

//verificar password
// var pass1 = document.getElementById("password");
// var pass2 = document.getElementById("password-confirm");
// pass1.addEventListener("keyup", e => {
//   console.log("keyup", e);
// });