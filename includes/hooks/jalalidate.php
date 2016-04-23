<?php
/* *****************************************************
    ** WHMCS Jalali Dates **
    By Ehsan Chavoshi
    Date : 2016-04-23
    Source : https://github.com/EhsanCh/whmcs-jalalidate
***************************************************** */

add_hook('ClientAreaPage', 1, function($templateVariables) {
    // Look for an existing template variable.
    if (! in_array($templateVariables['language'],array('farsi','persian','فارسی')))
        return;
    $templateVariables['jdate'] = TRUE;
    foreach ($templateVariables['announcements'] as &$announcements) {
        $announcements['date'] = $announcements['timestamp'] ? jdate("j F", $announcements['timestamp']) : jdate("j F", strtotime($announcements['rawDate']));
    }
    foreach ($templateVariables['domains'] as &$domains) {
        $domains['registrationdate'] = jdate("Y/m/d", strtotime($domains['normalisedRegistrationDate']));
        $domains['nextduedate'] = jdate("Y/m/d", strtotime($domains['normalisedNextDueDate']));
        $domains['expirydate'] = jdate("Y/m/d", strtotime($domains['normalisedExpiryDate']));
    }
    foreach ($templateVariables['services'] as &$services) {
        $services['regdate'] = jdate("Y/m/d", strtotime($services['normalisedRegDate']));
        $services['nextduedate'] = jdate("Y/m/d", strtotime($services['normalisedNextDueDate']));
    }
    foreach ($templateVariables['tickets'] as &$tickets) {
        $tickets['date'] = jdate("Y/m/d H:i", strtotime($tickets['normalisedDate']));
        $tickets['lastreply'] = jdate("Y/m/d H:i", strtotime($tickets['normalisedLastReply']));
    }
    foreach ($templateVariables['replies'] as &$replies) {
        $replies['date'] = jdate("Y/m/d H:i", strtotime($replies['date']));
    }
    foreach ($templateVariables['ascreplies'] as &$ascreplies) {
        $ascreplies['date'] = jdate("Y/m/d H:i", strtotime($ascreplies['date']));
    }
    foreach ($templateVariables['descreplies'] as &$descreplies) {
        $descreplies['date'] = jdate("Y/m/d H:i", strtotime($descreplies['date']));
    }
    foreach ($templateVariables['invoices'] as &$invoices) {
        $invoices['datecreated'] = jdate("Y/m/d", strtotime($invoices['normalisedDateCreated']));
        $invoices['datedue'] = jdate("Y/m/d", strtotime($invoices['normalisedDateDue']));
    }
    
    if ($templateVariables['date']) {
        $templateVariables['jfulldate'] = jdate("l ، j F Y", strtotime($templateVariables['date']));
    }
    
    $datefields = array('registrationdate','nextduedate','expirydate','regdate','lastupdate','date','duedate','datepaid','datecreated','datedue');
    foreach ($datefields as $datefield) {
        if ($templateVariables[$datefield])
            $templateVariables[$datefield] = jdate("Y/m/d", strtotime($templateVariables[$datefield]));
    }
    
 
//    echo "<pre>";
//    print_r($templateVariables);
//    echo "</pre>";

    return $templateVariables;
});

