<?php
class EXCEL
{
    /**
    * 生成EXCEL
    *
    * @param	int				$batch							要生成的卡片批次号
    * @param    int             $randLength                     随机字符长度
    * @param    int             $uniqueLength                   Unique字符长度 10< 长度 <=23
    * @return   string
    */
    public function makeExcel($data,$columnName = array(),$isSave = false,$fileName = 'excel',$path='/',$cellwidth = array(),$isborder = false)
    {	
		$styleArray = array(  
			'borders' => array(  
				'allborders' => array(  
					//'style' => PHPExcel_Style_Border::BORDER_THICK,//边框是粗的  
					'style' => PHPExcel_Style_Border::BORDER_THIN,//细边框  
					//'color' => array('argb' => 'FFFF0000'),  
				),  
			),  
		);  

        // 创建一个处理对象实例   
        $objPHPExcel = new PHPExcel();   
        // 创建文件格式写入对象实例, uncomment
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("PHPExcel Test Document")
							 ->setSubject("PHPExcel Test Document")
							 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
							 ->setKeywords("office PHPExcel php")
							 ->setCategory("Test result file");
  
        $sheet0 = $objPHPExcel->setActiveSheetIndex(0);
        //设置列宽
		$countColu = count($data['0']);
        for($m=1;$m<=$countColu;$m++){
            $coName = $this->columnToABC($m);
			if(!empty($cellwidth)){
				$sheet0 ->getColumnDimension($coName)->setWidth($cellwidth[$m-1]);
			}else{
				$sheet0 ->getColumnDimension($coName)->setWidth(20);
			}
            //$sheet0 ->getColumnDimension($coName)->setAutoSize(true);  
        }
        // 单元格密码保护不让修改
        $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); 
        if(empty($columnName)){
            $row = 1;
        }elseif(!empty($columnName)&&count($columnName)==$countColu){
            $co=1;
            //print_r($eachRow);
            foreach($columnName as $kItemV){
                $coName = $this->columnToABC($co);
                //echo $coName.$row.':'.$kItemV.'<br>';
                
                $sheet0->setCellValueExplicit($coName.'1',$kItemV,PHPExcel_Cell_DataType::TYPE_STRING);
				if($isborder){
					$sheet0->getStyle($coName.'1')->applyFromArray($styleArray);
				}
                $co ++;
            }
            $row = 2;
        }else{
            die('列名与数据列数量不一致');
        }
        foreach($data as $eachRow){
            $co=1;
            //print_r($cellwidth);die();
            foreach($eachRow as $kItemV){
                $coName = $this->columnToABC($co);
                //echo $coName.$row.':'.$kItemV.'<br>';
                $sheet0->setCellValueExplicit($coName.$row,$kItemV,PHPExcel_Cell_DataType::TYPE_STRING);
				if(!empty($cellwidth)){
					$sheet0->getStyle($coName.$row)->applyFromArray($styleArray);
				}
                $co ++;
            }
            $row ++;
        }
		
        $objPHPExcel->getActiveSheet()->setTitle('Sheet0');
		$temparr = explode('.',$fileName);
		$ext = count($temparr) > 0 ? $temparr[count($temparr) - 1] : '';
			
        if($isSave){
			if($ext == 'xls'){
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
			}else{
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
			}
            $objWriter->save($path.$fileName);
        }else{
			// Redirect data to a client’s web browser (Excel2007)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;');
			//header('Content-Type: application/vnd.ms-excel; charset=utf-8'); 
			$ua = $_SERVER["HTTP_USER_AGENT"]; 
			
			//var_dump($ua);die();
			if (preg_match("/MSIE/", $ua) || preg_match("/Trident/", $ua) ) { 
				header('Content-Disposition: attachment;filename="'.urlencode($fileName).'"');
			}else{
				header('Content-Disposition: attachment;filename="'.$fileName.'"');
			}
            header('Cache-Control: max-age=0');
			
			
			if($ext == 'xls'){
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			}else{
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			}
            $objWriter->save('php://output');
        }
    }
    
    /**
    * 生成EXCEL
    *
    * @param	int		$columnNum			        第n列 n>=1
    * @return   string
    */
    private function columnToABC($columnNum)
    {
        $result = '';
        $ABC = array('1'=>'A','2'=>'B','3'=>'C','4'=>'D','5'=>'E','6'=>'F','7'=>'G','8'=>'H','9'=>'I',
                     '10'=>'J','11'=>'K','12'=>'L','13'=>'M','14'=>'N','15'=>'O','16'=>'P','17'=>'Q','18'=>'R','19'=>'S',
                     '20'=>'T','21'=>'U','22'=>'V','23'=>'W','24'=>'X','25'=>'Y','26'=>'Z',
					 '27'=>'AA','28'=>'AB','29'=>'AC','30'=>'AD','31'=>'AE','32'=>'AF','33'=>'AG','34'=>'AH','35'=>'AI',
					 );
        if($columnNum >0&&$columnNum<26){
                $key = $columnNum % 26;
                $result = $ABC[$key];            
        }elseif($columnNum >=26&&$columnNum<=35){
				$key = $columnNum;
				$result = $ABC[$key]; 
		}else{
            die('数据列超过35行');
        }
        return $result;
    }

	/**
    * 读取EXCEL
    *
    * @param	int		$columnNum			        第n列 n>=1
    * @return   array
    */
	public function readExcel2Array($filePath,$sheet = 0,$row = 1,$columnLen=1,$columns = array())
	{
	
	    if(!file_exists($filePath)){
			return array();
		}
		$fileType = PHPExcel_IOFactory::identify($filePath); //文件名自动判断文件类型
		$objReader = PHPExcel_IOFactory::createReader($fileType);
		$objPHPExcel = $objReader->load($filePath);
		$currentSheet = $objPHPExcel->getSheet($sheet); //第一个工作簿
		$allRow = $currentSheet->getHighestRow(); //行数
		$data = array();
		for($currentRow = $row;$currentRow<=$allRow;$currentRow++){ 
			for($colum = 1;$colum <= $columnLen;$colum++){
				$coName = $this->columnToABC($colum);
				if(in_array($coName,$columns)){
					//$v = $currentSheet->getCellByColumnAndRow($coName,$currentRow)->getFormattedValue();  
					$v = $currentSheet->getCell($coName.$currentRow)->getFormattedValue();
					//echo $v;die();
				}else{
					$v = (string)$currentSheet->getCell($coName.$currentRow)->getValue();
				}
				
				if(!empty($v))
					$data[$currentRow][$colum] = $v;
			}
		}
		//var_dump($data);die();
		return $data;
	}
	
	/**
    * 读取 tsv
	*/
	public function readTsv2Array($path)
	{
		$data = array();
		if(file_exists($path)){
		   $fp = fopen($path,'r');
		   while(!feof($fp)){
			   $str = fgets($fp);     
			   $data[] = explode("\t", $str);
		   } 
		}
		return $data;
	}

}
