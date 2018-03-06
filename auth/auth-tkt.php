<?php

set_include_path(get_include_path() . ':' . 'lib');

require_once 'Apache_AuthTkt.php';

$auth_tkt = new Apache_AuthTkt(array(
        'conf' => getenv('AUTH_TKT_SECRET'),
        'digest_type' => 'sha256',
    )
);
$tkt = $_COOKIE['statedemocrats_auth'];
if (!$tkt) {
    print "Missing auth tkt\n";
    exit(0);
}

$valid_tkt = $auth_tkt->validate_ticket($tkt);

print '<pre>';
if (!$valid_tkt) {
    print "Invalid ticket: $tkt\n";
    print $auth_tkt->get_err();
}
else {
    print_r($valid_tkt);
}
print '</pre>';
