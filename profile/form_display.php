<?php 

if($shift == 0){

    if($current_time > '08:00:00'){

        if( $current_time < '09:15:00'){
            $status = 'In-Time';
        }
        if( $current_time > '09:15:00' && $current_time < '12:00:00'){
            $status = 'Already Late';
        }
        if( $current_time > '12:00:00' && $current_time < '14:00:00'){
            $status = 'Half Day';
        }
        if( $current_time > '14:00:00'){
            $status = 'Absent Already';
        }

        show_form($userid, $status, $showentryform);
    }
}

if($shift == 1){

    if($current_time > '18:00:00'){

        if( $current_time < '18:15:00'){
            $status = 'In-Time';
        }
        if( $current_time > '18:15:00' && $current_time < '21:00:00'){
            $status = 'Already Late';
        }
        if( $current_time > '21:00:00' && $current_time < '22:30:00'){
            $status = 'Half Day';
        }
        if( $current_time > '22:30:00'){
            $status = 'Absent Already';
        }

        show_form($userid, $status);
    }
}
if($shift == 2){

    if($current_time > '02:00:00'){

        if( $current_time < '02:30:00'){
            $status = 'In-Time';
        }
        if( $current_time > '02:30:00' && $current_time < '04:00:00'){
            $status = 'Already Late';
        }
        if( $current_time > '04:00:00' && $current_time < '06:00:00'){
            $status = 'Half Day';
        }
        if( $current_time > '06:00:00'){
            $status = 'Absent Already';
        }

        show_form($userid, $status);
    }
}
// exit form

?>