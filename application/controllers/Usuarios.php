<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_Usuario");
        $this->load->model("Model_Nivel");
        $this->load->model("Status_Model");
    }

    public function index()
    {
        if ($this->session->userdata('nivel') == 1) {
            $data['lista'] = $this->Model_Usuario->listaUsuariosAll();
            $data['all_status'] = $this->Status_Model->get_all_status();
            $data['all_nivel'] = $this->Model_Nivel->getAll();

            $data['_view'] = 'usuarios/usuarios';

            $this->load->view('layouts/main', $data);

        } else {
            $data['_view'] = "accessdenied";
            $this->load->view('layouts/main', $data);
        }
    }

    public function agregarUsuario()
    {
        $datos = $_POST;
        $foto = $_FILES;

        $datos['password'] = sha1($this->input->post('password'));
        unset($datos['id_usuario']);
        unset($datos['password-confirm']);

        if ($_FILES['fotografia']['error'] == 0) { // sí hay foto
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . "/regtech/resources/img/fotografias/";
            $file = $_FILES["fotografia"];
            $nameExt = explode('/', $file["type"]);
            $nombre = $this->input->post('usuario') . '.' . $nameExt[1];

            $tipo = $file["type"];
            $ruta_provisional = $file["tmp_name"];
            $size = $file["size"];
            $carpeta = $targetFolder;
            $src = $targetFolder . $nombre;

            // if (!file_exists($src)) {
            if (move_uploaded_file($ruta_provisional, $src)) {
                $datos['fotografia'] = $nombre;
                $data['data'] = $this->Model_Usuario->agregarUsuario($datos);
                $data = array(
                    'success' => true,
                    'message' => "Archivo $nombre fue almacenado correctamente",
                );
            } else {
                $data = array(
                    'success' => false,
                    'message' => "No se pudo copiar el archivo $nombre!!!!!!",
                );
            }
        } else if ($_FILES['fotografia']['error'] == 4) { // no hay foto
            unset($datos['fotografia']); // elimina el campo fotografia para que no se actualice
            $this->Model_Usuario->agregarUsuario($datos);
            $data = array(
                'success' => true,
                'message' => "Actualizado correctamente",
            );
        }

        echo json_encode($data);
    }

    public function guardarUsuario()
    {
        $datos = $_POST;
        $foto = $_FILES;

        // Revisa si se va a cambiar el password o se quita de la lista de parámetros
        if ($datos['password'] === '') {
            unset($datos['password']);
            unset($datos['password-confirm']);
        } else if ($datos['password'] !== '') {
            $datos['password'] = sha1($this->input->post('password'));
            unset($datos['password-confirm']);
        }

        // Revisa si se cambia el password o no
        if ($_FILES['fotografia']['error'] == 0) { // sí hay foto
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . "/regtech/resources/img/fotografias/";
            $file = $_FILES["fotografia"];
            $nameExt = explode('/', $file["type"]);
            $nombre = $this->input->post('usuario') . '.' . $nameExt[1];

            $tipo = $file["type"];
            $ruta_provisional = $file["tmp_name"];
            $size = $file["size"];
            $carpeta = $targetFolder;
            $src = $targetFolder . $nombre;

            // if (!file_exists($src)) {
            if (move_uploaded_file($ruta_provisional, $src)) {
                $datos['fotografia'] = $nombre;
                $data['data'] = $this->Model_Usuario->guardarUsuario($datos);
                $data = array(
                    'success' => true,
                    'message' => "Archivo $nombre fue almacenado correctamente",
                );
            } else {
                $data = array(
                    'success' => false,
                    'message' => "No se pudo copiar el archivo $nombre!!!!!!",
                );
            }
            // } else {
            //     $data = array(
            //         'success' => false,
            //         'message' => "El archivo $nombre ya existe!!!",
            //     );
            // }
        } else if ($_FILES['fotografia']['error'] == 4) { // no hay foto
            unset($datos['fotografia']); // elimina el campo fotografia para que no se actualice
            $this->Model_Usuario->guardarUsuario($datos);
            $data = array(
                'success' => true,
                'message' => "Actualizado correctamente",
            );
        }

        echo json_encode($data);
    }

    public function getUsuario()
    {
        $this->load->model("Model_Usuario");
        $id_usuario = $this->input->post('id_usuario');
        $result = $this->Model_Usuario->getUsuario($id_usuario);
        $json = json_encode($result);
        echo $json;
    }

    public function deleteUsuario()
    {
        $this->load->model("Model_Usuario");
        $id_usuario = $this->input->get('id_usuario');

        if ($this->Model_Usuario->deleteUsuario($id_usuario)) {
            $data = array('success' => true, 'message' => 'Eliminado correctamente');
            echo json_encode($data);
        }

    }

    public function listaUsuariosAll()
    {
        $result = $this->Model_Usuario->listaUsuariosAll();
        $json = json_encode($result);
        echo $json;
    }
    public function listaVistaUsuarios()
    {
        $result = $this->Model_Usuario->listaVistaUsuarios();
        $json = json_encode($result);
        echo $json;
    }

    public function listaVistaUsuariosNivel()
    {
        $nivel = $this->input->post('nivel');
        $result = $this->Model_Usuario->listaVistaUsuariosNivel($nivel);
        $json = json_encode($result);
        echo $json;
    }
}