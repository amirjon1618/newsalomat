<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import1c extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function scan()
	{
        $dir = "1c/import/";
        $scanned_directory = array_diff(scandir($dir), array('..', '.'));
        if ($this->is_dir_empty($dir, $scanned_directory)) {
          echo "Папка пуста"; 
        }else{
            foreach ($scanned_directory as $scanned_file) {
                $this->importJson($scanned_file);
            }
            echo 'Завершено';
        }  
	}
	
	private function importJson($file)
	{	
        $this->load->model("product");
        $imported_array = json_decode(file_get_contents('1c/import/' . $file), true);
        //print_r($imported_array);
        foreach ($imported_array['Остатки'] as $imported_item) {
            
            $arr = array("product_name" => $imported_item["Номенклатура"],
                        "product_price" => str_replace(',','.', $imported_item["Цена"]), //$imported_item["Цена"], //,
                        "total_count_in_store" => $imported_item["Количество"],
                        "product_articule" => $imported_item['Артикул']);
            $this->product->import_from_json($arr);
            
           // if($arr[''])
            //print_r($imported_item);
        }
        unlink('1c/import/' . $file);
    }

    private function is_dir_empty($dir, $arr) {
       if (!file_exists($dir) || sizeof($arr) == 0) {
            return true; 
       } else {
           return false;
       }
    }
}