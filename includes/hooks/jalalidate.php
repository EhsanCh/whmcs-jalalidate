<?php
/* *****************************************************
    ** WHMCS Jalali Dates **
    By Ehsan Chavoshi (HostFa) & Amin Arjmand (https://github.com/sibche2013) & Hamid Ghouli (https://github.com/hamidghouli)
    Date : 2016-04-23
    Updated : 2017-01-09
    Lincense : MIT License
    Source : https://github.com/EhsanCh/whmcs-jalalidate Or https://github.com/sibche2013/whmcs-jalalidate (WHMCS 7.1.1 Updated)
***************************************************** */
add_hook('ClientAreaPage', 1, function ($templateVariables) {
    // Look for an existing template variable.
    if (!in_array($templateVariables['language'], array('farsi', 'persian', 'فارسی')))
        return;
    $templateVariables['jdate'] = TRUE;
    // Announcement Jalali Date
    foreach ($templateVariables['announcements'] as &$announcements) {
        $announcements['rawDate'] = jdate("j F Y", strtotime($announcements['rawDate']));
        $announcements['timestamp'] = jdate("j F Y", $announcements['timestamp']);
    }
    // Domains Jalali Date
    foreach ($templateVariables['domains'] as &$domains) {
        $domains['registrationdate'] = '<span class="text-info">' . date("Y/m/d", strtotime($domains['normalisedRegistrationDate'])) . '<br>(' . jdate("Y/m/d", strtotime($domains['normalisedRegistrationDate'])) . ')</span>';
        $domains['nextduedate'] = '<span class="text-danger">' . date("Y/m/d", strtotime($domains['normalisedNextDueDate'])) . '<br>(' . jdate("Y/m/d", strtotime($domains['normalisedNextDueDate'])) . ')</span>';
    }
    // Domains Renewal Jalali Date
    foreach ($templateVariables['renewals'] as &$renewals) {
        $renewals['expiryDate'] = '<span class="text-danger">' . date("Y/m/d", strtotime($renewals['normalisedExpiryDate'])) . '<br>(' . jdate("Y/m/d", strtotime($renewals['normalisedExpiryDate'])) . ')';
    }
    // Quotes Jalali Date
    foreach ($templateVariables['quotes'] as &$quotes) {
        $quotes['datecreated'] = '<span class="text-danger">' . date("Y/m/d", strtotime($quotes['normalisedDateCreated'])) . '<br>(' . jdate("Y/m/d", strtotime($quotes['normalisedDateCreated'])) . ')';
        $quotes['validuntil'] = '<span class="text-danger">' . date("Y/m/d", strtotime($quotes['normalisedValidUntil'])) . '<br>(' . jdate("Y/m/d", strtotime($quotes['normalisedValidUntil'])) . ')';
    }
    // Services Jalali Date
    foreach ($templateVariables['services'] as &$services) {
        $services['regdate'] = jdate("Y/m/d", strtotime($services['normalisedRegDate']));
        $services['nextduedate'] = '<span class="text-danger">' . date("Y/m/d", strtotime($services['normalisedNextDueDate'])) . '<br>(' . jdate("Y/m/d", strtotime($services['normalisedNextDueDate'])) . ')</span>';
    }
    // Tickets Last Reply Jalali Date
    foreach ($templateVariables['tickets'] as &$tickets) {
        $tickets['lastreply'] = '<span class="text-danger">' . jdate("Y/m/d H:i", strtotime($tickets['normalisedLastReply'])) . '</span>';
    }
    // Tickets Reply Jalali Date
    foreach ($templateVariables['descreplies'] as &$descreplies) {
        $descreplies['date'] = '<span class="text-info">' . jdate("Y/m/d H:i", strtotime($descreplies['date'])) . '</span>';
    }
    // Invoices Jalali Date
    foreach ($templateVariables['invoices'] as &$invoices) {
        $invoices['datecreated'] = '<span class="text-danger">' . date("Y/m/d", strtotime($invoices['normalisedDateCreated'])) . '<br>(' . jdate("Y/m/d", strtotime($invoices['normalisedDateCreated'])) . ')</span>';
        $invoices['datedue'] = '<span class="text-danger">' . date("Y/m/d", strtotime($invoices['normalisedDateDue'])) . '<br>(' . jdate("Y/m/d", strtotime($invoices['normalisedDateDue'])) . ')</span>';
    }
    // Transactions Jalali Date
    foreach ($templateVariables['transactions'] as &$transactions) {
        $transactions['date'] = '<span class="text-danger">' . date("Y/m/d", strtotime($transactions['date'])) . '<br>(' . jdate("Y/m/d", strtotime($transactions['date'])) . ')</span>';
    }
    // Emails History Jalali Date
    foreach ($templateVariables['emails'] as &$emails) {
        $emails['date'] = '<span class="text-info">' . date("Y/m/d", strtotime($emails['normalisedDate'])) . '<br>(' . jdate("Y/m/d", strtotime($emails['normalisedDate'])) . ')</span>';
    }
    if ($templateVariables['date']) {
        $templateVariables['jfulldate'] = jdate("l ، j F Y", strtotime($templateVariables['date']));
    }

    $datefields = array( 'expirydate',  'date', 'duedate', 'datepaid', 'datedue');
    foreach ($datefields as $datefield) {
        if ($templateVariables[$datefield])
            $templateVariables[$datefield] = '<span class="text-danger">' . date("Y/m/d", strtotime($templateVariables[$datefield])) . '<br>(' . jdate("Y/m/d", strtotime($templateVariables[$datefield])) . ')</span>';
    }
    $datefields1 = array('registrationdate',  'datecreated');
    foreach ($datefields1 as $datefield2) {
        if ($templateVariables[$datefield2])
            $templateVariables[$datefield2] = '<span class="text-info">' . date("Y/m/d", strtotime($templateVariables[$datefield2])) . '<br>(' . jdate("Y/m/d", strtotime($templateVariables[$datefield2])) . ')</span>';
    }
    return $templateVariables;
});
// Product Details Jalali Date
add_hook('ClientAreaProductDetailsPreModuleTemplate', 1, function ($templateVariables) {
    $templateVariables['jdate'] = TRUE;
    $datefields = array('nextduedate');
    foreach ($datefields as $datefield) {
        if ($templateVariables[$datefield])
            $templateVariables[$datefield] = '<span class="text-danger">' . date("Y/m/d", strtotime($templateVariables[$datefield])) . '<br>(' . jdate("Y/m/d", strtotime($templateVariables[$datefield])) . ')</span>';
    }
    $datefields1 = array('regdate', 'lastupdate');
    foreach ($datefields1 as $datefield2) {
        if ($templateVariables[$datefield2])
            $templateVariables[$datefield2] = '<span class="text-info">' . date("Y/m/d", strtotime($templateVariables[$datefield2])) . '<br>(' . jdate("Y/m/d", strtotime($templateVariables[$datefield2])) . ')</span>';
    }
    return $templateVariables;
});
