<?php
define('BASE_PATH', __DIR__);

if (!empty($_POST['data'])){
    processData($_POST['data']);
}else{
    die('要输入东西啊！');
}

function processData($data)
{
    $data = preg_replace('/\r\n(\w*)\r\n/', '${1} ', $data);
    $data = preg_replace('/\s(\d{1,3})\s/', '\r\n${1} ', $data);

    $data = array_filter(explode('\r\n', $data));
    $result = array();
    foreach($data as $v)
    {
        $result[] = explode(' ', $v);
    }
    exportExcel($result, 'fapiao');
}

function exportExcel($data, $sheetName)
{
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:filename={$sheetName}.xls");
    if (!empty($data))
    {
       echo "<head><style>table td,th{vnd.ms-excel.numberformat:@;text-align: center; width:140px;border-top:1px solid #000;border-left:1px solid #000} table th{color:red}</style></head><table>";
       echo "<tr><td>序号</td><td>发票代码</td><td>发票号码</td><td>开票日期</td><td>销货方税号</td><td>金额</td><td>税额</td></tr>";
       foreach($data as $v)
       {
           $str = '<tr>';
           foreach($v as $col)
           {
               $str .= "<td>{$col}</td>";
           }
           echo $str . "</tr>";
       }
       echo '</table>';
    }
}



