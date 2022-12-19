<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export1c extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
	}
	
	private $link_1c_file = '1c/export/orders.json';

	public function Orders()
	{
		if(!file_exists($this->link_1c_file)) {
			$this->load->model('order');
			$sells = $this->order->get_prods_for_export();
			
			//print_r($sells);
			if (sizeof($sells) != 0) {
				$result = array();
				foreach ($sells as $element) {
					$result['S'.$element['order_id']][] = $element;
				}

				
				//print_r($result);

				$a = null;

				foreach ($result as $sell) {
					$newArr = [];
        			date_default_timezone_set('Asia/Dushanbe');
        			$now_date = date('Y-m-d H:i:s');
					// $now = date('Y-m-d H:i:s');
					$newArr['ДатаФормирования'] = $now_date;
					$newArr['Остатки'] = $sell;
					$a[] = $newArr;
				}

			
				$this->exportJson($result);
			}
			// if (file_exists('sells.xml')) {
			// 	$xml = simplexml_load_file('sells.xml');

			// 	foreach($sells as $v)
			// 	{
			// 		$xml = $this->addXml("123", $v['product_articule'], $v['product_name'], $v['product_sold_price'], $v["total_count"], $xml);
			// 	}

			// 	$str_xml = $xml->asXML();

			// 	$this->load->helper('file');

			// 	if (!write_file('xml_order/offers_'.time().'.xml', $str_xml))
			// 	{
			// 		echo 'Unable to write the file';
			// 	}
			// 	else
			// 	{
			// 		echo 'File written!';
			// 		foreach($sells as $sell) {
			// 			$this->order->update_export($sell['order_id']);
			// 		}
			// 	}


			// } else {
			// 	exit('Failed to open test.xml.');
			// }
			// //exit('No data to export');
		} else {
			exit('No data to export');
		}
	}

	private function addXml($ID, $Artikul, $Product_name, $Price, $Count, $xml)
	{
		$ID = "123";
		$sells = $xml->ПакетПредложений->Предложения->addChild("Предложение");
		$sells->addChild("Ид", $ID);
		$sells->addChild("Артикул", $Artikul);
		$sells->addChild("Наименование", $Product_name);
		$baseC = $sells->addChild("БазоваяЕдиница");
		$baseC->addAttribute("Код", 796);
		$baseC->addAttribute("НаименованиеПолное", "Штука");
		$baseC->addAttribute("МеждународноеСокращение", "PCE");
		$baseC1 = $baseC->addChild("Пересчет");
		$baseC1->addChild("Единица", 796);
		$baseC1->addChild("Коэффициент", 1);
		$priceS = $sells->addChild("Цены");
		$priceS = $priceS->addChild("Цена");
		$priceS->addChild("Представление", " ".$Price." RUB за шт");
		$priceS->addChild("ИдТипаЦены", "659fefbf-0a13-11eb-8da4-d45d64237257");
		$priceS->addChild("ЦенаЗаЕдиницу", $Price);
		$priceS->addChild("Валюта", "RUB");
		$priceS->addChild("Коэффициент", 1);

		$sells->addChild("Количество", $Count);
		$Sklad = $sells->addChild("Склад");
		$Sklad->addAttribute("ИдСклада", "d0feea77-266f-4cfa-b3c6-5ec4ec35ba52");
		$Sklad->addAttribute("КоличествоНаСкладе", $Count);

		return $xml;
	}
	private function exportJson($array)
	{	
		
		$this->load->helper('file');
		// $fp = fopen('./order_'. $array['Остатки'][0]['order_id'].'_'.time() .'.json', 'w');
		file_put_contents($this->link_1c_file, json_encode($array, JSON_UNESCAPED_UNICODE));
		
		// if ( ! write_file('json_order/order_'. $array['Остатки'][0]['order_id'].'_'.time() .'.json', json_encode($array)))
        // {
        //     echo 'Unable to write the file';
        // }
        // else
        // {
			foreach($array as $id => $arr) {
				$this->order->update_export($id);
			}
            echo 'file written';
        // }
	}
}