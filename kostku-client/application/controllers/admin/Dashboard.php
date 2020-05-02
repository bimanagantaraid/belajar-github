<?php 

    class Dashboard extends CI_Controller
    {
        var $API ="";
    
        function __construct() {
            parent::__construct();
            $this->API="http://localhost/rest-kost/api/";
            $this->assetimg = "http://localhost/rest-kost/uploads/";
        }
        

        public function index()
        {   
            $data['title'] = "Dashboard Admin";
            $data['kost'] = json_decode($this->curl->simple_get($this->API.'kost/getkost'));
            $this->load->view('templates_admin/header',$data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('templates_admin/footer');
        }

        public function kost()
        {   
            $data['title'] = "Kost - Dashboard Admin";
            $data['asset']=$this->assetimg;
            $data['count']=json_decode($this->curl->simple_get($this->API.'kost/getkost'));
            $config['base_url'] = base_url().'admin/dashboard/kost';
            $config['total_rows']= count($data['count']);
            $config['per_page']=5;
            $config["uri_segment"] = 4;  // uri parameter
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);

            // Membuat Style pagination untuk BootStrap v4
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';
            $form = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $this->pagination->initialize($config);
            $data['kost'] = json_decode($this->curl->simple_get($this->API.'/kost/getkostlistpage?from='.$form.'&page='.$config['per_page']));         
            $data['pagination'] = $this->pagination->create_links();
            $this->load->view('templates_admin/header',$data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/kost',$data);
            $this->load->view('templates_admin/footer');
        }

        public function kost_search(){
            $where = $this->input->post('search');
            $data['kost'] = $this->m_query->search($where);
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/search',$data);
            $this->load->view('templates_admin/footer');
        }

        public function user()
        {
            $data['user'] = $this->m_query->data_user();
            $this->load->view('templates_admin/header');
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/user',$data);
            $this->load->view('templates_admin/footer');
        }

        public function pembayaran(){
            
        }
    }

?>