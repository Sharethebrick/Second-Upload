<?php
use App\Common;

	function Getdesc($input, $length, $ellipses = false, $strip_html = false) {
    //strip tags, if desired
            if ($strip_html) {
                $input = strip_tags($input);
            }

            //no need to trim, already shorter than trim length
            if (strlen($input) <= $length) {
                return $input;
            }

            //find last space within length
            $last_space = strrpos(substr($input, 0, $length), ' ');
            if($last_space){
                $trimmed_text = substr($input, 0, $last_space);
            }else{
                $trimmed_text = substr($input, 0, $length);
            }

            //add ellipses (...)
            if ($ellipses) {
                $trimmed_text .= '...';
            }

            return $trimmed_text;
    }
    function get_time($value) {
	    $date = date ('F d, Y H:i A',$value?strtotime($value):'');

	    $day_ago = time_elapsed_string($value);
	    // return $date.'('.$day_ago.')';
	    return $day_ago;
	   }
     function items_count() {
      return 9;
     }
     function getUrl() {
        $url_segment = \Request::segment(1);
        return $url_segment;
     }
    function time_elapsed_string($datetime, $full = false) {
      $now = new DateTime;
      $ago = new DateTime($datetime);
      $diff = $now->diff($ago);

      $diff->w = floor($diff->d / 7);
      $diff->d -= $diff->w * 7;

      $string = array(
          'y' => 'year',
          'm' => 'month',
          'w' => 'week',
          'd' => 'day',
          'h' => 'hour',
          'i' => 'minute',
          's' => 'second',
      );
      foreach ($string as $k => &$v) {
          if ($diff->$k) {
              $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
          } else {
              unset($string[$k]);
          }
      }

      if (!$full) $string = array_slice($string, 0, 1);
      return $string ? implode(', ', $string) . '' : 'just now';
  	}
   function showDateFormat($data){
       $date=date_create($data);
       return date_format($date,"Y/m/d H:i");
   }
   function showDateFormatam($data){
       $date=date_create($data);
       // return date_format($date,"Y/m/d H:i:s");
       return date_format($date,"F d, Y H:i A");
   }
   function showDateFormatreturn($data){
       $date=date_create($data);
       return date_format($date,"Y/m/d");
   }
   function showOnlyDateFormat($data){
       $date=date_create($data);
       echo date_format($date,"m-d-Y");
   }
   function showOnlyDateFormat1($data){
       $date=date_create($data);
       return date_format($date,"Y-m-d");
   }
   function showOnlyDateFormat2($data){
       $date=date_create($data);
       return date_format($date,"F d, Y");
   }
   function showOnlyDateFormat3($data){
       $date=date_create($data);
       return date_format($date,"F d, Y H:i A");
   }
   function showDateFormatTime($data){
       $date=date_create($data);
       echo date_format($date,"H:i:sA");
   }
   function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return 'th';
    else
        return $ends[$number % 10];
    }
    function convertLinksClickable($text){
         $url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i';
         $string = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $text);
         return $string;
    }
    function getSettings(){
        return DB::table('settings')->select('*')->where('id',1)->first();
    }

/**
Get members of the Group
**/
function get_group_members( $group_id ){

    return Common::selectdata("group_user_mapping",[[ 'group_id' , $group_id ]]);
}

function get_brick_members($brickId){

    return Common::selectdata("members",[['listing_id' , $brickId],['status',1 ]])->pluck('user_id')->toArray();
}



function get_brick_group($brickId){

    return Common::getfirst("groups",[[ 'listing_id' , $brickId ]]);
}
function get_calendar_events($userid){

    return Common::get_calenter_event($userid);
}

function get_file_image( $extension ,$size=""){
    $image = "doc2.png";
    if( in_array( $extension , ["doc","docx"] ) ){
        $image = "doc2.png";
    }elseif( in_array( $extension , ["csv","xls" , "xlsx" ,"txt"] ) ){
        $image = "csv1.png";
    }elseif( $extension == "pdf" ){
        $image = "pdf2.png";
    }elseif( in_array($extension , ["jpg","jpeg","png","gif"] )){
        $image = "image2.jpg";
    }

    $image = asset( "img/$image" );
    return "<img height='$size' width='$size' src='$image' data-extension='$extension'/>";
}

function check_task_member($taskId,$userId){

    return Common::check_task_members($taskId,$userId);
}