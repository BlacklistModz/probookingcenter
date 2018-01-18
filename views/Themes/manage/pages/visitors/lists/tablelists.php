<?php

$tr = "";
$tr_total = "";
if( !empty($this->results['lists']) ){ 

    $seq = 0;
    foreach ($this->results['lists'] as $i => $item) { 

        // $item = $item;
        $cls = $i%2 ? 'even' : "odd";
        // set Name

        /*$updatedTime = strtotime( $item['updated'] );
        $updatedStr = date('j/m/Y', $updatedTime);
        $updatedStr .= '<div class="fsm fcg">' .date('H:i:s').'</div>';*/

        /*$created = strtotime( $item['created'] );
        $createdStr = date('j', $created) .' ' . $this->fn->q('time')->month( date('n', $created) ) .' '. ( date('Y', $created)+543 );*/

        $status = '';
        $option = '';
        foreach ($this->status as $key => $value) {
            $sel = '';
            if( $value["id"] == $item["status"] ){
                $sel = ' selected="1"';
            }
            $option .= '<option'.$sel.' value="'.$value["id"].'">'.$value['name'].'</option>';
        }
        $status = '<select class="inputtext" name="status">'.$option.'</select>';


        $tr .= '<tr class="'.$cls.'" data-id="'.$item['id'].'">'.

            // '<td class="check-box"><label class="checkbox"><input id="toggle_checkbox" type="checkbox" value="'.$item['id'].'"></label></td>'.

            '<td class="name">'.
                '<div class="anchor clearfix">'.
                    '<div class="content"><div class="spacer"></div><div class="massages">'.
                        //href="'.URL .'admin/visitors/'.$item['id'].'"
                        '<div class="fullname"><a class="fwb">'. $item["member"]['fullname'].'</a></div>'.
                        // '<div class="subname fsm meta fcg">Last Date: '.$this->fn->q('time')->live( $item['updated'] ).'</div>'.
                    '</div>'.
                '</div></div>'.
            '</td>'.
            '<td class="visit">'.$status.'</td>'.

        '</tr>';
        
    }
}

$table = '<table><tbody>'. $tr. '</tbody>'.$tr_total.'</table>';