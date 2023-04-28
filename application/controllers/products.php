<?php
class Products extends CI_Controller {
	
	public function __construct() {
		parent:: __construct();
		$this->load->library('pagination');
    }

    /**
     *  Get (filtered or all) Products and Load View
     */
	public function index() {
		$config = array();
		$config['base_url'] = base_url().'products/index';
		$config['total_rows'] = $this->Product_model->get_product_count();
		$config['per_page'] = 9;
		$config["uri_segment"] = 3;
		$config['num_links'] = 2;
		$config['next_link'] = 'Next >';
		$config['prev_link'] = '< Previous';

		$this->pagination->initialize($config);

		if ($this->input->post('keywords')) {
			//Get Filtered Products
			$data['products'] = $this->Product_model->get_filtered_products($this->input->post('keywords'));
		} else {
			//Get All Products
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['products'] = $this->Product_model->get_list_products($config["per_page"], $page);
		}

		//Load View
        $data['links'] = $this->pagination->create_links();
		$data['main_content'] = 'products';
		$this->load->view('/layouts/main', $data);
	}

    /**
     * Get Product Details and Load View
     * @param $id
     */
	public function details($id) {
		
		//Get Product Details
		$data['product'] = $this->Product_model->get_product_details($id);
		
		//Load View
		$data['main_content'] = 'details';
		$this->load->view('/layouts/main', $data);
	}

    /**
     * Get Product Category and Load View
     * @param $category_id
     */
	public function category($category_id) {
		
		//Get Product Category
		$data['products'] = $this->Product_model->get_category($category_id);
		
		//Load View
		$data['links'] = $this->pagination->create_links();
		$data['main_content'] = 'products';
		$this->load->view('/layouts/main', $data);
	}
}