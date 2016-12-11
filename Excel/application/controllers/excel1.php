<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class excel1 extends CI_Controller
{
    //使用phpexcel导出
    public function index()
    {
        //echo $table_name;
       /* $table_name = $this->uri->segment(3,1);*/
        $table_name='images';
        $query = $this ->db -> get($table_name);
        if(!$query)return false;
        // StartingthePHPExcellibrary
        $this->load->library('PHPExcel');
        $this ->load ->library('PHPExcel/IOFactory');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()-> setTitle("export") -> setDescription("none");
        $objPHPExcel -> setActiveSheetIndex(0);
        // Fieldnamesinthefirstrow
        $fields = $query -> list_fields();
       /* $col = 0;
        foreach($fields as $field){
            $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($col, 1,$field);
            $col++;
        }*/
        // Fetchingthetabledata
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$data->$field);
                $col++;
            }
            $row++;
        }
        $objPHPExcel -> setActiveSheetIndex(0);
        $objWriter = IOFactory :: createWriter($objPHPExcel, 'Excel5');
        // Sendingheaderstoforcetheusertodownloadthefile
        header('Content-Type:application/vnd.ms-excel');
        //header('Content-Disposition:attachment;filename="Products_' . date('dMy') . '.xls"');
        header('Content-Disposition:attachment;filename="'.$table_name . '_' . date('Y-m-d') . '.xls"');
        header('Cache-Control:max-age=0');
        $objWriter -> save('php://output');
    }

    //phpexcel导入到数据库
    public function daoru(){
        //设置导入的数据 excel文件
        $filename = "public/images_2016-06-01.xls";
        $this ->load ->library('PHPExcel/IOFactory');
        $objReader = IOFactory::createReader('Excel5');
        $objReader->setReadDataOnly(true);
        //加载load方法
        $objPHPExcel = $objReader->load($filename);
        //print_r($objPHPExcel);exit;
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow();
        //echo $highestRow;
        //echo $highestRow;
        $highestColumn = $objWorksheet->getHighestColumn();
        //echo $highestColumn;exit;
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        //定义一个空数组
        $excelData = array();
        //循环把excel数据存在数组中
        for($row = 1; $row <= $highestRow; $row++) {
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $excelData[$row][]=(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
        }
       // var_dump($excelData);die;
        //添加数据
        foreach($excelData as $key=>$val){
            if($key!=1){
                $sql = "insert into images values(null,'$val[1]')";
                $this->db->query($sql);
            }

        }

    }
}