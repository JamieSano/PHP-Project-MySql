<?php
require '../config/function.php';

$paramResultId = checkParamID('ID');
if(is_numeric($paramResultId)){

    $Product_ID = validate($paramResultId);

    $Product = getByID('product', $Product_ID);

    if($Product['status'] == 200){

        $ProdDel = delete('product',$Product_ID);
        if($ProdDel){
            $deleteImage = "../".$Product['data']['Image'];
            if(file_exists($deleteImage)){

                unlink($deleteImage);
            }
            redirect('view-products.php', 'Product deleted successfully');
        }else{
            redirect('view-products.php', 'Failed to delete Product');
        }
    }else{
        redirect('view-products.php', $Product['message']);
    }
} else{
    redirect('view-products.php', 'Something went wrong!');
}
?>