<?php
include('../config/function.php');

if(isset($_POST['saveProduct'])){
    $Category_ID = validate($_POST['category_id']);
    $Product_name = validate($_POST['Product_name']);
    $Supplier_ID = validate($_POST['supplier_id']);

    $Price = validate($_POST['Price']);
    $Quantity = validate($_POST['Quantity']);
    
    if($_FILES['image']['name'] != ''){
        $path = "../assets/uploads/products/";
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $filename =  time().'.'.$image_ext;

        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        $finalImage = "/assets/uploads/products/".$filename;
    }
    else {
        redirect('view-products.php', 'Please select an image');
    }

    if($Product_name != '' && $Category_ID != '' && $Supplier_ID != '' && $Price != '' && $Quantity != '' && $finalImage != ''){
        $data = [
            'Category_ID' => $Category_ID,
            'Product_name' => $Product_name,
            'Quantity' => $Quantity,
            'Price' => $Price,
            'Supplier_ID' => $Supplier_ID,
            'Image' => $finalImage,
            
        ];
        $result = insertRecord('product', $data);
        if($result){
            redirect('add-products.php', 'Product added successfully');
        }
        else {
            redirect('add-products.php', 'Failed to add product');
        }
    }
    else {
        redirect('add-products.php', 'All fields are required');
    }
}
if(isset($_POST['saveCategory'])){
    $Category_name = validate($_POST['Category_Name']);
    $Category_Descrip = validate($_POST['Category_Descrip']);
    
    if($Category_name != '' && $Category_Descrip != ''){
        $data = [
            'Category_Name' => $Category_name,
            'Category_Descrip' => $Category_Descrip
        ];
        $result = insertRecord('category', $data);
        if($result){
            redirect('view-categories.php', 'Category added successfully');
        }
        else {
            redirect('add-categories.php', 'Failed to add category');
        }
    }
    else {
        redirect('add-categories.php', 'All fields are required');
    }

}

if(isset($_POST['updateCategory'])){
    $Category_ID = validate($_POST['Category_ID']);
    $Category_name = validate($_POST['Category_name']);
    $Category_Descrip = validate($_POST['Category_Descrip']);
        $data = [
            'Category_Name' => $Category_name,
            'Category_Descrip' => $Category_Descrip
        ];
        $result = update('category', $Category_ID, $data);
        
        if($result){
            redirect('view-categories.php?ID='.$Category_ID, 'Category Updated Successfully');
        } else {
            redirect('edit-categories.php?ID='.$Category_ID, 'Failed to Update Category');
        } 

}

if(isset($_POST['saveSupplier'])){
    $Supplier_name = validate($_POST['Supplier_Name']);
    $Supplier_contact = validate($_POST['Supplier_Contact']);
    $Supplier_phone = validate($_POST['Supplier_PhoneNum']);
    
    if($Supplier_name != '' && $Supplier_contact != '' && $Supplier_phone != ''){
        $data = [
            'Supplier_Name' => $Supplier_name,
            'Supplier_Contact' => $Supplier_contact,
            'Supplier_PhoneNum' => $Supplier_phone
        ];
        $result = insertRecord('supplier', $data);
        if($result){
            redirect('view-suppliers.php', 'Supplier Added successfully');
        }
        else {
            redirect('add-suppliers.php', 'Failed to Add supplier');
        }
    }
    else {
        redirect('add-suppliers.php', 'All fields are Required');
    }

}

if(isset($_POST['updateSupplier'])){
    $Supplier_ID = validate($_POST['Supplier_ID']);
    $Supplier_name = validate($_POST['Supplier_Name']);
    $Supplier_contact = validate($_POST['Supplier_Contact']);
    $Supplier_phone = validate($_POST['Supplier_PhoneNum']);
        $data = [
            'Supplier_Name' => $Supplier_name,
            'Supplier_Contact' => $Supplier_contact,
            'Supplier_PhoneNum' => $Supplier_phone
        ];
        $result = update('supplier', $Supplier_ID, $data);
        
        if($result){
            redirect('view-suppliers.php?ID='.$Supplier_ID, 'Supplier Updated Successfully');
        } else {
            redirect('edit-categories.php?ID='.$Supplier_ID, 'Failed to Update Supplier');
        } 

}

if(isset($_POST['updateProduct'])){
    $Product_ID = validate($_POST['Product_ID']);
    $ProductData = getByID('product', $Product_ID);
    if(!$ProductData){
        redirect('view-products.php', 'Product not found');
    } 
    $Category_ID = validate($_POST['category_id']);
    $Product_name = validate($_POST['Product_name']);
    $Supplier_ID = validate($_POST['supplier_id']);

    $Price = validate($_POST['Price']);
    $Quantity = validate($_POST['Quantity']);
    
    if($_FILES['image']['size'] > 0){

        $path = "../assets/uploads/products";
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $filename =  time().'.'.$image_ext;

        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        
        $finalImage = "assets/uploads/products/".$filename;

        $deleteImage = "../".$ProductData['data']['Image'];

        if(file_exists($deleteImage)){
            unlink($deleteImage);
        }
    }
    else {
        $finalImage = $ProductData['data']['Image'];
    }
    $data = [
        'Category_ID' => $Category_ID,
        'Product_name' => $Product_name,
        'Quantity' => $Quantity,
        'Price' => $Price,
        'Supplier_ID' => $Supplier_ID,
        'Image' => $finalImage,
        
    ];
    $result = update('product', $Product_ID, $data);
    if($result){
        redirect('view-products.php?ID='.$Product_ID, 'Product Updated successfully');
    }
    else {
        redirect('view-products.php?ID='.$Product_ID, 'Failed to Update product');
    }
}
?>
