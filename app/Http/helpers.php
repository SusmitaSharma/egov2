<?php


function upload_image(\Illuminate\Http\UploadedFile $image, $prefix = "",$path) {
	// modify the image name and upload it and return modified image name.
	$image_name_with_extension          = $image->getClientOriginalName();
	$modified_image_name_with_extension = "{$prefix}-" . date('YmdHis') . "-" . str_random(5) . "-" . str_replace(" ", "-", $image_name_with_extension);
	 $image_path = public_path('uploads/') . $path;

	if ($image->move($image_path, $modified_image_name_with_extension)) {
		return $modified_image_name_with_extension;
	} else {
		return redirect()->back()->with('failure_message', 'Sorry, something went wrong while uploading the image. Please try again later!');
	}
}

function admin_url($url) {
	return asset("bower_components/" . $url);
}

function front_url($url) {
	return asset("front_assets/" . $url);
}










function paginateCollection($collection, $perPage, $pageName = 'page', $fragment = null)
{
    $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
    $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
    parse_str(request()->getQueryString(), $query);
    unset($query[$pageName]);
    $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
        $currentPageItems,
        $collection->count(),
        $perPage,
        $currentPage,
        [
            'pageName' => $pageName,
            'path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(),
            'query' => $query,
            'fragment' => $fragment
        ]
    );

    return $paginator;
}



function validation_error_message($errors)
{
  $message="";
  if(count($errors) || $errors->any())
  {

    $all_errors=$errors->all();
    $message.=' <div class="alert stay alert-danger">';
    $message.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span class="material-icons">clear</span></button>';
    foreach($all_errors as $error):
     $message.='<p>'.$error.'</p>';
    endforeach;
    $message.='</div>';
    return $message;
  }
  return $message;


}

// function success_or_failure_message()
// {
//   $message = "";
//   if (session('success_message')) {
//     $message .= '<div class="alert fade in alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4><p>'.session("success_message").'</p></div>';
//   } elseif (session('failure_message')) {;
//       $message .= '<div class="alert fade in alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4><p>'.session("failure_message").'</p></div>';

//   }
//   return $message;
// }

function success_or_failure_message()
{
  $message = "";
  if (session('success_message')) {
    $message .= '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    $message .= '<p>' . session("success_message") . '</p>';
    $message .= '</div>';
  } elseif (session('failure_message')) {
    $message .= '<div id="asdh-message2" class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    $message .= '<p>' . session("failure_message") . '</p>';
    $message .= '</div>';
  }
  return $message;
}






