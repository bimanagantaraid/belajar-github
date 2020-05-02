<?php 

    class Kost extends CI_Controller
    {
        var $API ="";
    
        function __construct() {
            parent::__construct();
            $this->API="http://localhost/rest-kost/api/";
        }

        function update($idkost){
            $data['kost']   = json_decode($this->curl->simple_get($this->API.'kost/getkost?idkost='.$idkost),true);
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('admin/update',$data);
            $this->load->view('templates/footer');
        }

        function ubah(){
            $fasilitas  = $this->input->post('KMD').','.$this->input->post('KD').','.$this->input->post('KASUR').','.$this->input->post('AC').','.$this->input->post('WIFI').','.$this->input->post('24JAM').','.$this->input->post('LOUNDRY').','.$this->input->post('TV');

            $data = array (
                'idkost'        => $this->input->post('idkost'),
                'namakost'      => $this->input->post('namakost'),
                'harga'         => $this->input->post('harga'),
                'type'          => $this->input->post('type'),
                'kota'          => $this->input->post('kota'),
                'kecamatan'     => $this->input->post('kecamatan'),
                'keterangan'    => $this->input->post('keterangan'),
                'diskripsi'     => $this->input->post('diskripsi'),
                'Alamat'        => $this->input->post('Alamat'),
                'gambar'        => $this->input->post('gambar'),
                'fasilitas'     => $fasilitas
            );
            $update = $this->curl->simple_put($this->API.'/kost/editkost/',$data,array(CURLOPT_BUFFERSIZE => 10));
            if($update)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kost Has Been Updated!</div>');
                redirect('/admin/dashboard/kost');
            }else
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Fail to Update Kost!</div>');
                redirect('/admin/dashboard/kost');
            }            
        }

        function delete(){
            $idkost = $this->uri->segment(4);
            $delete = $this->curl->simple_delete($this->API.'/kost/deletekost/',array('idkost'=>$idkost),array(CURLOPT_BUFFERSIZE => 10));
            if($delete)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kost Has Been Deleted!</div>');
                redirect('/admin/dashboard/kost');
            }else
            {
                $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Fail to De;ete Kost!</div>');
                redirect('/admin/dashboard/kost');
            }
        }
    }

?>