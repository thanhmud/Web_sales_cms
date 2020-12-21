<?php 
  //nối chuỗi php '..' - javascript ' ++ ' 
  //đệ quy category = = 
  function showCategories($categories, $parent_id = 0, $char = '')
  {
      foreach ($categories as $key => $item)
      {
          // Nếu là chuyên mục con thì hiển thị
          if ($item->parent_id == $parent_id)
          {
              echo '<option value="'.$item->id.'">'.$char.$item->name.'</option>';
              // Xóa chuyên mục đã lặp
              unset($categories[$key]);
               
              // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
              showCategories($categories, $item->id, $char.'--');
          }
      }
  }
  function showEditProductCategories($categories, $parent_id = 0, $char = '')
  {
      foreach ($categories as $key => $item)
      {
          // Nếu là chuyên mục con thì hiển thị
          if ($item->parent_id == $parent_id)
          {
              echo '<option value="'.$item->id.'">'.$char.$item->name.'</option>';
              // Xóa chuyên mục đã lặp
              unset($categories[$key]);
              // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
              showEditProductCategories($categories, $item->id, $char.'--');
          }
      }
  }
    function showProductCategories($categories, $parent_id = 0, $char = '')
  {
      foreach ($categories as $key => $item)
      {
          // Nếu là chuyên mục con thì hiển thị
          if ($item->parent_id == $parent_id)
          {
              echo ' <input type="checkbox" name="parent_id" value="'.$item->id.'"><option style="display:inline-block" value="'.$item->id.'">'.$char.$item->name.'</option><br>';
              // Xóa chuyên mục đã lặp
              unset($categories[$key]);
               
              // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
              showProductCategories($categories, $item->id, $char.'--');
          }
      }
  }


  function tableCategories($categories, $parent_id = 0, $char = '')
  {
     $stt=1;
      foreach ($categories as $key => $item)
      {
          // Nếu là chuyên mục con thì hiển thị
          if ($item->parent_id == $parent_id)
          {
              echo '<tr >';
                  echo '<td scope="col"><input type="checkbox"  name=""></td>';
                  echo '<td scope="col">'.$stt++.'</td>';
                  echo '<td scope="col">'.substr($char.$item->name,0,100).'</td>';
                  echo '<td scope="col">'.substr($item->desc,0,70).'</td>';
                  echo '<td scope="col" >'.$item->parent_id.'</td>';
                  // echo '<td scope="col">'.$item->media_id.'</td>';
                  echo '<td scope="col" class="text-center"><a href="'.route('edit.category.post',['id'=>$item->id]).'"><i class="fa fa-edit tacvu"></i></a><a href="'.route('delete.category.post',['id'=>$item->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></td>';
              echo '</tr>';
              // Xóa chuyên mục đã lặp
              unset($categories[$key]);
               
              // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
              tableCategories($categories, $item->id, $char.'--');
          }
      }
    }
    function tableProductCategories($categories, $parent_id = 0, $char = '')
    {
       $stt=1;
        foreach ($categories as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id)
            {
                echo '<tr >';
                    echo '<td scope="col"><input type="checkbox"  name=""></td>';
                    echo '<td scope="col">'.$stt++.'</td>';
                    echo '<td scope="col">'.substr($char.$item->name,0,100).'</td>';
                    echo '<td scope="col">'.substr($item->desc,0,70).'</td>';
                    echo '<td scope="col" >'.$item->parent_id.'</td>';
                    // echo '<td scope="col">'.$item->media_id.'</td>';
                    echo '<td scope="col" class="text-center"><a href="'.route('edit.category.product',['id'=>$item->id]).'"><i class="fa fa-edit tacvu"></i></a><a href="'.route('delete.category.product',['id'=>$item->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></td>';
                echo '</tr>';
                // Xóa chuyên mục đã lặp
                unset($categories[$key]);
                 
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                tableProductCategories($categories, $item->id, $char.'--');
            }
        }
      }
  //  function tableProductCategories($categories, $parent_id = 0, $char = '')
  // {
  //    $stt=1;
  //     foreach ($categories as $key => $item)
  //     {
  //         // Nếu là chuyên mục con thì hiển thị
  //         if ($item->parent_id == $parent_id)
  //         {
  //             echo '<tr>';
  //                 echo '<td scope="col"><input type="checkbox"  name=""></td>';
  //                 echo '<td scope="col">'.$stt++.'</td>';
  //                 echo '<td scope="col">'.$char.$item->name.'</td>';
  //                 echo '<td scope="col">'.$item->desc.'</td>';
  //                 echo '<td scope="col">'.$item->parent_id.'</td>';
  //                 echo '<td scope="col">'.$item->media_id.'</td>';
  //                 echo '<td scope="col"><a href="'.route('edit.category',['id'=>$item->id]).'"><i class="fa fa-edit tacvu"></i></a><a href="'.route('delete.category',['id'=>$item->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></td>';
  //             echo '</tr>';
  //             // Xóa chuyên mục đã lặp
  //             unset($categories[$key]);
               
  //             // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
  //             tableCategories($categories, $item->id, $char.'**');
  //         }
  //     }
  // }
?>
