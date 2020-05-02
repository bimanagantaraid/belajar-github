<?php 

    class Dashboard extends CI_Controller{
        function __construct() {
            parent::__construct();
            $this->API="http://localhost/rest-kost/api/";
            $this->assetimg = "http://localhost/rest-kost/uploads/";
        }

        public function index(){
            $data['title'] = "KOST MAWAR - User";
            $id = 2;
            $data['datasewa'] = json_decode($this->curl->simple_get($this->API.'/user/getdatausersewa?id='.$id));
            $this->load->view('templates_user/header',$data);
            $this->load->view('templates_user/sidebar');
            $this->load->view('user/dashboard',$data);
            $this->load->view('templates_user/footer');
        }
    }