<?php


class Cart extends CI_Controller
{
   
    public $tax;
    public $shipping;
    public $total = 0;
    public $grand_total;
    

    // Cart Index
    public function index()
    {
        //Load View
        $data['main_content'] = 'cart';
        $this->load->view('layouts/main', $data);
    }

    // Add to Cart
    public function add()
    {
        // Item Data
        $data = array(
            'id' => $this->input->post('item_number'),
            'qty' => $this->input->post('qty'),
            'price' => $this->input->post('price'),
            'name' => $this->input->post('title')
        );
        // print_r($data); die();

        // Insert Into Cart
        $this->cart->insert($data);

        redirect('products');
    }

    public function update($in_cart = null)
    {
        $data = $_POST;
        $this->cart->update($data);

        //Show Cart Page
        redirect('cart', 'refresh');
    }

    public function process ()
    {
        if($_POST){
            //Get tax & shipping from config
            $this->tax = $this->config->item('tax');
            $this->shipping = $this->config->item('shipping');

            foreach ($this->input->post('item_name') as $key => $value) {
                $item_id = $this->input->post('item_code')[$key];
                $product = $this->Product_model->get_product_details($item_id);

                //Price x Quanity
                $subtotal = ($product['price'] * $this->input->post('item_qty')[$key]);
                $this->total = $this->total + $subtotal;

        $order_data = array(
                    'product_id' => $item_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'transaction_id' => 0,
                    'qty' => $this->input->post('item_qty')[$key],
                    'price' => $subtotal,
                    'address' => $this->input->post('address'),
                    'address' => $this->input->post('address2'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zipcode' => $this->input->post('zipcode')
                );

        $this->Product_model->add_order($order_data);
       
}
         $this->grand_total = $this->total + $this->tax + $this->shipping;
       
        $data['main_content']= 'bill';

        $this->load->view('layouts/main', $data);

}
}
}