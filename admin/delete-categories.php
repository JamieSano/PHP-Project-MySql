<?php
require '../config/function.php';

$paramResultId = checkParamID('ID');
if(is_numeric($paramResultId)){
    $categoryId = validate($paramResultId);
    $category = getByID('category', $categoryId);
    if($category['status'] == 200){
        $categoryDel = delete('category', $categoryId);
        if($categoryDel){
            redirect('view-categories.php', 'Category deleted successfully');
        }else{
            redirect('view-categories.php', 'Failed to delete category');
        }
    }else{
        redirect('view-categories.php', 'Category not found');
    }
} else{
    redirect('view-categories.php', 'Invalid parameter');
}
?>