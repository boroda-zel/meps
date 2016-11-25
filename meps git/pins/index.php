<?php

/*test
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function __autoload($class_name) {
    include_once '../inc/class.' . $class_name . '.inc.php';
}
setcookie("nickmeps", Alex, time() + 36000, '/');
echo check_login::check('5');
echo DBconnect::connect();

?>
<script type="text/javascript" src="ajax.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<form id=choose>
    <table>
        <tr>
            <td>Service name</td><td>
                <select name=type>
                    <option value="">Choose service</option>
                    <?php
                    $model = pg_query('SELECT services.id_service,print_name
                            FROM public.services
                            INNER JOIN public.card_types ON(card_types.id_service=services.id_service)
                            WHERE blocked = false 
                            GROUP BY services.id_service');
                    while ($record = pg_fetch_array($model))
                    {
                        print '<option value="' . $record['id_service'] . '">' . $record['print_name'] . '</option>';
                    }
                    ?>
                </select>
            </td>
            <td>Choose how to group</td><td>
                <input type="radio" name="group" value="week">Week<br>
                <input type="radio" name="group" value="month">Month<br>
            </td>
            <td>Period</td><td>
                <input type="number" name="period">
            </td>
        </tr>
    </table>
    <input type="button" onclick="function1('get_card')" value="Find">

</form>

<div id="result"></div>
