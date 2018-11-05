<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class csv extends MX_Controller {



    public function __construct() {

        parent::__construct();

        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

        $this->load->model('model_csv');

        $this->load->library('session');

          $this->load->library('image_lib');

    }


	public function export_csv()
	{
	
	$this->load->dbutil(); // call db utility library
	$this->load->helper('download'); // call download helper
 
	$query = $this->db->query("SELECT * FROM users"); // whatever you want to export to CSV, just select in query
	
	$filename = 'dumpexport.csv'; // name of csv file to download with data
	force_download($filename, $this->dbutil->csv_from_result($query)); // download file
		 
	}

      public function manage_brand()

     {

       $fields="*";

        $cond="bIsdelete = 0";

        $order_by="brand_id desc";

        $brands = $this->model_csv->getData("brand",$fields,$cond,$join,$order_by);



         $data['brands'] = $brands;



         $this->load->view("brand_list", $data);

     }



    public function user_import()

    {

        $this->load->view("user_import");

    }

    public function product_import()

    {

       $this->load->view("product_import");

    }





    public function user_import_action()

    {

        $postvar = $this->input->post();





        if(!empty($_FILES))

        {

          $filename = $_FILES['csv']['name'];



           if($filename != '')

          {

            $file_name = trim(basename(stripslashes($filename)), ".\x00..\x20");

            $file_name = str_replace(" ", "", $file_name);

            $file_name_array = explode('.',$file_name);





            $newfilename = time().$file_name_array[0].".".$file_name_array[1];

            move_uploaded_file($_FILES["csv"]["tmp_name"],CSV_USER_PATH.$newfilename);



            $file=$_FILES['csvfile']['tmp_name'];

            $file_path= CSV_USER_PATH.$newfilename;



          }

            $csv_array=$this->csv_to_array($file_path);

             $error=$this->users($csv_array);



              $this->session->set_flashdata('success', 'Consumer Import successfully');



              redirect("consumer_list");

        }







          $id = $this->model_csv->insert("brand", $val);



             $this->session->set_flashdata('success', 'Brand Added successfully');



           redirect("manage_brand");



    }





    public function product_import_action()

    {

           $postvar = $this->input->post();





        if($_FILES['csv']['name'])

        {

          $filename = $_FILES['csv']['name'];



           if($filename != '')

          {

            $file_name = trim(basename(stripslashes($filename)), ".\x00..\x20");

            $file_name = str_replace(" ", "", $file_name);

            $file_name_array = explode('.',$file_name);





            $newfilename = time().$file_name_array[0].".".$file_name_array[1];

            move_uploaded_file($_FILES["csv"]["tmp_name"],CSV_PRODUCT_PATH.$newfilename);



            $file=$_FILES['csvfile']['tmp_name'];

            $file_path= CSV_PRODUCT_PATH.$newfilename;



          }

            $csv_array=$this->csv_to_array($file_path);



            $this->brand($csv_array);

            $this->category($csv_array);

            $this->sub_category($csv_array);

            $this->product($csv_array);



              $this->session->set_flashdata('success', 'Product Import successfully');



              redirect("product_list");

        }
        else
        {
            $this->session->set_flashdata('failure', 'Please Select CSV');
              redirect("product_import");
        }








    }





       public function product_export()
    {
          $sql = $this->db->query("SELECT p.product_id, p.product_english_name AS product_name, b.brand_name AS product_brand_id,c.category_english_name AS product_category, pb.productbunch_english_name AS product_subcategory
          , p.subproduct_id, p.subproduct_total, ut.display_name AS unit_type, p.product_description, p.product_image, p.product_order, p.product_status, p.mrp, p.discount_percentage, p.discounted_price, p.quantity, p.unit_value,p.product_timestamp, p.admin_id, p.min_sale_qty, p.max_sale_qty FROM product AS p LEFT JOIN brand AS b ON(b.brand_id=p.product_brand_id) LEFT JOIN category AS c ON(c.category_id=p.product_category) LEFT JOIN product_bunch AS pb ON(pb.product_bunch_id=p.product_bunch) LEFT JOIN unit_type AS ut ON(ut.unit_id=p.unit_type)  WHERE p.subproduct_id=0 and p.bIsdelete = 0");
           $result = $sql->result_array();




          $data_array=array();
          $count=0;
        if(count($result)>0)
        {
          $final_row=array();
           // var_dump("Hello");
           //  exit();
            for($i=0;$i<count($result);$i++)
            {
          // while($order_info= $result)
          // {
            //   echo "<pre>";
            // var_dump($result[$i]);
            // exit();

     $sql = $this->db->query("SELECT p.mrp,p.unit_type,ut.display_name,p.product_id, p.unit_value ,p.discount_percentage, p.discounted_price, p.quantity FROM product AS p   LEFT JOIN unit_type AS ut ON(ut.unit_id=p.unit_type) WHERE p.bIsdelete = 0 and p.subproduct_id=".$result[$i]['product_id']);
     $sub_product = $sql->result_array();
   // $sub_product=mysql_query($sql1,$con);



    $product_value=array();
    $quantity=array();
    $mrp=array();
    $product_id =array();
    $discounted_price=array();
    $discount_percentage=array();
    $unit_type=array();
    array_push($quantity, $result[$i]['quantity']);
    array_push($mrp, $result[$i]['mrp']);
    array_push($product_id,$result[$i]['product_id']);
    array_push($discount_percentage,$result[$i]['discount_percentage']);
    array_push($unit_type,$result[$i]['unit_type']);
    array_push($discounted_price, $result[$i]['discounted_price']);
    array_push($product_value,$result[$i]['unit_value']);
    // $final_row['mrp']=clean($order_info['mrp']);
    // $final_row['discount_percentage']=clean($order_info['discount_percentage']);
    // $final_row['discounted_price']=clean($order_info['discounted_price']);
    // $final_row['quantity']=clean($order_info['quantity']);
    // while($content= mysql_fetch_assoc($sub_product))
    // {
    for ($j=0; $j <count($sub_product) ; $j++)
    {
      array_push($quantity, $this->clean(trim($sub_product[$j]['quantity'])));
      array_push($mrp, $this->clean(trim($sub_product[$j]['mrp'])));
      array_push($product_id, $this->clean(trim($sub_product[$j]['product_id'])));
      array_push($discount_percentage,$this->clean(trim($sub_product[$j]['discount_percentage'])));
      array_push($unit_type,$this->clean(trim($sub_product[$j]['display_name'])));
      array_push($discounted_price,trim($sub_product[$j]['discounted_price']));
      array_push($product_value, $this->clean(trim($sub_product[$j]['unit_value'])));
    }



  //  var_dump($unit_type);exit();
    $final_row['product_id']=str_replace(',', ' ', implode('--', $product_id));
    $final_row['product_name']=str_replace(',', ' ',$result[$i]['product_name']);
    $final_row['product_brand']=str_replace(',', ' ',$result[$i]['product_brand_id']);
    $final_row['product_category']=str_replace(',', ' ',$result[$i]['product_category']);
    $final_row['product_subcategory']=str_replace(',', ' ',$result[$i]['product_subcategory']);
    // $final_row['subproduct_id']=str_replace(',', ' ',$result[$i]['subproduct_id']);
    // $final_row['subproduct_total']=str_replace(',', ' ',$result[$i]['subproduct_total']);
    // $final_row['unit_type']=str_replace(',', ' ',$order_info['unit_type']);
    $final_row['product_description']=  $this->clean(strip_tags(preg_replace( "/\r|\n/", "", $result[$i]['product_description'])));;
    $final_row['product_image']=$result[$i]['product_image'];
    // $final_row['product_order']=$result[$i]['product_order'];
    $final_row['product_status']=$result[$i]['product_status'];
    // $final_row['product_timestamp']=$result[$i]['product_timestamp'];
    // $final_row['admin_id']=$result[$i]['admin_id'];
    // $final_row['min_sale_qty']=$result[$i]['min_sale_qty'];
    $final_row['max_sale_qty']=$result[$i]['max_sale_qty'];
    $final_row['unit_value']=str_replace(',', '', implode('--', $product_value));
    $final_row['mrp']=str_replace(',', ' ', implode('--', $mrp));
    $final_row['discount_percentage']=str_replace(',', '', implode('--', $discount_percentage));
    $final_row['unit_type']=str_replace(',', '', implode('--', $unit_type));
    // $final_row['discounted_price']=str_replace(',', '', implode('--', $discounted_price));
    $final_row['quantity']=str_replace(',', '', implode('--', $product_value));
    /*if ($count==0) {*/
      array_push($data_array,$final_row);
  }

          // echo "<pre>";
          //   var_dump($data_array);
          //   exit();
}

$csv_data="";
$header="";
  // echo "<pre>";
  // var_dump($data_array);
  // exit();
if (count($data_array))
{
  for ($i=0; $i < count($data_array); $i++) {
    if ($i==0) {
      $header=array_keys($data_array[$i]);
      $header=implode(",", $header);
      $header.="\n";
      $csv_data.=$header;
    }
    // var_dump($csv_data);
    // exit();
    $valus=array_values($data_array[$i]);
    $new_row=implode($valus, ",")." \n ";
    $csv_data.=$new_row;
  }
}
else{
  $csv_data='product_id,product_name,product_brand,product_category,product_subcategory
,unit_type,unit_value,product_description,product_image,product_status,mrp,discount_percentage,quantity,max_sale_qty';
}
/*echo "<pre>";
echo $csv_data;exit();*/
/*$csv_handler = fopen ("EG- ".date("jS F, Y", strtotime(date("Y-m-d"))).".csv","w");
fwrite ($csv_handler,$csv_data);
fclose ($csv_handler);
copy("EG- ".date("jS F, Y", strtotime(date("Y-m-d"))).".csv","../csv/report1/EG- ".date("jS F, Y", strtotime(date("Y-m-d"))).".csv");
unlink("EG- ".date("jS F, Y", strtotime(date("Y-m-d"))).".csv");*/
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=product_list.csv");
header("Pragma: no-cache");
header("Expires: 0");
echo $csv_data;exit();
    }

   //---------Get Clean String
       function clean($string) {
    return $string = str_replace(',', '--', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9 .\-]/', '', $string); // Removes special chars.
 }

// --- Get array from CSV files ----------------------------------------------------------------------------------------

function csv_to_array($filename='', $delimiter=','){

    if(!file_exists($filename) || !is_readable($filename))

        return FALSE;

    $header = NULL;

    $data = array();

    if (($handle = fopen($filename, 'r')) !== FALSE)

    {

        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)

        {

            if(!$header)

                $header = $row;

            else{

              if (count($header)==count($row)) {

                  $data[] = array_combine($header, $row);

              }

              elseif(count($header)>count($row)){

                while (count($header)!=count($row)) {

                  array_push($row, '');

                }

                // commbine your header as key and valus as row.

                  $data[] = array_combine($header, $row);

              }

            }

        }

        fclose($handle);

    }

    return $data;

}








// ---brand insert ------------------------------------------------------------

function brand($csv_array)

{

    foreach ($csv_array as $row)

    {

        if ($row['product_brand']!='')

        {

            $data_to_store=array(

                'brand_name'=>($row['product_brand']),

                'brand_icon'=>'no_image.png',

                'brand_status'=>1,

                'bIsdelete' => 0,

                'brand_timestamp'=>date('Y-m-d H:i:s')

            );



           $this->brand_insert($data_to_store);

        }



    }

}

function brand_insert($data)

{





   $counter = $this->model_csv->get_total_counts('brand', array('brand_name'=>addslashes($data['brand_name']), 'bIsdelete' => 0));



     // var_dump($counter);

   // exit();



    if ($counter==0) {

        $cat_insert_id=$this->model_csv->insert('brand', $data);

    }

 //   exit();

}



 //--- category insert --------------------------------------------------------------------------------------------------

function category($csv_array){

    foreach ($csv_array as $row) {

        if (strpos($row['product_category'], '/') === false && $row['product_category']!='' ) {

            $data_to_store=array(

            'category_english_name'=>addslashes($row['product_category']),

            'category_icon'=>'no_image.png',

            'category_order'=>0,

            'category_status'=>1,

            'bIsdelete' => 0,

            'category_timestamp'=>date('Y-m-d H:i:s')

            );

            // echo "<pre>";

            // var_dump($data_to_store);



            $this->category_insert($data_to_store);

        }

    }

}



  function category_insert($data)

  {



      $counter = $this->model_csv->get_total_counts('category', array('category_english_name'=>$data['category_english_name'] , 'bIsdelete' => 0));


      // var_dump($data);
      // exit();


      if ($counter==0) {

        $cat_insert_id=$this->model_csv->insert('category', $data);

      }

  }



  // --- sub Category insert ---------------------------------------------------------------------------------------------

function sub_category($csv_array)

{



    foreach ($csv_array as $row) {

        if ($row['product_subcategory']!='' && $row['product_category']!='')

        {

            $category_english_name=addslashes($row['product_category']);

        $category_id=$this->model_csv->getsinglecolumevalue_array('category', array('category_english_name'=>$category_english_name,'bIsdelete'=>0),'category_id');

            if ($category_id<=0)
            {

              $this->category($csv_array=array('category_english_name' => addslashes($row['product_category']), ));

              $category_id=$this->model_csv->getsinglecolumevalue_array('category', array('category_english_name'=>$category_english_name,'bIsdelete'=>0),'category_id');

            }

            $data_to_store=array(

            'productbunch_english_name'=>addslashes($row['product_subcategory']),

            'product_image'=>'no_image.png',

            'product_order'=>0,

            'product_status'=>1,

            'bIsdelete' => 0,

            'product_timestamp'=>date('Y-m-d H:i:s')

            );

            $data_to_store['product_category']=$category_id;

            // echo "<pre>";

            // var_dump($data_to_store);

            $this->sub_category_insert($data_to_store);

        }

    }

}



function sub_category_insert($data)

{

  /*echo "<pre>";

  var_dump($data);*/



   $counter = $this->model_csv->get_total_counts('product_bunch', array('productbunch_english_name'=>$data['productbunch_english_name'], 'bIsdelete' => 0,'product_category'=>$data['product_category']));

    /*echo "<br>";

    echo "</pre>";*/

    // var_dump($counter);

    if ($counter==0)

     {

      $cat_insert_id=$this->model_csv->insert('product_bunch', $data);

    }

}

// --- product insert ---------------------------------------------------------------------------------------------

function product($csv_array)

{



    foreach ($csv_array as $row)
    {

        if ($row['product_name']!='') {

            if (empty($row['product_image'])) {

              $final_img='no_image.png';

            }

            else{

              $final_img=$row['product_image'];

            }

            if (empty($row['max_sale_qty']))

            {

              $row['max_sale_qty']=10;

            }

            if (empty($row['min_sale_qty'])) {

              $row['min_sale_qty']=0;

            }



            $product_brand_id=$this->model_csv->getsinglecolumevalue_array('brand', array('brand_name'=>$row['product_brand'],'bIsdelete'=>0),'brand_id');

            $row['discounted_price']=floatval($row['mrp'])-((floatval($row['discount_percentage']*floatval($row['mrp']))/100));

            if(isset($row['product_status']))
            {
              $status = $row['product_status'];
            }
            else
            {
              $status = 1;
            }

            $data_to_store=array(

                'product_id'=>$row['product_id'],

                'product_brand_id'=>$product_brand_id,

                'product_description'=>addslashes($row['product_description']),

                'product_image'=>$final_img,

                'product_english_name'=>addslashes($row['product_name']),

                'unit_type'=>$row['unit_type'],

                'subproduct_id'=>'0',

                'product_order'=>0,

                'product_status'=>$status,

                'mrp'=>$row['mrp'],

                'unit_value' => $row['unit_value'],

                'admin_id'=>1,

                'bIsdelete' => 0,

                'quantity'=>$row['quantity'],

                'discount_percentage'=>$row['discount_percentage'],

                'discounted_price'=>round($row['discounted_price'],2),

                'min_sale_qty'=>$row['min_sale_qty'],

                'max_sale_qty'=>$row['max_sale_qty'],

                'product_timestamp'=>date('Y-m-d H:i:s')

            );




           // var_dump($row['product_value']);

            if (empty($row['product_value']))

            {

              $product_value=1;

            }

            else

            {

              $product_value=$row['product_value'];

            }



            $category_id=$this->model_csv->getsinglecolumevalue_array('category', array('bIsdelete'=>0,'category_english_name'=>addslashes($row['product_category'])),'category_id');

             $sub_category_id=$this->model_csv->getsinglecolumevalue_array('product_bunch', array('bIsdelete'=>0,'productbunch_english_name'=>addslashes($row['product_subcategory']),'product_category'=>$category_id),'product_bunch_id');

               $brand_id=$this->model_csv->getsinglecolumevalue_array('brand', array('bIsdelete'=>0,'brand_name'=>addslashes($row['product_brand_id'])),'brand_id');




            // $sub_category_id=$this->model_csv->getsinglecolumevalue_array('product_bunch', array('productbunch_english_name'=>addslashes($row['product_subcategory']),'product_bunch_id');

            $data_to_store['product_category']=$category_id;

            $data_to_store['product_bunch']=$sub_category_id;

             $data_to_store['product_brand_id']=$brand_id;

            // echo "<pre>";
            // var_dump($brand_id);
            // exit();

          $this->product_insert($data_to_store,$product_value);

            //exit();

        }

    }

}





function product_insert($data,$product_value)

{




   if($data['product_id']==NULL)

   {

    $product_id =0;

   }

   else

   {

    $product_id = $data['product_id'];

   }



    if (!empty($product_id))

    {

        $qty_array=explode('--', $data['quantity']);

       $unit_type=explode('--', $data['unit_type']);

        $mrp_array=explode('--', $data['mrp']);

        $product_value_array=explode('--',  $data['unit_value']);

        $discount_percentage_array=explode('--', $data['discount_percentage']);

         $product_id_array=explode('--', $data['product_id']);





        if (count($discount_percentage_array)<=0)

        {

           $discount_percentage_array=array('0');

        }





        if (count($qty_array)==1 && count($mrp_array)==1  && count($discount_percentage_array)==1 && count($product_value_array)==1)

        {

           $product_id = ($product_id_array[0]);



            $unit_id=$this->model_csv->getsinglecolumevalue_array('unit_type', array('display_name'=>trim(strtoupper($unit_type[0]))),'unit_id');

            if ($unit_id==0)

            {

              $unit_id=1;

            }



             $data['unit_type']=$unit_id;



              $this->model_csv->update("product", $data, "product_id=" .$product_id);

           // $product_insert_id=$cDB->updatequery($data,'product',' WHERE product_id='.$product_id);

        }

      elseif(count($qty_array)==count($mrp_array))

      {





         for ($i=0; $i <count($product_id_array) ; $i++)

        {

          if (count($qty_array) != count($mrp_array))

          {

            $qty_array[$i]=$qty_array[0];

          }

          if (count($discount_percentage_array) != count($mrp_array))

          {

              $discount_percentage_array[$i]=$discount_percentage_array[0];

          }



            $unit_id=$this->model_csv->getsinglecolumevalue_array('unit_type', array('display_name'=>trim(strtoupper($unit_type[$i]))),'unit_id');

            if ($unit_id==0)

            {

              $unit_id=1;

            }





          $data['unit_type']=$unit_id;

          $data['quantity']=$qty_array[$i];

          $data['mrp']=$mrp_array[$i];

           $data['product_id']=$product_id_array[$i];

           $data['unit_value']=$product_value_array[$i];

          $data['discount_percentage']=$discount_percentage_array[$i];

          $data['discounted_price']=floatval($data['mrp'])-((floatval($discount_percentage_array[$i]*floatval($data['mrp']))/100));

          $product_id = $data['product_id'];







          if ($i==0)

          {

             $this->model_csv->update("product", $data, "product_id=" .$product_id);

           //$product_insert_id=$cDB->updatequery($data,'product',' WHERE product_id='.$product_id);

          }

          else

          {

                $data['subproduct_id']=$product_id_array[0];

                // var_dump($data);

                // exit();

                 $this->model_csv->update("product", $data, "product_id=" .$product_id);

              // $product_insert_id=$cDB->updatequery($data,'product',' WHERE product_id='.$product_id);

          }





        }



      }



    }







    elseif ($counter==0)

    {





      $data['product_id']='';

      $qty_array=explode('--', $data['quantity']);

      $mrp_array=explode('--', $data['mrp']);

      $unit_type=explode('--', $data['unit_type']);

      $product_value_array=explode('--', $data['unit_value']);

      $discount_percentage_array=explode('--', $data['discount_percentage']);

        if (count($discount_percentage_array)<=0) {

            $discount_percentage_array=array('0');

        }



      if (count($qty_array)==1 && count($mrp_array)==1  && count($discount_percentage_array)==1 && count($product_value_array)==1  )

      {


         $unit_id= $this->model_csv->getsinglecolumevalue_array('unit_type', array('display_name'=>trim(strtoupper($unit_type[0]))),'unit_id');

            if ($unit_id==0)
            {
              $unit_id=1;
            }



            $data['unit_type']=$unit_id;
            // echo "<pre>";
            // var_dump($data);
            // exit();

          $product_insert_id=$this->model_csv->insert('product', $data);

      }

      elseif ((count($product_value_array) == count($mrp_array)) )

      {//&& (count($mrp_array) == count($discount_percentage_array))

        for ($i=0; $i <count($mrp_array) ; $i++)

        {

           $unit_id= $this->model_csv->getsinglecolumevalue_array('unit_type', array('display_name'=>trim(strtoupper($unit_type[$i]))),'unit_id');

            if ($unit_id==0)

            {

              $unit_id=1;

            }



            $data['unit_type']=$unit_id;



          if (count($qty_array) != count($mrp_array))

          {

            $qty_array[$i]=$qty_array[0];

          }

          if (count($discount_percentage_array) != count($mrp_array))

          {

              $discount_percentage_array[$i]=$discount_percentage_array[0];

          }

          $data['quantity']=$qty_array[$i];

          $data['mrp']=$mrp_array[$i];

          $data['unit_value']=$product_value_array[$i];

          $data['discount_percentage']=$discount_percentage_array[$i];

          $data['discounted_price']=floatval($data['mrp'])-((floatval($discount_percentage_array[$i]*floatval($data['mrp']))/100));

           // echo "<pre>";
           //  var_dump($data);
           //  exit();

          if ($i==0)

          {

            $product_insert_id_main= $this->model_csv->insert('product', $data);

          }

          else

          {

            $data['subproduct_id']=$product_insert_id_main;



            $product_insert_id= $this->model_csv->insert('product', $data);



          }

        }

      }

    }

}







}





