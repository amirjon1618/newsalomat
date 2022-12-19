<?php

class Order extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }

    public function get_all_orders()
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('order');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            // if ($row['cash_type']) {
            //     if ($row['cash_type'] == 'cash') {
            //         $row['cash_type'] = 'Наличными';
            //     } else {
            //         $row['cash_type'] = 'Онлайн Кошелёк';
            //     }
            // }
            $or_st = $this->get_order_status($row['status_id']);
            $row['status'] = isset($or_st['status_text']) ? $or_st['status_text'] : '';
            unset($row['status_id']);
            unset($row['hash']);
            $array[] = $row;
        }
        return $array;
    }

    private $order_per_page_admin = 30;
    public function get_all($current_page, $order_inp, $stat_id, $order_date, $order_date_sort)
    {
        $this->load->model('delivery');

        $array = array('base_url' => base_url());
        $this->db->select("COUNT(*) as total_orders");
        $this->db->from('order');
        if ($order_inp != '') {
            $this->db->where("(id LIKE '%" . $order_inp . "%' or phone_number LIKE '%" . $order_inp . "%' or full_name LIKE '%" . $order_inp . "%')");
        }
        if ($stat_id != '') {
            $this->db->where('status_id', $stat_id);
        }
        if ($order_date != '') {
            $from = new DateTime($order_date);
            $to = new DateTime($order_date);
            $to->modify('+1 day');
            $this->db->where('created_at >=', date_format($from, 'Y-m-d H:i:s'));
            $this->db->where('created_at <=', date_format($to, 'Y-m-d H:i:s'));
        }
        
        $qq = $this->db->get();

        $total_pages = 0;
        foreach ($qq->result_array() as $row) {
            if ($row['total_orders'] > 0)
                $total_pages = ceil($row['total_orders'] / $this->order_per_page_admin);
        }

        $linkk = base_url("index.php/admin/orders/?");
        $pages = array();
        if ($order_inp != '') {
            $linkk = $linkk . "order_inp=" . $order_inp . '&';
        }
        if ($stat_id != '') {
            $linkk = $linkk . "stat_id=" . $stat_id . '&';
        }
        if ($order_date != '') {
            $linkk = $linkk . "order_date=" . $order_date . '&';
        }
        if ($order_date_sort != '') {
            $linkk = $linkk . "order_date_sort=" . $order_date_sort . '&';
        }

        $linkk = $linkk . "page=";
        $array['link'] = $linkk;

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $current_page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => 'active'
                );
            } else {
                $pages[] = array(
                    "page" => $i,
                    "current_page" => $current_page,
                    "total_pages" => $total_pages,
                    "base_url" => base_url(),
                    "link" => $linkk,
                    "current" => ''
                );
            }
        }
        $rr = $this->filter_pages($pages);
        $array['pages'] = $rr;

        if ($current_page > 1 & $current_page <= $total_pages) {
            $array['prev_page'] = $current_page - 1;
        }
        if ($current_page < $total_pages) {
            $array['next_page'] = $current_page + 1;
        }
        if ($current_page <= $total_pages) {
            $this->db->select('*');
            $this->db->from('order');
            if ($order_inp != '') {
                $this->db->where("(id LIKE '%" . $order_inp . "%' or phone_number LIKE '%" . $order_inp . "%' or full_name LIKE '%" . $order_inp . "%')");
            }
            if ($stat_id != '') {
                $this->db->where('status_id', $stat_id);
            }
            if ($order_date != '') {
                $from = new DateTime($order_date);
                $to = new DateTime($order_date);
                $to->modify('+1 day');
                $this->db->where('created_at >=', date_format($from, 'Y-m-d H:i:s'));
                $this->db->where('created_at <=', date_format($to, 'Y-m-d H:i:s'));
            }
            $this->db->join("delivery", "delivery.delivery_id = order.delivery_type");
            $this->db->limit($this->order_per_page_admin, ($current_page - 1) * $this->order_per_page_admin);
            if ($order_date_sort != '') {
                $this->db->order_by('created_at', $order_date_sort);
            } else {
                $this->db->order_by('id', 'desc');
            }
            $query = $this->db->get();
            foreach ($query->result_array() as $row) {
                $row['base_url'] = base_url();
                // if ($row['cash_type']) {
                //     if ($row['cash_type'] == 'cash') {
                //         $row['cash_type'] = 'Наличными';
                //     } else {
                //         $row['cash_type'] = 'Онлайн Кошелёк';
                //     }
                //  }
                $or_st = $this->get_order_status($row['status_id']);
                $row['status'] = isset($or_st['status_text']) ? $or_st['status_text'] : '';
                $row['status_color'] = isset($or_st['status_color']) ? $or_st['status_color'] : 'white';
                $array['orders'][] = $row;
            }
        } else {
            $array['orders'] = [];
        }
        return $array;
    }

    public function get($id)
    {
        $this->db->select('*');
        $this->db->from('order');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array()[0];
    }

    public function getForStatic()
    {
        $this->db->select('*');
        $this->db->from('order');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_order_status($id)
    {
        $array = array('base_url' => base_url());
        $this->db->select('*');
        $this->db->from('status');
        $this->db->where('id', $id);
        $q = $this->db->get();
        foreach ($q->result_array() as $row) {
            $array = $row;
        }
        return $array;
    }

    public function get_order_prods($id)
    {
        $array = array();
        $this->db->select('
            product_order.order_id,
            product_order.total_count,
            product_order.product_sold_price as product_price,
            product_order.product_id,
            product.product_name,
        ');
        $this->db->from('product_order');
        $this->db->where('product_order.order_id', $id);
        $this->db->join('product', 'product.id = product_order.product_id');
        $res = $this->db->get();
        foreach ($res->result_array() as $row) {
            if ($row['product_name'] != '' && $row['product_price'] != '') {
                $row['base_url'] = base_url();
                $array[] = $row;
            }
        }
        return $array;
    }

    public function get_order_prods_by_hash($hash)
    {
        $this->load->model("delivery");
        $array = array();
        $this->db->select('*');
        $this->db->from('order');
        $this->db->where('hash', $hash);
        $this->db->where('status_id != -1');
        $q = $this->db->get();
        foreach ($q->result_array() as $row) {
             
            $array = $this->get_order_prods($row['id']);
            $array['order_date'] = $row['created_at'];
            $array['delivery_info'] = $this->delivery->get($row["delivery_type"]); 
        }
        return $array;
    }

    public function change_status($order_id, $status_id)
    {
        if ($status_id == -1) {
            $this->db->select('*');
            $this->db->from('product_order');
            $this->db->where('order_id', $order_id);
            $q = $this->db->get();
            $order_prods = $q->result_array();
            $prod_ids = array();
            foreach ($order_prods as $order_prod) {
                $prod_ids[] = $order_prod['product_id'];
            }
            $this->db->select('product.id, product.total_count_in_store');
            $this->db->from('product');
            $this->db->where_in('id', $prod_ids);
            $q2 = $this->db->get();
            foreach ($q2->result_array() as $q_row) {
                for ($i = 0; $i < sizeof($order_prods); $i++) {
                    if ($q_row['id'] == $order_prods[$i]['product_id']) {
                        $count = floatval($q_row['total_count_in_store']) + floatval(($order_prods[$i]['total_count']));
                        $this->db->set('total_count_in_store', $count);
                        $this->db->where('id', $q_row['id']);
                        $this->db->update('product');
                    }
                }
            }
        }
        $this->db->update('order', array('status_id' => $status_id), array('id' => $order_id));
        return 1;
    }

    public function add($array)
    {

        // date_default_timezone_set('Asia/Dushanbe');
        // $created_at = date('Y-m-d H:i:s');
        if (!isset($array['wallet_name'])) {
            $array['wallet_name'] = "";
        }
        $new_arr = array(
            'total_price'  =>  $array['total_price'],
            'full_name' => $array['name'],
            'phone_number' => $array['phone_number'],
            'address' => $array['address'],
            'comment' => $array['comment'],
            'wallet_name' => $array['wallet_name'],
            'delivery_type' => $array['delivery_id'],
            // 'cash_type' => $array['cash_type'],
            'code' => $array['code'],
            'status_id' => 1
            // 'created_at' => $created_at
        );
        $this->db->insert('order', $new_arr);
        // print_r($new_arr);
        // print_r($this->db->last_query());
        $id = $this->db->insert_id();
        $err = $this->db->error();;

        if ($err['code'] != 0) {
            return array('stat' => -1);
        }
        foreach ($array['products'] as $product) {
            $this->db->select('*');
            $this->db->from('product');
            $this->db->where('id', $product['product_id']);
            $q = $this->db->get();
            $order_prods = $q->result_array();
            $another_arr = array(
                'product_id' => $product['product_id'],
                'order_id' => $id,
                'total_count' => $product['product_count'],
                'product_sold_price' => $order_prods[0]['product_price']
            );
            $this->db->insert('product_order', $another_arr);

            $count = floatval($array['product_total_count']) - floatval(($product['product_count']));
            $this->db->set('total_count_in_store', $count);
            $this->db->where('id', $product['product_id']);
            $this->db->update('product');
        }
        $arr2 = array('stat' => 1, 'order_id' => $id);

        return $arr2;
    }

    public function row_add($array)
    {

        // date_default_timezone_set('Asia/Dushanbe');
        // $created_at = date('Y-m-d H:i:s');
        if (!isset($array->wallet_name)) {
            $array->wallet_name = "";
        }
        $new_arr = array(
            'total_price'  =>  $array->total_price,
            'full_name' => $array->name,
            'phone_number' => $array->phone_number,
            'address' => $array->address,
            'comment' => $array->comment,
            'wallet_name' => $array->wallet_name,
            'delivery_type' => $array->delivery_id,
            // 'cash_type' => $array['cash_type'],
            'code' => $array->code,
            'status_id' => 1
            // 'created_at' => $created_at
        );
        $this->db->insert('order', $new_arr);
        // print_r($new_arr);
        // print_r($this->db->last_query());
        $id = $this->db->insert_id();
        $err = $this->db->error();;

        if ($err['code'] != 0) {
            return array('stat' => -1);
        }
        foreach ($array->products as $product) {
            $this->db->select('*');
            $this->db->from('product');
            $this->db->where('id', $product->product_id);
            $q = $this->db->get();
            $order_prods = $q->result_array();
            $another_arr = array(
                'product_id' => $product->product_id,
                'order_id' => $id,
                'total_count' => $product->product_count,
                'product_sold_price' => $order_prods[0]['product_price']
            );
            $this->db->insert('product_order', $another_arr);

            $count = floatval($array->product_total_count) - floatval(($product->product_count));
            $this->db->set('total_count_in_store', $count);
            $this->db->where('id', $product->product_id);
            $this->db->update('product');
        }
        $arr2 = array('stat' => 1, 'order_id' => $id);

        return $arr2;
    }

    public function add_order_admin($array)
    {
        $new_arr = array(
            'full_name' => $array['name'],
            'phone_number' => $array['phone_number'],
            'address' => $array['address'],
            'comment' => $array['comment'],
            // 'cash_type' => $array['cash_type'],
            'code' => $array['code'],
            'status_id' => 0
        );
        $this->db->insert('order', $new_arr);
        $id = $this->db->insert_id();
        $err = $this->db->error();;

        if ($err['code'] != 0) {
            return array('stat' => -1);
        }
        foreach ($array['products'] as $product) {
            $another_arr = array(
                'product_id' => $product['id'],
                'order_id' => $id,
                'total_count' => $product['count']
            );
            $this->db->insert('product_order', $another_arr);

            $count = floatval($product['total_count_in_store']) - floatval(($product['count']));
            $this->db->set('total_count_in_store', $count);
            $this->db->where('id', $product['id']);
            $this->db->update('product');
        }
        $arr2 = array('stat' => 1, 'order_id' => $id);

        return $arr2;
    }

    public function hash_pass($str)
    {
        return md5("ffxKS&@)|_'a" . $str);
    }

    // public function get_by_delivery($id)
    // {
    //     $status = $this->get_status();

    // 	$array = array();
    //     $this->db->select("*");
    // 	$this->db->where('delivery_id', $id);
    //     $this->db->from('history');
    //     $query = $this->db->get();
    //     foreach($query->result_array() as $row)
    //     {
    //         $row['history_status_str'] = $status[$row['history_status']];
    //         $array[] = $row;
    //     }
    //     return $array;
    // }

    public function update($id, $array)
    {
        $this->db->update('order', $array, array('id' => $id));
    }

    public function check_order($id, $phone, $code)
    {
        $this->db->select('*');
        $this->db->from('order');
        $this->db->where('id', $id);
        $this->db->where('phone_number', $phone);
        $this->db->where('code', $code);
        $query = $this->db->get();
        $answer = $query->result_array();
        if (sizeof($answer) == 0) {
            return 0;
        } else {
            $hash = $this->hash_pass($id);
            $this->db->update('order', array('hash' => $hash), array('id' => $id));
            return 1;
        }
    }

    public function save_user_order_status_change($user_id, $order_id, $previous_status_id, $status_id, $user_comment)
    {
        $array = array(
            'user_id' => $user_id,
            'order_id' => $order_id,
            'previous_status_id' => $previous_status_id,
            'status_id' => $status_id,
            'user_comment' => $user_comment
            // 'created_at' => $created_at
        );
        $this->db->insert('user_order', $array);
    }

    public function get_all_user_changes($order_id)
    {
        $array = array();
        $query = $this->db->query(
            'SELECT uo.id AS user_order_id, uo.user_id, users.login AS user_login, users.name AS user_name, users.access AS user_access, uo.order_id, st.id AS previous_status_id, st.status_text AS previous_status_text, st2.id AS status_id, st2.status_text AS status_text, uo.user_comment, uo.created_at 
            FROM `user_order` AS uo 
            INNER JOIN status AS st2 ON uo.status_id=st2.id 
            INNER JOIN status AS st ON uo.previous_status_id=st.id 
            INNER JOIN users ON uo.user_id = users.user_id WHERE order_id=' . $order_id . ' ORDER BY uo.created_at DESC'
        );
        foreach ($query->result_array() as $row) {
            $row['base_url'] = base_url();
            $array[] = $row;
        }
        return $array;
    }

    public function get_user($order_id)
    {
        $this->db->select('*');
        $this->db->from('user_order');
        $this->db->where('order_id', $order_id);
        $this->db->join('users', 'users.user_id = user_order.user_id');
        $query = $this->db->get();
        $array = [];
        foreach ($query->result_array() as $row) {
            $array[] = $row;
        }
        return $array;
    }

    public function filter_pages($arr)
    {
        if (sizeof($arr) > 3) {
            $new_arr = array();
            if ($arr[0]['current'] == 'active') {
                $new_arr[] = $arr[0];
                $new_arr[] = $arr[1];
                $new_arr[] = $arr[2];
            } else if ($arr[sizeof($arr) - 1]['current'] == 'active') {
                $new_arr[] = $arr[sizeof($arr) - 3];
                $new_arr[] = $arr[sizeof($arr) - 2];
                $new_arr[] = $arr[sizeof($arr) - 1];
            } else {
                for ($i = 0; $i < sizeof($arr); $i++) {
                    if ($arr[$i]['current'] == 'active') {
                        $new_arr[] = $arr[$i - 1];
                        $new_arr[] = $arr[$i];
                        $new_arr[] = $arr[$i + 1];
                        break;
                    }
                }
            }
            return $new_arr;
        } else {
            return $arr;
        }
    }
    public function get_all_waiting()
    {
        $array = array();
        $this->db->select('*');
        $this->db->from('order');
        $this->db->where('status_id', 1);
        $result = $this->db->get();
        foreach ($result->result_array() as $row) {
            $array[] = $row;
        }
        return $array;
    }

    public function update_order_code($id, $code)
    {
        $this->db->update('order', array('code' => $code), array('id' => $id));
    }
    public function update_transaction_id($id, $tr_id)
    {
        $this->db->update('order', array('transaction_id' => $tr_id), array('id' => $id));
    }

    public function get_prods_for_export() 
    {
        $this->db->select('product.product_articule as "Артикул", product.product_name as "Номенклатура", product_order.total_count as "Количество", product_order.product_sold_price as "Цена", product_order.order_id');
        $this->db->from('order');
        $this->db->join('product_order', 'product_order.order_id = order.id');
        $this->db->join('product', 'product.id = product_order.product_id');
        $this->db->where('order.status_id', 1);
        $this->db->where('order.export', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function update_export($id)
    {
        $this->db->update('order', array('export' => 1), array('id' => $id));
    }

    public function user_orders($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_order');
        $this->db->order_by("order_id", "desc");
        $this->db->where('user_id', $user_id);
        $this->db->join('order', 'user_order.order_id = order.id');
        $query = $this->db->get();
        $order = $query->result();

        foreach ($order as $item) {
            $this->db->select('*');
            $this->db->from('product_order');
            $this->db->where('order_id', $item->id);
            $this->db->join('product', 'product_order.product_id = product.id');
            $this->db->order_by('order_id ASC');
            $product = $this->db->get();
            if ($product) {
                $this->db->select('delivery_price');
                $this->db->from('delivery');
                $this->db->where('delivery_id', $item->delivery_type);
                $delivery = $this->db->get();
            }
            if ($product) {
                $this->db->select('status_text');
                $this->db->from('status');
                $this->db->where('id', $item->status_id);
                $status = $this->db->get();
            }
            $order_product[] = [
                'order' => $item,
                'status' => $status->result(),
                'delivery' => $delivery->result(),
                'products' => $product->result()
            ];
        }
        return $order_product??null;
    }
}
