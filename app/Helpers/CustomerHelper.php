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
use Illuminate\Support\Facades\DB;


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
    public function helper_generate_title_after_filter($customer_name, $customer_type, $category)
    {
        if ($customer_type == 'provider') {
            $customer_type = "Furnizor";
        }

        if ($customer_type == 'customer') {
            $customer_type = 'Beneficiar';
        }

        $title_text = " ";

        if ($customer_name) {
            $title_text .= $customer_name;
        }

        if ($customer_name && $customer_type) {
            $title_text .= ' / ' . $customer_type;
        } elseif ($customer_type) {
            $title_text .= $customer_type;
        }

        if (($customer_name || $customer_type) && $category) {
            $title_text .= ' / ' . $this->product->get_customer_category_by_id($category)->name;
        } elseif ($category) {
            $title_text .= $this->product->get_customer_category_by_id($category)->name;
        }

        return $title_text;
    }

    public function helper_show_filter($data)
    {

        $customer_name = $data['customer_name'] ?? '';
        $customer_type = $data['type'] ?? '';
        $category = $data['category'] ?? '';

        return array(
            'filter_title' => $this->helper_generate_title_after_filter($customer_name, $customer_type, $category),
            'type' => $customer_type,
            'category' => $category,
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

                $ware['category_name'] = DB::table('furnace_categories')->select('name')->where('id', $ware['category_id'])->first();
                $ware['subcategory_name'] = DB::table('customer_subcategory')->select('name')->where('id', $ware['subcategory_id'])->first();
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

        return $bills_array;
    }

    public function customers_autocomplete(Request $request)
    {

        $res = null;
        $search = null;
        if ($request->search) {
            $search = $request->search;
        }
        if ($request->term) {
            $search = $request->term;
        }

        $customers = DB::table('customers')
            ->select('customers.id', 'customers.name')
            ->leftJoin('customer_category_id_subcategories', 'customer_category_id_subcategories.customer_id', 'customers.id');

        if ($request->subcategory_id && $request->category_id) {
            $customers = $customers
                ->where('customer_category_id_subcategories.category_id', $request->category_id)
                ->where('customer_category_id_subcategories.subcategory_id', $request->subcategory_id);
        }

        $customers = $customers
            ->where('customers.name', "LIKE", "%{$search}%")
            ->groupBy('customers.id', 'customers.name')
            ->orderBy('customers.name')
            ->get();

        foreach ($customers as $customer) {
            $res[] = array(
                "id" => $customer->id,
                "text" => $customer->name,
                "category_id" => $request->category_id ?? '',
            );
        }

        return response()->json($res);
    }

    public function search_ware_name(Request $request)
    {

        if (!$request->customer_id && !$request->category_id && !$request->subcategory_id) {
            return response()->json(false);
        }
        if ($request->row_name == 'custom_code' && !$request->product_name_selected) {
            return response()->json(false);
        }

        $wares = DB::table('customer_wares')
            ->select(
                'bills.id as bill_id',
                'customer_wares.id as ware_id',
                'customer_wares.product_name',
                'customer_wares.custom_code',
                'bills.bill_date',
                'bills.bill_number'
            )
            ->leftJoin('bills', 'bills.id', 'customer_wares.bill_id')
            ->where('customer_wares.product_name', 'LIKE', "%{$request->search}%")
            ->where('customer_wares.category_id', $request->category_id)
            ->where('customer_wares.subcategory_id', $request->subcategory_id)
            ->where('customer_wares.customer_id', $request->customer_id)
            ->get();

        $res = array();

        foreach ($wares as $ware) {
            $res[] = array(
                "id" => $ware->ware_id,
                "text" => 'Product name: ' . $ware->product_name . '/ Data facturii: ' . $ware->bill_date . '/ Custom code: ' . $ware->custom_code . '/ Numarul facturii: ' . $ware->bill_number,
            );
        }


        return response()->json($res);
    }

    public function bills_autocomplete(Request $request)
    {
        // dd($request->category_id);
        if (!$request->category_id) {
            return response()->json(false);
        }
        if ($request->category_id != 8) {

            $subcategories = DB::table('customer_subcategory')
                ->select('name', 'id')
                ->where('category_id', $request->category_id);

            if ($request->search) {
                $subcategories = $subcategories
                    ->where('name', 'LIKE', "%{$request->search}%");
            }
            $subcategories = $subcategories
                ->orderBy('name')
                ->get();
        }

        //get subcategories form textiles
        if ($request->category_id == 8) {
            $subcategories = DB::table('customer_wares')
                ->slect('composition')
                ->where('category_id', $request->category_id)
                ->get();
            // ->where('')
            // trebuie sa vad ce spune clientul
        }
        $res = array();

        foreach ($subcategories as $subcategory) {
            $res[] = array(
                "id" => $subcategory->id,
                "text" => $subcategory->name,
            );
        }

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
        $ware_exists_or_no = false;
        $form_ware = $request->form_customer;

        if ($form_ware['customer_id'] || $form_ware['category_id'] || $form_ware['ware_id']) {

            $ware_exists_or_no = DB::table('customer_wares')
                ->where('customer_id', $form_ware['customer_id'])
                ->where('category_id', $form_ware['category_id'])
                ->where('id', $form_ware['ware_id'])
                ->get();

            if ($ware_exists_or_no) {
                return response()->json(true);
            }
        }

        return response()->json(false);
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

    public function get_customer_coin(Request $request): bool|\Illuminate\Http\JsonResponse
    {
        $customer_id = $request->customer_id;

        if (!$customer_id) {
            return false;
        }
        $customer = $this->customers->get_customer_by_id($customer_id);
        $coin_name = $this->show_coin_by_country($customer->country);

        if ($coin_name) {
            return response()->json($coin_name);
        }
        return response()->json(false);
    }

    public function take_categories(): bool|\Illuminate\Http\JsonResponse
    {

        $categories = $this->product->get_furnace_categories();
        return response()->json($categories);
    }

    public function generate_title_by_filter_bills($customer_name, $bills_type, $start_date, $end_date)
    {

        if ($bills_type == 1) {
            $bills_type = "Proforma";
        } elseif ($bills_type == 2) {
            $bills_type = "Definitiva";
        }

        $bills_list_title = $customer_name ?? null;

        if ($customer_name && $bills_type) {
            $bills_list_title .= ' / ' . $bills_type;
        } elseif ($bills_type) {
            $bills_list_title .= $bills_type;
        }

        if (($customer_name || $bills_type) && ($start_date && $end_date)) {
            $bills_list_title .= ' / ' . $start_date;
            $bills_list_title .= ' / ' . $end_date;
        } elseif ($start_date && $end_date) {
            $bills_list_title .= $start_date;
            $bills_list_title .= ' / ' . $end_date;
        }

        return $bills_list_title;
    }

    public function subcategories_for_category(Request $request)
    {
        $query = DB::table('customer_subcategory')
            ->select('id', 'name')
            ->where('name', 'LIKE', "%$request->term%");
        if ($request->category_id) {
            $query
                ->where('category_id', $request->category_id);
        }

        return $query->limit(10)->orderBy('name')
            ->get();
    }

    public function helper_generate_title_after_filter_wares($name, $category, $subcategory)
    {
        if ($category) {
            $category = DB::table('furnace_categories')
                ->where('id', $category)
                ->select('name')
                ->first()->name;
        }

        if ($category && $name) {
            $name .= ' / ';
        }

        if ($subcategory && ($category || $name)) {
            $category .= ' / ';
        }

        $title = null;
        if ($name || $category || $subcategory)
            $title = "$name$category$subcategory";

        return $title;
    }

    public function helper_generate_title_after_filter_textile($data)
    {
        // dd($data);
        if ($data) {
            return
                $data['customer_name'] . $this->helper_if_exists_return_simbol($data['textiles_composition'], ' / ') .
                $data['textiles_composition'] . $this->helper_if_exists_return_simbol($data['textiles_material'], ' / ') .
                $data['textiles_material'] . $this->helper_if_exists_return_simbol($data['textiles_design'], ' / ') .
                $data['textiles_design'] . $this->helper_if_exists_return_simbol($data['textiles_color'], ' / ') .
                $data['textiles_color'] . $this->helper_if_exists_return_simbol($data['textiles_structure'], ' / ') .
                $data['textiles_structure'] . $this->helper_if_exists_return_simbol($data['textiles_weaving'], ' / ') .
                $data['textiles_weaving'] . $this->helper_if_exists_return_simbol($data['textiles_finishing'], ' / ') .
                $data['textiles_finishing'] . $this->helper_if_exists_return_simbol($data['textiles_rating'], ' / ') .
                $data['textiles_rating'];
        }
        return null;
    }

    private function helper_if_exists_return_simbol($value, $simbol)
    {
        if (isset($value)) {
            return $simbol;
        }
        return '';
    }
}
