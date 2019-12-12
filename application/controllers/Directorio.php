<?php
class Directorio extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Directorio');
    }

    /*
     * Listing of status
     */
    public function index()
    {
        if ($this->session->userdata('nivel') == 1) {
            $data['status'] = $this->Model_Directorio->get_all_status();

            $data['_view'] = 'status/index';
            $this->load->view('layouts/main', $data);
        } else {
            $data['_view'] = "accessdenied";
            $this->load->view('layouts/main', $data);
        }
    }
    /*
     * List all status
     */
    public function get_all_status()
    {
        echo json_encode($this->Model_Directorio->get_all_status());
    }

    /*
     * Adding a new statu
     */
    public function add()
    {
        if ($this->session->userdata('nivel') == 1) {

            if (isset($_POST) && count($_POST) > 0) {
                $params = array(
                    'status' => $this->input->post('status'),
                );

                $statu_id = $this->Model_Directorio->add_status($params);
                redirect('status/index');
            } else {
                $data['_view'] = 'status/add';
                $this->load->view('layouts/main', $data);
            }
        } else {
            $data['_view'] = "accessdenied";
            $this->load->view('layouts/main', $data);
        }
    }

    /*
     * Editing a statu
     */
    public function edit($idstatus)
    {
        // check if the statu exists before trying to edit it
        $data['status'] = $this->Model_Directorio->get_status($idstatus);

        if (isset($data['status']['idstatus'])) {
            if (isset($_POST) && count($_POST) > 0) {
                $params = array(
                    'status' => $this->input->post('status'),
                );

                $this->Status_Model->update_status($idstatus, $params);
                redirect('status/index');
            } else {
                $data['_view'] = 'status/edit';
                $this->load->view('layouts/main', $data);
            }
        } else {
            show_error('The statu you are trying to edit does not exist.');
        }

    }

    /*
     * Deleting statu
     */
    public function remove($idstatus)
    {
        $status = $this->Model_Directorio->get_status($idstatus);

        // check if the statu exists before trying to delete it
        if (isset($status['idstatus'])) {
            $this->Model_Directorio->delete_status($idstatus);
            redirect('status/index');
        } else {
            show_error('The statu you are trying to delete does not exist.');
        }

    }

}
