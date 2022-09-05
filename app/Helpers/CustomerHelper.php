<?php

namespace App\Helpers;

use App\Http\Controllers\Controller;
use App\Models\Bills;
use App\Models\Customers;
use App\Models\CustomerWares;
use App\Models\Products;
use App\Models\ProductTemplateChild;
use App\Models\ProductTemplateParent;
use Illuminate\Http\Request;


class CustomerHelper extends Controller
{
    public Products $product;
    public Customers $customers;
    public CustomerWares $wares;
    public ProductTemplateParent $templateParent;
    public ProductTemplateChild $templateChild;
    public Bills $bills;

    public function __construct()
    {
        $this->product = new Products();
        $this->customers = new Customers();
        $this->wares = new CustomerWares();
        $this->templateParent = new ProductTemplateParent();
        $this->templateChild = new ProductTemplateChild();
        $this->bills = new Bills();
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

    public function helper_add_subcategory(Request $request)
    {
        if (!is_numeric($request->input('category_id'))) {
            return false;
        }
        $category_id = $request->input('category_id');
        $subcategory = $request->input('subcategory_label');

        $ifSubcategoryExist = (array)$this->product->find_subcategory_by_label($subcategory);

        if (!$ifSubcategoryExist) {
            $this->product->set_customers_subcategory(array('name' => $subcategory, 'category_id' => $category_id));
            $subcategory = (array)$this->product->find_subcategory_by_label($subcategory);

        } else {
            return false;
        }

        return $subcategory;

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

        $title_text = " ";

        if ($customer_type) {
            $title_text .= ' ' . $customer_type;
        }
        if ($category) {
            $title_text .= ' / ' . $this->product->get_customer_category_by_id($category)->name;
        }
        if (!is_numeric($subcategory_id) && $subcategory_id) {
            $subcategory_id = $this->product->find_subcategory_by_label($subcategory_id)->subcategory_id;
        }
//
        if ($subcategory_id && is_numeric($subcategory_id)) {
            $title_text .= ' / ' . $this->product->get_customer_subcategory_by_id($subcategory_id)->name;
        }
//        dd($title_text);
        return $title_text;
    }

    public function helper_show_filter($data)
    {

        $customer_name = $data['customer_name'] ?? '';
        $customer_type = $data['customer_type'] ?? '';
        $category = $data['category'] ?? '';
        $subcategory = $data['subcategory'] ?? '';

        $subcategory = $this->product->find_subcategory_by_label($subcategory) ?? '';

        $subcategory_id = $subcategory->subcategory_id ?? '';
        // dump($subcategory_id);

        return array(
            'customers' => $this->customers->get_customers_after_filter($customer_name, $customer_type, $category, $subcategory_id),
            'filter_title' => $this->helper_generate_title_after_filter($customer_type, $category, $subcategory_id),
            'type' => $customer_type,
            'category' => $category,
            'subcategory' => $subcategory_id
        );
    }


    public function show_subcategory_by_category_id(Request $request)
    {
        return $this->product->get_subcategory_by_category_id($request->input('category_id'));

    }

//    show customer coin
    public function show_coin_by_country($country_id)
    {
        $coin = array();
        if ($country_id == 1) {
            $coin['label'] = "LEI";
            $coin['id'] = $country_id;
        } else {
            $coin['label'] = "EURO";
            $coin['id'] = $country_id;

        }
        return $coin;
    }

    public function bills_value_calculated_ware($bills)
    {
        if (!$bills) {
            return false;
        }
        $j = 0;
        $bills_array = array();
        foreach ($bills as $bill) {
            $i = 0;
            foreach ($bill as $ware) {
                $ware = (array)$ware;


                if ($ware['coin'] == 1) {
                    $exchange = round($ware['price'] / $ware['exchange'], 3);
                    $ware['price_euro'] = $exchange;
                    $ware['price_lei'] = $ware['price'];


                    $ware['tva_lei_buc'] = round(($ware['price'] / 100) * $ware['tva'], 3);
                    $ware['tva_euro_buc'] = round(($exchange / 100) * $ware['tva'], 3);
                } else {
//                    dd($ware['price']);

                    $ware['tva_euro_buc'] = round(($ware['price'] / 100) * $ware['tva'], 3);
                    $exchange = round($ware['price'] * $ware['exchange'], 3);
                    $ware['price_euro'] = $ware['price'];
                    $ware['price_lei'] = $exchange;
                    $ware['tva_lei_buc'] = round(($exchange / 100) * $ware['tva'], 3);

                }

                $bills_array[$j][$i] = $ware;
                $i++;

            }
            $j++;
        }
//        dd($bills_array);

        return $bills_array;
    }

    public function customers_autocomplete(Request $request)
    {

        $res = $this->customers->get_customer_name_by_search($request->term, $request->category_id ?? '');

        return response()->json($res);
    }

    public function search_ware_name(Request $request)
    {

        $res = $this->wares->get_wares_suggestions_for_customer(
            $request->term,
            $request->row_name,
            $request->customer_id,
            $request->product_name_selected,
            $request->category_id,
        );

        return response()->json($res);
    }

    public function bills_autocomplete(Request $request)
    {
        $res = $this->bills->get_bills_to_autocomplete_suggestions(
            $request->term,
            $request->customer_id,
            $request->row_name,
            $request->ware_custom_code,
            $request->ware_product_name_selected,
            $request->bill_date
        );

        return response()->json($res);

    }

    public function find_textiles_filters(Request $request)
    {
        $res = $this->wares->get_wares_suggestions_for_customer($request->input('term'), $request->input('row_name'));
//        dd($request->input('row_name'));

        return response()->json($res);
    }

    public function find_market_product(Request $request)
    {

        $res = $this->templateParent->get_parent_template_product_by_suggestions($request->term);
//        dd($request->input());
        return response()->json($res);

    }

    public function template_child_validator(Request $request)
    {
        return response()->json($this->templateChild->validate_child_template_if_data_exists($request->form_customer));

    }

    public function customer_separe_categories_from_subcategories($customer)
    {
        if (!$customer['categories']) {
            return false;
        }

        $categories = [];

        foreach ($customer['categories'] as $category) {
            $categories[$category->category_id] = [
                'id' => $category->category_id,
                'name' => $category->category_name ?? '',
            ];
        }

        return $categories;
    }

}










