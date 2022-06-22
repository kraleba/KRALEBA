<?php

namespace App\Helpers;

use App\Models\Customers;
use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerHelper
{
    public $product;
    public $customers;

    public function __construct()
    {
        $this->product = new Products();
        $this->customers = new Customers();
    }

    public function helper_get_categories_to_customers($customers)
    {


        foreach ($customers as $customer) {

            if (is_object($customer)) {
                $customer = (array)$customer;
            }

            if ($customer['category_id'] && is_numeric($customer['category_id'])) {
                $category = $this->product->get_customer_category_by_id($customer['category_id']);
                $customer['category_id'] = $category;

            }

            if ($customer['subcategory_id'] && is_numeric($customer['subcategory_id'])) {
                $subcategory = $this->product->get_customer_subcategory_by_id($customer['subcategory_id']);
                $customer['subcategory_id'] = $subcategory;
            }
        }
        return $customers;
    }

//for edit when is a single customer
    public function helper_get_categories_to_customer($customer)
    {
        $category = (array)$this->product->get_customer_category_by_id($customer['category_id']);
        $customer['category_id'] = $category;

        $subcategory = (array)$this->product->get_customer_subcategory_by_id($customer['subcategory_id']);
        $customer['subcategory_id'] = $subcategory;

        return $customer;
    }

    public function helper_add_subcategory($data)
    {
        $product = new Products();
        $ifSubcategoryExist = (array)$product->find_subcategory_by_label($data);

        if (!$ifSubcategoryExist) {
            $product->set_customers_subcategory(array('name' => $data));
            $subcategoryData = (array)$product->find_subcategory_by_label($data);
        } else {
            $subcategoryData = $ifSubcategoryExist;
        }

        return $subcategoryData['subcategory_id'];

    }

//generate title afrer filter
    public function helper_generate_title_after_filter($customer_type, $category, $subcategory_id)
    {
//        dd($customer_type);
        if ($customer_type == 'Provider') {
            $customer_type = "Furnizor";
        }
        if ($customer_type == 'Customer') {
            $customer_type = 'Beneficiar';
        }

        $title_text = "Ai aplicat filtrele: ";

        if ($customer_type) {
            $title_text .= ' tipul ' . $customer_type;
        }
        if ($category) {
            $title_text .= ' categoria ' . $this->product->get_customer_category_by_id($category)->name;
        }
        if (!is_numeric($subcategory_id) && $subcategory_id) {
            $subcategory_id = $this->product->find_subcategory_by_label($subcategory_id)->subcategory_id;
        }

//
        if ($subcategory_id && is_numeric($subcategory_id)) {
            $title_text .= ' sub-categoria ' . $this->product->get_customer_subcategory_by_id($subcategory_id)->name;
        }

        return $title_text;
    }

    public function helper_show_filter($data)
    {

        $customer_type = $data['type'] ?? '';
        $category = $data['category'] ?? '';
        $subcategory = $data['subcategory'] ?? '';

        $subcategory = $this->product->find_subcategory_by_label($subcategory) ?? '';
        $subcategory_id = $subcategory->subcategory_id ?? '';

        return array(
            'customers' => $this->customers->get_customers_after_filter($customer_type, $category, $subcategory_id),
            'filter_title' => $this->helper_generate_title_after_filter($customer_type, $category, $subcategory_id),
            'type' => $customer_type,
            'category' => $category,
            'subcategory' => $subcategory_id
        );
    }

}
